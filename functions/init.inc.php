<?php 
// jared-2002.10.30, I want to make sure my published calendars are world-read/writeable
// so I have this making sure they all are. This should be commented out/deleted
// for shipping versions. This is a convenience so when I commit, changes are made and
// I don't get errors.
//chmod(BASE.'calendars/School.ics',0666);

// uncomment when developing, comment for shipping version
//error_reporting (E_ALL);

if (!defined('BASE')) define('BASE', './');
include(BASE.'config.inc.php');
include(BASE.'functions/error.php');
if (isset($HTTP_COOKIE_VARS['phpicalendar'])) {
	$phpicalendar = unserialize(stripslashes($HTTP_COOKIE_VARS['phpicalendar']));
	if (isset($phpicalendar['cookie_language'])) 	$language 			= $phpicalendar['cookie_language'];
	if (isset($phpicalendar['cookie_calendar'])) 	$default_cal_check	= $phpicalendar['cookie_calendar'];
	if (isset($phpicalendar['cookie_view'])) 		$default_view 		= $phpicalendar['cookie_view'];
	if (isset($phpicalendar['cookie_style'])) 		$style_sheet 		= $phpicalendar['cookie_style'];
	if (isset($phpicalendar['cookie_startday'])) 	$week_start_day		= $phpicalendar['cookie_startday'];
	if (isset($phpicalendar['cookie_time']))		$day_start			= $phpicalendar['cookie_time'];
}

// language support
$language = strtolower($language);
$lang_file = BASE.'/languages/'.$language.'.inc.php';

if (file_exists($lang_file)) {
	include($lang_file);
} else {
	exit(error('The requested language "'.$language.'" is not a supported language. Please use the configuration file to choose a supported language.'));
}

if (!isset($getdate)) {
	if (isset($HTTP_GET_VARS['getdate']) && ($HTTP_GET_VARS['getdate'] !== '')) {
		$getdate = $HTTP_GET_VARS['getdate'];
	} else {
		$getdate = date('Ymd', strtotime("now + $second_offset seconds"));
	}
}

if (ini_get('max_execution_time') < 60) {
	ini_set('max_execution_time', '60');
}

if ($calendar_path == '') {
	$calendar_path = 'calendars';
	$calendar_path_orig = $calendar_path;
	$calendar_path = BASE.$calendar_path;
}

$is_webcal = FALSE;
if (isset($HTTP_GET_VARS['cal']) && $HTTP_GET_VARS['cal'] != '') {
	$cal_decoded = urldecode($HTTP_GET_VARS['cal']);
	if (substr($cal_decoded, 0, 7) == 'http://' || substr($cal_decoded, 0, 9) == 'webcal://') {
		$is_webcal = TRUE;
		$cal_webcalPrefix = str_replace('http://','webcal://',$cal_decoded);
		$cal_httpPrefix = str_replace('webcal://','http://',$cal_decoded);
		$cal_filename = $cal_httpPrefix;
	} else {
		$cal_filename = stripslashes($cal_decoded);
	}
} else {
	if (isset($default_cal_check)) {
		$calcheck = $calendar_path.'/'.$default_cal_check.'.ics';
		$calcheckopen = @fopen($calcheck, "r");
		if ($calcheckopen == FALSE) {
			$cal_filename = $default_cal;
		} else {
			$cal_filename = $default_cal_check;
		}
	} else {
		$cal_filename = $default_cal;
	}
}


if ($is_webcal) {
	if ($allow_webcals == 'yes' || in_array($cal_webcalPrefix, $list_webcals) || in_array($cal_httpPrefix, $list_webcals)) {
		$cal_displayname = substr(str_replace('32', ' ', basename($cal_filename)), 0, -4);
		$cal = urlencode($cal_filename);
		$filename = $cal_filename;
		$subscribe_path = $cal_webcalPrefix;
	} else {
		exit(error($error_remotecal_lang, $HTTP_GET_VARS['cal']));
	}
} else {
	$cal_displayname = str_replace('32', ' ', $cal_filename);
	$cal = urlencode($cal_filename);
	if (in_array($cal_filename, $blacklisted_cals)) {
		exit(error($error_restrictedcal_lang, $cal_filename));
	} else {
		if (!isset($filename)) {
			$filename = $calendar_path.'/'.$cal_filename.'.ics';
			if (true == false) {
				$dir_handle = @opendir($calendar_path) or die(error(sprintf($error_path_lang, $calendar_path), $cal_filename));
				while ($file = readdir($dir_handle)) {
					if (substr($file, -4) == '.ics') {
						$cal = urlencode(substr($file, 0, -4));
						$filename = $calendar_path.'/'.$file;
						break;
					}
				}
			}
		}
		
		// Sets the download and subscribe paths from the config if present.
		if ($download_uri == '') {
			$subscribe_path = 'webcal://'.$HTTP_SERVER_VARS['SERVER_NAME'].dirname($HTTP_SERVER_VARS['PHP_SELF']).'/'.$filename;
			$download_filename = $filename;
		} else {
			$newurl = eregi_replace("^(http://)", "", $download_uri); 
			$subscribe_path = 'webcal://'.$newurl.'/'.$cal_filename.'.ics';
			$download_filename = $download_uri.'/'.$cal_filename.'.ics';
		}
		
	}
}
?>