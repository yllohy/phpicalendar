<?php

// Danish language include
// For version 0.6 PHP iCalendar
//
// Translation by Henrik H¿jmark (styxx@worldonline.dk)
//            and Jakob PeterhŠnsel (marook@creepers.org)
//
// Submit new translations to chad@chadsdomain.com



$day_lang			= 'Dag';
$week_lang			= 'Uge';
$month_lang			= 'M&aring;ned';
$year_lang			= '&Aring;r';
$calendar_lang		= 'kalender';
$next_day_lang		= 'N&aelig;ste dag';
$next_month_lang	= 'N&aelig;ste m&aring;ned';
$next_week_lang		= 'N&aelig;ste uge';
$next_year_lang		= 'N&aelig;ste &aring;r';
$last_day_lang		= 'Forrige dag';
$last_month_lang	= 'Forrige m&aring;ned';
$last_week_lang		= 'Forrige uge';
$last_year_lang		= 'Forrige &aring;r';
$subscribe_lang		= 'Abonn&eacute;r';
$download_lang		= 'Hent';
$powered_by_lang 	= 'Drevet af';
$version_lang		= '0.6';
$event_lang			= 'Aftale';
$event_start_lang	= 'Start tidspunkt';
$event_end_lang		= 'Slut tidspunkt';
$this_months_lang	= 'Denne m&aring;neds aftaler';
$date_lang			= 'Dato';
$summary_lang		= 'Opsummering';

// new since last translation
$all_day_lang		= 'Heldags aftale';
$notes_lang			= 'Noter';
$this_years_lang	= 'Dette &aring;s aftaler';
$today_lang			= 'I dag';
$this_week_lang		= 'Denne uge';
$this_month_lang	= 'Denne m&aring;ned';
$jump_lang			= 'G&aring; til';
$tomorrows_lang		= 'N&aelig;ste dags aftaler';
$goday_lang			= 'G&aring; til i dag';
$goweek_lang		= 'G&aring; til denne uge';
$gomonth_lang		= 'G&aring; til denne m&aring;ned';
$goyear_lang		= 'G&aring; til dette &aring;r';

// new since last translation
$daysofweek_lang			= array ('S&oslash;ndag','Mandag','Tirsdag','Onsdag','Torsdag','Fredag','L&oslash;rdag');
$daysofweekshort_lang		= array ('S&oslash;n','Man','Tir','Ons','Tor','Fre','L&oslash;r');
$daysofweekreallyshort_lang	= array ('S','M','T','O','T','F','L');
$monthsofyear_lang			= array ('Januar','Februar','Marts','April','Maj','Juni','Juli','August','September','Oktober','November','December');
$monthsofyearshort_lang		= array ('Jan','Feb','Mar','Apr','Maj','Jun','Jul','Aug','Sep','Okt','Nov','Dec');

// For time formatting, check out: http://www.php.net/manual/en/function.date.php
$timeFormat = 'H:i';

// For date formatting, see note below
$dateFormat_day = '%A, %e %B';
$dateFormat_week = '%e %B';
$dateFormat_week_list = '%a, %e %b';
$dateFormat_week_jump = '%e %b';
$dateFormat_month = '%B %Y';
$dateFormat_month_list = '%A, %e %B';

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
$error_title_lang = 'Fejl!';
$error_window_lang = 'Der opstod en fejl!';
$error_calendar_lang = 'Kalenderen "%s" blev benyttet da fejlen opstod.';
$error_path_lang = 'Kan ikke &aring;bne stien : "%s"';
$error_back_lang = 'Brug venligst "Tilbage" knappen for at g&aring; tilbage.';
$error_remotecal_lang = 'Denne server blokerer for eksterne kalendere der ikke er blevet godkendt';
$error_restrictedcal_lang = 'Du har fors&oslash;gt at f&aring; adgang til en beskyttet kalender p&aring; denne server.';
$error_invalidcal_lang = 'Ugyldig kalender fil. Pr&oslash;v en anden kalender.';


?>
