<?php

// Dutch language include
// For version 0.5 PHP iCalendar
//
// Translation by Lieven Gekiere (Lieven@gekiere.com)
//
// Submit new translations to chad@chadsdomain.com



$day_lang			= "Dag";
$week_lang			= "Week";
$month_lang			= "Maand";
$year_lang			= "Jaar";
$calendar_lang		= "Kalender";
$next_day_lang		= "Volgende Dag";
$next_month_lang	= "Volgende Maand";
$next_week_lang		= "Volgende Week";
$next_year_lang		= "Volgend Jaar";
$last_day_lang		= "Vorige Dag";
$last_month_lang	= "Vorige Maand";
$last_week_lang		= "Vorige Week";
$last_year_lang		= "Vorig Jaar";
$subscribe_lang		= "Abonneer";
$download_lang		= "Download";
$powered_by_lang 	= "Gemaakt met";
$version_lang		= "0.5";
$event_lang			= "Activiteit";
$event_start_lang	= "Start Tijd";
$event_end_lang		= "Eind Tijd";
$this_months_lang	= "Activiteiten Deze Maand";
$date_lang			= "Datum";
$summary_lang		= "Overzicht";

// new since last translation
$all_day_lang		= "All day event";
$notes_lang			= "Notes";
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
setlocale (LC_TIME, 'nl_BE');

// For time formatting, check out: http://www.php.net/manual/en/function.date.php
$timeFormat = "G:i";

// For date formatting, see note below
$dateFormat_day = "%A %e %B";
$dateFormat_week = "%e %B";
$dateFormat_week_list = "%a %e %b";
$dateFormat_week_jump = "%b %e";// new since last translation
$dateFormat_month = "%B %Y";
$dateFormat_month_list = "%A %e %B";

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