<?php
$current_view = 'year';
define('BASE', './');
include(BASE.'functions/ical_parser.php');

ereg ("([0-9]{4})([0-9]{2})([0-9]{2})", $getdate, $day_array2);
$this_day = $day_array2[3]; 
$this_month = $day_array2[2];
$this_year = $day_array2[1]. '01'. '01';
$this_year2 = $day_array2[1];

$unix_time = strtotime($getdate);
$startYear = strtotime ($this_year);
$checkad = date ("Ymd", $startYear);

$next_year = strtotime ("+1 year", strtotime("$getdate"));
$next_year = date ("Ymd", $next_year);
$prev_year = strtotime ("-1 year", strtotime("$getdate"));
$prev_year = date ("Ymd", $prev_year);

$thisday2 = localizeDate($dateFormat_week_list, $unix_time);


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title><?php echo "$calendar_name - $this_year2"; ?></title>
	<link rel="stylesheet" type="text/css" href="styles/<?php echo $style_sheet.'/default.css'; ?>">
	<meta name="generator" content="BBEdit 6.5.3">
</head>
<body>
<?php include ('./header.inc.php'); ?>
<center>
<table width="676" border="0" cellspacing="0" cellpadding="0" class="calborder">
	<tr>
		<td align="center" valign="middle" bgcolor="white">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
      			<tr>
      				<td align="left" width="90" class="navback">&nbsp;</td>
      				<td class="navback">
      					<table width="100%" border="0" cellspacing="0" cellpadding="0">
      						<tr>
								<td align="right" width="45%" class="navback"><?php echo "<a class=\"psf\" href=\"year.php?cal=$cal&getdate=$prev_year\"><img src=\"styles/$style_sheet/left_day.gif\" alt=\"\" border=\"0\" align=\"right\"></a>"; ?></td>
								<td align="center" width="10%" class="navback" nowrap valign="middle"><font class="H20"><?php echo $this_year2; ?></font></td>
      							<td align="left" width="45%" class="navback"><?php echo "<a class=\"psf\" href=\"year.php?cal=$cal&getdate=$next_year\"><img src=\"styles/$style_sheet/right_day.gif\" alt=\"\" border=\"0\" align=\"left\"></a>"; ?></td>
      						</tr>
      					</table>
      				</td>
      				<td align="right" width="90" class="navback">	
      					<table width="90" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td><?php echo '<a class="psf" href="day.php?cal='.$cal.'&getdate='.$getdate.'"><img src="styles/'.$style_sheet.'/day_on.gif" alt="" border="0"></td>'; ?>
								<td><?php echo '<a class="psf" href="week.php?cal='.$cal.'&getdate='.$getdate.'"><img src="styles/'.$style_sheet.'/week_on.gif" alt="" border="0"></td>'; ?>
								<td><?php echo '<a class="psf" href="month.php?cal='.$cal.'&getdate='.$getdate.'"><img src="styles/'.$style_sheet.'/month_on.gif" alt="" border="0"></td>'; ?>
							</tr>
						</table>
					</td>
      			</tr>
      		</table>
		</td>
	</tr>
