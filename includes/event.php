<?php 
define('BASE', '../');
include (BASE.'functions/init.inc.php'); 

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
if (isset($HTTP_GET_VARS['cal']) && ($HTTP_GET_VARS['cal'] !== '') ) {
	$calendar_name = $HTTP_GET_VARS['cal'];
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
if (isset($HTTP_GET_VARS['status']) && ($HTTP_GET_VARS['status'] !== '') ) {
	$status = $HTTP_GET_VARS['status'];
} else {
	$status = '';
}

if (isset($HTTP_GET_VARS['location']) && ($HTTP_GET_VARS['location'] !== '') ) {
	$location = $HTTP_GET_VARS['location'];
} else {
	$location = '';
}

if (isset($HTTP_GET_VARS['organizer']) && ($HTTP_GET_VARS['organizer'] !== '') ) {
	$organizer = $HTTP_GET_VARS['organizer'];
} else {
	$organizer = '';
}

if (isset($HTTP_GET_VARS['attendee']) && ($HTTP_GET_VARS['attendee'] !== '') ) {
	$attendee = $HTTP_GET_VARS['attendee'];
} else {
	$attendee = '';
}

$event = rawurldecode($event);
$event = stripslashes($event);
$event = str_replace('\\', '', $event);
$event = htmlspecialchars($event);
$description = rawurldecode($description);
$description = stripslashes($description);
$description = str_replace('\\', '', $description);
$organizer = rawurldecode($organizer);
$organizer = stripslashes($organizer);
$organizer = str_replace('\\', '', $organizer);
$organizer = unserialize ($organizer);
$attendee = rawurldecode($attendee);
$attendee = stripslashes($attendee);
$attendee = str_replace('\\', '', $attendee);
$attendee = unserialize ($attendee);
$location = rawurldecode($location);
$location = stripslashes($location);
$location = str_replace('\\', '', $location);
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
  <title><?php 
  				if ($calendar_name == 'all_calenders_combined971') {
					echo "$all_cal_comb_lang";
				} else {
					echo "$calendar_name2";
				}?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo BASE."styles/$style_sheet/default.css"; ?>">
</head>
<body bgcolor="#eeeeee"><center>
<table border="0" width="430" cellspacing="0" cellpadding="0" class="calborder">
	<tr>
		<td align="left" valign="top" width="1%" class="sideback"><img src="images/spacer.gif" width="1" height="20" alt=" "></td>
		<td align="center" width="98%" class="sideback"><font class="G10BOLD">
			<?php 
				if ($calendar_name == 'all_calenders_combined971') {
					echo "$all_cal_comb_lang";
				} else {
					echo "$calendar_name2 $calendar_lang";
				} 
			?>
		</font></td>
		<td align="right" valign="top" width="1%" class="sideback"></td>
	</tr>
	<tr>
		<td colspan="3"><img src="images/spacer.gif" width="1" height="6" alt=" "></td>
	</tr>
	<tr>
		<td colspan="3">  
	   		<table width="430" border="0" cellspacing="0" cellpadding="0">
				<?php 
				if (($start) && ($end)) $event_times = ' - <font class="V9">(<i>'.$start.' - '.$end.'</i>)</font>'; 
				if ($start == '' && $end == '' && (isset($start) && isset($end))) $event_times = ' - <font class="V9">(<i>'.$all_day_lang.'</i>)</font>';
				?>
				<tr>
					 <td width="1%"><img src="images/spacer.gif" width="6" height="1" alt=" "></td>
		 			 <td align="left" colspan="2" class="V12"><?php echo $event.' '.$event_times.'<br><br>'; ?></td>
				</tr>
				
				<?php if ($description) { ?>    
					<tr>
					 <td width="1%"><img src="images/spacer.gif" width="6" height="1" alt=" "></td>
					 <td align="left" colspan="2" class="V12">
					 <?php echo ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]",
							'<a target="_new" href="\0">\0</a>', $description); ?></td>
					</tr>
				<?php } ?>

				<?php 
					
					if ($organizer) {
						$i = 0;
						echo '<tr>';
						echo '<td width="1%"><img src="images/spacer.gif" width="6" height="1" alt=" "></td>';
						echo '<td align="left" colspan="2" class="V12">';
						echo $organizer_lang.' - ';
						foreach ($organizer as $val) {	
							$organizers .= $organizer[$i]["name"].', ';
							$i++;
						}
						$organizers = substr ($organizers, 0, -2);
						echo $organizers.'</td></tr>';
					}	
					
					if ($attendee) {
						$i = 0;
						echo '<tr>';
						echo '<td width="1%"><img src="images/spacer.gif" width="6" height="1" alt=" "></td>';
						echo '<td align="left" colspan="2" class="V12">';
						echo $attendee_lang.' - ';
						foreach ($attendee as $val) {	
							$attendees .= $attendee[$i]["name"].', ';
							$i++;
						}
						$attendees = substr ($attendees, 0, -2);
						echo $attendees.'</td></tr>';
					}
				
					if ($status) {  
						echo '<tr>';
						echo '<td width="1%"><img src="images/spacer.gif" width="6" height="1" alt=" "></td>';
						echo '<td align="left" colspan="2" class="V12">';
						echo $status_lang.' - '.$status.'</td>';
						echo '</tr>';
					}
					
					if ($location) {  
						echo '<tr>';
						echo '<td width="1%"><img src="images/spacer.gif" width="6" height="1" alt=" "></td>';
						echo '<td align="left" colspan="2" class="V12">';
						echo $location_lang.' - '.$location.'</td>';
						echo '</tr>';
					}
				
				
				?>
	
	   </table>
   </td>
	</tr>
</table> 
</center>
</body>
</html>
