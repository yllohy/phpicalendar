<?php

//print_r($master_array);

class Page {
	var $page;
	function draw_day($template_p) {
		global $template, $getdate, $cal, $master_array ;
		$replace = '';
		if (is_array($master_array[$getdate]['-1'])) {
			preg_match("!<\!-- loop allday on -->(.*)<\!-- loop allday off -->!is", $this->page, $match1);
			$loop_ad = trim($match1[1]);
			foreach ($master_array[$getdate]['-1'] as $allday) {
				$event_calno  	= $allday['calnumber'];
				$event_calna  	= $allday['calname'];
				$event_url	   	= $allday['url'];
				if ($event_calno < 1) $event_calno=1;
				if ($event_calno > 7) $event_calno=7;
				$event 			= openevent($event_calna, '', '', $allday, 0, '', '<span class="V10WB">', '</span>', 'psf', $url);
				$loop_tmp 		= str_replace('{EVENT}', $event, $loop_ad);
				$loop_tmp 		= str_replace('{CALNO}', $event_calno, $loop_tmp);
				$replace		.= $loop_tmp;
			}
		}
		$this->page = ereg_replace('<!-- loop allday on -->(.*)<!-- loop allday off -->', $replace, $this->page);
	}
	
	function draw_month($template_p, $offset = '+0', $type) {
		global $template, $getdate, $master_array, $this_year, $this_month, $dateFormat_month, $week_start_day, $cal, $minical_view, $month_event_lines, $daysofweekreallyshort_lang, $daysofweekshort_lang, $daysofweek_lang, $timeFormat_small, $timeFormat;
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
		$month_event_lines	= 0;
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
							$calno 			= $val['calnumber'];
							$event_calna 	= $val['calname'];
							$event_url 		= $val['url'];
							if (!isset($val['event_start'])) {
								if ($type == 'large') {
									$switch['ALLDAY'] .= '<div class="V10"><img src="templates/'.$template.'/images/monthdot_'.$calno.'.gif" alt="" width="9" height="9" border="0">';
									$switch['ALLDAY'] .= openevent($event_calna, '', '', $val, $month_event_lines, 15, '', '', 'psf', $event_url);
									$switch['ALLDAY'] .= '</span></div>';
								} else {
									$switch['ALLDAY'] .= '<img src="templates/'.$template.'/images/allday_dot.gif" alt=" " width="11" height="10" border="0">';
								}
							} else {	
								$event_start = $val['start_unixtime'];
								$event_end 	 = (isset($val['display_end'])) ? $val['display_end'] : $val["event_end"];
								$event_start = date($timeFormat, $val['start_unixtime']);
								$start2		 = date($timeFormat_small, $val['start_unixtime']);
								$event_end   = date($timeFormat, @strtotime ($event_end));
								if ($type == 'large') {
									$switch['EVENT'] .= '<div class="V9"><img src="templates/'.$template.'/images/monthdot_'.$calno.'.gif" alt="" width="9" height="9" border="0">';
									$switch['EVENT'] .= openevent($event_calna, $event_start, $event_end, $val, $month_event_lines, 10, "$start2 ", '', 'ps3', $event_url).'<br>';
									$switch['EVENT'] .= '</span></div>';
								} else {
									$switch['EVENT'] = '<img src="templates/'.$template.'/images/event_dot.gif" alt=" " width="11" height="10" border="0">';
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
		
		$return = preg_replace('!<\!-- loop weekday on -->(.*)<\!-- loop weekday off -->!is', $weekday_loop, $template_p);
		$return = ereg_replace('<!-- loop monthweeks on -->(.*)<!-- loop monthweeks off -->', $middle, $return);
		$return = str_replace('{MONTH_TITLE}', $month_title, $return);
		$return = str_replace('{CAL}', $cal, $return);
		
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
							$switch['EVENT_TEXT'] 	= openevent($event_calna, '', '', $val, $month_event_lines, 15, '', '', 'psf', $event_url);
						} else {	
							$event_start = $val['start_unixtime'];
							$event_end 	 = (isset($val['display_end'])) ? $val['display_end'] : $val["event_end"];
							$event_start = date($timeFormat, $val['start_unixtime']);
							$event_end   = date($timeFormat, @strtotime ($event_end));
							$switch['START_TIME'] 	= $event_start . ' - ' . $event_end;
							$switch['EVENT_TEXT'] 	= openevent($event_calna, '', '', $val, $month_event_lines, 15, '', '', 'psf', $event_url);
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
		
		$this->page = ereg_replace('<!-- loop showbottomevents_odd on -->(.*)<!-- loop showbottomevents_even off -->', $middle, $this->page);
			
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
					$this->page = ereg_replace('<!-- switch ' . $tag . ' on -->(.*)<!-- switch ' . $tag . ' off -->', '', $this->page);
				}
				
				// This replaces any tags
				$this->page = str_replace('{' . strtoupper($tag) . '}', $data, $this->page);
			}
			
		else
			die('No tags designated for replacement.');
		}
	
	function output() {
		global $template, $php_started, $lang;
		
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
		
		// Replace any languages
		foreach ($lang as $tag => $data) {
			$this->page = str_replace('{' . strtoupper($tag) . '}', $data, $this->page);
		}
		
		$php_ended = @getmicrotime();
		$generated = number_format(($php_ended-$php_started),3);
		$this->page = str_replace('{GENERATED}', $generated, $this->page);
		print($this->page);
	}
}
?> 