<style type="text/css" class="main">
	<?php $gapis_fsu = "//fonts.googleapis.com/css2?family="; ?>
	@import url('<?php echo$gapis_fsu;?>Akaya+Telivigala&display=swap');
	@import url('<?php echo$gapis_fsu;?>Balsamiq+Sans&display=swap');
	@import url('<?php echo$gapis_fsu;?>Bitter&display=swap');
	@import url('<?php echo$gapis_fsu;?>Caladea:wght@700&display=swap');
    @import url('<?php echo$gapis_fsu;?>Cormorant+Upright:wght@700&display=swap');
	@import url('<?php echo$gapis_fsu;?>Dancing+Script:wght@400;600&display=swap');
    @import url('<?php echo$gapis_fsu;?>Dosis:wght@500&display=swap');
	@import url('<?php echo$gapis_fsu;?>Itim&display=swap');
    @import url('<?php echo$gapis_fsu;?>Kanit:wght@200&display=swap');
	@import url('<?php echo$gapis_fsu;?>Modak&display=swap');
	@import url('<?php echo$gapis_fsu;?>Oswald:wght@700&display=swap');
	@import url('<?php echo$gapis_fsu;?>Permanent+Marker&display=swap');
	@import url('<?php echo$gapis_fsu;?>Prompt&display=swap');
	@import url('<?php echo$gapis_fsu;?>Quicksand:wght@600&display=swap');
    @import url('<?php echo$gapis_fsu;?>Ranchers&display=swap');
	@import url('<?php echo$gapis_fsu;?>Roboto:wght@300&display=swap');
    @import url('<?php echo$gapis_fsu;?>Sarabun:wght@300&display=swap');
	@import url('/reg/resource/css/core/appfont.css');
	@import url('//fonts.googleapis.com/icon?family=Material+Icons');
</style>
<script type="text/javascript">
    // Resizing
    $(function(){
		var main_height = $("html body main").height();
		$("html body header section div.head-item.menu a").on("click", function(){setTimeout(function(){$(window).trigger("resize");},500);});
		var $window = $(window).on('resize', function() {
			$("html body main").height((($("html body main > :first-child").height()+$("html body header").height() > main_height))?($("html body main > :first-child").height()+2*$("html body header").height()):main_height);
		}).trigger('resize');
		ppa.check_lang(); ppa.check_theme(); ppa.color_up_codes();
		<?php if($show_auth_form)echo'app.sys.auth.check();'; ?>
		if (/\/reg\/teacher\/auth/.test(location.pathname)) $("html body header section div.head-item.menu aside.navigator_tab ul.so").remove();
		if (self != top) {
			$("html body header").remove();
			$("html body footer").remove();
			$("html body").addClass("nohbar");
		} $('html body header section div.head-item.menu aside.navigator_tab ul a[href="'+location.pathname+'"]').addClass("itp");
    });
	// Scrolling
	$(document).scroll(function() {
		// setHash($(document).scrollTop());
		$("html body aside.up").css("display", (($(document).scrollTop() > $(window).height() - 50)?"block":"none"));
		if ($(document).scrollTop()>0) $("html body header:not(.scrolled)").addClass("scrolled");
		else $("html body header.scrolled").removeClass("scrolled");
	});
	function smooth_scrolling(event) {
		if (this.hash !== "") {
			event.preventDefault();
			var hash = this.hash;
			$('html, body').animate({
				scrollTop: $(hash).offset().top
			}, 800, function(){
				window.location.hash = hash;
			});
		}
	}
	$("a").on('click', function(event) { smooth_scrolling(event); });
</script>