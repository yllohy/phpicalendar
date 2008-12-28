<?php
# drawEventTimes returns starttime and endtime and event length for drawing into a grid
function drawEventTimes ($start, $end) {
	global  $phpiCal_config;
	$sta_h = $sta_min = $end_h = $end_min = "00";
	$gridLength = $phpiCal_config->gridLength;
	if (preg_match ('/([0-9]{2})([0-9]{2})/', $start, $time)){
		$sta_h   = $time[1];
		$sta_min = $time[2];
	}
	$sta_min = sprintf("%02d", floor($sta_min / $gridLength) * $gridLength);
	if ($sta_min == 60) {
		$sta_h = sprintf("%02d", ($sta_h + 1));
		$sta_min = "00";
	}
	
	if (preg_match ('/([0-9]{2})([0-9]{2})/', $end, $time)){
		$end_h   = $time[1];
		$end_min = $time[2];
	}
	$end_min = sprintf("%02d", floor($end_min / $gridLength) * $gridLength);
	if ($end_min == 60) {
		$end_h = sprintf("%02d", ($end_h + 1));
		$end_min = "00";
	}
	
	if (($sta_h . $sta_min) == ($end_h . $end_min))  {
		$end_min += $gridLength;
		if ($end_min == 60) {
			$end_h = sprintf("%02d", ($end_h + 1));
			$end_min = "00";
		}
	}	
	$draw_len = ($end_h * 60 + $end_min) - ($sta_h * 60 + $sta_min);
	return array ("draw_start" => ($sta_h . $sta_min), "draw_end" => ($end_h . $end_min), "draw_length" => $draw_len);
}

// word wrap function that returns specified number of lines
// when lines is 0, it returns the entire string as wordwrap() does it
function word_wrap($str, $length, $lines=0) {
	if ($lines > 0) {
		$len = $length * $lines;
		//if ($len < strlen($str)) {
		// $str = substr($str,0,$len).'...';
		//}
		$rstr=bite_str($str,0,$len+1);
	}
	return $rstr;
}

// String intercept By Bleakwind
// utf-8:$byte=3 | gb2312:$byte=2 | big5:$byte=2
function bite_str($string, $start, $len, $byte=3){
	$str = "";
	$count = 0;
	$str_len = strlen($string);
	for ($i=0; $i<$str_len; $i++) {
		if (($count+1-$start)>$len) {
			$str .= "...";
			break;
		} elseif ((ord(substr($string,$i,1)) <= 128) && ($count < $start)){
			$count++;
		} elseif ((ord(substr($string,$i,1)) > 128) && ($count < $start)){
			$count = $count+2;
			$i = $i+$byte-1;
		} elseif ((ord(substr($string,$i,1)) <= 128) && ($count >= $start)){
			$str .= substr($string,$i,1);
			$count++;
		} elseif ((ord(substr($string,$i,1)) > 128) && ($count >= $start)){
			$str .= substr($string,$i,$byte);
			$count = $count+2;
			$i = $i+$byte-1;
		}
	}
	return $str;
}
?>