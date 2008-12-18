<?php
/* end_vevent.php

What happens in this file:
1. Initialization: add information not present by default
	a.	duration
	b.	class
	c.	uid
	d.	adjust start_time and end_time
2. Build recur_data array
3. Add occurrences to master_array
*/

// Handle DURATION
if (!isset($end_unixtime)) {
	if(!isset($the_duration)) $the_duration = 0;
	$end_unixtime 	= $start_unixtime + $the_duration;
	$end_time 	= date ('Hi', $end_unixtime);
}
	
// CLASS support
if (isset($class)) {
	if ($class == 'PRIVATE') {
		$summary ='**PRIVATE**';
		$description ='**PRIVATE**';
	} elseif ($class == 'CONFIDENTIAL') {
		$summary ='**CONFIDENTIAL**';
		$description ='**CONFIDENTIAL**';
	}
}	 

// make sure we have some value for $uid
if (!isset($uid)) {
	$uid = $uid_counter;
	$uid_counter++;
	$uid_valid = false;
} else {
	$uid_valid = true;
}

# adjust event start and end times
if (isset($start_time) && isset($end_time)) {
	// Mozilla style all-day events or just really long events
	if (($end_time - $start_time) > 2345) {
		$allday_start = $start_date;
		$allday_end = ($start_date + 1);
	}
}

# look for events that span more than one day
if (isset($start_unixtime,$end_unixtime) && date('Ymd',$start_unixtime) != date('Ymd',$end_unixtime)) {
	$spans_day = true;
	$bleed_check = (($start_unixtime - $end_unixtime) < (60*60*24)) ? '-1' : '0';
} else {
	$spans_day = false;
	$bleed_check = 0;
}

# get hour and minute adjusted to allowed grid times
if (isset($start_time) && $start_time != '') {
	preg_match ('/([0-9]{2})([0-9]{2})/', $start_time, $time);
	preg_match ('/([0-9]{2})([0-9]{2})/', $end_time, $time2);
	if (isset($start_unixtime) && isset($end_unixtime)) {
		$length = $end_unixtime - $start_unixtime;
	} else {
		$length = ($time2[1]*60+$time2[2]) - ($time[1]*60+$time[2]);
	}
	
	$drawKey = drawEventTimes($start_time, $end_time);
	preg_match ('/([0-9]{2})([0-9]{2})/', $drawKey['draw_start'], $time3);
	$hour = $time3[1];
	$minute = $time3[2];
}

// RECURRENCE-ID Support
if (isset($recurrence_d)) {
	
	$recurrence_delete["$recurrence_d"]["$recurrence_t"] = $uid;
}


# treat nonrepeating events as rrule events with one instance
if (!isset($rrule_array) && $start_unixtime < $mArray_end && $end_unixtime > $mArray_begin){
	$rrule_array['FREQ'] = 'YEARLY';
	$rrule_array['START_DATE'] = $start_date;
	$rrule_array['UNTIL'] = $start_date;
#	$rrule_array['END'] = 'end';
}


if (isset($allday_start) && $allday_start != '') {
	$hour = '-';
	$minute = '1';
	$rrule_array['START_DAY'] = $allday_start;
	# $rrule_array['END_DAY'] = $allday_end; # this doesn't seem to be used anywhere.
#	$rrule_array['END'] = 'end';
	$recur_start = $allday_start;
	$start_date = $allday_start;
	if (isset($allday_end)) {
		$diff_allday_days = dayCompare($allday_end, $allday_start);
	 } else {
		$diff_allday_days = 1;
	}
} else {
	$rrule_array['START_DATE'] = $start_date;
	$rrule_array['START_TIME'] = $start_time;
	$rrule_array['END_TIME'] = $end_time;
#	$rrule_array['END'] = 'end';
}

