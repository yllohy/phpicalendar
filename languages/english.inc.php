<?php

// English language include
// For version 0.6 PHP iCalendar
//
// Translation by Chad Little (chad@chadsdomain.com)
//
// Submit new translations to chad@chadsdomain.com



$day_lang			= "Day";
$week_lang			= "Week";
$month_lang			= "Month";
$year_lang			= "Year";
$calendar_lang		= "Calendar";
$next_day_lang		= "Next Day";
$next_month_lang	= "Next Month";
$next_week_lang		= "Next Week";
$next_year_lang		= "Next Year";
$last_day_lang		= "Previous Day";
$last_month_lang	= "Previous Month";
$last_week_lang		= "Previous Week";
$last_year_lang		= "Previous Year";
$subscribe_lang		= "Subscribe";
$download_lang		= "Download";
$powered_by_lang 	= "Powered by";
$version_lang		= "0.6";
$event_lang			= "Event";
$event_start_lang	= "Start Time";
$event_end_lang		= "End Time";
$this_months_lang	= "This Month's Events";
$date_lang			= "Date";
$summary_lang		= "Summary";
$all_day_lang		= "All day event";
$notes_lang			= "Notes";
$this_years_lang	= "This Year's Events";
$today_lang			= "Today";
$this_week_lang		= "This Week";
$this_month_lang	= "This Month";
$jump_lang			= "Jump to";
$tomorrows_lang		= "Tomorrow's Events";

// Date display since setlocale isnt perfect.
$daysofweek_lang			= array ("Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday");
$daysofweekshort_lang		= array ("Sun","Mon","Tue","Wed","Thu","Fri","Sat");
$monthsofyear_lang			= array ("January","February","March","April","May","June","July","August","September","October","November","December");
$monthsofyearshort_lang		= array ("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");

// Set Location for date formatting, check out: http://www.php.net/manual/en/function.setlocale.php
// These do not work on Mac OS X, but are fine on other builds of *nix.
setlocale (LC_TIME, 'en_EN');

// For time formatting, check out: http://www.php.net/manual/en/function.date.php
$timeFormat = "g:i A";

// For date formatting, check out: http://www.php.net/manual/en/function.strftime.php
$dateFormat_day = "%A, %B %e";
$dateFormat_week = "%B %e";
$dateFormat_week_list = "%a, %b %e";
$dateFormat_week_jump = "%b %e";
$dateFormat_month = "%B %Y";
$dateFormat_month_list = "%A, %B %e";

?>