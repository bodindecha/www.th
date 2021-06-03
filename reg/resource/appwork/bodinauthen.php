<?php
	session_start();
	

    $hrfr = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "";
    if (strpos($hrfr, $_SERVER['SERVER_NAME'])>-1 && isset($_SESSION['auth'])) unset($_SESSION['auth']);
	include("db_connect.php");

	// Function check validity to use authoraze app
	$apis = array( // crc32 u@d
		"dc933a02" => ["TianTcl", "42629.std.bodin.ac.th"]
	);
	foreach ($apis as $kq => $ud) { if ($_SERVER['HTTP_ORIGIN']=="https://".$ud[1]) {
		header("Access-Control-Allow-Origin: ".$_SERVER['HTTP_ORIGIN']);
		break;
	} } # header("Access-Control-Allow-Origin: *");
	function valid_api() {
		if (!isset($hrfr)) $hrfr = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "";
		if (isset($_POST['api_key'])) { // "-bodinauthen-<api_key>-api-" -> str_rot13 -> strrev -> b64enc -> rem eq-sign
			$ak = str_rot13(substr(strrev(base64_decode(trim($_POST['api_key'])."=")), 13, 8));
			return (isset($apis[$ak]) && parse_url($hrfr)['host']==$apis[$ak][1]);
		} else return false;
	}

    // Function get info from database
    function getuserdata($user, $zone) {
        /* $getuserinf = $db -> query("");
        if ($getuserinf) {
		    if ($getuserinf -> num_rows == 1) {
                while ($getinf = $getuserinf -> fetch_assoc()) $userinf = $getinf;
                return $userinf;
            } else return null;
        } else return false; */
        return [""];
    }

	// Function get student generation for low range search
	$generations = [48=>39212, 49=>40036, 50=>40855, 51=>41700, 52=>42537, 53=>43323]; // เลขประจำตัวต่ำสุดของรุ่น
	function getstdgen($stdid, $generations=$generations) {
		$gen = 0;
		for ($g = 48; $g < 53; $g++) {
			if ($stdid >= $generations[$g]) $gen = $g;
			else break;
		}
		return ($gen) ? ["ou=bd".strval($gen).",", "ou=bd".strval($gen-3).","] : "";
	}

	// Function Ldap Authen
	function ldap_authen($server,$base_dn,$useraccount,$password){

		$ldapserver = ldap_connect($server);
		// If Server Ldap Version is 3
		ldap_set_option($ldapserver, LDAP_OPT_PROTOCOL_VERSION, 3);
		ldap_set_option($ldapserver, LDAP_OPT_TIMELIMIT, 6);
		ldap_set_option($ldapserver, LDAP_OPT_REFERRALS, 0);
		$useraccountad = "BODIN\\".$useraccount;
		$bind = @ldap_bind($ldapserver, $useraccountad, $password);
		$authen = "true";
		if (!$bind) $authen = "false";
		$filter = "samaccountname=".$useraccount;
		// $inforequired = array("sAMAccountName");
		$result = @ldap_search($ldapserver, $base_dn, $filter);
		$info = @ldap_get_entries($ldapserver, $result);
		if (!$result) $authen = "false";
		// Count = 1, True   <- found account
		// Count = 0,>1 False  <- not found account or found more than 1 account
		if ($info["count"] == 0) $authen = "false";
		if ($info["count"] > 1) $authen = "false";
		if (isset($info[0]["distinguishedName"])) $user_dn = $info[0]["distinguishedName"];
		else $user_dn = "";
		//use dn for authen with password
		$bind = @ldap_bind($ldapserver, $useraccountad, $password);
		if (!$bind) $authen = "false";
		
		ldap_close($ldapserver);
		
		return $authen;
	}
	
	// Define Zone (Authen Zone)
	if (isset($_POST['zone'])) $zone = $_POST['zone'];
	else $zone = 0; // Default Authen Zone (Login Web)
	
	if ($is_valid) {

		// If submit action
		if (isset($_POST['username']) && isset($_POST['password'])) {
			// Cut *,space and lowercase -> username (Ldap authen pass with * and space)
			$_POST['username'] = str_replace("*", "", strtolower(trim($_POST['username'])));
			// Check username and password not blank
			if ($_POST['username']<>"" && $_POST['password']<>"") {
				// Array 1 = Server Set
				// Array 2 -> 0 = Base Dn
				// Array 2 -> 1,2,3,4 = Ldap Server Name or IP (Priority)
				// Note : Each Ldap Server can authen all OU (But better authen nearly network)
				
				$bdstdgens = getstdgen(intval($_POST['username']));
				$bdstdgen = ($bdstdgens=="") ? "" : $bdstdgens[0];

				$authenzone = array(
					[$bdstdgen."ou=student,dc=bodin,dc=ac,dc=th", "ldap01.bodin.ac.th", "ldap02.bodin.ac.th"],
					["ou=teacher,dc=bodin,dc=ac,dc=th", "ldap01.bodin.ac.th", "ldap02.bodin.ac.th"],
					["ou=employee,dc=bodin,dc=ac,dc=th", "ldap01.bodin.ac.th", "ldap02.bodin.ac.th"],
				); $authen = "false";
				$i = 1; while ($i < count($authenzone[$zone])) {
					$authen = ldap_authen($authenzone[$zone][$i], $authenzone[$zone][0], $_POST['username'], $_POST['password']);
					if ($authen=="true") $i = count($authenzone[$zone]);
					else $i++;
				} if ($authen=="false" && $zone==0 && $bdstdgens<>"") { // If student -> retry another gen
					$bdstdgen = $bdstdgens[0];
					$authenzone[0][0] = $bdstdgen."ou=student,dc=bodin,dc=ac,dc=th";
					$i = 1; while ($i < count($authenzone[$zone])) {
						$authen = ldap_authen($authenzone[$zone][$i], $authenzone[$zone][0], $_POST['username'], $_POST['password']);
						if ($authen=="true") $i = count($authenzone[$zone]);
						else $i++;
					}
				}
				
				// Protaego SQL injequetion
				$_POST['username'] = strval($db -> real_escape_string($_POST['username']));
				$_POST['password'] = strval($db -> real_escape_string($_POST['password']));
					
				if ($authen=="true") { // ถ้าผ่าน
					if (strpos($hrfr, $_SERVER['SERVER_NAME'])>-1) {
						// get std data
						$userdata = getuserdata($_POST['username'], $zone);
						if ($userdata==false) echo '{"success": false, "reason": "Unable to get user\'s data."}';
						else if ($userdata==null) echo '{"success": false, "reason": "No record of this user found."}';
						else {
							echo '{"success": true}';
							$_SESSION['auth'] = array(
								
							);
						}
					} else echo '{"success": true, "token": "'.sha1(time()).'"}';
				} else echo '{"success": false, "reason": [3, "Incorrect username or password."]}';
			} else echo '{"success": false, "reason": [3, "Parameter(s) empty."]}';
		} else if ($hrfr=="") header("Location: https://bodin.ac.th");
		else echo '{"success": false, "reason": [3, "No parameters."]}';
	
	} else echo '{"success": false, "reason": [2, "Invalid API key."]}';
	
	$db -> close();
?>