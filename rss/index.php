<?php

define('BASE','../');
require_once(BASE.'functions/ical_parser.php');
require_once(BASE.'functions/calendar_functions.php');

if ($enable_rss != 'yes') {
	exit(error('RSS is not available for this installation.', $cal, '../'));
}

if (empty($default_path)) {
	if (isset($_SERVER['HTTPS']) || strtolower($_SERVER['HTTPS']) == 'on' ) {
		$default_path = 'https://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].substr($_SERVER['PHP_SELF'],0,strpos($_SERVER['PHP_SELF'],'/rss/'));
	} else {
		$default_path = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].substr($_SERVER['PHP_SELF'],0,strpos($_SERVER['PHP_SELF'],'/rss/'));
	}
}

$current_view = "rssindex";
$display_date = "RSS Info";

$filelist = availableCalendars($username, $password, $ALL_CALENDARS_COMBINED);
foreach ($filelist as $file) {
	// $cal_filename is the filename of the calendar without .ics
	// $cal is a urlencoded version of $cal_filename
	// $cal_displayname is $cal_filename with occurrences of "32" replaced with " "
	$cal_filename_tmp = getCalendarName($file);
	$cal_tmp = urlencode($cal_filename_tmp);
	$cal_displayname_tmp = str_replace("32", " ", $cal_filename_tmp);
	$rss_list .= '<font class="V12" color="blue"><b>'.$cal_displayname_tmp.' '. $calendar_lang.'</b></font><br />';
	$rss_list .= $default_path.'/rss/rss.php?cal='.$cal_tmp.'&amp;cpath='.$cpath.'&amp;rssview=day<br />';
	$rss_list .= $default_path.'/rss/rss.php?cal='.$cal_tmp.'&amp;cpath='.$cpath.'&amp;rssview=week<br />';
	$rss_list .= $default_path.'/rss/rss.php?cal='.$cal_tmp.'&amp;cpath='.$cpath.'&amp;rssview=month<br /><br />';
	$footer_check = $default_path.'/rss/rss.php?cal='.$default_cal.'&amp;rssview='.$default_view;
}


$page = new Page(BASE.'templates/'.$template.'/rss_index.tpl');

$page->replace_files(array(
	'header'			=> BASE.'templates/'.$template.'/header.tpl',
	'footer'			=> BASE.'templates/'.$template.'/footer.tpl',
	'event_js'			=> ''
	));

$page->replace_tags(array(
	'default_path'		=> $default_path.'/',
	'template'			=> $template,
	'cal'				=> $cal,
	'getdate'			=> $getdate,
	'calendar_name'		=> $calendar_name,
	'display_date'		=> $display_date,
	'current_view'		=> $current_view,
	'sidebar_date'		=> $sidebar_date,
	'rss_powered'	 	=> $rss_powered,
	'rss_list'	 		=> $rss_list,
	'charset'	 		=> $charset,
	'rss_available' 	=> '',
	'rssdisable'	 	=> '',
	'rss_valid' 		=> '',
	'show_search' 		=> $show_search,
	'l_rss_info'		=> $lang['l_rss_info'],
	'l_rss_subhead'		=> $lang['l_rss_subhead'],
	'l_day'				=> $lang['l_day'],
	'l_week'			=> $lang['l_week'],
	'l_month'			=> $lang['l_month'],
	'l_year'			=> $lang['l_year'],
	'l_subscribe'		=> $lang['l_subscribe'],
	'l_download'		=> $lang['l_download'],
	'l_this_months'		=> $lang['l_this_months'],
	'l_powered_by'		=> $lang['l_powered_by'],
	'l_this_site_is'	=> $lang['l_this_site_is']				
	));

$page->output();
								
								
?>
