<?php

//print_r($master_array);

class Page {
	var $page;
	function draw_subscribe($template_p) {
		global $template, $getdate, $cal, $ALL_CALENDARS_COMBINED, $subscribe_path, $download_filename;
		if ($cal != $ALL_CALENDARS_COMBINED && $subscribe_path != '' && $download_filename != '') {
			$this->page 	= str_replace('{SUBSCRIBE_PATH}', $subscribe_path, $this->page);
			$this->page 	= str_replace('{DOWNLOAD_FILENAME}', $download_filename, $this->page);
		} else {
			$this->page = preg_replace('!<\!-- switch display_download on -->(.*)<\!-- switch display_download off -->!is', '', $this->page);
		}
	}
	
	function draw_admin() {
		global $template, $getdate, $cal, $master_array, $is_loged_in;
		
		if ($is_loged_in == TRUE) { 
			// Print Calendar Checkboxes
			$COLUMNS_TO_PRINT = 3;
			$column = 1;
			$filelist = availableCalendarNames('', '', '', true);
			foreach ($filelist as $file) {
				if ($column > $COLUMNS_TO_PRINT) {
					$delete_table 	.= '</tr>';
					$column 	= 1;
				}
				if ($column == 1) {
					$delete_table .= '<tr>';
				}
				
				$cal_filename_tmp = substr($file,0,-4);
				$cal_tmp = urlencode($file);
				$cal_displayname_tmp = str_replace("32", " ", $cal_filename_tmp);
				
				$delete_table .= '<td align="left"><input name="delete_calendar[]" value="'.$cal_tmp.'" type="checkbox" />'.$cal_displayname_tmp.'</td>';
				
				$column++;
			}
			// Print remaining empty columns if necessary
			$number_of_columns = count($filelist);
			while (gettype($number_of_columns/$COLUMNS_TO_PRINT) != "integer") {
				$delete_table .= '<td>&nbsp;</td>';
				$number_of_columns++;
			}
			
			$this->page 	= str_replace('{DELETE_TABLE}', $delete_table, $this->page);
		} else {
			$this->page 	= preg_replace('!<\!-- switch logged_in on -->(.*)<\!-- switch logged_in off -->!is', '', $this->page);
			$this->page 	= preg_replace('!<\!-- switch logged_in2 on -->(.*)<\!-- switch logged_in2 off -->!is', '', $this->page);
		}
	
	}
	
	function draw_print($template_p) {
		global $template, $getdate, $cal, $master_array, $daysofweek_lang, $week_start_day, $printview, $dateFormat_day, $timeFormat, $week_start, $week_end, $lang;
		preg_match("!<\!-- loop events on -->(.*)<\!-- loop events off -->!is", $this->page, $match1);
		preg_match("!<\!-- switch some_events on -->(.*)<\!-- loop events on -->!is", $this->page, $match3);
		$loop_event		= trim($match1[1]);
		$loop_day 		= trim($match3[1]);
		$parse_month 	= date ("Ym", strtotime($getdate));
		
		foreach($master_array as $key => $val) {
			preg_match ('/([0-9]{6})([0-9]{2})/', $key, $regs);
			if ((($regs[1] == $parse_month) && ($printview == 'month')) || (($key == $getdate) && ($printview == 'day')) || ((($key >= $week_start) && ($key <= $week_end)) && ($printview == 'week'))) {
				$events_week++;
				$dayofmonth = strtotime ($key);
				$dayofmonth = localizeDate ($dateFormat_day, $dayofmonth);
				$events_tmp = $loop_event;
				$day_tmp	= $loop_day;
				
				// Pull out each day
				foreach ($val as $new_val) {
					foreach ($new_val as $new_key2 => $new_val2) {
					if ($new_val2['event_text']) {	
						$event_text 	= stripslashes(urldecode($new_val2['event_text']));
						$description 	= stripslashes(urldecode($new_val2['description']));
						$event_start 	= $new_val2['event_start'];
						$event_end 		= $new_val2['event_end'];
						if (isset($new_val2['display_end'])) $event_end = $new_val2['display_end'];
							$event_start 	= date ($timeFormat, strtotime ($event_start));
							$event_end 		= date ($timeFormat, strtotime ($event_end));
							$event_start 	= $event_start .' - '.$event_end;
							if (!$new_val2['event_start']) { 
								$event_start = $lang['l_all_day'];
								$event_start2 = '';
								$event_end = '';
							}							
						}
						
						if ($description == '') {
							$events_tmp = preg_replace('!<\!-- switch description_events on -->(.*)<\!-- switch description_events off -->!is', '', $events_tmp);
						}
						
						$search		= array('{EVENT_START}', '{EVENT_TEXT}', '{DESCRIPTION}');
						$replace	= array($event_start, $event_text, $description);
						$events_tmp = str_replace($search, $replace, $events_tmp);
						$some_events .= $events_tmp;
						$events_tmp	= $loop_event;
					}
				}
				$day_tmp  = str_replace('{DAYOFMONTH}', $dayofmonth, $day_tmp);
				$final   .= $day_tmp.$some_events;
				unset ($day_tmp, $some_events);
			}
		}
		
		if ($events_week < 1) {
			$this->page = preg_replace('!<\!-- switch some_events on -->(.*)<\!-- switch some_events off -->!is', '', $this->page);
		} else {
			$this->page = preg_replace('!<\!-- switch some_events on -->(.*)<\!-- switch some_events off -->!is', $final, $this->page);
			$this->page = preg_replace('!<\!-- switch no_events on -->(.*)<\!-- switch no_events off -->!is', '', $this->page);
		}
	}	
	
