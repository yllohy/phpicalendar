<?php

// Spanish language include
// For version 0.8 PHP iCalendar
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

// new in 0.8 -------------
$search_lang		= 'Buscar'; // the verb
$results_lang		= 'Resultados de b&uacute;squeda';
$query_lang			= 'Consulta: '; // will be followed by the search query
$no_results_lang	= 'Ning&uacute;n evento encontrado';

$goprint_lang		= 'Formato de impresi&oacute;n';
$time_lang			= 'Hora';
$summary_lang		= 'Resumen';
$description_lang	= 'Descripci&oacute;n';

// RSS text for 0.8
$this_site_is_lang		= 'Esta p&aacute;gina es';
$no_events_day_lang		= 'No hay eventos para hoy.';
$no_events_week_lang	= 'No hay eventos para esta semana.';
$no_events_month_lang	= 'No hay eventos para este mes.';
$rss_day_date			= 'g:i A';  // Lists just the time
$rss_week_date			= '%e de %b';  // Lists just the day
$rss_month_date			= '%e de %b';  // Lists just the day
// -------------------------

$daysofweek_lang			= array ('Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado');
$daysofweekshort_lang		= array ('Dom','Lun','Mar','Mie','Jue','Vie','Sab');
$daysofweekreallyshort_lang	= array ('D','L','M','X','J','V','S');
$monthsofyear_lang			= array ('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
$monthsofyearshort_lang		= array ('Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic');

// For time formatting, check out: http://www.php.net/manual/en/function.date.php
$timeFormat = 'g:i A';

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
