<?php

// French language include
// For version 0.8 PHP iCalendar
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
$version_lang		= '0.8';
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

// new in 0.8 -------------
$search_lang		= 'Search'; // the verb
$results_lang		= 'Search Results';
$query_lang			= 'Query: '; // will be followed by the search query
$no_results_lang	= 'No events found';

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
// -------------------------

// Date display since setlocale isnt perfect. // new since last translation
$daysofweek_lang			= array ('Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi');
$daysofweekshort_lang		= array ('Dim','Lun','Mar','Mer','Jeu','Ven','Sam');
$daysofweekreallyshort_lang	= array ('D','L','M','M','J','V','S');
$monthsofyear_lang			= array ('Janvier','F&eacute;vrier','Mars','Avril','Mai','Juin','Juillet','Ao&ucirc;t','Septembre','Octobre','Novembre','D&eacute;cembre');
$monthsofyearshort_lang		= array ('jan','f&eacute;v','mar','avr','mai','juin','juil','ao&ucirc;','sep','oct','nov','d&eacute;c');



// For time formatting, check out: http://www.php.net/manual/fr/function.date.php
$timeFormat = 'H:i';

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