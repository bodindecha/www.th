<?php
	session_start();
	$group = strtoupper($_SESSION['user_data']["adm"]["sgroup"]);
	if (isset($_POST['data'])) {
		unset($_SESSION['user_data']["adm"]["sgroup"]);
		include("../../resource/appwork/db_connect.php");
		include("../../resource/appwork/getip.php");
		$dt = date("Y-m-d H:i:s");
		if(!$db -> query("UPDATE chdata SET cgroup='$group',time='$dt',ip='$ip' WHERE stdcode='".$_SESSION['user_id']."'")) $status = false;
		else $status = "true";
		$db -> close();
		$_SESSION['user_data']["adm"]["time"] = $dt;
		$_SESSION['user_data']["adm"]["ip"] = $ip;
		$_SESSION['user_data']["adm"]["step"]++;
		$_SESSION['user_data']["adm"]["cgroup"] = $group;
		include("../../resource/appwork/appfunc.php");
		echo '{"success": '.$status.', "time": "'.$dt.'", "ip": "'.$ip.'", "cgr": "'.group2code($group).'"}';
	} else {
		include("../../resource/appwork/appfunc.php");
		echo '{"cnftxt": "ข้าพเจ้า <u>'.$_SESSION['user_name'].'</u> รหัสประจำตัวนักเรียน (นักเรียนเดิม) / เลขประจำตัวผู้สอบ (นักเรียนใหม่) <u>'.$_SESSION['user_id'].'</u> ขอยืนยันสิทธิ์การเข้าศึกษาต่อ ชั้นมัธยมศึกษาปีที่ 4 แผนการเรียน <u>'.code2group($group).'</u>"}';
	}
?>