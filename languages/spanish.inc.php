<?php

// Spanish language include
// For version 0.9 PHP iCalendar
//
// Translation by Javier Navarro from XIPS (jnavarro@xips.es)


$day_lang			= "D&iacute;a";
$week_lang			= "Semana";
$month_lang			= "Mes";
$year_lang			= "A&ntilde;o";
$calendar_lang		= "Calendario";
$next_day_lang		= "D&iacute;a siguiente";
$next_month_lang	= "Mes siguiente";
$next_week_lang		= "Semana siguiente";
$next_year_lang		= "A&ntilde;o siguiente";
$last_day_lang		= "D&iacute;a anterior";
$last_month_lang	= "Mes anterior";
$last_week_lang		= "Semana anterior";
$last_year_lang		= "A&ntilde;o anterior";
$subscribe_lang		= "Suscribir";
$download_lang		= "Descargar";
$powered_by_lang 	= "Powered by";
$version_lang		= "0.8";
$event_lang			= 'Evento';
$event_start_lang	= 'Inicio';
$event_end_lang		= 'Fin';
$this_months_lang	= 'Eventos de este mes';
$date_lang			= 'Fecha';
$summary_lang		= 'Descripci&oacute;n';
$all_day_lang		= 'Evento diario';
$notes_lang			= 'Notas';
$this_years_lang	= 'Eventos de este a&ntilde;o';
$today_lang			= 'Hoy';
$this_week_lang		= 'Esta semana';
$this_month_lang	= 'Este mes';
$jump_lang			= 'Ir a';
$tomorrows_lang		= 'Eventos de ma&ntilde;ana';
$goday_lang			= 'Ir a Hoy';
$goweek_lang		= 'Ir a Esta semana';
$gomonth_lang		= 'Ir a Este Mes';
$goyear_lang		= 'Ir a Este A&ntilde;o';
$search_lang		= 'Buscar'; // the verb
$results_lang		= 'Resultados de b&uacute;squeda';
$query_lang			= 'Consulta: '; // will be followed by the search query
$no_results_lang	= 'Ning&uacute;n evento encontrado';
$goprint_lang		= 'Formato de impresi&oacute;n';
$time_lang			= 'Hora';
$summary_lang		= 'Resumen';
$description_lang	= 'Descripci&oacute;n';
$this_site_is_lang		= 'Esta p&aacute;gina es';
$no_events_day_lang		= 'No hay eventos para hoy.';
$no_events_week_lang	= 'No hay eventos para esta semana.';
$no_events_month_lang	= 'No hay eventos para este mes.';
$rss_day_date			= 'g:i A';  // Lists just the time
$rss_week_date			= '%e de %b';  // Lists just the day
$rss_month_date			= '%e de %b';  // Lists just the day
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

$daysofweek_lang			= array ('Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado');
$daysofweekshort_lang		= array ('Dom','Lun','Mar','Mie','Jue','Vie','Sab');
$daysofweekreallyshort_lang	= array ('D','L','M','X','J','V','S');
$monthsofyear_lang			= array ('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
$monthsofyearshort_lang		= array ('Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic');

// For time formatting, check out: http://www.php.net/manual/en/function.date.php
$timeFormat = 'g:i A';
$timeFormat_small = 'g:i';

// For date formatting, see note below
$dateFormat_day = '%A, %e de %B';
$dateFormat_week = '%e de %B';
$dateFormat_week_list = '%a, %e de %b';
$dateFormat_week_jump = '%e de %e';
$dateFormat_month = '%B de %Y';
$dateFormat_month_list = '%A, %e de %B';

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
$error_title_lang = '&iexcl;Error!';
$error_window_lang = '&iexcl;Hubo un error!';
$error_calendar_lang = 'Cuando se produjo este error, se procesaba "%s" del calendario.';
$error_path_lang = 'Incapaz de abrir: "%s"';
$error_back_lang = 'Por favor, use el bot&oacute;n "Atr&aacute;s" para volver.';
$error_remotecal_lang = 'Este servidor bloquea calendarios remotos que no han sido aceptados.';
$error_restrictedcal_lang = 'Ha intentado llegar a un calendario que tiene el acceso restringido.';
$error_invalidcal_lang = 'Fichero de calendario inv&aacute;lido. Por favor, pruebe con otro calendario.';


?>
