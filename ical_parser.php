<?php
// note from Jared: the _time suffix has been applied to all variables 
// that are timestamps to distinguish between them and Ymd format
// I did not change other variables to use this convention yet

// I started commenting the line above where $master_array gets written to
// I did this because I kept scrolling through looking for them so I decided to mark them

include("./init.inc.php");
include("./functions/date_add.php");
include("./functions/date_functions.php");
include("./functions/draw_functions.php");
include("./functions/overlapping_events.php");



//$day_array = array ("0700", "0730", "0800", "0830", "0900", "0930", "1000", "1030", "1100", "1130", "1200", "1230", "1300", "1330", "1400", "1430", "1500", "1530", "1600", "1630", "1700", "1730", "1800", "1830", "1900", "1930", "2000", "2030", "2100", "2130", "2200", "2230", "2300", "2330");
$fillTime = $day_start;
$day_array = array ();
while ($fillTime != "2400") {
	array_push ($day_array, $fillTime);
	ereg ("([0-9]{2})([0-9]{2})", $fillTime, $dTime);
	$fill_h = $dTime[1];
	$fill_min = $dTime[2];
	$fill_min = sprintf("%02d", $fill_min + $gridLength);
	if ($fill_min == 60) {
		$fill_h = sprintf("%02d", ($fill_h + 1));
		$fill_min = "00";
	}
	$fillTime = $fill_h . $fill_min;
}


// what date we want to get data for (for day calendar)
if (!$getdate) $getdate = date("Ymd");
ereg ("([0-9]{4})([0-9]{2})([0-9]{2})", $getdate, $day_array2);
$this_day = $day_array2[3];
$this_month = $day_array2[2];
$this_year = $day_array2[1];

// Start the session
//session_start();
//if (($aYear != $this_year) || ($use_sessions != "yes") || (!is_array($aArray))) {
//echo "not using sessions";


// open the iCal file, read it into a string
$fp = @fopen($filename, "r");
$contents = @fread ($fp, filesize ($filename));
@fclose ($fp);


// turn that string into an array
$contents = ereg_replace("\n ", "", $contents);
$contents = split ("\n", $contents);

// auxiliary array for determining overlaps of events
$overlap_array = array ();

