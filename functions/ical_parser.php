<?php

include('./functions/init.inc.php');
include('./functions/date_add.php');
include('./functions/date_functions.php');
include('./functions/draw_functions.php');
include('./functions/overlapping_events.php');
include('./functions/timezones.php');

$fillTime = $day_start;
$day_array = array ();
while ($fillTime != '2400') {
	array_push ($day_array, $fillTime);
	ereg ('([0-9]{2})([0-9]{2})', $fillTime, $dTime);
	$fill_h = $dTime[1];
	$fill_min = $dTime[2];
	$fill_min = sprintf('%02d', $fill_min + $gridLength);
	if ($fill_min == 60) {
		$fill_h = sprintf('%02d', ($fill_h + 1));
		$fill_min = '00';
	}
	$fillTime = $fill_h . $fill_min;
}

// what date we want to get data for (for day calendar)
if (!isset($getdate) || $getdate == '') $getdate = date('Ymd');
ereg ('([0-9]{4})([0-9]{2})([0-9]{2})', $getdate, $day_array2);
$this_day = $day_array2[3];
$this_month = $day_array2[2];
$this_year = $day_array2[1];

// reading the file if it's allowed
$parse_file = true;
if ($is_webcal == false && $save_parsed_cals == 'yes') {	
	$realcal_mtime = filemtime($filename);
	$parsedcal = '/tmp/parsedcal-'.$cal_filename.'-'.$this_year;
	if (file_exists($parsedcal)) {
		$parsedcal_mtime = filemtime($parsedcal);
		if ($realcal_mtime == $parsedcal_mtime) {
			$fd = fopen($parsedcal, 'r');
			$contents = fread($fd, filesize($parsedcal));
			fclose($fd);
			$master_array = unserialize($contents);
			if ($master_array['-1'] == 'valid cal file') {
				$parse_file = false;
				$calendar_name = $master_array['calendar_name'];
				$calendar_tz = $master_array['calendar_tz'];
			}
		}
	}
}

