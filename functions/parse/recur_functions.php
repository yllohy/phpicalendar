<?php
/* from the std

"BYxxx rule parts modify the recurrence in some manner. BYxxx rule parts for a period of time which is the same or greater than the frequency generally reduce or limit the number of occurrences of the recurrence generated. For example, "FREQ=DAILY;BYMONTH=1" reduces the number of recurrence instances from all days (if BYMONTH tag is not present) to all days in January. BYxxx rule parts for a period of time less than the frequency generally increase or expand the number of occurrences of the recurrence. For example, "FREQ=YEARLY;BYMONTH=1,2" increases the number of days within the yearly recurrence set from 1 (if BYMONTH tag is not present) to 2.

If multiple BYxxx rule parts are specified, then after evaluating the specified FREQ and INTERVAL rule parts, the BYxxx rule parts are applied to the current set of evaluated occurrences in the following order: BYMONTH, BYWEEKNO, BYYEARDAY, BYMONTHDAY, BYDAY, BYHOUR, BYMINUTE, BYSECOND and BYSETPOS; then COUNT and UNTIL are evaluated."

We will use two kinds of functions - those that restrict the date to allowed values and those that expand allowed values
*/

function add_recur($times,$freq=''){
	global $recur_data;
	global $count, $mArray_begin, $mArray_end, $except_dates, $start_date, $start_date_unixtime,$end_range_unixtime,$until_unixtime, $day_offset, $current_view;	
	if (!is_array($times)) $times = array($times);
	/*	BYMONTH, BYWEEKNO, BYYEARDAY, BYMONTHDAY, BYDAY, BYHOUR, BYMINUTE, BYSECOND and BYSETPOS	*/
#dump_times($times);
	if ($current_view != 'search'){
		$times = restrict_bymonth($times,$freq); 
	#	$times = restrict_byweekno($times,$freq);
		$times = restrict_byyearday($times,$freq);
		$times = restrict_bymonthday($times,$freq);
		$times = restrict_byday($times,$freq);
		if($start_date_unixtime > $mArray_begin) $times[] = $start_date_unixtime;
		$times = restrict_bysetpos($times,$freq);#echo "restrict_bysetpos";
		$times = array_unique($times);
		sort($times); 
	}
	$until_date = date("Ymd",$end_range_unixtime);
	foreach ($times as $time){ 
		#echo "time:". date("Ymd",$time)." $until_date<br>\n";
		if (!isset($time) || $time == '') continue;
		$date = date("Ymd",$time);
		$time = strtotime("$date 12:00:00");
		# day offset fixes shifts across day boundaries due to time diffs.  
		# These are already fixed for the initial instance, but need to be fixed for recurrences
		if (date("Ymd", $time) != $start_date) $time = $time + $day_offset * (24*60*60);
		if(isset($time) 
			&& $time != ''
			&& !in_array($time, $recur_data) 
			&& !in_array($date, $except_dates) 
			&& $time <= $until_unixtime 
			&& $time >= $start_date_unixtime 
			&& $date <= $until_date
		){ 
			$count--; #echo "\n.$count\n";
			if($time >= $mArray_begin 
				&& $time  <= $mArray_end 
				&& $count >= 0
			) $recur_data[] = $time;
		}
	}
#dump_times($recur_data);
	return;
}
function expand_bymonth($time){
	global $bymonth, $byweekno, $bymonthday, $year, $start_unixtime, $freq_type;
	if(!empty($byweekno)) return $time;
	if(empty($bymonth)) $bymonth = array(date("m", $start_unixtime)); 
	$d = date("d",$start_unixtime);
	if (!empty($bymonthday)) $d = 1;
	foreach ($bymonth as $m){ 
		$time = mktime(12,0,0,$m,$d,$year); #echo "exm:".date("Ymd",$time)."\n";
		$times[] = $time;
	}	
	return $times;	
}
function expand_byweekno($times){
	global $byweekno, $year, $freq_type, $wkst, $wkst3char;
	# byweekno is only used when repeat is yearly
	# when it's set, the input times are irrelevant
	# it also needs a byday.
	if ($freq_type != 'year') return $times;
	if (empty($byweekno)) return $times;
	$total_weeks = date("W",mktime(12,0,0,12,24,$year) ) +1;
	$w1_start = strtotime("this $wkst3char", mktime(12,0,0,1,1,$year) ); 
	foreach($byweekno as $weekno){ 
		if($weekno < 0) $weekno = $weekno + $total_weeks;
		#echo "\n $wkst3char w1st:".date("Ymd", $w1_start)." ".date("Ymd", mktime(12,0,0,1,1,$year))." weekno:$weekno";
		$new_times[] = strtotime("+".(($weekno-1)*7)."days",$w1_start);
	}
	#dump_times($new_times);
	return $new_times;
}

function expand_byyearday($times){
	global $byyearday, $year;
	if (empty($byyearday)) return $times;
	$py = $year-1; 
	$ny = $year+1;
	$new_times = array();
	foreach($times as $time){ 
		foreach($byyearday as $yearday){
			if($yearday > 0){ $day = strtotime("+$yearday days Dec 31, $py");#echo "\n".date("Ymd",$day)." = +$yearday days Dec 31, $py";
			}else $day = strtotime("Jan 1 $ny $yearday days");
			if(date("Y",$day == $year)) $new_times[] = $day;
		}	
	}
#	dump_times($new_times);
	return $new_times;
}

function expand_bymonthday($times){
	global $bymonthday, $year;
	if (empty($bymonthday)) return $times;
	foreach($times as $time){ 
		$month = date('m',$time);
		foreach($bymonthday as $monthday){ 
			if($monthday < 0) $monthday = date("t",$time) + $monthday +1;
			$new_times[] = mktime(12,0,0,$month,$monthday,$year);
			#echo "monthday:$monthday\n";
		}	
	}	
	return $new_times;
}

