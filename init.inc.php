<?php 
// Retain some compatibility backwards like.
if(phpversion() >= "4.2.0") 

	{
		extract($HTTP_GET_VARS);	
		extract($HTTP_POST_VARS);
	}

include('./config.inc.php');

// language support
$language = strtolower($language);
$lang_file = "./languages/$language.inc.php";

if (file_exists($lang_file)) {
	include($lang_file);
} else {
//	Not sure if we should print this warning or not. It would inform the user
//	why the language isn't working.
	print "File \"$lang_file\" does not exist, defaulting to English<br><br>";
	include("./languages/english.inc.php");
}

// $cal_displayname is $cal_filename with occurrences of "32" replaced with " "
// $cal_filename should always be the filename of the calendar without .ics
if (isset($_GET["cal"])) {
	$cal_filename = stripslashes(urldecode($_GET["cal"]));
} else {
	$cal_filename = $default_cal;
}

$cal_displayname = str_replace("32", " ", $cal_filename);
$cal = urlencode($cal_filename);

if (!isset($filename)) {
	$filename = $calendar_path."/".$cal_filename.".ics";
}

?>