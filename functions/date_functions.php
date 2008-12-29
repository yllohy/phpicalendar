<?php
require_once(BASE."functions/is_daylight.php");
// date_functions.php
// functions for returning or comparing dates


// takes iCalendar 2 day format and makes it into 3 characters
// if $txt is true, it returns the 3 letters, otherwise it returns the
// integer of that day; 0=Sun, 1=Mon, etc.
function two2threeCharDays($day, $txt=true) {
	switch($day) {
		case 'SU': return ($txt ? 'sun' : '0');
		case 'MO': return ($txt ? 'mon' : '1');
		case 'TU': return ($txt ? 'tue' : '2');
		case 'WE': return ($txt ? 'wed' : '3');
		case 'TH': return ($txt ? 'thu' : '4');
		case 'FR': return ($txt ? 'fri' : '5');
		case 'SA': return ($txt ? 'sat' : '6');
	}
}

// dateOfWeek() takes a date in Ymd and a day of week in 3 letters or more
// and returns the date of that day. (ie: "sun" or "sunday" would be acceptable values of $day but not "su")
function dateOfWeek($Ymd, $day) {
	global $phpiCal_config;
	$week_start_day = 'Sunday';
	if (isset($phpiCal_config->week_start_day)) $week_start_day = $phpiCal_config->week_start_day;
	$timestamp = strtotime($Ymd);
	$num = date('w', strtotime($week_start_day));
	$start_day_time = strtotime((date('w',$timestamp)==$num ? "$week_start_day" : "last $week_start_day"), $timestamp);
	$ret_unixtime = strtotime($day,$start_day_time);
	// Fix for 992744
	// $ret_unixtime = strtotime('+12 hours', $ret_unixtime);
	$ret_unixtime += (12 * 60 * 60);
	$ret = date('Ymd',$ret_unixtime);
	return $ret;
}

// function to compare to dates in Ymd and return the number of weeks 
// that differ between them. requires dateOfWeek()
function weekCompare($now, $then) {
	global $week_start_day;
	$sun_now = dateOfWeek($now, "Sunday");
	$sun_then = dateOfWeek($then, "Sunday");
	$seconds_now = strtotime($sun_now);
	$seconds_then =  strtotime($sun_then);
	$diff_weeks = round(($seconds_now - $seconds_then)/(60*60*24*7));
	return $diff_weeks;
}

// function to compare to dates in Ymd and return the number of days 
// that differ between them.
function dayCompare($now, $then) {
	$seconds_now = strtotime($now);
	$seconds_then =  strtotime($then);
	$diff_seconds = $seconds_now - $seconds_then;
	$diff_minutes = $diff_seconds/60;
	$diff_hours = $diff_minutes/60;
	$diff_days = round($diff_hours/24);
	
	return $diff_days;
}

// function to compare to dates in Ymd and return the number of months 
// that differ between them.
function monthCompare($now, $then) {
	ereg ("([0-9]{4})([0-9]{2})([0-9]{2})", $now, $date_now);
	ereg ("([0-9]{4})([0-9]{2})([0-9]{2})", $then, $date_then);
	$diff_years = $date_now[1] - $date_then[1];
	$diff_months = $date_now[2] - $date_then[2];
	if ($date_now[2] < $date_then[2]) {
		$diff_years -= 1;
		$diff_months = ($diff_months + 12) % 12;
	}
	$diff_months = ($diff_years * 12) + $diff_months;

	return $diff_months;
}

function yearCompare($now, $then) {
	ereg ("([0-9]{4})([0-9]{2})([0-9]{2})", $now, $date_now);
	ereg ("([0-9]{4})([0-9]{2})([0-9]{2})", $then, $date_then);
	$diff_years = $date_now[1] - $date_then[1];
	return $diff_years;
}

function noneCompare($now, $then) {
	return 0;
}


