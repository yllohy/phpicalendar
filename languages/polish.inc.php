<?

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
$download_lang		= 'Pobież';
$powered_by_lang 	= 'Powered by';
$version_lang		= '0.6';
$event_lang			= 'Zadanie';
$event_start_lang	= 'Początek';
$event_end_lang		= 'Koniec';
$this_months_lang	= 'Zadania miesiąca';
$date_lang			= 'Data';
$summary_lang		= 'Info';

// new since last translation
$all_day_lang		= 'All day event';
$notes_lang			= 'Notes';
$this_years_lang	= 'This Year\'s Events';
$today_lang			= 'Today';
$this_week_lang		= 'This Week';
$this_month_lang	= 'This Month';
$jump_lang			= 'Jump to';
$tomorrows_lang		= 'Tomorrow\'s Events';
$goday_lang			= 'Go to Today';
$goweek_lang		= 'Go to This Week';
$gomonth_lang		= 'Go to This Month';
$goyear_lang		= 'Go to This Year';

$daysofweek_lang			= array ('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
$daysofweekshort_lang		= array ('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
$daysofweekreallyshort_lang	= array ('S','M','T','W','T','F','S');
$monthsofyear_lang			= array ('January','February','March','April','May','June','July','August','September','October','November','December');
$monthsofyearshort_lang		= array ('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');

// For time formatting, check out: http://www.php.net/manual/en/function.date.php
$timeFormat = 'G:i';

// For date formatting, see note below
$dateFormat_day = '%A, %e %B';
$dateFormat_week = '%e %B';
$dateFormat_week_list = '%a, %e %b';
$dateFormat_week_jump = '%b %e';// new since last translation
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
$error_title_lang = 'Error!';
$error_window_lang = 'There was an error!';
$error_calendar_lang = 'The calendar "%s" was being processed when this error occurred.';
$error_path_lang = 'Unable to open the path: "%s"';
$error_back_lang = 'Please use the "Back" button to return.';
$error_remotecal_lang = 'This server blocks remote calendars which have not been approved.';
$error_restrictedcal_lang = 'You have tried to access a calendar that is restricted on this server.';
$error_invalidcal_lang = 'Invalid calendar file. Please try a different calendar.';

?>