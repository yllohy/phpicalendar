<?php

// Czech language include
// For version 0.9 PHP iCalendar
//
// Translation by Whit, studio jižák (whit@studio.jizak.cz)
//
// Submit new translations to chad@chadsdomain.com



$day_lang			= 'Den';
$week_lang			= 'Týden';
$month_lang			= 'Měsíc';
$year_lang			= 'Rok';
$calendar_lang		= 'Kalendář';
$next_day_lang		= 'Následující den';
$next_month_lang	= 'Následující měsíc';
$next_week_lang		= 'Následující týden';
$next_year_lang		= 'Příští rok';
$last_day_lang		= 'Předchozí den';
$last_month_lang	= 'Předchozí měsíc';
$last_week_lang		= 'Předchozí týden';
$last_year_lang		= 'Předchozí rok';
$subscribe_lang		= 'Přihlaš';
$download_lang		= 'Stáhni';
$powered_by_lang 	= 'Powered by';
$event_lang			= 'Událost';
$event_start_lang	= 'Začátek';
$event_end_lang		= 'Konec';
$this_months_lang	= 'Tento měsíc';
$date_lang			= 'Datum';
$summary_lang		= 'Souhrn';
$all_day_lang		= 'Celý den';
$notes_lang			= 'Poznámky';
$this_years_lang	= 'Tento rok';
$today_lang			= 'Dnes';
$this_week_lang		= 'Tento týden';
$this_month_lang	= 'Tento měsíc';
$jump_lang			= 'Jdi';
$tomorrows_lang		= 'Odpoledne';
$goday_lang			= 'Dnešek';
$goweek_lang		= 'Tento týden';
$gomonth_lang		= 'Tento měsíc';
$goyear_lang		= 'Tento rok';
$search_lang		= 'Hledej'; // the verb
$results_lang		= 'Výsledky hledání';
$query_lang			= 'Dotaz: '; // will be followed by the search query
$no_results_lang	= 'Žádné nalezené záznamy';
$goprint_lang		= 'Tisk';
$time_lang			= 'Čas';
$summary_lang		= 'Výsledek';
$description_lang	= 'Popis';
$this_site_is_lang		= 'Tato stránka je';
$no_events_day_lang		= 'Žádné záznamy v tomto dni.';
$no_events_week_lang	= 'Žádné záznamy v tomto týdnu.';
$no_events_month_lang	= 'Žádné záznamy v tomto měsíci.';
$rss_day_date			= 'G:i A';  // Lists just the time
$rss_week_date			= '%A, %e %B';  // Lists just the day
$rss_month_date			= '%A, %e %B';  // Lists just the day
$rss_language			= 'cs-cz';

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

// - navigation
$back_lang = 'Back';
$next_lang = 'Next';
$prev_lang = 'Prev';
$day_view_lang = 'Day View';
$week_view_lang = 'Week View';
$month_view_lang = 'Month View';
$year_view_lang = 'Year View';

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

$daysofweek_lang			= array ('Neděle','Pondělí','Úterý','Středa','Čtvrtek','Pátek','Sobota');
$daysofweekshort_lang		= array ('Ne','Po','Út','St','Čt','Pá','So');
$daysofweekreallyshort_lang	= array ('N','P','Ú','S','Č','P','S');
$monthsofyear_lang			= array ('Leden','Únor','Březen','Duben','Květen','Červen','Červenec','Srpen','Září','Říjen','Listopad','Prosinec');
$monthsofyearshort_lang		= array ('Led.','Úno.','Bře.','Dub.','Kvě.','Čer.','Čec.','Srp.','Zář.','Říj.','List.','Pros.');

// For time formatting, check out: http://www.php.net/manual/en/function.date.php
$timeFormat = 'G:i';

// For date formatting, see note below
$dateFormat_day = '%A, %e. %B';
$dateFormat_week = '%e. %B';
$dateFormat_week_list = '%a, %e. %b';
$dateFormat_week_jump = '%e. %B';// new since last translation
$dateFormat_month = '%B %Y';
$dateFormat_month_list = '%A, %e. %B';

/*
Notes about $dateFormat_*
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
$error_title_lang = 'Chyba!';
$error_window_lang = 'Chybové okno!';
$error_calendar_lang = 'Při vytváření kalendáře „%s” se vyskytla chyba.';
$error_path_lang = 'Nelze otevřít: "%s"';
$error_back_lang = 'Použij tlačítko "Zpět" pro návrat.';
$error_remotecal_lang = 'Tento server blokuje vzdálené kalendáře, které nejsou odsouhlaseny.';
$error_restrictedcal_lang = 'Zkoušíš přistupovat k zamknutému kalendáři.';
$error_invalidcal_lang = 'Chybný soubor. Vyber jiný kalendář.';

?>