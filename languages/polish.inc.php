<?php

// Polish language include
// For version 0.6 PHP iCalendar
//
// Translation by Stanislaw Cieslicki (stahoo@poczta.onet.pl)
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
$powered_by_lang 	= 'Powered by';
$version_lang		= '0.6';
$event_lang			= 'Zadanie';
$event_start_lang	= 'Początek';
$event_end_lang		= 'Koniec';
$this_months_lang	= 'Zadania miesiąca';
$date_lang			= 'Data';
$summary_lang		= 'Info';

// new since last translation
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

$daysofweek_lang			= array ('Niedziela','Poniedziałek','Wtorek','Środa','Czwartek','Piątek','Sobota');
$daysofweekshort_lang		= array ('Nie','Pon','Wt','Śr','Czw','Pt','Sob');
$daysofweekreallyshort_lang	= array ('N','P','W','Ś','C','P','S');
$monthsofyear_lang			= array ('Styczeń','Luty','Marzec','Kwiecień','Maj','Czerwiec','Lipiec','Sierpień','Wrzesień','Październik','Listopad','Grudzień');
$monthsofyearshort_lang		= array ('Sty','Luty','Marz','Kwie','Maj','Czer','Lip','Sier','Wrz','Paź','List','Gru');

// For time formatting, check out: http://www.php.net/manual/en/function.date.php
$timeFormat = 'G:i';

// For date formatting, see note below
$dateFormat_day = '%A, %e %B';
$dateFormat_week = '%e %B';
$dateFormat_week_list = '%a, %e %b';
$dateFormat_week_jump = '%e %b';// new since last translation
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

?>)
