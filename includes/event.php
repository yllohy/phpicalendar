<?php 
define('BASE', '../');
include_once(BASE.'functions/init.inc.php'); 
require_once(BASE.'functions/template.php');

function decode_popup ($item) {
	$item = stripslashes(rawurldecode($item));
	$item = str_replace('\\','',$item);
	return $item;
}

$event			= (isset($HTTP_POST_VARS['event'])) ? decode_popup($HTTP_POST_VARS['event']) : ('');
$description	= (isset($HTTP_POST_VARS['description'])) ? decode_popup($HTTP_POST_VARS['description']) : ('');
$cal			= (isset($HTTP_POST_VARS['cal'])) ? decode_popup($HTTP_POST_VARS['cal']) : ('');
$start			= (isset($HTTP_POST_VARS['start'])) ? decode_popup($HTTP_POST_VARS['start']) : ('');
$end			= (isset($HTTP_POST_VARS['end'])) ? decode_popup($HTTP_POST_VARS['end']) : ('');
$status			= (isset($HTTP_POST_VARS['status'])) ? decode_popup($HTTP_POST_VARS['status']) : ('');
$location		= (isset($HTTP_POST_VARS['location'])) ? decode_popup($HTTP_POST_VARS['location']) : ('');
$url			= (isset($HTTP_POST_VARS['url'])) ? decode_popup($HTTP_POST_VARS['url']) : ('');
$organizer		= (isset($HTTP_POST_VARS['organizer'])) ? ($HTTP_POST_VARS['organizer']) : ('');
$organizer 		= unserialize (decode_popup ($organizer));
$attendee		= (isset($HTTP_POST_VARS['attendee'])) ? ($HTTP_POST_VARS['attendee']) : ('');
$attendee 		= unserialize (decode_popup ($attendee));
$cal_title_full	= $cal.' '.$calendar_lang;

// Format event time
if (($start) && ($end)) {
	$event_times = $start . ' - ' . $end; 
}
if ($start == '' && $end == '' && (isset($start) && isset($end))) {
	$event_times = $all_day_lang;
}

if ($description) $description = ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]",'<a target="_new" href="\0">\0</a>',$description);
if ($organizer) {
	$i=0;
	$display .= $organizer_lang . ' - ';
	foreach ($organizer as $val) {	
		$organizers .= $organizer[$i]["name"] . ', ';
		$i++;
	}
	$organizer = substr($organizers,0,-2);
}
if ($attendee) {
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
	'organizer_lang' 	=> $organizer_lang,
	'organizer' 		=> $organizer,
	'attendee_lang' 	=> $attendee_lang,
	'attendee'	 		=> $attendee,
	'status_lang' 		=> $status_lang,
	'status'	 		=> $status,
	'location_lang' 	=> $location_lang,
	'location' 			=> $location,
	'sheet_href'		=> $sheet_href,
	'cal_title_full'	=> $cal_title_full,
	'template'			=> $template,
		
	));

$page->output();

?>
