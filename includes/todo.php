<?php 

define('BASE', '../');
include_once(BASE.'functions/init.inc.php');
include_once(BASE.'functions/date_functions.php');

$vtodo_array = unserialize(base64_decode($HTTP_GET_VARS['vtodo_array']));

// Set the variables from the array
$vtodo_text		= (isset($vtodo_array['vtodo_text'])) ? $vtodo_array['vtodo_text'] : ('');
$description	= (isset($vtodo_array['description'])) ? $vtodo_array['description'] : ('');
$completed_date	= (isset($vtodo_array['completed_date'])) ? localizeDate ($dateFormat_day, strtotime($vtodo_array['completed_date'])) : ('');
$status			= (isset($vtodo_array['status'])) ? $vtodo_array['status'] : ('');
$calendar_name  = (isset($vtodo_array['cal'])) ? $vtodo_array['cal'] : ('');
$start_date 	= (isset($vtodo_array['start_date'])) ? localizeDate ($dateFormat_day, strtotime($vtodo_array['start_date'])) : ('');
$due_date 		= (isset($vtodo_array['due_date'])) ? localizeDate ($dateFormat_day, strtotime($vtodo_array['due_date'])) : ('');
$priority 		= (isset($vtodo_array['priority'])) ? $vtodo_array['priority'] : ('');

$cal_title_full = $calendar_name.' '.$calendar_lang;
$description	= ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]", '<a target="_new" href="\0">\0</a>', $description);
$vtodo_text		= ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]",'<a target="_new" href="\0">\0</a>',$vtodo_text);
$sheet_href 	= BASE.'styles/'.$style_sheet.'/default.css';


if ((!isset($status) || $status == "COMPLETED") && isset($completed_date)) {
	$status = "$completed_date_lang $completed_date";
} else if ($status == "COMPLETED") {
	$status = $completed_lang;
} else {
	$status = $unfinished_lang;
}

if ($priority >= 1 && $priority <= 4) {
	$priority = $priority_high_lang;
} else if ($priority == 5) {
	$priority = $priority_medium_lang;
} else if ($priority >= 6 && $priority <= 9) {
	$priority = $priority_low_lang;
} else {
	$priority = $priority_none_lang;
}

$display = '';
if ($vtodo_text != '')  	$display .= $vtodo_text.'<br><br>';
if ($description != '')  	$display .= $description.'<br>';
if ($status != '')  		$display .= $status_lang.': '.$status.'<br>';
if ($priority != '')  		$display .= $priority_lang.' '.$priority.'<br>';
if ($start_date != '')  	$display .= $created_lang.' '.$start_date.'<br>';
if ($due_date != '')  		$display .= $due_lang.' '.$due_date.'<br>';

echo <<<END

	<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
			"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
	<html>
	<head>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<title>{$calendar_name}</title>
		<link rel="stylesheet" type="text/css" href="{$sheet_href}">
	</head>
	<body>
	<center>
		<table border="0" width="430" cellspacing="0" cellpadding="0" class="calborder">
			<tr>
				<td align="center" class="sideback"><div style="height: 17px; margin-top: 3px;" class="G10BOLD">{$cal_title_full}</div></td>
			</tr>
			<tr>
				<td align="left" class="V12">
					<div style="margin-left: 10px; margin-bottom:10px;">
						<p>{$display}</p>
					</div>
				</td>
			</tr>
		</table>
	</center>
	</body>
	</html>

END;

?>