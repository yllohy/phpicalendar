<?php

/* from the std

BYxxx rule parts modify the recurrence in some manner. BYxxx rule
   parts for a period of time which is the same or greater than the
   frequency generally reduce or limit the number of occurrences of the
   recurrence generated. For example, "FREQ=DAILY;BYMONTH=1" reduces the
   number of recurrence instances from all days (if BYMONTH tag is not
   present) to all days in January. BYxxx rule parts for a period of
   time less than the frequency generally increase or expand the number
   of occurrences of the recurrence. For example,
   "FREQ=YEARLY;BYMONTH=1,2" increases the number of days within the
   yearly recurrence set from 1 (if BYMONTH tag is not present) to 2.

   If multiple BYxxx rule parts are specified, then after evaluating the
   specified FREQ and INTERVAL rule parts, the BYxxx rule parts are
   applied to the current set of evaluated occurrences in the following
   order: BYMONTH, BYWEEKNO, BYYEARDAY, BYMONTHDAY, BYDAY, BYHOUR,
   BYMINUTE, BYSECOND and BYSETPOS; then COUNT and UNTIL are evaluated.

	We will use two kinds of functions - those that restrict the date to allowed values and those that expand allowed values

*/

function add_recur($times,$freq=''){
	global $recur_data;	
	if (!is_array($times)) $times = array($times);
	/*BYMONTH, BYWEEKNO, BYYEARDAY, BYMONTHDAY, BYDAY, BYHOUR,
   BYMINUTE, BYSECOND and BYSETPOS*/
	$times = restrict_bymonth($times,$freq); 
	$times = restrict_byweekno($times,$freq);
	$times = restrict_byyearday($times,$freq);
	$times = restrict_bymonthday($times,$freq);
	$times = restrict_byday($times,$freq);
	$times = restrict_bysetpos($times,$freq);

	foreach ($times as $time) if(isset($time)) $recur_data[] = $time;
	return;
}

function expand_byday($time){
	global $freq_type, $byday, $wkst3char;
	$the_sunday = dateOfWeek(date("Ymd",$time), $wkst3char);
#	echo "$freq_type, ".print_r($byday,true)."$wkst3char $the_sunday";
	if (empty($byday)) $byday[] = strtoupper(substr(date('D', $time), 0, 2));					
	foreach($byday as $key=>$day) {
		/* set $byday_arr
				[0] => byday string, e.g. 4TH
				[1] => sign/modifier
				[2] => 4 number
				[3] => TH day abbr
		*/
		ereg ('([-\+]{0,1})?([0-9]{1})?([A-Z]{2})', $day, $byday_arr);
		$on_day = two2threeCharDays($byday_arr[3]);
		switch($freq_type){
			case 'week':
				#need to find the first day of the appropriate week.						
				if ($key == 0){ 
					$next_date_time = strtotime("next $on_day",strtotime($the_sunday)) + (12 * 60 * 60);
				}else{
					$next_date_time = strtotime("next $on_day",$next_date_time) + (12 * 60 * 60);						
				}
			default:	
				$next_date_time = strtotime($byday_arr[1].$byday_arr[2].$on_day, $time); 
		}
		$times[] = $next_date_time; 
	}
	return $times;
}


function restrict_bymonth($times,$freq=''){
	global $bymonth;
	if (empty($bymonth)) return $times;
	foreach ($times as $time) if(in_array(date("m", $time), $bymonth)) $new_times[] = $time;
	return $new_times;
}
function restrict_byweekno($times,$freq=''){
	global $byweekno;
	if(empty($byweekno)) return $times;
	foreach ($times as $time) if(in_array(date("W", $time), $byweekno)) $new_times[] = $time;
	return $new_times;

}
function restrict_byyearday($times,$freq=''){
	global $byyearday;
	if(empty($byyearday)) return $times;
	foreach ($times as $time) if(in_array(date("z", $time), $byyearday)) $new_times[] = $time;
	return $new_times;
}

function restrict_bymonthday($times,$freq=''){
	global $bymonthday;
	if(empty($bymonthday)) return $times;
	foreach ($times as $time) if(in_array(date("j", $time), $bymonthday)) $new_times[] = $time;
	return $new_times;
}
function restrict_byday($times,$freq=''){
	global $byday;
	if(empty($byday)) return $times;
	foreach($byday as $key=>$day) $byday3[] = two2threeCharDays($day);	
	foreach ($times as $time) if(in_array(strtolower(date("D", $time)), $byday3)) $new_times[] = $time;
	return $new_times;	
}

function restrict_bysetpos($times,$freq=''){
	global $rrule_array, $bysetpos;
	if(empty($bysetpos)) return $times;

}