$freq_type = 'none';
# Load $rrule_array
foreach ($rrule_array as $key => $val) {
	switch($key) {
		case 'FREQ':
			switch ($val) {
				case 'YEARLY':		$freq_type = 'year';	break;
				case 'MONTHLY':		$freq_type = 'month';	break;
				case 'WEEKLY':		$freq_type = 'week';	break;
				case 'DAILY':		$freq_type = 'day';		break;
				case 'HOURLY':		$freq_type = 'hour';	break;
				case 'MINUTELY':	$freq_type = 'minute';	break;
				case 'SECONDLY':	$freq_type = 'second';	break;
			}
			$recur_array[($start_date)][($hour.$minute)][$uid]['recur'][$key] = strtolower($val);
			break;
		case 'COUNT':
			$count = $val;
			$recur_array[($start_date)][($hour.$minute)][$uid]['recur'][$key] = $count;
			break;
		case 'UNTIL':
			$until = str_replace('T', '', $val);
			$until = str_replace('Z', '', $until);
			if (strlen($until) == 8) $until = $until.'235959';
			$abs_until = $until;
			ereg ('([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})', $until, $regs);
			$until_unixtime = mktime($regs[4],$regs[5],@$regs[6],$regs[2],$regs[3],$regs[1]);
			$recur_array[($start_date)][($hour.$minute)][$uid]['recur'][$key] = localizeDate($dateFormat_week,$until);
			break;
		case 'INTERVAL':
			if ($val > 0){
			$interval = $val;
			$recur_array[($start_date)][($hour.$minute)][$uid]['recur'][$key] = $interval;
			}
			break;
		case 'BYSECOND':
			$bysecond = split (',', $val);
			$recur_array[($start_date)][($hour.$minute)][$uid]['recur'][$key] = $bysecond;
			break;
		case 'BYMINUTE':
			$byminute = split (',', $val);
			$recur_array[($start_date)][($hour.$minute)][$uid]['recur'][$key] = $byminute;
			break;
		case 'BYHOUR':
			$byhour = split (',', $val);
			$recur_array[($start_date)][($hour.$minute)][$uid]['recur'][$key] = $byhour;
			break;
		case 'BYDAY':
			$byday = split (',', $val);
			$recur_array[($start_date)][($hour.$minute)][$uid]['recur'][$key] = $byday;
			break;
		case 'BYMONTHDAY':
			$bymonthday = split (',', $val);
			$recur_array[($start_date)][($hour.$minute)][$uid]['recur'][$key] = $bymonthday;
			break;					
		case 'BYYEARDAY':
			$byyearday = split (',', $val);
			$recur_array[($start_date)][($hour.$minute)][$uid]['recur'][$key] = $byyearday;
			break;
		case 'BYWEEKNO':
			$byweekno = split (',', $val);
			$recur_array[($start_date)][($hour.$minute)][$uid]['recur'][$key] = $byweekno;
			break;
		case 'BYMONTH':
			$bymonth = split (',', $val);
			$recur_array[($start_date)][($hour.$minute)][$uid]['recur'][$key] = $bymonth;
			break;
		case 'BYSETPOS':
			$bysetpos = split (',', $val);
			$recur_array[($start_date)][($hour.$minute)][$uid]['recur'][$key] = $bysetpos;
			break;
		case 'WKST':
			$wkst = $val;
			$recur_array[($start_date)][($hour.$minute)][$uid]['recur'][$key] = $wkst;
			break;
	}
}
# $recur is the recurrence info that goes into the master array for this VEVENT
$recur = @$recur_array[($start_date)][($hour.$minute)][$uid]['recur']; 

/* ============================ Load $recur_data ============================
$recur_data is an array of unix times for days of recurrences of an event.  This code handles repeats at the day level or above.  The next loop handles the times.
RDATE is currently not supported

A. Set up the time range to scan for events.
If COUNT is not set (default is 1,000,000) then we don't have to start at start_date; we can start at the minimum interval for the view.
variables ending in date are in phpical date format: YYYYMMDD
variables ending with time are in phpical time format: HHMM
variables ending in unixtime are in unixtime

mArray_begin and mArray_end are set in initialization by date_range.php and may be overwritten by rss_common.php.  

$start_date_unixtime should be the default for starting the range.  Need this for the intervals to work out (e.g. every other day, week, month etc)
mArray_end should be the default for end_range unixtimes.  
Conditions where overwrite these:
	$until_unixtime < $mArray_end 	- stop iterating early
	!isset($rrule_array['FREQ']) 	- only iterate once, set the end_range_unixtime to the end_date_unixtime
Note that start_range_unixtime and end_range_unixtime are not the same as start_date_unixtime and end_date_unixtime */

$end_range_unixtime = $mArray_end+60*60*24;
$start_date_unixtime = strtotime($start_date);
$next_range_unixtime = $start_date_unixtime;

