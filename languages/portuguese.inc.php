<?php

// Portuguese language include
// For version 0.9 PHP iCalendar
//
// Translation by Rui Costa (ruicosta@ubi.pt)
//
// Submit new translations to chad@chadsdomain.com



$day_lang               = 'Dia';
$week_lang              = 'Semana';
$month_lang             = 'Mes';
$year_lang              = 'Ano';
$calendar_lang          = 'Calendario';
$next_day_lang          = 'Dia seguinte';
$next_month_lang        = 'Mes seguinte';
$next_week_lang         = 'Proxima semana';
$next_year_lang         = 'Ano Seguinte';
$last_day_lang          = 'Dia anterior';
$last_month_lang        = 'Mes anterior';
$last_week_lang         = 'Semana anterior';
$last_year_lang         = 'Ano anterior';
$subscribe_lang         = 'Assinar';
$download_lang          = 'Download';
$powered_by_lang        = 'Powered by';
$event_lang             = 'Evento';
$event_start_lang       = 'Hora de inicio';
$event_end_lang         = 'Hora de fim';
$this_months_lang       = 'Registos para deste mes';
$date_lang              = 'Data';
$summary_lang           = 'Sumario';
$all_day_lang           = 'Todo dia';
$notes_lang             = 'Notas';
$this_years_lang        = 'Registos deste ano';
$today_lang             = 'Hoje';
$this_week_lang         = 'Esta semana';
$this_month_lang        = 'Este mes';
$jump_lang              = 'Ir para';
$tomorrows_lang         = 'Registos para amanha';
$goday_lang             = 'Ver Hoje';
$goweek_lang            = 'Ver esta semana';
$gomonth_lang           = 'Ver este mes';
$goyear_lang            = 'Ver este ano';
$search_lang            = 'Procurar'; // the verb
$results_lang           = 'Resultados da pesquisa';
$query_lang             = 'Pesquisa por: '; // will be followed by the search query
$no_results_lang        = 'Nao foram encontrados registos';
$goprint_lang           = 'Versao para Imprimir';
$time_lang              = 'Hora';
$summary_lang           = 'Resumo';
$description_lang       = 'Descricao';
$this_site_is_lang      = 'Este site e';
$no_events_day_lang     = 'Nao existem registos para hoje.';
$no_events_week_lang    = 'Nao existem registos para esta semana.';
$no_events_month_lang   = 'Nao existem registos para este mes.';
$rss_day_date           = 'g:i A';  // Lists just the time
$rss_week_date          = '%e %b';  // Lists just the day
$rss_month_date         = '%e %b';  // Lists just the day

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

$daysofweek_lang                        = array ('Domingo','Segunda','Terca','Quarta','Quinta','Sexta','Sabado');
$daysofweekshort_lang                = array ('Dom','Seg','Ter','Qua','Qui','Sex','Sab');
$daysofweekreallyshort_lang        = array ('D','S','T','Q','Q','S','S');
$monthsofyear_lang                        = array ('Janeiro','Fevereiro','Marco','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');
$monthsofyearshort_lang                = array ('Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez');

// For time formatting, check out: http://www.php.net/manual/en/function.date.php
$timeFormat = 'g:i A';
$timeFormat_small = 'g:i';

// For date formatting, see note below
$dateFormat_day = '%A,%e %B';
$dateFormat_week = '%e %B';
$dateFormat_week_list = '%a, %e %b';
$dateFormat_week_jump = '%e %b';
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
$error_title_lang = 'Erro!';
$error_window_lang = 'Aconteceu um erro!';
$error_calendar_lang = 'O calendario "%s" estava a ser processado quando ocorreu este erro.';
$error_path_lang = 'Não foi possivel abrir: "%s"';
$error_back_lang = 'Por favor use o botao de "Back" para voltar.';
$error_remotecal_lang = 'Este servidor bloqueia calendarios remotos que nao foram aprovados.';
$error_restrictedcal_lang = 'Tentou aceder a um calendario onde e restricto o acesso neste servidor.';
$error_invalidcal_lang = 'Ficheiro de calendario invalido. Por favor tente usar outro claendario.';

?>