</table>
<br>	
<table border="0" width="670" cellspacing="0" cellpadding="0">
	<tr>	
		<?php
		$m=0;	
		$n=0;
		do {
		
		?>
		<td width="210" valign="top" align="left">
			<table border="0" width="210" cellspacing="0" cellpadding="0" class="calborder">
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="0" cellpadding="0">
							<tr>
								<td width="1" class="sideback"><img src="images/spacer.gif" width="1" height="20" alt=""></td>
								<?php 
									$monthlink = date("Ym", $startYear); 
									$monthlink = $monthlink . $this_day;
								?>
								<td align="center" class="sideback"><?php echo '<a class="ps3" href="month.php?cal=' . $cal . '&getdate=' . $monthlink . '">'; ?><font class="G10BOLD"><?php print (localizeDate ($dateFormat_month, $startYear)); ?></font></a></td>
								<td width="1" class="sideback"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
				<?php
					$start_day = strtotime($week_start_day);
					for ($i=0; $i<7; $i++) {
						$day_num = date("w", $start_day);
						$day = $daysofweekshort_lang[$day_num];
						print '<td width="30" height="14" class="dateback" align="center"><font class="V9BOLD">' . $day . '</td>' . "\n";
						$start_day = strtotime("+1 day", $start_day); 
					}
				?>
				</tr>
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="1" cellpadding="0" class="yearmonth">
							<?php
									$minical_time = $startYear;
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
										if ($check_month != $minical_month) $day= "<font class=\"V9G\">$day</font>";
										if ($i == 0) echo '<tr height="30">';
										if (isset($master_array[("$daylink")]) && ($check_month == $minical_month)) {
											foreach ($master_array[("$daylink")] as $event_times) {
												foreach ($event_times as $val) {
												if (!isset($val["event_start"])) $image1 = '<img src="styles/'. $style_sheet . '/allday_dot.gif" alt="" width="11" height="10" border="0">';
												if (isset($val["event_start"])) $image2 = '<img src="styles/'. $style_sheet . '/event_dot.gif" alt="" width="11" height="10" border="0">';
												}
											}	
											if (isset($master_array[("$daylink")][-1])) $image2 = '<img src="styles/silver/allday_dot.gif" alt="" border="0">';
											echo '<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href=\'day.php?cal=' . $cal . '&getdate=' . $daylink . '\'">' . "\n";
											echo '<table width="100%" border="0" cellspacing="0" cellpadding="1">' . "\n";
											echo '<tr>' . "\n";
											echo '<td align="right" valign="top" class="V9">' . "\n";
											echo '<a class="psf" href="day.php?cal=' . $cal . '&getdate=' . $daylink . '">' . $day . '</a>' . "\n";
											echo '</td>' . "\n";
											echo '</tr>' . "\n";
											echo '<tr>' . "\n";
											echo '<td align="center" valign="top">' . $image1 . $image2 . '</td>' . "\n";
											echo '</tr>' . "\n";
											echo '</table>' . "\n";
										} elseif ($check_month == $minical_month) {
											echo '<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href=\'day.php?cal=' . $cal . '&getdate=' . $daylink . '\'">' . "\n";
											echo '<font class="V9"><a class="psf" href="day.php?cal=' . $cal . '&getdate=' . $daylink . '">' . $day . '</a></font></td>' . "\n";
										} else {
											echo '<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href=\'day.php?cal=' . $cal . '&getdate=' . $daylink . '\'">' . "\n";
											echo '<a class="psf" href="day.php?cal=' . $cal . '&getdate=' . $daylink . '">' . $day . '</a></td>' . "\n";
										}
										$start_day = strtotime("+1 day", $start_day); 
										$i++;
										$image1 = '';
										$image2 = '';
										if ($i == 7) { 
											echo '</tr>';
											$i = 0;
											$checkagain = date ("m", $start_day);
											if ($checkagain != $minical_month) $whole_month = FALSE;	
										}
									} while ($whole_month == TRUE);
									$startYear = strtotime ("+1 month", $startYear);
								?>
						</table>
					</td>
				</tr>
			</table>
		</td>
		<?php 
				if ($m < 2) echo '<td width="20"><img src="images/spacer.gif" width="20" height="1" alt=""></td>';
				$m++;
				$n++;
				if (($m == 3) && ($n < 12)) {
					$m = 0;
					echo '<tr>';
					echo '<td colspan="5"><img src="images/spacer.gif" width="1" height="20" alt=""></td>';
					echo '</tr>';
				}
			} while (($m < 3) && ($n < 12)); 
		?>
</table>
<?php include (BASE.'footer.inc.php'); ?>
</center>
</body>
</html>
