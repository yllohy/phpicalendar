<?php 
$current_view = "event";
define('BASE', '../');
include_once(BASE.'functions/init.inc.php'); 
require_once(BASE.'functions/date_functions.php');
require_once(BASE.'functions/template.php');

# information for the popup is sent via $_POST by a javascript snippet in 
# in function openevent() from functions/date_functions.php
# character encoding has been problematic with popups.
$event			= unserialize(stripslashes($_POST['event_data']));
$organizer 		= unserialize($event['organizer']);
$attendee 		= unserialize($event['attendee']);
$uid    		= stripslashes($_POST['uid']);

// Format event time
// All day
if ($_POST['time'] == -1) {
	$start = localizeDate($dateFormat_week, $event['start_unixtime']);
	$end   = localizeDate($dateFormat_week, ($event['end_unixtime'] - 60));
	$event_times = $lang['l_all_day']." $start";
	if ($start != $end) $event_times = "$start - $end";
} else {
	$start = date($timeFormat, $event['start_unixtime']);
	$end   = date($timeFormat, $event['end_unixtime']);
	$event_times = "$start";
	if ($start != $end) $event_times = "$start - $end";
}

$event['event_text']  = sanitizeForWeb(urldecode($event['event_text']));
$event['description'] = sanitizeForWeb(urldecode($event['description']));
$event['location']    = sanitizeForWeb(urldecode($event['location']));
if (isset($event['description'])) {
	$event['description'] = ereg_replace("(blocked)?([[:alpha:]]+://([^<>&[:space:]]|&amp;)+[[:alnum:]/])", '<a target="_new" href="\2">\2</a>', $event['description']);
	$event['description'] = ereg_replace("(blocked)?(mailto:)?([[:alnum:]_.%+-]+@[[:alnum:].-]+\.[[:alpha:]]{2,4})", '<a href="mailto:\3">\3</a>', $event['description']);
}

if (isset($organizer) && is_array($organizer)) {
	$i=0;
	$organizers = array();
	foreach ($organizer as $val) {
		if (!empty($organizer[$i]["email"])) {
			$organizers[] .= "<a href=\"mailto:{$organizer[$i]["email"]}\">{$organizer[$i]["name"]}</a>";
		} else {
			$organizers[] .= $organizer[$i]["name"];
		}
		$i++;
	}
	$organizer = implode(', ',$organizers);
}
if (isset($attendee) && is_array($attendee)) {
	$i=0;
	$attendees = array();
	foreach ($attendee as $val) {
		if (!empty($attendee[$i]["email"])) {
			$attendees[] .= "<a href=\"mailto:{$attendee[$i]["email"]}\">{$attendee[$i]["name"]}</a>";
		} else {
			$attendees[] .= $attendee[$i]["name"];
		}
		$i++;
	}
	$attendee = implode(', ',$attendees);
}
if (isset($event['location'])) $event['location'] = stripslashes($event['location']);
if (sizeof($attendee) == 0) $attendee = '';
if (sizeof($organizer) == 0) $organizer = '';
if ($event['url'] != '') $event['url'] = '<a href="'.$event['url'].'" target="_blank">'.$event['url'].'</a>';

switch ($event['status']){
	case 'CONFIRMED':
		$event['status'] =	$lang['l_status_confirmed'] ; 
		break;
	case 'CANCELLED':
		$event['status'] =	$lang['l_status_cancelled'] ; 
		break;
	case 'TENTATIVE':
		$event['status'] =	$lang['l_status_tentative'] ; 
		break;
	default:	
		$event['status'] =	'' ; 
}

$event_download = '';
if($phpiCal_config->event_download == 'yes') $event_download = "
<form action='' method='post'>
<input type=hidden name='event_data' value = '".$_POST['event_data']."' />
<input type=hidden name='uid' value = '".$_POST['uid']."' />
<input type='submit' name='submit' value='".$lang['l_download_event']."' />
<form>";

if (isset($_POST['submit'])){
header("Content-Type: text/calendar; charset=utf-8; name=$uid");
header("Content-Disposition: attachment; filename=$uid");
echo 
"BEGIN:VCALENDAR
VERSION:2.0
X-WR-CALNAME:".$event['calname']."
BEGIN:VEVENT
UID:$uid
SUMMARY:".$event['event_text']."
CATEGORIES:".$event['calname']."
DTSTART;TZID=".$event['timezone'].":".date("Ymd\THis",$event['start_unixtime'])."
DTEND;TZID=".$event['timezone'].":".date("Ymd\THis",$event['start_unixtime'])."
CLASS:".$event['class']."
".$event['other']."
SEQUENCE:1
CREATED:20081128T075152
END:VEVENT
END:VCALENDAR
";exit;
}
$page = new Page(BASE.'templates/'.$phpiCal_config->template.'/event.tpl');

$page->replace_tags(array(
	'charset'			=> $phpiCal_config->charset,
	'cal' 				=> $event['calname'],
	'event_text' 		=> $event['event_text'],
	'event_times' 		=> $event_times,
	'description' 		=> $event['description'],
	'organizer' 		=> $organizer,
	'attendee'	 		=> $attendee,
	'status'	 		=> $event['status'],
	'location' 			=> $event['location'],
	'event_download'	=> $event_download,
	'url'      			=> $event['url'],
	'cal_title_full'	=> $event['calname'],
	'template'			=> $phpiCal_config->template,
	'l_summary' 		=> $lang['l_summary'],
	'l_description'		=> $lang['l_description'],
	'l_organizer'		=> $lang['l_organizer'],
	'l_attendee'		=> $lang['l_attendee'],
	'l_status'			=> $lang['l_status'],
	'l_location'		=> $lang['l_location'],
	'l_url'     		=> $lang['l_url']
		
	));

$page->output();

?>
