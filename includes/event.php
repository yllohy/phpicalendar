<?php 
define('BASE', '../');
include_once(BASE.'functions/init.inc.php'); 
require_once(BASE.'functions/template.php');

function decode_popup ($item) {
	$item = stripslashes(rawurldecode($item));
	$item = str_replace('\\','',$item);
	return $item;
}

$event			= (isset($_POST['event'])) ? decode_popup($_POST['event']) : ('');
$description	= (isset($_POST['description'])) ? decode_popup($_POST['description']) : ('');
$cal			= (isset($_POST['cal'])) ? decode_popup($_POST['cal']) : ('');
$start			= (isset($_POST['start'])) ? decode_popup($_POST['start']) : ('');
$end			= (isset($_POST['end'])) ? decode_popup($_POST['end']) : ('');
$status			= (isset($_POST['status'])) ? decode_popup($_POST['status']) : ('');
$location		= (isset($_POST['location'])) ? decode_popup($_POST['location']) : ('');
$url			= (isset($_POST['url'])) ? decode_popup($_POST['url']) : ('');
$organizer		= (isset($_POST['organizer'])) ? ($_POST['organizer']) : ('');
$organizer 		= unserialize (decode_popup ($organizer));
$attendee		= (isset($_POST['attendee'])) ? ($_POST['attendee']) : ('');
$attendee 		= unserialize (decode_popup ($attendee));
$cal_title_full	= $cal.' '.$calendar_lang;

// Format event time
if (($start) && ($end)) {
	$event_times = $start . ' - ' . $end; 
}
if ($start == '' && $end == '' && (isset($start) && isset($end))) {
	$event_times = $lang['l_all_day'];
}

if ($description) $description = ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]",'<a target="_new" href="\0">\0</a>',$description);
if (is_array($organizer)) {
	$i=0;
	$display .= $organizer_lang . ' - ';
	foreach ($organizer as $val) {	
		$organizers .= $organizer[$i]["name"] . ', ';
		$i++;
	}
	$organizer = substr($organizers,0,-2);
}
if (is_array($attendee)) {
	$i=0;
	$display .= $attendee_lang . ' - ';
	foreach ($attendee as $val) {	
		$attendees .= $attendee[$i]["name"] . ', ';
		$i++;
	}
	$attendee = substr($attendees,0,-2);
}

if ($location) {
	if ($url != '') $location = '<a href="'.$url.'" target="_blank">'.$location.'</a>';
}

if (sizeof($attendee) == 0) $attendee = '';
if (sizeof($organizer) == 0) $organizer = '';

$page = new Page(BASE.'templates/'.$template.'/event.tpl');

$page->replace_tags(array(
	'cal' 				=> $cal,
	'event' 			=> $event,
	'event_times' 		=> $event_times,
	'description' 		=> $description,
	'organizer' 		=> $organizer,
	'attendee'	 		=> $attendee,
	'status'	 		=> $status,
	'location' 			=> $location,
	'cal_title_full'	=> $cal_title_full,
	'template'			=> $template,
	'l_organizer'		=> $lang['l_organizer'],
	'l_attendee'		=> $lang['l_attendee'],
	'l_status'			=> $lang['l_status'],
	'l_location'		=> $lang['l_location']
		
	));

$page->output();

?>
