<?php
if (!defined('BASE')) define('BASE', './');
include_once(BASE.'functions/init.inc.php');
include_once(BASE.'functions/date_functions.php');
include_once(BASE.'functions/draw_functions.php');
include_once(BASE.'functions/parse/overlapping_events.php');
include_once(BASE.'functions/timezones.php');
include_once(BASE.'functions/parse/recur_functions.php');

// reading the file if it's allowed
$realcal_mtime = time();
$parse_file = true;
if ($phpiCal_config->save_parsed_cals == 'yes') {
	sort($cal_filelist);
	$filename = sha1(implode(',', $cal_filelist));
	$parsedcal = $phpiCal_config->tmp_dir . '/parsedcal-' . $filename . '-' . $this_year;
	if (file_exists($parsedcal)) {
		$fd = fopen($parsedcal, 'r');
		$contents = fread($fd, filesize($parsedcal));
		fclose($fd);
		$master_array = unserialize($contents);
		$y=0;
		// Check the calendars' last-modified time to determine if any need to be re-parsed
		if (count($master_array['-4']) == count($cal_filelist)) {
			foreach ($master_array['-4'] as $temp_array) {
				$mtime = $temp_array['mtime'];
				$fname = $temp_array['filename'];
				$wcalc = $temp_array['webcal'];

				if ($wcalc == 'no') {
					/*
					 * Getting local file mtime is "fairly cheap"
					 * (disk I/O is expensive, but *much* cheaper than going to the network for remote files)
					 */
					$realcal_mtime = filemtime($fname);
				}
				else if ((time() - $mtime) >= $phpiCal_config->webcal_hours * 60 * 60) {
					/*
					 * We limit remote file mtime checks based on the magic webcal_hours config variable
					 * This allows highly volatile web calendars to be cached for a period of time before
					 * downloading them again
					 */
					$realcal_mtime = remote_filemtime($fname);
				}
				else {
					// This is our fallback, for the case where webcal_hours is taking effect
					$realcal_mtime = $mtime;
				}

				// If this calendar is up-to-date, the $y magic number will be incremented...
				if ($mtime >= $realcal_mtime) {
					$y++;
				}
			}

			foreach ($master_array['-3'] as $temp_array) {
				if (isset($temp_array) && $temp_array !='') $caldisplaynames[] = $temp_array;
			}

			// And the $y magic number is used here to determine if all calendars are up-to-date
			if ($y == count($cal_filelist)) {
				if ($master_array['-1'] == 'valid cal file') {
					// At this point, all calendars are up-to-date, so we can simply used the pre-parsed data
					$parse_file = false;
					$calendar_name = $master_array['calendar_name'];
					if (isset($master_array['calendar_tz']))
						$calendar_tz = $master_array['calendar_tz'];
				}
			}
		}
	}
	if ($parse_file == true) {
		// We need to re-parse at least one calendar, so unset master_array
		unset($master_array);
	}
}

if ($parse_file) {
	$overlap_array = array ();
	$uid_counter = 0;
}

