<section class="modal">
	<label onClick="app.ui.modal.close()">⨯</label>
	<span class="ctxt"></span>
	<div>
		<span><a role="button" href="javascript:app.ui.modal.close()" data-text="Dismiss"></a></span>
		<span class="slider"><a role="button" class="filled"></a></span>
	</div>
</section>
<section class="lightbox">
	<span class="fadebg" data-dark="false"></span>
	<div class="displayer slider"></div>
</section>
<nav class="cm">
    <ul class="nav">
        <li class="back" onClick="window.history.back()"><img src="/reg/resource/images/cm_nav-back.png"><span>Back</span></li>
        <li class="reload" onClick="location.reload()"><img src="/reg/resource/images/cm_nav-reload.png"><span>Reload page</span></li>
    </ul>
    <div class="divider"></div>
    <ul class="share">
        <li class="copyurl" onClick="app.io.copy.location()"><img src="/reg/resource/images/cm_share-url.png"><span>Copy page URL</span></li>
    </ul>
    <div class="divider"></div>
    <ul class="action">
        <li class="print" onClick="window.print()"><img src="/reg/resource/images/cm_action-print.png"><span>Print page</span></li>
    </ul>
</nav>
<nav class="rfr txtoe"></nav>
<aside class="fm hscroll"></aside>
<aside class="up">
    <a href="javascript:app.io.scrollToTop()"><div><img src="/reg/resource/images/cm_nav-back.png"></div></a>
</aside>