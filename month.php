<?php 
	$current_view = "month";
	include("./functions/ical_parser.php"); 

	//might not need this, depending on implimentation, doesn't work correctly in current form anyway
	//setcookie("last_view", "month");


	ereg ("([0-9]{4})([0-9]{2})([0-9]{2})", $getdate, $day_array2);
	$this_day = $day_array2[3]; 
	$this_month = $day_array2[2];
	$this_year = $day_array2[1];
	
	$unix_time = strtotime($getdate);
	$today_today = date ("Ymd");
	$tomorrows_date = date( "Ymd", strtotime("+1 day",  $unix_time));
	$yesterdays_date = date( "Ymd", strtotime("-1 day",  $unix_time));
	$date = mktime(0,0,0,"$this_month","$this_day","$this_year");
	$next_month = date("Ymd", DateAdd ("m", "1", $date));
	$prev_month = date("Ymd", DateAdd ("m", "-1", $date));
	$display_month = localizeDate ($dateFormat_month, $date);
	$parse_month = date ("Ym", $date);
	$first_of_month = $this_year.$this_month."01";
	$start_month_day = dateOfWeek($first_of_month, $week_start_day);
	$thisday2 = localizeDate($dateFormat_week_list, $unix_time);


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<title><?php echo "$calendar_name"; ?></title>
	<link rel="stylesheet" type="text/css" href="styles/<?php echo "$style_sheet/default.css"; ?>">
	<?php include "functions/event.js"; ?>
