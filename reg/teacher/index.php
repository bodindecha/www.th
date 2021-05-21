<?php
	include("../resource/hpe/init_ps.php");
	$header_title = "Teachers";
	$header_desc = "Dashboard | Home";
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php include("../resource/hpe/heading.php"); include("../resource/hpe/init_ss.php"); ?>
		<style type="text/css">
			html body main div.container {
				transform: translate(50px, 50px);
				width: 250px;
			}
			html body main div.container ul { max-width: 200px; }
			html body main div.container ul li {
				max-width: 150px;
				cursor: pointer;
			}
			html body main div.container ul li:hover { text-decoration: underline; }
			html body main div.container ul li:active { color: #55A; }
		</style>
		<script type="text/javascript">
			
		</script>
	</head>
	<body>
		<?php include("../resource/hpe/header.php"); ?>
		<main shrink="<?php echo($_COOKIE['sui_open-nt'])??"false"; ?>">
			<div class="container">
				<b>เมนูหลัก</b>
				<ul>
					<li onClick="app.io.warpto('reg/teacher/admission-upload/view.php')">ดูไฟล์หลักฐาน</li>
				</ul>
			</div>
		</main>
		<?php include("../resource/hpe/material.php"); ?>
		<footer>
			<?php include("../resource/hpe/footer.php"); ?>
		</footer>
	</body>
</html>