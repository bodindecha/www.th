const cnf = {
	right: function(chose) {
		document.querySelector('.form-action [name="right"][value="'+chose+'"]').checked = true;
		if (chose=="N") {
			$("div.form-action span.file").html('<input name="slip" type="file" accept=".png,.jpg,.jpeg,.pdf" required data-text="อัปโหลดหลักฐาน">');
			$("div.form-action:not(.incf)").addClass("incf");
			$('div.form-action a.green[role="button"]').css("box-shadow", "none");
			$('div.form-action a.red[role="button"]').css("box-shadow", "0px 0px 5px 0.625px var(--clr-bs-blue)");
		}
		else if (chose=="Y") {
			$("div.form-action span.file input").remove();
			$("div.form-action.incf").removeClass("incf");
			$('div.form-action a.green[role="button"]').css("box-shadow", "0px 0px 5px 0.3125px var(--clr-bs-blue)");
			$('div.form-action a.red[role="button"]').css("box-shadow", "none");
		}
	}, validate: function() {
		if (document.querySelector('div.form-action input[type="radio"]:checked')==null) app.ui.notify(1, [2, "You must choose an option.\nกรุณาเลือกการใช้สิทธิ์"]);
	}
}