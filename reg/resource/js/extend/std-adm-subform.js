const cnf = {
	right: function(chose) {
		document.querySelector('.form-action [name="right"][value="'+chose+'"]').checked = true;
		if (chose=="N") {
			$("div.form-action span.file").html('<input name="slip" type="file" accept=".png,.jpg,.jpeg,.pdf" required data-text="อัปโหลดหลักฐาน" onInput="cnf.tf(this)"><i class="material-icons" style="width:0px;">done</i>');
			$("div.form-action:not(.incf)").addClass("incf");
			$('div.form-action a.green[role="button"]').css("box-shadow", "none");
			$('div.form-action a.green.t[role="button"]').removeClass("t");
			$('div.form-action a.red[role="button"]').css("box-shadow", "0px 0px 5px 0.625px var(--clr-bs-blue)");
			$('div.form-action a.red[role="button"]').addClass("t");
			cnf.sttl(750);
		}
		else if (chose=="Y") {
			$("div.form-action span.file").html("");
			$("div.form-action.incf").removeClass("incf");
			$('div.form-action a.green[role="button"]').css("box-shadow", "0px 0px 5px 0.3125px var(--clr-bs-blue)");
			$('div.form-action a.green[role="button"]').addClass("t");
			$('div.form-action a.red[role="button"]').css("box-shadow", "none");
			$('div.form-action a.red.t[role="button"]').removeClass("t");
		}
	}, validate: function() {
		if (document.querySelector('div.form-action input[type="radio"]:checked')==null) app.ui.notify(1, [2, "You must choose an option.\nกรุณาเลือกการใช้สิทธิ์"]);
	}, tf : function(me) {
		var ckq = $("div.form-action span.file i");
		(me.files.length == 1) ? ckq.width(30) : ckq.width(0) ;
		cnf.sttl(750, {x:32.5,y:0});
	}, sttl: function(speed, coord={x:0,y:0}) {
		var tbl = $("div.form-action div.table"); tbl.animate({
				// scrollTop: tbl.children().first().height()-tbl.height()+10+coord.y,
				scrollLeft: tbl.children().first().width()-tbl.width()+10+coord.x
		}, speed);
	}
}