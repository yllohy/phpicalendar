<?php 

define('BASE', '../');
include_once(BASE.'functions/init.inc.php');
include_once(BASE.'functions/date_functions.php');
require_once(BASE.'functions/template.php');

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

$page = new Page(BASE.'templates/'.$template.'/todo.tpl');

$page->replace_tags(array(
	'cal' 				=> $cal_title_full,
	'vtodo_text' 		=> $vtodo_text,
	'description' 		=> $description,
	'priority_lang' 	=> $priority_lang,
	'priority'	 		=> $priority,
	'created_lang'	 	=> $created_lang,
	'start_date' 		=> $start_date,
	'status_lang' 		=> $status_lang,
	'status'	 		=> $status,
	'due_lang'		 	=> $due_lang,
	'due_date' 			=> $due_date,
	'cal_title_full'	=> $cal_title_full,
	'template'			=> $template
		
	));

$page->output();

?>