	<?php
	
	$cal_displayname2 = $calendar_name . " $calendar_lang";
	if (strlen($cal_displayname2) > 24) {
		$cal_displayname2 = substr("$cal_displayname2", 0, 21);
		$cal_displayname2 = $cal_displayname2 . "...";
	}
	
	$next_day = date("Ymd", strtotime("+1 day", $unix_time));
	$prev_day = date("Ymd", strtotime("-1 day", $unix_time));
	
	$fake_getdate_time = strtotime($this_year.'-'.$this_month.'-15');
	?>
<br>
<table border="0" width="737" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="calborder">
	<tr>
		<td align="left" valign="top" width="1%"  class="sideback"><?php echo "<a class=\"psf\" href=\"month.php?cal=$cal&getdate=$prev_day\"><img src=\"styles/$style_sheet/left_arrows.gif\" alt=\"right\" border=\"0\" align=\"left\"></a>"; ?></td>
		<td align="center" class="sideback"><font class="G10B"><b><?php print (localizeDate ($dateFormat_day, strtotime($getdate))); ?></b></font></td>
		<td align="right" valign="top" width="1%"  class="sideback"><?php echo "<a class=\"psf\" href=\"month.php?cal=$cal&getdate=$next_day\"><img src=\"styles/$style_sheet/right_arrows.gif\" alt=\"right\" border=\"0\" align=\"right\"></a>"; ?></td>
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
								<td align="center"><font class="G10BOLD"><?php print (localizeDate ($dateFormat_month, strtotime("-1 month", $fake_getdate_time))); ?></font></td>
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
												$day_num = date("w", $start_day);
												$day = $daysofweekreallyshort_lang[$day_num];
												print "<td align=\"center\"><font class=\"G10BOLD\">$day</font></td>\n";
												$start_day = strtotime("+1 day", $start_day); 
											}
										?>
										</tr>
										<tr height="3">
											<td colspan="7"><img src="images/spacer.gif" width="1" height="3" alt=""></td>
										</tr>
										<?php
											$minical_time = strtotime("-1 month", $fake_getdate_time);
											$minical_month = date("m", $minical_time);
											$minical_year = date("Y", $minical_time);
											$first_of_month = $minical_year.$minical_month."01";
											$start_day = strtotime(dateOfWeek($first_of_month, $week_start_day));
											$i = 0;
											$whole_month = TRUE;
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
												$start_day = strtotime("+1 day", $start_day); 
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
														<td colspan="6"><font class="G10BOLD"><?php echo "$jump_lang"; ?></font></td>
													</tr>
													<tr>
														<td colspan="7"><img src="images/spacer.gif" width="21" height="3"></td>
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
														<td colspan="7"><img src="images/spacer.gif" width="21" height="1"></td>
													</tr>
													<tr>
														<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
														<td colspan="6" class="G10B"><?php echo "<a class=\"psf\" href=\"print.php?cal=$cal&getdate=$getdate&printview=$current_view\">$goprint_lang</a>"; ?></td>
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
						<td align="center"><font class="G10BOLD"><?php print (localizeDate ($dateFormat_month, strtotime("+1 month", $fake_getdate_time))); ?></font></td>
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
										$day_num = date("w", $start_day);
										$day = $daysofweekreallyshort_lang[$day_num];
										print "<td align=\"center\"><font class=\"G10BOLD\">$day</font></td>\n";
										$start_day = strtotime("+1 day", $start_day); 
									}
								?>
								</tr>
								<tr height="3">
									<td colspan="7"><img src="images/spacer.gif" width="1" height="3" alt=""></td>
								</tr>
								<?php
									$minical_time = strtotime("+1 month", $fake_getdate_time);
									$minical_month = date("m", $minical_time);
									$minical_year = date("Y", $minical_time);
									$first_of_month = $minical_year.$minical_month."01";
									$start_day = strtotime(dateOfWeek($first_of_month, $week_start_day));
									$i = 0;
									$whole_month = TRUE;
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
										$start_day = strtotime("+1 day", $start_day); 
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
	
<?php if (($num_of_events != 0) && ($this_months_events == "yes")) { ?>	
	<tr>
		<td colspan="3">
				<table border="0" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td align="center" valign="top">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td align="left" valign="top" width="160" class="montheventtop"><?php echo "<img src=\"images/spacer.gif\" alt=\"right\" width=\"16\" height=\"20\" border=\"0\" align=\"left\"></a>"; ?></td>
									<td align="center" class="montheventtop" width="417" nowrap><font class="G10BOLD"><?php echo "$this_months_lang"; ?></font></td>
									<td align="right" valign="top" width="160" class="montheventtop"><?php echo "<img src=\"images/spacer.gif\" alt=\"right\" width=\"16\" height=\"20\" border=\"0\" align=\"right\"></a>"; ?></td>
								</tr>
								<tr>
									<td colspan="3" height="1"></td>
								</tr>
								<?php	
									// Iterate the entire master array
									foreach($master_array as $key => $val) {
										
										// Pull out only this months
										ereg ("([0-9]{6})([0-9]{2})", $key, $regs);
										if ($regs[1] == $parse_month) {
											$dayofmonth = strtotime ($key);
											$dayofmonth = localizeDate ($dateFormat_week_list, $dayofmonth);
											$i = 0;
											if ($today_today == $key) {
												$fontclass="class=\"G10BOLD\"";
											} else {
												$fontclass="class=\"G10B\"";
											}
											
											// Pull out each day
											foreach ($val as $new_val) {
												
												// Pull out each time
												foreach ($new_val as $new_key2 => $new_val2) {
												if ($new_val2["event_text"]) {	
													$event_text 	= stripslashes(urldecode($new_val2["event_text"]));
													$event_text2 	= addslashes($new_val2["event_text"]);
													$event_text2 	= str_replace("\"", "&quot;", $event_text2);
													$event_text2 	= urlencode($event_text2);
													$description 	= addslashes(urlencode($new_val2["description"]));
													$description 	= str_replace("\"", "&quot;", $description);
													if (isset($new_val2["event_start"])) {
														$event_start 	= $new_val2["event_start"];
														$event_end 		= $new_val2["event_end"];
														$event_start 	= date ($timeFormat, strtotime ("$event_start"));
														$event_end 		= date ($timeFormat, strtotime ("$event_end"));
														$event_text 	= str_replace ("<br>", "", $event_text);
														$event_start2	= $event_start;
													} else {
														$event_start = "$all_day_lang";
														$event_start2 = '';
														$event_end = '';													}
													if (strlen($event_text) > 70) {
														$event_text = substr("$event_text", 0, 65);
														$event_text = $event_text . "...";
													}

													echo "<tr>\n";
													echo "<td align=\"left\" valign=\"top\" width =\"160\" class=\"montheventline\" nowrap><font $fontclass>&nbsp;<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$key\">$dayofmonth</a></font> <font class=\"V9G\">($event_start)</font></td>\n";
													echo "<td align=\"left\" valign=\"top\" colspan=\"2\">\n";
													echo "&nbsp;<a class=\"psf\" href=\"javascript:openEventInfo('$event_text2', '$calendar_name', '$event_start2', '$event_end', '$description')\"><font class=\"G10B\">$event_text</font></a>\n";
													echo "</td>\n";
													echo "</tr>\n";
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
	
<?php } ?>			
</table>
