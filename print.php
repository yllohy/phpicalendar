<?php
	
define('BASE', './');
require_once(BASE.'functions/ical_parser.php');
require_once(BASE.'functions/list_functions.php');
require_once(BASE.'functions/template.php');
$cal_displayname2 = $calendar_name . " $calendar_lang";
if (strlen($cal_displayname2) > 24) {
	$cal_displayname2 = substr("$cal_displayname2", 0, 21);
	$cal_displayname2 = $cal_displayname2 . "...";
}

$start_week_time 	= strtotime(dateOfWeek($getdate, $week_start_day));
$end_week_time 		= $start_week_time + (6 * 25 * 60 * 60);
$parse_month 		= date ("Ym", strtotime($getdate));
$printview 			= $HTTP_GET_VARS['printview'];
$cal_displayname 	= str_replace("32", " ", $cal);
$events_week 		= 0;
$unix_time 			= strtotime("$getdate");

if ($printview == 'day') {
	$display_date 	= localizeDate ($dateFormat_day, strtotime($getdate));
	$next 			= date("Ymd", strtotime("+1 day", $unix_time));
	$prev 			= date("Ymd", strtotime("-1 day", $unix_time));
	$zero_events 	= $no_events_day_lang;
	$print_next_nav = $next_day_lang;
	$print_prev_nav = $last_day_lang;
	$week_start		= '';
	$week_end		= '';
} elseif ($printview == 'week') {
	$start_week 	= localizeDate($dateFormat_week, $start_week_time);
	$end_week 		= localizeDate($dateFormat_week, $end_week_time);
	$display_date 	= "$start_week - $end_week";
	$week_start 	= date("Ymd", $start_week_time);
	$week_end 		= date("Ymd", $end_week_time);
	$next 			= date("Ymd", strtotime("+1 week", $unix_time));
	$prev 			= date("Ymd", strtotime("-1 week", $unix_time));
	$zero_events 	= $no_events_week_lang;
	$print_next_nav = $next_week_lang;
	$print_prev_nav = $last_week_lang;
} elseif ($printview == 'month') {
	$display_date 	= localizeDate ($dateFormat_month, strtotime($getdate));
	$next 			= date("Ymd", strtotime("+1 month", $unix_time));
	$prev 			= date("Ymd", strtotime("-1 month", $unix_time));
	$zero_events 	= $no_events_month_lang;
	$print_next_nav = $next_month_lang;
	$print_prev_nav = $last_month_lang;
	$week_start		= '';
	$week_end		= '';
}

$page = new Page(BASE.'templates/'.$template.'/print.tpl');

$page->replace_tags(array(
	'header'			=> BASE.'templates/'.$template.'/header.tpl',
	'footer'			=> BASE.'templates/'.$template.'/footer.tpl',
	'sidebar'			=> BASE.'templates/'.$template.'/sidebar.tpl',
	'event_js'			=> BASE.'functions/event.js',
	'default_path'		=> '',
	'template'			=> $template,
	'cal'				=> $cal,
	'getdate'			=> $getdate,
	'calendar_name'		=> $calendar_name,
	'current_view'		=> $current_view,
	'display_date'		=> $display_date,
	'sidebar_date'		=> $sidebar_date,
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
	
$page->draw_print($this->page);

$page->output();

?>