	function draw_week($template_p) {
		global $unique_colors, $start_week_time, $template, $getdate, $cal, $master_array, $daysofweek_lang, $week_start_day, $dateFormat_week_list, $current_view, $day_array, $timeFormat, $gridLength, $timeFormat_small, $day_start;
		
		// Figure out colspans
		$dayborder 	= 0;
		$thisdate  	= $start_week_time;
		$swt	   	= $start_week_time;
		for ($i=0;$i<7;$i++) {
			$thisday = date("Ymd", $thisdate);
			$nbrGridCols[$thisday] = 1;
			if (isset($master_array[$thisday])) {
				foreach($master_array[($thisday)] as $ovlKey => $ovlValue) {
					if ($ovlKey != "-1") {
						foreach($ovlValue as $ovl2Value) {
							$nbrGridCols[($thisday)] = kgv($nbrGridCols[($thisday)], ($ovl2Value["event_overlap"] + 1));
						}
					}
				} 
			}
			$thisdate = ($thisdate + (25 * 60 * 60));
		}
		
		for ($i=0; $i<7; $i++) {
			$thisdate 			= date ('Ymd', $start_week_time); 
			$weekarray[$i] 		= $thisdate;
			$start_week_time 	= strtotime('+1 day', $start_week_time);
		}
				
		// Replaces the allday events
		preg_match("!<\!-- loop allday on -->(.*)<\!-- loop allday off -->!is", $this->page, $match1);
		preg_match("!<\!-- loop alldaysofweek on -->(.*)<\!-- loop allday on -->!is", $this->page, $match2);
		preg_match("!<\!-- loop allday off -->(.*)<\!-- loop alldaysofweek off -->!is", $this->page, $match3);
		$loop_ad 	= trim($match1[1]);
		$loop_begin = trim($match2[1]);
		$loop_end 	= trim($match3[1]);
		foreach ($weekarray as $key => $get_date) {
			$replace 	= $loop_begin;
			$colspan	= 'colspan="'.$nbrGridCols[$get_date].'"';
			$replace 	= str_replace('{COLSPAN}', $colspan, $replace);
			if (is_array($master_array[$get_date]['-1'])) {
				foreach ($master_array[$get_date]['-1'] as $allday) {
					$event_calno  	= $allday['calnumber'];
					$event_calna  	= $allday['calname'];
					$event_url	   	= $allday['url'];
					if ($event_calno > $unique_colors) $event_calno = ($event_calno - $unique_colors);
					$event 			= openevent($event_calna, '', '', $allday, 1, 11, '', '', 'psf', $event_url);
					$loop_tmp 		= str_replace('{ALLDAY}', $event, $loop_ad);
					$loop_tmp 		= str_replace('{CALNO}', $event_calno, $loop_tmp);
					$replace		.= $loop_tmp;
				}
			}
			$replace .= $loop_end;
			$weekreplace .= $replace;
		}
		$this->page = preg_replace('!<\!-- loop alldaysofweek on -->(.*)<\!-- loop alldaysofweek off -->!is', $weekreplace, $this->page);
		
		// Replaces the daysofweek
		preg_match("!<\!-- loop daysofweek on -->(.*)<\!-- loop daysofweek off -->!is", $this->page, $match1);
		$loop_dof = trim($match1[1]);
		$start_wt		 	= strtotime(dateOfWeek($getdate, $week_start_day));
		$start_day 			= strtotime($week_start_day);
		for ($i=0; $i<7; $i++) {
			$day_num 		= date("w", $start_day);
			$daylink		= date('Ymd', $start_wt);
			if ($current_view == 'day') {
				$weekday 		= $daysofweek_lang[$day_num];
			} else {
				$weekday = localizeDate($dateFormat_week_list, strtotime($daylink));
			}	
			
			if ($daylink == $getdate) {
				$row1 = 'rowToday';
				$row2 = 'rowOn';
				$row3 = 'rowToday';
			} else {
				$row1 = 'rowOff';
				$row2 = 'rowOn';
				$row3 = 'rowOff';
			}
			$start_day 		= strtotime("+1 day", $start_day);
			$start_wt 		= strtotime("+1 day", $start_wt);
			$colspan		= 'colspan="'.$nbrGridCols[$daylink].'"';
			$search			= array('{DAY}', '{DAYLINK}', '{ROW1}', '{ROW2}', '{ROW3}', '{COLSPAN}');
			$replace		= array($weekday, $daylink, $row1, $row2, $row3, $colspan);
			$loop_tmp 		= str_replace($search, $replace, $loop_dof);
			$weekday_loop  .= $loop_tmp;
		}
		$this->page = preg_replace('!<\!-- loop daysofweek on -->(.*)<\!-- loop daysofweek off -->!is', $weekday_loop, $this->page);
		
		// Build the body
		preg_match("!<\!-- loop row on -->(.*)<\!-- loop row off -->!is", $this->page, $match2);
		preg_match("!<\!-- loop event on -->(.*)<\!-- loop event off -->!is", $this->page, $match3);
		$loop_hours = trim($match2[1]);
		$loop_event = trim($match3[1]);

		$event_length = array ();
		$border = 0;
		preg_match ('/([0-9]{4})([0-9]{2})([0-9]{2})/', $getdate, $day_array2);
		$this_day = $day_array2[3]; 
		$this_month = $day_array2[2];
		$this_year = $day_array2[1];
		$thisdate = $swt;
		for ($i=0;$i<7;$i++) {
			$thisday = date("Ymd", $thisdate);
			$event_length[$thisday] = array ();
			$thisdate = ($thisdate + (25 * 60 * 60));
		}
		foreach ($day_array as $key) {
			$cal_time = $key;	
			preg_match('/([0-9]{2})([0-9]{2})/', $key, $regs_tmp);
			$key = mktime($regs_tmp[1],$regs_tmp[2],0,$this_month,$this_day,$this_year);
			$key = date ($timeFormat, $key);
												

			if (ereg("([0-9]{1,2}):00", $key)) {
				$weekdisplay .= '<tr>';
				$weekdisplay .= '<td colspan="4" rowspan="' . (60 / $gridLength) . '" align="center" valign="top" width="60" class="timeborder">'.$key.'</td>';
				$weekdisplay .= '<td bgcolor="#a1a5a9" width="1" height="' . $gridLength . '"></td>';
			} elseif ($cal_time == $day_start) {
				$size_tmp = 60 - (int)substr($cal_time,2,2);
				$weekdisplay .= '<tr>';
				$weekdisplay .= '<td colspan="4" rowspan="' . ($size_tmp / $gridLength) . '" align="center" valign="top" width="60" class="timeborder">'.$key.'</td>';
				$weekdisplay .= '<td bgcolor="#a1a5a9" width="1" height="' . $gridLength . '"></td>';
			} else {
				$weekdisplay .= '<tr>';
				$weekdisplay .= '<td bgcolor="#a1a5a9" width="1" height="' . $gridLength . '"></td>';
			}
			
			// initialize $thisdate again
			$thisdate = $swt;
			
			// loop this part 7 times, one for each day
			for ($week_loop=0; $week_loop<7; $week_loop++) {
				$thisday = date("Ymd", $thisdate);
				$dayborder = 0;
				unset($this_time_arr);
				if (isset($master_array[$thisday][$cal_time]) && sizeof($master_array[$thisday][$cal_time]) > 0) {
					$this_time_arr = $master_array[$thisday][$cal_time];
				}
					
				if ($day_start == $cal_time && isset($master_array[$thisday]) && is_array($master_array[$thisday])) {
					foreach($master_array[$thisday] as $time_key => $time_arr) {
						if ((int)$time_key < (int)$cal_time && is_array($time_arr) && $time_key != '-1') {
							foreach($time_arr as $event_tmp) {
								if ((int)$event_tmp['event_end'] > (int)$cal_time) {
									$this_time_arr[] = $event_tmp;
								}
							}
						} else {
							break;
						}
					}
				}
				
				
				// check for eventstart 
				if (isset($this_time_arr) && sizeof($this_time_arr) > 0) {
					foreach ($this_time_arr as $eventKey => $loopevent) {
						$drawEvent = drawEventTimes ($cal_time, $loopevent["event_end"]);
						$j = 0;
						while (isset($event_length[$thisday][$j])) {
							if ($event_length[$thisday][$j]["state"] == "ended") {
								$event_length[$thisday][$j] = array ("length" => ($drawEvent["draw_length"] / $gridLength), "key" => $eventKey, "overlap" => $loopevent["event_overlap"],"state" => "begin");
								break;
							}
							$j++;
						}
						if ($j == sizeof($event_length[$thisday])) {
							array_push ($event_length[$thisday], array ("length" => ($drawEvent["draw_length"] / $gridLength), "key" => $eventKey, "overlap" => $loopevent["event_overlap"],"state" => "begin"));
						}
					}
				}

				if (sizeof($event_length[$thisday]) == 0) {
					if ($dayborder == 0) {
						$class = ' class="weekborder"';
						$dayborder++;
					} else {
						$class = '';
						$dayborder = 0;
					}
					
					$drawWidth = 1;
					$colspan_width = round((80 / $nbrGridCols[$thisday]) * $drawWidth);
					$weekdisplay .= '<td width="' . $colspan_width . '" colspan="' . $nbrGridCols[$thisday] . '" ' . $class . '>&nbsp;</td>'."\n";
					
				} else {
					$emptyWidth = $nbrGridCols[$thisday];
					for ($i=0;$i<sizeof($event_length[$thisday]);$i++) {
					
						$drawWidth = $nbrGridCols[$thisday] / ($event_length[$thisday][$i]["overlap"] + 1);
						$emptyWidth = $emptyWidth - $drawWidth;
						switch ($event_length[$thisday][$i]["state"]) {
							case "begin":
								$event_length[$thisday][$i]["state"] = "started";
								$event_start 	= $this_time_arr[($event_length[$thisday][$i]["key"])]['start_unixtime'];
								$event_start 	= date ($timeFormat_small, $event_start);
								$event_calno  	= $this_time_arr[($event_length[$thisday][$i]['key'])]['calnumber'];
								$event_calna  	= $this_time_arr[($event_length[$thisday][$i]['key'])]['calname'];
								$event_url  	= $this_time_arr[($event_length[$thisday][$i]['key'])]['url'];
								$event_status	= strtolower($this_time_arr[($event_length[$thisday][$i]['key'])]['status']);
								if ($event_calno > $unique_colors) $event_calno = ($event_calno - $unique_colors);
								if ($event_status != '') {
						  			$confirmed = '<img src="images/'.$event_status.'.gif" width="9" height="9" alt="" border="0" hspace="0" vspace="0" />&nbsp;';
						  		}
								$colspan_width = round((80 / $nbrGridCols[$thisday]) * $drawWidth);
								$weekdisplay .= '<td width="'.$colspan_width.'" rowspan="' . $event_length[$thisday][$i]['length'] . '" colspan="' . $drawWidth . '" align="left" valign="top" class="eventbg2_'.$event_calno.'">'."\n";

								$event_end	= $this_time_arr[($event_length[$thisday][$i]["key"])]["end_unixtime"];
								 if (isset($this_time_arr[($event_length[$thisday][$i]["key"])]['display_end'])) $event_end = strtotime ($this_time_arr[($event_length[$thisday][$i]["key"])]['display_end']);
								$event_end 	= date ($timeFormat, $event_end);
							  
								// Start drawing the event
								$event_temp  = $loop_event;
								$event 		 = openevent($event_calna, $event_start, $event_end, $this_time_arr[($event_length[$thisday][$i]["key"])], $week_events_lines, 25, '', '', 'ps', $event_url);
								$event_temp   = str_replace('{EVENT}', $event, $event_temp);
								$event_temp   = str_replace('{EVENT_START}', $event_start, $event_temp);
								$event_temp   = str_replace('{CONFIRMED}', $confirmed, $event_temp);
								$event_temp   = str_replace('{EVENT_CALNO}', $event_calno, $event_temp);
								$weekdisplay .= $event_temp;
								$weekdisplay .= '</td>';
								// End event drawing
						  
								break;
							case "started":
								break;
							case "ended":
								$weekdisplay .= '<td colspan="' . $drawWidth . '" '.$class.'>&nbsp;</td>';
								break;
						}
						$event_length[$thisday][$i]["length"]--;
						if ($event_length[$thisday][$i]["length"] == 0) {
							$event_length[$thisday][$i]["state"] = "ended";
						}
					}
					//fill emtpy space on the right
					if ($emptyWidth > 0) {
						$weekdisplay .= "<td colspan=\"" . $emptyWidth . "\" $class>&nbsp;</td>\n";
					}
					while (isset($event_length[$thisday][(sizeof($event_length[$thisday]) - 1)]["state"]) && $event_length[$thisday][(sizeof($event_length[$thisday]) - 1)]["state"] == "ended") {
						array_pop($event_length[$thisday]);
					}
				}
				$thisdate = ($thisdate + (25 * 60 * 60));
			}
			$weekdisplay .= "</tr>\n";
		}
		
		$this->page = preg_replace('!<\!-- loop row on -->(.*)<\!-- loop event off -->!is', $weekdisplay, $this->page);
		
		
		
	}
	
