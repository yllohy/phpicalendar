<?php

// Italian language include
// For version 0.9 PHP iCalendar
//
// First translation by Luca Cacciagrano (clooka@clac.it)
// Updated translation by Daniele Nicolucci (jollino@discussioni.org)
//
// Submit new translations to chad@chadsdomain.com



$day_lang			= 'Giorno';
$week_lang			= 'Settimana';
$month_lang			= 'Mese';
$year_lang			= 'Anno';
$calendar_lang		= 'Calendario';
$next_day_lang		= 'Giorno Successivo';
$next_month_lang	= 'Mese Successivo';
$next_week_lang		= 'Settimana Successiva';
$next_year_lang		= 'Anno Successivo';
$last_day_lang		= 'Giorno Precedente';
$last_month_lang	= 'Mese Precedente';
$last_week_lang		= 'Settimana Precedente';
$last_year_lang		= 'Anno Precedente';
$subscribe_lang		= 'Sottoscrivi';
$download_lang		= 'Scarica';
$powered_by_lang 	= 'Powered by';
$event_lang			= 'Evento';
$event_start_lang	= 'Inizio';
$event_end_lang		= 'Fine';
$this_months_lang	= 'Eventi di questo mese';
$date_lang			= 'Data';
$summary_lang		= 'Sommario';
$all_day_lang		= 'Eventi giornalieri';
$notes_lang			= 'Note';
$this_years_lang	= 'Eventi di quest\'anno';
$today_lang			= 'Oggi';
$this_week_lang		= 'Questa settimana';
$this_month_lang	= 'Questo mese';
$jump_lang			= 'Vai a';
$tomorrows_lang		= 'Eventi di domani';
$goday_lang			= 'Vai a oggi';
$goweek_lang		= 'Vai a questa settimana';
$gomonth_lang		= 'Vai a questo mese';
$goyear_lang		= 'Vai a quest\'anno';
$search_lang		= 'Ricerca'; // the verb
$results_lang		= 'Risultati ricerca';
$query_lang			= 'Cerca: '; // will be followed by the search query
$no_results_lang	= 'Nessun evento trovato';
$goprint_lang		= 'Printer Friendly';
$time_lang			= 'Ora';
$summary_lang		= 'Sommario';
$description_lang	= 'Descrizione';
$this_site_is_lang		= 'Questo sito &egrave;';
$no_events_day_lang		= 'Nessun evento per oggi.';
$no_events_week_lang	= 'Nessun evento per questa settimana.';
$no_events_month_lang	= 'Nessun evento per questo mese.';
$rss_day_date			= 'G:i';  // Lists just the time
$rss_week_date			= '%e %B';  // Lists just the day
$rss_month_date			= '%e %B';  // Lists just the day
$rss_language			= 'en-us';

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

// Date display since setlocale isnt perfect. // new since last translation
$daysofweek_lang			= array ('Domenica','Luned&iacute;','Marted&igrave;','Mercoled&igrave;','Gioved&igrave;','Venerd&igrave;','Sabato');
$daysofweekshort_lang		= array ('Dom','Lun','Mar','Mer','Gio','Ven','Sab');
$daysofweekreallyshort_lang	= array ('D','L','M','M','G','V','S');
$monthsofyear_lang			= array ('Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre');
$monthsofyearshort_lang		= array ('Gen','Feb','Mar','Apr','Mag','Giu','Lug','Ago','Set','Ott','Nov','Dic');

// For time formatting, check out: http://www.php.net/manual/en/function.date.php
$timeFormat = 'G:i';
$timeFormat_small = 'G:i';

// For date formatting, see note below
$dateFormat_day = '%A, %e %B';
$dateFormat_week = '%e %B';
$dateFormat_week_list = '%a, %e %b';
$dateFormat_week_jump = '%e %B';
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
$error_title_lang = 'Errore!';
$error_window_lang = 'C\'&egrave; un errore!';
$error_calendar_lang = 'L\'errore si &egrave; verificato con il calendario "%s" in esecuzione.';
$error_path_lang = 'Impossibile aprire il percorso: "%s"';
$error_back_lang = 'Usa il tasto "Indietro" per tornare alla pagina precedente.';
$error_remotecal_lang = 'Questo server blocca calendari che non sono stati approvati.';
$error_restrictedcal_lang = 'Hai tentato di accedere ad un calendario protetto su questo server.';
$error_invalidcal_lang = 'File di calendario non valido. Prova un altro calendario.';


?>