<?php
	include("../../resource/hpe/init_ps.php");
	$header_title = "Student";
	$header_desc = "Admission | New student confirmation";
	
	// Set close date time
	$_SESSION['user_data']["form_time_end"] = 1621935000; // ไปแปลงที่นี่เอา dracon.biz/timestamp.php (ตอนนี้ตั้งไว้ 2021-05-25 16-30-00) --> 1621935000
	
	// Get /std/admission data
	if (isset($_SESSION['user_auth'])) { 
		include("../../resource/appwork/db_connect.php");
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
	} } else $_SESSION['user_data']["adm"] = array("step" => (time()<$_SESSION['user_data']["form_time_end"])?1:0);
	}
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php include("../../resource/hpe/heading.php"); include("../../resource/hpe/init_ss.php"); ?>
		<style type="text/css">
			main div.container {
				position: relative; top: 50px; left: 50%; transform: translateX(-50%);
				max-width: 95%;
			}
			@media (min-width: 1200px) { main div.container { width: 1170px; } }
			@media (min-width: 992px) {	main div.container { width: 970px; } }
			@media (min-width: 768px) { main div.container { width: 750px; } }
			main div.container div.form-action { margin-top: 50px; }
			main div.container div.form-action form {
				padding: 0px 12.5px;
				background-color: var(--clr-bs-light);
				border-radius: 5px; border: 1px solid var(--clr-bs-gray);
			}
			main div.container div.form-action form > * { margin: 25px 0px; }
			main div.container div.form-action div.message { line-height: 30px; }
		</style>
		<script type="text/javascript">
			function open_unconfirmed_form() {
				document.querySelector("main div.container div.form-action").innerHTML = '<center><br>ยืนยันสายการเรียน<br><br><button class="blue" onClick="app.sys.auth.check()">ดำเนินการ</button></center>';
			}
			function open_confirmation_form() {
				var s = new XMLHttpRequest;
				s.open("GET","/reg/student/admission/confirm.php", true);
				s.responseType = "text";
				s.onload = function() {
					document.querySelector("main div.container div.form-action").innerHTML = this.responseText;
					$(window).trigger("resize");
				}; s.send();
				if (typeof cnf === "undefined") $.ajax({url: "/reg/resource/js/extend/std-adm-subform.js"});
			}
			function open_complete_form(eti=0) {
				if (eti==0) document.querySelector("main div.container div.form-action").innerHTML = '<center><div class="message gray">You are unauthorized</div></center>';
				else {
					var estr = ((!(typeof eti.time === "undefined") || !(typeof eti.ip === "undefined"))?"<br>":"")+(typeof eti.time === "undefined"?"":"ณ วันเวลาที่ "+eti.time+" ")+(typeof eti.ip === "undefined"?"":"ผ่าน IP "+eti.ip);
					if (!(typeof eti.cgr === "undefined")) estr += '<br>โดยได้'+(eti.cfm=="Y"?'ยืนยันสิทธิ์กลุ่มการเรียน '+eti.cgr:"สละสิทธิ์การเข้าศึกษาต่อที่โรงเรียนบดินทรเดชา (สิงห์ สิงหเสนี)");
					document.querySelector("main div.container div.form-action").innerHTML = '<center><div class="message '+(eti.cfm=="Y"?"green":"red")+'"><?php if(isset($_SESSION['user_name']))echo $_SESSION['user_name']; ?> รหัสประจำตัวนักเรียน / เลขประจำตัวผู้สอบ <?php if(isset($_SESSION['user_id']))echo $_SESSION['user_id']; ?> ได้ดำเนินการเรียบร้อยแล้ว'+estr+'</div></center>';
				}
			}
			function open_not_time_form() {
				document.querySelector("main div.container div.form-action").innerHTML = '<center><div class="message yellow">ขณะนี้หมดเวลาในการใช้งานระบบแล้ว</div></center>';
			}
			$(document).ready(function() {
				<?php
					if (isset($_SESSION['user_auth'])) {
						include("../../resource/appwork/appfunc.php");
						switch ($_SESSION['user_data']["adm"]["step"]) {
							case 0: echo 'open_not_time_form();'; break;
							case 1: echo 'open_confirmation_form();'; break;
							case 2: echo 'open_complete_form({time: "'.$_SESSION['user_data']["adm"]["time"].'", ip: "'.$_SESSION['user_data']["adm"]["ip"].'", cgr: "'.code2group($_SESSION['user_data']["adm"]["cgroup"]).'", "cfm": "'.$_SESSION['user_data']["adm"]["cfm"].'"});'; break;
							default: echo 'open_unconfirmed_form();'; break;
						}
					}
					if (isset($_GET['status'])) echo "disp_status(".$_GET['status'].(isset($_GET['reason'])?", '".$_GET['reason']."'":"").");";
				?>
				setTimeout(function() { $(window).trigger("resize"); }, 500);
			});
			function refresh_statement() {
				document.querySelector("main div.container div.form-action").innerHTML = '<center><div class="info"><br>ตรวจสอบสถานะการยืนยัน<br><br><button class="blue" onClick="location.reload()">โหลด</button></div></center>';
			}
			function disp_status(status, reason="") {
				history.replaceState(null,null,location.pathname);
				var prior, msg; switch (status) {
					case 0: prior = 0, msg = reason+"Your data has been record."; break;
					case 1: prior = 3, msg = "Unable to upload evidence. Please try again."; break;
					case 2: prior = 3, msg = "Unable to connect to database. Please try again."; break;
					case 3: prior = 1, msg = "You've already made a record at "+reason; break;
				} app.ui.notify(1, [prior, msg]);
			}
		</script>
	</head>
	<body>
		<?php include("../../resource/hpe/header.php"); ?>
		<main shrink="<?php echo($_COOKIE['sui_open-nt'])??"false"; ?>">
			<div class="container">
				<div class="bc">
					<h2>ประกาศแจ้งนักเรียนชั้นมัธยมศึกษาปีที่ 4 ปีการศึกษา 2564</h2>
					<p>&emsp;&emsp;ขอความร่วมมือนักเรียนชั้นมัธยมศึกษาปีที่ 3 เดิม (ที่รายงานตัวเข้าศึกษาต่อชั้นมัธยมศึกษาปีที่ 4 ในวันที่ 24 มีนาคม 2564) และนักเรียนที่ได้รับการคัดเลือกเข้าศึกษาชั้นมัธยมศึกษาปีที่ 4 ตามประกาศโรงเรียนบดินทรเดชา (สิงห์ สิงหเสนี) ลงวันที่ 24 พฤษภาคม 2564 ยืนยันการเข้าศึกษา ภายในวันที่ 25 พฤษภาคม 2564 เวลา 16.30 น.</p>
				</div>
				<div class="form-action">
					
				</div>
			</div>
		</main>
		<?php include("../../resource/hpe/material.php"); ?>
		<footer>
			<?php include("../../resource/hpe/footer.php"); ?>
		</footer>
	</body>
</html>