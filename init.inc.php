<? 
// Retain some compatibility backwards like.
if(phpversion() >= "4.2.0") 

	{
		extract($HTTP_GET_VARS);	
		extract($HTTP_POST_VARS);
	}

include('./config.inc.php');

// define supported languages
switch ($language) {
	case "German":
		include("./languages/german.inc.php");
		break;
	case "Polish":
		include("./languages/polish.inc.php");
		break;
	case "French":
		include("./languages/french.inc.php");
		break;
	default:
		include("./languages/english.inc.php");
}

// $cal_displayname is $cal_filename with occurrences of "32" replaced with " "
// $cal_filename should always be the filename of the calendar without .ics
if (isset($_GET["cal"])) {
	$cal_filename = stripslashes(urldecode($_GET["cal"]));
	setcookie("cal",$cal_filename);
} elseif ($_COOKIE["cal"]) {
	$cal_filename = stripslashes(urldecode($_COOKIE["cal"]));
} else {
	$cal_filename = $default_cal;
}

$cal_displayname = str_replace("32", " ", $cal_filename);
$cal = urlencode($cal_filename);

if (!isset($filename)) {
	$filename = $calendar_path."/".$cal_filename.".ics";
}