	<?php
	
	$cal_displayname2 = $calendar_name . " $calendar_lang";
	if (strlen($cal_displayname2) > 24) {
		$cal_displayname2 = substr("$cal_displayname2", 0, 21);
		$cal_displayname2 = $cal_displayname2 . "...";
	}
	
	?>
	
	<table cellpadding="0" cellspacing="0" border="0" width="170">
		<tr>
			<td valign="center" align="center">
				<table width="170" border="0" cellpadding="0" cellspacing="0" class="calborder">
					<tr>
						<td align="left" valign="top" width="24" class="sideback"><?php echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$yesterdays_date\"><img src=\"styles/$style_sheet/left_arrows.gif\" alt=\"right\" width=\"16\" height=\"20\" border=\"0\" align=\"left\"></a>"; ?></td>
						<td align="center" width="112" class="sideback"><font class="G10BOLD"><?php echo "$thisday2"; ?></font></td>
						<td align="right" valign="top" width="24" class="sideback"><?php echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$tomorrows_date\"><img src=\"styles/$style_sheet/right_arrows.gif\" alt=\"right\" width=\"16\" height=\"20\" border=\"0\" align=\"right\"></a>"; ?></td>
					</tr>
					<tr>
						<td colspan="3" bgcolor="#FFFFFF" align="left">
							<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" width="100%">
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="21" height="6"></td>
								</tr>
								<tr>
									<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
									<td colspan="6"><font class="G10BOLD"><?php echo "$cal_displayname2"; ?></font></td>
								</tr>
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="21" height="3"></td>
								</tr>
								<tr>
									<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
									<td colspan="6" class="G10B"><?php echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$today_today\">$goday_lang</a>"; ?></td>
								</tr>
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="21" height="1"></td>
								</tr>
								<tr>
									<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
									<td colspan="6" class="G10B"><?php echo "<a class=\"psf\" href=\"week.php?cal=$cal&getdate=$today_today\">$goweek_lang</a>"; ?></td>
								</tr>
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="21" height="1"></td>
								</tr>
								<tr>
									<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
									<td colspan="6" class="G10B"><?php echo "<a class=\"psf\" href=\"month.php?cal=$cal&getdate=$today_today\">$gomonth_lang</a>"; ?></td>
								</tr>
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="21" height="1"></td>
								</tr>
								<tr>
									<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
									<td colspan="6" class="G10B"><?php echo "<a class=\"psf\" href=\"year.php?cal=$cal&getdate=$today_today\">$goyear_lang</a>"; ?></td>
								</tr>
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="21" height="5"></td>
								</tr>
								<tr>
									<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
									<td width="1%" align="middle"><?php echo "<a class=\"psf\" href=\"$subscribe_path\"><img src=\"styles/$style_sheet/smallicon.gif\" alt=\"\" border=\"0\" align=\"middle\"></a>"; ?></td>
									<td width="1%"><img src="images/spacer.gif" width="3" height="1"></td>
									<td colspan="4" class="G10B"><?php echo "<a class=\"psf\" href=\"$subscribe_path\">$subscribe_lang</a>"; ?></td>
								</tr>
								<tr>
									<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
									<td width="1%" align="middle"><?php echo "<a class=\"psf\" href=\"$filename\"><img src=\"styles/$style_sheet/download_arrow.gif\" alt=\"\" border=\"0\" align=\"middle\"></a>"; ?></td>
									<td width="1%"><img src="images/spacer.gif" width="3" height="1"></td>
									<td colspan="4" class="G10B"><?php echo "<a class=\"psf\" href=\"$filename\">$download_lang</a>"; ?></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td colspan="3"><img src="images/spacer.gif" width="1" height="6"></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br>
	<table cellpadding="0" cellspacing="0" border="0" width="170">
		<tr>
			<td valign="center" align="center">
				<table width="170" border="0" cellpadding="0" cellspacing="0" class="calborder">
					<tr>
						<td align="left" valign="top" width="1%" class="sideback"><img src="images/spacer.gif" width="1" height="20"></td>
						<td align="center" width="98%" class="sideback"><font class="G10BOLD"><?php echo "$jump_lang"; ?></font></td>
						<td align="right" valign="top" width="1%" class="sideback"></td>
					</tr>
					<tr>
						<td colspan="3" bgcolor="#FFFFFF" align="left">
							<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" width="100%">
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="21" height="6"></td>
								</tr>
								<tr>
									<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
									<td colspan="6"><?php include('./functions/list_icals.php'); ?></td>
								</tr>
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="21" height="5"></td>
								</tr>
								<tr>
									<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
									<td colspan="6"><?php include('./functions/list_years.php'); ?></td>
								</tr>
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="21" height="5"></td>
								</tr>
								<tr>
									<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
									<td colspan="6"><?php include('./functions/list_months.php'); ?></td>
								</tr>
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="21" height="5"></td>
								</tr>
								<tr>
									<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
									<td colspan="6"><?php include('./functions/list_weeks.php'); ?></td>
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
<?php if (isset($master_array[($tomorrows_date)]) && sizeof($master_array[($tomorrows_date)]) > 0) { ?>
	<table cellpadding="0" cellspacing="0" border="0" width="170">
		<tr>
			<td valign="center" align="center">
				<table width="170" border="0" cellpadding="0" cellspacing="0" class="calborder">
					<tr>
						<td align="left" valign="top" width="1%" class="sideback"><img src="images/spacer.gif" width="1" height="20"></td>
						<td align="center" width="98%" class="sideback"><font class="G10BOLD"><?php echo "$tomorrows_lang"; ?></font></td>
						<td align="right" valign="top" width="1%" class="sideback"></td>
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
										$event_text = urldecode($val["event_text"]);
										$event_text = strip_tags($event_text, '<b><i><u>');
										if ($event_text != "") {	
											$event_text2 	= addslashes($val["event_text"]);
											$event_text2 	= urlencode($event_text2);
											$description 	= $val["description"];
											$description 	= addslashes($val["description"]);
											$description	= urlencode($description);
											$event_start 	= @$val["event_start"];
											$event_end 		= @$val["event_end"];
											$event_start 	= date ($timeFormat, @strtotime ("$event_start"));
											$event_end 		= date ($timeFormat, @strtotime ("$event_end"));
											$calendar_name2	= addslashes($calendar_name);
											$calendar_name2 = urlencode($calendar_name2);
											$event_text = word_wrap($event_text, 21, $tomorrows_events_lines);
											echo "<tr>\n";
											echo "<td width=\"1%\"><img src=\"images/spacer.gif\" width=\"4\" height=\"1\"></td>";
											echo "<td colspan=\"6\" class=\"G10B\">\n";
											if (!isset($val["event_start"])) {
												$event_start = $all_day_lang;
												$event_end = '';
												echo "<a class=\"psf\" href=\"javascript:openEventInfo('$event_text2', '$calendar_name2', '$event_start', '$event_end', '$description')\"><i>$event_text</i></a>\n";
											} else {	
												echo "<a class=\"psf\" href=\"javascript:openEventInfo('$event_text2', '$calendar_name2', '$event_start', '$event_end', '$description')\"><font class=\"G10B\">&#149; $event_text</font></a>\n";
											}
											echo "</td>\n";
											echo "</tr>\n";
											//$num_of_events++;
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
	<table cellpadding="0" cellspacing="0" border="0" width="170">
		<tr>
			<td valign="center" align="center">
				<table width="170" border="0" cellpadding="0" cellspacing="0" class="calborder">
					<tr>

						<td align="left" valign="top" width="1" class="sideback"><img src="images/spacer.gif" width="1" height="20"></td>
						<td align="center" class="sideback"><font class="G10BOLD"><?php print (localizeDate ($dateFormat_month, strtotime("-1 month", strtotime($getdate)))); ?></font></td>
						<td align="right" valign="top" width="1" class="sideback"></td>
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
										$day_num = date("w", $start_day);
										$day = $daysofweekreallyshort_lang[$day_num];
										print "<td align=\"center\" class=\"G10BOLD\">$day</td>\n";
										$start_day = ($start_day + (24.5 * 60 * 60));
									}
								?>
								</tr>
								<tr height="3">
									<td colspan="7"><img src="images/spacer.gif" width="1" height="3" alt=""></td>
								</tr>
								<?php
									$minical_time = strtotime("-1 month", strtotime($getdate));
									$minical_month = date("m", $minical_time);
									$minical_year = date("Y", $minical_time);
									$first_of_month = $minical_year.$minical_month."01";
									$start_day = strtotime(dateOfWeek($first_of_month, $week_start_day));
									$i = 0;
									$whole_month = TRUE;
									$num_of_events = 0;
									do {
										$day = date ("j", $start_day);
										$daylink = date ("Ymd", $start_day);
										$check_month = date ("m", $start_day);
										if ($check_month != $minical_month) $day= "<font class=\"G10G\">$day</font>";
										if ($i == 0) echo "<tr>\n";
										if (isset($master_array[("$daylink")]) && ($check_month == $minical_month)) {
											echo "<td align=\"center\" class=\"G10B\">\n";
											echo "<a class=\"ps2\" href=\"$minical_view.php?cal=$cal&getdate=$daylink\">$day</a>\n";
											echo "</td>\n";
										} else {
											echo "<td align=\"center\" class=\"G10B\">\n";
											echo "<a class=\"psf\" href=\"$minical_view.php?cal=$cal&getdate=$daylink\">$day</a>\n";
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
	<table cellpadding="0" cellspacing="0" border="0" width="170">
		<tr>
			<td valign="center" align="center">
				<table width="170" border="0" cellpadding="0" cellspacing="0" class="calborder">
					<tr>
						<td align="left" valign="top" width="1" class="sideback"><img src="images/spacer.gif" width="1" height="20"></td>
						<td align="center" class="sideback"><font class="G10BOLD"><?php print (localizeDate ($dateFormat_month, strtotime($getdate))); ?></font></td>
						<td align="right" valign="top" width="1" class="sideback"></td>
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
										$day_num = date("w", $start_day);
										$day = $daysofweekreallyshort_lang[$day_num];
										print "<td align=\"center\" class=\"G10BOLD\">$day</td>\n";
										$start_day = ($start_day + (24.5 * 60 * 60));
									}
								?>
								</tr>
								<tr height="3">
									<td colspan="7"><img src="images/spacer.gif" width="1" height="3" alt=""></td>
								</tr>
								<?php
									$minical_time = strtotime($getdate);
									$minical_month = date("m", $minical_time);
									$minical_year = date("Y", $minical_time);
									$first_of_month = $minical_year.$minical_month."01";
									$start_day = strtotime(dateOfWeek($first_of_month, $week_start_day));
									$i = 0;
									$whole_month = TRUE;
									$num_of_events = 0;
									do {
										$day = date ("j", $start_day);
										$daylink = date ("Ymd", $start_day);
										$check_month = date ("m", $start_day);
										if ($check_month != $minical_month) $day= "<font class=\"G10G\">$day</font>";
										if ($i == 0) echo "<tr>\n";
										if (isset($master_array[("$daylink")]) && ($check_month == $minical_month)) {
											echo "<td align=\"center\" class=\"G10B\">\n";
											echo "<a class=\"ps2\" href=\"$minical_view.php?cal=$cal&getdate=$daylink\">$day</a>\n";
											echo "</td>\n";
										} else {
											echo "<td align=\"center\" class=\"G10B\">\n";
											echo "<a class=\"psf\" href=\"$minical_view.php?cal=$cal&getdate=$daylink\">$day</a>\n";
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
	<table cellpadding="0" cellspacing="0" border="0" width="170">
		<tr>
			<td valign="center" align="center">
				<table width="170" border="0" cellpadding="0" cellspacing="0" class="calborder">
					<tr>
						<td align="left" valign="top" width="1" class="sideback"><img src="images/spacer.gif" width="1" height="20"></td>
						<td align="center" class="sideback"><font class="G10BOLD"><?php print (localizeDate ($dateFormat_month, strtotime("+1 month", strtotime($getdate)))); ?></font></td>
						<td align="right" valign="top" width="1" class="sideback"></td>
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
										$day_num = date("w", $start_day);
										$day = $daysofweekreallyshort_lang[$day_num];
										print "<td align=\"center\" class=\"G10BOLD\">$day</td>\n";
										$start_day = ($start_day + (24.5 * 60 * 60));
									}
								?>
								</tr>
								<tr height="3">
									<td colspan="7"><img src="images/spacer.gif" width="1" height="3" alt=""></td>
								</tr>
								<?php
									$minical_time = strtotime("+1 month", strtotime($getdate));
									$minical_month = date("m", $minical_time);
									$minical_year = date("Y", $minical_time);
									$first_of_month = $minical_year.$minical_month."01";
									$start_day = strtotime(dateOfWeek($first_of_month, $week_start_day));
									$i = 0;
									$whole_month = TRUE;
									$num_of_events = 0;
									do {
										$day = date ("j", $start_day);
										$daylink = date ("Ymd", $start_day);
										$check_month = date ("m", $start_day);
										if ($check_month != $minical_month) $day= "<font class=\"G10G\">$day</font>";
										if ($i == 0) echo "<tr>\n";
										if (isset($master_array[("$daylink")]) && ($check_month == $minical_month)) {
											echo "<td align=\"center\" class=\"G10B\">\n";
											echo "<a class=\"ps2\" href=\"$minical_view.php?cal=$cal&getdate=$daylink\">$day</a>\n";
											echo "</td>\n";
										} else {
											echo "<td align=\"center\" class=\"G10B\">\n";
											echo "<a class=\"psf\" href=\"$minical_view.php?cal=$cal&getdate=$daylink\">$day</a>\n";
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