function expand_byday($time){
	global $freq_type, $byday, $bymonth,$byweekno, $wkst3char, $year, $month, $start_unixtime, $summary;
	if (empty($byday)) return array($time);
	$times = array();
	$the_sunday = dateOfWeek(date("Ymd",$time), $wkst3char);
	#echo "<pre>$summary $freq_type ".print_r($byday,true)."$wkst3char $the_sunday</pre>";
	foreach($byday as $key=>$day) {
		/* set $byday_arr
				[0] => byday string, e.g. 4TH
				[1] => sign/modifier
				[2] => 4 number
				[3] => TH day abbr
		*/
		ereg ('([-\+]{0,1})?([0-9]+)?([A-Z]{2})', $day, $byday_arr);
		$on_day = two2threeCharDays($byday_arr[3]);
		switch($freq_type){
			case 'week':
				#need to find the first day of the appropriate week.
				$next_date_time = strtotime("this $on_day",strtotime($the_sunday)) + (12 * 60 * 60);					
				$times[] = $next_date_time; 
				break;
			case 'month':
				$time = mktime(12,0,0,$month,1,$year);
			case 'year':
				if(empty($byweekno)){
					$week_arr = array(1,2,3,4,5);
					if(isset($byday_arr[2]) && $byday_arr[2] !='') $week_arr = array($byday_arr[2]); 
					$month_start = strtotime(date("Ym00",$time));
					$month_end = strtotime(date("Ymt",$time))+ (36 * 60 * 60);
					if($freq_type == 'year' && empty($bymonth)){
						$month_start = mktime(12,0,0,1,0,$year);
						$month_end   = mktime(12,0,0,1,1,$year+1);
					}
					foreach($week_arr as $week){
						#echo "<pre>$summary ".$byday_arr[1].$week.$on_day." st:".date("Ymd",$month_start)." t:".date("Ymd",$time)."\n";
						if($byday_arr[1] == '-') $next_date_time = strtotime($byday_arr[1].$week.$on_day,$month_end);
						else $next_date_time = strtotime($byday_arr[1].$week.$on_day,$month_start);
						# check that we're still in the same month
						if (date("m",$next_date_time) == date("m",$time) ) $times[] = $next_date_time; 
					}
				}else{
					# byweekno should act like freq_type = week
					$next_date_time = strtotime("this $on_day",strtotime($the_sunday)) + (12 * 60 * 60);					
					$times[] = $next_date_time; 				
				}
				break;
			default:
				$month_start = strtotime(date("Ym01",$time));
				$next_date_time = strtotime($byday_arr[1].$byday_arr[2].$on_day, $month_start); 
		}
	}
	#echo "exp byday";dump_times($times);
	return $times;
}


function restrict_bymonth($times,$freq=''){
	global $bymonth, $byyearday;
	if (empty($bymonth) || !empty($byyearday)) return $times;
	$new_times=array();
	foreach ($times as $time){ 
		if(in_array(date("m", $time), $bymonth)) $new_times[] = $time;
	}	
	return $new_times;
}
function restrict_byweekno($times,$freq=''){
	global $byweekno;
	if(empty($byweekno)) return $times;
	$new_times=array();
	foreach ($times as $time) if(in_array(date("W", $time), $byweekno)) $new_times[] = $time;
	return $new_times;

}
function restrict_byyearday($times,$freq=''){
	global $byyearday;
	if(empty($byyearday)) return $times;
	$new_times=array();
	foreach ($times as $time){
		foreach ($byyearday as $yearday){
			if($yearday < 0){
				$yearday = 365 + $yearday +1;
				if(date("L",$time)) $yearday += 1;
			}	
			$yearday_arr[] = $yearday;
		}
		# date(z,$time) gives 0 for Jan 1
		if(in_array((date("z", $time)+1), $yearday_arr)) $new_times[] = $time;
	}	
	return $new_times;
}

function restrict_bymonthday($times,$freq=''){
	global $bymonthday;
	if(empty($bymonthday)) return $times;
	$new_times=array();
	foreach ($times as $time){
		foreach ($bymonthday as $monthday){
			if($monthday < 0) $monthday = date("t",$time) + $monthday +1;
			$monthday_arr[] = $monthday;
		}	
		if(in_array(date("j", $time), $monthday_arr)) $new_times[] = $time;
	}	
	return $new_times;
}
function restrict_byday($times,$freq=''){
	global $byday;
	if(empty($byday)) return $times;
	foreach($byday as $key=>$day) {
		/* set $byday_arr
				[0] => byday string, e.g. 4TH
				[1] => sign/modifier
				[2] => 4 number
				[3] => TH day abbr
		*/
		ereg ('([-\+]{0,1})?([0-9]{1})?([A-Z]{2})', $day, $byday_arr);
		$byday3[] = two2threeCharDays($byday_arr[3]);
	}
	$new_times=array();
	foreach ($times as $time) if(in_array(strtolower(date("D", $time)), $byday3)) $new_times[] = $time;
	return $new_times;	
}

function restrict_bysetpos($times,$freq=''){
	global $bysetpos;
	if(empty($bysetpos)) return $times;
	sort($times);
	$new_times=array(); 
	foreach($bysetpos as $setpos){
		$new_times[] = implode('',array_slice($times, $setpos, 1));
	}
	return $new_times;	
}

# for diagnostics
function dump_times($times){
	global $summary;
	echo "<pre>$summary times:";
	#var_dump($times);
	foreach($times as $time) echo "\ndate:".date("Y-m-d H:i:s",$time);
	echo "</pre>";
}
