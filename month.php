<?php 
define('BASE', './');
include_once(BASE.'functions/ical_parser.php');
require_once(BASE.'functions/template.php');
$current_view = "month";
if ($minical_view == 'current') $minical_view = 'month';

ereg ("([0-9]{4})([0-9]{2})([0-9]{2})", $getdate, $day_array2);
$this_day 				= $day_array2[3]; 
$this_month 			= $day_array2[2];
$this_year 				= $day_array2[1];

$unix_time 				= strtotime($getdate);
$today_today 			= date('Ymd', strtotime("now + $second_offset seconds")); 
$tomorrows_date 		= date( "Ymd", strtotime("+1 day",  $unix_time));
$yesterdays_date 		= date( "Ymd", strtotime("-1 day",  $unix_time));

// find out next month
$next_month_month 		= ($this_month+1 == '13') ? '1' : ($this_month+1);
$next_month_day 		= $this_day;
$next_month_year 		= ($next_month_month == '1') ? ($this_year+1) : $this_year;
while (!checkdate($next_month_month,$next_month_day,$next_month_year)) $next_month_day--;
$next_month_time 		= mktime(0,0,0,$next_month_month,$next_month_day,$next_month_year);

// find out last month
$prev_month_month 		= ($this_month-1 == '0') ? '12' : ($this_month-1);
$prev_month_day 		= $this_day;
$prev_month_year 		= ($prev_month_month == '12') ? ($this_year-1) : $this_year;
while (!checkdate($prev_month_month,$prev_month_day,$prev_month_year)) $prev_month_day--;
$prev_month_time 		= mktime(0,0,0,$prev_month_month,$prev_month_day,$prev_month_year);

$next_month 			= date("Ymd", $next_month_time);
$prev_month 			= date("Ymd", $prev_month_time);
$display_date 			= localizeDate ($dateFormat_month, $unix_time);
$parse_month 			= date ("Ym", $unix_time);
$first_of_month 		= $this_year.$this_month."01";
$start_month_day 		= dateOfWeek($first_of_month, $week_start_day);
$thisday2 				= localizeDate($dateFormat_week_list, $unix_time);
$num_of_events2 			= 0;

// select for calendars
$list_icals 	= display_ical_list(availableCalendars($username, $password, $ALL_CALENDARS_COMBINED));
$list_years 	= list_years();
$list_months 	= list_months();
$list_weeks 	= list_weeks();

$php_ended = getmicrotime();

$generated = number_format(($php_ended-$php_started),3);
//$generated = sprintf($search_took_lang,$search_took);

$page = new Page(BASE.'templates/'.$template.'/month.tpl');

$page->replace_tags(array(
	'header'			=> BASE.'templates/'.$template.'/header.tpl',
	'footer'			=> BASE.'templates/'.$template.'/footer.tpl',
	'calendar_nav'		=> BASE.'templates/'.$template.'/calendar_nav.tpl',
	'template'			=> $template,
	'cal'				=> $cal,
	'getdate'			=> $getdate,
	'calendar_name'		=> $calendar_name,
	'display_date'		=> $display_date,
	'rss_powered'	 	=> $rss_powered,
	'rss_available' 	=> '',
	'rss_valid' 		=> '',
	'todo_available' 	=> '',
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
	
$page->replace_langs($lang);

$page->output();



?>