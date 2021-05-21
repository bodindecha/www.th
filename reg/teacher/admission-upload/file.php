<?php
	$show_auth_form = false;
	if (isset($_GET['of'])) {
		$path = $_GET['of']; $proceed = true;
		if (file_exists($path.".png")) $type = "png";
		else if (file_exists($path.".jpg")) $type = "jpg";
		else if (file_exists($path.".jpeg")) $type = "jpeg";
		else if (file_exists($path.".pdf")) $type = "pdf";
		else $proceed = false;
		if ($proceed) {
			$path .= ".$type";
			$size = getimagesize($path);
			if ($type=="pdf") {
				header("Content-Type: application/pdf");
				header("Content-Length: ".filesize($path));
				header("Expires: ".strval(gmdate("D, d m y H:i:s", time()+5)));
				readfile($path);
			} else {
				echo '<!doctype html>
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>';
			include("../../resource/hpe/heading.php"); include("../../resource/hpe/init_ss.php");
			echo '<style type="text/css">
				html body main {
					background-color: rgba(198, 218, 252, 0.25);
					overflow: hidden;
				}
				html body main div.container {
					position: relative; top: 50%; left: 50%; transform: translate(-50%, -50%);
					width: '.$size[0].'px; max-width: 100%; height: '.$size[1].'px; max-height: 100%;
				}
				html body main div.container div.wrapper {
					width: 100%; height: 100%;
					background-image: linear-gradient(45deg,#EFEFEF 25%,rgba(239,239,239,0) 25%,rgba(239,239,239,0) 75%,#EFEFEF 75%,#EFEFEF),linear-gradient(45deg,#EFEFEF 25%,rgba(239,239,239,0) 25%,rgba(239,239,239,0) 75%,#EFEFEF 75%,#EFEFEF); background-position: 0 0,10px 10px; background-size: 21px 21px;
					transition: var(--time-tst-fast);
				}
				html body main div.container div.wrapper > * {
					position: absolute; top: 0px;
					width: 100%; height: 100%;
				}
				html body main div.container div.wrapper div { opacity: 0.5; filter: opacity(0.5); }
				html body main div.container div.wrapper div img { opacity: 0; filter: opacity(0); }
				html body main div.container div.wrapper span {
					background-image: url("/reg/teacher/admission-upload/'.$path.'"); background-size: contain;
					/* backdrop-filter: blur(7.5px); */ background-repeat: no-repeat; background-position: center;
				}
				html body main div.controller, html body main div.controller div.sgt {
					position: absolute; top: 0px;
					width: 100%; height: 100%;
				}
				html body main div.controller div.bar {
					--h: 50px; --pd-s: 50px;
					padding: 175px var(--pd-s) 25px;
					position: absolute; bottom: 0px; z-index: 1;
					width: calc(100% - var(--pd-s) * 2); height: var(--h);
					transition: var(--time-tst-fast);
				}
				html body main div.controller div.bar.force {
					transform: translateY(0px);
					opacity: 1; filter: opacity(1);
					pointer-events: auto;
				}
				html body main div.controller div.bar ul {
					margin: 0px auto; padding: 0px 5px;
					width: 480px; height: calc(100% - 5px);
					background-color: var(--clr-bs-light);
					border-radius: calc(var(--h) / 2); border: 2.5px solid var(--clr-bs-dark);
					display: flex; justify-content: space-around;
					overflow: visible; transition: var(--time-tst-medium);
				}
				html body main div.controller div.bar ul li {
					height: calc(var(--h) - 5px);
					white-space: nowrap;
					display: flex; list-style-type: none;
				}
				html body main div.controller div.bar ul > * { transform: translateY(-0.5px); }
				html body main div.controller div.bar ul li > * {
					min-width: 30px; height: 100%;
					font-size: 24px; line-height: calc(var(--h) - 5px);
					text-align: center;
				}
				html body main div.controller div.bar ul li a {
					--mg-f: 7.5px;
					margin: var(--mg-f) 0px;
					height: calc(var(--h) - 5px - var(--mg-f) * 2);
					font-size: 24px; line-height: calc(var(--h) - 5px - var(--mg-f) * 2);
					border-radius: calc((var(--h) - 5px - var(--mg-f) * 2) / 2);
					transition: var(--time-tst-xfast);
				}
				html body main div.controller div.bar ul li a:link, html body main div.controller div.bar ul li a:hover { color: var(--clr-bs-gray); }
				html body main div.controller div.bar ul li a:active, html body main div.controller div.bar ul li a:focus { color: var(--clr-bs-gray-dark); }
				html body main div.controller div.bar ul li a:hover { background-color: rgba(0, 0, 0, 0.125); }
				html body main div.controller div.bar ul li a i { position: relative; top: 50%; left: 50%; transform: translate(-62.5%, -50%); }
				html body main div.controller div.bar ul li a span {
					position: absolute; top: var(--mg-f); transform: translateX(calc(-100% + 2.5px));
					min-width: inherit; height: calc(100% - var(--mg-f) * 2);
					border-radius: calc((var(--h) - 5px - var(--mg-f) * 2) / 2);
					display: inline-block;
				}
				html body main div.controller div.bar ul li label { padding: 0px 6.25px; }
				html body main div.controller div.bar ul li label select {
					border-radius: 3.75px; border: 1px solid var(--clr-bs-gray);
					background-color: var(--clr-gg-grey-100);
					font-size: 20px;
				}
				html body main div.controller div.bar ul li input[type="checkbox"] { transform: scale(0.75); }
				html body main div.controller div.bar ul > span {
					position: relative; top: 50%; transform: translateY(-50%);
					width: 1.25px; height: 75%;
					background-color: var(--clr-gg-grey-500);
					display: block;
				}
				html body main *[data-title]:before {
					padding: 7.5px;
					position: absolute; top: -33.5px; left: 50%; transform: translateX(-50%);
					height: 10px;
					background-color: var(--clr-bs-dark); border-radius: 5px; border: 1px solid var(--clr-bs-light);
					box-shadow: 0px 0px 2.5px 2.5px rgba(127, 127, 127, 0.375);
					color: var(--clr-bs-light); white-space: nowrap;
					font-size: 12.5px; line-height: 10px; font-family: "Balsamiq Sans";
					display: none; content: attr(data-title); pointer-events: none;
				}
				html body main *[data-title]:after {
					position: absolute; top: -12.5px; left: 50%; transform: translateX(-50%) rotate(45deg);
					width: 10px; height: 10px;
					background-color: var(--clr-bs-dark);
					border-right: 1px solid var(--clr-bs-light); border-bottom: 1px solid var(--clr-bs-light);
					box-shadow: 2.25px 2.25px 0.25px 0.75px rgba(127, 127, 127, 0.09375);
					display: none; content: ""; pointer-events: none;
				}
				html body main *[data-title]:hover:before, html body main *[data-title]:active:before, html body main *[data-title]:hover:after, html body main *[data-title]:active:after { display: block; }
				@media only screen and (min-width: 768.003px) {
					html body main div.controller div.bar {
						transform: translateY(25px);
						opacity: 0; filter: opacity(0);
					}
					html body main div.controller div.bar:hover {
						transform: translateY(0px);
						opacity: 1; filter: opacity(1);
					}
				}
				@media only screen and (max-width: 768px) {
					html body main div.controller div.bar {
						--pd-s: 25px; --h: 30px;
						padding: 12.5px var(--pd-s);
					}
					html body main div.controller div.bar {
						bottom: 75px;
						opacity: 0.25; filter: opacity(0.25);
						pointer-events: none;
					}
					html body main div.controller div.bar.on { opacity: 1; filter: opacity(1); pointer-events: initial; }
					html body main div.controller div.bar ul { padding: 0px 1.25px; width: 300px; }
					html body main div.controller div.bar ul li > * { min-width: 20px; font-size: 12.5px; }
					html body main div.controller div.bar ul li a { --mg-f: 2.5px; font-size: 12px; width: 20px; }
					html body main div.controller div.bar ul li a i { transform: translate(-50%, -50%) scale(0.75); }
					html body main div.controller div.bar ul li label { padding: 0px 2.5px; }
					html body main div.controller div.bar ul li label select { font-size: 10px; }
					html body main *[data-title]:before { transform: translateX(calc(-50% - 7.5px)); }
					html body main *[data-title]:after { transform: translateX(calc(-50% - 7.5px)) rotate(45deg); }
				}
				@media only print { html body main div.controller { display: none; } }
			</style>
			<script type="text/javascript">
				const zoom = {
					level: [12.5,25,50,65,75,80,90,100,110,120,125,150,175,200,400,500], now: 7,
					inc: function() { if (zoom.now+1<zoom.level.length) { zoom.now++; zoom.init(); } },
					dec: function() { if (zoom.now-1>=0) { zoom.now--; zoom.init(); } },
					init: function(sel=true) {
						let percent = zoom.level[zoom.now];
						$("html body main div.container div.wrapper").css("transform", "scale("+(percent/100).toString()+") rotate(var(--rot))");
						if (sel) $(\'[name="zoom"] option[value="\'+percent.toString()+\'"]\').prop("selected", true);
					}
				}, rot = {
					now: 0,
					cw: function() { /* rot.now = (rot.now+90==360) ? 0 : rot.now+90; */ rot.now+=90; rot.init(); },
					cc: function() { /* rot.now = (rot.now-90==-360) ? 0 : rot.now-90; */ rot.now-=90; rot.init(); },
					init: function() { $("html body main div.container div.wrapper").css("--rot", rot.now.toString()+"deg"); }
				}; var prevkey = []
				$(document).ready(function() {
					zoom.level.forEach((percent)=>{
						let this_opt = $(\'<option value="\'+percent.toString()+\'">\'+percent.toString()+\' %</option>\');
						$(\'[name="zoom"]\').append(this_opt);
					}); zoom.init(); rot.init();
					$(\'[name="zoom"]\').on("change", function() {
						zoom.now = zoom.level.indexOf(parseFloat(this.value));
						zoom.init(false);
					});
					$(\'[name="asc"]\').on("change", function() { $("html body main div.controller div.bar").toggleClass("force"); });
					$("html body main div.controller div.sgt").on("click", function() { $("html body main div.controller div.bar").toggleClass("on"); });
					setTimeout(function() {
						// Grade(document.querySelectorAll("html body main div.container div.wrapper div"));
						setTimeout(function() { $("html body main div.container div.wrapper div img").remove(); }, 250);
					}, 250);
					$(document).on("keypress keydown", function(e) {
						let prik = e.which || e.keyCode, ckeyp = String.fromCharCode(prik) || e.key || e.code, isCrtling = e.ctrlKey, isShifting = e.shiftKey, isAlting = e.altKey;
						prevkey.push(prik); if (prevkey.length > 3) prevkey.shift();
						if (prik==38) { e.preventDefault(); zoom.inc(); }
						else if (prik==40) { e.preventDefault(); zoom.dec(); }
						else if (prik==39) { e.preventDefault(); rot.cw(); }
						else if (prik==37) { e.preventDefault(); rot.cc(); }
						else if (ckeyp=="c") { document.querySelector(\'[name="asc"]\').checked = !document.querySelector(\'[name="asc"]\').checked; $(\'[name="asc"]\').trigger("change"); }
						// else app.ui.notify(1,[1,prik.toString()]);
					});
				});
			</script>
			<!--script type="text/javascript" src="/reg/resource/js/lib/grade.min.js"></script-->
		</head>
		<body class="nohbar">
			<main>
				<div class="container">
					<div class="wrapper">
						<div><img src="/reg/teacher/admission-upload/'.$path.'"></div>
						<span></span>
					</div>
				</div>
				<div class="controller">
					<div class="sgt"></div>
					<div class="bar"><ul>
						<li>
							<a href="javascript:rot.cc()"><i class="material-icons">rotate_left</i><span data-title="Rotate counter-clockwise (←)"></span></a>
							<label>Rotate</label>
							<a href="javascript:rot.cw()"><i class="material-icons">rotate_right</i><span data-title="Rotate clockwise (→)"></span></a>
						</li>
						<span></span>
						<li>
							<a href="javascript:zoom.dec()"><i class="material-icons">zoom_out</i><span data-title="Zoom Out (↓)"></span></a>
							<label>Zoom <select name="zoom"></select></label>
							<a href="javascript:zoom.inc()"><i class="material-icons">zoom_in</i><span data-title="Zoom In (↑)"></span></a>
						</li>
						<span></span>
						<li data-title="always show controller">
							<input name="asc" type="checkbox" id="prv-asc"><label for="prv-asc">ASC</label>
						</li>
					</ul></div>
				</div>
			</main>';
			include("../../resource/hpe/material.php");
			echo '<footer>';
				include("../../resource/hpe/footer.php");
			echo '</footer>
		</body>
	</html>';
			}
		} else {
			echo 'File not found';
		}
	}
?>