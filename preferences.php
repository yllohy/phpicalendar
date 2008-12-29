<?php
define('BASE','./');
$current_view = 'preferences';
require_once(BASE.'functions/init.inc.php');
require_once(BASE.'functions/template.php');
$display_date = $lang['l_preferences'];

if ($phpiCal_config->allow_preferences != 'yes') {
	exit(error($lang['l_prefs_off'], $cal));
}

$current_view = "preferences";
$back_page = BASE.$phpiCal_config->default_view.'.php?cal='.$cal.'&amp;getdate='.$getdate.'&amp;cpath='.$cpath;
if ($phpiCal_config->allow_preferences == 'no') header("Location: $back_page");

if (isset($_GET['action'])) {
	$action = $_GET['action'];
} else {
	$action = '';
} 

$startdays = array ('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

if ($action == 'setcookie') { 
	$cookie_language 	= $_POST['cookie_language'];
   	$cookie_cpath     	= $_POST['cpath'];
	$cookie_calendar 	= $_POST['cookie_calendar'];
	$cookie_view 		= $_POST['cookie_view'];
	$cookie_style 		= $_POST['cookie_style'];
	$cookie_startday	= $_POST['cookie_startday'];
	$cookie_time		= $_POST['cookie_time'];
	$cookie_endtime		= $_POST['cookie_endtime'];
	$cookie_timezone	= $_POST['cookie_timezone'];
	$cookie_unset		= @$_POST['unset'];
	$the_cookie = array ("cookie_language" => "$cookie_language", "cookie_calendar" => "$cookie_calendar", "cookie_view" => "$cookie_view", "cookie_startday" => "$cookie_startday", "cookie_style" => "$cookie_style", "cookie_time" => "$cookie_time","cookie_endtime" => "$cookie_endtime", "cookie_cpath"=>"$cookie_cpath", "cookie_timezone"=>"$cookie_timezone");
	$the_cookie 		= serialize($the_cookie);
	if ($cookie_unset) { 
		setcookie("$cookie_name","$the_cookie",time()-(60*60*24*7) ,"/","$phpiCal_config->cookie_uri",0);
	} else {
		setcookie("$cookie_name","$the_cookie",time()+(60*60*24*7*12*10) ,"/","$phpiCal_config->cookie_uri",0);
		if (isset($_POST['cookie_view'])) 
			$phpiCal_config->default_view = $_POST['cookie_view'];
		if (isset($_POST['cookie_style']) && is_dir(BASE.'templates/'.$_POST['cookie_style'].'/')) 
			$phpiCal_config->template = $_POST['cookie_style'];
		if (isset($_POST['cookie_language']) && is_file(BASE.'languages/'.strtolower($_POST['cookie_language']).'.inc.php')) 
			include(BASE.'languages/'.strtolower($_POST['cookie_language']).'.inc.php');
	}
	$_COOKIE[$cookie_name] = $the_cookie;
    $cpath = $cookie_cpath;
    $cal = $cookie_calendar;
}

if (isset($_COOKIE[$cookie_name])) {
	$phpicalendar 		= unserialize(stripslashes($_COOKIE[$cookie_name]));
	$cookie_language 	= $phpicalendar['cookie_language'];
	$cookie_calendar 	= $phpicalendar['cookie_calendar'];
	$cookie_view 		= $phpicalendar['cookie_view'];
	$cookie_style 		= $phpicalendar['cookie_style'];
	$cookie_startday	= $phpicalendar['cookie_startday'];
	$cookie_time		= $phpicalendar['cookie_time'];
	$cookie_endtime		= $phpicalendar['cookie_endtime'];
	$cookie_timezone	= $phpicalendar['cookie_timezone'];
	if ($cookie_unset) { 
		unset ($cookie_language, $cookie_calendar, $cookie_view, $cookie_style,$cookie_startday);
	}
}

if ((!isset($_COOKIE[$cookie_name])) || ($cookie_unset)) {
	# No cookie set -> use defaults from config file.
	$cookie_language = ucfirst($language);
	$cookie_calendar = $phpiCal_config->default_cal;
	$cookie_view = $phpiCal_config->default_view;
	$cookie_style = $phpiCal_config->template;
	$cookie_startday = $phpiCal_config->week_start_day;
	$cookie_time = $phpiCal_config->day_start;
	$cookie_endtime = $phpiCal_config->day_end;
	$cookie_timezone = $phpiCal_config->timezone;
}

if ($action == 'setcookie') { 
	if (!$cookie_unset) {
		$message = $lang['l_prefs_set'];
	} else {
		$message = $lang['l_prefs_unset'];
	}
} else {
	$message = '';
}

// select for languages
$dir_handle = @opendir(BASE.'languages/');
$tmp_pref_language = urlencode(ucfirst($language));
$language_select = '';
while ($file = readdir($dir_handle)) {
	if (substr($file, -8) == ".inc.php") {
		$language_tmp = urlencode(ucfirst(substr($file, 0, -8)));
		if ($language_tmp == $cookie_language) {
			$language_select .= '<option value="'.$language_tmp.'" selected="selected">'.$language_tmp.'</option>';
		} else {
			$language_select .= '<option value="'.$language_tmp.'">'.$language_tmp.'</option>';
		}
	}
}
closedir($dir_handle);

// select for calendars
$calendar_select = display_ical_list(availableCalendars($username, $password, $phpiCal_config->ALL_CALENDARS_COMBINED),TRUE);
$calendar_select .="<option value=\"$phpiCal_config->ALL_CALENDARS_COMBINED\">$all_cal_comb_lang</option>";
$calendar_select = str_replace("<option value=\"$cookie_calendar\">","<option value=\"$cookie_calendar\" selected='selected'>",$calendar_select);
// select for dayview
$view_select 	= ($phpiCal_config->default_view == 'day') ? '<option value="day" selected="selected">{L_DAY}</option>' : '<option value="day">{L_DAY}</option>';
$view_select    .= ($phpiCal_config->default_view == 'week') ? '<option value="week" selected="selected">{L_WEEK}</option>' : '<option value="week">{L_WEEK}</option>';
$view_select    .= ($phpiCal_config->default_view == 'month') ? '<option value="month" selected="selected">{L_MONTH}</option>' : '<option value="month">{L_MONTH}</option>';

// select for time
$time_select = '';
for ($i = 000; $i <= 2400; $i += 100) {
	$s = sprintf("%04d", $i);
	$time_select .= '<option value="'.$s.'"';
	if ($s == $cookie_time) {
		$time_select .= ' selected="selected"';
	}
	$time_select .= ">$s</option>\n";
}

$endtime_select = '';
for ($i = 000; $i <= 2400; $i += 100) {
	$s = sprintf("%04d", $i);
	$endtime_select .= '<option value="'.$s.'"';
	if ($s == $cookie_endtime) {
		$endtime_select .= ' selected="selected"';
	}
	$endtime_select .= ">$s</option>\n";
}

// select for day of week
$i=0;
$startday_select = '';
foreach ($daysofweek_lang as $daysofweek) {
	if ($startdays[$i] == $cookie_startday) {
		$startday_select .= '<option value="'.$startdays[$i].'" selected="selected">'.$daysofweek.'</option>';
	} else {
		$startday_select .= '<option value="'.$startdays[$i].'">'.$daysofweek.'</option>';
	}
	$i++;
}

$timezone_subset = array(
	'',
	'GMT',
	'US/Hawaii',
	'US/Pacific',
	'US/Mountain',
	'US/Central',
	'US/Eastern',
	'Canada/Newfoundland',
	'CET',
	'EET',
	'Etc/GMT-14',
	'Etc/GMT-13',
	'Etc/GMT-12',
	'Etc/GMT-11',
	'Etc/GMT-10',
	'Etc/GMT-9',
	'Etc/GMT-8',
	'Etc/GMT-7',
	'Etc/GMT-6',
	'Etc/GMT-5',
	'Etc/GMT-4',
	'Etc/GMT-3',
	'Etc/GMT-2',
	'Etc/GMT-1',
	'Etc/GMT+1',
	'Etc/GMT+2',
	'Etc/GMT+3',
	'Etc/GMT+4',
	'Etc/GMT+5',
	'Etc/GMT+6',
	'Etc/GMT+7',
	'Etc/GMT+8',
	'Etc/GMT+9',
	'Etc/GMT+10',
	'Etc/GMT+11',
	'Etc/GMT+12',
	'MET',
	'Mexico/General',
	'NZ',
	'WET'
);

$timezone_select = '';
foreach ($timezone_subset as $timezone) {
	if ($timezone == $cookie_timezone) {
		$timezone_select .= "<option value='$timezone' selected='selected'>$timezone</option>\n";
	} else {
		$timezone_select .= "<option value='$timezone'>$timezone</option>\n";
	}
}


$dir_handle = @opendir(BASE.'templates/');
$style_select = '';
while ($file = readdir($dir_handle)) {
	if (($file != ".") && ($file != "..") && ($file != "CVS")) {
		if (is_dir(BASE.'templates/'.$file)) {
			$file_disp = ucfirst($file);
			$style_select .= ($file == "$cookie_style") ? "<option value=\"$file\" selected=\"selected\">$file_disp</option>\n" : "<option value=\"$file\">$file_disp</option>\n";
		}
	}
}
closedir($dir_handle);

$page = new Page(BASE.'templates/'.$phpiCal_config->template.'/preferences.tpl');

$page->replace_files(array(
	'header'			=> BASE.'templates/'.$phpiCal_config->template.'/header.tpl',
	'footer'			=> BASE.'templates/'.$phpiCal_config->template.'/footer.tpl'
	));

$page->replace_tags(array(
	'version'			=> $phpiCal_config->phpicalendar_version,
	'charset'			=> $phpiCal_config->charset,
	'template'			=> $phpiCal_config->template,
	'default_path'		=> $phpiCal_config->default_path,
	'cpath'				=> $cpath,
	'cal'				=> $cal,
	'getdate'			=> $getdate,
	'calendar_name'		=> $cal_displayname,
	'display_date'		=> $display_date,
	'rss_powered'	 	=> $rss_powered,
	'rss_available' 	=> '',
	'rss_valid' 		=> '',
	'event_js' 			=> '',
	'language_select' 	=> $language_select,
	'timezone_select' 	=> $timezone_select,
	'calendar_select' 	=> $calendar_select,
	'view_select' 		=> $view_select,
	'time_select' 		=> $time_select,
	'endtime_select'	=> $endtime_select,
	'startday_select' 	=> $startday_select,
	'style_select' 		=> $style_select,
	'display_date'	 	=> $lang['l_preferences'],
	'message'	 		=> $message,
	'l_preferences'		=> $lang['l_preferences'],
	'l_prefs_subhead'	=> $lang['l_prefs_subhead'],
	'l_select_lang'		=> $lang['l_select_lang'],
	'l_select_view'		=> $lang['l_select_view'],
	'l_select_time'		=> $lang['l_select_time'],
	'l_select_timezone'	=> $lang['l_select_timezone'],
	'l_select_endtime'	=> $lang['l_select_endtime'],
	'l_select_day'		=> $lang['l_select_day'],
	'l_select_cal'		=> $lang['l_select_cal'],
	'l_select_style'	=> $lang['l_select_style'],
	'l_unset_prefs'		=> $lang['l_unset_prefs'],
	'l_set_prefs'		=> $lang['l_set_prefs'],
	'l_day'				=> $lang['l_day'],
	'l_week'			=> $lang['l_week'],
	'l_month'			=> $lang['l_month'],
	'l_year'			=> $lang['l_year'],
	'l_subscribe'		=> $lang['l_subscribe'],
	'l_download'		=> $lang['l_download'],
	'l_powered_by'		=> $lang['l_powered_by'],
	'l_this_site_is'	=> $lang['l_this_site_is']	
			
	));

$page->output();
?>
