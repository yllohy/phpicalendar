<?php

// English language include
// For version 0.8 PHP iCalendar
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
$next_year_lang		= '来年';
$last_day_lang		= '前日';
$last_month_lang	= '先月';
$last_week_lang		= '先週';
$last_year_lang		= '去年';
$subscribe_lang		= '追加';
$download_lang		= 'ダウンロード';
$published_lang		= '公開日：';
$powered_by_lang 	= 'Powered by';

$version_lang		= '0.8';
$event_lang			= '件名';
$event_start_lang	= '開始日';
$event_end_lang		= '終了日';
$date_lang			= '日付';
$summary_lang		= '一覧';
$all_day_lang		= '終日イベント';
$notes_lang			= '注釈';

$todays_lang		= '今日の予定';
$this_weeks_lang	= '今週の予定';
$this_months_lang	= '今月の予定';
$this_years_lang	= '今年の予定';
$today_lang			= '今日';
$this_week_lang		= '今週';
$this_month_lang	= '今月';
$this_year_lang		= '今年';

$jump_lang			= '移動';
$tomorrows_lang		= '翌日の予定';
$goday_lang			= '今日に移動';
$goweek_lang		= '今週に移動';
$gomonth_lang		= '今月に移動';
$goyear_lang		= '今年に移動';

// new in 0.8 -------------
$search_lang		= '探す'; // the verb
$results_lang		= 'サーチリザルト';
$query_lang			= '問い: '; // will be followed by the search query
$no_results_lang	= '予定を見つけません。';

$goprint_lang		= '印刷できる';
$time_lang			= '時間';
$summary_lang		= '結言';
$description_lang	= 'デスクリプション';

// RSS text for 0.8
$this_site_is_lang		= 'このウェブサイト：';
$no_events_day_lang		= '今日は予定がありません。';
$no_events_week_lang	= '今週は予定がありません。';
$no_events_month_lang	= '今月は予定がありません';
$rss_day_date			= 'g:i A';  // Lists just the time
$rss_week_date			= '%b %e日';  // Lists just the day
$rss_month_date			= '%b %e日';  // Lists just the day
$rss_language			= 'en-us';
// -------------------------

$daysofweek_lang			= array ('日曜日','月曜日','火曜日','水曜日','木曜日','金曜日','土曜日');
$daysofweekshort_lang		= array ('日','月','火','水','木','金','土');
$daysofweekreallyshort_lang	= array ('日','月','火','水','木','金','土');
$monthsofyear_lang			= array ('1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月');
$monthsofyearshort_lang		= $monthsofyear_lang;

// For time formatting, check out: http://www.php.net/manual/en/function.date.php
$timeFormat = 'g:i A';

// For date formatting, see note below
$dateFormat_day = '%B %e日 %A';
$dateFormat_week = '%B %e日';
$dateFormat_week_list = '%b %e日 (%a)';
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

// Error messages - %s will be replaced with a variable
$error_title_lang = 'Error!';
$error_window_lang = 'エラーが発生しました!';
$error_calendar_lang = 'エラーがおきたとき、「%s」カレンダーを処理していました。';
$error_path_lang = '「%s」ディレクトリを開けることはできません。';
$error_back_lang = '前のページに戻るには「戻る」ボタンをクリックして下さい。';
$error_remotecal_lang = 'このサーバは承認されていないリモートカレンダーを拒否しています。';
$error_restrictedcal_lang = 'このサーバで 限られているカレンダーにアクセスしようとしました。';
$error_invalidcal_lang = 'このカレンダーはサーバ側で制限されているため、アクセスできません。';


?>