<?php
	$db = new mysqli("localhost", "th_m4cfm", "ixpdlTb78n5PX1nq", "th_m4cfm");
	$db -> set_charset("utf8");
	// if ($db -> connect_errno) { die("Connection failed: ".$db -> connect_error); }
	function str_escape_sql($ipt_data) {
		$opt_data = strval($db -> real_escape_string($ipt_data));
		return $opt_data;
	}
?>