$calnumber = 1;
foreach ($cal_filelist as $cal_key=>$filename) {

	// Find the real name of the calendar.
	$actual_calname = getCalendarName($filename);

	if ($parse_file) {

		// Let's see if we're doing a webcal
		if (substr($filename, 0, 7) == 'http://' || substr($filename, 0, 8) == 'https://' || substr($filename, 0, 9) == 'webcal://') {
			$cal_webcalPrefix = str_replace(array('http://', 'https://'), 'webcal://', $filename);
			$cal_httpPrefix = str_replace(array('webcal://', 'https://'), 'http://', $filename);
			$cal_httpsPrefix = str_replace(array('http://', 'webcal://'), 'https://', $filename);

			$master_array['-4'][$calnumber]['webcal'] = 'yes';
			$actual_mtime = remote_filemtime($cal_httpPrefix);

			/*
			 * We want to copy the remote calendar to a local temporary file,
			 * because the current parser will read it twice:
			 * - Once to get the timezone information
			 * - And again to collect the remaining data
			 * See: http://phpicalendar.net/forums/viewtopic.php?f=45&t=4140#p14451
			 */
			$filename = tempnam(sys_get_temp_dir(), 'ICS');
			if (copy($cal_httpPrefix, $filename) === FALSE) {
				exit(error($lang['l_copy_error'], $cal_httpPrefix));
			}
		} else {
			$actual_mtime = filemtime($filename);
		}

		include(BASE.'functions/parse/parse_tzs.php');

		$ifile = @fopen($filename, 'r');
		if ($ifile == FALSE) exit(error($lang['l_error_cantopen'], $filename));
		$nextline = fgets($ifile, 1024);
		#if (trim($nextline) != 'BEGIN:VCALENDAR') exit(error($lang['l_error_invalidcal'], $filename));

		// Set a value so we can check to make sure $master_array contains valid data
		$master_array['-1'] = 'valid cal file';

		// Set default calendar name - can be overridden by X-WR-CALNAME
		$calendar_name = $cal_filename;
		$master_array['calendar_name'] 	= $calendar_name;

		// read file in line by line
		// XXX end line is skipped because of the 1-line readahead
		while (!feof($ifile)) {
			$line = $nextline;
			$nextline = fgets($ifile, 1024);
			$nextline = ereg_replace("[\r\n]", '', $nextline);
			#handle continuation lines that start with either a space or a tab (MS Outlook)
			while (isset($nextline{0}) && ($nextline{0} == ' ' || $nextline{0} == "\t")) {
				$line = $line . substr($nextline, 1);
				$nextline = fgets($ifile, 1024);
				$nextline = ereg_replace("[\r\n]", '', $nextline);
			}
			$line = str_replace('\n', "\n", $line);
			$line = str_replace('\t', "\t", $line);
			$line = trim(stripslashes($line));
			switch ($line) {
				// Begin VFREEBUSY/VEVENT Parsing
				//
				case 'BEGIN:VFREEBUSY':
				case 'BEGIN:VEVENT':
					// each of these vars were being set to an empty string
					unset (
						$start_time, $end_time, $start_date, $end_date,
						$allday_start, $allday_end, $start, $end, $the_duration,
						$beginning, $start_of_vevent,
						$valarm_description, $start_unixtime, $end_unixtime, $display_end_tmp, $end_time_tmp1,
						$recurrence_id, $recurrence_d, $recurrence_, $uid, $rrule, $until_check,
						$until, $byweek, $byweekno,
						$byminute, $byhour, $bysecond
					);

					$interval = 1;
					$sequence = 0;
					$summary = '';
					$description = '';
					$status = '';
					$class = '';
					$location = '';
					$url = '';
					$geo = '';
					$type = '';
					$other = '';
					$wkst = 'MO';
					$vtodo_categories = '';

					$except_dates 	= array();
					$except_times 	= array();
					$rrule_array 	= array();
					$byday  	 	= array();
					$bymonth	 	= array();
					$bymonthday 	= array();
					$byyearday  	= array();
					$bysetpos   	= array();
					$first_duration = TRUE;
					$count 			= 1000000;
					$valarm_set 	= FALSE;
					$attendee		= array();
					$organizer		= array();

					break;
				case 'END:VFREEBUSY':
				case 'END:VEVENT':
					include BASE.'functions/parse/end_vevent.php';
					break;

				// Begin VTODO Parsing
				//
				case 'END:VTODO':
					if (($vtodo_priority == '') && ($status == 'COMPLETED')) {
						$vtodo_sort = 11;
					} elseif ($vtodo_priority == '') {
						$vtodo_sort = 10;
					} else {
						$vtodo_sort = $vtodo_priority;
					}

					// CLASS support
					if (isset($class)) {
						if ($class == 'PRIVATE') {
							$summary = '**PRIVATE**';
							$description = '**PRIVATE**';
						} elseif ($class == 'CONFIDENTIAL') {
							$summary = '**CONFIDENTIAL**';
							$description = '**CONFIDENTIAL**';
						}
					}

					$master_array['-2']["$vtodo_sort"]["$uid"] = array (
						'start_date' => $start_date,
						'start_time' => $start_time,
						'vtodo_text' => $summary,
						'due_date'=> $due_date,
						'due_time'=> $due_time,
						'completed_date' => $completed_date,
						'completed_time' => $completed_time,
						'priority' => $vtodo_priority,
						'status' => $status,
						'class' => $class,
						'categories' => $vtodo_categories,
						'description' => $description,
						'calname' => $actual_calname,
						'geo' => $geo,
						'url' => $url
						);
					unset ($start_date, $start_time, $due_date, $due_time, $completed_date, $completed_time, $vtodo_priority, $status, $class, $vtodo_categories, $summary, $description);
					$vtodo_set = FALSE;
					break;

				case 'BEGIN:VTODO':
					$vtodo_set = TRUE;
					$start_date = '';
					$start_time = '';
					$summary = '';
					$due_date = '';
					$due_time = '';
					$completed_date = '';
					$completed_time = '';
					$vtodo_priority = '';
					$vtodo_categories = '';
					$status = '';
					$class = '';
					$description = '';
					break;

				// Begin VALARM Parsing
				//
				case 'BEGIN:VALARM':
					$valarm_set = TRUE;
					break;
				case 'END:VALARM':
					$valarm_set = FALSE;
					break;

				default:
					unset ($field, $data, $prop_pos, $property);
					if (ereg ("([^:]+):(.*)", $line, $line)){
					$field = $line[1];
					$data = $line[2];
					$property = strtoupper($field);
					$prop_pos = strpos($property,';');
					if ($prop_pos !== false) $property = substr($property,0,$prop_pos);

					switch ($property) {
						// Start VTODO Parsing
						//
						case 'DUE':
							$datetime = extractDateTime($data, $property, $field);
							$due_date = $datetime[1];
							$due_time = $datetime[2];
							break;

						case 'COMPLETED':
							$datetime = extractDateTime($data, $property, $field);
							$completed_date = $datetime[1];
							$completed_time = $datetime[2];
							break;

						case 'PRIORITY':
							$vtodo_priority = "$data";
							break;

						case 'STATUS':
							$status = "$data";
							break;

						case 'GEO':
							$geo = "$data";
							break;

						case 'CLASS':
							$class = "$data";
							break;

						case 'CATEGORIES':
							$vtodo_categories = "$data";
							break;
						//
						// End VTODO Parsing

						case 'DTSTART':
							$datetime = extractDateTime($data, $property, $field);
							$start_unixtime = $datetime[0];
							$start_date = $datetime[1];
							$start_time = $datetime[2];
							$allday_start = $datetime[3];
							$start_tz = $datetime[4];
							preg_match ('/([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{0,2})([0-9]{0,2})/', $data, $regs);
							$vevent_start_date = $regs[1] . $regs[2] . $regs[3];
							$day_offset = dayCompare($start_date, $vevent_start_date);
							#echo date("Ymd Hi", $start_unixtime)." $start_date $start_time $vevent_start_date $day_offset<br>";
							break;

						case 'DTEND':
							$datetime = extractDateTime($data, $property, $field);
							$end_unixtime = $datetime[0];
							$end_date = $datetime[1];
							$end_time = $datetime[2];
							$allday_end = $datetime[3];
							break;

						case 'EXDATE':
							$data = split(',', $data);
							foreach ($data as $exdata) {
								$exdata = str_replace('T', '', $exdata);
								$exdata = str_replace('Z', '', $exdata);
								preg_match ('/([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{0,2})([0-9]{0,2})/', $exdata, $regs);
								$except_dates[] = $regs[1] . $regs[2] . $regs[3];
								// Added for Evolution, since they dont think they need to tell me which time to exclude.
								if ($regs[4] == '' && isset($start_time) && $start_time != '') {
									$except_times[] = $start_time;
								} else {
									$except_times[] = $regs[4] . $regs[5];
								}
							}
							break;

						case 'SUMMARY':
							$data = str_replace('$', '&#36;', $data);
							$data = stripslashes($data);
							$data = htmlentities(urlencode($data));
							if ($valarm_set == FALSE) {
								$summary = $data;
							} else {
								$valarm_summary = $data;
							}
							break;

						case 'DESCRIPTION':
							$data = str_replace('$', '&#36;', $data);
							$data = stripslashes($data);
							$data = htmlentities(urlencode($data));
							if ($valarm_set == FALSE) {
								$description = $data;
							} else {
								$valarm_description = $data;
							}
							break;

						case 'RECURRENCE-ID':
							$parts = explode(';', $field);
							foreach($parts as $part) {
								$eachval = split('=',$part);
								if ($eachval[0] == 'RECURRENCE-ID') {
									// do nothing
								} elseif ($eachval[0] == 'TZID') {
									$recurrence_id['tzid'] = $eachval[1];
								} elseif ($eachval[0] == 'RANGE') {
									$recurrence_id['range'] = $eachval[1];
								} elseif ($eachval[0] == 'VALUE') {
									$recurrence_id['value'] = $eachval[1];
								} else {
									$recurrence_id[] = $eachval[1];
								}
							}
							unset($parts, $part, $eachval);

							$data = str_replace('T', '', $data);
							$data = str_replace('Z', '', $data);
							ereg ('([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{0,2})([0-9]{0,2})', $data, $regs);
							$recurrence_id['date'] = $regs[1] . $regs[2] . $regs[3];
							$recurrence_id['time'] = $regs[4] . $regs[5];

							$recur_unixtime = mktime($regs[4], $regs[5], 0, $regs[2], $regs[3], $regs[1]);

							if (isset($recurrence_id['tzid'])) {
								$offset_tmp = chooseOffset($recur_unixtime, $recurrence_id['tzid']);
							} elseif (isset($calendar_tz)) {
								$offset_tmp = chooseOffset($recur_unixtime, $calendar_tz);
							} else {
								$offset_tmp = chooseOffset($recur_unixtime);
							}
							$recur_unixtime = calcTime($offset_tmp, @$server_offset_tmp, $recur_unixtime);
							$recurrence_id['date'] = date('Ymd', $recur_unixtime);
							$recurrence_id['time'] = date('Hi', $recur_unixtime);
							$recurrence_d = date('Ymd', $recur_unixtime);
							$recurrence_t = date('Hi', $recur_unixtime);
							unset($server_offset_tmp);
							break;

						case 'SEQUENCE':
							$sequence = $data;
							break;
						case 'UID':
							$uid = $data;
							break;
						case 'X-WR-CALNAME':
							$actual_calname = $data;
							$master_array['calendar_name'] = $actual_calname;
								$cal_displaynames[$cal_key] = $actual_calname; #correct the default calname based on filename
							break;
						case 'X-WR-CALDESC':
							$actual_caldesc = $data;
							$master_array['calendar_desc'] = $actual_caldesc;
								$cal_displaydescs[$cal_key] = $actual_caldesc; #correct the default caldesc based on filename
							break;
						case 'X-WR-TIMEZONE':
							$calendar_tz = $data;
							$master_array['calendar_tz'] = $calendar_tz;
							break;
						case 'DURATION':
							if (($first_duration == TRUE) && (!stristr($field, '=DURATION'))) {
								ereg ('^P([0-9]{1,2}[W])?([0-9]{1,3}[D])?([T]{0,1})?([0-9]{1,2}[H])?([0-9]{1,2}[M])?([0-9]{1,2}[S])?', $data, $duration);
								$weeks 			= str_replace('W', '', $duration[1]);
								$days 			= str_replace('D', '', $duration[2]);
								$hours 			= str_replace('H', '', $duration[4]);
								$minutes 		= str_replace('M', '', $duration[5]);
								$seconds 		= str_replace('S', '', $duration[6]);
								$the_duration 	= ($weeks * 60 * 60 * 24 * 7) + ($days * 60 * 60 * 24) + ($hours * 60 * 60) + ($minutes * 60) + ($seconds);
								$first_duration = FALSE;
							}
							break;
						case 'RRULE':
							$data = str_replace ('RRULE:', '', $data);
							$rrule = split (';', $data);
							foreach ($rrule as $recur) {
								ereg ('(.*)=(.*)', $recur, $regs);
								$rrule_array[$regs[1]] = $regs[2];
							}
							break;
						case 'ATTENDEE':
							$email		= preg_match('/mailto:(.*)/i', $data, $matches1);
							$name		= preg_match('/CN=([^;]*)/i', $field, $matches2);
							$rsvp 		= preg_match('/RSVP=([^;]*)/i', $field, $matches3);
							$partstat	= preg_match('/PARTSTAT=([^;]*)/i', $field, $matches4);
							$role		= preg_match('/ROLE=([^;]*)/i', $field, $matches5);

							$email		= ($email ? $matches1[1] : '');
							$name		= ($name ? $matches2[1] : $email);
							$rsvp		= ($rsvp ? $matches3[1] : '');
							$partstat	= ($partstat ? $matches4[1] : '');
							$role		= ($role ? $matches5[1] : '');

							// Emergency fallback
							if (empty($name) && empty($email)) $name = $data;

							$attendee[] = array ('name'     => stripslashes($name),
												 'email'    => stripslashes($email),
									        	 'RSVP'     => stripslashes($rsvp),
									        	 'PARTSTAT' => stripslashes($partstat),
								         		 'ROLE'     => stripslashes($role)
												);
							break;
						case 'ORGANIZER':
							$email		= preg_match('/mailto:(.*)/i', $data, $matches1);
							$name		= preg_match('/CN=([^;]*)/i', $field, $matches2);

							$email		= ($email ? $matches1[1] : '');
							$name		= ($name ? $matches2[1] : $email);

							// Emergency fallback
							if (empty($name) && empty($email)) $name = $data;

							$organizer[] = array ('name' => stripslashes($name), 'email' => stripslashes($email));
							break;
						case 'LOCATION':
							$data = str_replace('$', '&#36;', $data);
							$data = stripslashes($data);
							$data = htmlentities(urlencode($data));
							$location = $data;
							break;
						case 'URL':
							$url = $data;
							break;
						default:
							if(strpos(':',$data) > 1) $other .= $data;
					}
				}
			}
		}
		fclose($ifile);

		// Delete the temporary file created for webcals
		if (@$master_array['-4'][$calnumber]['webcal'] == 'yes') {
			unlink($filename);
		}
	}
	if (!isset($master_array['-3'][$calnumber])) $master_array['-3'][$calnumber] = $actual_calname;
	if (!isset($master_array['-4'][$calnumber]['mtime'])) $master_array['-4'][$calnumber]['mtime'] = $actual_mtime;
	if (!isset($master_array['-4'][$calnumber]['filename'])) $master_array['-4'][$calnumber]['filename'] = $filename;
	if (!isset($master_array['-4'][$calnumber]['webcal'])) $master_array['-4'][$calnumber]['webcal'] = 'no';
	$calnumber = $calnumber + 1;
}