#conditions where we can not iterate over the whole range
if($count == 1000000){
	if($interval == 1) {
		$next_range_unixtime = $mArray_begin;
	}else{
		# can we calculate the right start time?
		# pick the right compare function from date_functions.php
		# $diff is the number of occurrences between start_date and next_range_time
	#	$func = $freq_type.'Compare';
	#	$diff = $func(date('Ymd',strtotime($getdate)), $start_date);	
	#	$next_range_unixtime = strtotime('+'.$diff*$interval.' '.$freq_type, $start_date_unixtime); echo "<pre>$summary\nnext $freq_type $diff $freq_type".date("Ymd",$start_date_unixtime)."\n";
	}
}
// if the beginning of our range is less than the start of the item, we may as well set it equal to it
if ($next_range_unixtime < $start_date_unixtime) $next_range_unixtime = $start_date_unixtime;

if(isset($until) && $end_range_unixtime > $until_unixtime) $end_range_unixtime = $until_unixtime;
if($freq_type == 'year') $end_range_unixtime	+= 366*24*60*60;
if(!isset($rrule_array['FREQ']) && isset($end_date)){ 
	$end_range_unixtime = strtotime($end_date);
	$count = 1;
}
// convert wkst to a 3 char day for strtotime to work		
$wkst3char = two2threeCharDays($wkst);

/* The while loop below increments $next_range_time by $freq type. For the larger freq types, there is only 
one $next_range_time per repeat, but the BYXXX rules may write more than one event in that repeat cycle
$next_date_time handles those instances within a $freq_type */
#echo "<pre>$summary\n\tstart mArray time:".date("Ymd his",$mArray_begin)."\n\tnext_range_unixtime:".date("Ymd his",$next_range_unixtime)."\n\tend range time ".date("Ymd his",$end_range_unixtime)."\n";
$recur_data = array();
while ($next_range_unixtime <= $end_range_unixtime && $count > 0) {
	$year = date("Y", $next_range_unixtime); 
	$month = date('m', $next_range_unixtime); 
	$time = mktime(12,0,0,$month,date("d",$start_unixtime),$year);
	switch ($freq_type){
		case 'day':
			add_recur($next_range_unixtime);
			break;
		case 'week':
			add_recur(expand_byday($next_range_unixtime));
			break;
		case 'month':
			if(!empty($bymonthday)) $time = mktime(12,0,0,$month,1,$year);
			$times = expand_bymonthday(array($time));#echo "\n $month exp bymonthday";dump_times($times);
			foreach($times as $time){ 
				add_recur(expand_byday($time));
			}
			break;
		case 'year':
			$times = expand_bymonth($time); #echo "exp bymonth";dump_times($times);
			$times = expand_byweekno($times); #echo "exp byweekno";dump_times($times);
			$times = expand_byyearday($times); #echo "exp byyearday";dump_times($times);
			$times = expand_bymonthday($times); #echo "\nexp bymonthday";dump_times($times);
			foreach($times as $time){ 
				add_recur(expand_byday($time));
			}
			break;
		default:
			add_recur($start_unixtime);
			break 2;
	}
	$next_range_unixtime = strtotime('+'.$interval.' '.$freq_type, $next_range_unixtime); #echo "\nnext $interval $freq_type".date("Ymd",$next_range_unixtime)."\n";
} #end while loop
sort($recur_data);

