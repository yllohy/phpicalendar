	<?php
	
	$cal_displayname2 = $cal_displayname . " $calendar_lang";
	if (strlen($cal_displayname2) > 24) {
		$cal_displayname2 = substr("$cal_displayname2", 0, 21);
		$cal_displayname2 = $cal_displayname2 . "...";
	}
	
	?>
	
	<table cellpadding="0" cellspacing="0" border="0" width="160">
		<tr>
			<td valign="center" align="center">
				<table width="160" border="0" cellpadding="0" cellspacing="0" class="calborder">
					<tr>
						<td align="left" valign="top" bgcolor="#DDDDDD" width="1%" background="images/side_bg.gif"><?php echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$yesterdays_date\"><img src=\"images/left_arrows.gif\" alt=\"right\" width=\"16\" height=\"20\" border=\"0\" align=\"left\"></a>"; ?></td>
						<td bgcolor="#DDDDDD" align="center" class="G10B" width="98%" background="images/side_bg.gif"><b><?php echo "$thisday2"; ?></b></td>
						<td align="right" valign="top" bgcolor="#DDDDDD" width="1%" background="images/side_bg.gif"><?php echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$tomorrows_date\"><img src=\"images/right_arrows.gif\" alt=\"right\" width=\"16\" height=\"20\" border=\"0\" align=\"right\"></a>"; ?></td>
					</tr>
					<tr>
						<td colspan="3" bgcolor="#FFFFFF" align="center">
							<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" width="100%">
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="21" height="6"></td>
								</tr>
								<tr>
									<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
									<td colspan="6" class="G10B"><b><?php echo "$cal_displayname2"; ?></b></td>
								</tr>
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="21" height="3"></td>
								</tr>
								<tr>
									<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
									<td colspan="6" class="G10B"><?php echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$today_today\">Go to Today</a>"; ?></td>
								</tr>
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="21" height="1"></td>
								</tr>
								<tr>
									<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
									<td colspan="6" class="G10B"><?php echo "<a class=\"psf\" href=\"week.php?cal=$cal&getdate=$today_today\">Go to This Week</a>"; ?></td>
								</tr>
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="21" height="1"></td>
								</tr>
								<tr>
									<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
									<td colspan="6" class="G10B"><?php echo "<a class=\"psf\" href=\"month.php?cal=$cal&getdate=$today_today\">Go to This Month</a>"; ?></td>
								</tr>
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="21" height="5"></td>
								</tr>
								<tr>
									<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
									<td width="1%" align="middle"><?php echo "<a class=\"psf\" href=\"$fullpath$cal.ics\"><img src=\"images/smallicon.gif\" alt=\"\" width=\"13\" height=\"16\" border=\"0\" align=\"middle\"></a>"; ?></td>
									<td width="1%"><img src="images/spacer.gif" width="3" height="1"></td>
									<td colspan="4" class="G10B"><?php echo "<a class=\"psf\" href=\"$fullpath$cal.ics\">$subscribe_lang</a>"; ?></td>
								</tr>
								<tr>
									<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
									<td width="1%" align="middle"><?php echo "<a class=\"psf\" href=\"$filename\"><img src=\"images/download_arrow.gif\" alt=\"\" width=\"13\" height=\"16\" border=\"0\" align=\"middle\"></a>"; ?></td>
									<td width="1%"><img src="images/spacer.gif" width="3" height="1"></td>
									<td colspan="4" class="G10B"><?php echo "<a class=\"psf\" href=\"$filename\">$download_lang</a>"; ?></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="148" height="6"></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br>
	<table cellpadding="0" cellspacing="0" border="0" width="160">
		<tr>
			<td valign="center" align="center">
				<table width="160" border="0" cellpadding="0" cellspacing="0" class="calborder">
					<tr>
						<td align="left" valign="top" bgcolor="#DDDDDD" width="1%" background="images/side_bg.gif"><img src="images/spacer.gif" width="1" height="20"></td>
						<td bgcolor="#DDDDDD" align="center" class="G10B" width="98%" background="images/side_bg.gif"><b><?php echo "Jump to"; ?></b></td>
						<td align="right" valign="top" bgcolor="#DDDDDD" width="1%" background="images/side_bg.gif"></td>
					</tr>
					<tr>
						<td colspan="3" bgcolor="#FFFFFF" align="center">
							<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" width="100%">
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="21" height="6"></td>
								</tr>
								<tr>
									<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
									<td colspan="6" class="G10B"><?php include('./functions/list_icals.php'); ?></td>
								</tr>
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="21" height="5"></td>
								</tr>
								<tr>
									<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
									<td colspan="6" class="G10B"><?php include('./functions/list_months.php'); ?></td>
								</tr>
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="21" height="5"></td>
								</tr>
								<tr>
									<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
									<td colspan="6" class="G10B"><?php include('./functions/list_weeks.php'); ?></td>
								</tr>
								<?php
								if ($display_custom_goto == "yes") {
								?>
								<tr>
									<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
									<td colspan="6" class="G10B">
										<form action="day.php" method="GET">
											<input type="hidden" name="cal" value="<?php print urlencode($cal); ?>">
											<input type="text" size="15" name="jumpto_day">
											<input type="submit" value="Go">
										</form>
									</td>
								</tr>
								<?php
								}
								?>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="148" height="6"></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br>
