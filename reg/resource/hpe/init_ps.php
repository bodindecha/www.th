<?php
    session_start();
    $my_url = ($_SERVER['REQUEST_URI']=="/")?"":"?return_url=".urlencode(ltrim($_SERVER['REQUEST_URI'], "/"));
    if (preg_match("/^\/reg\/teacher\//", $_SERVER['PHP_SELF'])) {
		$show_auth_form = false;
		if (!isset($_SESSION['user_ac'])) header("Location: /reg/teacher/auth.php");
	} else if (preg_match("/^\/reg\/resource\//", $_SERVER['PHP_SELF'])) {
		$show_auth_form = false;
	} else if (preg_match("/^\/reg\/student\//", $_SERVER['PHP_SELF'])) {
		if (isset($_SESSION['user_ac'])) unset($_SESSION['user_ac']);
		$show_auth_form = true;
		if (isset($_SESSION['user_auth'])) {
			$show_auth_form = false;
			// switch ($_SESSION['user_auth']) {
			//     case 1: $link_prof = "myaccount"; $link_course = "mycourse"; break;
			// }
		}
	} else $show_auth_form = true;
?>