	function draw_day($template_p) {
		global $template, $getdate, $cal, $master_array, $unique_colors, $daysofweek_lang, $week_start_day, $dateFormat_week_list, $current_view, $day_array, $timeFormat, $gridLength, $day_start;
		
		// Replaces the allday events
		$replace = '';
		if (is_array($master_array[$getdate]['-1'])) {
			preg_match("!<\!-- loop allday on -->(.*)<\!-- loop allday off -->!is", $this->page, $match1);
			$loop_ad = trim($match1[1]);
			foreach ($master_array[$getdate]['-1'] as $allday) {
				$event_calno  	= $allday['calnumber'];
				$event_calna  	= $allday['calname'];
				$event_url	   	= $allday['url'];
				if ($event_calno > $unique_colors) $event_calno = ($event_calno - $unique_colors);
				$event 			= openevent($event_calna, '', '', $allday, 0, '', '', '', '', $event_url);
				$loop_tmp 		= str_replace('{ALLDAY}', $event, $loop_ad);
				$loop_tmp 		= str_replace('{CALNO}', $event_calno, $loop_tmp);
				$replace		.= $loop_tmp;
			}
		}
		$this->page = preg_replace('!<\!-- loop allday on -->(.*)<\!-- loop allday off -->!is', $replace, $this->page);
	
		// Replaces the daysofweek
		preg_match("!<\!-- loop daysofweek on -->(.*)<\!-- loop daysofweek off -->!is", $this->page, $match1);
		$loop_dof = trim($match1[1]);
		$start_wt		 	= strtotime(dateOfWeek($getdate, $week_start_day));
		$start_day 			= strtotime($week_start_day);
		for ($i=0; $i<7; $i++) {
			$day_num 		= date("w", $start_day);
			$daylink		= date('Ymd', $start_wt);
			if ($current_view == 'day') {
				$weekday 		= $daysofweek_lang[$day_num];
			} else {
				$weekday = localizeDate($dateFormat_week_list, strtotime($daylink));
			}	
			if ($daylink == $getdate) {
				$row1 = 'rowToday';
				$row2 = 'rowOn';
				$row3 = 'rowToday';
			} else {
				$row1 = 'rowOff';
				$row2 = 'rowOn';
				$row3 = 'rowOff';
			}
			$start_day 		= strtotime("+1 day", $start_day);
			$start_wt 		= strtotime("+1 day", $start_wt);
			$search			= array('{DAY}', '{DAYLINK}', '{ROW1}', '{ROW2}', '{ROW3}');
			$replace		= array($weekday, $daylink, $row1, $row2, $row3);
			$loop_tmp 		= str_replace($search, $replace, $loop_dof);
			$weekday_loop  .= $loop_tmp;
		}
		$this->page = preg_replace('!<\!-- loop daysofweek on -->(.*)<\!-- loop daysofweek off -->!is', $weekday_loop, $this->page);
		
		// Build the body
		$dayborder = 0;

		$nbrGridCols = 1;
		if (isset($master_array[($getdate)])) {
			foreach($master_array[($getdate)] as $ovlKey => $ovlValue) {
				if ($ovlKey != '-1') {
					foreach($ovlValue as $ovl2Value) {
						$nbrGridCols = kgv($nbrGridCols, ($ovl2Value['event_overlap'] + 1));
					}
				}
			} 
		}
		preg_match("!<\!-- loop row on -->(.*)<\!-- loop row off -->!is", $this->page, $match2);
		preg_match("!<\!-- loop event on -->(.*)<\!-- loop event off -->!is", $this->page, $match3);
		$loop_hours = trim($match2[1]);
		$loop_event = trim($match3[1]);

		$event_length = array ();
		$border = 0;
		preg_match('/([0-9]{4})([0-9]{2})([0-9]{2})/', $getdate, $day_array2);
		$this_day = $day_array2[3]; 
		$this_month = $day_array2[2];
		$this_year = $day_array2[1];
		foreach ($day_array as $key) {
			preg_match('/([0-9]{2})([0-9]{2})/', $key, $regs_tmp);
			$cal_time = $key;
			$key = mktime($regs_tmp[1],$regs_tmp[2],0,$this_month,$this_day,$this_year);
			$key = date ($timeFormat, $key);
			unset($this_time_arr);
			
			// add events that overlap the start time
			if (isset($master_array[$getdate][$cal_time]) && sizeof($master_array[$getdate][$cal_time]) > 0) {
				$this_time_arr = $master_array[$getdate][$cal_time];
			}
			
			// add events that overlap $day_start instead of cutting them out completely
			if (($day_start == $cal_time) && (isset($master_array[$getdate]))) {
				foreach($master_array[$getdate] as $time_key => $time_arr) {
					if ((int)$time_key < (int)$cal_time && is_array($time_arr) && $time_key != '-1') {
						foreach($time_arr as $event_tmp) {
							if ((int)$event_tmp['event_end'] > (int)$cal_time) {
								$this_time_arr[] = $event_tmp;
							}
						}
					} else {
						break;
					}
				}
			}																		
			
			// check for eventstart 
			if (isset($this_time_arr) && sizeof($this_time_arr) > 0) {
				foreach ($this_time_arr as $eventKey => $loopevent) {
					$drawEvent = drawEventTimes ($cal_time, $loopevent['event_end']);
					$j = 0;
					while (isset($event_length[$j])) {
						if ($event_length[$j]['state'] == 'ended') {
							$event_length[$j] = array ('length' => ($drawEvent['draw_length'] / $gridLength), 'key' => $eventKey, 'overlap' => $loopevent['event_overlap'],'state' => 'begin');
							break;
						}
						$j++;
					}
					if ($j == sizeof($event_length)) {
						array_push ($event_length, array ('length' => ($drawEvent['draw_length'] / $gridLength), 'key' => $eventKey, 'overlap' => $loopevent['event_overlap'],'state' => 'begin'));
					}
				}
			}
			if (preg_match('/([0-9]{1,2}):00/', $key)) {
				$daydisplay .= '<tr>'."\n";
				$daydisplay .= '<td rowspan="' . (60 / $gridLength) . '" align="center" valign="top" width="60" class="timeborder">'.$key.'</td>'."\n";
				$daydisplay .= '<td bgcolor="#a1a5a9" width="1" height="' . $gridLength . '"></td>'."\n";
			} elseif($cal_time == $day_start) {
				$size_tmp = 60 - (int)substr($cal_time,2,2);
				$daydisplay .= '<tr>'."\n";
				$daydisplay .= "<td rowspan=\"" . ($size_tmp / $gridLength) . "\" align=\"center\" valign=\"top\" width=\"60\" class=\"timeborder\">$key</td>\n";
				$daydisplay .= '<td bgcolor="#a1a5a9" width="1" height="' . $gridLength . '"></td>'."\n";
			} else {
				$daydisplay .= '<tr>'."\n";
				$daydisplay .= '<td bgcolor="#a1a5a9" width="1" height="' . $gridLength . '"></td>'."\n";
			}
			if ($dayborder == 0) {
				$class = ' class="dayborder"';
				$dayborder++;
			} else {
				$class = ' class="dayborder2"';
				$dayborder = 0;
			}
			if (sizeof($event_length) == 0) {
				$daydisplay .= '<td colspan="' . $nbrGridCols . '" '.$class.'>&nbsp;</td>'."\n";
				
			} else {
				$emptyWidth = $nbrGridCols;
				for ($i=0;$i<sizeof($event_length);$i++) {
					$drawWidth = $nbrGridCols / ($event_length[$i]['overlap'] + 1);
					$emptyWidth = $emptyWidth - $drawWidth;
					switch ($event_length[$i]['state']) {
						case 'begin':
						  $event_length[$i]['state'] = 'started';
						  $event_start 	= strtotime ($this_time_arr[($event_length[$i]['key'])]['event_start']);
						  $event_end	= strtotime ($this_time_arr[($event_length[$i]['key'])]['event_end']);
						  if (isset($this_time_arr[($event_length[$i]['key'])]['display_end'])) $event_end = strtotime ($this_time_arr[($event_length[$i]['key'])]['display_end']);
						  $event_start 	= date ($timeFormat, $event_start);
						  $event_end	= date ($timeFormat, $event_end);
						  $event_calno  = $this_time_arr[($event_length[$i]['key'])]['calnumber'];
						  $event_recur  = $this_time_arr[($event_length[$i]['key'])]['recur'];
						  $event_status = strtolower($this_time_arr[($event_length[$i]['key'])]['status']);
						  if ($event_calno > $unique_colors) $event_calno = ($event_calno - $unique_colors);
						  if ($event_status != '') {
						  	$confirmed = '<img src="images/'.$event_status.'.gif" width="9" height="9" alt="" border="0" hspace="0" vspace="0" />&nbsp;';
						  } elseif (is_array($event_recur)) {
						  	$confirmed = '<img src="images/recurring.gif" width="9" height="9" alt="" border="0" hspace="0" vspace="0" />&nbsp;';
						  }
						  $colspan_width = round((460 / $nbrGridCols) * $drawWidth);
						  $daydisplay .= '<td rowspan="' . $event_length[$i]['length'] . '" width="'.$colspan_width.'" colspan="' . $drawWidth . '" align="left" valign="top" class="eventbg2_'.$event_calno.'">'."\n";
						  
						  // Start drawing the event
						  $event_temp  = $loop_event;
						  $event_calna = $this_time_arr[($event_length[$i]['key'])]['calname'];
						  $event_url   = $this_time_arr[($event_length[$i]['key'])]['url'];
						  $event 	   = openevent($event_calna, $event_start, $event_end, $this_time_arr[($event_length[$i]['key'])], '', 0, '', '', 'ps', $event_url);
						  $event_temp   = str_replace('{EVENT}', $event, $event_temp);
						  $event_temp   = str_replace('{EVENT_START}', $event_start, $event_temp);
						  $event_temp   = str_replace('{EVENT_END}', $event_end, $event_temp);
						  $event_temp   = str_replace('{CONFIRMED}', $confirmed, $event_temp);
						  $event_temp   = str_replace('{EVENT_CALNO}', $event_calno, $event_temp);
						  $daydisplay .= $event_temp;
						  $daydisplay .= '</td>';
						  // End event drawing
						  
						  break;
						case 'started':
							break;
						case 'ended':
							$daydisplay .= '<td colspan="' . $drawWidth . '" ' . $class . '>&nbsp;</td>'."\n";
							break;
					}
					$event_length[$i]['length']--;
					if ($event_length[$i]['length'] == 0) {
						$event_length[$i]['state'] = 'ended';
					}
				}
				//fill emtpy space on the right
				if ($emptyWidth > 0) {
					$daydisplay .= '<td colspan="' . $emptyWidth . '" ' . $class . '>&nbsp;</td>'."\n";
				}
				while (isset($event_length[(sizeof($event_length) - 1)]) && $event_length[(sizeof($event_length) - 1)]['state'] == 'ended') {
					array_pop($event_length);
				}
				
			}
			$daydisplay .= '</tr>'."\n";
		}
		
		$this->page = preg_replace('!<\!-- loop row on -->(.*)<\!-- loop event off -->!is', $daydisplay, $this->page);
	
	
	}
	
