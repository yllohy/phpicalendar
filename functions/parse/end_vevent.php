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

if (!isset($start_date)) $start_date = "19700101";

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
}elseif(in_array($uid, $uid_list)) {
	$uid .= $uid_counter;
	$uid_counter++;
}else{
	$uid_valid = true;
}
$uid_list[] = $uid;

# Handle DURATION
if (!isset($end_unixtime)) {
	if(!isset($the_duration)) $the_duration = 0;
	$end_unixtime 	= $start_unixtime + $the_duration;
	$end_time 	= date ('Hi', $end_unixtime);
}
# at this point $end_unixtime should be set
# adjust event start and end times
if (isset($start_time) && isset($end_time)) {
	// Mozilla style all-day events or just really long events
	if (($end_unixtime - $start_unixtime) > 24*60*60) {
		$allday_start = $start_date;
		$allday_end = ($start_date + 1);
	}
}
# look for events that span more than one day
if (isset($start_unixtime,$end_unixtime) && date('Ymd',$start_unixtime) < date('Ymd',$end_unixtime)) {
	$spans_day = true;
	$bleed_check = (($start_unixtime - $end_unixtime) <= (60*60*24)) ? '-1' : '0';
} else {
	$spans_day = false;
	$bleed_check = 0;
}

$length = $end_unixtime - $start_unixtime;
if ($length < 0){ 
	$length = 0;
	$end_time = $start_time;
}
# get hour and minute adjusted to allowed grid times
$drawKey = drawEventTimes($start_time, $end_time);
preg_match ('/([0-9]{2})([0-9]{2})/', $drawKey['draw_start'], $time3);
preg_match ('/([0-9]{2})([0-9]{2})/', $drawKey['draw_end'], $time4);
$hour = $time3[1];
$minute = $time3[2];
$end_hour = $time4[1];
$end_minute = $time4[2];


