<?php 
// Retain some compatibility backwards like.
if(phpversion() >= '4.2.0') 

	{
		extract($HTTP_GET_VARS);	
		extract($HTTP_POST_VARS);
	}

include('./config.inc.php');
include('./functions/error.php');

// subscribe link prefix, doesn't need to be user configureable
$fullpath = 'webcal://'.$HTTP_SERVER_VARS['SERVER_NAME'].dirname($HTTP_SERVER_VARS['PHP_SELF']).'/'.$calendar_path.'/';


// language support
$language = strtolower($language);
$lang_file = './languages/'.$language.'.inc.php';

if (file_exists($lang_file)) {
	include($lang_file);
} else {
//	Not sure if we should print this warning or not. It would inform the user
//	why the language isn't working.
	print 'File "'.$lang_file.'" does not exist, defaulting to English<br><br>';
	include('../languages/english.inc.php');
}

if (isset($HTTP_GET_VARS['getdate']) && ($HTTP_GET_VARS['getdate'] !== '')) {
	$getdate = $HTTP_GET_VARS['getdate'];
} else {
	$getdate = date('Ymd');
}

// $cal_displayname is $cal_filename with occurrences of '32' replaced with ' '
// $cal_filename should always be the filename of the calendar without .ics
$is_webcal = FALSE;
if (isset($HTTP_GET_VARS['cal'])) {
	if (substr($HTTP_GET_VARS['cal'], 0, 7) == 'http://') {
		$is_webcal = TRUE;
		$cal_filename = $HTTP_GET_VARS['cal'];
	} else {
		$cal_filename = stripslashes(urldecode($HTTP_GET_VARS['cal']));
	}
} else {
	$cal_filename = $default_cal;
}


if ($is_webcal) {
	$cal_displayname = substr(str_replace('32', ' ', basename($cal_filename)), 0, -4);
	$cal = $cal_filename;
	$filename = $cal;
} else {
	$cal_displayname = str_replace('32', ' ', $cal_filename);
	$cal = urlencode($cal_filename);

	if (!isset($filename)) {
		$filename = $calendar_path.'/'.$cal_filename.'.ics';
		if (!file_exists($filename)) {
			$dir_handle = @opendir($calendar_path) or die('Unable to open path: '.$calendar_path);
			while ($file = readdir($dir_handle)) {
				if (substr($file, -4) == '.ics') {
					$filename = $calendar_path.'/'.$file;
					break;
				}
			}
		}
	}
}
?>