<?php 

$current_view = "month";
define('BASE', './');
include(BASE.'functions/ical_parser.php');
if ($minical_view == 'current') $minical_view = 'month';

ereg ("([0-9]{4})([0-9]{2})([0-9]{2})", $getdate, $day_array2);
$this_day = $day_array2[3]; 
$this_month = $day_array2[2];
$this_year = $day_array2[1];

$unix_time = strtotime($getdate);
$today_today = date ("Ymd");
$tomorrows_date = date( "Ymd", strtotime("+1 day",  $unix_time));
$yesterdays_date = date( "Ymd", strtotime("-1 day",  $unix_time));
$date = mktime(0,0,0,"$this_month","$this_day","$this_year");

// find out next month
$next_month_month = ($this_month+1 == '13') ? '1' : ($this_month+1);
$next_month_day = $this_day;
$next_month_year = ($next_month_month == '1') ? ($this_year+1) : $this_year;
while (!checkdate($next_month_month,$next_month_day,$next_month_year)) $next_month_day--;
$next_month_time = mktime(0,0,0,$next_month_month,$next_month_day,$next_month_year);

// find out last month
$prev_month_month = ($this_month-1 == '0') ? '12' : ($this_month-1);
$prev_month_day = $this_day;
$prev_month_year = ($prev_month_month == '12') ? ($this_year-1) : $this_year;
while (!checkdate($prev_month_month,$prev_month_day,$prev_month_year)) $prev_month_day--;
$prev_month_time = mktime(0,0,0,$prev_month_month,$prev_month_day,$prev_month_year);


$next_month = date("Ymd", $next_month_time);
$prev_month = date("Ymd", $prev_month_time);

$display_month = localizeDate ($dateFormat_month, $date);
$parse_month = date ("Ym", $date);
$first_of_month = $this_year.$this_month."01";
$start_month_day = dateOfWeek($first_of_month, $week_start_day);
$thisday2 = localizeDate($dateFormat_week_list, $unix_time);
$num_of_events = 0;


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<title><?php echo "$calendar_name - $display_month"; ?></title>
	<link rel="stylesheet" type="text/css" href="styles/<?php echo "$style_sheet/default.css"; ?>">
	<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo $default_path.'/rss/rss.php?cal='.$cal.'&rssview=month'; ?>">
	<?php include (BASE.'functions/event.js'); ?>
