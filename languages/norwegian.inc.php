<?php

// Norwegian language include
// For version 0.9 PHP iCalendar
//
// Translation by Geir Kielland (geir.kielland@jus.uio.no)
//
// Submit new translations to chad@chadsdomain.com



$day_lang			= 'Dag';
$week_lang			= 'Uke';
$month_lang			= 'M&aring;ned';
$year_lang			= '&aring;r';
$calendar_lang		= 'kalender';
$next_day_lang		= 'Neste dag';
$next_month_lang	= 'Neste m&aring;ned';
$next_week_lang		= 'Neste uke';
$next_year_lang		= 'Neste &aring;r';
$last_day_lang		= 'Forrige dag';
$last_month_lang	= 'Forrige m&aring;ned';
$last_week_lang		= 'Forrige uke';
$last_year_lang		= 'Forrige &aring;r';
$subscribe_lang		= 'Abonn&eacute;r';
$download_lang		= 'Last ned';
$powered_by_lang 	= 'Kj&oslash;res med';
$event_lang			= 'Hendelse';
$event_start_lang	= 'Start tid';
$event_end_lang		= 'Slutt tid';
$this_months_lang	= 'Denne M&aring;nedens Hendelser';
$date_lang			= 'Dato';
$summary_lang		= 'Sammendrag';
$all_day_lang		= 'Hele dagen';
$notes_lang			= 'Notater';
$this_years_lang	= 'Hendelser dette &aring;ret';
$today_lang			= 'I dag';
$this_week_lang		= 'Denne uken';
$this_month_lang	= 'Denne m&aring;neden';
$jump_lang			= 'Hopp til';
$tomorrows_lang		= 'I morgen';
$goday_lang			= 'G&aring; til i dag';
$goweek_lang		= 'G&aring; til denne uken';
$gomonth_lang		= 'G&aring; til denne m&aring;neden';
$goyear_lang		= 'G&aring; til dette &aring;ret';
$search_lang		= 'S&oslash;k'; // the verb
$results_lang		= 'S&oslash;keresultater';
$query_lang			= 'Sp&oslash;rring: '; // will be followed by the search query
$no_results_lang	= 'Ingen hendelser funnet';
$goprint_lang		= 'Utskriftsvennlig';
$time_lang			= 'Tid';
$summary_lang		= 'Oppsummering';
$description_lang	= 'Beskrivelse';
$this_site_is_lang		= 'Dette nettstedet er';
$no_events_day_lang		= 'Ingen hendelser i dag.';
$no_events_week_lang	= 'Ingen hendelser denne uken.';
$no_events_month_lang	= 'Ingen hendelser denne m&aring;neden.';
$rss_day_date			= 'g:i A';  // Lists just the time
$rss_week_date			= '%b %e';  // Lists just the day
$rss_month_date			= '%b %e';  // Lists just the day

// new in 0.9 ----------------------

$search_took_lang		= 'Search took %s seconds';
$recurring_event_lang	= 'Recurring event';
$exception_lang			= 'Exception';
$no_query_lang			= 'No query given';
$preferences_lang		= 'Preferences';
$printer_lang			= 'Printer';
$select_lang_lang		= 'Select your default language:';
$select_cal_lang		= 'Select your default calendar:';
$select_view_lang		= 'Select your default view:';
$select_time_lang		= 'Select your default start time:';
$select_day_lang		= 'Select your default start day of week:';
$select_style_lang		= 'Select your default style:';
$set_prefs_lang			= 'Set preferences';
$completed_date_lang	= 'Completed on';
$completed_lang			= 'Completed';
$created_lang			= 'Created:';
$due_lang				= 'Due:';
$priority_lang			= 'Priority:';
$priority_high_lang		= 'High';
$priority_low_lang		= 'Low';
$priority_medium_lang	= 'Medium';
$priority_none_lang		= 'None';
$status_lang			= 'Status:';
$todo_lang				= 'To do items';
$unfinished_lang		= 'Unfinished';

// $format_recur, items enclosed in % will be substituted with variables
$format_recur_lang['delimiter']	= ', ';								// ie, 'one, two, three'

$format_recur_lang['yearly']		= array('year','years');		// for these, put singular
$format_recur_lang['monthly']		= array('month','months');		// and plural forms
$format_recur_lang['weekly']		= array('week','weeks');		// these will be %freq%
$format_recur_lang['daily']			= array('day','days');			// in the replacement below
$format_recur_lang['hourly']		= array('hour','hours');
$format_recur_lang['minutely']		= array('minute','minutes');
$format_recur_lang['secondly']		= array('second','seconds');

$format_recur_lang['start']			= 'Every %int% %freq% %for%';	// ie, 'Every 1 day until January 4' or 'Every 1 day for a count of 5'
$format_recur_lang['until']			= 'until %date%';				// ie, 'until January 4'
$format_recur_lang['count']			= 'for a count of %int%';		// ie, 'for 5 times'

$format_recur_lang['bymonth']		= 'In months: %list%';			// ie, 'In months: January, February, March'
$format_recur_lang['bymonthday']	= 'On dates: %list%';			// ie, 'On dates: 1, 2, 3, 4'
$format_recur_lang['byday']			= 'On days: %list%';			// ie, 'On days: Mon, Tues, Wed, Thurs'

// ---------------------------------

$daysofweek_lang			= array('S&oslash;ndag','Mandag','Tirsdag','Onsdag','Torsdag','Fredag','L&oslash;rdag');
$daysofweekshort_lang		= array ('S&oslash;n','Man','Tir','Ons','Tor','Fre','L&oslash;r');
$daysofweekreallyshort_lang	= array ('S','M','T','O','T','F','L');
$monthsofyear_lang			= array ('Januar','Februar','Mars','April','Mai','Juni','Juli','August','September','Oktober','November','Desember');
$monthsofyearshort_lang		= array ('Jan','Feb','Mar','Apr','Mai','Jun','Jul','Aug','Sep','Okt','Nov','Des');


// For time formatting, check out: http://www.php.net/manual/en/function.date.php
$timeFormat = 'H:i';
$timeFormat_small = 'H:i';

// For date formatting, see note below
$dateFormat_day = '%A, %e. %B ';
$dateFormat_week = '%e. %B';
$dateFormat_week_list = '%a, %e. %b';
$dateFormat_week_jump = '%b %e';
$dateFormat_month = '%B %Y';
$dateFormat_month_list = '%A, %e. %B';

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
$error_title_lang = 'Feil!';
$error_window_lang = 'Det skjedde en feil!';
$error_calendar_lang = 'Kalenderen "%s" var i bruk n&aring;r denne feilen oppstod.';
$error_path_lang = 'Kunne ikke &aring;pne adressen: "%s"';
$error_back_lang = 'Vennligst bruk "Tilbake" knappen for &aring; returnere.';
$error_remotecal_lang = 'Denne tjenermaskinen blokkerer ikke-lokale kalendere uten godkjenning.';
$error_restrictedcal_lang = 'Du har pr&oslash;vd &aring; &aring;pne en kalender som er sperret p&aring; denne tjenermaskinen.';
$error_invalidcal_lang = 'Ugyldig kalenderfil. Vennligst pr&oslash;v en annen kalenderfil.';


?>
