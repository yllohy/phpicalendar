<?php 
	$current_view = "month";
	include("./ical_parser.php"); 

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
	$display_month = strftime ($dateFormat_month, $date);
	$parse_month = date ("Ym", $date);
	$first_sunday = sundayOfWeek($this_year, $this_month, "1");
	$thisday2 = strftime($dateFormat_week_list, $unix_time);


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<title><?php echo "$calendar_name"; ?></title>
	<link rel="stylesheet" type="text/css" href="styles/<?php echo "$style_sheet"; ?>">
	<?php include "functions/event.js"; ?>
</head>
<body>
<center>
<table width="735" border="0" cellspacing="0" cellpadding="0" class="calborder">
	<tr>
		<td align="center" valign="middle" bgcolor="white">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="75" background="images/time_bg.gif"><?php echo "<a class=\"psf\" href=\"month.php?cal=$cal&getdate=$prev_month\"><img src=\"images/left_day.gif\" alt=\"\" width=\"28\" height=\"28\" border=\"0\" align=\"left\"></a>"; ?></td>
					<td class="H20" align="center" bgcolor="#DDDDDD" background="images/time_bg.gif"><?php echo "$display_month"; ?></td>
					<td width="75" background="images/time_bg.gif"><?php echo "<a class=\"psf\" href=\"month.php?cal=$cal&getdate=$next_month\"><img src=\"images/right_day.gif\" alt=\"\" width=\"28\" height=\"28\" border=\"0\" align=\"right\"></a>"; ?></td>
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
					<td valign="top" width="105" height="12" bgcolor="#eeeeee" class="V9">
						<center><b>Sunday</b></center>
					</td>
					<td valign="top" width="105" height="12" bgcolor="#eeeeee" class="V9">
						<center><b>Monday</b></center>
					</td>
					<td valign="top" width="105" height="12" bgcolor="#eeeeee" class="V9">
						<center><b>Tuesday</b></center>
					</td>
					<td valign="top" width="105" height="12" bgcolor="#eeeeee" class="V9">
						<center><b>Wednesday</b></center>
					</td>
					<td valign="top" width="105" height="12" bgcolor="#eeeeee" class="V9">
						<center><b>Thursday</b></center>
					</td>
					<td valign="top" width="105" height="12" bgcolor="#eeeeee" class="V9">
						<center><b>Friday</b></center>
					</td>
					<td valign="top" width="105" height="12" bgcolor="#eeeeee" class="V9">
						<center><b>Saturday</b></center>
					</td>
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
					$sunday = strtotime("$first_sunday");
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
						if (($master_array[("$daylink")]) && ($check_month == $this_month)) {
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
											$event_text2 	= str_replace("\"", "&quot;", $event_text2);
											$description 	= addslashes($val["description"]);
											$description 	= str_replace("\"", "&quot;", $description);
											$event_start 	= $val["event_start"];
											$event_end 		= $val["event_end"];
											$event_start 	= date ($timeFormat, strtotime ("$event_start"));
											$event_end 		= date ($timeFormat, strtotime ("$event_end"));
											if (strlen($event_text) > 12) {
												$event_text = substr("$event_text", 0, 10);
												$event_text = $event_text . "...";
											}	
											echo "<tr>\n";
											echo "<td>\n";
											echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
											echo "<tr>\n";
											echo "<td>\n";
											if (!$event_start = $val["event_start"]) {
												echo "<center><a class=\"psf\" href=\"javascript:openEventInfo('$event_text2', '$calendar_name', '$event_start', '$event_end', '$description')\"><i>$event_text</i></a></center>\n";
											} else {	
												echo "<a class=\"psf\" href=\"javascript:openEventInfo('$event_text2', '$calendar_name', '$event_start', '$event_end', '$description')\"><font class=\"G10B\">&#149; $event_text</a>\n";
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
<?php echo "<font class=\"V9\">$powered_by_lang <a class=\"psf\" href=\"http://sourceforge.net/projects/phpicalendar/\">PHP iCalendar $version_lang</a>"; ?>
</center>
</body>
</html>
