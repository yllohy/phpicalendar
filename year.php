<?php

define('BASE', './');
$current_view = 'year';
require_once(BASE.'functions/ical_parser.php');
require_once(BASE.'functions/template.php');
header("Content-Type: text/html; charset=$charset");

ereg ("([0-9]{4})([0-9]{2})([0-9]{2})", $getdate, $day_array2);
$this_day 	= $day_array2[3]; 
$this_month = $day_array2[2];
$this_year 	= $day_array2[1];
$next_year 	= strtotime ("+1 year", strtotime($getdate));
$next_year 	= date ("Ymd", $next_year);
$prev_year 	= strtotime ("-1 year", strtotime($getdate));
$prev_year 	= date ("Ymd", $prev_year);

$page = new Page(BASE.'templates/'.$template.'/year.tpl');

$page->replace_files(array(
	'header'			=> BASE.'templates/'.$template.'/header.tpl',
	'footer'			=> BASE.'templates/'.$template.'/footer.tpl'
	));

$page->replace_tags(array(
	'event_js'			=> '',
	'template'			=> $template,
	'charset'			=> $charset,
	'default_path'		=> '',
	'cal'				=> $cal,
		'getcpath'			=> "&cpath=$cpath",
        'cpath'                 => $cpath,
	'getdate'			=> $getdate,
	'calendar_name'		=> $cal_displayname,
	'display_date'		=> $this_year,
	'rss_powered'	 	=> $rss_powered,
	'rss_available' 	=> '',
	'rss_valid' 		=> '',
	'todo_available' 	=> '',
	'event_js' 			=> '',
	'this_year'			=> $this_year,
	'next_year'			=> $next_year,
	'prev_year'			=> $prev_year,
	'l_day'				=> $lang['l_day'],
	'l_week'			=> $lang['l_week'],
	'l_month'			=> $lang['l_month'],
	'l_year'			=> $lang['l_year'],
	'l_powered_by'		=> $lang['l_powered_by'],
	'l_this_site_is'	=> $lang['l_this_site_is']

	));
	
$page->output();

?>
