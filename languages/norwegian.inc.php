<?php

// Norwegian language include
// For version 0.5 PHP iCalendar
//
// Translation by Geir Kielland (geir.kielland@jus.uio.no)
//
// Submit new translations to chad@chadsdomain.com



$day_lang			= "Dag";
$week_lang			= "Uke";
$month_lang			= "M&aring;ned";
$year_lang			= "&aring;r";
$calendar_lang		= "Kalender";
$next_day_lang		= "Neste Dag";
$next_month_lang	= "Neste M&aring;ned";
$next_week_lang		= "Neste Uke";
$next_year_lang		= "Neste &Aring;r";
$last_day_lang		= "Forrige Dag";
$last_month_lang	= "Forrige M&aring;ned";
$last_week_lang		= "Forrige Uke";
$last_year_lang		= "Forrige &Aring;r";
$subscribe_lang		= "Abonn&eacute;r";
$download_lang		= "Last Ned";
$powered_by_lang 	= "Powered by";
$version_lang		= "0.5";
$event_lang			= "Hendelse";
$event_start_lang	= "Start Tid";
$event_end_lang		= "Slutt Tid";
$this_months_lang	= "Denne M&aring;nedens Hendelser";
$date_lang			= "Dato";
$summary_lang		= "Sammendrag";
$all_day_lang		= "Hele dagen";
$notes_lang			= "Notater";

// new since last translation
$this_years_lang	= "This Year's Events";
$today_lang			= "Today";
$this_week_lang		= "This Week";
$this_month_lang	= "This Month";
$jump_lang			= "Jump to";
$tomorrows_lang		= "Tomorrow's Events";
$goday_lang			= "Go to Today";
$goweek_lang		= "Go to This Week";
$gomonth_lang		= "Go to This Month";
$goyear_lang		= "Go to This Year";

// Date display since setlocale isnt perfect. // new since last translation
$daysofweek_lang			= array ("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
$daysofweekshort_lang		= array ("Sun","Mon","Tue","Wed","Thu","Fri","Sat");
$daysofweekreallyshort_lang	= array ("S","M","T","W","T","F","S");
$monthsofyear_lang			= array ("January","February","March","April","May","June","July","August","September","October","November","December");
$monthsofyearshort_lang		= array ("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");


// Set Location for date formatting, check out: http://www.php.net/manual/en/function.setlocale.php
setlocale (LC_TIME, 'no_NO');

// For time formatting, check out: http://www.php.net/manual/en/function.date.php
$timeFormat = "H:i";

// For date formatting, see note below
$dateFormat_day = "%A, %e. %B ";
$dateFormat_week = "%e. %B";
$dateFormat_week_list = "%a, %e. %b";
$dateFormat_week_jump = "%b %e"; // new since last translation
$dateFormat_month = "%B %Y";
$dateFormat_month_list = "%A, %e. %B";

/*
Notes about dateFormat_*
	The pieces are similar to that of the PHP function strftime(), 
	however only the following is supported at this time:
	
	%A - the full week day name as specified in $daysofweek_lang
	%a - the shortened week day name as specified in $daysofweekshort_lang
	%B - the full month name as specified in $monthsofyear_lang
	%b - the shortened month name as specified in $monthsofyearshort_lang
	%e - the day of the month as a decimal number (1 to 31)
	%Y - the 4-digit year

	If this causes problems with representing your language accurately, let
	us know. We will be happy to modify this if needed.
*/

?>