</head>
<body>
<?php include (BASE.'includes/header.inc.php'); ?>
<center>
<table width="735" border="0" cellspacing="0" cellpadding="0" class="calborder">
	<tr>
		<td align="center" valign="middle" bgcolor="white">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
      			<tr>
      				<td align="left" width="120" class="navback">&nbsp;</td>
      				<td class="navback">
      					<table width="100%" border="0" cellspacing="0" cellpadding="0">
      						<tr>
								<td align="right" width="40%" class="navback"><?php echo "<a class=\"psf\" href=\"month.php?cal=$cal&amp;getdate=$prev_month\"><img src=\"styles/$style_sheet/left_day.gif\" alt=\"\" border=\"0\" align=\"right\"></a>"; ?></td>
								<td align="center" width="20%" class="navback" nowrap valign="middle"><font class="H20"><?php echo $display_month; ?></font></td>
      							<td align="left" width="40%" class="navback"><?php echo "<a class=\"psf\" href=\"month.php?cal=$cal&amp;getdate=$next_month\"><img src=\"styles/$style_sheet/right_day.gif\" alt=\"\" border=\"0\" align=\"left\"></a>"; ?></td>
      						</tr>
      					</table>
      				</td>
      				<td align="right" width="120" class="navback">	
      					<table width="120" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td><?php echo '<a class="psf" href="day.php?cal='.$cal.'&amp;getdate='.$getdate.'"><img src="styles/'.$style_sheet.'/day_on.gif" alt="" border="0"></a></td>'; ?>
								<td><?php echo '<a class="psf" href="week.php?cal='.$cal.'&amp;getdate='.$getdate.'"><img src="styles/'.$style_sheet.'/week_on.gif" alt="" border="0"></a></td>'; ?>
								<td><?php echo '<a class="psf" href="month.php?cal='.$cal.'&amp;getdate='.$getdate.'"><img src="styles/'.$style_sheet.'/month_on.gif" alt="" border="0"></a></td>'; ?>
								<td><?php echo '<a class="psf" href="year.php?cal='.$cal.'&amp;getdate='.$getdate.'"><img src="styles/'.$style_sheet.'/year_on.gif" alt="" border="0"></a></td>'; ?>
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
							print "<td valign=\"top\" width=\"105\" height=\"12\" class=\"dateback\"><center><font class=\"V9BOLD\">$day</font></center></td>";
							$start_day = strtotime("+1 day", $start_day);
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
			<table width="100%" border="0" cellspacing="1" cellpadding="0" class="monthback">
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
							$day= "<font class=\"G10G\">$day</font>";
							$bgclass="class=\"monthoff\"";
						} else {
							if ($today_today == $daylink) {
								$bgclass="class=\"monthon\"";
							} else {
								$bgclass="class=\"monthreg\"";
							}
						}
						if ($i == 0) echo "<tr height=\"105\">\n";
						if (isset($master_array[("$daylink")]) && ($check_month == $this_month)) {
							echo "<td align=\"center\" valign=\"top\" $bgclass width=\"105\" height=\"105\">\n";
							echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">\n";
							echo "<tr>\n";
							echo "<td align=\"right\" valign=\"top\" class=\"G10B\">\n";
							echo "<a class=\"psf\" href=\"day.php?cal=$cal&amp;getdate=$daylink\">$day</a>\n";
							echo "</td>\n";
							echo "</tr>\n";
							if ($master_array[("$daylink")]) {
								foreach ($master_array[("$daylink")] as $event_times) {
									foreach ($event_times as $val) {
										$num_of_events++;
										$event_text = stripslashes(urldecode($val["event_text"]));
										$event_text = strip_tags($event_text, '<b><i><u>');
										if ($event_text != "") {	
											$event_text2 	= addslashes($val["event_text"]);
											$event_text2 	= urlencode($event_text2);
											$description 	= addslashes($val["description"]);
											$description	= urlencode($description);
											$event_start 	= @$val["event_start"];
											$event_end 		= @$val["event_end"];
											$event_start 	= date ($timeFormat, @strtotime ("$event_start"));
											$event_start2 	= date ($timeFormat_small, @strtotime ("$event_start"));
											$event_end 		= date ($timeFormat, @strtotime ("$event_end"));
											$calendar_name2	= addslashes($calendar_name);
											$calendar_name2 = urlencode($calendar_name2);
											$event_text		= word_wrap($event_text, 12, $month_event_lines);
											echo "<tr>\n";
											echo "<td>\n";
											echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
											echo "<tr>\n";
											if (!isset($val["event_start"])) {
												$event_start = '';
												$event_end = '';
												echo "<td><font class=\"V10\"><center><a class=\"psf\" href=\"javascript:openEventInfo('$event_text2', '$calendar_name2', '$event_start', '$event_end', '$description')\"><i>$event_text</i></a></center></font></td>\n";
											} else {	
												echo "<td align=\"left\" valign=\"top\"><a class=\"psf\" href=\"javascript:openEventInfo('$event_text2', '$calendar_name2', '$event_start', '$event_end', '$description')\"><font class=\"V9\">&nbsp;$event_start2 $event_text</font></a></td>\n";
											}
											echo "</tr>\n";
											echo "</table>\n";
											echo "</td>\n";
											echo "</tr>\n";
										}
									}
								}
							}
							echo "</table>\n";
							echo "</td>\n";
						} else {
							echo "<td align=\"center\" valign=\"top\" $bgclass width=\"105\" height=\"105\">\n";
							echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"1\">\n";
							echo "<tr>\n";
							echo "<td align=\"right\" valign=\"top\" class=\"G10B\">\n";
							echo "<a class=\"psf\" href=\"day.php?cal=$cal&amp;getdate=$daylink\">$day</a>\n";
							echo "</td>\n";
							echo "</tr>\n";
							echo "</table>\n";
							echo "</td>\n";
						}
						$sunday = strtotime("+1 day", $sunday); 
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
<?php include (BASE.'includes/calendar_nav.php'); ?>
<?php if (($num_of_events != 0) && ($this_months_events == "yes")) { ?>	
<br>
<table border="0" cellspacing="0" cellpadding="0" width="737" bgcolor="#FFFFFF" class="calborder">
	<tr>
		<td align="center" valign="top">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align="left" valign="top" width="160" class="sideback"><?php echo "<img src=\"images/spacer.gif\" alt=\"right\" width=\"16\" height=\"20\" border=\"0\" align=\"left\"></a>"; ?></td>
					<td align="center" class="sideback" width="417" nowrap><font class="G10BOLD"><?php echo "$this_months_lang"; ?></font></td>
					<td align="right" valign="top" width="160" class="sideback"><?php echo "<img src=\"images/spacer.gif\" alt=\"right\" width=\"16\" height=\"20\" border=\"0\" align=\"right\"></a>"; ?></td>
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
									echo "<td align=\"left\" valign=\"top\" width =\"160\" class=\"montheventline\" nowrap><font $fontclass>&nbsp;<a class=\"psf\" href=\"day.php?cal=$cal&amp;getdate=$key\">$dayofmonth</a></font> <font class=\"V9G\">($event_start)</font></td>\n";
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
<?php } ?>
<?php include (BASE.'includes/footer.inc.php'); ?>
</center>
</body>
</html>
