<?php

$current_view = 'print';
$printview = 'agenda';

if (!defined('BASE')) define('BASE', './');
require_once(BASE.'functions/date_functions.php');
require_once(BASE.'functions/init.inc.php');


// agenda.php will display all events
//   between $start_time and $end_time
// If they are not both set, use a default value of +/- two weeks
// around the current date.
if (!isset($start_time) || !isset($end_time))
{
  $start_time     = strtotime("-2 weeks");
  $end_time       = strtotime("+2 weeks");
}

$mArray_begin = $start_time;
$mArray_end = $end_time;

//setlocale(LC_TIME, 'de_DE');

// override $timeFormat in english.inc.php.  Check out: http://www.php.net/manual/en/function.date.php
$timeFormat = 'G';
$dateFormat_day = '%A, %d.%m.%Y';

$days = 14;			if (isset($_GET['days']))			$days = $_GET['days'];
$table_width = 800;	if (isset($_GET['table_width']))	$table_width = $_GET['table_width'];



$parse_month 		= date ("Ym", strtotime($getdate));
$events_week 		= 0;
$unix_time 			= strtotime($getdate);

$start_date 	= date("Y-m-d", $start_time);
$end_date 	= date("Y-m-d", $end_time);
$display_date 	= "$start_date - $end_date";

// application specific: set summer/winter term
$start_year = date("Y", $start_time);
$end_year = date("Y", $end_time);
if( $start_year == $end_year )
{
  $nice_display_date 	= "Sommer $start_year";
}
else
{
  $nice_display_date 	= "Winter $start_year/$end_year";
}

$week_start 	= date("Ymd", $start_time);
$week_end 		= date("Ymd", $end_time);
$next_day		= date("Ymd", strtotime("+$days days", $unix_time));
$prev_day		= date("Ymd", strtotime("-$days days", $unix_time));
$today = date('Ymd', time() + $second_offset);

require_once(BASE.'functions/ical_parser.php');
require_once(BASE.'functions/list_functions.php');
require_once(BASE.'functions/template.php');
header("Content-Type: text/html; charset=$charset");


$page = new Page(BASE.'templates/'.$template.'/agenda.tpl');

$page->replace_files(array(
  'header'			=> BASE.'templates/'.$phpiCal_config->template.'/header.tpl',
  'event_js'			=> BASE.'functions/event.js',
  'footer'			=> BASE.'templates/'.$phpiCal_config->template.'/footer.tpl',
  'sidebar'           => BASE.'templates/'.$phpiCal_config->template.'/sidebar.tpl',
  'search_box'        => BASE.'templates/'.$phpiCal_config->template.'/search_box.tpl'
));

$page->replace_tags(array(
	'version'			=> $phpiCal_config->phpicalendar_version,
	'charset'			=> $phpiCal_config->charset,
	'default_path'		=> $phpiCal_config->default_path,
  'template'			=> $phpiCal_config->template,
	'cal'				=> $cal,
	'getdate'			=> $getdate,
	'getcpath'			=> "&cpath=$cpath",
	'cpath'				=> $cpath,
	'calendar_name'		=> $cal_displayname,
	'calendar_desc'		=> $cal_displaydesc,
	'current_view'		=> $current_view,
	'display_date'		=> $display_date,
	'nice_display_date'		=> $nice_display_date,
	'sidebar_date'		=> $sidebar_date,
	'rss_powered'	 	=> $rss_powered,
	'rss_available' 	=> '',
	'rss_valid' 		=> '',
	'show_search' 		=> $phpiCal_config->show_search,
	'next_day' 			=> $next_day,
	'prev_day'	 		=> $prev_day,
	'show_goto' 		=> '',
	'show_user_login'	=> $show_user_login,
	'invalid_login'		=> $invalid_login,
	'login_querys'		=> $login_querys,
	'is_logged_in' 		=> $is_logged_in,
	'username'			=> $username,
	'logout_querys'		=> $logout_querys,
	'list_icals' 		=> $list_icals,
	'list_icals_pick' 	=> $list_icals_pick,
	'list_years' 		=> $list_years,
	'list_months' 		=> $list_months,
	'list_weeks' 		=> $list_weeks,
	'list_jumps' 		=> $list_jumps,
	'legend'	 		=> $list_calcolors,
#	'style_select' 		=> $style_select,
	'l_goprint'			=> $lang['l_goprint'],
	'l_preferences'		=> $lang['l_preferences'],
	'l_calendar'		=> $lang['l_calendar'],
	'l_legend'			=> $lang['l_legend'],
	'l_tomorrows'		=> $lang['l_tomorrows'],
	'l_jump'			=> $lang['l_jump'],
	'l_todo'			=> $lang['l_todo'],
	'l_prev'			=> $lang['l_prev'],
	'l_next'			=> $lang['l_next'],
	'l_day'				=> $lang['l_day'],
	'l_week'			=> $lang['l_week'],
	'l_month'			=> $lang['l_month'],
	'l_year'			=> $lang['l_year'],
	'l_pick_multiple'	=> $lang['l_pick_multiple'],
	'l_powered_by'		=> $lang['l_powered_by'],
	'l_subscribe'		=> $lang['l_subscribe'],
	'l_download'		=> $lang['l_download'],
	'l_search'			=> $lang['l_search'],
	'l_this_site_is'	=> $lang['l_this_site_is'],


	'days'				=> $days,
	'today'				=> $today,
	'table_width'		=> $table_width,
	'l_time'			=> $lang['l_time'],
	'l_summary'			=> $lang['l_summary'],
	'l_description'		=> $lang['l_description'],
	'l_location'			=> $lang['l_location'],
	'l_no_results'		=> $lang['l_no_results']
	));

$page->draw_agenda($page);
$page->draw_subscribe($page);

$page->output();

?>