	function tomorrows_events() {
		global $template, $getdate, $master_array, $next_day, $timeFormat, $tomorrows_events_lines;
		
		preg_match("!<\!-- switch t_allday on -->(.*)<\!-- switch t_allday off -->!is", $this->page, $match1);
		preg_match("!<\!-- switch t_event on -->(.*)<\!-- switch t_event off -->!is", $this->page, $match2);
		$loop_t_ad 	= trim($match1[1]);
		$loop_t_e 	= trim($match2[1]);
		$return_adtmp	= '';
		$return_etmp	= '';
		
		if (is_array($master_array[$next_day]) && sizeof($master_array[$next_day]) > 0) {
			foreach ($master_array[$next_day] as $event_times) {
				foreach ($event_times as $val) {
					$event_text = stripslashes(urldecode($val["event_text"]));
					$event_text = strip_tags($event_text, '<b><i><u>');
					if ($event_text != "") {	
						$event_start 	= $val["event_start"];
						$event_end 		= $val["event_end"];
						$event_calna 	= $val["calname"];
						$event_url 		= $val["url"];
						$event_start 	= date ($timeFormat, @strtotime ($event_start));
						$event_end 		= date ($timeFormat, @strtotime ($event_end));
						if (!isset($val["event_start"])) { 
							$event_start = $lang['l_all_day']; 
							$event_end = ''; 
							$return_adtmp = openevent($event_calna, $event_start, $event_end, $val, $tomorrows_events_lines, 21, '', '', 'psf', $event_url); 
							$replace_ad 	.= str_replace('{T_ALLDAY}', $return_adtmp, $loop_t_ad);
						} else { 
							$return_etmp 	= openevent($event_calna, $event_start, $event_end, $val, $tomorrows_events_lines, 21, '', '', 'ps3', $event_url); 
							$replace_e 		.= str_replace('{T_EVENT}', $return_etmp, $loop_t_e);
						}
					}
				}
			}
		
			$this->page = preg_replace('!<\!-- switch t_allday on -->(.*)<\!-- switch t_allday off -->!is', $replace_ad, $this->page);
			$this->page = preg_replace('!<\!-- switch t_event on -->(.*)<\!-- switch t_event off -->!is', $replace_e, $this->page);		
	
		} else {
		
			$this->page = preg_replace('!<\!-- switch tomorrows_events on -->(.*)<\!-- switch tomorrows_events off -->!is', '', $this->page);
		
		}
	}
	
