<? 
include('./config.inc.php');

// $cal_filename should always be the filename of the calendar without .ics
if (isset($_GET["cal"])) {
	$cal_filename = stripslashes(urldecode($_GET["cal"]));
	setcookie("cal",$cal_filename);
} elseif ($_COOKIE["cal"]) {
	$cal_filename = stripslashes(urldecode($_COOKIE["cal"]));
} else {
	$cal_filename = $default_cal;
}

if (!isset($filename)) {
	$filename = $calendar_path."/".$cal_filename.".ics";
}