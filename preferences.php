<?php

define('BASE','./');
require_once(BASE.'functions/ical_parser.php');
require_once(BASE.'functions/template.php');
$display_date = $preferences_lang;

if ($cookie_uri == '') {
	$cookie_uri = $HTTP_SERVER_VARS['SERVER_NAME'].substr($HTTP_SERVER_VARS['PHP_SELF'],0,strpos($HTTP_SERVER_VARS['PHP_SELF'], '/'));
}

$current_view = "preferences";
$back_page = BASE.$default_view.'.php?cal='.$cal.'&amp;getdate='.$getdate;
if ($allow_preferences == 'no') header("Location: $back_page");

if (isset($HTTP_GET_VARS['action'])) {
	$action = $HTTP_GET_VARS['action'];
} else {
	$action = '';
} 

$startdays = array ('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');

if ($action == 'setcookie') { 
	$cookie_language 	= $HTTP_POST_VARS['cookie_language'];
	$cookie_calendar 	= $HTTP_POST_VARS['cookie_calendar'];
	$cookie_view 		= $HTTP_POST_VARS['cookie_view'];
	$cookie_style 		= $HTTP_POST_VARS['cookie_style'];
	$cookie_startday	= $HTTP_POST_VARS['cookie_startday'];
	$cookie_time		= $HTTP_POST_VARS['cookie_time'];
	$cookie_unset		= $HTTP_POST_VARS['unset'];
	$the_cookie = array ("cookie_language" => "$cookie_language", "cookie_calendar" => "$cookie_calendar", "cookie_view" => "$cookie_view", "cookie_startday" => "$cookie_startday", "cookie_style" => "$cookie_style", "cookie_time" => "$cookie_time");
	$the_cookie 		= serialize($the_cookie);
	if ($cookie_unset) { 
		setcookie("phpicalendar","$the_cookie",time()-(60*60*24*7) ,"/","$cookie_uri",0);
	} else {
		setcookie("phpicalendar","$the_cookie",time()+(60*60*24*7*12*10) ,"/","$cookie_uri",0);
	}
	$HTTP_COOKIE_VARS['phpicalendar'] = $the_cookie;
}

if (isset($HTTP_COOKIE_VARS['phpicalendar'])) {
	$phpicalendar 		= unserialize(stripslashes($HTTP_COOKIE_VARS['phpicalendar']));
	$cookie_language 	= $phpicalendar['cookie_language'];
	$cookie_calendar 	= $phpicalendar['cookie_calendar'];
	$cookie_view 		= $phpicalendar['cookie_view'];
	$cookie_style 		= $phpicalendar['cookie_style'];
	$cookie_startday	= $phpicalendar['cookie_startday'];
	$cookie_time		= $phpicalendar['cookie_time'];
	if ($cookie_unset) { 
		unset ($cookie_language, $cookie_calendar, $cookie_view, $cookie_style,$cookie_startday);
	}
}

if ((!isset($HTTP_COOKIE_VARS['phpicalendar'])) || ($cookie_unset)) {
	# No cookie set -> use defaults from config file.
	$cookie_language = ucfirst($language);
	$cookie_calendar = $default_cal;
	$cookie_view = $default_view;
	$cookie_style = $style_sheet;
	$cookie_startday = $week_start_day;
	$cookie_time = $day_start;
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
while ($file = readdir($dir_handle)) {
	if (substr($file, -8) == ".inc.php") {
		$language_tmp = urlencode(ucfirst(substr($file, 0, -8)));
		if ($language_tmp == $cookie_language) {
			$language_select .= "<option value=\"$language_tmp\" selected>$language_tmp</option>\n";
		} else {
			$language_select .= "<option value=\"$language_tmp\">$language_tmp</option>\n";
		}
	}
}
closedir($dir_handle);

// select for calendars
$calendar_select = display_ical_list(availableCalendars($username, $password, $ALL_CALENDARS_COMBINED));

// select for dayview
$view_select 	= ($cookie_view == 'day') ? '<option value="day" selected>{L_DAY}</option>' : '<option value="day">{L_DAY}</option>';
$view_select    .= ($cookie_view == 'week') ? '<option value="week" selected>{L_WEEK}</option>' : '<option value="week">{L_WEEK}</option>';
$view_select    .= ($cookie_view == 'month') ? '<option value="month" selected>{L_MONTH}</option>' : '<option value="month">{L_MONTH}</option>';

// select for time
for ($i = 000; $i <= 1200; $i += 100) {
	$s = sprintf("%04d", $i);
	$time_select .= "<option value=\"$s\"";
	if ($s == $cookie_time) {
		$time_select .= " selected";
	}
	$time_select .= ">$s</option>\n";
}

// select for day of week
$i=0;
foreach ($daysofweek_lang as $daysofweek) {
	if ($startdays[$i] == "$cookie_startday") {
		$startday_select .= "<option value=\"$startdays[$i]\" selected>$daysofweek</option>\n";
	} else {
		$startday_select .= "<option value=\"$startdays[$i]\">$daysofweek</option>\n";
	}
	$i++;
}

$dir_handle = @opendir(BASE.'templates/');
while ($file = readdir($dir_handle)) {
	if (($file != ".") && ($file != "..") && ($file != "CVS")) {
		if (!is_file($file)) {
			$file_disp = ucfirst($file);
			$style_select .= ($file == "$cookie_style") ? "<option value=\"$file\" selected>$file_disp</option>\n" : "<option value=\"$file\">$file_disp</option>\n";
		}
	}
}
closedir($dir_handle);

$php_ended = getmicrotime();
$generated = number_format(($php_ended-$php_started),3);

$page = new Page(BASE.'templates/'.$template.'/preferences.tpl');

$page->replace_tags(array(
	'header'			=> BASE.'templates/'.$template.'/header.tpl',
	'footer'			=> BASE.'templates/'.$template.'/footer.tpl',
	'template'			=> $template,
	'default_path'		=> '',
	'cal'				=> $cal,
	'getdate'			=> $getdate,
	'calendar_name'		=> $calendar_name,
	'display_date'		=> $display_date,
	'rss_powered'	 	=> $rss_powered,
	'rss_available' 	=> '',
	'rss_valid' 		=> '',
	'todo_js' 			=> '',
	'event_js' 			=> '',
	'language_select' 	=> $language_select,
	'calendar_select' 	=> $calendar_select,
	'view_select' 		=> $view_select,
	'time_select' 		=> $time_select,
	'startday_select' 	=> $startday_select,
	'style_select' 		=> $style_select,
	'display_date'	 	=> $lang['l_preferences'],
	'generated'	 		=> $generated,
	'message'	 		=> $message
			
	));

$page->output();

?>
