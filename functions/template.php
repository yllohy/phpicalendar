<?php

//print_r($master_array);



class Page {
	var $page;
	function draw_month($template_p, $offset = '+0', $type) {
		global $template, $getdate, $master_array, $this_year, $this_month, $dateFormat_month, $week_start_day, $cal, $minical_view, $daysofweekreallyshort_lang, $daysofweekshort_lang, $daysofweek_lang, $timeFormat_small, $timeFormat;
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
							$event_calno 	= $val['calnumber'];
							$event_calna 	= $val['calname'];
							$event_url 		= $val['url'];
							if (!isset($val['event_start'])) {
								if ($type == 'large') {
									$switch['ALLDAY'] .= openevent($event_calna, '', '', $val, $month_event_lines, 15, '', '', 'psf', $event_url).'<br>';
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
									$switch['EVENT'] .= openevent($event_calna, $event_start, $event_end, $val, $month_event_lines, 10, "$start2 ", '', 'ps3', $event_url).'<br>';
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
				#echo $tag.'<br>';
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
		
		return $return;
		
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
		// Small month builder
		preg_match_all ('!(\{MONTH_SMALL\|[+|-][0-9]\})!is', $this->page, $match);
		if (sizeof($match) > 0) {
			$template_file = $this->parse('templates/'.$template.'/month_small.tpl');
			foreach ($match[1] as $key => $val) {
				$offset = str_replace('}', '', $val);
				$offset = str_replace('{MONTH_SMALL|', '', $offset);
				$data = $this->draw_month($template_file, $offset, 'small');
				$this->page = str_replace($val, $data, $this->page);
			}
		}
		
		// Medium month builder
		preg_match_all ('!(\{MONTH_MEDIUM\|[0-9][0-9]\})!is', $this->page, $match);
		if (sizeof($match) > 0) {
			$template_file = $this->parse('templates/'.$template.'/month_medium.tpl');
			foreach ($match[1] as $key => $val) {
				$offset = str_replace('}', '', $val);
				$offset = str_replace('{MONTH_MEDIUM|', '', $offset);
				$data = $this->draw_month($template_file, $offset, 'medium');
				$this->page = str_replace($val, $data, $this->page);
			}
		}
		
		// Large month builder
		preg_match_all ('!(\{MONTH_LARGE\|[+|-][0-9]\})!is', $this->page, $match);
		if (sizeof($match) > 0) {
			$template_file = $this->parse('templates/'.$template.'/month_large.tpl');
			foreach ($match[1] as $key => $val) {
				$offset = str_replace('}', '', $val);
				$offset = str_replace('{MONTH_LARGE|', '', $offset);
				$data = $this->draw_month($template_file, $offset, 'large');
				$this->page = str_replace($val, $data, $this->page);
			}
		}
		
		// Replace any languages
		foreach ($lang as $tag => $data) {
			$this->page = str_replace('{' . strtoupper($tag) . '}', $data, $this->page);
		}
		
		$php_ended = getmicrotime();
		$generated = number_format(($php_ended-$php_started),3);
		echo $generated;
		print($this->page);
	}
}
?> 