<?php

$current_view = "week";
define('BASE', './');
include(BASE.'functions/ical_parser.php');
if ($minical_view == "current") $minical_view = "week";

$starttime 			= "0500";
$weekstart 			= 1;
$unix_time 			= strtotime($getdate);
$thisday2 			= localizeDate($dateFormat_week_list, $unix_time);
$today_today 		= date('Ymd', strtotime("now + $second_offset seconds")); 
$next_week 			= date("Ymd", strtotime("+1 week",  $unix_time));
$prev_week 			= date("Ymd", strtotime("-1 week",  $unix_time));
$tomorrows_date 	= date( "Ymd", strtotime("+1 day",  $unix_time));
$yesterdays_date 	= date( "Ymd", strtotime("-1 day",  $unix_time));
$start_week_time 	= strtotime(dateOfWeek($getdate, $week_start_day));
$end_week_time 		= $start_week_time + (6 * 25 * 60 * 60);
$start_week 		= localizeDate($dateFormat_week, $start_week_time);
$end_week 			= localizeDate($dateFormat_week, $end_week_time);
$display_date 		= "$start_week - $end_week";

// For the side months
ereg ("([0-9]{4})([0-9]{2})([0-9]{2})", $getdate, $day_array2);
$this_day = $day_array2[3]; 
$this_month = $day_array2[2];
$this_year = $day_array2[1];

$dayborder = 0;
$thisdate = $start_week_time;
for ($i=0;$i<7;$i++) {
	$thisday = date("Ymd", $thisdate);
	$nbrGridCols[$thisday] = 1;
	if (isset($master_array[$thisday])) {
		foreach($master_array[($thisday)] as $ovlKey => $ovlValue) {
			if ($ovlKey != "-1") {
				foreach($ovlValue as $ovl2Value) {
					$nbrGridCols[($thisday)] = kgv($nbrGridCols[($thisday)], ($ovl2Value["event_overlap"] + 1));
				}
			}
		} 
	}
	$thisdate = ($thisdate + (25 * 60 * 60));
}
include (BASE.'includes/header.inc.php'); 

?>

