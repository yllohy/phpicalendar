<? include "ical_parser.php"; 

	//might not need this, depending on implimentation, doesn't work correctly in current form anyway
	//setcookie("last_view", "month");
	$current_view = "month";

	ereg ("([0-9]{4})([0-9]{2})([0-9]{2})", $getdate, $day_array2);
	$this_day = $day_array2[3]; 
	$this_month = $day_array2[2];
	$this_year = $day_array2[1];
	$date = mktime(0,0,0,"$this_month","$this_day","$this_year");
	$next_date = DateAdd ("m", "1", $date);
	$prev_date = DateAdd ("m", "-1", $date);
	$next_month = date( "Ym01", $next_date);
	$prev_month = date( "Ym01", $prev_date);
	$display_month = date ("F Y", $date);
	$parse_month = date ("Ym", $date);
	$first_sunday = sundayOfWeek($this_year, $this_month, "1");


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<title><? echo "$calendar_name"; ?></title>
		<link rel="stylesheet" type="text/css" href="styles/<? echo "$style_sheet"; ?>">
</head>
<body bgcolor="#FFFFFF">
<center>
<table width="740" border="0" cellspacing="0" cellpadding="0" class="V12">
	<tr>
		<td align="left" width="5%"><!--[[a class="psf" href="day.php"]]Today[[/a]]--></td>
		<td align="center" width="90%"><? echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$getdate\">$day_lang</a> | <a class=\"psf\" href=\"week.php?cal=$cal&getdate=$getdate\">$week_lang</a> | <a class=\"psf\" href=\"month.php?cal=$cal&getdate=$getdate\">$month_lang</a>"; ?></td>
		<td align="right" width="5%"><!--[[a class="psf" href="preferences.php"]]Preferences[[/a]]--></td>
	</tr>
	<tr>
		<td colspan="3"><img src="images/spacer.gif" height="10" width="1"></td>
	</tr>
