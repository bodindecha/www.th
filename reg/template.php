<?php
	include("../resource/hpe/init_ps.php");
	$header_title = "";
	$header_desc = "";
	$header_cover = "";
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php include("../resource/hpe/heading.php"); include("../resource/hpe/init_ss.php"); ?>
		<style type="text/css">
			
		</style>
		<script type="text/javascript">
			
		</script>
	</head>
	<body>
		<?php include("../resource/hpe/header.php"); ?>
		<main shrink="<?php echo($_COOKIE['sui_open-nt'])??"false"; ?>">
			
		</main>
		<?php include("../resource/hpe/material.php"); ?>
		<footer>
			<?php include("../resource/hpe/footer.php"); ?>
		</footer>
	</body>
</html>