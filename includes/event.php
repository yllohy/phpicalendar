<?php 
define('BASE', '../');
include (BASE.'functions/init.inc.php'); 

function decode_popup ($item) {
	$item = stripslashes(rawurldecode($item));
	$item = str_replace('\\','',$item);
	return $item;
}

$event			= (isset($_REQUEST['event'])) ? decode_popup($_REQUEST['event']) : ('unset');
$description	= (isset($_REQUEST['description'])) ? decode_popup($_REQUEST['description']) : ('unset');
$cal			= (isset($_REQUEST['cal'])) ? decode_popup($_REQUEST['cal']) : ('unset');
$start			= (isset($_REQUEST['start'])) ? decode_popup($_REQUEST['start']) : ('unset');
$end			= (isset($_REQUEST['end'])) ? decode_popup($_REQUEST['end']) : ('unset');
$status			= (isset($_REQUEST['status'])) ? decode_popup($_REQUEST['status']) : ('unset');
$location		= (isset($_REQUEST['location'])) ? decode_popup($_REQUEST['location']) : ('unset');
$url			= (isset($_REQUEST['url'])) ? decode_popup($_REQUEST['url']) : ('unset');
$organizer		= (isset($_REQUEST['organizer'])) ? ($_REQUEST['organizer']) : ('unset');
$organizer 		= unserialize (decode_popup ($organizer));
$attendee		= (isset($_REQUEST['attendee'])) ? ($_REQUEST['attendee']) : ('unset');
$attendee 		= unserialize (decode_popup ($attendee));
$cal_title_full	= $cal.' '.$calendar_lang;

// Format event time
if (($start) && ($end)) {
	$event_times=' - <font class="V9">(<i>' . $start . ' - ' . $end . '</i>)</font>'; 
}
if ($start == '' && $end == '' && (isset($start) && isset($end))) {
	$event_times=' - <font class="V9">(<i>' . $all_day_lang . '</i>)</font>';
}

if ($description) {
	$display = ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]",'<a target="_new" href="\0">\0</a>',$description);
	$display .= '<br>';
}
if ($organizer) {
	$i=0;
	$display .= $organizer_lang . ' - ';
	foreach ($organizer as $val) {	
		$organizers .= $organizer[$i]["name"] . ', ';
		$i++;
	}
	$display .= substr($organizers,0,-2);
	$display .= '<br>';
}
if ($attendee) {
	$i=0;
	$display .= $attendee_lang . ' - ';
	foreach ($attendee as $val) {	
		$attendees .= $attendee[$i]["name"] . ', ';
		$i++;
	}
	$attendees = substr($attendees,0,-2);
	$display .= '<br>';
}
if ($status) {
	$display .= $status_lang . ' - ' . $status. '<br>' . "\n";
}
if ($location) {
	if (isset($url)) $location = '<a href="'.$url.'" target="_blank">'.$location.'</a>';
	$display .= $location_lang . ' - ' . $location.'<br>' . "\n";
}
$sheet_href = BASE.'styles/'.$style_sheet.'/default.css';


echo <<<END

	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
			"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
	<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<title>{$cal}</title>
		<link rel="stylesheet" type="text/css" href="{$sheet_href}">
	</head>
	<body bgcolor="#eeeeee">
	<center>
		<table border="0" width="430" cellspacing="0" cellpadding="0" class="calborder">
			<tr>
				<td align="center" width="98%" class="sideback"><div style="height: 17px; margin-top: 3px;"><font class="G10BOLD">{$cal_title_full}</font></div></td>
			</tr>
			<tr>
				<td colspan="3" class="V12">
					<div style="margin-left: 10px; margin-bottom:10px;">
						<p>{$event}  {$event_times}</p>
						{$display}
					</div>
				</td>
			</tr>
		</table>
	</center>
	</body>
	</html>

END;

?>