<?

// German language include
// For version 0.5 PHP iCalendar
//
// Translation by David Reindl (dre@andare.ch)
//



$day_lang			= "Tag";
$week_lang			= "Woche";
$month_lang			= "Monat";
$year_lang			= "Jahr";
$calendar_lang		= "Kalender";
$next_day_lang		= "Folgender Tag";
$next_month_lang	= "Folgender Monat";
$next_week_lang		= "Folgende Woche";
$next_year_lang		= "Folgendes Jahr";
$last_day_lang		= "Vorhergehender Tag";
$last_month_lang	= "Vorhergehender Monat";
$last_week_lang		= "Vorhergehende Woche";
$last_year_lang		= "Vorhergehendes Jahr";
$subscribe_lang		= "Abonnieren";
$download_lang		= "Herunterladen";
$powered_by_lang 	= "Powered by";
$version_lang		= "0.5";
$event_lang			= "Eintrag";
$event_start_lang	= "Beginn";
$event_end_lang		= "Ende";
$this_months_lang	= "Alle Einträge in diesem Monat";
$date_lang			= "Datum";
$summary_lang		= "Beschreibung";

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
// for Switzerland
setlocale (LC_TIME, 'ch_DE');
// for Germany
// setlocale (LC_TIME, 'de_DE');
// for Austria
// setlocale (LC_TIME, 'at_DE');

// For time formatting, check out: http://www.php.net/manual/en/function.date.php
$timeFormat = "H:i";

// For date formatting, see note below
$dateFormat_day = "%A, %e. %B";
$dateFormat_week = "%B %e";
$dateFormat_week_list = "%a, %e. %b";
$dateFormat_week_jump = "%b %e";// new since last translation
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