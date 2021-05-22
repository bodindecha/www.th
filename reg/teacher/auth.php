<?php
	session_start(); $show_auth_form = false;
	$header_title = "Teachers";
	$header_desc = "Authorized teacher only";
	
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
	if (isset($_SESSION['user_ac'])) unset($_SESSION['user_ac']);
	if (isset($_POST['username']) && isset($_POST['password'])) {
		// Cut *,space and lowercase -> username (Ldap authen pass with * and space)
		$_POST['username'] = str_replace("*", "", strtolower(trim($_POST['username'])));
		// Check username and password not blank
		if ($_POST['username']<>"" && $_POST['password']<>"") {
			// Array 1 = Server Set
			// Array 2 -> 0 = Base Dn
			// Array 2 -> 1,2,3,4 = Ldap Server Name or IP (Priority)
			// Note : Each Ldap Server can authen all OU (But better authen nearly network)
			// Teacher
			$authenzone[0][0]="ou=teacher,dc=bodin,dc=ac,dc=th";
			$authenzone[0][1]="ldap01.bodin.ac.th";
			$authenzone[0][2]="ldap02.bodin.ac.th";
			// Employee
			$authenzone[1][0]="ou=employee,dc=bodin,dc=ac,dc=th";
			$authenzone[1][1]="ldap01.bodin.ac.th";
			$authenzone[1][2]="ldap02.bodin.ac.th";
			$authen = "false";
			$i = 1; while ($i < count($authenzone[$zone])) {
				$authen = ldap_authen($authenzone[$zone][$i], $authenzone[$zone][0], $_POST['username'], $_POST['password']);
				if ($authen=="true") {
					$i = count($authenzone[$zone]);
					// Set variable zonename use to insert database (bkn,kps,src,csc)
					$zonename = substr($authenzone[$zone][0], 3, 7);
				} else $i++;
			}
			if ($authen=="true") { //ถ้าผ่าน
				echo '{"success": true}';
				$_SESSION['user_ac'] = true;
			} else { //ถ้าไม่ผ่าน
				echo '{"success": false}';
			}
		}
		
	} else if (isset($_POST['ac'])) {
		$ac = strtolower(trim($_POST['ac']));
		$acs = array(
			"6072ccd156f23a5b32f52afd9c3eb2daa5effd2b" // IctBodin4113
		);
		$pac = sha1($ac);
		if (in_array($pac, $acs)) {
			$_SESSION['user_ac'] = true;
			echo '{"success": true}';
		} else echo '{"success": false, "pac": "'.$pac.'"}';
		
	} else {
		echo '<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>';
		include("../resource/hpe/heading.php"); include("../resource/hpe/init_ss.php");
		echo '<style type="text/css">
			main div.container {
				position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
				width: 420px; height: 100px;
				text-align: center; line-height: 50px;
			}
			main div.container button {
				padding: 5px 15px;
				font-family: \'Sarabun\', serif; font-size: 18.75px; line-height: 30px;
				cursor: pointer;
			}
		</style>
		<script type="text/javascript">
			function fac() { app.sys.auth.tac("'.$_GET['return_url'].'"); document.querySelector("html body section.modal span.ctxt input").focus(); }
			$(document).ready(function() {
				// fac();
				$("html body header section div.head-item.auth").remove();
			}); var af_showed = false;
		</script>
	</head>
	<body>';
		include("../resource/hpe/header.php");
		echo '<main shrink="'.(($_COOKIE['sui_open-nt'])??"false").'">
			<div class="container">
				<span>Please authorize to continue.<br></span>
				<button onClick="fac()" class="blue">Provide access code</button> <button onClick="app.sys.auth.teacher()" class="blue">Authenticate</button>
			</div>
		</main>';
		include("../resource/hpe/material.php");
		echo '<footer>';
			include("../resource/hpe/footer.php");
		echo '</footer>
	</body>
</html>';
	}
?>