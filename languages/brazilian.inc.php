<?php

// Brazilian Portuguese language include
// For version 0.8 PHP iCalendar
//
// Translation by Wilton, Bennet (suporte@bennetworks.com.br) 
// 01-nov-2002 02:42 PM
// Submit new translations to chad@chadsdomain.com



$day_lang 				= 'Dia';
$week_lang				= 'Semana';
$month_lang				= 'M&ecirc;s';
$year_lang				= 'Ano';
$calendar_lang          = 'Calend&aacute;rio';
$next_day_lang          = 'Dia seguinte';
$next_month_lang        = 'M&ecirc;s seguinte';
$next_week_lang         = 'Pr&oacute;xima semana';
$next_year_lang         = 'Ano Seguinte';
$last_day_lang          = 'Dia anterior';
$last_month_lang        = 'M&ecirc;s anterior';
$last_week_lang         = 'Semana anterior';
$last_year_lang         = 'Ano anterior';
$subscribe_lang         = 'Assinar';
$download_lang          = 'Download';
$powered_by_lang        = 'Powered by';
$version_lang           = '0.8';
$event_lang                        = 'Evento';
$event_start_lang        = 'Hora de in&iacute;cio';
$event_end_lang                = 'Hora de fim';
$this_months_lang        = 'Eventos deste m&ecirc;s';
$date_lang                        = 'Data';
$summary_lang                = 'Sum&aacute;rio';
$all_day_lang                = 'Evento dia todo';
$notes_lang                        = 'Notas';
$this_years_lang        = 'Eventos deste ano';
$today_lang                        = 'Hoje';
$this_week_lang                = 'Esta semana';
$this_month_lang        = 'Este m&ecirc;s';
$jump_lang                        = 'Ir para';
$tomorrows_lang                = 'Eventos para amanha';
$goday_lang                        = 'Ir para Hoje';
$goweek_lang                = 'Ir para este semana';
$gomonth_lang                = 'Ir para este m&ecirc;s';
$goyear_lang                = 'Ir para este ano';

// new in 0.8 -------------
$search_lang		= 'Buscar'; // the verb
$results_lang		= 'Buscar Resultados';
$query_lang			= 'Quest&atilde;o: '; // will be followed by the search query
$no_results_lang	= 'Eventos n&atilde;o encontrados';

$goprint_lang		= 'Vers&atilde;o para imprimir';
$time_lang			= 'Hora';
$summary_lang		= 'Resumo';
$description_lang	= 'Descri&ccedil;&atilde;o';

// RSS text for 0.8
$this_site_is_lang		= 'Esse site &eacute;';
$no_events_day_lang		= 'N&atilde;o h&aacute; eventos para hoje.';
$no_events_week_lang	= 'N&atilde;o h&aacute; eventos para esta semana.';
$no_events_month_lang	= 'N&atilde;o h&aacute; eventos para esse m&ecirc;s.';
$rss_day_date			= 'g:i A';  // Lists just the time
$rss_week_date			= '%b %e';  // Lists just the day
$rss_month_date			= '%b %e';  // Lists just the day
// -------------------------

$daysofweek_lang                        = array ('Domingo','Segunda-Feira','Terca-Feira','Quarta-Feira','Quinta-Feira','Sexta-Feira','S&aacute;bado');
$daysofweekshort_lang                = array ('Dom','Seg','Ter','Qua','Qui','Sex','Sáb');
$daysofweekreallyshort_lang        = array ('D','S','T','Q','Q','S','S');
$monthsofyear_lang                        = array ('Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro');
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
$error_calendar_lang = 'O calend&aacute;rio "%s" estava sendo processado quando ocorreu este erro.';
$error_path_lang = 'N&atilde;o foi poss&iacute;vel abrir: "%s"';
$error_back_lang = 'Por favor use o bot&atilde;o de "Back" para voltar.';
$error_remotecal_lang = 'Este servidor bloqueia calend&aacute;rios remotos que nao foram aprovados.';
$error_restrictedcal_lang = 'Tentou acessar um calend&aacute;rio o qual &eacute; restrito o acesso neste servidor.';
$error_invalidcal_lang = 'Arquivo de calend&aacute;rio inv&aacute;lido. Por favor tente usar outro calend&aacute;rio.';

?>