	function get_vtodo() {
		global $template, $getdate, $master_array, $next_day, $timeFormat, $tomorrows_events_lines;
		
		preg_match("!<\!-- switch show_completed on -->(.*)<\!-- switch show_completed off -->!is", $this->page, $match1);
		preg_match("!<\!-- switch show_important on -->(.*)<\!-- switch show_important off -->!is", $this->page, $match2);
		preg_match("!<\!-- switch show_normal on -->(.*)<\!-- switch show_normal off -->!is", $this->page, $match3);
		$completed 	= trim($match1[1]);
		$important 	= trim($match2[1]);
		$normal 	= trim($match3[1]);
		$nugget2	= '';
		
		if (is_array($master_array['-2'])) {
			foreach ($master_array['-2'] as $vtodo_times) {
				foreach ($vtodo_times as $val) {
					$vtodo_text = stripslashes(urldecode($val["vtodo_text"]));
					if ($vtodo_text != "") {	
						if (isset($val["description"])) { 
							$description 	= urldecode($val["description"]);
						} else {
							$description = ""; 
						}
						$completed_date = $val['completed_date'];
						$event_calna 	= $val['calname'];
						$status 		= $val["status"];
						$priority 		= $val['priority'];
						$start_date 	= $val["start_date"];
						$due_date 		= $val['due_date'];
						$vtodo_array 	= array(
							'cal'			=> $event_calna,
							'completed_date'=> $completed_date,
							'description'	=> $description,
							'due_date'		=> $due_date,
							'priority'		=> $priority,
							'start_date'	=> $start_date,
							'status'		=> $status,
							'vtodo_text' 	=> $vtodo_text);

						$vtodo_array 	= base64_encode(serialize($vtodo_array));
						$vtodo_text 	= word_wrap(strip_tags(str_replace('<br />',' ',$vtodo_text), '<b><i><u>'), 21, $tomorrows_events_lines);
						$data 			= array ('{VTODO_TEXT}', '{VTODO_ARRAY}');
						$rep			= array ($vtodo_text, $vtodo_array);
						
						// Reset this TODO's category.
						$temp = '';
						if ($status == 'COMPLETED' || (isset($val['completed_date']) && isset($val['completed_time']))) {
							if ($show_completed == 'yes') {
								$temp = $completed;
							}
						} elseif (isset($val['priority']) && ($val['priority'] != 0) && ($val['priority'] <= 5)) {
							$temp = $important;
						} else {
							$temp = $normal;
						}
						
						// Do not include TODOs which do not have the
						// category set.
						if ($temp != '') {
							$nugget1 = str_replace($data, $rep, $temp);
							$nugget2 .= $nugget1;
						}
					}
				}
			}	
		}
		
		// If there are no TODO items, completely hide the TODO list.
		if ($nugget2 == '') {
			$this->page = preg_replace('!<\!-- switch vtodo on -->(.*)<\!-- switch vtodo off -->!is', '', $this->page);
		}
		
		// Otherwise display the list of TODOs.
		else {
			$this->page = preg_replace('!<\!-- switch show_completed on -->(.*)<\!-- switch show_normal off -->!is', $nugget2, $this->page);
		}
	}
	
