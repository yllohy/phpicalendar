<?php
	
define('BASE', './');
include(BASE.'functions/ical_parser.php');
$cal_displayname2 = $calendar_name . " $calendar_lang";
if (strlen($cal_displayname2) > 24) {
	$cal_displayname2 = substr("$cal_displayname2", 0, 21);
	$cal_displayname2 = $cal_displayname2 . "...";
}

$start_week_time = strtotime(dateOfWeek($getdate, $week_start_day));
$end_week_time = $start_week_time + (6 * 25 * 60 * 60);
$start_week = localizeDate($dateFormat_week, $start_week_time);
$end_week =  localizeDate($dateFormat_week, $end_week_time);
$parse_month = date ("Ym", strtotime($getdate));
$printview = $HTTP_GET_VARS['printview'];
$cal_displayname = str_replace("32", " ", $cal);
$events_week = 0;

	?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<title><?php echo "$goprint_lang"; ?></title>
  	<link rel="stylesheet" type="text/css" href="styles/<?php echo $style_sheet.'/default.css'; ?>">
</head>
<body bgcolor="#FFFFFF">
<center><table border="0" width="737" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="calborder">
	<tr>
		<td align="left" valign="top" width="1%"  class="sideback"><?php echo "<img src=\"images/spacer.gif\" alt=\"right\" height=\"22\" border=\"0\" align=\"left\">"; ?></td>
		<td align="center" width="98%" class="sideback"><font class="G10BOLD"><?php print (localizeDate ($dateFormat_day, strtotime($getdate))); ?></font></td>
		<td align="right" valign="top" width="1%"  class="sideback"></td>
	</tr>
	<tr>
		<td colspan="3"><img src="images/spacer.gif" width="1" height="5"></td>
	</tr>
	<tr>
		<td colspan="3">
				<table border="0" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td align="center" valign="top">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td colspan="3" height="1"></td>
								</tr>
								<?php	
									// Iterate the entire master array
									foreach($master_array as $key => $val) {
										
										// Pull out only this months
										ereg ("([0-9]{6})([0-9]{2})", $key, $regs);
										if ((($regs[1] == $parse_month) && ($printview == "month")) || (($key == $getdate) && ($printview == "day"))) {
											$dayofmonth = strtotime ($key);
											$dayofmonth = localizeDate ($dateFormat_day, $dayofmonth);
											echo "<tr><td width=\"10\"><img src=\"images/spacer.gif\" width=\"10\" height=\"1\"></td>\n";
											echo "<td colspan=\"2\"><font class=\"V12\"><b>$dayofmonth</b></font></td></tr>";
											echo "<tr><td colspan=\"3\"><img src=\"images/spacer.gif\" width=\"1\" height=\"5\"></td></tr>\n";
											
											// Pull out each day
											foreach ($val as $new_val) {
												
												// Pull out each time
												foreach ($new_val as $new_key2 => $new_val2) {
												if ($new_val2["event_text"]) {	
													$event_text 	= stripslashes(urldecode($new_val2["event_text"]));
													$description 	= stripslashes(urldecode($new_val2["description"]));
													$event_start 	= $new_val2["event_start"];
													$event_end 		= $new_val2["event_end"];
													$event_start 	= date ($timeFormat, strtotime ("$event_start"));
													$event_end 		= date ($timeFormat, strtotime ("$event_end"));
													if (!$new_val2["event_start"]) { 
														$event_start = "$all_day_lang";
														$event_start2 = '';
														$event_end = '';
													}
													echo "<tr>\n";
													echo "<td width=\"10\"><img src=\"images/spacer.gif\" width=\"10\" height=\"1\"></td>\n";
													echo "<td width=\"10\"><img src=\"images/spacer.gif\" width=\"10\" height=\"1\"></td>\n";
													echo "<td align=\"left\">\n";
													echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\n";
													echo "<tr>\n";
													echo "<td width=\"100\" class=\"G10BOLD\">$time_lang:</td>\n";
													echo "<td align=\"left\" class=\"G10B\">$event_start - $event_end</td>\n";
													echo "</tr>\n";
													echo "<tr>\n";
													echo "<td valign=\"top\" width=\"100\" class=\"G10BOLD\">$summary_lang:</td>\n";
													echo "<td valign=\"top\" align=\"left\" class=\"G10B\">$event_text</td>\n";
													echo "</tr>\n";
													if ($new_val2["description"]) {
														echo "<tr>\n";
														echo "<td valign=\"top\" width=\"100\" class=\"G10BOLD\">$description_lang:</td>\n";
														echo "<td valign=\"top\" align=\"left\" class=\"G10B\">$description</td>\n";
														echo "</tr>\n";
													}
													echo "</table>\n";
													echo "</td>\n";
													echo "</tr>\n";			
													echo "<tr><td colspan=\"3\"><img src=\"images/spacer.gif\" width=\"1\" height=\"10\"></td></tr>\n";
													}
												}
											}
										}
									}
								
								?>
							</table>
						</td>
					</tr>
				</table>		
		</td>
	</tr>
</table>
