<?php

$current_view = "week";
define('BASE', './');
require_once(BASE.'functions/ical_parser.php');
require_once(BASE.'functions/list_functions.php');
require_once(BASE.'functions/template.php');
if ($minical_view == "current") $minical_view = "week";

$starttime 			= "0500";
$weekstart 			= 1;
$unix_time 			= strtotime($getdate);
$thisday2 			= localizeDate($dateFormat_week_list, $unix_time);
$today_today 		= date('Ymd', strtotime("now + $second_offset seconds")); 
$next_week 			= date("Ymd", strtotime("+1 week",  $unix_time));
$prev_week 			= date("Ymd", strtotime("-1 week",  $unix_time));
$tomorrows_date 	= date( "Ymd", strtotime("+1 day",  $unix_time));
$yesterdays_date 	= date( "Ymd", strtotime("-1 day",  $unix_time));
$start_week_time 	= strtotime(dateOfWeek($getdate, $week_start_day));
$end_week_time 		= $start_week_time + (6 * 25 * 60 * 60);
$start_week 		= localizeDate($dateFormat_week, $start_week_time);
$end_week 			= localizeDate($dateFormat_week, $end_week_time);
$display_date 		= "$start_week - $end_week";

// For the side months
ereg ("([0-9]{4})([0-9]{2})([0-9]{2})", $getdate, $day_array2);
$this_day 	= $day_array2[3]; 
$this_month = $day_array2[2];
$this_year 	= $day_array2[1];

// select for calendars
$list_icals 	= display_ical_list(availableCalendars($username, $password, $ALL_CALENDARS_COMBINED));
$list_years 	= list_years();
$list_months 	= list_months();
$list_weeks 	= list_weeks();
$list_jumps 	= list_jumps();
$list_calcolors = list_calcolors();

$page = new Page(BASE.'templates/'.$template.'/week.tpl');

$page->replace_tags(array(
	'header'			=> BASE.'templates/'.$template.'/header.tpl',
	'footer'			=> BASE.'templates/'.$template.'/footer.tpl',
	'sidebar'			=> BASE.'templates/'.$template.'/sidebar.tpl',
	'event_js'			=> BASE.'functions/event.js',
	'template'			=> $template,
	'cal'				=> $cal,
	'getdate'			=> $getdate,
	'calendar_name'		=> $calendar_name,
	'display_date'		=> $display_date,
	'rss_powered'	 	=> $rss_powered,
	'rss_available' 	=> '',
	'rss_valid' 		=> '',
	'todo_js' 			=> '',
	'show_search' 		=> '',
	'next_day' 			=> $next_day,
	'prev_day'	 		=> $prev_day,
	'show_goto' 		=> '',
	'is_logged_in' 		=> '',
	'list_icals' 		=> $list_icals,
	'list_years' 		=> $list_years,
	'list_months' 		=> $list_months,
	'list_weeks' 		=> $list_weeks,
	'list_jumps' 		=> $list_jumps,
	'legend'	 		=> $list_calcolors,
	'style_select' 		=> $style_select			
	));
	
$page->draw_day($this->page);

$page->output();

?>