<?php if(!isset($my_url))$my_url=($_SERVER['REQUEST_URI']=="/")?"":"?return_url=".urlencode(ltrim($_SERVER['REQUEST_URI'],"/")); ?><header><section><div class="head-item clickable click-fx menu"><a href="javascript:app.ui.toggle.navtab()"opened="<?php echo($_COOKIE['sui_open-nt'])??"false"; ?>"><span class="bar"></span> <span class="bar"></span> <span class="bar"></span></a><aside class="navigator_tab"><ul><a href="/reg/student/"><li>เข้าสู่ระบบนักเรียน</li></a><?php if(isset($_SESSION['user_auth'])){echo '<a href="/reg/student/admission/"><li>• ยืนยันการเข้าศึกษา</li></a>';} ?></ul><ul><a href="/reg/teacher/"><li>เข้าสู่ระบบครู</li></a><?php if(isset($_SESSION['user_ac'])){echo '<a href="/reg/teacher/admission-upload/view.php"><li>• ดูไฟล์หลักฐาน</li></a>';} ?></ul><ul><a class="blue" href="mailto:TianTcl@bodin.ac.th"><li>แจ้งปัญหา/สอบถามการใช้งาน</li></a></ul><?php if(preg_match("/^\/reg\/(student|teacher)\//",$_SERVER['PHP_SELF']))echo '<ul class="so"><a class="red" href="'.(preg_match("/^\/reg\/teacher\//",$_SERVER['PHP_SELF'])?"/reg/teacher/auth.php$my_url":"javascript:app.sys.auth.check()").'"><li>ออกจากระบบ</li></a></ul>'; ?></aside></div><div class="head-item clickable contain-img logo"><a href="/reg/"><img src="/reg/resource/images/cover-2.png"></a></div><div class="head-item schname text"style="display:none"><span>โรงเรียนบดินทรเดชา</span> <span>(สิงห์ สิงหเสนี)</span></div></section><section><div class="head-item lang"hidden></div><div class="head-item clickable click-fx clrt contain-img"><a href="javascript:app.ui.change.theme('dark')"><img src="/reg/resource/images/lang_dark.png"style="transform:scale(.75)"title="Toggle dark mode"></a></div><?php if(preg_match("/^\/reg\/(student|teacher)\//",$_SERVER['PHP_SELF']))echo'<div class="head-item text clickable auth"><a href="'.(preg_match("/^\/reg\/teacher\//",$_SERVER['PHP_SELF'])?"/reg/teacher/auth.php$my_url":"javascript:app.sys.auth.check()").'"><span>ออกจากระบบ</span></a></div>'; ?></section></header>