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

if (isset($cpath) && $cpath !=''){
	$cpath_tmp = '&amp;cpath='.$cpath;
}
foreach ($filelist as $file) {
	// $cal_filename is the filename of the calendar without .ics
	// $cal is a urlencoded version of $cal_filename
	// $cal_displayname is $cal_filename with occurrences of "32" replaced with " "

	if (substr($file, 0, 7) == 'http://' || substr($file, 0, 8) == 'https://' || substr($file, 0, 9) == 'webcal://') {
		$cal_tmp = urlencode($file);
	}else{
		$cal_tmp = getCalendarName($file);	
	}
	$cal_displayname_tmp = $cal_displaynames[array_search($file,$cal_filelist)];
	$cal_tmp = str_replace(" ", "+", $cal_tmp);
	$rss_list .= '<br /><font class="V12"><b>'.$cal_displayname_tmp.' '. $lang['l_calendar'].'</b></font><br />';
	$rss_list .= '<table><tr><td><font class="V12">'.$lang['l_day'].':</font></td><td>
	<a href='. $default_path.'/rss/rss.php?cal='.$cal_tmp.$cpath_tmp.'&amp;rssview=day>'.$default_path.'/rss/rss.php?cal='.$cal_tmp.$cpath_tmp.'&amp;rssview=day</a></td></tr>';

	$rss_list .= '<td><font class="V12">'.$lang['l_week'].':</font></td><td>
	<a href='. $default_path.'/rss/rss.php?cal='.$cal_tmp.$cpath_tmp.'&amp;rssview=week>'.$default_path.'/rss/rss.php?cal='.$cal_tmp.$cpath_tmp.'&amp;rssview=week</a></td></tr>';

	$rss_list .= '<td><font class="V12">'.$lang['l_month'].':</font></td><td>
	<a href='. $default_path.'/rss/rss.php?cal='.$cal_tmp.$cpath_tmp.'&amp;rssview=month>'.$default_path.'/rss/rss.php?cal='.$cal_tmp.$cpath_tmp.'&amp;rssview=month</a></td></tr>';

		$rss_list .= '<td><font class="V12">'.$lang['l_year'].':</font></td><td>
		<a href='. $default_path.'/rss/rss.php?cal='.$cal_tmp.$cpath_tmp.'&amp;rssview=year>'.$default_path.'/rss/rss.php?cal='.$cal_tmp.$cpath_tmp.'&amp;rssview=year</a></td></tr>';
		$rss_list .='</table>';
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
