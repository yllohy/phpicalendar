<?

// Retain some compatibility backwards like.
if(phpversion() >= "4.2.0") 

	{
		extract($HTTP_POST_VARS);
		extract($HTTP_GET_VARS);	
	}

$style_sheet = "default.css";			// Themes support
$fullpath = "webcal://";				// what iCal file are we using
$calendar_path = "./calendars";			// path to directory with calendars
$default_view = "day";					// filename of calendar without .ics
$default_cal = "Home";
$language = "English";					// Language support


if ($language == "English") { 	
	include "languages/english.inc.php";
} else {
	include "languages/english.inc.php";
}

?>