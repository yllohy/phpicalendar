<?php

// German language include
// For version 0.8 PHP iCalendar
//
// Translation by David Reindl (dre@andare.ch)
// Corrected by whippersnapper slomo (mail@slomo.de)
//
// Submit new translations to chad@chadsdomain.com



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
$event_lang			= 'Eintrag';
$event_start_lang	= 'Beginn';
$event_end_lang		= 'Ende';
$this_months_lang	= 'Alle Eintr&auml;ge in diesem Monat';
$date_lang			= 'Datum';
$summary_lang		= 'Beschreibung';
$all_day_lang		= 'Tagesereignis';
$notes_lang			= 'Notiz';
$this_years_lang	= 'Eintr&auml;ge in diesem Jahr';
$today_lang			= 'Heute';
$this_week_lang		= 'Diese Woche';
$this_month_lang	= 'Diesen Monat';
$jump_lang			= 'Gehe zu';
$tomorrows_lang		= 'Morgige Eintr&auml;ge';
$goday_lang			= 'Gehe zum heutigen Tag';
$goweek_lang		= 'Gehe zur aktuellen Woche';
$gomonth_lang		= 'Gehe zum aktuellen Monat';
$goyear_lang		= 'Gehe zum aktuellen Jahr';
$search_lang		= 'Suchen'; // the verb
$results_lang		= 'Suchresultate';
$query_lang			= 'Suche: '; // will be followed by the search query
$no_results_lang	= 'Keine Eintr&auml;ge gefunden';
$goprint_lang		= 'Druckversion';
$time_lang			= 'Zeit';
$summary_lang		= 'Zusammenfassung';
$description_lang	= 'Beschreibung';
$this_site_is_lang		= 'Diese Site ist';
$no_events_day_lang		= 'Keine Eintr&auml;ge f&uuml;r heute.';
$no_events_week_lang	= 'Keine Eintr&auml;ge in dieser Woche.';
$no_events_month_lang	= 'Keine Eintr&auml;ge in diesem Monat.';
$rss_day_date			= 'H:i';  // Lists just the time
$rss_week_date			= '%e. %b';  // Lists just the day
$rss_month_date			= '%e. %b';  // Lists just the day
$rss_language			= 'en-us';

// new in 0.9 ----------------------

$search_took_lang		= 'Suche dauerte %s Sekunden';
$recurring_event_lang	= 'Wiederkehrender Eintrag';
$exception_lang			= 'Ausnahme';
$no_query_lang			= 'Kein Suchbegriff';
$preferences_lang		= 'Einstellungen';
$printer_lang			= 'Drucker';
$select_lang_lang		= 'Standardsprache w&auml;hlen:';
$select_cal_lang		= 'Standardkalender w&auml;hlen:';
$select_view_lang		= 'Standardansicht  w&auml;hlen:';
$select_time_lang		= 'Tag beginnt um:';
$select_day_lang		= 'Woche beginnt mit:';
$select_style_lang		= 'Standardstil w&auml;hlen:';
$set_prefs_lang			= 'Einstellungen speichern';
$completed_date_lang	= 'Erledigt am';
$completed_lang			= 'Erledigt';
$created_lang			= 'Erstellt:';
$due_lang				= 'F&auml;llig:';
$priority_lang			= 'Priorit&auml;t:';
$priority_high_lang		= 'hoch';
$priority_low_lang		= 'tief';
$priority_medium_lang	= 'mittel';
$priority_none_lang		= 'keine';
$status_lang			= 'Status:';
$todo_lang				= 'Aufgaben';
$unfinished_lang		= 'Pendent';

// $format_recur, items enclosed in % will be substituted with variables
$format_recur_lang['delimiter']	= ', ';								// ie, 'one, two, three'

$format_recur_lang['yearly']		= array('Jahr','Jahre');		// for these, put singular
$format_recur_lang['monthly']		= array('Monat','Monate');		// and plural forms
$format_recur_lang['weekly']		= array('Woche','Wochen');		// these will be %freq%
$format_recur_lang['daily']			= array('Tag','Tage');			// in the replacement below
$format_recur_lang['hourly']		= array('Stunde','Stunden');
$format_recur_lang['minutely']		= array('Minute','Minuten');
$format_recur_lang['secondly']		= array('Sekunde','Sekunden');

$format_recur_lang['start']			= 'Jeden %int% %freq% %for%';	// ie, 'Every 1 day until January 4' or 'Every 1 day for a count of 5'
$format_recur_lang['until']			= 'bis %date%';				// ie, 'until January 4'
$format_recur_lang['count']			= 'f&uuml;r %int% Mal';		// ie, 'for 5 times'

$format_recur_lang['bymonth']		= 'In den Monaten: %list%';			// ie, 'In months: January, February, March'
$format_recur_lang['bymonthday']	= 'An den Daten: %list%';			// ie, 'On dates: 1, 2, 3, 4'
$format_recur_lang['byday']			= 'An den Tagen: %list%';			// ie, 'On days: Mon, Tues, Wed, Thurs'

// ---------------------------------

$daysofweek_lang			= array ('Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag');
$daysofweekshort_lang		= array ('Son','Mon','Die','Mit','Don','Fre','Sam');
$daysofweekreallyshort_lang	= array ('S','M','D','M','D','F','S');
$monthsofyear_lang			= array ('Januar','Februar','M&auml;rz','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember');
$monthsofyearshort_lang		= array ('Jan','Feb','M&auml;r','Apr','Mai','Jun','Jul','Aug','Sep','Okt','Nov','Dez');

// For time formatting, check out: http://www.php.net/manual/en/function.date.php
$timeFormat = 'H:i';
$timeFormat_small = 'H:i';

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
$error_calendar_lang = 'Der Kalender "%s" wurde bearbeitet, als dieser Fehler auftrat.';
$error_path_lang = 'Der Pfad "%s" kann nicht ge&ouml;ffnet werden.';
$error_back_lang = 'Bitte klicken Sie die "Zur&uuml;ck" Schaltfl&auml;che des Browsers um zur&uuml;ckzuspringen.';
$error_remotecal_lang = 'Dieser Server blockiert entfernte Kalender, welche nicht freigegeben wurden.';
$error_restrictedcal_lang = 'Sie haben versucht einen Kalender mit eingeschr&auml;nktem Zugriff auf diesem Server aufzurufen.';
$error_invalidcal_lang = 'Dieser Kalender enth&auml;lt Fehler. Bitte w&auml;hlen Sie einen anderen aus.';

?>