// parse our new array
foreach($contents as $line) {
	if (strstr($line, "BEGIN:VEVENT")) {
		$start_time = "";
		$end_time = "";
		$end_day = "";
		$summary = "";
		$allday_start = "";
		$allday_end = "";
		$start = "";
		$end = "";
		$the_duration = "";
		$beginning = "";
		$rrule_array = "";
		$start_of_vevent = "";
		$end_of_vevent = "";
		$interval = "";
		$number = "";
		$except_dates = array();
		$except_times = array();
		$first_duration = TRUE;
		$bymonthday = "";
	} elseif (strstr($line, "END:VEVENT")) {
		
		// Clean out \n's and other slashes
		$summary = str_replace("\\n", "<br>", $summary);
		$summary = stripslashes($summary);
		$description = str_replace("\\n", "<br>", $description);
		$mArray_begin = mktime (0,0,0,1,1,$this_year);
		$mArray_end = mktime (0,0,0,1,10,($this_year + 1));
				
		if ($start_time != "") {
			ereg ("([0-9]{2})([0-9]{2})", $start_time, $time);
			ereg ("([0-9]{2})([0-9]{2})", $end_time, $time2);
			$length = ($time2[1]*60+$time2[2]) - ($time[1]*60+$time[2]);
			
			$drawKey = drawEventTimes($start_time, $end_time);
			ereg ("([0-9]{2})([0-9]{2})", $drawKey["draw_start"], $time3);
			$hour = $time3[1];
			$minute = $time3[2];
		}
		
		
		// Handling of the all day events	
		if (($allday_start != "") && ($rrule_array == "")) {
			$start = strtotime("$allday_start");
			$end = strtotime("$allday_end");
			if (($end > $mArray_begin) && ($end < $mArray_end)) {
				while ($start != $end) {
					$start_date = date("Ymd", $start);
					$master_array[($start_date)][("-1")][]= array ("event_text" => "$summary", "description" => $description);
					$start = strtotime("+1 day", $start);
				}
			}
		}
		
		
		// Handling of the recurring events, RRULE
		// This will be quite a bit of work, thats for sure.
		if (is_array($rrule_array)) {
			if ($allday_start != "") {
				$rrule_array["START_DAY"] = $allday_start;
				$rrule_array["END_DAY"] = $allday_end;
				$rrule_array["END"] = "end";
				$recur_start = $allday_start;
			} else {
				$rrule_array["START_DATE"] = $start_date;
				$rrule_array["START_TIME"] = $start_time;
				$rrule_array["END_TIME"] = $end_time;
				$rrule_array["END"] = "end";
			}
			//print_r($rrule_array);
			foreach ($rrule_array as $key => $val) {
				if ($key == "FREQ") {
					if ($val == "YEARLY") {
						$interval = "yyyy";
					} elseif ($val == "MONTHLY") {
						$interval = "m";
					} elseif ($val == "WEEKLY") {
						$interval = "ww";
					} elseif ($val == "DAILY") {
						$interval = "d";
					} elseif ($val == "HOURLY") {
						$interval = "h";
					} elseif ($val == "MINUTELY") {
						$interval = "n";
					} elseif ($val == "SECONDLY") {
						$interval = "s";
					}		
				} elseif ($key == "COUNT") 		{
					$count = $val;
				
				} elseif ($key == "UNTIL") 		{
					$until = ereg_replace("T", "", $val);
					ereg ("([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{0,2})([0-9]{0,2})", $until, $regs);
					$year = $regs[1];
					$month = $regs[2];
					$day = $regs[3];
					$until = strtotime("$year$month$day");
					
				} elseif ($key == "INTERVAL")	{
					$number = $val;
				
				} elseif ($key == "BYSECOND") 	{
					$bysecond = $val;
					$bysecond = split (",", $bysecond);
				
				} elseif ($key == "BYMINUTE") 	{
					$byminute = $val;
					$byminute = split (",", $byminute);
				
				} elseif ($key == "BYHOUR")		{
					$byhour = $val;
					$byhour = split (",", $byhour);
				
				} elseif ($key == "BYDAY") 		{
					$byday = $val;
					$byday = split (",", $byday);
				
				} elseif ($key == "BYMONTHDAY") {
					$bymonthday = $val;
					$bymonthday = split (",", $bymonthday);
					//print_r ($bymonthday);
				
				} elseif ($key == "BYYEARDAY") 	{
					$byyearday = $val;
					$byyearday = split (",", $byyearday);
				
				} elseif ($key == "BYWEEKNO") 	{
					$byweekno = $val;
					$byweekno = split (",", $byweekno);
				
				} elseif ($key == "BYMONTH") 	{
					$bymonth = $val;
					$bymonth = split (",", $bymonth);
				
				} elseif ($key == "BYSETPOS") 	{
					$bysetpos = $val;
				
				} elseif ($key == "WKST") 		{
					$wkst = $val;
				
				} elseif ($key == "END")		{
					
					if ($allday_start != "") {
						
						// Since we hit the end of the RRULE array, lets do something.
						// Below handles yearly, montly, weekly, daily all-day events.
						// $start_of_vevent is the date the recurring event starts.
						// $end_of_vevent is the date the recurring event stops.
						// $count and $count_to check for the COUNT feature
						// $until checks for the UNTIL feature, makes sure we don't recur past it.
						 
						$start_of_vevent = strtotime("$allday_start");
						$end_of_vevent = strtotime("$allday_end");
						$count_to = 0;
						if (!$until) $until = $mArray_end;
						if ($start_of_vevent < $mArray_end) {
							do {
								// This steps through each day of a multiple all-day event and adds to master array
								// Every all day event should pass through here at least once if its recurring.
								$start = $start_of_vevent;
								$end = $end_of_vevent;
								while ($start != $end) {
									$start_date = date("Ymd", $start);
									if (($end > $mArray_begin) && ($end < $mArray_end)) {
										$master_array[($start_date)][("-1")][]= array ("event_text" => "$summary", "description" => $description);
									}
									$start = strtotime("+1 day", $start);
								}
								$start_of_vevent = DateAdd ($interval,  $number, $start_of_vevent);
								$end_of_vevent = DateAdd ($interval,  $number, $end_of_vevent);
								$count_to++;
							} while (($start_of_vevent < $mArray_end) && ($count != $count_to) && ($start_of_vevent < $until)); 
						}
					
					// Let's take care of recurring events that are not all day events
					// DAILY and WEEKLY recurrences seem to work fine. Need feedback.
					// Known bug, doesn't look at UNTIL or COUNT yet.
					} else {
					
						// again, $parse_to_year is set to January 10 of the upcoming year
						$parse_to_year_time  = mktime(0,0,0,1,10,($this_year + 1));
						$start_date_time = strtotime($start_date);
						
						// initializing my range. it takes noticeable time to process the entire year so lets only process
						// what we're looking at. We start out initializing for the year, but hopefully we won't do that.
						$start_range_time = $start_date_time;
						$end_range_time = $parse_to_year_time;
						
						// depending on which view we're looking at, we do one month or one week
						// one day is more difficult, I think, so I wrapped that into the week. We'll have to
						// add another case for "year" once that's added.
						if ($current_view == "month") {
							$start_range_time = strtotime("$this_year-$this_month-01");
							$end_range_time = strtotime("+1 month +1 week", $start_range_time);
						} else {
							$start_range_time = strtotime(dateOfWeek($getdate, substr($week_start_day, 0, 2)));
							$end_range_time = strtotime("+1 week", $start_range_time);
						}
						
						// If the $end_range_time is less than the $start_date_time, we may as well forget the whole thing
						// It doesn't do us any good to spend time adding data we aren't even looking at
						// this will prevent the year view from taking way longer than it needs to
						if ($end_range_time >= $start_date_time) {
						
							// if the beginning of our range is less than the start of the item, we may as well set it equal to it
							if ($start_range_time < $start_date_time) $start_range_time = $start_date_time;
				
							// initialze the time we will increment
							$next_range_time = $start_range_time;
							$i=0;
							// start at the $start_range and go until we hit the end of our range.
							while ($next_range_time >= $start_range_time && $next_range_time <= $end_range_time) {
								$i++;
								// handling WEEKLY events here
								if ($rrule_array["FREQ"] == "WEEKLY") {

									// use weekCompare to see if we even have this event this week
									if (weekCompare(date("Ymd",$next_range_time), $start_date) % $number == 0) {
										$interval = $number;
										// loop through the days on which this event happens
										foreach($byday as $day) {
										
											// use my fancy little function to get the date of each day
											$next_date = dateOfWeek(date("Ymd", $next_range_time),$day);
											
											if (strtotime($next_date) > $start_date_time && !in_array($next_date, $except_dates)) {
												// add it to the array if it passes inspection, it allows the first time to be
												// written by the master data writer (hence the > instead of >=) otherwise we can special case these
												// before, the first one would get entered twice and show up twice
												// $next_date can fall up to a week behind $next_range_time because of how dateOfWeek works
												// so we have to check this again. It uses $except_dates so it doesn't add to $master_array
												// on days that have been deleted by the user
// check for overlapping events
												$nbrOfOverlaps = checkOverlap();
// writes to $master array here
												$master_array[($next_date)][($hour.$minute)][] = array ("event_start" => $start_time, "event_text" => $summary, "event_end" => $end_time, "event_length" => $length, "event_overlap" => $nbrOfOverlaps, "description" => $description);
											}
										}
									} else {
										$interval = 1;
									}
									$next_range_time = strtotime("+$interval week", $next_range_time);
								
								// handling DAILY events here
								} elseif ($rrule_array["FREQ"] == "DAILY") {

									// use dayCompare to see if we even have this event this day
									if (dayCompare(date("Ymd",$next_range_time), $start_date) % $number == 0) {
										$interval = $number;
										$next_date = date("Ymd", $next_range_time);
										
										if (strtotime($next_date) > $start_date_time && !in_array($next_date, $except_dates)) {
											// same general concept as the WEEKLY recurrence
// check for overlapping events
											$nbrOfOverlaps = checkOverlap();
// writes to $master array here
											$master_array[($next_date)][($hour.$minute)][] = array ("event_start" => $start_time, "event_text" => $summary, "event_end" => $end_time, "event_length" => $length, "event_overlap" => $nbrOfOverlaps, "description" => $description);
										}
									} else {
										$interval = 1;
									}
									$next_range_time = strtotime("+$interval day", $next_range_time);
									
								// handling MONTHLY events here
								} elseif ($rrule_array["FREQ"] == "MONTHLY") {
									$next_range_time = strtotime(date("Y-m-01", $next_range_time));
									// use monthCompare to see if we even have this event this month
									if (monthCompare(date("Ymd",$next_range_time), $start_date) % $number == 0) {
										$interval = $number;
										
										// month has two cases, either $bymonthday or $byday
										if (is_array($bymonthday)) {
										
											// loop through the days on which this event happens
											foreach($bymonthday as $day) {
												if ($day != "0") {
													$next_date_time = strtotime(date("Y-m-",$next_range_time).$day);
													$next_date = date("Ymd", $next_date_time);
													if ($next_date_time > $start_date_time && !in_array($next_date, $except_dates)) {
														// same general concept as the WEEKLY recurrence
// check for overlapping events	
														$nbrOfOverlaps = checkOverlap();
// writes to $master array here
														$master_array[($next_date)][($hour.$minute)][] = array ("event_start" => $start_time, "event_text" => $summary, "event_end" => $end_time, "event_length" => $length, "event_overlap" => $nbrOfOverlaps, "description" => $description);
													}
												}
											}
											
										// our other case
										} else {
											// loop through the days on which this event happens
											foreach($byday as $day) {
												ereg ("([0-9]{1})([A-Z]{2})", $day, $byday_arr);
												$nth = $byday_arr[1]-1;
												$on_day = two2threeCharDays($byday_arr[2]);
												$next_date_time = strtotime("$on_day +$nth week", $next_range_time);
												$next_date = date("Ymd", $next_date_time);
												if ($next_date_time > $start_date_time && !in_array($next_date, $except_dates)) {
													// same general concept as the WEEKLY recurrence
// check for overlapping events	
													$nbrOfOverlaps = checkOverlap();
// writes to $master array here
													$master_array[($next_date)][($hour.$minute)][] = array ("event_start" => $start_time, "event_text" => $summary, "event_end" => $end_time, "event_length" => $length, "event_overlap" => $nbrOfOverlaps, "description" => $description);
												}
											}
																					}
									} else {
										$interval = 1;
									}
									$next_range_time = strtotime("+$interval month", $next_range_time);
									
								// anything else we need to end the loop
								} else {
									$next_range_time = $end_range_time + 100;
								}

							}
						}
					}
				}	
			}
		}
	
	// Let's write all the data to the master array
	if ($start_time != "") {
// check for overlapping events
		$nbrOfOverlaps = checkOverlap();

// writes to $master array here
		$master_array[($start_date)][($hour.$minute)][] = array ("event_start" => $start_time, "event_text" => $summary, "event_end" => $end_time, "event_length" => $length, "event_overlap" => $nbrOfOverlaps, "description" => $description);
	}
		

		
		
		
	} else {
		
		$field = "";
		$data = "";
		
		sscanf($line, "%[^:]:%[^\n]", &$field, &$data);
		
		if(strstr($field, "DTSTART;TZID")) {
			$data = ereg_replace("T", "", $data);
			ereg ("([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{0,2})([0-9]{0,2})", $data, $regs);
			$year = $regs[1];
			$month = $regs[2];
			$day = $regs[3];
			$hour = $regs[4];
			$minute = $regs[5];
			
			$start_date = $year . $month . $day;
			$start_time = $hour . $minute;

		} elseif (strstr($field, "DTEND;TZID")) {
			$data = ereg_replace("T", "", $data);
			ereg ("([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{0,2})([0-9]{0,2})", $data, $regs);
			$year = $regs[1];
			$month = $regs[2];
			$day = $regs[3];
			$hour = $regs[4];
			$minute = $regs[5];
		
			$end_day = $year . $month . $day;
			$end_time = $hour . $minute;
			
		} elseif (strstr($field, "EXDATE;TZID")) {
			$data = ereg_replace("T", "", $data);
			ereg ("([0-9]{4})([0-9]{2})([0-9]{2})([0-9]{0,2})([0-9]{0,2})", $data, $regs);
			$year = $regs[1];
			$month = $regs[2];
			$day = $regs[3];
			$hour = $regs[4];
			$minute = $regs[5];
		
			$except_dates[] = $year . $month . $day;
			$except_times[] = $hour . $minute;
			
		} elseif (strstr($field, "SUMMARY")) {
			$summary = $data;
			
		} elseif (strstr($field, "DESCRIPTION")) {
			$description = $data;	
		
		} elseif (strstr($field, "X-WR-CALNAME")) {
			$calendar_name = $data;
		
		} elseif (strstr($field, "DTSTART;VALUE=DATE")) {
			$allday_start = $data;
			// echo "$allday_start";
		
		} elseif (strstr($field, "DTEND;VALUE=DATE")) {
			$allday_end = $data;
			
		} elseif (strstr($field, "DURATION")) {
			
			if (($first_duration = TRUE) && (!strstr($field, "=DURATION"))) {
				ereg ("^P([0-9]{1,2})?([W,D]{0,1})?(T)?([0-9]{1,2})?(H)?([0-9]{1,2})?(M)?([0-9]{1,2})?(S)?", $data, $duration);
				if ($duration[2] = "W") {
					$weeks = $duration[1];
				} else {
					$days = $duration[1];
				}
				$hours = $duration[4];
				$minutes = $duration[6];
				$seconds = $duration[8];
				$the_duration = ($weeks * 60 * 60 * 24 * 7) + ($days * 60 * 60 * 24) + ($hours * 60 * 60) + ($minutes * 60) + ($seconds);
				$beginning = (strtotime($start_time) + $the_duration);
				$end_time = date ("Hi", $beginning);
				$first_duration = FALSE;
			}	
			
		} elseif (strstr($field, "RRULE")) {
			// $data = "RRULE:FREQ=YEARLY;INTERVAL=2;BYMONTH=1;BYDAY=SU;BYHOUR=8,9;BYMINUTE=30";
			$data = ereg_replace ("RRULE:", "", $data);
			$rrule = split (";", $data);
			foreach ($rrule as $recur) {
				ereg ("(.*)=(.*)", $recur, $regs);
				$rrule_array[$regs[1]] = $regs[2];
			}	
		} elseif (strstr($field, "ATTENDEE")) {
			$attendee = $data;
			// echo "$attendee";
			
		}
	}
}
// Sort the array by absolute date.
if (is_array($master_array)) { 
	ksort($master_array);
	reset($master_array);
}

// Store information in the session
/*if ($use_sessions == "yes") {
	session_start();
	session_register( "aArray", "aYear", "aLanguage", "aCalendar" );
	$aArray = $master_array;
	$aYear = $this_year;
	$aLanguage = $language;
	$aCalendar = $cal;
}*/


// End the session
//}

//If you want to see the values in the arrays, uncomment below.
//print "<pre>";
//print_r($master_array);
//print_r($overlap_array);
//print_r($day_array);
//print_r($rrule);			
//print "</pre>";
	
					
?>