	function draw_month($template_p, $offset = '+0', $type) {
		global $template, $getdate, $master_array, $this_year, $this_month, $unique_colors, $dateFormat_month, $week_start_day, $cal, $minical_view, $month_event_lines, $daysofweekreallyshort_lang, $daysofweekshort_lang, $daysofweek_lang, $timeFormat_small, $timeFormat;
		preg_match("!<\!-- loop weekday on -->(.*)<\!-- loop weekday off -->!is", $template_p, $match1);
		preg_match("!<\!-- loop monthdays on -->(.*)<\!-- loop monthdays off -->!is", $template_p, $match2);
		preg_match("!<\!-- switch notthismonth on -->(.*)<\!-- switch notthismonth off -->!is", $template_p, $match3);
		preg_match("!<\!-- switch istoday on -->(.*)<\!-- switch istoday off -->!is", $template_p, $match4);
		preg_match("!<\!-- switch ismonth on -->(.*)<\!-- switch ismonth off -->!is", $template_p, $match5);
		preg_match("!<\!-- loop monthweeks on -->(.*)<\!-- loop monthdays on -->!is", $template_p, $match6);
		preg_match("!<\!-- loop monthdays off -->(.*)<\!-- loop monthweeks off -->!is", $template_p, $match7);		
				
		$loop_wd 			= trim($match1[1]);
		$loop_md 			= trim($match2[1]);
		$t_month[0]			= trim($match3[1]);
		$t_month[1]			= trim($match4[1]);
		$t_month[2] 		= trim($match5[1]);
		$startweek 			= trim($match6[1]);
		$endweek 			= trim($match7[1]);
		if ($type != 'medium') {
			$fake_getdate_time 	= strtotime($this_year.'-'.$this_month.'-15');
			$fake_getdate_time	= strtotime("$offset month", $fake_getdate_time);
		} else {
			$fake_getdate_time 	= strtotime($this_year.'-'.$offset.'-15');
		}
		
		$start_day 			= strtotime($week_start_day);
		$month_title 		= localizeDate ($dateFormat_month, $fake_getdate_time);
		$month_date 		= date ('Ymd', $fake_getdate_time);

		if ($type == 'small') {
			$langtype = $daysofweekreallyshort_lang;
		} elseif ($type == 'medium') {
			$langtype = $daysofweekshort_lang;
		} elseif ($type == 'large') {
			$langtype = $daysofweek_lang;	
		}
		
		for ($i=0; $i<7; $i++) {
			$day_num 		= date("w", $start_day);
			$weekday 		= $langtype[$day_num];
			$start_day 		= strtotime("+1 day", $start_day);
			$loop_tmp 		= str_replace('{LOOP_WEEKDAY}', $weekday, $loop_wd);
			$weekday_loop  .= $loop_tmp;
		}
		
		$minical_month 		= date("m", $fake_getdate_time);
		$minical_year 		= date("Y", $fake_getdate_time);
		$first_of_month 	= $minical_year.$minical_month."01";
		$start_day 			= strtotime(dateOfWeek($first_of_month, $week_start_day));
		$i 					= 0;
		$whole_month 		= TRUE;
		
		do {
			if ($i == 0) $middle .= $startweek; $i++;
			#$temp_middle			= $loop_md;
			$switch					= array('ALLDAY' => '', 'CAL' => $cal, 'MINICAL_VIEW' => $minical_view);
			$check_month 			= date ("m", $start_day);
			$daylink 				= date ("Ymd", $start_day);
			$switch['DAY']	 		= date ("j", $start_day);
			$switch['DAYLINK'] 		= date ("Ymd", $start_day);
			if ($check_month != $minical_month) {
				$temp = $t_month[0];
			} elseif ($daylink == $getdate) {
				$temp = $t_month[1];
			} else {
				$temp = $t_month[2];
			}
			if ($master_array[$daylink]) {
				if ($type != 'small') {
					foreach ($master_array[$daylink] as $event_times) {
						foreach ($event_times as $val) {
							$event_calno 	= $val['calnumber'];
							if ($event_calno > $unique_colors) $event_calno = ($event_calno - $unique_colors);
							$event_calna 	= $val['calname'];
							$event_url 		= $val['url'];
							if (!isset($val['event_start'])) {
								if ($type == 'large') {
									$switch['ALLDAY'] .= '<div class="V10"><img src="templates/'.$template.'/images/monthdot_'.$event_calno.'.gif" alt="" width="9" height="9" border="0" />';
									$switch['ALLDAY'] .= openevent($event_calna, '', '', $val, $month_event_lines, 15, '', '', 'psf', $event_url);
									$switch['ALLDAY'] .= '</div>';
								} else {
									$switch['ALLDAY'] .= '<img src="templates/'.$template.'/images/allday_dot.gif" alt=" " width="11" height="10" border="0" />';
								}
							} else {	
								$event_start = $val['start_unixtime'];
								$event_end 	 = (isset($val['display_end'])) ? $val['display_end'] : $val["event_end"];
								$event_start = date($timeFormat, $val['start_unixtime']);
								$start2		 = date($timeFormat_small, $val['start_unixtime']);
								$event_end   = date($timeFormat, @strtotime ($event_end));
								if ($type == 'large') {
									$switch['EVENT'] .= '<div class="V9"><img src="templates/'.$template.'/images/monthdot_'.$event_calno.'.gif" alt="" width="9" height="9" border="0" />';
									$switch['EVENT'] .= openevent($event_calna, $event_start, $event_end, $val, $month_event_lines, 10, "$start2 ", '', 'ps3', $event_url).'<br />';
									$switch['EVENT'] .= '</div>';
								} else {
									$switch['EVENT'] = '<img src="templates/'.$template.'/images/event_dot.gif" alt=" " width="11" height="10" border="0" />';
								}
							}
						}
					}
				}
			}
			
			$switch['EVENT'] = (isset($switch['EVENT'])) ? $switch['EVENT'] : '';
			$switch['ALLDAY'] = (isset($switch['ALLDAY'])) ? $switch['ALLDAY'] : '';
			
			#print_r($switch);
			
			foreach ($switch as $tag => $data) {
				$temp = str_replace('{'.$tag.'}', $data, $temp);
			}
			$middle .= $temp;
			
			$start_day = strtotime("+1 day", $start_day); 
			if ($i == 7) { 
				$i = 0;
				$middle .= $endweek;
				$checkagain = date ("m", $start_day);
				if ($checkagain != $minical_month) $whole_month = FALSE;	
			}
		} while ($whole_month == TRUE); 
		
		$return = str_replace('<!-- loop weekday on -->'.$match1[1].'<!-- loop weekday off -->', $weekday_loop, $template_p);
		$return = preg_replace('!<\!-- loop monthweeks on -->(.*)<\!-- loop monthweeks off -->!is', $middle, $return);
		$return = str_replace('{MONTH_TITLE}', $month_title, $return);
		$return = str_replace('{CAL}', $cal, $return);
		$return = str_replace('{MONTH_DATE}', $month_date, $return);
		
		return $return;	
	}
	
