	<?php
	
	if ($cal == $ALL_CALENDARS_COMBINED) {
		$cal_displayname2 = $all_cal_comb_lang;
	} else {
		$cal_displayname2 = $calendar_name . " $calendar_lang";
	}
	if (strlen($cal_displayname2) > 24) {
		$cal_displayname2 = substr("$cal_displayname2", 0, 21);
		$cal_displayname2 = $cal_displayname2 . "...";
	}
	
	$next_day = date("Ymd", strtotime("+1 day", $unix_time));
	$prev_day = date("Ymd", strtotime("-1 day", $unix_time));

	// Get the real date to display as "go to today", not the date displayed in the calendar
	$really_unix_time = strtotime(date('Ymd'));
	$really_today_today = date ('Ymd', $really_unix_time);
		
	$fake_getdate_time = strtotime($this_year.'-'.$this_month.'-15');
	?>
<br>
<table border="0" width="737" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="calborder">
	<tr>
		<td align="left" valign="top" width="1%"  class="sideback"><?php echo "<a class=\"psf\" href=\"month.php?cal=$cal&amp;getdate=$prev_day\"><img src=\"styles/$style_sheet/left_arrows.gif\" alt=\"[$last_day_lang]\" border=\"0\" align=\"left\"></a>"; ?></td>
		<td align="center" class="sideback"><font class="G10B"><b><?php print (localizeDate ($dateFormat_day, strtotime($getdate))); ?></b></font></td>
		<td align="right" valign="top" width="1%"  class="sideback"><?php echo "<a class=\"psf\" href=\"month.php?cal=$cal&amp;getdate=$next_day\"><img src=\"styles/$style_sheet/right_arrows.gif\" alt=\"[$next_day_lang]\" border=\"0\" align=\"right\"></a>"; ?></td>
	</tr>
	<tr>
		<td colspan="3"><img src="images/spacer.gif" width="1" height="5" alt=" "></td>
	</tr>
	<tr>
		<td width="1%" valign="top" align="right">
			<table cellpadding="0" cellspacing="0" border="0" width="160">
				<tr>
					<td valign="middle" align="center">
						<table width="160" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td align="center"><font class="G10BOLD"><?php print (localizeDate ($dateFormat_month, strtotime("-1 month", $fake_getdate_time))); ?></font></td>
							</tr>
							<tr>
								<td bgcolor="#FFFFFF" align="center">
									<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
										<?php
											$start_day = strtotime($week_start_day);
											echo '<tr>';
											for ($i=0; $i<7; $i++) {
												$day_num = date("w", $start_day);
												$day = $daysofweekreallyshort_lang[$day_num];
												echo '<td align="center" class="G10BOLD">'.$day.'</td>';
												$start_day = strtotime("+1 day", $start_day); 
											}
											echo '</tr>';
											$minical_time 		= strtotime("-1 month", $fake_getdate_time);
											$minical_month 		= date("m", $minical_time);
											$minical_year 		= date("Y", $minical_time);
											$first_of_month 	= $minical_year.$minical_month."01";
											$start_day 			= strtotime(dateOfWeek($first_of_month, $week_start_day));
											$i 					= 0;
											$whole_month 		= TRUE;
											$num_of_events 		= 0;
											do {
												$day 			= date ("j", $start_day);
												$daylink 		= date ("Ymd", $start_day);
												$check_month 	= date ("m", $start_day);
												if ($check_month != $minical_month) $day = '<font class="G10G">'.$day.'</font>';
												if ($i == 0) echo "<tr>\n";
												if (isset($master_array[("$daylink")]) && ($check_month == $minical_month)) {
													echo '<td width="22" align="center" class="G10B">';
													echo '<a class="ps2" href="'.$minical_view.'.php?cal='.$cal.'&amp;getdate='.$daylink.'">'.$day.'</a>';
													echo '</td>';
												} else {
													echo '<td width="22" align="center" class="G10B">';
													echo '<a class="psf" href="'.$minical_view.'.php?cal='.$cal.'&amp;getdate='.$daylink.'">'.$day.'</a>';
													echo '</td>';
												}
												$start_day = strtotime("+1 day", $start_day); 
												$i++;
												if ($i == 7) { 
													echo '</tr>';
													$i = 0;
													$checkagain = date ("m", $start_day);
													if ($checkagain != $minical_month) $whole_month = FALSE;	
												}
											} while ($whole_month == TRUE);
										?>
									</table>
									<img src="images/spacer.gif" width="1" height="3" alt=" "><br>
								</td>
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
								<td bgcolor="#FFFFFF" align="left" class="G10BOLD">
									<?php 
									
									echo '<b>'.$jump_lang.'</b><br>';
									echo '<img src="images/spacer.gif" width="1" height="6" alt=" "><br>';
									echo "<form action=\"month.php\" method=\"GET\"><select name=\"action\" class=\"query_style\" onChange=\"window.location=(this.options[this.selectedIndex].value+'$query');\">";
									include('./functions/list_icals.php');
									include('./functions/list_years.php');
									include('./functions/list_months.php');
									include('./functions/list_weeks.php');
									echo "</form>";
									echo '<img src="images/spacer.gif" width="1" height="6" alt=" "><br>';
									
									?>
								</td>
							</tr>
						</table>
					</td>
					<td><img src="images/spacer.gif" width="20" height="1" alt=" "></td>
					<td width="160" valign="top">
						<table cellpadding="0" cellspacing="0" border="0" width="160">
							<tr>
								<td valign="middle" align="left" valign="top">
									<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" width="100%">
										<tr>
											<td colspan="7"><img src="images/spacer.gif" width="21" height="2" alt=" "></td>
										</tr>
										<tr>
											<td width="1%"><img src="images/spacer.gif" width="4" height="1" alt=" "></td>
											<td colspan="6"><font class="G10BOLD"><?php echo "$cal_displayname2"; ?></font></td>
										</tr>
										<tr>
											<td width="1%"><img src="images/spacer.gif" width="4" height="1" alt=" "></td>
											<td colspan="6" class="G10B">
											<?php 
												echo "<a class=\"psf\" href=\"day.php?cal=$cal&amp;getdate=$really_today_today\">$goday_lang</a><br>\n";
												echo "<a class=\"psf\" href=\"week.php?cal=$cal&amp;getdate=$really_today_today\">$goweek_lang</a><br>\n";
												echo "<a class=\"psf\" href=\"month.php?cal=$cal&amp;getdate=$really_today_today\">$gomonth_lang</a><br>\n";
												echo "<a class=\"psf\" href=\"year.php?cal=$cal&amp;getdate=$really_today_today\">$goyear_lang</a><br>\n";
												echo "<a class=\"psf\" href=\"print.php?cal=$cal&amp;getdate=$getdate&amp;printview=$current_view\">$goprint_lang</a><br>\n";
												if ($allow_preferences != 'no') echo "<a class=\"psf\" href=\"preferences.php?cal=$cal&amp;getdate=$getdate\">$preferences_lang</a><br>\n";
												if ($cal != $ALL_CALENDARS_COMBINED) echo "<a class=\"psf\" href=\"$subscribe_path\">$subscribe_lang</a>&nbsp;|&nbsp;<a class=\"psf\" href=\"$download_filename\">$download_lang</a>\n";
											 ?>
											</td>
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
			<td valign="middle" align="center">
				<table width="160" border="0" cellpadding="3" cellspacing="0">
					<tr>
						<td align="center"><font class="G10BOLD"><?php print (localizeDate ($dateFormat_month, strtotime("+1 month", $fake_getdate_time))); ?></font></td>
					</tr>
					<tr>
						<td bgcolor="#FFFFFF" align="center">
							<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
								<?php
									$start_day = strtotime($week_start_day);
									echo '<tr>';
									for ($i=0; $i<7; $i++) {
										$day_num = date("w", $start_day);
										$day = $daysofweekreallyshort_lang[$day_num];
										echo '<td align="center" class="G10BOLD">'.$day.'</td>';
										$start_day = strtotime("+1 day", $start_day); 
									}
									echo '</tr>';
									$minical_time 		= strtotime("+1 month", $fake_getdate_time);
									$minical_month 		= date("m", $minical_time);
									$minical_year 		= date("Y", $minical_time);
									$first_of_month 	= $minical_year.$minical_month."01";
									$start_day 			= strtotime(dateOfWeek($first_of_month, $week_start_day));
									$i 					= 0;
									$whole_month 		= TRUE;
									$num_of_events 		= 0;
									do {
										$day 			= date ("j", $start_day);
										$daylink 		= date ("Ymd", $start_day);
										$check_month 	= date ("m", $start_day);
										if ($check_month != $minical_month) $day = '<font class="G10G">'.$day.'</font>';
										if ($i == 0) echo "<tr>\n";
										if (isset($master_array[("$daylink")]) && ($check_month == $minical_month)) {
											echo '<td width="22" align="center" class="G10B">';
											echo '<a class="ps2" href="'.$minical_view.'.php?cal='.$cal.'&amp;getdate='.$daylink.'">'.$day.'</a>';
											echo '</td>';
										} else {
											echo '<td width="22" align="center" class="G10B">';
											echo '<a class="psf" href="'.$minical_view.'.php?cal='.$cal.'&amp;getdate='.$daylink.'">'.$day.'</a>';
											echo '</td>';
										}
										$start_day = strtotime("+1 day", $start_day); 
										$i++;
										if ($i == 7) { 
											echo '</tr>';
											$i = 0;
											$checkagain = date ("m", $start_day);
											if ($checkagain != $minical_month) $whole_month = FALSE;	
										}
									} while ($whole_month == TRUE);
								?>
							</table>
							<img src="images/spacer.gif" width="1" height="3" alt=" "><br>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>	
</td>
</tr>
</table>
