<?php
	include("../../resource/hpe/init_ps.php");
	$header_title = "Student";
	$header_desc = "Admission | New student confirmation";
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
			function open_selection_form() {
				var s = new XMLHttpRequest;
				s.open("GET","/reg/student/admission/choose.php", true);
				s.responseType = "text";
				s.onload = function() {
					var dat = JSON.parse(this.responseText);
					setTimeout(function() { app.ui.modal.open(dat.cnftxt, {response: "confirm", option: ["Cancel", "OK"], values: [false, true], cfx: function(res) {
						var ans = !["0", "false"].includes(res);
						if (ans) {
							$.post("/reg/student/admission/choose.php", {data: "confirmed"}, function(res, hsc){
								var dat = JSON.parse(res);
								if (dat.success) {
									open_complete_form({time: dat.time, ip: dat.ip});
									app.ui.notify(1, [0, "Data confirmed."]);
								} else disp_status(2);
							});
						}
					} }); }, 250);
					document.querySelector("main div.container div.form-action").innerHTML = '<center><div class="info"><br>โปรดยืนยันข้อมูล<br><br><button class="blue" onClick="open_selection_form()">ตรวจสอบข้อมูล</button></div></center>';
				}; s.send();
			}
			function open_complete_form(eti={}) {
				var estr = ((!(typeof eti.time === "undefined") || !(typeof eti.ip === "undefined"))?"<br>":"")+(typeof eti.time === "undefined"?"":"ณ วันเวลาที่ "+eti.time+" ")+(typeof eti.ip === "undefined"?"":"ผ่าน IP "+eti.ip);
				document.querySelector("main div.container div.form-action").innerHTML = '<center><div class="message green">คุณได้ดำเนินการเรียบร้อยแล้ว'+estr+'</div></center>';
				app.ui.modal.close();
			}
			$(document).ready(function() {
				<?php
					if (isset($_SESSION['user_auth'])) {
						switch ($_SESSION['user_data']["adm"]["step"]) {
							case 1: echo 'open_confirmation_form();'; break;
							case 2: echo 'open_selection_form();'; break;
							case 3: echo 'open_complete_form({time: "'.$_SESSION['user_data']["adm"]["time"].'", ip: "'.$_SESSION['user_data']["adm"]["ip"].'"});'; break;
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
					case 1: prior = 3, msg = "Unable to upload image. Please try again."; break;
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