	function monthbottom() {
		global $template, $getdate, $master_array, $this_year, $this_month, $cal, $timeFormat, $timeFormat_small, $dateFormat_week_list, $lang;
		preg_match("!<\!-- loop showbottomevents_odd on -->(.*)<\!-- loop showbottomevents_odd off -->!is", $this->page, $match1);
		preg_match("!<\!-- loop showbottomevents_even on -->(.*)<\!-- loop showbottomevents_even off -->!is", $this->page, $match2);
		
		$loop[0] 	= trim($match1[1]);
		$loop[1] 	= trim($match2[1]);
		
		$m_start = $this_year.$this_month.'01';
		$u_start = strtotime($m_start);
		$i=0;
		do {
			if (isset($master_array[$m_start])) {
				foreach ($master_array[$m_start] as $event_times) {
					$switch['CAL'] 			= $cal;
					$switch['START_DATE'] 	= localizeDate ($dateFormat_week_list, $u_start);
					foreach ($event_times as $val) {
						$switch['CALNAME'] 	= $val['calname'];
						$switch['URL'] 		= $val['url'];
						if (!isset($val['event_start'])) {
							$switch['START_TIME'] 	= $lang['l_all_day'];
							$switch['DESCRIPTION'] 	= urldecode($val['description']);
							$switch['EVENT_TEXT'] 	= openevent($switch['CALNAME'], '', '', $val, $month_event_lines, 15, '', '', 'psf', $switch['URL']);
						} else {	
							$event_start = $val['start_unixtime'];
							$event_end 	 = (isset($val['display_end'])) ? $val['display_end'] : $val["event_end"];
							$event_start = date($timeFormat, $val['start_unixtime']);
							$event_end   = date($timeFormat, @strtotime ($event_end));
							$switch['START_TIME'] 	= $event_start . ' - ' . $event_end;
							$switch['EVENT_TEXT'] 	= openevent($switch['CALNAME'], '', '', $val, 0, 15, '', '', 'psf', $switch['URL']);
							$switch['DESCRIPTION'] 	= urldecode($val['description']);
						}
						if ($switch['EVENT_TEXT'] != '') {
							$switch['DAYLINK'] = $m_start;
							$temp = $loop[$i];
							foreach ($switch as $tag => $data) {
								$temp = str_replace('{'.$tag.'}', $data, $temp);
							}
							$middle .= $temp;
							$i = ($i == 1) ? 0 : 1;
						}
					}
				}
			}
			$u_start 	 = strtotime("+1 day", $u_start);
			$m_start 	 = date('Ymd', $u_start);
			$check_month = date('m', $u_start);
			unset ($switch);
		} while ($this_month == $check_month);
		
		$this->page = preg_replace('!<\!-- loop showbottomevents_odd on -->(.*)<\!-- loop showbottomevents_even off -->!is', $middle, $this->page);
			
	}
	
