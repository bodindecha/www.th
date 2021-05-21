<?php
	session_start();
	$vn_s = array("user_auth", "user_name", "user_id", "user_data");
	$vn_t = array("user_ac");
	$varnames = (isset($_GET['f']) && $_GET['f']=="t") ? $vn_s : array_merge($vn_s, $vn_t);
	foreach ($varnames as $vn) {
		if (isset($vn)) unset($_SESSION[$vn]);
	}
?>