<?php
	function date_to_word($date){
		$year = substr($date,0,4);
		$month = substr($date,5,2);
		$day = substr($date,8,2);
		switch((int)$month){
			case 1: $month = "January";
				break;
			case 2: $month = "February";
				break;
			case 3: $month = "March";
				break;
			case 4: $month = "April";
				break;
			case 5: $month = "May";
				break;
			case 6: $month = "June";
				break;
			case 7: $month = "July";
				break;
			case 8: $month = "August";
				break;
			case 9: $month = "September";
				break;
			case 10: $month = "October";
				break;
			case 11: $month = "November";
				break;
			case 12: $month = "December";
				break;
		}
		switch((int)substr($day,1,1)){
			case 1: $day = strval((int)$day)."<sup>st</sup>";
				break;
			case 2: $day = strval((int)$day)."<sup>nd</sup>";
				break;
			case 3: $day = strval((int)$day)."<sup>rd</sup>";
				break;
			default: $day = strval((int)$day)."<sup>th</sup>";
		}
		$word = $day." ".$month.", ".$year;
		return $word;
	}
?>