	function Page($template = 'std.tpl') {
		if (file_exists($template))
			$this->page = join('', file($template));
		else
			die("Template file $template not found.");
		}

	function parse($file) {
		ob_start();
		include($file);
		$buffer = ob_get_contents();
		ob_end_clean();
		return $buffer;
	}
	
	function replace_tags($tags = array()) {
		if (sizeof($tags) > 0)
			foreach ($tags as $tag => $data) {
				
				// This opens up another template and parses it as well.
				$data = (file_exists($data)) ? $this->parse($data) : $data;
				
				// This removes any unfilled tags
				if (!$data) {
					$this->page = preg_replace('!<\!-- switch ' . $tag . ' on -->(.*)<\!-- switch ' . $tag . ' off -->!is', '', $this->page);
				}
				
				// This replaces any tags
				$this->page = str_replace('{' . strtoupper($tag) . '}', $data, $this->page);
			}
			
		else
			die('No tags designated for replacement.');
		}
	
	function output() {
		global $template, $php_started, $lang, $enable_rss, $template_started;
		
		// Looks for {MONTH} before sending page out
		preg_match_all ('!\{MONTH_([A-Z]*)\|?([+|-])([0-9]{1,2})\}!is', $this->page, $match);
		if (sizeof($match) > 0) {
			$i=0;
			foreach ($match[1] as $key => $val) {
				if ($match[1][$i] == 'SMALL') {
					$template_file 	= $this->parse('templates/'.$template.'/month_small.tpl');
					$type 			= 'small';
					$offset 		= $match[2][$i].$match[3][$i];
				} elseif ($match[1][$i] == 'MEDIUM') {
					$template_file 	= $this->parse('templates/'.$template.'/month_medium.tpl');
					$type 			= 'medium';
					$offset 		= $match[3][$i];
				} else {
					$template_file 	= $this->parse('templates/'.$template.'/month_large.tpl');
					$type 			= 'large';
					$offset 		= $match[2][$i].$match[3][$i];
				}
				$data = $this->draw_month($template_file, $offset, $type);
				$this->page = str_replace($match[0][$i], $data, $this->page);
				$i++;
			}
		}
		
		$php_ended = @getmicrotime();
		$generated1 = number_format(($php_ended-$php_started),3);
		$generated2 = number_format(($php_ended-$template_started),3);
		$this->page = str_replace('{GENERATED1}', $generated1, $this->page);
		$this->page = str_replace('{GENERATED2}', $generated2, $this->page);
		if ($enable_rss != 'yes') {
			$this->page = preg_replace('!<\!-- switch rss_powered on -->(.*)<\!-- switch rss_powered off -->!is', '', $this->page);
		} else {
			$this->page = str_replace('{BASE}', BASE, $this->page);
		}
		print($this->page);
	}
}
?>
