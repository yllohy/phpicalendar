<?php

// French language include
// For version 0.9 PHP iCalendar
//
// Translation by La Shampouineuse (info@lashampoo.com)
//
// Submit new translations to chad@chadsdomain.com



$day_lang			= 'Jour';
$week_lang			= 'Semaine';
$month_lang			= 'Mois';
$year_lang			= 'Ann&eacute;e';
$calendar_lang		= 'Calendrier';
$next_day_lang		= 'Jour suivant';
$next_month_lang	= 'Mois suivant';
$next_week_lang		= 'Semaine suivante';
$next_year_lang		= 'Ann&eacute;e suivante';
$last_day_lang		= 'Jour pr&eacute;c&eacute;dent';
$last_month_lang	= 'Mois pr&eacute;c&eacute;dent';
$last_week_lang		= 'Semaine pr&eacute;c&eacute;dente';
$last_year_lang		= 'Ann&eacute;e pr&eacute;c&eacute;dente';
$subscribe_lang		= 'Souscrire';
$download_lang		= 'T&eacute;l&eacute;charger';
$powered_by_lang 	= 'Produit avec';
$event_lang			= '&Eacute;v&eacute;nement';
$event_start_lang	= 'D&eacute;but';
$event_end_lang		= 'Fin';
$this_months_lang	= '&Eacute;v&eacute;nements de ce mois';
$date_lang			= 'Date';
$summary_lang		= 'R&eacute;sum&eacute;';
$all_day_lang		= '&Eacute;v&eacute;nement quotidien';
$notes_lang			= 'Notes';
$this_years_lang	= '&Eacute;v&eacute;nements de cette ann&eacute;';
$today_lang			= 'Aujourd\'hui';
$this_week_lang		= 'Cette semaine';
$this_month_lang	= 'Ce mois';
$jump_lang			= 'Voir';
$tomorrows_lang		= '&Eacute;v&eacute;nements de demain';
$goday_lang			= 'Voir aujourd\'hui';
$goweek_lang		= 'Voir cette semaine';
$gomonth_lang		= 'Voir ce mois';
$goyear_lang		= 'Voir cette ann&eacute;e';
$search_lang		= 'Recherche'; // the verb
$results_lang		= 'R&eacute;sultats de la recherche';
$query_lang			= 'Requ&ecirc;te: '; // will be followed by the search query
$no_results_lang	= 'Aucun &eacute;v&eacute;nement trouv&eacute;';
$goprint_lang		= 'Version imprimable';
$time_lang			= 'Heure';
$summary_lang		= 'R&eacute;sum&eacute;';
$description_lang	= 'Description';
$this_site_is_lang		= 'Ce site est';
$no_events_day_lang		= 'Pas d\'&eacute;v&eacute;nement aujourd\'hui.';
$no_events_week_lang	= 'Pas d\'&eacute;v&eacute;nement cette semaine.';
$no_events_month_lang	= 'Pas d\'&eacute;v&eacute;nement ce mois-ci.';
$rss_day_date			= 'H:i';  // Lists just the time
$rss_week_date			= '%e %b';  // Lists just the day
$rss_month_date			= '%e %b';  // Lists just the day
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

$daysofweek_lang			= array ('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi');
$daysofweekshort_lang		= array ('Dim','Lun','Mar','Mer','Jeu','Ven','Sam');
$daysofweekreallyshort_lang	= array ('D','L','M','M','J','V','S');
$monthsofyear_lang			= array ('Janvier','F&eacute;vrier','Mars','Avril','Mai','Juin','Juillet','Ao&ucirc;t','Septembre','Octobre','Novembre','D&eacute;cembre');
$monthsofyearshort_lang		= array ('jan','f&eacute;v','mar','avr','mai','juin','juil','ao&ucirc;','sep','oct','nov','d&eacute;c');



// For time formatting, check out: http://www.php.net/manual/fr/function.date.php
$timeFormat = 'H:i';
$timeFormat_small = 'g:i';

// For date formatting, see note below
$dateFormat_day = '%A %e %B';
$dateFormat_week = '%e %B';
$dateFormat_week_list = '%a %e %b';
$dateFormat_week_jump = '%e %b';
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
$error_title_lang = 'Erreur!';
$error_window_lang = 'Une erreur s\'est produite!';
$error_calendar_lang = 'L\'erreur s\'est produite lors du traitement du calendrier "%s".';
$error_path_lang = 'Impossible d\'ouvrir le chemin: "%s"';
$error_back_lang = 'Veuillez utiliser le bouton "Retour" pour revenir en arri&egrave;re.';
$error_remotecal_lang = 'Ce serveur refuse les calendriers distants non approuv&eacute;s.';
$error_restrictedcal_lang = 'Vous avez essay&eacute; d\'utiliser un calendrier dont les permissions sont restreintes sur ce serveur.';
$error_invalidcal_lang = 'Fichier calendrier invalide. Veuillez utiliser un autre calendrier.';


?>