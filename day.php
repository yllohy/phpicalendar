<?php 

$current_view = "day";
include("./ical_parser.php");

$starttime = "0700";
$weekstart = 1;
$gridLength = 30;

if ($getdate == (date("Ymd"))) {
	$display_date = strftime ($dateFormat_day);
	$tomorrows_date = date( "Ymd", (time() + (24 * 3600)));
	$yesterdays_date = date( "Ymd", (time() - (24 * 3600)));
} else {
	ereg ("([0-9]{4})([0-9]{2})([0-9]{2})", $getdate, $day_array2);
	$this_day = $day_array2[3];
	$this_month = $day_array2[2];
	$this_year = $day_array2[1];
	$unix_time = mktime(0,0,0,"$this_month","$this_day","$this_year");
	$display_date = strftime($dateFormat_day, $unix_time);
	$tomorrow = $unix_time + (24 * 3600);
	$yesterday = $unix_time - (24 * 3600);
	$tomorrows_date = date( "Ymd", ($tomorrow));
	$yesterdays_date = date( "Ymd", ($yesterday));
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<title><? echo "$calendar_name"; ?></title>
  	<link rel="stylesheet" type="text/css" href="styles/<? echo "$style_sheet"; ?>">
	<? include "functions/event.js"; ?>
</head>
<body bgcolor="#FFFFFF">
<center>

<table width="700" border="0" cellspacing="0" cellpadding="0" class="V12">
	<tr>
		<td align="left" width="5%"><!--[[a class="psf" href="day.php"]]Today[[/a]]--></td>
		<td align="center" width="90%"><? echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$getdate\">$day_lang</a> | <a class=\"psf\" href=\"week.php?cal=$cal&getdate=$getdate\">$week_lang</a> | <a class=\"psf\" href=\"month.php?cal=$cal&getdate=$getdate\">$month_lang</a>"; ?></td>
		<td align="right" width="5%"><!--[[a class="psf" href="preferences.php"]]Preferences[[/a]]--></td>
	</tr>
	<tr>
		<td colspan="3"><img src="images/spacer.gif" height="10" width="1" alt=""></td>
	</tr>
</table>

<table width="700" border="0" cellspacing="1" cellpadding="2" class="calborder">
<tr>
<td>

<table width="700" border="0" cellspacing="0" cellpadding="0">
    <tr>
     	<td align="center" valign="middle">
      		<table width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#a1a5a9" class="G10B">
      			<tr>
      				<td bgcolor="#ffffff">
      					<table width="100%" border="0" cellspacing="1" cellpadding="2">
							<tr>
								<td colspan="2">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td class="G10B" align="left" valign="top" width="100"><? echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$yesterdays_date\">$last_day_lang</a>"; ?></td>
											<td class="H20" align="center" valign="middle" width="500"><? echo "$display_date"; ?></td>
											<td class="G10B" align="right" valign="top" width="100"><? echo "<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$tomorrows_date\">$next_day_lang</a>"; ?></td>
										</tr>
									</table>
								</td>
							</tr>
							<tr>
								<td align="left" valign="middle" class="G10B" width="50%"><? include('./list_icals.php'); ?></td>
								<td align="right" valign="middle" class="G10B" width="50%"><? echo "<a class=\"psf\" href=\"$fullpath\">$subscribe_lang</a>&nbsp;|&nbsp;<a class=\"psf\" href=\"$filename\">$download_lang</a>"; ?></td>
							</tr>
						</table>
      				</td>
      			</tr>
      			<tr>
					<td align="center" valign="top">
						<table width="100%" border="0" cellspacing="1" cellpadding="0">
							<?php
							// The all day events returned here.
							$i = 0;
//							if ($master_array[($getdate)]["0001"]["event_text"] != "") {
// drei 20020921: changed format of allday array
							if (sizeof($master_array[($getdate)]["-1"]) > 0) {
								echo "<tr height=\"30\">\n";
								echo "<td colspan=\"15\" height=\"30\" valign=\"middle\" align=\"center\" class=\"eventbg\">\n";
								echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"4\">\n";										  
//								foreach($master_array[($getdate)]["0001"]["event_text"] as $all_day_text) {
// drei 20020921: changed format of allday array
								foreach($master_array[($getdate)]["-1"] as $all_day) {
									$event_text2 = addslashes($all_day["event_text"]); 
									if ($i > 0) {
										echo "<tr>\n";
										echo "<td bgcolor=\"#eeeeee\" height=\"1\"></td>\n";
										echo "</tr>\n";
									}
									echo "<tr>\n";
									echo "<td valign=\"top\" align=\"center\"><a class=\"psf\" href=\"javascript:openEventInfo('$event_text2', '$calendar_name', '$event_start', '$event_end')\"><font class=\"eventfont\"><i>" . $all_day["event_text"] . "</i></font></a></td>\n";
									echo "</tr>\n";
									$i++;
								}
								echo "</table>\n";
								echo "</td>\n";
								echo "</tr>\n";
							}
							?>

							<tr>
								<td nowrap bgcolor="#a1a5a9" width="60"></td>
								<td nowrap bgcolor="#a1a5a9" width="1"></td>
								<?php for ($m=0;$m < 12;$m++) { ?>
									<td nowrap bgcolor="#a1a5a9"><img src="images/spacer.gif" width="55" height="1" alt=""></td>
								<?php } ?>
							</tr>
							<?php
								// $master_array[($getdate)]["$day_time"]
								$event_length = array ();
								
								foreach ($day_array as $key) {
//									$k = 0;
									$cal_time = $key;	
									$key = strtotime ("$key");
//									if ($time_format == "24") {
//										$key = date ("G:i", $key);
//									} else {
//										$key = date ("g:i A", $key);
//									}
									$key = date ($timeFormat, $key);
																		
									// check for eventstart (line 117)
									if (sizeof($master_array[($getdate)]["$cal_time"]) > 0) {
										foreach ($master_array[($getdate)]["$cal_time"] as $eventKey => $loopevent) {
											$j = 0;
											while ($event_length[$j]) {
												if ($event_length[$j]["state"] == "ended") {
													$event_length[$j] = array ("length" => (round($loopevent["event_length"] / $gridLength)), "key" => $eventKey, "overlap" => $loopevent["event_overlap"],"state" => "begin");
													break;
												}
												$j++;
											}
											if ($j == sizeof($event_length)) {
												array_push ($event_length, array ("length" => (round($loopevent["event_length"] / $gridLength)), "key" => $eventKey, "overlap" => $loopevent["event_overlap"],"state" => "begin"));
											}
										}
									}
									if (ereg("([0-9]{1,2}):00", $key)) {
										echo "<tr height=\"30\">\n";
										echo "<td rowspan=\"2\" align=\"center\" valign=\"top\" bgcolor=\"#f5f5f5\" width=\"60\">$key</td>\n";
										echo "<td  align=\"center\" valign=\"top\" nowrap bgcolor=\"#a1a5a9\" width=\"1\" height=\"30\"></td>\n";
									} else {
										echo "<tr height=\"30\">\n";
										echo "<td  align=\"center\" valign=\"top\" nowrap bgcolor=\"#a1a5a9\" width=\"1\" height=\"30\"></td>\n";
									}
									if (sizeof($event_length) == 0) {
										echo "<td bgcolor=\"#ffffff\" colspan=\"12\">&nbsp;</td>\n";
									} else {
										$emptyWidth = 12;
										for ($i=0;$i<sizeof($event_length);$i++) {
								//echo $master_array[($getdate)]["$cal_time"][($event_length[$i]["key"])]["event_text"] . " ind: " . $i . " / anz: " . $event_length[$i]["overlap"] . " = " . eventWidth($i,$event_length[$i]["overlap"]) . "<br />";
											$drawWidth = eventWidth($i,$event_length[$i]["overlap"]);
											$emptyWidth = $emptyWidth - $drawWidth;
											switch ($event_length[$i]["state"]) {
												case "begin":
													$event_length[$i]["state"] = "started";
													$event_text = $master_array[($getdate)]["$cal_time"][($event_length[$i]["key"])]["event_text"];
													$event_text2 = addslashes($master_array[($getdate)]["$cal_time"][($event_length[$i]["key"])]["event_text"]);
													$event_start = $master_array[($getdate)]["$cal_time"][($event_length[$i]["key"])]["event_start"];
													$event_end = $master_array[($getdate)]["$cal_time"][($event_length[$i]["key"])]["event_end"];
													$event_start = strtotime ("$event_start");
													$event_start = date ($timeFormat, $event_start);
													$event_end = strtotime ("$event_end");
													$event_end = date ($timeFormat, $event_end);
													echo "<td rowspan=\"" . $event_length[$i]["length"] . "\" colspan=\"" . $drawWidth . "\" align=\"left\" valign=\"top\" class=\"eventbg\">\n";
													echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">\n";
													echo "<tr>\n";
													echo "<td class=\"eventborder\"><font class=\"eventfont\"><b>$event_start</b> - $event_end</font></td>\n";
													echo "</tr>\n";
													echo "<tr>\n";
													echo "<td>\n";
													echo "<table width=\"100%\" border=\"0\" cellpadding=\"1\" cellspacing=\"0\">\n";
													echo "<tr>\n";
													echo "<td class=\"eventbg\"><a class=\"psf\" href=\"javascript:openEventInfo('$event_text2', '$calendar_name', '$event_start', '$event_end')\"><font class=\"eventfont\">$event_text</font></a></td>\n";
													echo "</tr>\n";
													echo "</table>\n";
													echo "</td>\n";           
													echo "</tr>\n";
													echo "</table>\n";
													echo "</td>\n";
													break;
												case "started":
													break;
												case "ended":
													echo "<td bgcolor=\"#ffffff\" colspan=\"" . $drawWidth . "\">&nbsp;</td>\n";
													break;
											}
											$event_length[$i]["length"]--;
											if ($event_length[$i]["length"] == 0) {
												$event_length[$i]["state"] = "ended";
											}
										}
										//fill emtpy space on the right
										if ($emptyWidth > 0) {
											echo "<td bgcolor=\"#ffffff\" colspan=\"" . $emptyWidth . "\">&nbsp;</td>\n";
										}
										while ($event_length[(sizeof($event_length) - 1)]["state"] == "ended") {
											array_pop($event_length);
										}
										
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
</tr>
</table>
<br>
<? echo "<font class=\"V9\">$powered_by_lang <a class=\"psf\" href=\"http://sourceforge.net/projects/phpicalendar/\">PHP iCalendar $version_lang</a></font>"; ?>
</center>
</body>
</html>

