<?php

// Dutch language include
// For version 0.8 PHP iCalendar
//
// Translation by Lieven Gekiere (Lieven@gekiere.com)
//
// Submit new translations to chad@chadsdomain.com



$day_lang			= 'Dag';
$week_lang			= 'Week';
$month_lang			= 'Maand';
$year_lang			= 'Jaar';
$calendar_lang		= 'Kalender';
$next_day_lang		= 'Volgende Dag';
$next_month_lang	= 'Volgende Maand';
$next_week_lang		= 'Volgende Week';
$next_year_lang		= 'Volgend Jaar';
$last_day_lang		= 'Vorige Dag';
$last_month_lang	= 'Vorige Maand';
$last_week_lang		= 'Vorige Week';
$last_year_lang		= 'Vorig Jaar';
$subscribe_lang		= 'Abonneer';
$download_lang		= 'Download';
$powered_by_lang 	= 'Gemaakt met';
$version_lang		= '0.8';
$event_lang			= 'Activiteit';
$event_start_lang	= 'Start Tijd';
$event_end_lang		= 'Eind Tijd';
$this_months_lang	= 'Activiteiten Deze Maand';
$date_lang			= 'Datum';
$summary_lang		= 'Overzicht';
$all_day_lang		= 'Dag Activiteit';
$notes_lang			= 'Opmerkingen';
$this_years_lang	= 'Activiteiten Dit Jaar';
$today_lang			= 'Vandaag';
$this_week_lang		= 'Deze Week';
$this_month_lang	= 'Deze Maand';
$jump_lang			= 'Ga naar';
$tomorrows_lang		= 'Activiteiten van morgen';
$goday_lang			= 'Ga Naar Vandaag';
$goweek_lang		= 'Ga Naar Deze Week';
$gomonth_lang		= 'Ga Naar Deze Maand';
$goyear_lang		= 'Ga Naar Dit Jaar';
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



// new since last translation
$daysofweek_lang			= array ('Zondag','Maandag','Dinsdag','Woensdag','Donderdag','Vrijdag','Zaterdag');
$daysofweekshort_lang		= array ('Zon','Ma','Din','Woe','Do','Vrij','Zat');
$daysofweekreallyshort_lang	= array ('Z','M','D','W','D','V','Z');
$monthsofyear_lang			= array ('Januari','Februari','Maart','April','Mei','Juni','Juli','Augustus','September','Oktober','November','December');
$monthsofyearshort_lang		= array ('Jan','Feb','Maa','Apr','Mei','Jun','Jul','Aug','Sep','Okt','Nov','Dec');

// For time formatting, check out: http://www.php.net/manual/en/function.date.php
$timeFormat = 'G:i';

// For date formatting, see note below
$dateFormat_day = '%A %e %B';
$dateFormat_week = '%e %B';
$dateFormat_week_list = '%a %e %b';
$dateFormat_week_jump = '%e %b';// new since last translation
$dateFormat_month = '%B %Y';
$dateFormat_month_list = '%A %e %B';

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
$error_title_lang = 'Fout!';
$error_window_lang = 'Er is een fout opgetreden!';
$error_calendar_lang = 'De kalender "%s" was aan het processen toen de fout gebeurde.';
$error_path_lang = 'Onmogelijk om het path te openen: "%s"';
$error_back_lang = 'Gebruik de "Back" knop om terug te keren.';
$error_remotecal_lang = 'Deze server blokt alle niet-geaccepteerde kalenders.';
$error_restrictedcal_lang = 'Je probeerde een beveiligde kalender te bekijken.';
$error_invalidcal_lang = 'Ongeldige Kalender file. Probeer een andere kalender aub.';


?>