</head>
<body>
<center>
<table width="735" border="0" cellspacing="0" cellpadding="0" class="calborder">
	<tr>
		<td align="center" valign="middle" bgcolor="white">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
      			<tr>
      				<td align="left" width="90" class="navback">&nbsp;</td>
      				<td>
      					<table width="100%" border="0" cellspacing="0" cellpadding="0">
      						<tr>
								<td align="right" width="40%" class="navback"><?php echo "<a class=\"psf\" href=\"month.php?cal=$cal&getdate=$prev_month\"><img src=\"styles/$style_sheet/left_day.gif\" alt=\"\" width=\"28\" height=\"28\" border=\"0\" align=\"right\"></a>"; ?></td>
								<td align="center" width="20%" class="navback" nowrap valign="middle"><font class="H20"><?php echo $display_month; ?></font></td>
      							<td align="left" width="40%" class="navback"><?php echo "<a class=\"psf\" href=\"month.php?cal=$cal&getdate=$next_month\"><img src=\"styles/$style_sheet/right_day.gif\" alt=\"\" width=\"28\" height=\"28\" border=\"0\" align=\"left\"></a>"; ?></td>
      						</tr>
      					</table>
      				</td>
      				<td align="right" width="90" class="navback">	
      					<table width="90" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td><?php echo '<a class="psf" href="day.php?cal='.$cal.'&getdate='.$getdate.'"><img src="styles/'.$style_sheet.'/day_on.gif" width="30" height="24" alt=""></td>'; ?>
								<td><?php echo '<a class="psf" href="week.php?cal='.$cal.'&getdate='.$getdate.'"><img src="styles/'.$style_sheet.'/week_on.gif" width="30" height="24" alt=""></td>'; ?>
								<td><?php echo '<a class="psf" href="month.php?cal='.$cal.'&getdate='.$getdate.'"><img src="styles/'.$style_sheet.'/month_on.gif" width="30" height="24" alt=""></td>'; ?>
							</tr>
						</table>
					</td>
      			</tr>
      		</table>
		</td>
	</tr>
	<tr>
		<td align="center" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td colspan="7" width="735"><img src="images/spacer.gif" width="735" height="1" alt=""></td>
				</tr>
				<tr>
					<?php
						// loops through 7 times, starts with $week_start_day
						$start_day = strtotime($week_start_day);
						for ($i=0; $i<7; $i++) {
							$day_num = date("w", $start_day);
							$day = $daysofweek_lang[$day_num];
							print "<td valign=\"top\" width=\"105\" height=\"12\" bgcolor=\"#eeeeee\" class=\"V9\"><center><b>$day</b></center></td>";
							$start_day = ($start_day + (24.5 * 60 * 60));
						}
					?>	
				</tr>
				<tr>
					<td width="105"><img src="images/spacer.gif" width="105" height="1" alt=""></td>
					<td width="105"><img src="images/spacer.gif" width="105" height="1" alt=""></td>
					<td width="105"><img src="images/spacer.gif" width="105" height="1" alt=""></td>
					<td width="105"><img src="images/spacer.gif" width="105" height="1" alt=""></td>
					<td width="105"><img src="images/spacer.gif" width="105" height="1" alt=""></td>
					<td width="105"><img src="images/spacer.gif" width="105" height="1" alt=""></td>
					<td width="105"><img src="images/spacer.gif" width="105" height="1" alt=""></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
			<td align="center" valign="top">
			<table width="100%" border="0" cellspacing="1" cellpadding="0" class="G10B" bgcolor="#A1A5A9">
				<tr>	
				<?php 	 
					$sunday = strtotime("$start_month_day");
					$i = 0;
					$whole_month = TRUE;
					$num_of_events = 0;
					do {
						$day = date ("j", $sunday);
						$daylink = date ("Ymd", $sunday);
						$check_month = date ("m", $sunday);
						if ($check_month != $this_month) {
							$day= "<font color=\"#666666\">$day";
							$bgcolor="#F2F2F2";
						} else {
							if ($getdate == $daylink) {
								$bgcolor="#F2F9FF";
							} else {
								$bgcolor="#FFFFFF";
							}
						}
						if ($i == 0) echo "<tr height=\"105\">\n";
						if (isset($master_array[("$daylink")]) && ($check_month == $this_month)) {
							echo "<td align=\"center\" valign=\"top\" bgcolor=\"$bgcolor\" width=\"105\" height=\"105\">\n";
							echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">\n";
							echo "<tr>\n";
							echo "<td align=\"right\" valign=\"top\">\n";
							echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$daylink\">$day</a>\n";
							echo "</td>\n";
							echo "</tr>\n";
							if ($master_array[("$daylink")]) {
								foreach ($master_array[("$daylink")] as $event_times) {
									foreach ($event_times as $val) {
										$event_text = $val["event_text"];
										$event_text = strip_tags($event_text, '<b><i><u>');
										if ($event_text != "") {	
											$event_text2 	= addslashes($val["event_text"]);
											$event_text2 	= urlencode($event_text2);
											$description 	= addslashes($val["description"]);
											$description	= urlencode($description);
											$event_start 	= @$val["event_start"];
											$event_end 		= @$val["event_end"];
											$event_start 	= date ($timeFormat, @strtotime ("$event_start"));
											$event_end 		= date ($timeFormat, @strtotime ("$event_end"));
											$calendar_name2	= addslashes($calendar_name);
											$calendar_name2 = urlencode($calendar_name2);
											$event_text		= word_wrap($event_text, 12, $month_event_lines);
											echo "<tr>\n";
											echo "<td>\n";
											echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
											echo "<tr>\n";
											echo "<td>\n";
											if (!isset($val["event_start"])) {
												$event_start = 'All';
												$event_end = 'Day';
												echo "<center><a class=\"psf\" href=\"javascript:openEventInfo('$event_text2', '$calendar_name2', '$event_start', '$event_end', '$description')\"><i>$event_text</i></a></center>\n";
											} else {	
												echo "<a class=\"psf\" href=\"javascript:openEventInfo('$event_text2', '$calendar_name2', '$event_start', '$event_end', '$description')\"><font class=\"G10B\">&#149; $event_text</a>\n";
											}
											echo "</td>\n";
											echo "</tr>\n";
											echo "</table>\n";
											echo "</td>\n";
											echo "</tr>\n";
											$num_of_events++;
										}
									}
								}
							}
							echo "</table>\n";
							echo "</td>\n";
						} else {
							echo "<td align=\"center\" valign=\"top\" bgcolor=\"$bgcolor\" width=\"105\" height=\"105\">\n";
							echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">\n";
							echo "<tr>\n";
							echo "<td align=\"right\" valign=\"top\">\n";
							echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$daylink\">$day</a>\n";
							echo "</td>\n";
							echo "</tr>\n";
							echo "</table>\n";
							echo "</td>\n";
						}
						$sunday = ($sunday + (24.5 * 60 * 60));
						$i++;
						if ($i == 7) { 
							echo "</tr>\n";
							$i = 0;
							$checkagain = date ("m", $sunday);
							if ($checkagain != $this_month) $whole_month = FALSE;	
						}
					} while ($whole_month == TRUE);
				?>
			</table>
		</td>
	</tr>
</table>
<?php include "./month_bottom.php"; ?>

<br>
<?php echo "<font class=\"V9\"><br>$powered_by_lang <a class=\"psf\" href=\"http://phpicalendar.sourceforge.net/\">PHP iCalendar $version_lang</a></font>"; ?></center></td>
</center>
</body>
</html>
