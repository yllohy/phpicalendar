	<table cellpadding="0" cellspacing="0" border="0" width="160">
		<tr>
			<td valign="center" align="center">
				<table width="160" border="0" cellpadding="0" cellspacing="0" class="calborder">
					<tr>
						<td align="left" valign="top" bgcolor="#DDDDDD" width="1%"><?php echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$yesterdays_date\"><img src=\"images/left_arrows.gif\" alt=\"right\" width=\"16\" height=\"20\" border=\"0\" align=\"left\"></a>"; ?></td>
						<td bgcolor="#DDDDDD" align="center" class="G10B" width="98%"><b><?php echo "$thisday2"; ?></b></td>
						<td align="right" valign="top" bgcolor="#DDDDDD" width="1%"><?php echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$tomorrows_date\"><img src=\"images/right_arrows.gif\" alt=\"right\" width=\"16\" height=\"20\" border=\"0\" align=\"right\"></a>"; ?></td>
					</tr>
					<tr>
						<td colspan="3" bgcolor="#FFFFFF" align="center">
							<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" width="100%">
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="21" height="6"></td>
								</tr>
								<tr>
									<td width="1%"><img src="images/spacer.gif" width="4" height="1"></td>
									<td colspan="6" class="G10B"><?php echo "$cal $calendar_lang"; ?></td>
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
						<td align="left" valign="top" bgcolor="#DDDDDD" width="1%"><img src="images/spacer.gif" width="1" height="20"></td>
						<td bgcolor="#DDDDDD" align="center" class="G10B" width="98%"><b><?php echo "Jump to"; ?></b></td>
						<td align="right" valign="top" bgcolor="#DDDDDD" width="1%"></td>
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
						<td align="left" valign="top" bgcolor="#DDDDDD" width="1%"><img src="images/spacer.gif" width="1" height="20"></td>
						<td bgcolor="#DDDDDD" align="center" class="G10B" width="98%"><b><?php echo "Tomorrow's Events"; ?></b></td>
						<td align="right" valign="top" bgcolor="#DDDDDD" width="1%"></td>
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
											$event_text2 	= str_replace("\"", "&quot;", $event_text2);
											$description 	= addslashes($val["description"]);
											$description 	= str_replace("\"", "&quot;", $description);
											$event_start 	= $val["event_start"];
											$event_end 		= $val["event_end"];
											$event_start 	= date ($timeFormat, strtotime ("$event_start"));
											$event_end 		= date ($timeFormat, strtotime ("$event_end"));
											if (strlen($event_text) > 21) {
												$event_text = substr("$event_text", 0, 18);
												$event_text = $event_text . "...";
											}	
											echo "<tr>\n";
											echo "<td width=\"1%\"><img src=\"images/spacer.gif\" width=\"4\" height=\"1\"></td>";
											echo "<td colspan=\"6\" class=\"G10B\">\n";
											if (!$event_start = $val["event_start"]) {
												echo "<a class=\"psf\" href=\"javascript:openEventInfo('$event_text2', '$calendar_name', '$event_start', '$event_end', '$description')\"><i>$event_text</i></a>\n";
											} else {	
												echo "<a class=\"psf\" href=\"javascript:openEventInfo('$event_text2', '$calendar_name', '$event_start', '$event_end', '$description')\"><font class=\"G10B\">&#149; $event_text</font></a>\n";
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
						<td align="left" valign="top" bgcolor="#DDDDDD" width="1"><img src="images/spacer.gif" width="1" height="20"></td>
						<td bgcolor="#DDDDDD" align="center" class="G10B"><b><?php echo "$display_month1"; ?></b></td>
						<td align="right" valign="top" bgcolor="#DDDDDD" width="1"></td>
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
									<td align="center" class="G10B"><b>Su</b></td>
									<td align="center" class="G10B"><b>Mo</b></td>
									<td align="center" class="G10B"><b>Tu</b></td>
									<td align="center" class="G10B"><b>We</b></td>
									<td align="center" class="G10B"><b>Th</b></td>
									<td align="center" class="G10B"><b>Fr</b></td>
									<td align="center" class="G10B"><b>Sa</b></td>
								</tr>
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="1" height="3">
									</td>
								</tr>
								<?php 	 
									$sunday = strtotime("$first_sunday1");
									$i = 0;
									$whole_month = TRUE;
									$num_of_events = 0;
									do {
										$day = date ("j", $sunday);
										$daylink = date ("Ymd", $sunday);
										$check_month = date ("m", $sunday);
										if ($check_month != $month1) $day= "<font class=\"G10B\">$day</font>";
										if ($i == 0) echo "<tr>\n";
										if (($master_array[("$daylink")]) && ($check_month == $month1)) {
											echo "<td align=\"center\" class=\"G10B\">\n";
											echo "<a class=\"ps2\" href=\"day.php?cal=$cal&getdate=$daylink\">$day</a>\n";
											echo "</td>\n";
										} else {
											echo "<td align=\"center\" class=\"G10B\">\n";
											echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$daylink\">$day</a>\n";
											echo "</td>\n";
										}
										$sunday = ($sunday + (24.5 * 60 * 60));
										$i++;
										if ($i == 7) { 
											echo "</tr>\n";
											$i = 0;
											$checkagain = date ("m", $sunday);
											if ($checkagain != $month1) $whole_month = FALSE;	
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
						<td align="left" valign="top" bgcolor="#DDDDDD" width="1"><img src="images/spacer.gif" width="1" height="20"></td>
						<td bgcolor="#DDDDDD" align="center" class="G10B"><b><?php echo "$display_month2"; ?></b></td>
						<td align="right" valign="top" bgcolor="#DDDDDD" width="1"></td>
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
									<td align="center" class="G10B"><b>Su</b></td>
									<td align="center" class="G10B"><b>Mo</b></td>
									<td align="center" class="G10B"><b>Tu</b></td>
									<td align="center" class="G10B"><b>We</b></td>
									<td align="center" class="G10B"><b>Th</b></td>
									<td align="center" class="G10B"><b>Fr</b></td>
									<td align="center" class="G10B"><b>Sa</b></td>
								</tr>
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="1" height="3">
									</td>
								</tr>
								<?php 	 
									$sunday = strtotime("$first_sunday2");
									$i = 0;
									$whole_month = TRUE;
									$num_of_events = 0;
									do {
										$day = date ("j", $sunday);
										$daylink = date ("Ymd", $sunday);
										$check_month = date ("m", $sunday);
										if ($check_month != $month2) $day= "<font class=\"G10B\">$day</font>";
										if ($daylink == $getdate) $day= "<b>$day</b>";
										if ($i == 0) echo "<tr>\n";
										if (($master_array[("$daylink")]) && ($check_month == $month2)) {
											echo "<td align=\"center\" class=\"G10B\">\n";
											echo "<a class=\"ps2\" href=\"day.php?cal=$cal&getdate=$daylink\">$day</a>\n";
											echo "</td>\n";
										} else {
											echo "<td align=\"center\" class=\"G10B\">\n";
											echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$daylink\">$day</a>\n";
											echo "</td>\n";
										}
										$sunday = ($sunday + (24.5 * 60 * 60));
										$i++;
										if ($i == 7) { 
											echo "</tr>\n";
											$i = 0;
											$checkagain = date ("m", $sunday);
											if ($checkagain != $month2) $whole_month = FALSE;	
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
						<td align="left" valign="top" bgcolor="#DDDDDD" width="1"><img src="images/spacer.gif" width="1" height="20"></td>
						<td bgcolor="#DDDDDD" align="center" class="G10B"><b><?php echo "$display_month3"; ?></b></td>
						<td align="right" valign="top" bgcolor="#DDDDDD" width="1"></td>
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
									<td align="center" class="G10B"><b>Su</b></td>
									<td align="center" class="G10B"><b>Mo</b></td>
									<td align="center" class="G10B"><b>Tu</b></td>
									<td align="center" class="G10B"><b>We</b></td>
									<td align="center" class="G10B"><b>Th</b></td>
									<td align="center" class="G10B"><b>Fr</b></td>
									<td align="center" class="G10B"><b>Sa</b></td>
								</tr>
								<tr>
									<td colspan="7"><img src="images/spacer.gif" width="1" height="3">
									</td>
								</tr>
								<?php 	 
									$sunday = strtotime("$first_sunday3");
									$i = 0;
									$whole_month = TRUE;
									$num_of_events = 0;
									do {
										$day = date ("j", $sunday);
										$daylink = date ("Ymd", $sunday);
										$check_month = date ("m", $sunday);
										if ($check_month != $month3) $day= "<font class=\"G10B\">$day</font>";
										if ($i == 0) echo "<tr>\n";
										if (($master_array[("$daylink")]) && ($check_month == $month3)) {
											echo "<td align=\"center\" class=\"G10B\">\n";
											echo "<a class=\"ps2\" href=\"day.php?cal=$cal&getdate=$daylink\">$day</a>\n";
											echo "</td>\n";
										} else {
											echo "<td align=\"center\" class=\"G10B\">\n";
											echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$daylink\">$day</a>\n";
											echo "</td>\n";
										}
										$sunday = ($sunday + (24.5 * 60 * 60));
										$i++;
										if ($i == 7) { 
											echo "</tr>\n";
											$i = 0;
											$checkagain = date ("m", $sunday);
											if ($checkagain != $month3) $whole_month = FALSE;	
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
