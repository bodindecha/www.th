<?php
	function code2group($code) {
		switch($code) {
			case "A": $group = "วิทยาศาสตร์ - คณิตศาสตร์"; break;
			case "B": $group = "คณิตศาสตร์ - ภาษาอังกฤษ"; break;
			case "C": $group = "ภาษา เลือกเรียนภาษาจีน"; break;
			case "D": $group = "ภาษา เลือกเรียนภาษาญี่ปุ่น"; break;
			case "E": $group = "ภาษา เลือกเรียนภาษาเกาหลี"; break;
			case "F": $group = "ภาษา เลือกเรียนภาษาเยอรมัน"; break;
			case "G": $group = "ภาษา เลือกเรียนภาษาฝรั่งเศส"; break;
		} return $group;
	}
?>