<?php if (sizeof($master_array[($tomorrows_date)]) > 0) { ?>
	<table cellpadding="0" cellspacing="0" border="0" width="160">
		<tr>
			<td valign="center" align="center">
				<table width="160" border="0" cellpadding="0" cellspacing="0" class="calborder">
					<tr>
						<td align="left" valign="top" bgcolor="#DDDDDD" width="1%" background="images/side_bg.gif"><img src="images/spacer.gif" width="1" height="20"></td>
						<td bgcolor="#DDDDDD" align="center" class="G10B" width="98%" background="images/side_bg.gif"><b><?php echo "Tomorrow's Events"; ?></b></td>
						<td align="right" valign="top" bgcolor="#DDDDDD" width="1%" background="images/side_bg.gif"></td>
					</tr>
					<tr>
						<td colspan="3" bgcolor="#FFFFFF" align="center">
							<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" width="100%">
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="21" height="6"></td>
								</tr>
								
								<?php
								foreach ($master_array[("$tomorrows_date")] as $event_times) {
									foreach ($event_times as $val) {
										$event_text = $val["event_text"];
										$event_text = strip_tags($event_text, '<b><i><u>');
										if ($event_text != "") {	
											$event_text2 	= addslashes($val["event_text"]);
											$event_text2 	= urlencode($event_text2);
											$description 	= $val["description"];
											$description 	= addslashes($val["description"]);
											$description	= urlencode($description);
											$event_start 	= $val["event_start"];
											$event_end 		= $val["event_end"];
											$event_start 	= date ($timeFormat, strtotime ("$event_start"));
											$event_end 		= date ($timeFormat, strtotime ("$event_end"));
											$calendar_name2	= addslashes($calendar_name);
											$calendar_name2 = urlencode($calendar_name2);
											if (strlen($event_text) > 21) {
												$event_text = substr("$event_text", 0, 18);
												$event_text = $event_text . "...";
											}	
											echo "<tr>\n";
											echo "<td width=\"1%\"><img src=\"images/spacer.gif\" width=\"4\" height=\"1\"></td>";
											echo "<td colspan=\"6\" class=\"G10B\">\n";
											if (!$event_start == $val["event_start"]) {
												echo "<a class=\"psf\" href=\"javascript:openEventInfo('$event_text2', '$calendar_name2', '$event_start', '$event_end', '$description')\"><i>$event_text</i></a>\n";
											} else {	
												echo "<a class=\"psf\" href=\"javascript:openEventInfo('$event_text2', '$calendar_name2', '$event_start', '$event_end', '$description')\"><font class=\"G10B\">&#149; $event_text</font></a>\n";
											}
											echo "</td>\n";
											echo "</tr>\n";
											$num_of_events++;
										}
									}
								}
								?>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="148" height="6"></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br>
<?php } ?>	
	<table cellpadding="0" cellspacing="0" border="0" width="160">
		<tr>
			<td valign="center" align="center">
				<table width="160" border="0" cellpadding="0" cellspacing="0" class="calborder">
					<tr>
						<td align="left" valign="top" bgcolor="#DDDDDD" width="1" background="images/side_bg.gif"><img src="images/spacer.gif" width="1" height="20"></td>
						<td bgcolor="#DDDDDD" align="center" class="G10B" background="images/side_bg.gif"><b><?php print (strftime ($dateFormat_month, strtotime("-1 month", strtotime($getdate)))); ?></b></td>
						<td align="right" valign="top" bgcolor="#DDDDDD" width="1" background="images/side_bg.gif"></td>
					</tr>
					<tr>
						<td colspan="3" bgcolor="#FFFFFF" align="center">
							<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
								<tr>
									<td><img src="images/spacer.gif" width="21" height="3"></td>
									<td><img src="images/spacer.gif" width="21" height="1"></td>
									<td><img src="images/spacer.gif" width="21" height="1"></td>
									<td><img src="images/spacer.gif" width="21" height="1"></td>
									<td><img src="images/spacer.gif" width="21" height="1"></td>
									<td><img src="images/spacer.gif" width="21" height="1"></td>
									<td><img src="images/spacer.gif" width="21" height="1"></td>
								</tr>
								<tr>
								<?php
									$start_day = strtotime($week_start_day);
									for ($i=0; $i<7; $i++) {
										$day = substr(date("D", $start_day), 0, 2);
										print "<td align=\"center\" class=\"G10B\"><b>$day</b></td>\n";
										$start_day = ($start_day + (24.5 * 60 * 60));
									}
								?>
								</tr>
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="1" height="3">
									</td>
								</tr>
								<?php
									$minical_time = strtotime("-1 month", strtotime($getdate));
									$minical_month = date("m", $minical_time);
									$minical_year = date("Y", $minical_time);
									$first_of_month = $minical_year.$minical_month."01";
									$start_day = strtotime(dateOfWeek($first_of_month, $start_week_day));
									$i = 0;
									$whole_month = TRUE;
									$num_of_events = 0;
									do {
										$day = date ("j", $start_day);
										$daylink = date ("Ymd", $start_day);
										$check_month = date ("m", $start_day);
										if ($check_month != $minical_month) $day= "<font class=\"G10B\">$day</font>";
										if ($i == 0) echo "<tr>\n";
										if (($master_array[("$daylink")]) && ($check_month == $minical_month)) {
											echo "<td align=\"center\" class=\"G10B\">\n";
											echo "<a class=\"ps2\" href=\"day.php?cal=$cal&getdate=$daylink\">$day</a>\n";
											echo "</td>\n";
										} else {
											echo "<td align=\"center\" class=\"G10B\">\n";
											echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$daylink\">$day</a>\n";
											echo "</td>\n";
										}
										$start_day = ($start_day + (24.5 * 60 * 60));
										$i++;
										if ($i == 7) { 
											echo "</tr>\n";
											$i = 0;
											$checkagain = date ("m", $start_day);
											if ($checkagain != $minical_month) $whole_month = FALSE;	
										}
									} while ($whole_month == TRUE);
								?>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="148" height="6"></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br>
	<table cellpadding="0" cellspacing="0" border="0" width="160">
		<tr>
			<td valign="center" align="center">
				<table width="160" border="0" cellpadding="0" cellspacing="0" class="calborder">
					<tr>
						<td align="left" valign="top" bgcolor="#DDDDDD" width="1" background="images/side_bg.gif"><img src="images/spacer.gif" width="1" height="20"></td>
						<td bgcolor="#DDDDDD" align="center" class="G10B" background="images/side_bg.gif"><b><?php print (strftime ($dateFormat_month, strtotime($getdate))); ?></b></td>
						<td align="right" valign="top" bgcolor="#DDDDDD" width="1" background="images/side_bg.gif"></td>
					</tr>
					<tr>
						<td colspan="3" bgcolor="#FFFFFF" align="center">
							<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
								<tr>
									<td><img src="images/spacer.gif" width="21" height="3"></td>
									<td><img src="images/spacer.gif" width="21" height="1"></td>
									<td><img src="images/spacer.gif" width="21" height="1"></td>
									<td><img src="images/spacer.gif" width="21" height="1"></td>
									<td><img src="images/spacer.gif" width="21" height="1"></td>
									<td><img src="images/spacer.gif" width="21" height="1"></td>
									<td><img src="images/spacer.gif" width="21" height="1"></td>
								</tr>
								<tr>
								<?php
									$start_day = strtotime($week_start_day);
									for ($i=0; $i<7; $i++) {
										$day = substr(date("D", $start_day), 0, 2);
										print "<td align=\"center\" class=\"G10B\"><b>$day</b></td>\n";
										$start_day = ($start_day + (24.5 * 60 * 60));
									}
								?>
								</tr>
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="1" height="3">
									</td>
								</tr>
								<?php
									$minical_time = strtotime($getdate);
									$minical_month = date("m", $minical_time);
									$minical_year = date("Y", $minical_time);
									$first_of_month = $minical_year.$minical_month."01";
									$start_day = strtotime(dateOfWeek($first_of_month, $start_week_day));
									$i = 0;
									$whole_month = TRUE;
									$num_of_events = 0;
									do {
										$day = date ("j", $start_day);
										$daylink = date ("Ymd", $start_day);
										$check_month = date ("m", $start_day);
										if ($check_month != $minical_month) $day= "<font class=\"G10B\">$day</font>";
										if ($i == 0) echo "<tr>\n";
										if (($master_array[("$daylink")]) && ($check_month == $minical_month)) {
											echo "<td align=\"center\" class=\"G10B\">\n";
											echo "<a class=\"ps2\" href=\"day.php?cal=$cal&getdate=$daylink\">$day</a>\n";
											echo "</td>\n";
										} else {
											echo "<td align=\"center\" class=\"G10B\">\n";
											echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$daylink\">$day</a>\n";
											echo "</td>\n";
										}
										$start_day = ($start_day + (24.5 * 60 * 60));
										$i++;
										if ($i == 7) { 
											echo "</tr>\n";
											$i = 0;
											$checkagain = date ("m", $start_day);
											if ($checkagain != $minical_month) $whole_month = FALSE;	
										}
									} while ($whole_month == TRUE);
								?>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="148" height="6"></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br>
	<table cellpadding="0" cellspacing="0" border="0" width="160">
		<tr>
			<td valign="center" align="center">
				<table width="160" border="0" cellpadding="0" cellspacing="0" class="calborder">
					<tr>
						<td align="left" valign="top" bgcolor="#DDDDDD" width="1" background="images/side_bg.gif"><img src="images/spacer.gif" width="1" height="20"></td>
						<td bgcolor="#DDDDDD" align="center" class="G10B" background="images/side_bg.gif"><b><?php print (strftime ($dateFormat_month, strtotime("+1 month", strtotime($getdate)))); ?></b></td>
						<td align="right" valign="top" bgcolor="#DDDDDD" width="1" background="images/side_bg.gif"></td>
					</tr>
					<tr>
						<td colspan="3" bgcolor="#FFFFFF" align="center">
							<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
								<tr>
									<td><img src="images/spacer.gif" width="21" height="3"></td>
									<td><img src="images/spacer.gif" width="21" height="1"></td>
									<td><img src="images/spacer.gif" width="21" height="1"></td>
									<td><img src="images/spacer.gif" width="21" height="1"></td>
									<td><img src="images/spacer.gif" width="21" height="1"></td>
									<td><img src="images/spacer.gif" width="21" height="1"></td>
									<td><img src="images/spacer.gif" width="21" height="1"></td>
								</tr>
								<tr>
								<?php
									$start_day = strtotime($week_start_day);
									for ($i=0; $i<7; $i++) {
										$day = substr(date("D", $start_day), 0, 2);
										print "<td align=\"center\" class=\"G10B\"><b>$day</b></td>\n";
										$start_day = ($start_day + (24.5 * 60 * 60));
									}
								?>
								</tr>
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="1" height="3">
									</td>
								</tr>
								<?php
									$minical_time = strtotime("+1 month", strtotime($getdate));
									$minical_month = date("m", $minical_time);
									$minical_year = date("Y", $minical_time);
									$first_of_month = $minical_year.$minical_month."01";
									$start_day = strtotime(dateOfWeek($first_of_month, $start_week_day));
									$i = 0;
									$whole_month = TRUE;
									$num_of_events = 0;
									do {
										$day = date ("j", $start_day);
										$daylink = date ("Ymd", $start_day);
										$check_month = date ("m", $start_day);
										if ($check_month != $minical_month) $day= "<font class=\"G10B\">$day</font>";
										if ($i == 0) echo "<tr>\n";
										if (($master_array[("$daylink")]) && ($check_month == $minical_month)) {
											echo "<td align=\"center\" class=\"G10B\">\n";
											echo "<a class=\"ps2\" href=\"day.php?cal=$cal&getdate=$daylink\">$day</a>\n";
											echo "</td>\n";
										} else {
											echo "<td align=\"center\" class=\"G10B\">\n";
											echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$daylink\">$day</a>\n";
											echo "</td>\n";
										}
										$start_day = ($start_day + (24.5 * 60 * 60));
										$i++;
										if ($i == 7) { 
											echo "</tr>\n";
											$i = 0;
											$checkagain = date ("m", $start_day);
											if ($checkagain != $minical_month) $whole_month = FALSE;	
										}
									} while ($whole_month == TRUE);
								?>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="148" height="6"></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
