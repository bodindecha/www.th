<?php session_start();if(isset($_POST['data'])){if($_POST['data']=="1"){if($_POST['right']=="N"&&isset($_FILES["slip"])){$target_dir="../../teacher/admission-upload/";$imageFileType=strtolower(pathinfo($target_dir.basename($_FILES["slip"]["name"]),PATHINFO_EXTENSION));$target_file=$target_dir.$_SESSION['user_id'].".".$imageFileType;$uploadOk=($_FILES["slip"]["size"]<=10000000);if(!in_array($imageFileType,array("png","jpg","jpeg","pdf")))$uploadOk=false;if($uploadOk){if(file_exists($target_file))unlink($target_file);if(move_uploaded_file($_FILES["slip"]["tmp_name"],$target_file))$reason="Evidence uploaded successfully. ​";else $status=1;}else $status=1;}if(!isset($status)){include("../../resource/appwork/db_connect.php");include("../../resource/appwork/getip.php");$chq_dup=$db->query("SELECT time FROM chdata WHERE stdcode='".$_SESSION['user_id']."'");if($chq_dup->num_rows==0){foreach(["right","group1"]as $pn)$_POST[$pn]=$db->real_escape_string($_POST[$pn]);$status=($db->query("INSERT INTO chdata (stdcode,cfm,cgroup,ip) VALUES ('".$_SESSION['user_id']."','".$_POST['right']."','".$_POST['group1']."','$ip')"))?0:2;}else{$status=3;while($mrs=$chq_dup->fetch_assoc())$reason=$mrs["time"];}$db->close();}}else if($_POST['data']=="2"){if($_POST['right1']=="N"&&isset($_FILES["slip1"])){$target_dir="../../teacher/admission-upload/";$imageFileType=strtolower(pathinfo($target_dir.basename($_FILES["slip1"]["name"]),PATHINFO_EXTENSION));$target_file=$target_dir.$_SESSION['user_id'].".".$imageFileType;$uploadOk=($_FILES["slip1"]["size"]<=10000000);if(!in_array($imageFileType,array("png","jpg","jpeg","pdf")))$uploadOk=false;if($uploadOk){if(file_exists($target_file))unlink($target_file);if(move_uploaded_file($_FILES["slip1"]["tmp_name"],$target_file))$reason="Evidence uploaded successfully. ​";else $status=1;}else $status=1;}if($_POST['right2']=="N"&&isset($_FILES["slip2"])){$target_dir="../../teacher/admission-upload/";$imageFileType=strtolower(pathinfo($target_dir.basename($_FILES["slip2"]["name"]),PATHINFO_EXTENSION));$target_file=$target_dir.$_SESSION['user_data']["code2"].".".$imageFileType;$uploadOk=($_FILES["slip2"]["size"]<=10000000);if(!in_array($imageFileType,array("png","jpg","jpeg","pdf")))$uploadOk=false;if($uploadOk){if(file_exists($target_file))unlink($target_file);if(move_uploaded_file($_FILES["slip2"]["tmp_name"],$target_file))$reason="Evidence uploaded successfully. ​";else $status=1;}else $status=1;}if(!isset($status)&&!($_POST['right1']=="Y"&&$_POST['right2']=="Y")){include("../../resource/appwork/db_connect.php");include("../../resource/appwork/getip.php");$chq_dup=$db->query("SELECT time FROM chdata WHERE stdcode='".$_SESSION['user_id']."' OR stdcode='".$_SESSION['user_data']["code2"]."'");if($chq_dup->num_rows==0){$query_string="";for($i=1;$i<=intval($_POST['data']);$i++){$j=strval($i);foreach(["stdcode$j","right$j","group$j"]as $pn)$_POST[$pn]=$db->real_escape_string($_POST[$pn]);$query_string.=($query_string==""?"":", ")."('".$_POST["stdcode$j"]."','".$_POST["right$j"]."','".$_POST["group$j"]."','$ip')";}$status=($db->query("INSERT INTO chdata (stdcode,cfm,cgroup,ip) VALUES $query_string"))?0:2;}else{$status=3;while($mrs=$chq_dup->fetch_assoc())$reason=$mrs["time"];}$db->close();}if($status==0)$_SESSION['user_data']["adm"]["step"]++;}else $status=3;if($status==0)$_SESSION['user_data']["adm"]["step"]++;header("Location: /reg/student/admission/?status=$status".(isset($reason)?"&reason=$reason":""));}else if(isset($_SESSION['user_auth'])&&$_SESSION['user_data']["form_intime"]){include("../../resource/appwork/appfunc.php");include("../../resource/appwork/db_connect.php");$choices=$db->query("SELECT stdcode,cgroup FROM stddata WHERE natid='".$_SESSION['user_data']["natid"]."'");$db->close();$cgroup_options=array();$stdcodes=array();if($choices->num_rows>=1){$i=1;while($choice=$choices->fetch_assoc()){array_push($cgroup_options,'<b>'.code2group($choice['cgroup']).'</b><input type="hidden" name="group'.strval($i++).'" value="'.$choice['cgroup'].'" />');array_push($stdcodes,$choice['stdcode']);}echo '<style type="text/css">div.form-action table{transform:translate(-1px,-1.5px);min-width:calc(100% + 1px);}div.form-action table tbody tr:not(:first-child) td{border-top:none;}div.form-action table tbody tr td > *:not(b),input[type="file"]{font-size:15px;}div.form-action table tbody tr.incf td:nth-child(2) > *{position:relative;top:-12.5px;}div.form-action a.t[role="button"]:before{content:"► "}div.form-action a.t[role="button"]:after{content:" ◄"}div.form-action input[type="radio"]{width:0px;height:0px;opacity:0;filter:opacity(0);}div.form-action i.material-icons{transform:translate(2.5px,7.5px);color:var(--clr-bs-green);font-size:30px;font-weight:bold;overflow:hidden;transition:var(--time-tst-medium);}div.form-action div.center{margin-top:-15px!important;font-size:15px;}</style>','<form method="post" action="/reg/student/admission/confirm.php" enctype="multipart/form-data">','<div class="text">ข้าพเจ้า <b class="name">'.$_SESSION['user_name'].'</b> รหัสประจำตัวนักเรียน (นักเรียนเดิม) / เลขประจำตัวผู้สอบ (นักเรียนใหม่) <b class="id">'.$_SESSION['user_id'].'</b> ได้รับการคัดเลือกเข้าศึกษาชั้นมัธยมศึกษาปีที่ 4 ปีการศึกษา 2564 ณ โรงเรียนบดินทรเดชา (สิงห์ สิงหเสนี) ประเภทห้องเรียนปกติ มีความประสงค์เลือกเรียนแผนการเรียน (ยืนยันได้เพียง 1 แผนการเรียนเท่านั้น) ดังนี้</div>','<div class="table"><table><tbody>';if($choices->num_rows==1){echo '<tr><td>แผนการเรียน '.$cgroup_options[0].'</td>','<td><a role="button" class="green" href="javascript:cnf.right(\'Y\')">ยืนยันสิทธิ์</a><input name="right" value="Y" type="radio" required> <input name="right" value="N" type="radio" required><a role="button" class="red" href="javascript:cnf.right(\'N\')">สละสิทธิ์</a>',' <span class="file cyan"></span></td></tr>';}else if($choices->num_rows>1){for($i=0;$i<$choices->num_rows;$i++){$j=strval($i+1);echo '<tr><td>แผนการเรียน '.$cgroup_options[$i].'<input name="stdcode'.$j.'" type="hidden" value="'.$stdcodes[$i].'" /></td>','<td><a role="button" class="green" href="javascript:scf.right('.$j.', \'Y\')">ยืนยันสิทธิ์</a><input name="right'.$j.'" value="Y" type="radio" required> <input name="right'.$j.'" value="N" type="radio" required><a role="button" class="red" href="javascript:scf.right('.$j.', \'N\')">สละสิทธิ์</a>',' <span class="file'.$j.' cyan"></span></td></tr>';}}echo '</tbody></table></div><div class="center"><center><a href="/reg/resource/upload/คำร้องขอสละสิทธิ์.pdf" download="เอกสารการขอสละสิทธิ์.pdf" onClick="app.io.confirm(\'download\', {me:this, app_name:\'เอกสารการขอสละสิทธิ์\'})">[ดาว์นโหลดเอกสารการขอสละสิทธิ์]</a></center></div>','<div class="text"><b>หมายเหตุ</b> การยืนยันสิทธิ์ มีผลต่อสิทธิ์การเข้าศึกษาต่อและการจัดแผนการเรียน</div>','<center><button name="data" value="'.strval($choices->num_rows).'" class="blue" onClick="return '.($choices->num_rows>1?"scf":"cnf").'.validate()">บันทึกข้อมูล</button></center>','</form>';}else echo '<center><div class="message yellow"><pre>Internal Server 500</pre></div></center>';}else echo '<center><div class="message '.((time()<$_SESSION['user_data']["form_time_end"])?'gray">You are unauthorized':'blue">ขณะนี้อยู่นอกเวลาใช้งานระบบ').'</div></center>'; ?>