if ($parse_file) {
	// Sort the array by absolute date.
	if (isset($master_array) && is_array($master_array)) {
		ksort($master_array);
		reset($master_array);

		// sort the sub (day) arrays so the times are in order
		foreach (array_keys($master_array) as $k) {
			if (isset($master_array[$k]) && is_array($master_array[$k])) {
				krsort($master_array[$k]);
				reset($master_array[$k]);
			}
		}
	}

	// write the new master array to the file
	if (isset($master_array) && is_array($master_array) && $phpiCal_config->save_parsed_cals == 'yes') {
		$write_me = serialize($master_array);
		$fd = @fopen($parsedcal, 'w');
		if ($fd == FALSE) exit(error($lang['l_error_cache'], $filename));
		@fwrite($fd, $write_me);
		@fclose($fd);
		@chmod($parsedcal, 0600); // 0640
	}
}


// Set a calender name for all calenders combined
if ($cal == $phpiCal_config->ALL_CALENDARS_COMBINED) {
	$calendar_name = $all_cal_comb_lang;
}
/* example of how to customize the display name sort order
if(in_array('US Holidays',$cal_displaynames)){
	unset($cal_displaynames[array_search('US Holidays',$cal_displaynames)]);
	array_unshift($cal_displaynames, 'US Holidays');
}
*/
$cal_displayname = urldecode(implode(', ', $cal_displaynames)); #reset this with the correct names
$cal_displaydesc = urldecode(implode(', ', $cal_displaydescs)); #reset this with the correct descs
$template_started = getmicrotime();



//If you want to see the values in the arrays, uncomment below.
#print '<pre>';
#var_dump($phpiCal_config);
#print_r($master_array);
#var_dump($overlap_array['20081211']);
//print_r($day_array);
//print_r($rrule_array);
//print_r($byday_arr);
//print_r($recurrence_delete);
//print_r($cal_displaynames);
//print_r($cal_filelist);
//print_r($tz_array);
#print '</pre>';
?>
