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
$all_day_lang		= "All day event";

// Set Location for date formatting, check out: http://www.php.net/manual/en/function.setlocale.php
// for Switzerland
setlocale (LC_TIME, 'ch_DE');
// for Germany
// setlocale (LC_TIME, 'de_DE');
// for Austria
// setlocale (LC_TIME, 'at_DE');

// For time formatting, check out: http://www.php.net/manual/en/function.date.php
$timeFormat = "H:i";

// For date formatting, check out: http://www.php.net/manual/en/function.strftime.php
$dateFormat_day = "%A, %e. %B";
$dateFormat_week = "%B %e";
$dateFormat_week_list = "%a, %e. %b";
$dateFormat_month = "%B %Y";
$dateFormat_month_list = "%A, %e. %B";


?>