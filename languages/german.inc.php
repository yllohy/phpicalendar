<?php

// German language include
// For version 0.8 PHP iCalendar
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
$version_lang		= '0.8';
$event_lang			= 'Eintrag';
$event_start_lang	= 'Beginn';
$event_end_lang		= 'Ende';
$this_months_lang	= 'Alle Einträge in diesem Monat';
$date_lang			= 'Datum';
$summary_lang		= 'Beschreibung';
$all_day_lang		= 'Tagesereignis';
$notes_lang			= 'Notiz';
$this_years_lang	= 'Einträge in diesem Jahr';
$today_lang			= 'Heute';
$this_week_lang		= 'Diese Woche';
$this_month_lang	= 'Diesen Monat';
$jump_lang			= 'Gehe zu';
$tomorrows_lang		= 'Morgige Einträge';
$goday_lang			= 'Gehe zu Heute';
$goweek_lang		= 'Gehe zur aktuellen Woche';
$gomonth_lang		= 'Gehe zum aktuellen Monat';
$goyear_lang		= 'Gehe zum aktuellen Jahr';

// new in 0.8 -------------
$search_lang		= 'Suchen'; // the verb
$results_lang		= 'Suchresultate';
$query_lang			= 'Suche: '; // will be followed by the search query
$no_results_lang	= 'Keine Einträge gefunden';

$goprint_lang		= 'Druckversion';
$time_lang			= 'Zeit';
$summary_lang		= 'Zusammenfassung';
$description_lang	= 'Beschreibung';

// RSS text for 0.8
$this_site_is_lang		= 'Diese Site ist';
$no_events_day_lang		= 'Keine Einträge für heute.';
$no_events_week_lang	= 'Keine Einträge in dieser Woche.';
$no_events_month_lang	= 'Keine Einträge in diesem Monat.';
$rss_day_date			= 'H:i';  // Lists just the time
$rss_week_date			= '%e. %b';  // Lists just the day
$rss_month_date			= '%e. %b';  // Lists just the day
// -------------------------

$daysofweek_lang			= array ('Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag');
$daysofweekshort_lang		= array ('Son','Mon','Die','Mit','Don','Fre','Sam');
$daysofweekreallyshort_lang	= array ('S','M','D','M','D','F','S');
$monthsofyear_lang			= array ('Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember');
$monthsofyearshort_lang		= array ('Jan','Feb','Mär','Apr','Mai','Jun','Jul','Aug','Sep','Okt','Nov','Dez');

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
$error_title_lang = 'Fehler!';
$error_window_lang = 'Es ist ein Fehler aufgetreten!';
$error_calendar_lang = 'Der Kalendar "%s" wurde bearbeitet, als dieser Fehler auftrat.';
$error_path_lang = 'Der Pfad "%s" kann nicht geöffnet werden.';
$error_back_lang = 'Bitte klicken Sie die "Zurück" Schaltfläche des Browsers um zurückzuspringen.';
$error_remotecal_lang = 'Dieser Server blockiert entfernte Kalendar, welche nicht bestätigt wurden..';
$error_restrictedcal_lang = 'Sie haben versucht einen Kalendar mit eingeschränktem Zugriff auf diesem Server aufzurufen.';
$error_invalidcal_lang = 'Dieser Kalender enthält Fehler. Bitte wählen Sie einen anderen aus.';

?>