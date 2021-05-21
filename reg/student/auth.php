<?php
	session_start();
	
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
	
	// If submit action
	if (isset($_POST['username']) && isset($_POST['password'])) {
		// Cut *,space and lowercase -> username (Ldap authen pass with * and space)
		$_POST['username'] = str_replace("*", "", strtolower(trim($_POST['username'])));
		// Check username and password not blank
		if ($_POST['username']<>"" && $_POST['password']<>"") {
			
			// Seperate OLD & NEW
			if (strlen($_POST['username'])<6) { // OLD
				// Array 1 = Server Set
				// Array 2 -> 0 = Base Dn
				// Array 2 -> 1,2,3,4 = Ldap Server Name or IP (Priority)
				// Note : Each Ldap Server can authen all OU (But better authen nearly network)
				// Student
				$authenzone[0][0] = "ou=bd52,ou=student,dc=bodin,dc=ac,dc=th";
				$authenzone[0][1] = "ldap01.bodin.ac.th";
				$authenzone[0][2] = "ldap02.bodin.ac.th";
				$authen = "false";
				$i = 1; while ($i < count($authenzone[$zone])) {
					$authen = ldap_authen($authenzone[$zone][$i], $authenzone[$zone][0], $_POST['username'], $_POST['password']);
					if ($authen=="true") {
						$i = count($authenzone[$zone]);
						// Set variable zonename use to insert database (bkn,kps,src,csc)
						$zonename = substr($authenzone[$zone][0], 3, 7);
					} else $i++;
				}
			} else { // NEW
				include("../resource/appwork/db_connect.php");
				$newstdlogin = $db -> query("SELECT stdcode,name,cgroup FROM stddata WHERE stdcode='".$_POST['username']."' AND natid = '".$_POST['password']."'");
				$db -> close();
				// คืนค่า $authen
			}
				
			if ($authen=="true") { //ถ้าผ่าน
				echo '{"success": true}';
				$_SESSION['user_auth'] = 1;
				$_SESSION['user_name'] = "";
				$_SESSION['user_id'] = $_POST['username'];
				$_SESSION['user_data'] = array(
					"adm" => array()
				);
				
				include("../resource/appwork/db_connect.php");
				$cnfdata = $db -> query("SELECT cgroup,time,ip FROM chdata WHERE stdcode='".$_SESSION['user_id']."'");
				$db -> close();
				if ($cnfdata -> num_rows == 1) {
					while ($rs = $cnfdata -> fetch_assoc()) {
						$_SESSION['user_data']["adm"]["time"] = $rs['time'];
						$_SESSION['user_data']["adm"]["ip"] = $rs['ip'];
						$_SESSION['user_data']["adm"]["step"] = ($rs['cgroup']==""? 2 : 3);
					}
				} else $_SESSION['user_data']["adm"]["step"] = 1;
				
			} else { //ถ้าไม่ผ่าน
				echo '{"success": false}';
			}
		}
		
		include("../resource/appwork/db_connect.php");
		$cnfdata = $db -> query("SELECT cgroup,time,ip FROM chdata WHERE stdcode='".$_SESSION['user_id']."'");
		$db -> close();
		if ($cnfdata -> num_rows == 1) { while ($rs = $cnfdata -> fetch_assoc()) {
			$_SESSION['user_data']["adm"]["time"] = $rs['time'];
			$_SESSION['user_data']["adm"]["ip"] = $rs['ip'];
			$_SESSION['user_data']["adm"]["step"] = (ctype_lower($rs['cgroup'])? 2 : 3);
			if ($_SESSION['user_data']["adm"]["step"]==2) $_SESSION['user_data']["adm"]["sgroup"] = $rs['cgroup'];
		} } else $_SESSION['user_data']["adm"]["step"] = 1;
		
	} else { header("Location: /reg/student/"); }
?>