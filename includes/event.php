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
	if (isset($url)) $location = '<a href="'.$url.'" target="_blank">'.$location.'</a>';
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
	<title><?php echo $cal; ?></title>
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

</tr>
<tr>
<td colspan="3"><img src="../images/spacer.gif" width="1" height="6" alt=" "></td>
</tr>
</table>
</td>
</tr>

</table>
</center>
</body>
<!-- End PAGE -->

</html>
