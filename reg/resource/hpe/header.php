<?php
	if (!isset($my_url)) $my_url = ($_SERVER['REQUEST_URI']=="/")?"":"?return_url=".urlencode(ltrim($_SERVER['REQUEST_URI'], "/"));
?>
<header>
    <section>
		<div class="head-item menu clickable click-fx">
			<a href="javascript:app.ui.toggle.navtab()" opened="<?php echo($_COOKIE['sui_open-nt'])??"false"; ?>">
				<span class="bar"></span>
				<span class="bar"></span>
				<span class="bar"></span>
			</a>
			<aside class="navigator_tab">
				<ul>
					<a href="/reg/student/"><li>เข้าสู่ระบบนักเรียน</li></a>
					<?php
						if (isset($_SESSION['user_auth'])) {
							echo '<a href="/reg/student/admission/"><li>• ยืนยันการเข้าศึกษา</li></a>';
							// echo '<a href="/reg/student/"><li></li></a>';
						}
					?>
					<!--a href="/reg/"><li></li></a-->
				</ul>
				<ul>
					<a href="/reg/teacher/"><li>เข้าสู่ระบบอาจารย์</li></a>
					<?php
						if (isset($_SESSION['user_ac'])) {
							echo '<a href="/reg/teacher/admission-upload/view.php"><li>• ดูไฟล์หลักฐาน</li></a>';
							// echo '<a href="/reg/teacher/"><li></li></a>';
						}
					?>
					<!--a href="/reg/"><li></li></a-->
				</ul>
				<?php
					if (preg_match("/^\/reg\/(student|teacher)\//", $_SERVER['PHP_SELF'])) echo '<ul class="so">
						<a class="red" href="'.(preg_match("/^\/reg\/teacher\//", $_SERVER['PHP_SELF'])?"/reg/teacher/auth.php$my_url":"javascript:app.sys.auth.check()").'"><li>ออกจากระบบ</li></a>
					</ul>';
				?>
			</aside>
		</div>
		<div class="head-item logo clickable contain-img">
			<a href="/reg/"><img src="/reg/resource/images/cover-2.png" /></a>
		</div>
		<div class="head-item text schname" style="display: none;">
			<span>โรงเรียนบดินทรเดชา</span> <span>(สิงห์ สิงหเสนี)</span>
		</div>
	</section>
    <section>
		<div class="head-item lang" hidden></div>
		<div class="head-item clrt clickable contain-img click-fx">
			<a href="javascript:app.ui.change.theme('dark')"><img title="Toggle dark mode" style="transform: scale(0.75)" src="/reg/resource/images/lang_dark.png"></a>
		</div>
		<?php if (preg_match("/^\/reg\/(student|teacher)\//", $_SERVER['PHP_SELF'])) echo'<div class="head-item text clickable auth"><a href="'.(preg_match("/^\/reg\/teacher\//", $_SERVER['PHP_SELF'])?"/reg/teacher/auth.php?return_url=$my_url":"javascript:app.sys.auth.check()").'"><span>ออกจากระบบ</span></a></div>';?>
	</section>
</header>