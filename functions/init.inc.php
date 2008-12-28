<?php 
$php_started = getmicrotime();
# define BASE
if (!defined('BASE')) define('BASE', './');
include_once(BASE.'functions/init/sanitize.php');
include_once(BASE.'functions/init/set_error_reporting.php');
include_once(BASE.'functions/init/configs.php');
include_once(BASE.'functions/init/cpaths.php');
include_once(BASE.'functions/init/date_range.php');
include_once(BASE.'error.php');
include_once(BASE.'functions/calendar_functions.php');
include_once(BASE.'functions/userauth_functions.php');

# require php 5
if (phpversion() < '5.1') die (error(sprintf($lang['l_php_version_required'],phpversion()) ) );
// Grab the action (login or logout).
$action = '';
if (isset($_GET['action']))			$action = $_GET['action'];
else if (isset($_POST['action']))	$action = $_POST['action'];											
	
// Login and/or logout.
list($username, $password, $invalid_login) = user_login();
if ($action != 'login') $invalid_login = false;
if ($action == 'logout' || $invalid_login) {
	list($username, $password) = user_logout();
}

if (ini_get('max_execution_time') < 60) {
	@ini_set('max_execution_time', '60');
}

// Pull the calendars off the GET line if provided. The $cal_filename
// is always an array, because this makes it easier to deal with below.
$cal_filenames = array();
if (isset($_GET['cal'])) {
	// If the cal value is not an array, split it into an array on
	// commas.
	if (!is_array($_GET['cal']))
		$_GET['cal'] = explode(',', $_GET['cal']);
	
	// Grab the calendar filenames off the cal value array.
	$cal_filenames = $_GET['cal'];
} else {
	if (isset($default_cal_check)) {
		if ($default_cal_check != $phpiCal_config->ALL_CALENDARS_COMBINED) {
			$calcheck = $phpiCal_config->calendar_path.'/'.$default_cal_check.'.ics'; 
			$calcheckopen = @fopen($calcheck, "r");
			if ($calcheckopen == FALSE) {
				$cal_filenames = explode(',',$default_cal);
			} else {
				$cal_filenames[0] = $default_cal_check;
			}
		} else {
			$cal_filenames[0] = $phpiCal_config->ALL_CALENDARS_COMBINED;
		}
	} else {
		$cal_filenames = explode(',',$phpiCal_config->default_cal);
	}
}

//load cal_filenames if $ALL_CALENDARS_COMBINED
if ($cal_filenames[0] == $phpiCal_config->ALL_CALENDARS_COMBINED){
	$cal_filenames = availableCalendars($username, $password, $phpiCal_config->ALL_CALENDARS_COMBINED);
}
// Separate the calendar identifiers into web calendars and local
// calendars.
$web_cals = array();
$local_cals = array();
foreach ($cal_filenames as $cal_filename) {
	# substitute for md5-obscured list_webcals
	foreach ($list_webcals as $tmp_cal){
		if($cal_filename == md5($phpiCal_config->salt.$tmp_cal)) $cal_filename = $tmp_cal;
	}
	// If the calendar identifier begins with a web protocol, this is a web
	// calendar.
	$cal_filename = urldecode($cal_filename); #need to decode for substr statements to identify webcals
	$cal_filename = str_replace(' ','%20', $cal_filename); #need to reencode blank spaces for matching with $list_webcals
	if (substr($cal_filename, 0, 7) == 'http://' ||
		substr($cal_filename, 0, 8) == 'https://' ||
		substr($cal_filename, 0, 9) == 'webcal://')
	{
		#jump sends cal url without .ics extension.  Add it if needed.
	#	if (substr($cal_filename, -4) != ".ics") $cal_filename .= ".ics";
		$web_cals[] = $cal_filename;
	}
	
	// Otherwise it is a local calendar.
	else {
		// Check blacklisted.
		if (in_array($cal_filename, $blacklisted_cals)  && $cal_filename !='') {
			exit(error($lang['l_error_restrictedcal'], $cal_filename));
		}
		$local_cals[] = urldecode(str_replace(".ics", '', basename($cal_filename)));
	}
}

// We will build the calendar display name as we go. The final display
// name will get constructed at the end.
$cal_displaynames = array();

// This is our list of final calendars.
$cal_filelist = array();

// This is our list of URL encoded calendars.
$cals = array();

