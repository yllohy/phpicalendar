<?php

// Portuguese language include
// For version 0.9.2 PHP iCalendar
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
$search_took_lang       = 'A procura demorou %s segundos';
$recurring_event_lang   = 'Evento de retorno';
$exception_lang         = 'Excecao';
$no_query_lang          = 'Nenhuma procura dada';
$preferences_lang       = 'Preferencias';
$printer_lang           = 'Impressora';
$select_lang_lang       = 'Escolha a sua linguagem por defeito:';
$select_cal_lang        = 'Escolha o seu calendário base:';
$select_view_lang       = 'Selecione a sua vista por defeito :';
$select_time_lang       = 'Selecione a sua hora de inicio:';
$select_day_lang        = 'Selecione o seu dia de inicio da semana:';
$select_style_lang      = 'Selecione o seu estilo por defeito:';
$set_prefs_lang         = 'Ajuste preferencias';
$completed_date_lang    = 'Terminado em';
$completed_lang         = 'Terminado';
$created_lang           = 'Criado:';
$due_lang               = 'Devido:';
$priority_lang          = 'Prioridade:';
$priority_high_lang     = 'Elevada';
$priority_low_lang      = 'Baixa';
$priority_medium_lang   = 'Media';
$priority_none_lang     = 'Nenhum';
$status_lang            = 'Status:';
$todo_lang              = 'Itens a fazer';
$unfinished_lang        = 'Por terminar';
$prefs_set_lang 		= 'A suas preferencias foram aplicadas.';
$prefs_unset_lang 		= 'Preferencias retiradas. Alteracoes aparecerao nas proxinas paginas.';
$unset_prefs_lang 		= 'Retirar preferencias:';

// ----- New for 0.9.2

$organizer_lang			= 'Organizer';
$attendee_lang			= 'Attendee';
$status_lang			= 'Status';
$location_lang			= 'Location';
$admin_header_lang		= 'PHP iCalendar Administration';
$username_lang			= 'Username';
$password_lang			= 'Password';
$login_lang				= 'Login';
$invalid_login_lang		= 'Wrong username or password.';
$addupdate_cal_lang		= 'Add or Update a Calendar';
$addupdate_desc_lang	= 'Add a calendar by uploading a new file. Update a calendar by uploading a file of the same name.';
$delete_cal_lang		= 'Delete a Calendar';
$logout_lang			= 'Logout';
$cal_file_lang			= 'Calendar File';
$php_error_lang			= 'PHP Error';
$upload_error_gen_lang	= 'There was a problem with your upload.';
$upload_error_lang[0]	= 'There was a problem with your upload.';
$upload_error_lang[1]	= 'The file you are trying to upload is too big.';
$upload_error_lang[2]	= 'The file you are trying to upload is too big.';
$upload_error_lang[3]	= 'The file you are trying upload was only partially uploaded.';
$upload_error_lang[4]	= 'You must select a file for upload.';
$upload_error_type_lang = 'Only .ics files may be uploaded.';
$copy_error_lang		= 'Failed to copy file';
$delete_error_lang		= 'Failed to delete file';
$delete_success_lang	= 'was deleted successfully.';
$action_success_lang	= 'Your action was successful.';
$submit_lang			= 'Submit';
$delete_lang			= 'Delete';

// - navigation
$back_lang = 'Anterior';
$next_lang = 'Seguinte';
$prev_lang = 'Ver ';
$day_view_lang = 'Ver Dia';
$week_view_lang = 'Ver Semana';
$month_view_lang = 'Ver Mes';
$year_view_lang = 'Ver Ano';

// ---------------------------------

// $format_recur, items enclosed in % will be substituted with variables
$format_recur_lang['delimiter']        = ', ';                                                                // ie, 'one, two, three'

$format_recur_lang['yearly']                = array('ano','anos');                // for these, put singular
$format_recur_lang['monthly']                = array('mes','meses');                // and plural forms
$format_recur_lang['weekly']                = array('semana','semanas');                // these will be %freq%
$format_recur_lang['daily']                        = array('dia','dias');                        // in the replacement below
$format_recur_lang['hourly']                = array('hora','horas');
$format_recur_lang['minutely']                = array('minuto','minutos');
$format_recur_lang['secondly']                = array('segundo','segundos');

$format_recur_lang['start']                        = 'Todos %int% %freq% %for%';        // ie, 'Every 1 day until January 4' or 'Every 1 day for a count of 5'
$format_recur_lang['until']                        = 'ate %date%';                                // ie, 'until January 4'
$format_recur_lang['count']                        = 'para repetir %int%';                // ie, 'for 5 times'

$format_recur_lang['bymonth']                = 'Nos meses: %list%';                        // ie, 'In months: January, February, March'
$format_recur_lang['bymonthday']        = 'Nas datas: %list%';                        // ie, 'On dates: 1, 2, 3, 4'
$format_recur_lang['byday']                        = 'Nos dias: %list%';                        // ie, 'On days: Mon, Tues, Wed, Thurs'

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
