<?php

define('BASE', '../');
include(BASE.'functions/ical_parser.php');

$start_week_time = strtotime(dateOfWeek($getdate, $week_start_day));
$end_week_time = $start_week_time + (6 * 25 * 60 * 60);
$start_week = localizeDate($dateFormat_week, $start_week_time);
$end_week =  localizeDate($dateFormat_week, $end_week_time);
$rssview = $HTTP_GET_VARS['rssview'];


if ($rssview == "day") {
	$theview = $day_lang;
} elseif ($rssview == "week") {
	$theview = $week_lang;
} elseif ($rssview == "month") {
	$theview = $month_lang;
}


$rss = 	"<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?>"."\n";
$rss .= '<!DOCTYPE rss PUBLIC "-//Netscape Communications//DTD RSS 0.91//EN" "http://my.netscape.com/publish/formats/rss-0.91.dtd">'."\n";
$rss .= '<rss version="0.91">'."\n";
$rss .= '<channel>'."\n";
$rss .= '<title>'.$cal.' '.$calendar_lang.' - '.$theview.'</title>'."\n";
$rss .= '<link>'.$default_path.'</link>'."\n";
$rss .= '<description>'.$cal.' '.$calendar_lang.' - '.$theview.'</description>'."\n";
$rss .= '<language>us-en</language>'."\n";
$rss .= '<copyright>Copyright 2002, '.$default_path.'</copyright>'."\n";


if ($rssview == 'day') {
	if (isset($master_array[($getdate)]) && sizeof($master_array[($getdate)]) > 0) {
		foreach ($master_array[("$getdate")] as $event_times) {
			foreach ($event_times as $val) {
				$event_start 	= @$val["event_start"];
				$event_start 	= date ($timeFormat, @strtotime ("$event_start"));
				$event_text 	= stripslashes(urldecode($val["event_text"]));
				$event_text 	= strip_tags($event_text, '<b><i><u>');
				$event_text 	= word_wrap($event_text, 21, $tomorrows_events_lines);
				$description 	= stripslashes(urldecode($val["description"]));
				$description 	= strip_tags($description, '<b><i><u>');
				$rss .= '<item>'."\n";
				$rss .= '<title>'.$event_start.' '.$event_text.'</title>'."\n";
				$rss .= '<link>'.$default_path.'/day.php?getdate='.$getdate.'&cal='.$cal.'</link>'."\n";
				$rss .= '<description>'.$description.'</description>'."\n";
				$rss .= '</item>'."\n";
			}
		}
	} else {
		$rss .= '<item>'."\n";
		$rss .= '<title>No events today.</title>'."\n";
		$rss .= '</item>'."\n";
	}
}

$thisdate = $start_week_time;
$events_week = 0;
$i = 0;
if ($rssview == "week") {
	do {
		$getdate = date("Ymd", $thisdate);
		if (isset($master_array[($getdate)]) && sizeof($master_array[($getdate)]) > 0) {
			foreach ($master_array[("$getdate")] as $event_times) {
				foreach ($event_times as $val) {
					$event_start 	= @$val["event_start"];
					$event_start 	= date ($timeFormat, @strtotime ("$event_start"));
					$event_text 	= stripslashes(urldecode($val["event_text"]));
					$event_text 	= strip_tags($event_text, '<b><i><u>');
					$event_text 	= word_wrap($event_text, 21, $tomorrows_events_lines);
					$description 	= stripslashes(urldecode($val["description"]));
					$description 	= strip_tags($description, '<b><i><u>');
					$rss .= '<item>'."\n";
					$rss .= '<title>'.$event_start.' '.$event_text.'</title>'."\n";
					$rss .= '<link>'.$default_path.'/day.php?getdate='.$getdate.'&cal='.$cal.'</link>'."\n";
					$rss .= '<description>'.$description.'</description>'."\n";
					$rss .= '</item>'."\n";
					$events_week++;
				}
			}
		}
		if ($events_week < 1) {
			$rss .= '<item>'."\n";
			$rss .= '<title>No events this week.</title>'."\n";
			$rss .= '</item>'."\n";
		}
		$thisdate = ($thisdate + (25 * 60 * 60));
		$i++;
	} while ($i < 7);
}


$rss .= '</channel>'."\n";
$rss .= '</rss>'."\n";

echo "$rss";


?>