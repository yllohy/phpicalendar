<?php 
define('BASE', './');
$current_view = "month";
require_once(BASE.'functions/ical_parser.php');
require_once(BASE.'functions/list_functions.php');
require_once(BASE.'functions/template.php');
header("Content-Type: text/html; charset=$phpiCal_config->charset");
if ($phpiCal_config->minical_view == 'current') $minical_view = 'month';

$unix_time 				= strtotime($getdate);
$today_today 			= date('Ymd', time() + $phpiCal_config->second_offset); 
$tomorrows_date 		= date('Ymd', strtotime("+1 day",  $unix_time));
$yesterdays_date 		= date('Ymd', strtotime("-1 day",  $unix_time));
$sidebar_date 			= localizeDate($dateFormat_week_list, $unix_time);
if (!isset($style_select)) $style_select = '';

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
$start_month_day 		= dateOfWeek($first_of_month, $phpiCal_config->week_start_day);
$thisday2 				= localizeDate($dateFormat_week_list, $unix_time);
$num_of_events2 			= 0;

// select for calendars
$list_icals 	= display_ical_list(availableCalendars($username, $password, $phpiCal_config->ALL_CALENDARS_COMBINED));
$list_years 	= list_years();
$list_months 	= list_months();
$list_weeks 	= list_weeks();
$list_jumps 	= list_jumps();
$list_calcolors = list_calcolors();
$list_icals_pick = display_ical_list(availableCalendars($username, $password, $phpiCal_config->ALL_CALENDARS_COMBINED), TRUE);

$page = new Page(BASE.'templates/'.$phpiCal_config->template.'/month.tpl');

$page->replace_files(array(
	'header'			=> BASE.'templates/'.$phpiCal_config->template.'/header.tpl',
	'event_js'			=> BASE.'functions/event.js',
	'footer'			=> BASE.'templates/'.$phpiCal_config->template.'/footer.tpl',
    'calendar_nav'      => BASE.'templates/'.$phpiCal_config->template.'/calendar_nav.tpl',
    'search_box'        => BASE.'templates/'.$phpiCal_config->template.'/search_box.tpl'
	));

$page->replace_tags(array(
	'version'			=> $phpiCal_config->phpicalendar_version,
	'charset'			=> $phpiCal_config->charset,
	'template'			=> $phpiCal_config->template,
	'cal'				=> $cal,
	'getdate'			=> $getdate,
	'getcpath'			=> "&cpath=$cpath",
	'cpath'             => $cpath,
	'calendar_name'		=> $cal_displayname,
	'display_date'		=> $display_date,
	'rss_powered'	 	=> $rss_powered,
	'default_path'		=> '',
	'rss_available' 	=> '',
	'rss_valid' 		=> '',
	'show_search' 		=> $phpiCal_config->show_search,
	'next_month' 		=> $next_month,
	'prev_month'	 	=> $prev_month,
	'show_goto' 		=> '',
	'is_logged_in' 		=> '',
	'list_jumps' 		=> $list_jumps,
	'list_icals' 		=> $list_icals,
	'list_icals_pick'	=> $list_icals_pick,
	'list_years' 		=> $list_years,
	'list_months' 		=> $list_months,
	'list_weeks' 		=> $list_weeks,
	'legend'	 		=> $list_calcolors,
	'current_view'		=> $current_view,
	'style_select' 		=> $style_select,
	'sidebar_date'		=> $sidebar_date,
	'l_goprint'			=> $lang['l_goprint'],
	'l_preferences'		=> $lang['l_preferences'],
	'l_calendar'		=> $lang['l_calendar'],
	'l_legend'			=> $lang['l_legend'],
	'l_tomorrows'		=> $lang['l_tomorrows'],
	'l_jump'			=> $lang['l_jump'],
	'l_todo'			=> $lang['l_todo'],
	'l_day'				=> $lang['l_day'],
	'l_week'			=> $lang['l_week'],
	'l_month'			=> $lang['l_month'],
	'l_year'			=> $lang['l_year'],
	'l_subscribe'		=> $lang['l_subscribe'],
	'l_download'		=> $lang['l_download'],
	'l_this_months'		=> $lang['l_this_months'],
	'l_search'			=> $lang['l_search'],
	'l_pick_multiple'	=> $lang['l_pick_multiple'],
	'l_powered_by'		=> $lang['l_powered_by'],
	'l_this_site_is'	=> $lang['l_this_site_is']			
	));
	
if ($phpiCal_config->allow_preferences != 'yes') {
	$page->replace_tags(array(
	'allow_preferences'	=> ''
	));
}	
	
if ($phpiCal_config->allow_login == 'yes') {
	$page->replace_tags(array(
	'l_invalid_login'	=> $lang['l_invalid_login'],
	'l_password'		=> $lang['l_password'],
	'l_username'		=> $lang['l_username'],
	'l_login'			=> $lang['l_login'],
	'l_logout'			=> $lang['l_logout']
	));
}

if ($phpiCal_config->show_search != 'yes') {
	$page->nosearch($page);
}
	
if ($this_months_events == 'yes') {	
	$page->monthbottom($page);
} else {
	$page->nomonthbottom($page);
}
$page->draw_subscribe($page);

$page->output();



?>
