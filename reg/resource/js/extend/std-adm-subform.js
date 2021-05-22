const cnf = {
	right: function(chose) {
		document.querySelector('.form-action [name="right"][value="'+chose+'"]').checked = true;
		if (chose=="N") {
			$("div.form-action span.file").html('<input name="slip" type="file" accept=".png,.jpg,.jpeg,.pdf" required data-text="อัปโหลดหลักฐาน" onInput="cnf.tf(this)"><i class="material-icons" style="width:0px;">done</i>');
			$("div.form-action:not(.incf)").addClass("incf");
			$("div.form-action select").hide();
			$('div.form-action a.green[role="button"]').css("box-shadow", "none");
			$('div.form-action a.green.t[role="button"]').removeClass("t");
			$('div.form-action a.red[role="button"]').css("box-shadow", "0px 0px 5px 0.625px var(--clr-bs-blue)");
			$('div.form-action a.red[role="button"]').addClass("t");
			cnf.sttl(750);
		}
		else if (chose=="Y") {
			$("div.form-action span.file").html("");
			$("div.form-action.incf").removeClass("incf");
			$("div.form-action select").show();
			$('div.form-action a.green[role="button"]').css("box-shadow", "0px 0px 5px 0.3125px var(--clr-bs-blue)");
			$('div.form-action a.green[role="button"]').addClass("t");
			$('div.form-action a.red[role="button"]').css("box-shadow", "none");
			$('div.form-action a.red.t[role="button"]').removeClass("t");
		}
	}, validate: function() {
		if (document.querySelector('div.form-action input[type="radio"]:checked')==null) {
			app.ui.notify(1, [2, "You must choose an option.\nกรุณาเลือกการใช้สิทธิ์"]);
			return false;
		} else if (document.querySelector('div.form-action input[name="slip"]').files.length != 1) {
			app.ui.notify(1, [2, "You must select a evidence file.\nกรุณาเลือกไฟล์หลักฐาน"]);
			return false;
		} else if (cnf.tf(true)) {
			var want = document.querySelector('div.form-action input[type="radio"]:checked').value=="Y";
			var name = $('div.form-action u.name').text(), id = $('div.form-action u.id').text(),
				right = want ? "ยืนยัน" : "สละ",
				group = cnf.group2code(document.querySelector('div.form-action [name="group"]').value);
			return confirm("ข้าพเจ้า "+name+" รหัสประจำตัวนักเรียน (นักเรียนเดิม) / เลขประจำตัวผู้สอบ (นักเรียนใหม่) "+id+" ขอ"+right+"สิทธิ์การเข้าศึกษาต่อ ชั้นมัธยมศึกษาปีที่ 4 "+(want?"กลุ่มการเรียน "+group:"โรงเรียนบดินทรเดชา (สิงห์ สิงหเสนี)"));
		}
	}, tf : function(r=false) {
		var me = document.querySelector('div.form-action span.file input[type="file"]').files, ckq = $("div.form-action span.file i");
		var cond = me.length == 1;
		if (cond) {
			let filename = (me[0].name).toLowerCase().split(".");
			cond = (["png", "jpg", "jpeg", "pdf"].includes(filename[filename.length-1])) && (me[0].size < 10240000); // 10 MB
			if (!cond) app.ui.notify(1, [2, "Please check if the file is an accepted type and its size is less than 8 MB"]);
		}
		(cond) ? ckq.width(30) : ckq.width(0);
		cnf.sttl(750, {x: (cond?32.5:0), y: 0});
		if (r) return cond;
	}, sttl: function(speed, coord={x:0,y:0}) {
		var tbl = $("div.form-action div.table"); tbl.animate({
				// scrollTop: tbl.children().first().height()-tbl.height()+10+coord.y,
				scrollLeft: tbl.children().first().width()-tbl.width()+10+coord.x
		}, speed);
	}, group2code: function(code) {
		var group; switch(code) {
			case "A": group = "วิทยาศาสตร์ - คณิตศาสตร์"; break;
			case "B": group = "คณิตศาสตร์ - ภาษาอังกฤษ"; break;
			case "C": group = "ภาษา เลือกเรียนภาษาจีน"; break;
			case "D": group = "ภาษา เลือกเรียนภาษาญี่ปุ่น"; break;
			case "E": group = "ภาษา เลือกเรียนภาษาเกาหลี"; break;
			case "F": group = "ภาษา เลือกเรียนภาษาเยอรมัน"; break;
			case "G": group = "ภาษา เลือกเรียนภาษาฝรั่งเศส"; break;
		} return group;
	}
}