/* ============================ Use $recur_data array to write the master array ============================*/
// This used to use 5 different blocks to write the array... can it be reduced further?						
$recur_data_hour = @substr($start_time,0,2);
$recur_data_minute = @substr($start_time,2,2);
foreach($recur_data as $recur_data_unixtime) {
	$recur_data_year = date('Y', $recur_data_unixtime);
	$recur_data_month = date('m', $recur_data_unixtime);
	$recur_data_day = date('d', $recur_data_unixtime);
	$recur_data_date = $recur_data_year.$recur_data_month.$recur_data_day;

	if (isset($allday_start) && $allday_start != '') {
		$start_time2 = $recur_data_unixtime;
		$end_time2 = strtotime('+'.$diff_allday_days.' days', $recur_data_unixtime);
		while ($start_time2 < $end_time2) {
			$start_date2 = date('Ymd', $start_time2);
			$master_array[($start_date2)][('-1')][$uid] = array (
				'event_text' => $summary, 
				'description' => $description, 
				'location' => $location, 
				'organizer' => serialize($organizer), 
				'attendee' => serialize($attendee), 
				'calnumber' => $calnumber, 
				'calname' => $actual_calname, 
				'url' => $url, 
				'status' => $status, 
				'class' => $class, 
				'recur' => $recur );
			$start_time2 = strtotime('+1 day', $start_time2);
		}
	} else {
		$start_unixtime_tmp = mktime($recur_data_hour,$recur_data_minute,0,$recur_data_month,$recur_data_day,$recur_data_year);
		$end_unixtime_tmp = $start_unixtime_tmp + $length;
		
		if (($end_time >= $phpiCal_config->bleed_time) && ($bleed_check == '-1')) {
			$start_tmp = strtotime(date('Ymd',$start_unixtime_tmp));
			$end_date_tmp = date('Ymd',$end_unixtime_tmp);
			while ($start_tmp < $end_unixtime_tmp) {
				$start_date_tmp = date('Ymd',$start_tmp);
				if ($start_date_tmp == $recur_data_year.$recur_data_month.$recur_data_day) {
					$time_tmp = $hour.$minute;
					$start_time_tmp = $start_time;
				} else {
					$time_tmp = '0000';
					$start_time_tmp = '0000';
				}
				if ($start_date_tmp == $end_date_tmp) {
					$end_time_tmp = $end_time;
				} else {
					$end_time_tmp = '2400';
					$display_end_tmp = $end_time;
				}
				
				// Let's double check the until to not write past it
				$until_check = $start_date_tmp.$time_tmp.'00'; 
				if ($abs_until > $until_check) {
					$master_array[$start_date_tmp][$time_tmp][$uid] = array (
						'event_start' => $start_time_tmp, 
						'event_end' => $end_time_tmp, 
						'start_unixtime' => $start_unixtime_tmp, 
						'end_unixtime' => $end_unixtime_tmp, 
						'event_text' => $summary, 
						'event_length' => $length, 
						'event_overlap' => 0, 
						'description' => $description, 
						'status' => $status, 
						'class' => $class, 
						'spans_day' => true, 
						'location' => $location, 
						'organizer' => serialize($organizer), 
						'attendee' => serialize($attendee), 
						'calnumber' => $calnumber, 
						'calname' => $actual_calname, 
						'url' => $url, 
						'recur' => $recur);
					if (isset($display_end_tmp)){
						$master_array[$start_date_tmp][$time_tmp][$uid]['display_end'] = $display_end_tmp;
					}
					checkOverlap($start_date_tmp, $time_tmp, $uid);
				}
				$start_tmp = strtotime('+1 day',$start_tmp);
			}
		} else {
			if ($bleed_check == '-1') {
				$display_end_tmp = $end_time;
				$end_time_tmp1 = '2400';
					
			}
			if (!isset($end_time_tmp1)) $end_time_tmp1 = $end_time;
		
			// Let's double check the until to not write past it
				$master_array[($recur_data_date)][($hour.$minute)][$uid] = array (
					'event_start' => $start_time, 
					'event_end' => $end_time_tmp1, 
					'start_unixtime' => $start_unixtime_tmp, 
					'end_unixtime' => $end_unixtime_tmp, 
					'event_text' => $summary, 
					'event_length' => $length, 
					'event_overlap' => 0, 
					'description' => $description, 
					'status' => $status, 
					'class' => $class, 
					'spans_day' => false, 
					'location' => $location, 
					'organizer' => serialize($organizer), 
					'attendee' => serialize($attendee), 
					'calnumber' => $calnumber, 
					'calname' => $actual_calname, 
					'url' => $url, 
					'recur' => $recur);
				if (isset($display_end_tmp)){
					$master_array[($recur_data_date)][($hour.$minute)][$uid]['display_end'] = $display_end_tmp;
				}
				checkOverlap($recur_data_date, ($hour.$minute), $uid);
			
		}
	}

}

unset($recur_data);


// This should remove any exdates that were missed.
// Added for version 0.9.5 modified in 2.22 remove anything that doesn't have an event_start
if (is_array($except_dates)) {
	foreach ($except_dates as $key => $value) {
		if (isset ($master_array[$value])){
			foreach ($master_array[$value] as $time => $value2){
				if (!isset($value2[$uid]['event_start'])){
					unset($master_array[$value][$time][$uid]);
				}
			}
		}
	}
}

// Clear event data now that it's been saved.
unset($start_time, $start_time_tmp, $end_time, $end_time_tmp, $start_unixtime, $start_unixtime_tmp, $end_unixtime, $end_unixtime_tmp, $summary, $length, $description, $status, $class, $location, $organizer, $attendee);
//If you want to see the values in the arrays, uncomment below.
//print '<pre>';
//print_r($master_array);
//print_r($overlap_array);
//print_r($day_array);
//print_r($rrule_array);
//print_r($byday_arr);
//print_r($recurrence_delete);
//print_r($cal_displaynames);
//print_r($cal_filelist);
//print_r($tz_array);
//print '</pre>';
?>