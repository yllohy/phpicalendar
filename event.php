<?php 

include ('./functions/init.inc.php'); 

if (isset($HTTP_GET_VARS['event']) && ($HTTP_GET_VARS['event'] !== '') ) {
	$event = $HTTP_GET_VARS['event'];
} else {
	$event = '';
}
if (isset($HTTP_GET_VARS['description']) && ($HTTP_GET_VARS['description'] !== '') ) {
	$description = $HTTP_GET_VARS['description'];
} else {
	$description = '';
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
if (isset($HTTP_GET_VARS['end']) && ($HTTP_GET_VARS['end'] !== '') ) {
	$end = $HTTP_GET_VARS['end'];
} else {
	$end = '';
}

$event = rawurldecode($event);
$event = stripslashes($event);
$event = str_replace('\\', '', $event);
$event = htmlspecialchars($event);
$description = rawurldecode($description);
$description = stripslashes($description);
$description = str_replace('\\', '', $description);
//$description = htmlspecialchars($description);
$calendar_name2 = rawurldecode($calendar_name);
$calendar_name2 = stripslashes($calendar_name2);
$calendar_name2 = str_replace('\\', '', $calendar_name2);
//$calendar_name2 = htmlspecialchars($calendar_name2);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8">
  <title><?php echo $calendar_name2; ?></title>
	<link rel="stylesheet" type="text/css" href="styles/<?php echo "$style_sheet/default.css"; ?>">
</head>
<body bgcolor="#eeeeee"><center>
<table border="0" width="430" cellspacing="0" cellpadding="0" class="calborder">
	<tr>
		<td align="left" valign="top" width="1%" class="sideback"><img src="images/spacer.gif" width="1" height="20"></td>
		<td align="center" width="98%" class="sideback"><font class="G10BOLD"><?php echo "$calendar_name2 $calendar_lang"; ?></font></td>
		<td align="right" valign="top" width="1%" class="sideback"></td>
	</tr>
	<tr>
		<td colspan="3"><img src="images/spacer.gif" width="1" height="6"></td>
	</tr>
	<tr>
		<td colspan="3">  
	   		<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<?php 
				if (($start) && ($end)) $event_times = ' - <font class="V9">(<i>'.$start.' - '.$end.'</i>)</font>'; 
				if ($start == '' && $end == '' && isset($start, $end)) $event_times = ' - <font class="V9">(<i>'.$all_day_lang.'</i>)</font>';
				?>
				<tr>
					 <td width="1%"><img src="images/spacer.gif" width="6" height="1"></td>
		 			 <td align="left" colspan="2" class="V12"><?php echo $event.' '.$event_times.'<br><br>'; ?></td>
				</tr>
				
				<?php if ($description) { ?>    
					<tr>
					 <td width="1%"><img src="images/spacer.gif" width="6" height="1"></td>
					 <td align="left" colspan="2" class="V12"><?php echo $description; ?></td>
					</tr>
				<?php } ?>
	
	   </table>
   </td>
	</tr>
</table> 
</center>
</body>
</html>