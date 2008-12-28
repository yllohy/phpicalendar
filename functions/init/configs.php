<?php
// Pull in the configuration and some functions.
include_once(BASE.'default_config.php');
if (is_file(BASE.'config.inc.php')){
	include(BASE.'config.inc.php');
	foreach($configs as $key=>$value) $phpiCal_config->setProperty($key, $value);
}

# adjust gridlength to allowed values
$g = $phpiCal_config->gridLength;
if (!in_array($g,array(1,2,3,4,10,12,15,20,30,60)) && $g < 11){
	$g = 10;
}elseif($g < 13){
	$g = 12;
}elseif($g < 17){
	$g = 15;
}elseif($g < 25){
	$g = 20;
}elseif($g < 45){
	$g = 30;
}else{
	$g = 60;
}
$phpiCal_config->setProperty('gridLength', $g);


if ($phpiCal_config->cookie_uri == '') {
	$phpiCal_config->setProperty('cookie_uri', $_SERVER['SERVER_NAME'].substr($_SERVER['PHP_SELF'],0,strpos($_SERVER['PHP_SELF'], '/')) );
	if ($phpiCal_config->cookie_uri == 'localhost')	$phpiCal_config->setProperty('cookie_uri', '');
;
}
$cookie_name = 'phpicalendar_'.basename($phpiCal_config->default_path);
if (isset($_COOKIE[$cookie_name]) && !isset($_POST['unset'])) {
	$phpicalendar = unserialize(stripslashes($_COOKIE[$cookie_name]));
	if (isset($phpicalendar['cookie_language'])) 	$phpiCal_config->setProperty('language', 			$phpicalendar['cookie_language']);
	if (isset($phpicalendar['cookie_calendar'])) 	$phpiCal_config->setProperty('default_cal_check', 	$phpicalendar['cookie_calendar']);
	if (isset($phpicalendar['cookie_cpath']) && strpos($phpicalendar['cookie_cpath'],'../') === false) 		$phpiCal_config->setProperty('default_cpath_check', $phpicalendar['cookie_cpath']);
	if (isset($phpicalendar['cookie_view'])) 		$phpiCal_config->setProperty('default_view', 		$phpicalendar['cookie_view']);
	if (isset($phpicalendar['cookie_style']) && is_dir(BASE.'templates/'.$phpicalendar['cookie_style'].'/')){ 
													$phpiCal_config->setProperty('template', 			$phpicalendar['cookie_style']);
	}	
	if (isset($phpicalendar['cookie_startday'])) 	$phpiCal_config->setProperty('week_start_day', 		$phpicalendar['cookie_startday']);
	if (isset($phpicalendar['cookie_time']))		$phpiCal_config->setProperty('day_start', 			$phpicalendar['cookie_time']); 
	if (isset($phpicalendar['cookie_endtime']))		$phpiCal_config->setProperty('day_end', 			$phpicalendar['cookie_endtime']); 
	if (isset($phpicalendar['cookie_timezone']))	$phpiCal_config->setProperty('timezone', 			$phpicalendar['cookie_timezone']); 
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
	if ($fill_min >= 60) {
		$fill_h = sprintf('%02d', ($fill_h + 1));
		$fill_min = '00';
	}
	$fillTime = $fill_h . $fill_min;
}

if (!isset($current_view)) $current_view = $phpiCal_config->default_view;

$tz_array=array();
/*echo "<pre>xx";
print_r($configs);
print_r($phpiCal_config);
echo "</pre>";
#die;
*/