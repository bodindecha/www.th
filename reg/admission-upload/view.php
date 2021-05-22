<?php
	include("../../resource/hpe/init_ps.php");
	$header_title = "Teachers";
	$header_desc = "View uploaded files";
	
	include("../../resource/appwork/db_connect.php");
	$cnfdata = $db -> query("SELECT stdcode,cfm,cgroup FROM chdata ORDER BY time");
	$stddata = $db -> query("SELECT stdcode,natid,cgroup FROM stddata");
	$db -> close();
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php include("../../resource/hpe/heading.php"); include("../../resource/hpe/init_ss.php"); ?>
		<style type="text/css">
			html body main div.container {
				padding: 25px;
				width: calc(100% - 50px); height: calc(100% - 50px);
			}
			html body main div.container div.wrapper {
				position: relative; float: left;
				height: 100%;
			}
			html body main div.container div.wrapper:nth-child(1) { width: 420px; }
			html body main div.container div.wrapper:nth-child(2) { width: calc(100% - 420px); }
			html body main div.container div.wrapper span {
				position: relative; top: 50%; left: 50%; transform: translate(-50%, -50%);
				width: 97.5%; height: 97.5%;
				border: 0.25px solid #777; border-radius: 5px; box-shadow: 0px 4px 15px 2px rgb(0 0 0 / 35%);
				display: block; overflow: hidden;
			}
			html body main div.container div.wrapper:nth-child(1) span { overflow: auto; }
			html body main div.container div.wrapper:nth-child(1) span table.record {
				min-width: 100%;
				font-size: 15px; font-family: 'Sarabun', sans-serif;
				box-shadow: none; border-spacing: 0px;
			}
			table.record tbody:nth-child(1) tr { background-color: rgba(0, 0, 0, 0.25) !important; }
			table.record tbody:nth-child(1) tr th:hover { background-image: linear-gradient(to bottom, rgba(0 0 0 / 0.3125), rgba(0 0 0 / 0.0625)); }
			table.record tbody:nth-child(1) tr th:active { background-image: linear-gradient(to top, rgba(0 0 0 / 0.3125), rgba(0 0 0 / 0.0625)); }
			table.record tbody:nth-child(2n+2) tr { background-color: rgba(0, 0, 0, 0.1875); }
			table.record tbody:nth-child(2n+2) tr th { border-top: 0.5px solid #999; }
			table.record tbody:not(:nth-child(2n+2)) tr:nth-child(2n+2) { background-color: rgba(0, 0, 0, 0.09375); }
			table.record tbody:not(:nth-child(2n+2)) tr:nth-child(2n+1) { background-color: rgba(0, 0, 0, 0.0234375); }
			table.record tbody:not(:nth-child(2n+2)) tr:hover { background-color: rgba(104, 126, 231, 0.25); }
			table.record tbody:nth-child(2n+1) tr > *:not(:first-child) { border-left: 1px dotted #999; }
			table.record tbody:last-child tr td { border-bottom: 0.5px solid #999; }
			table.record tbody tr > * {
				padding: 5px 10px;
				white-space: nowrap;
			}
			table.record tbody tr th { position: sticky; }
			table.record tbody tr th:nth-child(1) { text-align: left; }
			table.record tbody tr td:nth-child(2), table.record tbody tr td:nth-child(3) { text-align: center; }
			table.record tbody tr td:nth-child(5) { text-align: right; }
			table.record tbody tr td:nth-child(5) a:link, table.record tbody tr td:nth-child(5) a:visited { text-decoration: none; color: var(--clr-bd-light-blue); }
			table.record tbody tr td:nth-child(5) a:hover { text-decoration: underline; }
			table.record tbody tr td:nth-child(5) a:active { color: var(--clr-bd-low-light-blue); }
			html body main div.container div.wrapper:nth-child(2) span iframe {
				position: relative; top: 0px;
				width: 100%; height: 100%;
				border: none;
			}
			@media only screen and (max-width: 768px) {
				html body main div.container div.wrapper { width: 100% !important; }
				html body main div.container div.wrapper:nth-child(1) { height: 250px; }
				html body main div.container div.wrapper:nth-child(2) {
					margin-top: 12.5px;
					height: calc(100% - 250px - 12.5px);
				}
			}
		</style>
		<script type="text/javascript">
			$(document).ready(function() {
				setTimeout(function() { sttl(500); }, 750);
				<?php if (!in_array($_SESSION['user_perm'], array(50))) echo 'alert("You are unauthorized"); location="/reg/teacher/";'; ?>
			});
			function sttl(speed) {
				let rcdtbl = $("html body main div.container div.wrapper:nth-child(1) span"); rcdtbl.animate({
					scrollTop: rcdtbl.children().first().height()-rcdtbl.height()+10,
					// scrollLeft: rcdtbl.children().first().width()-rcdtbl.width()+10
				}, speed);
			}
			function ro(col) {
				w3.sortHTML("table.record", "tbody:nth-child(3) tr", "td:nth-child("+col.toString()+")");
				w3.sortHTML("table.record", "tbody:nth-child(5) tr", "td:nth-child("+col.toString()+")");
			}
			function ve(which, who) {
				var me = $("table.record tbody:nth-child("+which.toString()+") tr:nth-child("+who.toString()+") td:nth-child(1)");
				document.querySelector("html body main div.container div.wrapper:nth-child(2) iframe").src = "/reg/teacher/admission-upload/file.php?of="+me.text();
			}
		</script>
		<script type="text/javascript" src="/reg/resource/js/lib/w3.min.js"></script>
	</head>
	<body>
		<?php include("../../resource/hpe/header.php"); ?>
		<main shrink="<?php echo($_COOKIE['sui_open-nt'])??"false"; ?>">
			<div class="container">
			<div class="wrapper"><span>
				<table class="record"><tbody>
					<tr>
						<th onClick="ro(1)">เลขประจำตัว</th>
						<th onClick="ro(2)">ประเภท</th>
						<th onClick="ro(3)">เลือก</th>
						<th onClick="ro(4)">สายการเรียน</th>
						<th>อื่นๆ</th>
					</tr></tbody><tbody><tr><th colspan="5" style="text-align:center!important">ยืนยันข้อมูลการใช้สิทธิ์แล้ว</th></tr></tbody><tbody>
					<?php
						$vua = array(); include("../../resource/appwork/appfunc.php");
						if ($cnfdata -> num_rows >= 1) {
							$i = 1;
							while ($er = $cnfdata -> fetch_assoc()) {
								$stdtype = (strlen($er['stdcode'])<6) ? "นักเรียนเก่า" : "สอบเข้าใหม่";
								$stdchoice = ($er['cfm']=="Y") ? "ยืนยันสิทธิ์" : "สละสิทธิ์";
								$stdgroup = ($er['cfm']=="Y") ? code2group(strtoupper($er['cgroup'])) : "";
								$stdopt = ($er['cfm']=="N") ? '<a href="javascript:ve(3, '.strval($i).')">ดูไฟล์หลักฐาน</a>' : "";
								echo "<tr><td>".$er['stdcode']."</td><td>$stdtype</td><td>$stdchoice</td><td>$stdgroup</td><td>$stdopt</td></tr>";
								$i++; array_push($vua, $er['stdcode']);
							}
						}
					?>
					</tbody><tbody><tr><th colspan="5" style="text-align:center!important">ยังไม่ยืนยันข้อมูลการใช้สิทธิ์</th></tr></tbody><tbody>
					<?php
						if ($stddata -> num_rows >= 1) {
							while ($er = $stddata -> fetch_assoc()) {
								if (in_array($er['natid'], $vua)) $vua = array_diff($vua, [$er['natid']]);
								else if (in_array($er['stdcode'], $vua)) {
									$vua = array_diff($vua, [$er['stdcode']]);
									array_push($vua, $er['natid']);
								} else {
									$stdtype = (strlen($er['stdcode'])<6) ? "นักเรียนเก่า" : "สอบเข้าใหม่";
									$stdgroup = code2group(strtoupper($er['cgroup']));
									echo "<tr><td>".$er['stdcode']."</td><td>$stdtype</td><td></td><td>$stdgroup</td><td></td></tr>";
								}
							}
						}
					?>
				</tbody></table>
			</span></div>
			<div class="wrapper">
				<span><iframe></iframe></span>
			</div>
		</div>
		</main>
		<?php include("../../resource/hpe/material.php"); ?>
		<footer>
			<?php include("../../resource/hpe/footer.php"); ?>
		</footer>
	</body>
</html>