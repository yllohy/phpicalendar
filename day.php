<? 

include "ical_parser.php";

//might not need this, depending on implimentation, doesn't work correctly in current form anyway
//setcookie("last_view", "day");
$current_view = "day";

if ($getdate == (date("Ymd"))) {
	$display_date = date ("l, F d");
	$tomorrows_date = date( "Ymd", (time() + (24 * 3600)));
	$yesterdays_date = date( "Ymd", (time() - (24 * 3600)));
} else {
	ereg ("([0-9]{4})([0-9]{2})([0-9]{2})", $getdate, $day_array2);
	$this_day = $day_array2[3];
	$this_month = $day_array2[2];
	$this_year = $day_array2[1];
	$unix_time = mktime(0,0,0,"$this_month","$this_day","$this_year");
	$display_date = date ("l, F d", $unix_time);
	$tomorrow = $unix_time + (24 * 3600);
	$yesterday = $unix_time - (24 * 3600);
	$tomorrows_date = date( "Ymd", ($tomorrow));
	$yesterdays_date = date( "Ymd", ($yesterday));
}

if (!$cal) $cal = "$default_cal";

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html lang="en">
<head>
 <meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
  <title><? echo "$calendar_name"; ?></title>
	<link rel="stylesheet" type="text/css" href="styles/<? echo "$style_sheet"; ?>">
</head>
<body bgcolor="#FFFFFF">
<center>

<table width="700" border="0" cellspacing="0" cellpadding="0" class="V12">
	<tr>
		<td align="left" width="5%"><!--[[a class="psf" href="day.php"]]Today[[/a]]--></td>
		<td align="center" width="90%"><a class="psf" href="day.php?cal=<? echo "$cal&getdate=$getdate"; ?>">Day</a> | <a class="psf" href="week.php?cal=<? echo "$cal&getdate=$getdate"; ?>">Week</a> | <a class="psf" href="month.php?cal=<? echo "$cal&getdate=$getdate"; ?>">Month</a></td>
		<td align="right" width="5%"><!--[[a class="psf" href="preferences.php"]]Preferences[[/a]]--></td>
	</tr>
	<tr>
		<td colspan="3"><img src="images/spacer.gif" height="24" width="1"></td>
	</tr>
	<tr>
		<td class="V12" align="left" valign="top" width="5%" nowrap><? echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$yesterdays_date\">Previous Day</a>"; ?></td>
		<td class="H20" align="center" valign="middle" width="90%" nowrap><? echo "$display_date"; ?></td>
		<td class="V12" align="right" valign="top" width="5%" nowrap><? echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$tomorrows_date\">Next Day</a>"; ?></td>
	</tr>
	<tr>
		<td colspan="3"><img src="images/spacer.gif" height="10" width="1"></td>
	</tr>
</table>
<table width="700" border="0" cellspacing="1" cellpadding="2" class="calborder">
<tr>
<td>

