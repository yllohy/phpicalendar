<?

// Retain some compatibility backwards like.
if(phpversion() >= "4.2.0") 

	{
		extract($HTTP_POST_VARS);
		extract($HTTP_GET_VARS);	
	}

$style_sheet = "default.css";

// what iCal file are we using
$fullpath = "webcal://";
$filename = "calendars/Home.ics";

?>