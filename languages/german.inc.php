<?

// German language include
// For version 0.6 PHP iCalendar
//
// Translation by David Reindl (dre@andare.ch)
//



$day_lang			= 'Tag';
$week_lang			= 'Woche';
$month_lang			= 'Monat';
$year_lang			= 'Jahr';
$calendar_lang		= 'Kalender';
$next_day_lang		= 'Folgender Tag';
$next_month_lang	= 'Folgender Monat';
$next_week_lang		= 'Folgende Woche';
$next_year_lang		= 'Folgendes Jahr';
$last_day_lang		= 'Vorhergehender Tag';
$last_month_lang	= 'Vorhergehender Monat';
$last_week_lang		= 'Vorhergehende Woche';
$last_year_lang		= 'Vorhergehendes Jahr';
$subscribe_lang		= 'Abonnieren';
$download_lang		= 'Herunterladen';
$powered_by_lang 	= 'Powered by';
$version_lang		= '0.6';
$event_lang			= 'Eintrag';
$event_start_lang	= 'Beginn';
$event_end_lang		= 'Ende';
$this_months_lang	= 'Alle EintrÃ¤ge in diesem Monat';
$date_lang			= 'Datum';
$summary_lang		= 'Beschreibung';
$all_day_lang		= 'Tagesereignis';
$notes_lang			= 'Notiz';
$this_years_lang	= 'EintrŠge in diesem Jahr';
$today_lang			= 'Heute';
$this_week_lang		= 'Diese Woche';
$this_month_lang	= 'Diesen Monat';
$jump_lang			= 'Gehe zu';
$tomorrows_lang		= 'Morgige EintrŠge';
$goday_lang			= 'Gehe zu Heute';
$goweek_lang		= 'Gehe zur aktuellen Woche';
$gomonth_lang		= 'Gehe zum aktuellen Monat';
$goyear_lang		= 'Gehe zum aktuellen Jahr';

$daysofweek_lang			= array ('Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag');
$daysofweekshort_lang		= array ('Son','Mon','Die','Mit','Don','Fre','Sam');
$daysofweekreallyshort_lang	= array ('S','M','D','M','D','F','S');
$monthsofyear_lang			= array ('Januar','Februar','MŠrz','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember');
$monthsofyearshort_lang		= array ('Jan','Feb','MŠr','Apr','Mai','Jun','Jul','Aug','Sep','Okt','Nov','Dez');

// For time formatting, check out: http://www.php.net/manual/en/function.date.php
$timeFormat = 'H:i';

// For date formatting, see note below
$dateFormat_day = '%A, %e. %B';
$dateFormat_week = '%B %e';
$dateFormat_week_list = '%a, %e. %b';
$dateFormat_week_jump = ' %e. %b';
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
$error_title_lang = 'Error!';
$error_window_lang = 'There was an error!';
$error_calendar_lang = 'The calendar "%s" was being processed when this error occurred.';
$error_path_lang = 'Unable to open the path: "%s"';
$error_back_lang = 'Please use the "Back" button to return.';
$error_remotecal_lang = 'This server blocks remote calendars which have not been approved.';
$error_restrictedcal_lang = 'You have tried to access a calendar that is restricted on this server.';
$error_invalidcal_lang = 'Invalid calendar file. Please try a different calendar.';

?>