// localizeDate() - similar to strftime but uses our preset arrays of localized
// months and week days and only supports %A, %a, %B, %b, %e, and %Y
// more can be added as needed but trying to keep it small while we can
function localizeDate($format, $timestamp) {
	global $daysofweek_lang, $daysofweekshort_lang, $daysofweekreallyshort_lang, $monthsofyear_lang, $monthsofyear_lang, $monthsofyearshort_lang;
	$year = date("Y", $timestamp);
	$month = date("n", $timestamp)-1;
	$day = date("j", $timestamp);
	$dayofweek = date("w", $timestamp);	
 	$replacements = array(
 		'%Y' =>	$year,
 		'%e' => $day,
 		'%B' => $monthsofyear_lang[$month],
 		'%b' => $monthsofyearshort_lang[$month],
 		'%A' => $daysofweek_lang[$dayofweek],
 		'%a' => $daysofweekshort_lang[$dayofweek],
 		'%d' => sprintf("%02d", $day)
 	);
 	$date = str_replace(array_keys($replacements), array_values($replacements), $format);	
	return $date;	
	
}
// calcOffset takes an offset (ie, -0500) and returns it in the number of seconds
function calcOffset($offset_str) {
	$sign = substr($offset_str, 0, 1);
	$hours = substr($offset_str, 1, 2);
	$mins = substr($offset_str, 3, 2);
	$secs = ((int)$hours * 3600) + ((int)$mins * 60);
	if ($sign == '-') $secs = 0 - $secs;
	return $secs;
}

// calcTime calculates the unixtime of a new offset by comparing it to the current offset
// $have is the current offset (ie, '-0500')
// $want is the wanted offset (ie, '-0700')
// $time is the unixtime relative to $have
function calcTime($have, $want, $time) {
	if ($have == 'none' || $want == 'none') return $time;
	$have_secs = calcOffset($have);
	$want_secs = calcOffset($want);
	$diff = $want_secs - $have_secs;
	$time += $diff;
	return $time;
}

function chooseOffset($time, $timezone = '') {
	global $tz_array, $summary;
	switch ($timezone) {
		case '':
			$offset = 'none';
			break;
		case 'Same as Server':
			$offset = date('O', $time);
			break;
		default:
			if (is_array($tz_array) && array_key_exists($timezone, $tz_array)) {
				$dlst = is_daylight($time, $timezone);
				$offset = $tz_array[$timezone][$dlst];
			} else {
				$offset = '+0000';
			}
	}
	return $offset;
}
/* Returns a string to make event text with a link to popup boxes 
	$arr is a master array item
	$lines is the number of lines to restrict the event_text to, using word_wrap
	$length is the length of one line
	$link_class is a css class
	$pre_text and $post_text are to add tags around the link text (e.g. <b> or<i>)
	
	$title is the tooltip for the link
*/
function openevent($event_date, $time, $uid, $arr, $lines = 0, $length = 0, $link_class = '', $pre_text = '', $post_text = '') {
	global $cpath, $timeFormat, $dateFormat_week;
	$return = '';
	$event_text = stripslashes(urldecode($arr["event_text"]));
	# build tooltip
	if ($time == -1) {
		$start = localizeDate($dateFormat_week, $arr['start_unixtime']);
		$end   = localizeDate($dateFormat_week, ($arr['end_unixtime'] - 60));
		$title = $event_text;
		if ($start != $end) $title = "$start - $end $event_text";
	} else {
		$start = date($timeFormat, $arr['start_unixtime']);
		$end = date($timeFormat, $arr['end_unixtime']);
		$title = "$start: $event_text";
		if ($start != $end) $title = "$start - $end $event_text";
	}
	$title .= "\n".urldecode($arr['description'])."\n".urldecode($arr['location']);
	$title = trim($title);
	# for iCal pseudo tag <http> comptability
	if (ereg("<([[:alpha:]]+://)([^<>[:space:]]+)>",$event_text,$matches)) {
		$full_event_text = $matches[1] . $matches[2];
		$event_text      = $matches[2];
	} else {
		$full_event_text = $event_text;
		$event_text      = strip_tags($event_text, '<b><i><u><img>');
	}

	if (!empty($event_text)) {
		if ($lines > 0) {
			$event_text = word_wrap($event_text, $length, $lines);
		}

		if ((!(ereg("([[:alpha:]]+://[^<>[:space:]]+)", $full_event_text, $res))) || ($arr['description'])) {
			$escaped_date = addslashes($event_date);
			$escaped_time = addslashes($time);
			$escaped_uid  = addslashes($uid);
			$event_data   = addslashes(serialize ($arr));
			// fix for URL-length bug in IE: populate and submit a hidden form on click
			static $popup_data_index = 0;
			$return = "
				<script language='Javascript' type='text/javascript'><!--
				var eventData = new EventData('$escaped_date', '$escaped_time', '$escaped_uid','$cpath','$event_data');
				document.popup_data[$popup_data_index] = eventData;
				// --></script>";

			$return .= '<a class="'.$link_class.'" title="'.$title.'" href="#" onclick="openEventWindow('.$popup_data_index.'); return false;">';
			$popup_data_index++;
		} else {
			$return .= '<a class="'.$link_class.'" title="'.$title.'" href="'.$res[1].'">';
		}
		$return .= $pre_text.$event_text.$post_text.'</a>'."\n";
	}

	return $return;
}

