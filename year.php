<?php

define('BASE', './');
include_once(BASE.'functions/ical_parser.php');
require_once(BASE.'functions/template.php');
$current_view = 'year';

ereg ("([0-9]{4})([0-9]{2})([0-9]{2})", $getdate, $day_array2);
$this_day = $day_array2[3]; 
$this_month = $day_array2[2];
$this_year = $day_array2[1];
$display_date = $day_array2[1];

$unix_time = strtotime($getdate);
$startYear = strtotime ($this_year);
$checkad = date ("Ymd", $startYear);

$next_year = strtotime ("+1 year", strtotime("$getdate"));
$next_year = date ("Ymd", $next_year);
$prev_year = strtotime ("-1 year", strtotime("$getdate"));
$prev_year = date ("Ymd", $prev_year);

$thisday2 = localizeDate($dateFormat_week_list, $unix_time);

$page = new Page(BASE.'templates/'.$template.'/year.tpl');

$page->replace_tags(array(
	'header'			=> BASE.'templates/'.$template.'/header.tpl',
	'footer'			=> BASE.'templates/'.$template.'/footer.tpl',
	'template'			=> $template,
	'cal'				=> $cal,
	'getdate'			=> $getdate,
	'calendar_name'		=> $calendar_name,
	'display_date'		=> $display_date,
	'rss_powered'	 	=> $rss_powered,
	'rss_available' 	=> '',
	'rss_valid' 		=> '',
	'todo_available' 	=> '',
	'event_js' 			=> '',
	'show_search' 		=> '',
	'next_month' 		=> $next_month,
	'prev_month'	 	=> $prev_month,
	'show_goto' 		=> '',
	'is_logged_in' 		=> '',
	'list_icals' 		=> $list_icals,
	'list_years' 		=> $list_years,
	'list_months' 		=> $list_months,
	'list_weeks' 		=> $list_weeks,
	'style_select' 		=> $style_select,
	'generated'	 		=> $generated
			
	));
	
$page->output();

?>