<?php 
$current_view = "event";
define('BASE', '../');
include_once(BASE.'functions/init.inc.php'); 
require_once(BASE.'functions/template.php');

# information for the popup is sent via $_POST by a javascript snippet in 
# in function openevent() from functions/date_functions.php
# character encoding has been problematic with popups.
$event			= unserialize(stripslashes($_POST['event_data']));
$organizer 		= unserialize($event['organizer']);
$attendee 		= unserialize($event['attendee']);

// Format event time
// All day
if ($_POST['time'] == -1) {
	$event_times = $lang['l_all_day'];
} else {
	$event_times = date($timeFormat, $event['start_unixtime']) . ' - ' .  date($timeFormat, $event['end_unixtime']); 
}

$event['event_text']  = urldecode($event['event_text']);
$event['description'] = urldecode($event['description']);
$event['location']    = urldecode($event['location']);
$display ='';
if (isset($event['description'])) $event['description'] = ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]",'<a target="_new" href="\0">\0</a>',$event['description']);

if (isset($organizer) && is_array($organizer)) {
	$i=0;
	$display .= $lang['l_organizer'] . ' - ';
	$organizers = array();
	foreach ($organizer as $val) {	
		$organizers[] = $organizer[$i]["name"];
		$i++;
	}
	$organizer = implode(', ',$organizers);
}
if (isset($attendee) && is_array($attendee)) {
	$i=0;
	$display .= $lang['l_attendee'] . ' - ';
	$attendees = array();
	foreach ($attendee as $val) {	
		$attendees[] .= $attendee[$i]["name"];
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
	'url'      			=> $event['url'],
	'cal_title_full'	=> $event['calname'].' '.$lang['l_calendar'],
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
