<?

// Italian language include
// For version 0.6 PHP iCalendar
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
$version_lang		= '0.6';
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

// Date display since setlocale isnt perfect. // new since last translation
$daysofweek_lang			= array ('Domenica','Luned&iacute;','Marted&igrave;','Mercoled&igrave;','Gioved&igrave;','Venerd&igrave;','Sabato');
$daysofweekshort_lang		= array ('Dom','Lun','Mar','Mer','Gio','Ven','Sab');
$daysofweekreallyshort_lang	= array ('D','L','M','M','G','V','S');
$monthsofyear_lang			= array ('Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno','Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre');
$monthsofyearshort_lang		= array ('Gen','Feb','Mar','Apr','Mag','Giu','Lug','Ago','Set','Ott','Nov','Dic');

// For time formatting, check out: http://www.php.net/manual/en/function.date.php
$timeFormat = 'G:i';

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
$error_title_lang = 'Error!';
$error_window_lang = 'There was an error!';
$error_calendar_lang = 'The calendar "%s" was being processed when this error occurred.';
$error_path_lang = 'Unable to open the path: "%s"';
$error_back_lang = 'Please use the "Back" button to return.';
$error_remotecal_lang = 'This server blocks remote calendars which have not been approved.';
$error_restrictedcal_lang = 'You have tried to access a calendar that is restricted on this server.';
$error_invalidcal_lang = 'Invalid calendar file. Please try a different calendar.';


?>