if ($parse_file) {
	// patch to speed up parser
	
	$ifile = fopen($filename, "r");
	if ($ifile == FALSE) exit(error($error_invalidcal_lang, $filename));
	$nextline = fgets($ifile, 1024);
	if ($nextline != "BEGIN:VCALENDAR\n") exit(error($error_invalidcal_lang, $filename));
	
	// Set a value so we can check to make sure $master_array contains valid data
	$master_array['-1'] = 'valid cal file';

	// Set default calendar name - can be overridden by X-WR-CALNAME
	$calendar_name = $cal_filename;
	$master_array['calendar_name'] = $calendar_name;
	
	// auxiliary array for determining overlaps of events
	$overlap_array = array ();
	
// read file in line by line
// XXX end line is skipped because of the 1-line readahead
	while (!feof($ifile)) {
		$line = $nextline;
		$nextline = fgets($ifile, 1024);
		$nextline = ereg_replace("\r\n", "", $nextline);
		while (substr($nextline, 0, 1) == " ") {
			$line = $line . substr($nextline, 1);
			$nextline = fgets($ifile, 1024);
			$nextline = ereg_replace("\r\n", "", $nextline);
		}
		$line = trim($line);
		if (stristr($line, 'BEGIN:VEVENT')) {
			// each of these vars were being set to an empty string
			unset (
				$start_time, $end_time, $start_date, $end_date, $summary, 
				$allday_start, $allday_end, $start, $end, $the_duration, 
				$beginning, $rrule_array, $start_of_vevent, $description, 
				$valarm_description, $start_unixtime, $end_unixtime
			);
				
			$except_dates = array();
			$except_times = array();
			$first_duration = TRUE;
			$count = 1000000;
			$valarm_set = FALSE;
			
			unset(
				$until, $bymonth, $byday, $bymonthday, $byweek, $byweekno, 
				$byminute, $byhour, $bysecond, $byyearday, $bysetpos, $wkst,
				$interval, $number
			);
			
		} elseif (stristr($line, 'END:VEVENT')) {
			
			$mArray_begin = mktime (0,0,0,1,1,$this_year);
			$mArray_end = mktime (0,0,0,1,10,($this_year + 1));
			//if ((!$allday_end) && (!$end_time)) $allday_end = $mArray_end;	
			
			// Mozilla style all-day events or just really long events
			if (($end_time - $start_time) > 2345) {
				$allday_start = $start_date;
				$allday_end = ($start_date + 1);
			}
			
			// If the events go past midnight
			if ($end_time < $start_time) $end_time = 2359;
			
			if (isset($start_time) && $start_time != '') {
				ereg ('([0-9]{2})([0-9]{2})', $start_time, $time);
				ereg ('([0-9]{2})([0-9]{2})', $end_time, $time2);
				$length = ($time2[1]*60+$time2[2]) - ($time[1]*60+$time[2]);
				
				$drawKey = drawEventTimes($start_time, $end_time);
				ereg ('([0-9]{2})([0-9]{2})', $drawKey['draw_start'], $time3);
				$hour = $time3[1];
				$minute = $time3[2];
			}
			
			// Handling of the all day events
			if ((isset($allday_start) && $allday_start != '')) {
				$start = strtotime($allday_start);
				if (isset($allday_end)) {
					$end = strtotime($allday_end);
				} else {
					$end = strtotime('+1 day', $start);
				}
				if (($end > $mArray_begin) && ($end < $mArray_end)) {
					while ($start != $end) {
						$start_date = date('Ymd', $start);
						$master_array[($start_date)][('-1')][]= array ('event_text' => $summary, 'description' => $description);
						$start = strtotime('+1 day', $start);
					}
				}
			}
			
			// Handling regular events
			if ((isset($start_time) && $start_time != '') && (!isset($allday_start) || $allday_start == '')) {
				$nbrOfOverlaps = checkOverlap($start_date, $start_time, $end_time);
				$master_array[($start_date)][($hour.$minute)][] = array ('event_start' => $start_time, 'event_text' => $summary, 'event_end' => $end_time, 'event_length' => $length, 'event_overlap' => $nbrOfOverlaps, 'description' => $description);
			}
			
			// Handling of the recurring events, RRULE
// jared-2002.10.17, Commented this line out, replacing it with another. Not sure why the $allday_written var was
// implemented. This var in this "if" broke all recurring all-day event support (ie, only the first occurrence would show up)
// let's chat about why and figure out a better solution
//			if ((is_array($rrule_array)) && ($allday_written != TRUE)) {
			if (is_array($rrule_array)) {
				if (isset($allday_start) && $allday_start != '') {
					$rrule_array['START_DAY'] = $allday_start;
					$rrule_array['END_DAY'] = $allday_end;
					$rrule_array['END'] = 'end';
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
					$rrule_array['END'] = 'end';
				}
				//print_r($rrule_array);
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
							break;
						case 'COUNT':
							$count = $val;
							break;
						case 'UNTIL':
							$until = ereg_replace('T', '', $val);
							$until = ereg_replace('Z', '', $until);
							ereg ('([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{0,2})([0-9]{0,2})', $until, $regs);
							$year = $regs[1];
							$month = $regs[2];
							$day = $regs[3];
							$until = mktime(0,0,0,$month,$day,$year);
							if (ereg('^([0-9]{4})([0-9]{2})([0-9]{2})T([0-9]{2})([0-9]{2})([0-9]{2})$', $val)) {
								// RFC 2445 says that if an UNTIL has a date-time value,
								// it MUST be in UTC (i.e. trailing Z).  iCal tends to
								// put an end date on the next day early in the morning,
								// not in UTC time, so we try to correct for it.
								//
								// Bill's guess: iCal stores the UNTIL internally as
								// 23:59:59 UTC, then accidentally converts that to local
								// time when exporting the event.  Thus, if the UNTIL time
								// is before noon, it is a day ahead; if it's after noon
								// it's the right day.
								if ($regs[4] < 12)
									$until = strtotime('-1 day', $until);
							}
							break;
						case 'INTERVAL':
							$number = $val;
							break;
						case 'BYSECOND':
							$bysecond = $val;
							$bysecond = split (',', $bysecond);
							break;
						case 'BYMINUTE':
							$byminute = $val;
							$byminute = split (',', $byminute);
							break;
						case 'BYHOUR':
							$byhour = $val;
							$byhour = split (',', $byhour);
							break;
						case 'BYDAY':
							$byday = $val;
							$byday = split (',', $byday);
							break;
						case 'BYMONTHDAY':
							$bymonthday = $val;
							$bymonthday = split (',', $bymonthday);
							break;					
						case 'BYYEARDAY':
							$byyearday = $val;
							$byyearday = split (',', $byyearday);
							break;
						case 'BYWEEKNO':
							$byweekno = $val;
							$byweekno = split (',', $byweekno);
							break;
						case 'BYMONTH':
							$bymonth = $val;
							$bymonth = split (',', $bymonth);
							break;
						case 'BYSETPOS':
							$bysetpos = $val;
							break;
						case 'WKST':
							$wkst = $val;
							break;
						case 'END':
					
						// again, $parse_to_year is set to January 10 of the upcoming year
						$parse_to_year_time  = mktime(0,0,0,1,10,($this_year + 1));
						$start_date_time = strtotime($start_date);
						$this_month_start_time = strtotime($this_year.$this_month.'01');
						
						if ($save_parsed_cals == 'yes' && !$is_webcal) {
							$start_range_time = strtotime($this_year.'-01-01 -1 month -2 days');
							$end_range_time = strtotime($this_year.'-12-31 +1 month +2 days');
						} else {
							$start_range_time = strtotime('-1 month -2 day', $this_month_start_time);
							$end_range_time = strtotime('+2 month +2 day', $this_month_start_time);
						}
						
						// if $until isn't set yet, we set it to the end of our range we're looking at
						if (!isset($until)) $until = $end_range_time;
						$end_date_time = $until;
						
						// If the $end_range_time is less than the $start_date_time, or $start_range_time is greater
						// than $end_date_time, we may as well forget the whole thing
						// It doesn't do us any good to spend time adding data we aren't even looking at
						// this will prevent the year view from taking way longer than it needs to
						if ($end_range_time >= $start_date_time && $start_range_time <= $end_date_time) {
						
							// if the beginning of our range is less than the start of the item, we may as well set it equal to it
							if ($start_range_time < $start_date_time) $start_range_time = $start_date_time;
							if ($end_range_time > $end_date_time) $end_range_time = $end_date_time;
				
							// initialze the time we will increment
							$next_range_time = $start_range_time;
							
							$count_to = 0;
							// start at the $start_range and go until we hit the end of our range.
							while (($next_range_time >= $start_range_time) && ($next_range_time <= $end_range_time) && ($count_to != $count)) {
								$func = $freq_type.'Compare';
								$diff = $func(date('Ymd',$next_range_time), $start_date);
								if ($diff < $count) {
									if ($diff % $number == 0) {
										$interval = $number;
										switch ($rrule_array['FREQ']) {
											case 'DAILY':
												$next_date_time = $next_range_time;
												$recur_data[] = $next_date_time;
												break;
											case 'WEEKLY':
												if (is_array($byday)) {
													// loop through the days on which this event happens
													foreach($byday as $day) {
														// use my fancy little function to get the date of each day
														$day = two2threeCharDays($day);														
														$next_date = dateOfWeek(date('Ymd', $next_range_time),$day);
														$next_date_time = strtotime($next_date);
														$recur_data[] = $next_date_time;
													}
												}
												break;
											case 'MONTHLY':
												$next_range_time = strtotime(date('Y-m-01', $next_range_time));
												// month has two cases, either $bymonthday or $byday
												if (is_array($bymonthday)) {
													// loop through the days on which this event happens
													foreach($bymonthday as $day) {
														if ($day != '0') {
															$day = str_pad($day, 2, '0', STR_PAD_LEFT);
															$next_date_time = strtotime(date('Y-m-',$next_range_time).$day);
															$next_date = date('Ymd', $next_date_time);
															$recur_data[] = $next_date_time;
														}
													}
												// our other case
												} else {
													// loop through the days on which this event happens
													foreach($byday as $day) {
														ereg ('([0-9]{1})([A-Z]{2})', $day, $byday_arr);
														$nth = $byday_arr[1]-1;
														$on_day = two2threeCharDays($byday_arr[2]);
														$next_date_time = strtotime($on_day.' +'.$nth.' week', $next_range_time);
														$next_date = date('Ymd', $next_date_time);
														$recur_data[] = $next_date_time;
													}
												}
												break;
											case 'YEARLY':
												if (!isset($bymonth)) $bymonth[] = date('m', $start_date_time);
												foreach($bymonth as $month) {
													$year = date('Y', $next_range_time);
													$month = str_pad($month, 2, '0', STR_PAD_LEFT);
													if (is_array($byday)) {
														$checkdate_time = strtotime($year.$month.'01');
														foreach($byday as $day) {
															ereg ('([0-9]{1})([A-Z]{2})', $day, $byday_arr);
															$nth = $byday_arr[1]-1;
															$on_day = two2threeCharDays($byday_arr[2]);
															$next_date_time = strtotime($on_day.' +'.$nth.' week', $checkdate_time);
														}
													} else {
														$day = date('d', $start_date_time);
														$next_date_time = strtotime($year.$month.$day);
													}
													$recur_data[] = $next_date_time;
												}
												break;
											default:
												// anything else we need to end the loop
												$next_range_time = $end_range_time + 100;
												$count_to = $count;
										}
									} else {
										$interval = 1;
									}
									$next_range_time = strtotime('+'.$interval.' '.$freq_type, $next_range_time);
								} else {
									// end the loop because we aren't going to write this event anyway
									$count_to = $count;
								}
								// use the same code to write the data instead of always changing it 5 times						
								if (isset($recur_data) && is_array($recur_data)) {
									foreach($recur_data as $recur_data_time) {
										$recur_data_date = date('Ymd', $recur_data_time);
										if (($recur_data_time > $start_date_time) && ($recur_data_time <= $end_date_time) && ($count_to != $count) && !in_array($recur_data_date, $except_dates)) {
											if (isset($allday_start) && $allday_start != '') {
												$start_time2 = $recur_data_time;
												$end_time2 = strtotime('+'.$diff_allday_days.' days', $recur_data_time);
												while ($start_time2 < $end_time2) {
													$start_date2 = date('Ymd', $start_time2);
													$master_array[($start_date2)][('-1')][]= array ('event_text' => $summary, 'description' => $description);
													$start_time2 = strtotime('+1 day', $start_time2);
												}
											} else {
												$nbrOfOverlaps = checkOverlap($recur_data_date, $start_time, $end_time);
												$master_array[($recur_data_date)][($hour.$minute)][] = array ('event_start' => $start_time, 'event_text' => $summary, 'event_end' => $end_time, 'event_length' => $length, 'event_overlap' => $nbrOfOverlaps, 'description' => $description);
											}
										}
									}
									unset($recur_data);
								}
							}
						}
					}	
				}
			}
		

	
		} elseif (stristr($line, "BEGIN:VALARM")) {
			$valarm_set = TRUE;
		} elseif (stristr($line, "END:VALARM")) {
			$valarm_set = FALSE;
		} else {
	
			unset ($field, $data);
			ereg ("([^:]+):(.*)", $line, $line);
			$field = $line[1];
			$data = $line[2];
			
			if (preg_match("/^DTSTART/i", $field)) {
				$data = ereg_replace('T', '', $data);
				$data = ereg_replace('Z', '', $data);
				if (preg_match("/^DTSTART;VALUE=DATE/i", $field))  {
					$allday_start = $data;
					//echo "$summary - $allday_start<br>";
				} else {
					if (preg_match("/^DTSTART;TZID=/i", $field)) {
						$tz_tmp = explode('=', $field);
						$tz_dtstart = $tz_tmp[1];
						unset($tz_tmp);
					}	

					ereg ('([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{0,2})([0-9]{0,2})', $data, $regs);
					$start_date = $regs[1] . $regs[2] . $regs[3];
					$start_time = $regs[4] . $regs[5];
					$start_unixtime = mktime($regs[4], $regs[5], 0, $regs[2], $regs[3], $regs[1]);

					$dlst = date('I', $start_unixtime);
					$server_offset_tmp = chooseOffset($start_unixtime);
					if (isset($tz_dtstart)) {
						if (array_key_exists($tz_dtstart, $tz_array)) {
							$offset_tmp = $tz_array[$tz_dtstart][$dlst];
						} else {
							$offset_tmp = '+0000';
						}
					} elseif (isset($calendar_tz)) {
						if (array_key_exists($calendar_tz, $tz_array)) {
							$offset_tmp = $tz_array[$calendar_tz][$dlst];
						} else {
							$offset_tmp = '+0000';
						}
					} else {
						$offset_tmp = $server_offset_tmp;
					}
					$start_unixtime = calcTime($offset_tmp, $server_offset_tmp, $start_unixtime);
					$start_date = date('Ymd', $start_unixtime);
					$start_time = date('Hi', $start_unixtime);
					unset($server_offset_tmp);
				}
				
			} elseif (preg_match("/^DTEND/i", $field)) {
				$data = ereg_replace('T', '', $data);
				$data = ereg_replace('Z', '', $data);
				if (preg_match("/^DTEND;VALUE=DATE/i", $field))  {
					$allday_end = $data;
				} else {
					if (preg_match("/^DTEND;TZID=/i", $field)) {
						$tz_tmp = explode('=', $field);
						$tz_dtend = $tz_tmp[1];
						unset($tz_tmp);
					}
					ereg ('([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{0,2})([0-9]{0,2})', $data, $regs);
					$end_date = $regs[1] . $regs[2] . $regs[3];
					$end_time = $regs[4] . $regs[5];
					$end_unixtime = mktime($regs[4], $regs[5], 0, $regs[2], $regs[3], $regs[1]);

					$dlst = date('I', $end_unixtime);
					$server_offset_tmp = chooseOffset($end_unixtime);
					if (isset($tz_dtend)) {
						$offset_tmp = $tz_array[$tz_dtend][$dlst];
					} elseif (isset($calendar_tz)) {
						$offset_tmp = $tz_array[$calendar_tz][$dlst];
					} else {
						$offset_tmp = $server_offset_tmp;
					}
					$end_unixtime = calcTime($offset_tmp, $server_offset_tmp, $end_unixtime);
					$end_date = date('Ymd', $end_unixtime);
					$end_time = date('Hi', $end_unixtime);
					unset($server_offset_tmp);

				}
				
			} elseif (preg_match("/^EXDATE/i", $field)) {
				$data = split(",", $data);
				foreach ($data as $exdata) {
					$exdata = ereg_replace('T', '', $exdata);
					$exdata = ereg_replace('Z', '', $exdata);
					ereg ('([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{0,2})([0-9]{0,2})', $exdata, $regs);
					$except_dates[] = $regs[1] . $regs[2] . $regs[3];
					$except_times[] = $regs[4] . $regs[5];
				}
				
			} elseif (preg_match("/^SUMMARY/i", $field)) {
				$data = str_replace("\\n", "<br>", $data);
				$data = htmlentities(urlencode($data));
				$summary = $data;
				
			} elseif (preg_match("/^DESCRIPTION/i", $field)) {
				$data = str_replace("\\n", "<br>", $data);
				$data = htmlentities(urlencode($data));
				if ($valarm_set == FALSE) { 
					$description = $data;
				} else {
					$valarm_description = $data;
				}
			
			} elseif (preg_match("/^X-WR-CALNAME/i", $field)) {
				$calendar_name = $data;
				$master_array['calendar_name'] = $calendar_name;
			} elseif (preg_match("/^X-WR-TIMEZONE/i", $field)) {
				$calendar_tz = $data;
				$master_array['calendar_tz'] = $calendar_tz;
			} elseif (preg_match("/^DURATION/i", $field)) {
				
				if (($first_duration = TRUE) && (!stristr($field, '=DURATION'))) {
					ereg ('^P([0-9]{1,2})?([W,D]{0,1}[T])?([0-9]{1,2}[H])?([0-9]{1,2}[M])?([0-9]{1,2}[S])?', $data, $duration);
					if ($duration[2] = 'W') {
						$weeks = $duration[1];
						$days = 0;
					} else {
						$days = $duration[1];
						$weeks = 0;
					}
					$hours = ereg_replace('H', '', $duration[3]);
					$minutes = ereg_replace('M', '', $duration[4]);
					$seconds = ereg_replace('S', '', $duration[5]);
					$the_duration = ($weeks * 60 * 60 * 24 * 7) + ($days * 60 * 60 * 24) + ($hours * 60 * 60) + ($minutes * 60) + ($seconds);
					$beginning = (strtotime($start_time) + $the_duration);
					$end_time = date ('Hi', $beginning);
					$first_duration = FALSE;
				}	
				
			} elseif (preg_match("/^RRULE/i", $field)) {
				$data = ereg_replace ('RRULE:', '', $data);
				$rrule = split (';', $data);
				foreach ($rrule as $recur) {
					ereg ('(.*)=(.*)', $recur, $regs);
					$rrule_array[$regs[1]] = $regs[2];
				}	
				
			} elseif (preg_match("/^ATTENDEE/i", $field)) {
				$attendee = $data;
				
			}
		}
	}
	
	// Sort the array by absolute date.
	if (isset($master_array) && is_array($master_array)) { 
		ksort($master_array);
		reset($master_array);
		
		// sort the sub (day) arrays so the times are in order
		foreach (array_keys($master_array) as $k) {
			if (isset($master_array[$k]) && is_array($master_array[$k])) {
				ksort($master_array[$k]);
				reset($master_array[$k]);
			}
		}
	}
	
	// write the new master array to the file
	if (isset($master_array) && is_array($master_array) && $save_parsed_cals == 'yes' && $is_webcal == FALSE) {
		$write_me = serialize($master_array);
		$fd = fopen($parsedcal, 'w');
		fwrite($fd, $write_me);
		fclose($fd);
		touch($parsedcal, $realcal_mtime);
	}
}


//If you want to see the values in the arrays, uncomment below.
//print '<pre>';
//print_r($master_array);
//print_r($overlap_array);
//print_r($day_array);
//print_r($rrule);	
//print '</pre>';
	
					
?>