/* Returns an array of the date and time extracted from the data
 passed in. This array contains (unixtime, date, time, allday, tzid).

	$data		= A string representing a date-time per RFC2445.
	$property	= The property being examined, e.g. DTSTART, DTEND.
	$field		= The full field being examined, e.g. DTSTART;TZID=US/Pacific
	
See:http://phpicalendar.org/documentation/index.php/Property_Value_Data_Types#4.3.5___Date-Time	
*/
function extractDateTime($data, $property, $field) {
	global $tz_array, $phpiCal_config, $calendar_tz;
	$allday =''; #suppress error on returning undef.
	// Check for zulu time.
	$zulu_time = false;
	if (substr($data,-1) == 'Z') $zulu_time = true;
	// Pull out the timezone, or use GMT if zulu time was indicated.
	if (preg_match('/^'.$property.';TZID=/i', $field)) {
		$tz_tmp = explode('=', $field);
		$tz_dt = match_tz($tz_tmp[1]); #echo "$tz_dt<br>";
	} elseif ($zulu_time) {
		$tz_dt = 'GMT';
	}
	
	// Extract date-only values.
	if ((preg_match('/^'.$property.';VALUE=DATE:/i', $field)) || (ereg ('^([0-9]{4})([0-9]{2})([0-9]{2})$', $data)))  {
		// Pull out the date value. Minimum year is 1970.
		ereg ('([0-9]{4})([0-9]{2})([0-9]{2})', $data, $dt_check);
		if ($dt_check[1] < 1970) { 
			$data = '1971'.$dt_check[2].$dt_check[3];
		}		
		# convert to date-time
		$data = $dt_check[1].$dt_check[2].$dt_check[3]."T000000";
		$time = '';
		$allday = $data;
	}
	// Extract date-time values.
	// Pull out the date and time values. Minimum year is 1970.
	preg_match ('/([0-9]{4})([0-9]{2})([0-9]{2})T{0,1}([0-9]{0,2})([0-9]{0,2})/', $data, $regs);
	if (!isset ($regs[1])) return;
	if ($regs[1] < 1970) { 
		$regs[1] = '1971';
	}
	$date = $regs[1] . $regs[2] . $regs[3];
	$time = $regs[4] . $regs[5];
	$unixtime = mktime($regs[4], $regs[5], 0, $regs[2], $regs[3], $regs[1]);
	# chooseOffset checks for Daylight Saving Time
	$server_offset_tmp = chooseOffset($unixtime, $phpiCal_config->timezone);
	if (isset($tz_dt)) {
		$offset_tmp = chooseOffset($unixtime, $tz_dt);
	} elseif (isset($calendar_tz)) {
		$offset_tmp = chooseOffset($unixtime, $calendar_tz);
		$tz_dt = $calendar_tz;
	} else {
		$offset_tmp = $server_offset_tmp;
		$tz_dt = $phpiCal_config->timezone;
	}
	// Set the values.
	$unixtime = calcTime($offset_tmp, $server_offset_tmp, $unixtime);
	#echo "offset_tmp $offset_tmp, server_offset_tmp $server_offset_tmp, $unixtime =".date("Ymd His",$unixtime)." $time<br>";
	$date = date('Ymd', $unixtime);
	if ($allday == '') $time = date('Hi', $unixtime);
		
	// Return the results.
	return array($unixtime, $date, $time, $allday, $tz_dt);
}

/* TZIDs in calendars often contain leading information that should be stripped
Example: TZID=/mozilla.org/20050126_1/Europe/Berlin
if this has been set by the parse_tzs scanning the file, then it should be OK, but sometimes a calendar may have a tzid without having defined the vtimezone, expecting a match (This will often happen when users send isolated events in bug reports; the calendars should have vtimezones).

Need to return the part that matches a key in $tz_array
*/
function match_tz($data){
	global $tz_array;
	if (isset($tz_array[$data])) return $data;
	foreach ($tz_array as $key=>$val){
		if (strpos(" $data",$key) > 0) return $key;
	}
	return $data;
}?>