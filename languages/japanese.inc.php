<?php

// English language include
// For version 0.5 PHP iCalendar
//
// Translation by Jared Wangen (jared@silter.org)
// With the help of Eri Hayashiguchi
//
// Submit new translations to chad@chadsdomain.com



$day_lang			= '日';
$week_lang			= '週';
$month_lang			= '月';
$year_lang			= '年';
$calendar_lang		= 'カレンダー';
$next_day_lang		= '翌日';
$next_month_lang	= '来月';
$next_week_lang		= '来週';
$next_year_lang		= '明年';
$last_day_lang		= '前日';
$last_month_lang	= '先月';
$last_week_lang		= '先週';
$last_year_lang		= '去年';
$subscribe_lang		= '追加';
$download_lang		= 'ダウンロード';
$published_lang		= '公開日：';
$powered_by_lang 	= 'Powered by';

$version_lang		= '0.5';
$event_lang			= '件名';
$event_start_lang	= '開始日';
$event_end_lang		= '終了日';
$date_lang			= '日付';
$summary_lang		= '一覧';
$all_day_lang		= '終日イベント';
$notes_lang			= '注釈';

$todays_lang		= '今日今週の予定';
$this_weeks_lang		= '今週の予定';
$this_months_lang	= '今月の予定';
$this_years_lang	= '今年の予定';
$today_lang			= '今日';
$this_week_lang		= '今週';
$this_month_lang	= '今月';
$this_year_lang		= '今年';

$jump_lang			= 'Jump to';
$tomorrows_lang		= 'Tomorrow\'s Events';
$goday_lang			= 'Go to Today';
$goweek_lang		= 'Go to This Week';
$gomonth_lang		= 'Go to This Month';
$goyear_lang		= 'Go to This Year';

$daysofweek_lang			= array ('日曜日','月曜日','火曜日','水曜日','木曜日','金曜日','土曜日');
$daysofweekshort_lang		= array ('日曜','月曜','火曜','水曜','木曜','金曜','土曜');
$daysofweekreallyshort_lang	= array ('日','月','火','水','木','金','土');
$monthsofyear_lang			= array ('1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月');
$monthsofyearshort_lang		= $monthsofyear_lang;

// Set Location for date formatting, check out: http://www.php.net/manual/en/function.setlocale.php
setlocale (LC_TIME, 'ja_JP');

// For time formatting, check out: http://www.php.net/manual/en/function.date.php
$timeFormat = 'g:i A';

// For date formatting, see note below
$dateFormat_day = '%B %e日 %A';
$dateFormat_week = '%B %e日';
$dateFormat_week_list = '%b %e日 %a';
$dateFormat_week_jump = '%b %e日';
$dateFormat_month = '%Y年 %B';
$dateFormat_month_list = '%B %e日 %A';

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

?>