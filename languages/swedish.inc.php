<?php

// Swedish language include
// For version 0.8 PHP iCalendar
//
// Translation by Jonas Hjelm (jonas@hnet.se)
//
// Submit new translations to chad@chadsdomain.com



$day_lang			= 'Dag';
$week_lang			= 'Vecka';
$month_lang			= 'M&aring;nad';
$year_lang			= '&Aring;r';
$calendar_lang		= 'kalender';
$next_day_lang		= 'Imorgon';
$next_month_lang	= 'N&auml;sta m&aring;nad';
$next_week_lang		= 'N&auml;sta vecka';
$next_year_lang		= 'N&auml;sta &aring;r';
$last_day_lang		= 'F&ouml;reg&aring;ende dag';
$last_month_lang	= 'F&ouml;reg&aring;ende m&aring;nad';
$last_week_lang		= 'F&ouml;reg&aring;ende vecka';
$last_year_lang		= 'F&ouml;reg&aring;ende &aring;r';
$subscribe_lang		= 'Prenumerera';
$download_lang		= 'H&auml;mta fil';
$powered_by_lang 	= 'Powered by';
$version_lang		= '0.8';
$event_lang			= 'H&auml;ndelse';
$event_start_lang	= 'Start tid';
$event_end_lang		= 'Slut tid';
$this_months_lang	= 'Denna m&aring;nads h&auml;ndelser';
$date_lang			= 'Datum';
$summary_lang		= 'Summering';
$all_day_lang		= 'Heldags h&auml;ndelse';
$notes_lang			= 'Notering';
$this_years_lang	= '&Aring;rest h&auml;ndelser';
$today_lang			= 'Idag';
$this_week_lang		= 'Denna vecka';
$this_month_lang	= 'Denna m&aring;nad';
$jump_lang			= 'G&aring; till';
$tomorrows_lang		= 'Morgondagens h&auml;ndelser';
$goday_lang			= 'G&aring; till dagens datum';
$goweek_lang		= 'G&aring; till denna vecka';
$gomonth_lang		= 'G&aring; till denna m&aring;nad';
$goyear_lang		= 'G&aring; till detta &aring;r';
$goprint_lang		= 'Printer Friendly';
$time_lang			= 'Time';
$summary_lang		= 'Summary';
$description_lang	= 'Description';

// RSS text for 0.8
$this_site_is_lang		= 'This site is';
$no_events_day_lang		= 'No events today.';
$no_events_week_lang	= 'No events this week.';
$no_events_month_lang	= 'No events this month.';
$rss_day_date			= 'g:i A';  // Lists just the time
$rss_week_date			= '%b %e';  // Lists just the day
$rss_month_date			= '%b %e';  // Lists just the day



$daysofweek_lang			= array ('S&ouml;ndag','M&aring;ndag','Tisdag','Onsdag','Torsdag','Fredag','L&ouml;rdag');
$daysofweekshort_lang		= array ('S&ouml;n','M&aring;n','Tis','Ons','Tor','Fre','L&ouml;r');
$daysofweekreallyshort_lang	= array ('S','M','T','O','T','F','L');
$monthsofyear_lang			= array ('Januari','Februari','Mars','April','Maj','Juni','Juli','Augusti','September','Oktober','November','December');
$monthsofyearshort_lang		= array ('Jan','Feb','Mar','Apr','Maj','Jun','Jul','Aug','Sep','Okt','Nov','Dec');

// For time formatting, check out: http://www.php.net/manual/en/function.date.php
$timeFormat = "H:i";
$timeFormat_small = 'g:i';

// For date formatting, see note below
$dateFormat_day = '%Aen den %e %B';
$dateFormat_week = "%e %B";
$dateFormat_week_list = '%a, %e %b';
$dateFormat_week_jump = "%e %b";
$dateFormat_month = '%B %Y';
$dateFormat_month_list = '%A, %B %e';

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

// Error messages - %s will be replaced with a variable
$error_title_lang = 'Fel!';
$error_window_lang = 'Det har blivit ett fel!';
$error_calendar_lang = 'Den var "%s" kalendern som jobbades med n&auml;r felet h&auml;nde.';
$error_path_lang = 'Kan inte &ouml;ppna s&ouml;kv&auml;g: "%s"';
$error_back_lang = 'Anv&auml;nd "Back" knappen p&aring; din webbl&auml;sare f&ouml;r att backa.';
$error_remotecal_lang = 'Denna server blockerar kalendrar pŒ andra servrar som &auml;nnu inte blivit accepterade an administrat&ouml;ren.';
$error_restrictedcal_lang = 'Du har f&ouml;rs&ouml;kt att komma &aring;t en kalender som du ej har l&auml;sr&auml;ttigher p&aring;.';
$error_invalidcal_lang = 'Fel p&aring; kalenderfilen. Prova g&auml;rna med en annan kalender.';

?>