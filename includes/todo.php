<?php 

define('BASE', '../');
include (BASE.'functions/init.inc.php'); 

if (isset($HTTP_GET_VARS['vtodo']) && ($HTTP_GET_VARS['vtodo'] !== '') ) {
	$vtodo = $HTTP_GET_VARS['vtodo'];
} else {
	$vtodo = '';
}

if (isset($HTTP_GET_VARS['description']) && ($HTTP_GET_VARS['description'] !== '') ) {
	$description = $HTTP_GET_VARS['description'];
} else {
	$description = '';
}

if (isset($HTTP_GET_VARS['status']) && ($HTTP_GET_VARS['status'] !== '') ) {
	$status = $HTTP_GET_VARS['status'];
} else {
	$status = $unfinished_lang;
}

if (isset($HTTP_GET_VARS['calendar_name']) && ($HTTP_GET_VARS['calendar_name'] !== '') ) {
	$calendar_name = $HTTP_GET_VARS['calendar_name'];
} else {
	$calendar_name = '';
}

if (isset($HTTP_GET_VARS['start']) && ($HTTP_GET_VARS['start'] !== '') ) {
	$start = $HTTP_GET_VARS['start'];
} else {
	$start = '';
}

if (isset($HTTP_GET_VARS['due']) && ($HTTP_GET_VARS['due'] !== '') ) {
	$due = $HTTP_GET_VARS['due'];
} else {
	$due = '';
}

if (isset($HTTP_GET_VARS['priority']) && ($HTTP_GET_VARS['priority'] !== '') && ($HTTP_GET_VARS['priority'] < 10)) {
	$priority = $HTTP_GET_VARS['priority'];
} else {
	$priority = $no_priority_lang;
}

$vtodo = rawurldecode($vtodo);
$vtodo = stripslashes($vtodo);
$vtodo = str_replace('\\', '', $vtodo);
//$vtodo = htmlspecialchars($vtodo);
$description = rawurldecode($description);
$description = stripslashes($description);
$description = str_replace('\\', '', $description);
//$description = htmlspecialchars($description);
$calendar_name = rawurldecode($calendar_name);
$calendar_name = stripslashes($calendar_name);
$calendar_name = str_replace('\\', '', $calendar_name);
//$calendar_name = htmlspecialchars($calendar_name);
$status = rawurldecode($status);
$status = stripslashes($status);
$status = str_replace('\\', '', $status);
//$status = htmlspecialchars($status);
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
		<td align="left" valign="top" width="1%" class="sideback"><img src="images/spacer.gif" width="1" height="20"></td>
		<td align="center" width="98%" class="sideback"><font class="G10BOLD"><?php echo "$calendar_name $calendar_lang"; ?></font></td>
		<td align="right" valign="top" width="1%" class="sideback"></td>
	</tr>
	<tr>
		<td colspan="3"><img src="images/spacer.gif" width="1" height="6"></td>
	</tr>
	<tr>
		<td colspan="3">  
	   		<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					 <td width="1%"><img src="images/spacer.gif" width="6" height="1"></td>
		 			 <td align="left" colspan="2" class="V12"><?php echo ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]",'<a target="_new" href="\0">\0</a>',$vtodo).'<br /><br />'; ?></td>
				</tr>
				
				<?php if ($description) { ?>    
					<tr>
					 <td width="1%"><img src="images/spacer.gif" width="6" height="1"></td>
					 <td align="left" colspan="2" class="V12">
					 <?php echo ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]", '<a target="_new" href="\0">\0</a>', $description); ?></td>
					</tr>
				<?php } ?>

				<?php if ($status) { ?>
				<tr>
					 <td></td>
		 			 <td align="left" colspan="2" class="V12"><?php echo $status_lang . $status; ?></td>
				</tr>
				<?php } ?>

				<tr>
					 <td></td>
		 			 <td align="left" colspan="2" class="V12"><?php echo $priority_lang . $priority; ?></td>
				</tr>

				<tr>
					 <td></td>
		 			 <td align="left" colspan="2" class="V12"><?php echo $created_lang . $start; ?></td>
				</tr>

				<?php if ($due) { ?>
				<tr>
					 <td></td>
		 			 <td align="left" colspan="2" class="V12"><?php echo $due_lang . $due; ?></td>
				</tr>
				<?php } ?>
				
	   </table>
   </td>
	</tr>
</table> 
</center>
</body>
</html>
