<?php 
define('BASE', '../');
include (BASE.'functions/init.inc.php'); 

// Load vars
if (isset($HTTP_GET_VARS['event']) && ($HTTP_GET_VARS['event'] !== '') ) {
	$event=$HTTP_GET_VARS['event'];
} else {
	$event='';
}
if (isset($HTTP_GET_VARS['description']) && ($HTTP_GET_VARS['description'] !== '') ) {
	$description=$HTTP_GET_VARS['description'];
} else {
	$description='';
}
if (isset($HTTP_GET_VARS['cal']) && ($HTTP_GET_VARS['cal'] !== '') ) {
	$calendar_name=$HTTP_GET_VARS['cal'];
} else {
	$calendar_name='';
}
if (isset($HTTP_GET_VARS['start']) && ($HTTP_GET_VARS['start'] !== '') ) {
	$start=$HTTP_GET_VARS['start'];
} else {
	$start='';
}
if (isset($HTTP_GET_VARS['end']) && ($HTTP_GET_VARS['end'] !== '') ) {
	$end=$HTTP_GET_VARS['end'];
} else {
	$end='';
}
if (isset($HTTP_GET_VARS['status']) && ($HTTP_GET_VARS['status'] !== '') ) {
	$status=$HTTP_GET_VARS['status'];
} else {
	$status='';
}
if (isset($HTTP_GET_VARS['location']) && ($HTTP_GET_VARS['location'] !== '') ) {
	$location=$HTTP_GET_VARS['location'];
} else {
	$location='';
}
if (isset($HTTP_GET_VARS['organizer']) && ($HTTP_GET_VARS['organizer'] !== '') ) {
	$organizer=$HTTP_GET_VARS['organizer'];
} else {
	$organizer='';
}
if (isset($HTTP_GET_VARS['attendee']) && ($HTTP_GET_VARS['attendee'] !== '') ) {
	$attendee=$HTTP_GET_VARS['attendee'];
} else {
	$attendee='';
}

// Prep vars for HTML display
$event=stripslashes(rawurldecode($event));
$event=str_replace('\\','',$event);
$description=stripslashes(rawurldecode($description));
$description=str_replace('\\','',$description);
$organizer=stripslashes(rawurldecode($organizer));
$organizer=str_replace('\\','',$organizer);
$organizer=unserialize($organizer);
$attendee=str_replace('\\','',$attendee);
$attendee=unserialize ($attendee);
$location=stripslashes(rawurldecode($location));
$location=str_replace('\\','',$location);
$calendar_name=stripslashes(rawurldecode($calendar_name));
$calendar_name=str_replace('\\','',$calendar_name);

// Format calendar title
if ($calendar_name == $ALL_CALENDARS_COMBINED) {
	$cal_title=$all_cal_comb_lang;
	$cal_title_full=$all_cal_comb_lang;
} else {
	$cal_title=$calendar_name;
	$cal_title_full=$calendar_name . ' ' . $calendar_lang;
}

// Format event time
if (($start) && ($end)) {
	$event_times=' - <font class="V9">(<i>' . $start . ' - ' . $end . '</i>)</font>'; 
}
if ($start == '' && $end == '' && (isset($start) && isset($end))) {
	$event_times=' - <font class="V9">(<i>' . $all_day_lang . '</i>)</font>';
}

// Format optional event fields
if ($description) {
	$display.="<!-- Description -->\n";
	$display.='<tr>' . "\n";
	$display.='<td width="1%"><img src="../images/spacer.gif" width="6" height="1" alt=" "></td>' . "\n";
	$display.='<td align="left" colspan="2" class="V12">' . "\n";
	$display.=ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]",'<a target="_new" href="\0">\0</a>',$description);
	$display.='</td>' . "\n";
	$display.='</tr>' . "\n";
}
if ($organizer) {
	$i=0;
	$display.='<tr>' . "\n";
	$display.='<td width="1%"><img src="images/spacer.gif" width="6" height="1" alt=" "></td>' . "\n";
	$display.='<td align="left" colspan="2" class="V12">';
	$display.=$organizer_lang . ' - ';
	foreach ($organizer as $val) {	
		$organizers.=$organizer[$i]["name"] . ', ';
		$i++;
	}
	$display.=substr($organizers,0,-2);
	$display.='</td>' . "\n";
	$display.='</tr>' . "\n";
}
if ($attendee) {
	$i=0;
	$display.="<!-- Attendee -->\n";
	$display.='<tr>' . "\n";
	$display.='<td width="1%"><img src="images/spacer.gif" width="6" height="1" alt=" "></td>' . "\n";
	$display.='<td align="left" colspan="2" class="V12">' . "\n";
	$display.=$attendee_lang . ' - ';
	foreach ($attendee as $val) {	
		$attendees .= $attendee[$i]["name"] . ', ';
		$i++;
	}
	$attendees=substr($attendees,0,-2);
	$display.='</td>' . "\n";
	$display.='</tr>' . "\n";
}
if ($status) {
	$display.="<!-- Status -->\n";
	$display.='<tr>' . "\n";
	$display.='<td width="1%"><img src="images/spacer.gif" width="6" height="1" alt=" "></td>' . "\n";
	$display.='<td align="left" colspan="2" class="V12">' . "\n";
	$display.=$status_lang . ' - ' . $status. '</td>' . "\n";
	$display.='</tr>';
}
if ($location) {
	$display.="<!-- Location -->\n";
	$display.='<tr>' . "\n";
	$display.='<td width="1%"><img src="images/spacer.gif" width="6" height="1" alt=" "></td>' . "\n";
	$display.='<td align="left" colspan="2" class="V12">' . "\n";
	$display.=$location_lang . ' - ' . $location.'</td>' . "\n";
	$display.='</tr>' . "\n";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<title><?php echo $cal_title; ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo BASE."styles/$style_sheet/default.css"; ?>">
</head>

<!-- Start PAGE -->
<body bgcolor="#eeeeee">
<center>
<table border="0" width="430" cellspacing="0" cellpadding="0" class="calborder">

<!-- Calendar Title -->
<tr>
<td align="left" valign="top" width="1%" class="sideback"><img src="../images/spacer.gif" width="1" height="20" alt=" "></td>
<td align="center" width="98%" class="sideback"><font class="G10BOLD"><?php echo $cal_title_full; ?></font></td>
<td align="right" valign="top" width="1%" class="sideback"></td>
</tr>
<tr>
<td colspan="3"><img src="../images/spacer.gif" width="1" height="6" alt=" "></td>
</tr>

<!-- Event Info -->
<tr>
<td colspan="3">  
<table width="430" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="1%"><img src="../images/spacer.gif" width="6" height="1" alt=" "></td>
<td align="left" colspan="2" class="V12"><?php echo $event . ' ' . $event_times; ?><br><br></td>
</tr>
<?php echo $display; ?>
</table>
</td>
</tr>

</table>
</center>
</body>
<!-- End PAGE -->

</html>