<?php

// Japanese language include
// For version 0.9.2 PHP iCalendar
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
$event_lang			= '件名';
$event_start_lang	= '開始日';
$event_end_lang		= '終了日';
$date_lang			= '日付';
$summary_lang		= '件名';
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
$search_lang		= '検索'; // the verb
$results_lang		= '検索結果';
$query_lang			= '検索キーワード'; // will be followed by the search query
$no_results_lang	= '一致する予定はありませんでした。';
$goprint_lang		= '印刷できる';
$time_lang			= '時間';
$summary_lang		= '結言';
$description_lang	= 'メモ';
$this_site_is_lang		= 'このウェブサイトは%sです。';
$no_events_day_lang		= '今日は予定がありません。';
$no_events_week_lang	= '今週は予定がありません。';
$no_events_month_lang	= '今月は予定がありません';
$rss_day_date			= 'g:i A';  // Lists just the time
$rss_week_date			= '%b %e日';  // Lists just the day
$rss_month_date			= '%b %e日';  // Lists just the day
$rss_language			= 'ja';
$search_took_lang		= '検索に%s秒かかりました。';
$recurring_event_lang	= '引き続く予定';
$exception_lang			= '特例';
$no_query_lang			= '検索キーワードがありませんでした。';
$preferences_lang		= '環境設定';
$printer_lang			= 'プリンター';
$select_lang_lang		= 'デフォルト言語を選択して下さい:';
$select_cal_lang		= 'デフォルトカレンダーを選択して下さい:';
$select_view_lang		= 'デフォルト見解を選択して下さい:';
$select_time_lang		= 'デフォルト開始時刻を選択して下さい:';
$select_day_lang		= 'デフォルト開始曜日を選択して下さい:';
$select_style_lang		= 'デフォルト形式を選択して下さい:';
$set_prefs_lang			= '環境を設定する';
$completed_date_lang	= '%sに完成された。';
$completed_lang			= '完了';
$created_lang			= '作成日:';
$due_lang				= '期限:';
$priority_lang			= '優先順位:';
$priority_high_lang		= '高い';
$priority_low_lang		= '低い';
$priority_medium_lang	= '普通';
$priority_none_lang		= 'なし';
$status_lang			= '状態:';
$todo_lang				= '備忘録';
$unfinished_lang		= '完成されていない';
$prefs_set_lang 		= 'Your preferences have been set.';
$prefs_unset_lang 		= 'Preferences unset. Changes will take place next page load.';
$unset_prefs_lang 		= 'Unset preferences:';

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
$back_lang = '戻る';
$next_lang = '次';
$prev_lang = '前';
$day_view_lang = '日';
$week_view_lang = '週';
$month_view_lang = '月';
$year_view_lang = '年';

// $format_recur, items enclosed in % will be substituted with variables
$format_recur_lang['delimiter']	= '、';								// ie, 'one, two, three'
// 第
$format_recur_lang['yearly']		= array('年','年');		// for these, put singular
$format_recur_lang['monthly']		= array('か月','か月');		// and plural forms
$format_recur_lang['weekly']		= array('週','週');		// these will be %freq%
$format_recur_lang['daily']		= array('日','日');			// in the replacement below
$format_recur_lang['hourly']		= array('時間','時間');
$format_recur_lang['minutely']		= array('分','分');
$format_recur_lang['secondly']		= array('秒','秒');

$format_recur_lang['start']		= '%int%%freq%ごとに%for%';	// ie, 'Every 1 day until January 4' or 'Every 1 day for a count of 5'
$format_recur_lang['until']		= '%date%まで';				// ie, 'until January 4'
$format_recur_lang['count']		= '%int%回';		// ie, 'for a count of 5'

$format_recur_lang['bymonth']		= '月：%list%';			// ie, 'In months: January, February, March'
$format_recur_lang['bymonthday']	= '日：%list%';			// ie, 'On dates: 1, 2, 3, 4'
$format_recur_lang['byday']			= '曜日：%list%';			// ie, 'On days: Mon, Tues, Wed, Thurs'

$daysofweek_lang			= array ('日曜日','月曜日','火曜日','水曜日','木曜日','金曜日','土曜日');
$daysofweekshort_lang		= array ('日','月','火','水','木','金','土');
$daysofweekreallyshort_lang	= array ('日','月','火','水','木','金','土');
$monthsofyear_lang			= array ('1月','2月','3月','4月','5月','6月','7月','8月','9月','10月','11月','12月');
$monthsofyearshort_lang		= $monthsofyear_lang;

// For time formatting, check out: http://www.php.net/manual/en/function.date.php
$timeFormat = 'g:i A';
$timeFormat_small = 'g:i';

// For date formatting, see note below
$dateFormat_day = '%B%e日 %A';
$dateFormat_week = '%B%e日';
$dateFormat_week_list = '%b%e日（%a）';
$dateFormat_week_jump = '%b%e日';
$dateFormat_month = '%Y年%B';
$dateFormat_month_list = '%B%e日 %A';

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
$error_title_lang = 'エラー!';
$error_window_lang = 'エラーが発生しました!';
$error_calendar_lang = 'エラーがおきたとき、「%s」カレンダーを処理していました。';
$error_path_lang = '「%s」ディレクトリを開けることはできません。';
$error_back_lang = '前のページに戻るには「戻る」ボタンをクリックして下さい。';
$error_remotecal_lang = 'このサーバは承認されていないリモートカレンダーを拒否しています。';
$error_restrictedcal_lang = 'このサーバで 限られているカレンダーにアクセスしようとしました。';
$error_invalidcal_lang = 'このカレンダーはサーバ側で制限されているため、アクセスできません。';

?>