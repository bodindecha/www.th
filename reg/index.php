<?php
	session_start();
	$su = isset($_SESSION['user_ac']) ? "teacher" : "student";
	header("Location: /reg/$su/");
?>