</table>
<table width="740" border="0" cellspacing="1" cellpadding="2" class="calborder">
<tr>
<td>
	<table width="740" border="0" cellspacing="0" cellpadding="0" class="calborder">
		<tr>
			<td align="center" valign="middle">
				<table border="0" cellspacing="0" cellpadding="0" bgcolor="#A1A5A9">
					<tr>
						<td align="center" valign="middle" bgcolor="white">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr height="36">
									<td align="left" valign="middle" bgcolor="white" height="36">
										<table border="0" cellspacing="0" cellpadding="0" width="100%">
											<tr>
												<td align="left" width="100"><font class="G10B"><? echo "<a class=\"psf\" href=\"month.php?cal=$cal&getdate=$prev_month\">$last_month_lang</a>"; ?></font></td>
												<td class="H20" align="center" valign="middle" bgcolor="white" height="24"><? echo "$display_month"; ?></td>
												<td align="right" width="100"><font class="G10B"><? echo "<a class=\"psf\" href=\"month.php?cal=$cal&getdate=$next_month\">$next_month_lang</a>"; ?></font></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td align="center" valign="middle">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
								<tr height="20">
									<td align="left" valign="middle" height="26"><? include('./list_icals.php'); ?></td>
									<td align="right" class="G10B"><? echo "<a class=\"psf\" href=\"$fullpath\">$subscribe_lang</a>&nbsp;|&nbsp;<a class=\"psf\" href=\"$filename\">$download_lang</a>"; ?></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						
						<td align="center" valign="top">
							<table width="100%" border="0" cellspacing="1" cellpadding="0" class="G10B">
								<tr height="11">
									<td valign="top" width="99" height="13" class="eventbg">
										<center><font class="eventfont"><b>Sunday</b></font></center>
									</td>
									<td valign="top" width="99" height="13" class="eventbg">
										<center><font class="eventfont"><b>Monday</b></font></center>
									</td>
									<td valign="top" width="99" height="13" class="eventbg">
										<center><font class="eventfont"><b>Tuesday</b></font></center>
									</td>
									<td valign="top" width="99" height="13" class="eventbg">
										<center><font class="eventfont"><b>Wednesday</b></font></center>
									</td>
									<td valign="top" width="99" height="13" class="eventbg">
										<center><font class="eventfont"><b>Thursday</b></font></center>
									</td>
									<td valign="top" width="99" height="13" class="eventbg">
										<center><font class="eventfont"><b>Friday</b></font></center>
									</td>
									<td valign="top" width="99" height="13" class="eventbg">
										<center><font class="eventfont"><b>Saturday</b></font></center>
									</td>
								</tr>
								<? 	 
									$sunday = strtotime("$first_sunday");
									$i = 0;
									$whole_month = TRUE;
									do {
										$day = date ("j", $sunday);
										$daylink = date ("Ymd", $sunday);
										$check_month = date ("m", $sunday);
										if ($check_month != $this_month) $day= "<font style=\"color: #D6D6D6\">$day</font>";
										if ($i == 0) echo "<tr height=\"99\">\n";
										if (($master_array[("$daylink")]) && ($check_month == $this_month)) {
											echo "<td align=\"center\" valign=\"top\" bgcolor=\"#ffffff\" width=\"99\" height=\"99\">\n";
											echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">\n";
											echo "<tr>\n";
											echo "<td align=\"right\" valign=\"top\">\n";
											echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$daylink\">$day</a>\n";
											echo "</td>\n";
											echo "</tr>\n";
											if ($master_array[("$daylink")]["0001"]["event_text"]) {
												foreach ($master_array[("$daylink")]["0001"]["event_text"] as $event_text) {
													if (strlen($event_text) > 15) {
														$event_text = substr("$event_text", 0, 12);
														$event_text = $event_text . "...";
													}
													echo "<tr height=\"15\">\n";
													echo "<td height=\"15\" valign=\"middle\" align=\"center\" bgcolor=\"#ffffff\">\n";
													echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$daylink\"><i>$event_text</i></a>\n";
													echo "</td>\n";
													echo "</tr>\n";
												}
											} else {
												foreach ($master_array[("$daylink")] as $event_times) {
													foreach ($event_times as $val) {
														$event_text = $val["event_text"];
														if (strlen($event_text) > 12) {
															$event_text = substr("$event_text", 0, 10);
															$event_text = $event_text . "...";
														}	
														echo "<tr>\n";
														echo "<td class=\"label\">\n";
														echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
														echo "<tr>\n";
														echo "<td class=\"label\">\n";
														echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$daylink\"><font class=\"G10B\">&#149; $event_text</font></a>\n";
														echo "</td>\n";
														echo "</tr>\n";
														echo "</table>\n";
														echo "</td>\n";
														echo "</tr>\n";
													}
												}
											}
											echo "</table>\n";
											echo "</td>\n";
										} else {
											echo "<td align=\"center\" valign=\"top\" bgcolor=\"#ffffff\" width=\"99\" height=\"99\">\n";
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
					<tr>
						<td align="center" valign="middle">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr height="36">
									<td align="left" valign="middle" bgcolor="white" height="36">
										<table border="0" cellspacing="0" cellpadding="0" width="100%">
											<tr>
												<td align="left">
													<font class="G10B"><? echo "<a class=\"psf\" href=\"month.php?cal=$cal&getdate=$prev_month\">Last Month</a>"; ?></font>
												</td>
												<td align="right">
													<font class="G10B"><? echo "<a class=\"psf\" href=\"month.php?cal=$cal&getdate=$next_month\">Next Month</a>"; ?></font>
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
		</tr>
	</table>
				</td>
		</tr>
	</table>
	<br>
	<table width="740" border="0" cellspacing="1" cellpadding="2" class="calborder">
<tr>
<td>
	<table width="740" border="0" cellspacing="0" cellpadding="0" class="calborder">
		<tr>
			<td align="center" valign="middle">
				<table border="0" cellspacing="0" cellpadding="0" bgcolor="#A1A5A9">
					<tr>
						<td align="center" valign="top">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr height="25">
									<td colspan="3" align="center" valign="middle" class="eventborder" width="740" height="25">
										<font class="V12" color="#FFFFFF"><b>This Month's Events</b></font>
									</td>
								</tr>
								<tr height="11">
									<td valign="middle" width="150" height="11" class="eventbg">
										<font class="eventfont"><b>&nbsp;Date</b></font>
									</td>
									<td width="1" height="11" class="eventbg"><img src="images/spacer.gif" height="15" width="1">
									</td>
									<td valign="middle" width="551" height="11" class="eventbg">
										<font class="eventfont"><b>&nbsp;Summary</b></font>
									</td>
								</tr>
								<tr height="1">
									<td colspan="3" width="825" height="1">
									</td>
								</tr>
								<?	
									// Iterate the entire master array
									foreach($master_array as $key => $val) {
										
										// Pull out only this months
										ereg ("([0-9]{6})([0-9]{2})", $key, $regs);
										if ($regs[1] == $parse_month) {
											$dayofmonth = strtotime ($key);
											$dayofmonth = date ("l, F jS", $dayofmonth);
											$i = 0;
											
											// Pull out each day
											foreach ($val as $new_val) {
												
												// Pull out each time
												foreach ($new_val as $new_key2 => $new_val2) {
												if (!$new_val2["event_text"]) {
													foreach ($new_val2 as $all_day) {
														$event_text = $all_day;
														$event_text = str_replace ("<br>", "", $event_text);
														if (strlen($event_text) > 70) {
															$event_text = substr("$event_text", 0, 65);
															$event_text = $event_text . "...";
														}
														echo "<tr height=\"20\">\n";
														echo "<td valign=\"middle\" bgcolor=\"white\" width=\"200\" height=\"20\">\n";
														echo "<font class=\"G10B\">&nbsp;<a class=\"psf\" href=\"day.php?getdate=$key\">$dayofmonth</font></a>\n";
														echo "</td>\n";
														echo "<td width=\"1\" height=\"20\">\n";
														echo "</td>\n";
														echo "<td valign=\"middle\" bgcolor=\"white\" width=\"540\" height=\"20\">\n";
														echo "<font class=\"G10B\">&nbsp;<a class=\"psf\" href=\"day.php?getdate=$key\">$event_text</font></a> <font class=\"V9\">(All day event)</font>\n";
														echo "</td>\n";
														echo "</tr>\n";
													}
												} elseif ($new_val2["event_text"]) {	
													$event_text = $new_val2["event_text"];
													$event_start = $new_val2["event_start"];
													$event_end = $new_val2["event_end"];
													$event_start = strtotime ("$event_start");
													$event_start = date ("g:i a", $event_start);
													$event_end = strtotime ("$event_end");
													$event_end = date ("g:i a", $event_end);
													$event_text = str_replace ("<br>", "", $event_text);
													if (strlen($event_text) > 70) {
														$event_text = substr("$event_text", 0, 65);
														$event_text = $event_text . "...";
													}
													echo "<tr height=\"20\">\n";
													echo "<td valign=\"middle\" bgcolor=\"white\" width=\"200\" height=\"20\">\n";
													echo "<font class=\"G10B\">&nbsp;<a class=\"psf\" href=\"day.php?getdate=$key\">$dayofmonth</font></a>\n";
													echo "</td>\n";
													echo "<td width=\"1\" height=\"20\">\n";
													echo "</td>\n";
													echo "<td valign=\"middle\" bgcolor=\"white\" width=\"540\" height=\"20\">\n";
													echo "<font class=\"G10B\">&nbsp;<a class=\"psf\" href=\"day.php?getdate=$key\">$event_text</a></font> <font class=\"V9\">($event_start - $event_end)</font>\n";
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
	</table>
				</td>
		</tr>
	</table>
</center>
</body>
</html>
