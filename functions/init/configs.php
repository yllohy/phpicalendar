<?php
// Pull in the configuration and some functions.
include_once(BASE.'default_config.php');
if (is_file(BASE.'config.inc.php')){
	include_once(BASE.'config.inc.php');
	foreach($configs as $key=>$value) $phpiCal_config->setProperty($key, $value);
}
// Set the cookie URI.
if ($phpiCal_config->cookie_uri == '') {
	$phpiCal_config->setProperty('cookie_uri', $_SERVER['SERVER_NAME'].substr($_SERVER['PHP_SELF'],0,strpos($_SERVER['PHP_SELF'], '/') ).'phpicalendar' );
}

if (isset($_COOKIE[$phpiCal_config->cookie_uri]) && !isset($_POST['unset'])) {
	$phpicalendar = unserialize(stripslashes($_COOKIE[$cookie_name]));
	if (isset($phpicalendar['cookie_language'])) 	$phpiCal_config->setProperty('language', 			$phpicalendar['cookie_language']);
	if (isset($phpicalendar['cookie_calendar'])) 	$phpiCal_config->setProperty('default_cal_check', 	$phpicalendar['cookie_calendar']);
	if (isset($phpicalendar['cookie_cpath'])) 		$phpiCal_config->setProperty('default_cpath_check', $phpicalendar['cookie_cpath']);
	if (isset($phpicalendar['cookie_view'])) 		$phpiCal_config->setProperty('default_view', 		$phpicalendar['cookie_view']);
	if (isset($phpicalendar['cookie_style']) && is_dir(BASE.'templates/'.$phpicalendar['cookie_style'].'/')){ 
													$phpiCal_config->setProperty('template', 			$phpicalendar['cookie_style']);
	}	
	if (isset($phpicalendar['cookie_startday'])) 	$phpiCal_config->setProperty('week_start_day', 		$phpicalendar['cookie_startday']);
	if (isset($phpicalendar['cookie_time']))		$phpiCal_config->setProperty('day_start', 			$phpicalendar['cookie_time']);
}

# language support
# default to english and overwrite other strings as available
unset($lang); 
include_once(BASE.'languages/english.inc.php');
$language = strtolower($phpiCal_config->language);
$lang_file = BASE.'languages/'.$language.'.inc.php';
if (is_file($lang_file)) {
	include_once($lang_file);
}

$template = $phpiCal_config->template;

$fillTime = $phpiCal_config->day_start;
$day_array = array ();
while ($fillTime < $phpiCal_config->day_end) {
	array_push ($day_array, $fillTime);
	preg_match ('/([0-9]{2})([0-9]{2})/', $fillTime, $dTime);
	$fill_h = $dTime[1];
	$fill_min = $dTime[2];
	$fill_min = sprintf('%02d', $fill_min + $phpiCal_config->gridLength);
	if ($fill_min == 60) {
		$fill_h = sprintf('%02d', ($fill_h + 1));
		$fill_min = '00';
	}
	$fillTime = $fill_h . $fill_min;
}


/*
echo "<pre>xx";
print_r($configs);
print_r($phpiCal_config);
echo "</pre>";
#die;
*/