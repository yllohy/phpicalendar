<?php

// Polish language include
// For version 0.9.1 PHP iCalendar
//
// Translation by Stanisław Cieślicki (stahoo@poczta.onet.pl)
//
// Submit new translations to chad@chadsdomain.com



$day_lang			= 'Dzień';
$week_lang			= 'Tydzień';
$month_lang			= 'Miesiąc';
$year_lang			= 'Rok';
$calendar_lang		= 'Kalendarz';
$next_day_lang		= 'Następny dzień';
$next_month_lang	= 'Przyszły miesiąc';
$next_week_lang		= 'Przyszły tydzień';
$next_year_lang		= 'Przyszły rok';
$last_day_lang		= 'Poprzedni dzień';
$last_month_lang	= 'Zeszły Miesiąc';
$last_week_lang		= 'Zeszły tydzień';
$last_year_lang		= 'Zeszły rok';
$subscribe_lang		= 'Subskrybuj';
$download_lang		= 'Pobierz';
$powered_by_lang 	= 'Wspierane przez';
$event_lang			= 'Zadanie';
$event_start_lang	= 'Początek';
$event_end_lang		= 'Koniec';
$this_months_lang	= 'Zadania miesiąca';
$date_lang			= 'Data';
$summary_lang		= 'Info';
$all_day_lang		= 'Zadanie na cały dzień';
$notes_lang			= 'Notes';
$this_years_lang	= 'Zadania tego roku';
$today_lang			= 'Dzisiaj';
$this_week_lang		= 'Bieżący tydzień';
$this_month_lang	= 'Bieżący miesiąc';
$jump_lang			= 'Idź do';
$tomorrows_lang		= 'Zadania jutra';
$goday_lang			= 'Idź do dnia dzisiejszego';
$goweek_lang		= 'Idź do bieżącego tygodnia';
$gomonth_lang		= 'Idź do bieżącego miesiąca';
$goyear_lang		= 'Idź do bieżącego roku';
$search_lang		= 'Szukaj'; // the verb
$results_lang		= 'Wyniki poszukiwania';
$query_lang			= 'Pytanie: '; // will be followed by the search query
$no_results_lang	= 'Brak poszukiwanych zadań';
$goprint_lang		= 'Do druku';
$time_lang			= 'Czas';
$summary_lang		= 'Podsumowanie';
$description_lang	= 'Opis';
$this_site_is_lang		= 'Ta strona jest';
$no_events_day_lang		= 'Brak zadań na dziś.';
$no_events_week_lang	= 'Brak zadań na ten tydzień.';
$no_events_month_lang	= 'Brak zadań an ten miesiąc.';
$rss_day_date			= 'G:i A';  // Lists just the time
$rss_week_date			= '%A, %e %B';  // Lists just the day
$rss_month_date			= '%A, %e %B';  // Lists just the day
$rss_language			= 'en-us';
$search_took_lang		= 'Szukanie zajęło %s sekund';
$recurring_event_lang	= 'Zadanie rekurencyjne';
$exception_lang			= 'Wyjątek';
$no_query_lang			= 'Brak pytania';
$preferences_lang		= 'Preferencje';
$printer_lang			= 'Drukarka';
$select_lang_lang		= 'Wybierz domyślny język:';
$select_cal_lang		= 'Wybierz domyślny kalendarz:';
$select_view_lang		= 'Wybierz domyślny podgląd:';
$select_time_lang		= 'Wybierz domyślny czas rozpoczęcia dnia:';
$select_day_lang		= 'Wybierz domyślny dzień rozpoczynający tydzień:';
$select_style_lang		= 'Wybierz domyślny styl:';
$set_prefs_lang			= 'Ustaw preferencje';
$completed_date_lang	= 'Zakończono';
$completed_lang			= 'Zakończono';
$created_lang			= 'Utworzono:';
$due_lang				= 'Stosowany:';
$priority_lang			= 'Priorytet:';
$priority_high_lang		= 'Wysoki';
$priority_low_lang		= 'Niski';
$priority_medium_lang	= 'Średni';
$priority_none_lang		= 'Żaden';
$status_lang			= 'Status:';
$todo_lang				= 'Do zrobienia';
$unfinished_lang		= 'Niewykonane';