// Process the web calendars.
foreach ($web_cals as $web_cal) {
	// Make some protocol alternatives, and set our real identifier to the
	// HTTP protocol.
	$cal_webcalPrefix = str_replace('http://','webcal://',$web_cal);
	$cal_httpPrefix = str_replace('webcal://','http://',$web_cal);
	$cal_httpsPrefix = str_replace('webcal://','https://',$web_cal);
	$cal_httpsPrefix = str_replace('http://','https://',$web_cal);
		
	// We can only include this web calendar if we allow all web calendars
	// (as defined by $allow_webcals) or if the web calendar shows up in the
	// list of web calendars defined in config.inc.php.
	if ($phpiCal_config->allow_webcals != 'yes' &&
		!in_array($cal_webcalPrefix, $list_webcals) &&
		!in_array($cal_httpPrefix, $list_webcals) &&
		!in_array($cal_httpsPrefix, $list_webcals))
	{
		exit(error($lang['l_error_remotecal'], $web_cal));
	}
	
	// Pull the display name off the URL.
#	$cal_displaynames[] = substr(str_replace('32', ' ', basename($web_cal)), 0, -4);
	$cal_displaynames[] = substr(basename($web_cal), 0, -4);
	
	if(in_array($web_cal, $list_webcals)){
		$web_cal = md5($phpiCal_config->salt.$web_cal);
	}
	$cals[] = urlencode($web_cal);
	//$filename = $cal_filename;
	$subscribe_path = $cal_webcalPrefix;
	
	// Add the webcal to the available calendars.
	$web_cal = $cal_httpPrefix;
	$cal_filelist[] = $web_cal;
}

// Process the local calendars.
if (count($local_cals) > 0) {
	$local_cals = availableCalendars($username, $password, $local_cals);
	foreach ($local_cals as $local_cal) {
		$cal_displaynames[] = str_replace('32', ' ', getCalendarName($local_cal));
	}
	$cal_filelist = array_merge($cal_filelist, $local_cals);
	$cals = array_merge($cals, array_map("urlencode", array_map("getCalendarName", $local_cals)));
	
	// Set the download and subscribe paths from the config, if there is
	// only one calendar being displayed and those paths are defined.
	if (count($local_cals) == 1) {
		$filename = $local_cals[0];
		$add_cpath = '';
		if (isset($cpath) && $cpath !='') $add_cpath = "$cpath/";

		if (($phpiCal_config->download_uri == '') && (preg_match('/(^\/|\.\.\/)/', $filename) == 0)) {
			$subscribe_path = 'webcal://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF']).'/'.$filename;
			$download_filename = $filename;
		} elseif ($phpiCal_config->download_uri != '') {
			$newurl = eregi_replace("^(http://)", "", $phpiCal_config->download_uri); 
				$subscribe_path = 'webcal://'.$newurl.'/'.$add_cpath.basename($filename);
				$download_filename = $phpiCal_config->download_uri.'/'.$add_cpath.basename($filename);
		} else {
			$subscribe_path = $add_cpath;
			$download_filename = $add_cpath;
		}
	}
}

// We should only allow a download filename and subscribe path if there is
// only one calendar being displayed.
if (count($cal_filelist) > 1) {
	$subscribe_path = '';
	$download_filename = '';
}

// Build the final cal list. This is a comma separated list of the
// url-encoded calendar names and web calendar URLs.
$cal = implode(',', $cals);

// Build the final display name used for template substitution.
asort($cal_displaynames);
$cal_displayname = implode(', ', $cal_displaynames);

$rss_powered = ($phpiCal_config->enable_rss == 'yes') ? 'yes' : '';

function getmicrotime() { 
	list($usec, $sec) = explode(' ',microtime()); 
	return ((float)$usec + (float)$sec); 
}

$uid_list = array();
#uncomment for diagnostics
#echo "after init.inc.ics<pre>"; 
#echo "cals";print_r($cals);echo"\n\n";
#echo "cal_filenames";print_r($cal_filenames);echo"\n\n";
#echo "web_cals";print_r($web_cals);echo"\n\n";
#echo "local_cals";print_r($local_cals);echo"\n\n";
#echo "cal_filelist";print_r($cal_filelist);
#echo "cal_displaynames";print_r($cal_displaynames);
#echo "</pre><hr>";

?>