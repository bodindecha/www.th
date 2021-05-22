<?php
	session_start();
	if (isset($_POST['data'])) {
		if ($_POST['right']=="N" && isset($_FILES["slip"])) {
			$target_dir = "../../teacher/admission-upload/";
			$imageFileType = strtolower(pathinfo($target_dir.basename($_FILES["slip"]["name"]), PATHINFO_EXTENSION));
			$target_file = $target_dir.$_SESSION['user_id'].".".$imageFileType;
			$uploadOk = ($_FILES["slip"]["size"] <= 10000000) /* 10 MB */;
			if (!in_array($imageFileType, array("png", "jpg", "jpeg", "pdf"))) $uploadOk = false;
			if ($uploadOk) {
				if (file_exists($target_file)) unlink($target_file);
				if (move_uploaded_file($_FILES["slip"]["tmp_name"], $target_file)) $reason = "Evidence uploaded successfully. ";
				else $status = 1;
			} else $status = 1;
		}
		if (!isset($status)) {
			include("../../resource/appwork/db_connect.php");
			include("../../resource/appwork/getip.php");
			$dt = date("Y-m-d H:i:s");
			$chq_dup = $db -> query("SELECT time FROM chdata WHERE stdcode='".$_SESSION['user_id']."'");
			if ($chq_dup -> num_rows == 0) {
				$_POST['group'] = $_POST['group'];
				if ($db -> query("INSERT INTO chdata (stdcode,cfm,cgroup,ip) VALUES ('".$_SESSION['user_id']."','".$_POST['right']."','".$_POST['group']."','$ip')")) {
					$status = 0;
					$_SESSION['user_data']["adm"]["cgroup"] = $_POST['group'];
					$_SESSION['user_data']["adm"]["cfm"] = $_POST['right'];
					$_SESSION['user_data']["adm"]["time"] = $dt;
					$_SESSION['user_data']["adm"]["ip"] = $ip;
				}
				else $status = 2;
			} else {
				$status = 3;
				while ($mrs = $chq_dup -> fetch_assoc()) $reason = $mrs["time"];
			}
			$db -> close();
		}
		if ($status==0) $_SESSION['user_data']["adm"]["step"]++;
		header("Location: /reg/student/admission/?status=$status".(isset($reason)?"&reason=$reason":""));
	} else if (isset($_SESSION['user_auth'])) {
		include("../../resource/appwork/appfunc.php");
		include("../../resource/appwork/db_connect.php");
		$choices = $db -> query("SELECT cgroup FROM stddata WHERE natid='".$_SESSION['user_data']["natid"]."'");
		$db -> close();
		$cgroup_options = ""; if ($choices -> num_rows >= 1) {
			while ($choice = $choices -> fetch_assoc()) $cgroup_options .= '<option value="'.$choice['cgroup'].'">'.code2group($choice['cgroup']).'</option>';
		}
		
		echo '<style type="text/css">div.form-action table{transform:translate(-1px,-1.5px);}div.form-action table tbody tr td > *,input[type="file"]{font-size:15px;}div.form-action.incf table tbody tr:nth-child(1) td:nth-child(2) > *{position:relative;top:-12.5px;}div.form-action a.t[role="button"]:before{content:"► "}div.form-action a.t[role="button"]:after{content:" ◄"}div.form-action input[type="radio"]{width:0px;height:0px;opacity:0;filter:opacity(0);}div.form-action i.material-icons{transform:translate(2.5px,7.5px);color:var(--clr-bs-green);font-size:30px;font-weight:bold;overflow:hidden;transition:var(--time-tst-medium)}</style>',
			'<form method="post" action="/reg/student/admission/confirm.php" enctype="multipart/form-data">',
			'<div class="text">ข้าพเจ้า <u class="name">'.$_SESSION['user_name'].'</u> รหัสประจำตัวนักเรียน (นักเรียนเดิม) / เลขประจำตัวผู้สอบ (นักเรียนใหม่) <u class="id">'.$_SESSION['user_id'].'</u> ได้รับการคัดเลือกเข้าศึกษาชั้นมัธยมศึกษาปีที่ 4 ปีการศึกษา 2564 ณ โรงเรียนบดินทรเดชา (สิงห์ สิงหเสนี) ประเภทห้องเรียนปกติ มีความประสงค์เลือกเรียนแผนการเรียน (ยืนยันได้เพียง 1 แผนการเรียนเท่านั้น) ดังนี้</div>',
			'<div class="table"><table><tbody>',
			'<tr><td>แผนการเรียน <select name="group" role="button" class="cyan">'.$cgroup_options.'</select></td>',
			'<td><a role="button" class="green" href="javascript:cnf.right(\'Y\')">ยืนยันสิทธิ์</a><input name="right" value="Y" type="radio" required> <input name="right" value="N" type="radio" required><a role="button" class="red" href="javascript:cnf.right(\'N\')">สละสิทธิ์</a> <span class="file cyan"></span></td></tr>',
			'</tbody></table></div>',
			'<div class="text"><b>หมายเหตุ</b> การยืนยันสิทธิ์ มีผลต่อสิทธิ์การเข้าศึกษาต่อและการจัดแผนการเรียน</div>',
			'<center><button name="data" class="blue" onClick="return cnf.validate()">บันทึกข้อมูล</button></center>',
			'</form>';
	} else echo '<center>You are unauthorized</center>';
?>