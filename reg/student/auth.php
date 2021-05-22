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
		// Connect to database
		include("../resource/appwork/db_connect.php");
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
				$search_sql = "";
			} else { // NEW
				$search_sql = " AND natid='".$_POST['password']."'";
				$authen = "true";
			}
			
			// Get std data
			$newstdlogin = $db -> query("SELECT * FROM stddata WHERE stdcode='".$_POST['username']."'$search_sql");
			if ($newstdlogin -> num_rows == 1) { while ($ers = $newstdlogin -> fetch_assoc()) $stddata = $ers; }
				
			if ($authen=="true" && isset($stddata)) { // ถ้าผ่าน
				echo '{"success": true}';
				$_SESSION['user_auth'] = 1;
				$_SESSION['user_name'] = $stddata['name'];
				$_SESSION['user_id'] = $stddata['stdcode'];
				$_SESSION['user_data'] = array(
					"natid" => $stddata['natid']
				);
				$secondary_id = $db -> query("SELECT stdcode FROM stddata WHERE natid='".$_SESSION['user_data']["natid"]."' AND stdcode<>'".$_SESSION['user_id']."'");
				if ($secondary_id -> num_rows == 1) { while ($gsi = $secondary_id -> fetch_assoc()) $_SESSION['user_data']["code2"] = $gsi['stdcode']; }
			} else { // ถ้าไม่ผ่าน
				echo '{"success": false, "reason": '.($authen=="true"?'[1, "There isn\'t any record for your account yet."]':'[3,"Incorrect username or password."]').'}';
			}
		}
		
		// Get /std/admission data
		if (isset($_SESSION['user_auth'])) {
			$cnfdata = $db -> query("SELECT cfm,cgroup,time,ip FROM chdata WHERE stdcode='".$_SESSION['user_id']."'");
			if (isset($_SESSION['user_data']["code2"])) {
				$dupdata = $db -> query("SELECT cgroup,time,ip FROM chdata WHERE stdcode='".$_SESSION['user_data']["code2"]."'");
				$has_dup = ($dupdata -> num_rows == 1);
			} else $has_dup = false;
			if ($cnfdata -> num_rows == 1 || $has_dup) { while ($rs = ($has_dup?$dupdata:$cnfdata) -> fetch_assoc()) {
				$_SESSION['user_data']["adm"] = array(
					"time" => $rs['time'],
					"ip" => $rs['ip'],
					"step" => 2,
					"cgroup" => $rs['cgroup'],
					"cfm" => $rs['cfm']
				);
			} } else $_SESSION['user_data']["adm"] = array("step" => 1);
		}
		
		$db -> close();
		
	} else { header("Location: /reg/student/"); }
?>