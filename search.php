<?php

include('./functions/ical_parser.php');

$search_string = 'final';
$search_arr = explode(' ', $search_string);

function array_in($string,$arr) {
	foreach($arr as $s) {
		if (eregi($s,$string) == false) {
			return false;
		}
	}
	return true;
}
function search($find_arr) {
	global $master_array;
	if (isset($master_array) && is_array($master_array)) {
		foreach($master_array as $date_key => $date) {
			if (is_array($date)) {
				foreach($date as $time_key => $time) {
					if (is_array($time)) {
						foreach ($time as $event_key => $event) {
							if (is_array($event)) {
								if (array_in($event['description'],$find_arr) || array_in($event['event_text'],$find_arr)) {
									$tmp_arr = $event;
									$tmp_arr['date'] = $date_key;
									$retarr[] = $tmp_arr;
								}
							}
						}
					}
				}
			}
		}
	}
	return $retarr;
}

$the_arr = search($search_arr);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<title><?php echo "$calendar_name - $display_month"; ?></title>
	<link rel="stylesheet" type="text/css" href="styles/<?php echo "$style_sheet/default.css"; ?>">
	<?php include "functions/event.js"; ?>
</head>
<body>
<center>
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
		<td colspan="3">
				<table border="0" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td align="center" valign="top">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td align="left" valign="top" width="160" class="montheventtop"><?php echo "<img src=\"images/spacer.gif\" alt=\"right\" width=\"16\" height=\"20\" border=\"0\" align=\"left\"></a>"; ?></td>
									<td align="center" class="montheventtop" width="417" nowrap><font class="G10BOLD"><?php echo "Search Results"; ?></font></td>
									<td align="right" valign="top" width="160" class="montheventtop"><?php echo "<img src=\"images/spacer.gif\" alt=\"right\" width=\"16\" height=\"20\" border=\"0\" align=\"right\"></a>"; ?></td>
								</tr>
								<tr>
									<td colspan="3" height="1"></td>
								</tr>
								<?php	
									// Iterate the search results
									if (is_array($the_arr)) {
										foreach($the_arr as $val) {
											$dayofmonth = strtotime ($val['date']);
											$dayofmonth = localizeDate ($dateFormat_week_list, $dayofmonth);
											$i = 0;
											if ($getdate == $val['date']) {
												$fontclass="class=\"G10BOLD\"";
											} else {
												$fontclass="class=\"G10B\"";
											}
											if ($val["event_text"]) {	
												$event_text 	= stripslashes(urldecode($val["event_text"]));
												$event_text2 	= addslashes($val["event_text"]);
												$event_text2 	= str_replace("\"", "&quot;", $event_text2);
												$event_text2 	= urlencode($event_text2);
												$description 	= addslashes($val["description"]);
												$description 	= str_replace("\"", "&quot;", $description);
												$event_start 	= $val["event_start"];
												$event_end 		= $val["event_end"];
												$event_start 	= date ($timeFormat, strtotime ("$event_start"));
												$event_end 		= date ($timeFormat, strtotime ("$event_end"));
												$event_text 	= str_replace ("<br>", "", $event_text);
												$event_start2	= $event_start;
												if (strlen($event_text) > 70) {
													$event_text = substr("$event_text", 0, 65);
													$event_text = $event_text . "...";
												}
												if (!$val["event_start"]) { 
													$event_start = "$all_day_lang";
													$event_start2 = '';
													$event_end = '';
												}
												echo "<tr>\n";
												echo "<td width =\"160\" class=\"montheventline\" nowrap><font $fontclass>&nbsp;<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$key\">$dayofmonth</a></font> <font class=\"V9G\">($event_start)</font></td>\n";
												echo "<td colspan=\"2\">\n";
												echo "&nbsp;<a class=\"psf\" href=\"javascript:openEventInfo('$event_text2', '$calendar_name', '$event_start2', '$event_end', '$description')\"><font class=\"G10B\">$event_text</font></a>\n";
												echo "</td>\n";
												echo "</tr>\n";
											}
										}
									} else {
										echo "<tr>\n";
										echo "<td colspan=\"3\" align=\"center\">No results found</td>\n";
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

<br>
<?php echo '<font class="V9"><br>'.$powered_by_lang.' <a class="psf" href="http://phpicalendar.sourceforge.net/">PHP iCalendar '.$version_lang.'</a></font>'; ?>
</center>
</body>
</html>