// RECURRENCE-ID Support
if (isset($recurrence_d)) {
	
	$recurrence_delete["$recurrence_d"]["$recurrence_t"] = $uid;
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
			# UNTIL must be in UTC
			$until = date("YmdHis",strtotime($val)); 
			ereg ('([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{2})([0-9]{2})', $until, $regs);
			$until_unixtime = mktime($regs[4],@$regs[5],@$regs[6],$regs[2],$regs[3],$regs[1]);
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
# convert wkst to a 3 char day for strtotime to work		
$wkst3char = two2threeCharDays($wkst);
if($current_view == 'search') $freq_type = 'none'; 
# $recur is the recurrence info that goes into the master array for this VEVENT
$recur ='';
if (isset($recur_array[($start_date)][($hour.$minute)][$uid]['recur'])) $recur = $recur_array[($start_date)][($hour.$minute)][$uid]['recur']; 

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

# conditions where we don't need to iterate over the whole range
# 	if repeating without limit, and steps are by 1, don't go back before the mArray beginning.
if($count == 1000000 && $interval == 1 && $mArray_begin > $next_range_unixtime) $next_range_unixtime = $mArray_begin;

# 	if the beginning of our range is less than the start of the item, we may as well set the range to start at start_time
if ($next_range_unixtime < $start_date_unixtime) $next_range_unixtime = $start_date_unixtime;

# 	stop at the until limit if set
if(isset($until) && $end_range_unixtime > $until_unixtime) $end_range_unixtime = $until_unixtime;else $until_unixtime = $mArray_end;

# 	more adjustments
switch ($freq_type){
	case 'week':
		# need to get the first value of $next_range_unixtime onto the right day of the week
		$next_range_unixtime = strtotime("this ".date("D", $start_date_unixtime), $next_range_unixtime);
		break;
	case 'year':
		$end_range_unixtime	+= 366*24*60*60;
		break;
}

#nonrepeating events can stop at the first instance
if(!isset($rrule_array['FREQ']) && isset($end_date)){ 
	$end_range_unixtime = strtotime($end_date);
	$count = 1;
}

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
			$times = expand_bymonth($time);      #echo "exp bymonth";dump_times($times);
			$times = expand_byweekno($times);    #echo "exp byweekno";dump_times($times);
			$times = expand_byyearday($times);   #echo "exp byyearday";dump_times($times);
			$times = expand_bymonthday($times);  #echo "\nexp bymonthday";dump_times($times);
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

/* ============================ Use $recur_data array to write the master array ============================
// This used to use 5 different blocks to write the array... can it be reduced further?

For each recurrence date, an event may still cross day boundaries.  So we need to loop from the start_date for that recurrence to the end of that recurrence.
To generate $recur_data we mostly only paid attention to start times.

Now, a single event must be split into multiple master array values for each day on which it occurs

$hour and $minute are the values from the start_time, rounded to the nearest grid time.

*/
$recur_data_hour = @substr($start_time,0,2);
$recur_data_minute = @substr($start_time,2,2);
if (isset($allday_start) && $allday_start != ''){
	$recur_data_hour = '00';
	$recur_data_minute = '00';
}
foreach($recur_data as $recur_data_unixtime) {
	$recur_data_year 	= date('Y', $recur_data_unixtime);
	$recur_data_month 	= date('m', $recur_data_unixtime);
	$recur_data_day 	= date('d', $recur_data_unixtime);
	$recur_data_date 	= $recur_data_year.$recur_data_month.$recur_data_day;
	
	# initialize the loop range	to the recur date + grid time
	$next_range_unixtime = mktime($recur_data_hour,$recur_data_minute,0,$recur_data_month,$recur_data_day,$recur_data_year);
	$end_range_unixtime = $next_range_unixtime + $length;
	$end_date_tmp = date("Ymd",$end_range_unixtime);
	#echo "<pre>$summary ".date("Ymd H:i:s",$next_range_unixtime)." ".date("Ymd H:i:s",$end_range_unixtime)."\n";

	# default the time_key to -1 for allday events, overwrite as needed
	$time_key = -1;
	
	$start_unixtime_tmp = strtotime($recur_data_date.$start_time);
	$end_unixtime_tmp = strtotime($end_date_tmp.$end_time);
	while (date("Ymd", $next_range_unixtime) <= $end_date_tmp) {
		$this_date_tmp = date('Ymd',$next_range_unixtime);	
		$next_range_unixtime = strtotime('+1 day',$next_range_unixtime);
		
		if (!isset($allday_start) || $allday_start == '') $time_key = $hour.$minute;
		$display_end_tmp = $end_hour.$end_minute;
		if($time_key > -1){
			# the day is not the first day of the recurrence
			if ($this_date_tmp > $recur_data_date) $time_key = '0000';
			# the day is not the last day of the recurrence
			if ($this_date_tmp < $end_date_tmp) $display_end_tmp = '2400';
		}
		if($this_date_tmp == $end_date_tmp && ($end_time == '0000' && $time_key == -1)) continue;
		$master_array[$this_date_tmp][$time_key][$uid] = array (
			'event_start' => $start_time,                	# hhmm
			'event_end' => $end_time,                    	# hhmm
			'display_end' => $display_end_tmp,            	# hhmm display_start is $time_key
			'start_unixtime' => $start_unixtime_tmp,      	# start unixtime for this recurrence
			'end_unixtime' => $end_unixtime_tmp,          	# end unixtime for this recurrence
			'event_text' => $summary,                    	#
			'event_length' => $length,                    	# length in seconds
			'event_overlap' => 0,                        	# checkOverlap modifies this
			'description' => $description, 
			'status' => $status, 
			'class' => $class, 
			'spans_day' => $spans_day, 
			'location' => $location, 
			'organizer' => serialize($organizer), 
			'attendee' => serialize($attendee), 
			'calnumber' => $calnumber, 
			'calname' => $actual_calname,
			'geo' => $geo,
			'url' => $url, 
			'recur' => $recur
			);
		if($time_key > -1) checkOverlap($this_date_tmp, $time_key, $uid);
	}
} # end foreach recur_data 
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