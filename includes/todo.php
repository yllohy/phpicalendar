<?php 

define('BASE', '../');
include (BASE.'functions/init.inc.php');
include (BASE.'functions/date_functions.php');

// Unserialize the array so that we can use it.
$vtodo_array = unserialize(base64_decode($HTTP_GET_VARS['vtodo_array']));

// Set the variables from the array
if (isset($vtodo_array['vtodo_text']) && ($vtodo_array['vtodo_text'] !== '') ) {
	$vtodo_text = $vtodo_array['vtodo_text'];
} else {
	$vtodo_text = '';
}

if (isset($vtodo_array['description']) && ($vtodo_array['description'] !== '') ) {
	$description = $vtodo_array['description'];
} else {
	$description = '';
}

if (isset($vtodo_array['completed_date']) && ($vtodo_array['completed_date'] !== '') ) {
	$completed_date = localizeDate ($dateFormat_day, strtotime($vtodo_array['completed_date']));
}

if (isset($vtodo_array['status']) && ($vtodo_array['status'] !== '') ) {
	$status = $vtodo_array['status'];
}
if ((!isset($status) || $status == "COMPLETED") && isset($completed_date)) {
	$status = "$completed_date_lang $completed_date";
} else if ($status == "COMPLETED") {
	$status = $completed_lang;
} else {
	$status = $unfinished_lang;
}

if (isset($vtodo_array['cal']) && ($vtodo_array['cal'] !== '') ) {
	$calendar_name = $vtodo_array['cal'];
} else {
	$calendar_name = '';
}

if (isset($vtodo_array['start_date']) && ($vtodo_array['start_date'] !== '') ) {
	$start_date = localizeDate ($dateFormat_day, strtotime($vtodo_array['start_date']));
}

if (isset($vtodo_array['due_date']) && ($vtodo_array['due_date'] !== '') && strtotime($vtodo_array['due_date']) != strtotime("+1 year", strtotime($start_date))) {
	$due_date = localizeDate ($dateFormat_day, strtotime($vtodo_array['due_date']));
} else {
	$due_date = '';
}

if (isset($vtodo_array['priority']) && ($vtodo_array['priority'] !== '')) {
	$priority = $vtodo_array['priority'];

	if ($priority >= 1 && $priority <= 4) {
		$priority = $priority_high_lang;
	} else if ($priority == 5) {
		$priority = $priority_medium_lang;
	} else if ($priority >= 6 && $priority <= 9) {
		$priority = $priority_low_lang;
	} else {
		$priority = $priority_none_lang;
	}
} else {
	$priority = $priority_none_lang;
}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<title><?php echo $calendar_name; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo BASE."styles/$style_sheet/default.css"; ?>">
</head>
<body bgcolor="#eeeeee"><center>
<table border="0" width="430" cellspacing="0" cellpadding="0" class="calborder">
	<tr>
		<td align="left" valign="top" width="1%" class="sideback"><img src="images/spacer.gif" width="1" height="20" alt=" "></td>
		<td align="center" width="98%" class="sideback"><font class="G10BOLD"><?php echo "$calendar_name $calendar_lang"; ?></font></td>
		<td align="right" valign="top" width="1%" class="sideback"></td>
	</tr>
	<tr>
		<td colspan="3"><img src="images/spacer.gif" width="1" height="6" alt=" "></td>
	</tr>
	<tr>
		<td colspan="3">  
	   		<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					 <td width="1%"><img src="images/spacer.gif" width="6" height="1" alt=" "></td>
		 			 <td align="left" colspan="2" class="V12"><?php echo ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]",'<a target="_new" href="\0">\0</a>',$vtodo_text).'<br /><br />'; ?></td>
				</tr>
				
				<?php if ($description) { ?>    
					<tr>
					 <td width="1%"><img src="images/spacer.gif" width="6" height="1" alt=" "></td>
					 <td align="left" colspan="2" class="V12">
					 <?php echo ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]", '<a target="_new" href="\0">\0</a>', $description); ?></td>
					</tr>
				<?php } ?>

				<?php if ($status) { ?>
				<tr>
					 <td></td>
		 			 <td align="left" colspan="2" class="V12"><?php echo "$status_lang $status"; ?></td>
				</tr>
				<?php } ?>

				<tr>
					 <td></td>
		 			 <td align="left" colspan="2" class="V12"><?php echo "$priority_lang $priority"; ?></td>
				</tr>

				<tr>
					 <td></td>
		 			 <td align="left" colspan="2" class="V12"><?php echo "$created_lang $start_date"; ?></td>
				</tr>

				<?php if ($due_date) { ?>
				<tr>
					 <td></td>
		 			 <td align="left" colspan="2" class="V12"><?php echo "$due_lang $due_date"; ?></td>
				</tr>
				<?php } ?>
				
	   </table>
   </td>
	</tr>
</table> 
</center>
</body>
</html>
