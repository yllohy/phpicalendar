	<?php
	
	$cal_displayname2 = $cal_displayname . " $calendar_lang";
	if (strlen($cal_displayname2) > 24) {
		$cal_displayname2 = substr("$cal_displayname2", 0, 21);
		$cal_displayname2 = $cal_displayname2 . "...";
	}
	
	?>
<br>
<table border="0" width="737" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="calborder">
	<tr>
		<td align="left" valign="top" width="1%"  class="sideback"><?php echo "<a class=\"psf\" href=\"month.php?cal=$cal&getdate=$prev_month\"><img src=\"styles/$style_sheet/left_arrows.gif\" alt=\"right\" width=\"16\" height=\"20\" border=\"0\" align=\"left\"></a>"; ?></td>
		<td align="center" class="sideback"><font class="G10B"><b><?php print (strftime ($dateFormat_day, strtotime($getdate))); ?></b></font></td>
		<td align="right" valign="top" width="1%"  class="sideback"><?php echo "<a class=\"psf\" href=\"month.php?cal=$cal&getdate=$next_month\"><img src=\"styles/$style_sheet/right_arrows.gif\" alt=\"right\" width=\"16\" height=\"20\" border=\"0\" align=\"right\"></a>"; ?></td>
	</tr>
	<tr>
		<td colspan="3"><img src="images/spacer.gif" width="1" height="5"></td>
	</tr>
	<tr>
		<td width="1%" valign="top" align="right">
			<table cellpadding="0" cellspacing="0" border="0" width="160">
				<tr>
					<td valign="center" align="center">
						<table width="160" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td align="left" valign="top" width="1"><img src="images/spacer.gif" width="1" height="20"></td>
								<td align="center" class="G10B"><b><?php print (strftime ($dateFormat_month, strtotime("-1 month", strtotime($getdate)))); ?></b></td>
								<td align="right" valign="top" width="1"></td>
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
										<tr height="3">
											<td colspan="7"><img src="images/spacer.gif" width="1" height="3" alt=""></td>
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
		</td>
		<td width="98%" valign="top" align="center">
			<table border="0" width="330" cellspacing="0" cellpadding="0">
				<tr>
					<td width="160" valign="top">
						<table cellpadding="0" cellspacing="0" border="0" width="160">
							<tr>
								<td valign="center" align="center">
									<table width="160" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td colspan="3" bgcolor="#FFFFFF" align="left">
												<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" width="100%">
													<tr>
														<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
														<td colspan="6" class="G10B"><b><?php echo "$jump_lang"; ?></b></td>
													</tr>
													<tr>
														<td colspan="7"><img src="images/spacer.gif" width="21" height="3"></td>
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
					</td>
					<td><img src="images/spacer.gif" width="10" height="1"></td>
					<td width="160" valign="top">
						<table cellpadding="0" cellspacing="0" border="0" width="160">
							<tr>
								<td valign="center" align="left" valign="top">
									<table width="160" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td colspan="3" bgcolor="#FFFFFF" align="left" valign="top">
												<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" width="100%">
													<tr>
														<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
														<td colspan="6" class="G10B"><b><?php echo "$cal_displayname2"; ?></b></td>
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
														<td colspan="7"><img src="images/spacer.gif" width="21" height="5"></td>
													</tr>
													<tr>
														<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
														<td width="1%" align="middle"><?php echo "<a class=\"psf\" href=\"$fullpath$cal.ics\"><img src=\"styles/$style_sheet/smallicon.gif\" alt=\"\" width=\"13\" height=\"16\" border=\"0\" align=\"middle\"></a>"; ?></td>
														<td width="1%"><img src="images/spacer.gif" width="3" height="1"></td>
														<td colspan="4" class="G10B"><?php echo "<a class=\"psf\" href=\"$fullpath$cal.ics\">$subscribe_lang</a>"; ?></td>
													</tr>
													<tr>
														<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
														<td width="1%" align="middle"><?php echo "<a class=\"psf\" href=\"$filename\"><img src=\"styles/$style_sheet/download_arrow.gif\" alt=\"\" width=\"13\" height=\"16\" border=\"0\" align=\"middle\"></a>"; ?></td>
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
					</td>
				</tr>
			</table>
		</td>
		<td width="1%" valign="top" align="left">
	<table cellpadding="0" cellspacing="0" border="0" width="160">
		<tr>
			<td valign="center" align="center">
				<table width="160" border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td align="left" valign="top" width="1"><img src="images/spacer.gif" width="1" height="20"></td>
						<td align="center" class="G10B"><b><?php print (strftime ($dateFormat_month, strtotime("+1 month", strtotime($getdate)))); ?></b></td>
						<td align="right" valign="top" width="1"></td>
					</tr>
					<tr>
						<td colspan="3" bgcolor="#FFFFFF" align="center">
							<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
								<tr>
									<td><img src="images/spacer.gif" width="21" height="3" alt=""></td>
									<td><img src="images/spacer.gif" width="21" height="1" alt=""></td>
									<td><img src="images/spacer.gif" width="21" height="1" alt=""></td>
									<td><img src="images/spacer.gif" width="21" height="1" alt=""></td>
									<td><img src="images/spacer.gif" width="21" height="1" alt=""></td>
									<td><img src="images/spacer.gif" width="21" height="1" alt=""></td>
									<td><img src="images/spacer.gif" width="21" height="1" alt=""></td>
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
								<tr height="3">
									<td colspan="7"><img src="images/spacer.gif" width="1" height="3" alt=""></td>
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
						<td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="148" height="6" alt=""></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	
</td>
	</tr>
</table>
