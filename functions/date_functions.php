<?php
// date_functions.php
// functions for returning or comparing dates

// not a date function, but I didn't know where to put it
// for backwards compatibility
if (phpversion() < '4.1') {
	function array_key_exists($key, $arr) {
		if (!is_array($arr)) return false;
		foreach (array_keys($arr) as $k) {
			if ("$k" == "$key") return true;
		}
		return false;
	}
}

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
	global $week_start_day;
	if (!isset($week_start_day)) $week_start_day = 'Sunday';
	$timestamp = strtotime($Ymd);
	$num = date('w', strtotime($week_start_day));
	$start_day_time = strtotime((date('w',$timestamp)==$num ? "$week_start_day" : "last $week_start_day"), $timestamp);
	$ret_unixtime = strtotime($day,$start_day_time);
	$ret_unixtime = strtotime('+12 hours', $ret_unixtime);
	$ret = date('Ymd',$ret_unixtime);
	return $ret;
}

// function to compare to dates in Ymd and return the number of weeks 
// that differ between them. requires dateOfWeek()
function weekCompare($now, $then) {
	global $week_start_day;
	$sun_now = dateOfWeek($now, $week_start_day);
	$sun_then = dateOfWeek($then, $week_start_day);
	$seconds_now = strtotime($sun_now);
	$seconds_then =  strtotime($sun_then);
	$diff_seconds = $seconds_now - $seconds_then;
	$diff_minutes = $diff_seconds/60;
	$diff_hours = $diff_minutes/60;
	$diff_days = round($diff_hours/24);
	$diff_weeks = $diff_days/7;
	
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

// localizeDate() - similar to strftime but uses our preset arrays of localized
// months and week days and only supports %A, %a, %B, %b, %e, and %Y
// more can be added as needed but trying to keep it small while we can
function localizeDate($format, $timestamp) {
	global $daysofweek_lang, $daysofweekshort_lang, $daysofweekreallyshort_lang, $monthsofyear_lang, $monthsofyear_lang, $monthsofyearshort_lang;
	$year = date("Y", $timestamp);
	$month = date("n", $timestamp)-1;
	$day = date("j", $timestamp);
	$dayofweek = date("w", $timestamp);
	
	$date = str_replace('%Y', $year, $format);
	$date = str_replace('%e', $day, $date);
	$date = str_replace('%B', $monthsofyear_lang[$month], $date);
	$date = str_replace('%b', $monthsofyearshort_lang[$month], $date);
	$date = str_replace('%A', $daysofweek_lang[$dayofweek], $date);
	$date = str_replace('%a', $daysofweekshort_lang[$dayofweek], $date);
	
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

function chooseOffset($time) {
	global $timezone, $tz_array;
	if (!isset($timezone)) $timezone = '';
	switch ($timezone) {
		case '':
			$offset = 'none';
			break;
		case 'Same as Server':
			$offset = date('O', $time);
			break;
		default:
			if (is_array($tz_array) && array_key_exists($timezone, $tz_array)) {
				$dlst = date('I', $time);
				$offset = $tz_array[$timezone][$dlst];
			} else {
				$offset = '+0000';
			}
	}
	return $offset;
}

function openevent($calendar_name, $start, $end, $arr, $lines, $wrap, $pre_text, $post_text, $link_class, $url) { 
	$event_text = stripslashes(urldecode($arr["event_text"]));
	# for iCal pseudo tag <http> comptability
	if (ereg("<([[:alpha:]]+://)([^<>[:space:]]+)>",$event_text,$matches)) { 
		$full_event_text = $matches[1] . $matches[2]; 
		$event_text = $matches[2];
	} else { 
		$full_event_text = $event_text;
		$event_text = strip_tags($event_text, '<b><i><u>');
	}

	if (isset($arr["organizer"])) $organizer = addslashes($arr["organizer"]);
	if (isset($arr["attendee"])) $attendee = addslashes($arr["attendee"]);
	if (isset($arr["location"])) $location = addslashes($arr["location"]);
	if (isset($arr["status"])) $status = addslashes($arr["status"]);
	if (isset($arr["description"])) $description = addslashes(stripslashes(urldecode($arr["description"])));
    if (isset($arr["url"])) $url = addslashes(stripslashes(urldecode($arr["url"])));

	if (!empty($event_text)) {	
		if ($lines > 0) {
			$event_text = word_wrap($event_text, $wrap, $lines);
		}

		if ((!(ereg("([[:alpha:]]+://[^<>[:space:]]+)", $full_event_text, $res))) || ($description)) {
			$escaped_event = addslashes($full_event_text);
			$escaped_calendar = addslashes($calendar_name);
			$escaped_start = addslashes($start);
			$escaped_end = addslashes($end);
			// fix for URL-length bug in IE: populate and submit a hidden form on click
			static $popup_data_index = 0;
$return = "
    <script language=\"Javascript\" type=\"text/javascript\"><!--
    var eventData = new EventData('$escaped_event', '$escaped_calendar', '$escaped_start', '$escaped_end', '$description', '$status', '$location', '$organizer', '$attendee', '$url');
    document.popup_data[$popup_data_index] = eventData;
    // --></script>";

			$return .= '<a class="'.$link_class.'" href="#" onclick="openEventWindow('.$popup_data_index.'); return false;">';
			$popup_data_index++;
		} else {
			$return .= '<a class="'.$link_class.'" href="'.$res[1].'">';
		}
		$return .= $pre_text.$event_text.$post_text.'</a>'."\n";
	}
	
	return $return;
}


?>