<center>
<table border="0" width="720" cellspacing="0" cellpadding="0">
	<tr>
		<td width="540" valign="top">
			<table width="540" border="0" cellspacing="0" cellpadding="0" class="calborder">
				<tr>
					<td align="center" valign="middle">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td align="left" width="120" class="navback">&nbsp;</td>
								<td class="navback">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="right" width="40%" class="navback"><?php echo "<a class=\"psf\" href=\"week.php?cal=$cal&amp;getdate=$prev_week\"><img src=\"styles/$style_sheet/left_day.gif\" alt=\"[$last_week_lang]\" border=\"0\" align=\"right\"></a>"; ?></td>
											<td align="center" width="20%" class="navback" nowrap valign="middle"><font class="H20"><?php echo $display_date; ?></font></td>
											<td align="left" width="40%" class="navback"><?php echo "<a class=\"psf\" href=\"week.php?cal=$cal&amp;getdate=$next_week\"><img src=\"styles/$style_sheet/right_day.gif\" alt=\"[$next_week_lang]\" border=\"0\" align=\"left\"></a>"; ?></td>
										</tr>
									</table>
								</td>
								<td align="right" width="120" class="navback">	
									<table width="120" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td><?php echo '<a class="psf" href="day.php?cal='.$cal.'&amp;getdate='.$getdate.'"><img src="styles/'.$style_sheet.'/day_on.gif" alt="'.$day_view_lang.'" border="0"></a></td>'; ?>
											<td><?php echo '<a class="psf" href="week.php?cal='.$cal.'&amp;getdate='.$getdate.'"><img src="styles/'.$style_sheet.'/week_on.gif" alt="'.$week_view_lang.'" border="0"></a></td>'; ?>
											<td><?php echo '<a class="psf" href="month.php?cal='.$cal.'&amp;getdate='.$getdate.'"><img src="styles/'.$style_sheet.'/month_on.gif" alt="'.$month_view_lang.'" border="0"></a></td>'; ?>
											<td><?php echo '<a class="psf" href="year.php?cal='.$cal.'&amp;getdate='.$getdate.'"><img src="styles/'.$style_sheet.'/year_on.gif" alt="'.$year_view_lang.'" border="0"></a></td>'; ?>
										</tr>
									</table>
								</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="G10B">      			
							<tr>
								<td align="center" valign="top">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td width="60"><img src="images/spacer.gif" width="60" height="1" alt=" "></td>
											<td width="1"></td>
											<?php
											$thisdate = $start_week_time;
											$i = 0;
											do {
												$thisday = date("Ymd", $thisdate);
												$colWidth = round(70 / $nbrGridCols[$thisday]);
												for ($j=0;$j < $nbrGridCols[$thisday];$j++) {
													echo "<td width=\"" . $colWidth . "\"><img src=\"images/spacer.gif\" width=\"" . $colWidth . "\" height=\"1\" alt=\" \"></td>\n";
												}
												$thisdate = ($thisdate + (25 * 60 * 60));
												$i++;
											} while ($i < 7);
											?>
										</tr>
										<?php
										
										// print out the day names here
										echo "<tr>";
										$thisdate = $start_week_time;
										$i = 0;
										echo "<td class=\"dateback\" width=\"60\"><img src=\"images/spacer.gif\" width=\"1\" height=\"12\" alt=\" \"></td>";
										echo "<td class=\"dateback\" width=\"1\"></td>";
										do {
											$thisday = date("Ymd", $thisdate);
											$thisday3 = localizeDate($dateFormat_week_list, $thisdate);
											echo "<td width=\"70\" colspan=\"" . $nbrGridCols[$thisday] . "\" valign=\"top\" align=\"center\" class=\"dateback\">\n";
											echo "<font class=\"V9\"><a class=\"psf\" href=\"day.php?cal=$cal&amp;getdate=$thisday\">$thisday3</a></font>\n";
											echo "</td>\n";
											$thisdate = ($thisdate + (25 * 60 * 60));
											$i++;
										} while ($i < 7);
										echo "</tr>";
										?>
										<tr>
											<td width="60"><img src="images/spacer.gif" width="60" height="1" alt=" "></td>
											<td width="1"></td>
											<?php
											$thisdate = $start_week_time;
											$i = 0;
											do {
												$thisday = date("Ymd", $thisdate);
												$colWidth = round(70 / $nbrGridCols[$thisday]);
												for ($j=0;$j < $nbrGridCols[$thisday];$j++) {
													echo "<td width=\"" . $colWidth . "\"><img src=\"images/spacer.gif\" width=\"" . $colWidth . "\" height=\"1\" alt=\" \"></td>\n";
												}
												$thisdate = ($thisdate + (25 * 60 * 60));
												$i++;
											} while ($i < 7);
											?>
										</tr>
										<?php
										// The all day events returned here.
										$allday_events_this_week = false;
										$thisdate = $start_week_time;
										for ($i=0;$i<7;$i++) {
											$thisday = date("Ymd", $thisdate);
											if (isset($master_array[($thisday)]["-1"])) {
												$allday_events_this_week = true;
												break;
											}
											$thisdate = ($thisdate + (25 * 60 * 60));
										}
										if ($allday_events_this_week) {
											$thisdate = $start_week_time;
											$i = 0;
											echo "<tr>\n";
											echo "<td class=\"dateback\" colspan=\"2\"></td>";
											do {
												$thisday = date("Ymd", $thisdate);
												echo "<td class=\"dateback\" height=\"20\" colspan=\"" . $nbrGridCols[$thisday] . "\" valign=\"bottom\">\n";
												if (isset($master_array[($thisday)]["-1"])) {
													echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\" class=\"V9\">\n";
												  	foreach($master_array[($thisday)]["-1"] as $allday) {
														echo "<tr>\n";
														$event_calno  = $allday['calnumber'];
														$event_calna  = $allday['calname'];
														$event_url    = $allday['url'];
						 								if ($event_calno < 1) $event_calno=1;
														if ($event_calno > 7) $event_calno=7;
						 								echo '<td valign="top" align="center" class="eventbg_'.$event_calno.'">';
														openevent("$event_calna",
														"",
													  	"",
													  	$allday,
													  	$allday_week_lines,
													  	12,
													  	'<font color="#ffffff">',
													  	"</font>",
													  	"psf",
													  	$event_url);
														echo "</td></tr>\n";
												  	}
												  echo "</table>\n";
												}
												echo "</td>\n";
												$thisdate = ($thisdate + (25 * 60 * 60));
												$i++;
											  } while ($i < 7);
											echo "</tr>\n";
										}											
											$thisdate = $start_week_time;
											for ($i=0;$i<7;$i++) {
												$thisday = date("Ymd", $thisdate);
												$event_length[$thisday] = array ();
												$thisdate = ($thisdate + (25 * 60 * 60));
											}
											foreach ($day_array as $key) {
												$cal_time = $key;	
												ereg('([0-9]{2})([0-9]{2})', $key, $regs_tmp);
												$key = mktime($regs_tmp[1],$regs_tmp[2],0,$this_month,$this_day,$this_year);
												$key = date ($timeFormat, $key);
																					
			
												if (ereg("([0-9]{1,2}):00", $key)) {
													echo "<tr>\n";
													echo "<td rowspan=\"" . (60 / $gridLength) . "\" align=\"center\" valign=\"top\" width=\"60\" class=\"timeborder\">$key</td>\n";
													echo "<td width=\"1\" height=\"" . $gridLength . "\"></td>\n";
												} elseif("$cal_time" == "$day_start") {
													$size_tmp = 60 - (int)substr($cal_time,2,2);
													echo "<tr>\n";
													echo "<td rowspan=\"" . ($size_tmp / $gridLength) . "\" align=\"center\" valign=\"top\" width=\"60\" class=\"timeborder\">$key</td>\n";
													echo "<td width=\"1\" height=\"" . $gridLength . "\"></td>\n";
												} else {
			
													echo "<tr>\n";
													echo "<td width=\"1\" height=\"" . $gridLength . "\"></td>\n";
												}
												
												// initialize $thisdate again
												$thisdate = $start_week_time;
												
												// loop this part 7 times, one for each day
												
												for ($week_loop=0; $week_loop<7; $week_loop++) {
													$thisday = date("Ymd", $thisdate);
													$dayborder = 0;
													unset($this_time_arr);
													if (isset($master_array[$thisday][$cal_time]) && sizeof($master_array[$thisday][$cal_time]) > 0) {
														$this_time_arr = $master_array[$thisday][$cal_time];
													}
														
													if ("$day_start" == "$cal_time" && isset($master_array[$thisday]) && is_array($master_array[$thisday])) {
														foreach($master_array[$thisday] as $time_key => $time_arr) {
															if ((int)$time_key < (int)$cal_time && is_array($time_arr) && $time_key != '-1') {
																foreach($time_arr as $event_tmp) {
																	if ((int)$event_tmp['event_end'] > (int)$cal_time) {
																		$this_time_arr[] = $event_tmp;
																	}
																}
															} else {
																break;
															}
														}
													}
													
													
													// check for eventstart 
													if (isset($this_time_arr) && sizeof($this_time_arr) > 0) {
														foreach ($this_time_arr as $eventKey => $loopevent) {
															$drawEvent = drawEventTimes ($cal_time, $loopevent["event_end"]);
															$j = 0;
															while (isset($event_length[$thisday][$j])) {
																if ($event_length[$thisday][$j]["state"] == "ended") {
																	$event_length[$thisday][$j] = array ("length" => ($drawEvent["draw_length"] / $gridLength), "key" => $eventKey, "overlap" => $loopevent["event_overlap"],"state" => "begin");
																	break;
																}
																$j++;
															}
															if ($j == sizeof($event_length[$thisday])) {
																array_push ($event_length[$thisday], array ("length" => ($drawEvent["draw_length"] / $gridLength), "key" => $eventKey, "overlap" => $loopevent["event_overlap"],"state" => "begin"));
															}
														}
													}
			
													if (sizeof($event_length[$thisday]) == 0) {
														if ($dayborder == 0) {
															$class = " class=\"weekborder\"";
															$dayborder++;
														} else {
															$class = "";
															$dayborder = 0;
														}
														
														echo "<td bgcolor=\"#ffffff\" colspan=\"" . $nbrGridCols[$thisday] . "\" $class>&nbsp;</td>\n";
														
													} else {
														$emptyWidth = $nbrGridCols[$thisday];
														for ($i=0;$i<sizeof($event_length[$thisday]);$i++) {
														
														//echo $this_time_arr[($event_length[$thisday][$i]["key"])]["event_text"] . " ind: " . $i . " / anz: " . $event_length[$thisday][$i]["overlap"] . " = " . eventWidth($i,$event_length[$thisday][$i]["overlap"]) . "<br />";
															$drawWidth = $nbrGridCols[$thisday] / ($event_length[$thisday][$i]["overlap"] + 1);
															$emptyWidth = $emptyWidth - $drawWidth;
															switch ($event_length[$thisday][$i]["state"]) {
																case "begin":
																	$event_length[$thisday][$i]["state"] = "started";
																	$event_start 	= $this_time_arr[($event_length[$thisday][$i]["key"])]["start_unixtime"];
																	$event_start 	= date ($timeFormat, $event_start);
																	$event_calno  = $this_time_arr[($event_length[$thisday][$i]['key'])]['calnumber'];
																	$event_status	= strtolower($this_time_arr[($event_length[$thisday][$i]['key'])]['status']);
												  					if ($event_calno < 1) $event_calno = 1;
												  					if ($event_calno > 7) $event_calno = 7;
																	echo '<td rowspan="' . $event_length[$thisday][$i]['length'] . '" colspan="' . $drawWidth . '" align="left" valign="top" class="eventbg2week_'.$event_calno.'">'."\n";
																	echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
																	echo "<tr>\n";
																	echo "<td class=\"eventborder\"><font class=\"V10WB\"><b>$event_start</b></font></td>\n";
																	if ($event_status != '') {
																		echo '<td class="eventborder" width="9" align="right" valign="center"><font class="eventfont">';
																		echo '<img src="images/'.$event_status.'.gif" width="9" height="9" alt="" border="0" hspace="0" vspace="0">';
																		echo "</font></td>\n";
																	}
																	echo "</tr>\n";
																	echo "<tr>\n";
																	echo "<td colspan=\"2\">\n";
																	echo "<table width=\"100%\" border=\"0\" cellpadding=\"1\" cellspacing=\"0\">\n";
																	echo "<tr>\n";
																	echo '<td class="eventbg_'.$event_calno.'">';
																	$event_end	= $this_time_arr[($event_length[$thisday][$i]["key"])]["end_unixtime"];
																	 if (isset($this_time_arr[($event_length[$thisday][$i]["key"])]['display_end'])) $event_end = strtotime ($this_time_arr[($event_length[$thisday][$i]["key"])]['display_end']);
																	$event_end 	= date ($timeFormat, $event_end);

																	$event_calna 	= $this_time_arr[($event_length[$thisday][$i]["key"])]['calname'];
																	$event_url 		= $this_time_arr[($event_length[$thisday][$i]["key"])]['url'];
																	openevent("$event_calna",
																		  "$event_start",
																		  "$event_end",
																		  $this_time_arr[($event_length[$thisday][$i]["key"])],
																		  $week_events_lines,
																		  25,
																		  "<font class=\"V10W\">",
																		  "</font>",
																		  "psf",
																		  $event_url);
																	echo "</td></tr>\n";
																	echo "</table>\n";
																	echo "</td>\n";           
																	echo "</tr>\n";
																	echo "</table>\n";
																	echo "</td>\n";
																	break;
																case "started":
																	break;
																case "ended":
																	echo "<td bgcolor=\"#ffffff\" colspan=\"" . $drawWidth . "\" $class>&nbsp;</td>\n";
																	break;
															}
															$event_length[$thisday][$i]["length"]--;
															if ($event_length[$thisday][$i]["length"] == 0) {
																$event_length[$thisday][$i]["state"] = "ended";
															}
														}
														//fill emtpy space on the right
														if ($emptyWidth > 0) {
															echo "<td bgcolor=\"#ffffff\" colspan=\"" . $emptyWidth . "\" $class>&nbsp;</td>\n";
														}
														while (isset($event_length[$thisday][(sizeof($event_length[$thisday]) - 1)]["state"]) && $event_length[$thisday][(sizeof($event_length[$thisday]) - 1)]["state"] == "ended") {
															array_pop($event_length[$thisday]);
														}
													}
													$thisdate = ($thisdate + (25 * 60 * 60));
												}
												echo "</tr>\n";
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
		<td width="10"><img src="images/spacer.gif" width="10" height="1" alt=" "></td>
		<td width="170" valign="top">
			<?php include (BASE.'includes/sidebar.php'); ?>
		</td>
	</tr>
</table>
</center>
<?php include (BASE.'includes/footer.inc.php'); ?>