<table width="700" border="0" cellspacing="0" cellpadding="0">
    <tr>
     	<td align="center" valign="middle">
      		<table border="0" cellspacing="0" cellpadding="0" bgcolor="#a1a5a9" class="G10B">
      			<tr>
					<td align="center" valign="top">
						<table border="0" cellspacing="1" cellpadding="0">
							<tr>
								<td colspan="3" bgcolor="white" nowrap>
									<table width="100%" border="0" cellspacing="4" cellpadding="0">
										<tr>
											<td align="left" valign="middle"><? include('./list_icals.php'); ?></td>
											<td align="right" valign="middle" class="V12"><a class="psf" href="<? echo "$fullpath"; ?>">Subscribe</a>&nbsp;|&nbsp;<a class="psf" href="<? echo "$filename"; ?>">Download</a></td>
										</tr>
									</table>
								</td>
							</tr>
							<?
							// The all day events returned here.
							$i = 0;
							if ($master_array[($getdate)]["0001"]["event_text"] != "") {
								echo "<tr height=\"30\">\n";
								echo "<td colspan=\"3\" height=\"30\" valign=\"middle\" align=\"center\" class=\"eventbg\">\n";
								echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">\n";										  
								foreach($master_array[($getdate)]["0001"]["event_text"] as $all_day_text) {
									if ($i > 0) {
										echo "<tr>\n";
										echo "<td bgcolor=\"#eeeeee\" height=\"1\"></td>\n";
										echo "</tr>\n";
									}
									echo "<tr>\n";
									echo "<td valign=\"top\" align=\"center\"><font class=\"eventfont\"><i>$all_day_text</i></font></td>\n";
									echo "</tr>\n";
									$i++;
								}
								echo "</table>\n";
								echo "</td>\n";
								echo "</tr>\n";
							}
							?>

							<tr>
								 <td nowrap bgcolor="#a1a5a9" width="60"><img src="images/spacer.gif" width="60" height="1"></td>
								 <td nowrap bgcolor="#a1a5a9" width="1"><img src="images/spacer.gif" width="1" height="1"></td>
								 <td colspan="3" nowrap bgcolor="#a1a5a9"><img src="images/spacer.gif" width="649" height="1"></td>
							</tr>
							<?
								// $master_array[($getdate)]["$day_time"]
								$event_length = 0;
								
								foreach ($day_array as $key) {
									// The first <TR>
									$k = 0;
									$cal_time = $key;	
									$key = strtotime ("$key");
									$key = date ("g:i A", $key);
																		
									if (ereg("^([0-9]{1,2}):00", $key)) {
										if ($master_array[($getdate)]["$cal_time"] == "") {	
											echo "<tr height=\"30\">\n";
											echo "<td rowspan=\"2\" align=\"center\" valign=\"top\" bgcolor=\"#f5f5f5\" width=\"60\">$key</td>\n";
											echo "<td align=\"center\" valign=\"top\" nowrap bgcolor=\"#a1a5a9\" width=\"1\" height=\"30\"></td>\n";
											if ($event_length > 0) {
												$event_length--;
											} else {
												echo "<td bgcolor=\"#ffffff\"><img src=\"images/spacer.gif\" width=\"1\" height=\"30\"></td>\n";
											}
											echo "</tr>\n";
										} elseif ($event_started != TRUE) {
											$event_started = TRUE;
											$event_text = $master_array[($getdate)]["$cal_time"][$k]["event_text"];
											$event_start = $master_array[($getdate)]["$cal_time"][$k]["event_start"];
											$event_end = $master_array[($getdate)]["$cal_time"][$k]["event_end"];
											$event_length = $master_array[($getdate)]["$cal_time"][$k]["event_length"];
											$event_start = strtotime ("$event_start");
											$event_start = date ("g:i a", $event_start);
											$event_end = strtotime ("$event_end");
											$event_end = date ("g:i a", $event_end);
											echo "<tr height=\"30\">\n";
											echo "<td rowspan=\"2\" align=\"center\" valign=\"top\" bgcolor=\"#f5f5f5\" width=\"60\">$key</td>\n";
											echo "<td align=\"center\" valign=\"top\" nowrap bgcolor=\"#a1a5a9\" width=\"1\" height=\"30\"></td>\n";
											echo "<td rowspan=\"$event_length\" align=\"left\" valign=\"top\" class=\"eventbg\">\n";
											echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">\n";
											echo "<tr>\n";
											echo "<td class=\"eventborder\"><font class=\"eventfont\"><b>$event_start</b> - $event_end</font></td>\n";
											echo "</tr>\n";
											echo "<tr>\n";              
											echo "<td>\n";
											echo "<table width=\"100%\" border=\"0\" cellpadding=\"1\" cellspacing=\"0\">\n";
											echo "<tr>\n";
											echo "<td bgcolor=\"#68aaef\"><font class=\"eventfont\">$event_text</font></td>\n";
											echo "</tr>\n";
											echo "</table>\n";
											echo "</td>\n";           
											echo "</tr>\n";
											echo "</table>\n";
											echo "</td>\n";
											echo "</tr>\n";
											$event_length--;								
										} else {
											echo "<tr height=\"30\">\n";
											echo "<td rowspan=\"2\" align=\"center\" valign=\"top\" bgcolor=\"#f5f5f5\" width=\"60\">$key</td>\n";
											echo "<td align=\"center\" valign=\"top\" nowrap bgcolor=\"#a1a5a9\" width=\"1\" height=\"30\"></td>\n";
											if ($event_length > 0) {
												$event_length--;
											} else {
												echo "<td bgcolor=\"#ffffff\"><img src=\"images/spacer.gif\" width=\"1\" height=\"30\"></td>\n";
											}
											echo "</tr>\n";										
										}
									}
									
									if ($event_length == 0) $event_started = FALSE;
									
									
									// The second <TR>
									if (ereg("([0-9]{1,2}):30", $key)) {
										if (($master_array[($getdate)]["$cal_time"] == "") && ($event_started != TRUE)) {
											echo "<tr height=\"30\">\n";
											echo "<td align=\"center\" valign=\"top\" nowrap bgcolor=\"#a1a5a9\" width=\"1\" height=\"30\"></td>\n";
											echo "<td bgcolor=\"#ffffff\">&nbsp;</td>\n";
											echo "</tr>\n";
										} elseif ($event_length > 0) {
											echo "<tr height=\"30\">\n";
											echo "<td align=\"center\" valign=\"top\" nowrap bgcolor=\"#a1a5a9\" width=\"1\" height=\"30\"</td>\n";
											echo "</tr>\n";
											$event_length--;
										} else {
											$event_started = TRUE;
											$event_text = $master_array[($getdate)]["$cal_time"][$k]["event_text"];
											$event_start = $master_array[($getdate)]["$cal_time"][$k]["event_start"];
											$event_end = $master_array[($getdate)]["$cal_time"][$k]["event_end"];
											$event_length = $master_array[($getdate)]["$cal_time"][$k]["event_length"];
											echo "<tr>\n";
											echo "<td align=\"center\" valign=\"top\" nowrap bgcolor=\"#a1a5a9\" width=\"1\" height=\"30\"></td>\n";
											echo "<td rowspan=\"$event_length\" align=\"left\" valign=\"top\" class=\"eventbg\">\n";
											echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">\n";
											echo "<tr>\n";
											echo "<td class=\"eventborder\"><font class=\"eventfont\"><b>$event_start</b></font></td>\n";
											echo "</tr>\n";
											echo "<tr>\n";              
											echo "<td>\n";
											echo "<table width=\"100%\" border=\"0\" cellpadding=\"1\" cellspacing=\"0\">\n";
											echo "<tr>\n";
											echo "<td bgcolor=\"#68aaef\"><font class=\"eventfont\">$event_text</font></td>\n";
											echo "</tr>\n";
											echo "</table>\n";
											echo "</td>\n";           
											echo "</tr>\n";
											echo "</table>\n";
											echo "</td>\n";
											echo "</tr>\n";
											$event_length--;
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
<table width="700" border="0" cellspacing="0" cellpadding="0" class="V12">
	<tr>
		<td colspan="3"><img src="images/spacer.gif" height="10" width="1"></td>
	</tr>
	<tr>
		<td class="V12" align="left" valign="top" width="5%" nowrap><? echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$yesterdays_date\">Previous Day</a>"; ?></td>
		<td class="H20" align="center" valign="middle" width="90%" nowrap><? echo "$display_date"; ?></td>
		<td class="V12" align="right" valign="top" width="5%" nowrap><? echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$tomorrows_date\">Next Day</a>"; ?></td>
	</tr>
	<tr>
		<td colspan="3"><img src="images/spacer.gif" height="24" width="1"></td>
	</tr>
	<tr>
		<td align="left" width="5%"><!--[[a class="psf" href="day.php"]]Today[[/a]]--></td>
		<td align="center" width="90%"><a class="psf" href="day.php?cal=<? echo "$cal&getdate=$getdate"; ?>">Day</a> | <a class="psf" href="week.php?cal=<? echo "$cal&getdate=$getdate"; ?>">Week</a> | <a class="psf" href="month.php?cal=<? echo "$cal&getdate=$getdate"; ?>">Month</a></td>
		<td align="right" width="5%"><!--[[a class="psf" href="preferences.php"]]Preferences[[/a]]--></td>
	</tr>
</table>


</center>
</body>
</html>