// ----- New for 0.9.1

$prefs_set_lang = 'Twoje preferencje zostały ustawione.';
$prefs_unset_lang = 'Preferencje przywrócone. Zmiany będą widoczne po ponownym załadowaniu strony.';
$unset_prefs_lang = 'Przywróć preferencje:';

// - navigation
$back_lang = 'Back';
$next_lang = 'Next';
$prev_lang = 'Prev';
$day_view_lang = 'Day View';
$week_view_lang = 'Week View';
$month_view_lang = 'Month View';
$year_view_lang = 'Year View';

// ---------------------------------

// $format_recur, items enclosed in % will be substituted with variables
$format_recur_lang['delimiter']	= ', ';								// ie, 'one, two, three'

$format_recur_lang['yearly']		= array('rok','lat');		// for these, put singular
$format_recur_lang['monthly']		= array('miesiąc','miesięcy');		// and plural forms
$format_recur_lang['weekly']		= array('tydzień','tygodni');		// these will be %freq%
$format_recur_lang['daily']			= array('dzień','dni');			// in the replacement below
$format_recur_lang['hourly']		= array('godzina','godzin');
$format_recur_lang['minutely']		= array('minuta','minut');
$format_recur_lang['secondly']		= array('sekunda','sekund');

$format_recur_lang['start']			= 'Każdego %int% %freq% %for%';	// ie, 'Every 1 day until January 4' or 'Every 1 day for a count of 5'
$format_recur_lang['until']			= 'do %date%';				// ie, 'until January 4'
$format_recur_lang['count']			= '%int% razy';		// ie, 'for 5 times'

$format_recur_lang['bymonth']		= 'określonego miesiąca: %list%';			// ie, 'In months: January, February, March'
$format_recur_lang['bymonthday']	= 'określonego dnia: %list%';			// ie, 'On dates: 1, 2, 3, 4'
$format_recur_lang['byday']			= 'określonego dnia tygodnia: %list%';			// ie, 'On days: Mon, Tues, Wed, Thurs'

// ---------------------------------

$daysofweek_lang			= array ('Niedziela','Poniedziałek','Wtorek','Środa','Czwartek','Piątek','Sobota');
$daysofweekshort_lang		= array ('Nie','Pon','Wt','Śr','Czw','Pt','Sob');
$daysofweekreallyshort_lang	= array ('N','P','W','Ś','C','P','S');
$monthsofyear_lang			= array ('Styczeń','Luty','Marzec','Kwiecień','Maj','Czerwiec','Lipiec','Sierpień','Wrzesień','Październik','Listopad','Grudzień');
$monthsofyearshort_lang		= array ('Sty','Luty','Marz','Kwie','Maj','Czer','Lip','Sier','Wrz','Paź','List','Gru');

// For time formatting, check out: http://www.php.net/manual/en/function.date.php
$timeFormat = 'G:i';
$timeFormat_small = 'G:i';

// For date formatting, see note below
$dateFormat_day = '%A, %e %B';
$dateFormat_week = '%e %B';
$dateFormat_week_list = '%a, %e %b';
$dateFormat_week_jump = '%e %B';// new since last translation
$dateFormat_month = '%B %Y';
$dateFormat_month_list = '%A, %e %B';

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
$error_title_lang = 'Błąd!';
$error_window_lang = 'Wystąpił błąd!';
$error_calendar_lang = 'Podczas przetwarzania kalendarza „%s”, wystąpił błąd.';
$error_path_lang = 'Nie mogę otworzyć ścieżki: "%s"';
$error_back_lang = 'Proszę użyć przycisku „Wstecz” aby wrócić.';
$error_remotecal_lang = 'Ten serwer blokuje dostęp do niezatwierdzonych zdalnych kalendarzy.';
$error_restrictedcal_lang = 'Dostęp do kalendarza, który próbujesz otworzyć, jest zabroniony przez serwer.';
$error_invalidcal_lang = 'Zły plik kalendarza. Spróbuj innego.';

?>