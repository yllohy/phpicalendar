<?php

include('./functions/ical_parser.php');

// takes a boolean search and a string. Returns an array with
// [0] = True/False and [1] = formatted search string
function search_boolean($needle,$haystack) {
	// init arrays
	$and_arr = array();
	$or_arr = array();
	$not_arr = array();
	$or_str_arr = array();

	// compare lowercase versions of the strings
	$haystack = strtolower($haystack);
	$needle = strtolower($needle);
	
	// clean up search string
	$needle = str_replace(' and ', ' ', $needle);
	$needle = ereg_replace('[[:space:]]+',' ', $needle);
	
	// start out with an AND array of all the items
	$and_arr = explode(' ', $needle);
	$count = count($and_arr);
	$j = 0;
	
	// build an OR array from the items in AND
	for($i=0;$i<$count;$i++) {
		if ($i != 0 && $and_arr[$i] == 'or') {
			while ($and_arr[$i] == 'or') {
				$or_arr[$j][] = $and_arr[$i-1];
				unset($and_arr[$i], $and_arr[$i-1]);
				$i += 2;
			}
			if (isset($and_arr[$i-1])) {
				$or_arr[$j][] = $and_arr[$i-1];
				unset($and_arr[$i-1]);
			}
			$or_str_arr[$j] = implode('</b> OR <b>', $or_arr[$j]);
			$j++;
		}
	}

	// build a NOT array from the items in AND
	foreach($and_arr as $key => $val) {
		if (substr($val,0,1) == '-') {
			$not_arr[] = substr($val,1);
			unset($and_arr[$key]);
		} elseif(substr($val,0,1) == '+') {
			$and_arr[] = substr($val,1);
			unset($and_arr[$key]);
		}
	}
	
	// prepare our formatted search string
	if (count($and_arr) > 1) {
		$final_str_arr[] = implode('</b> AND <b>', $and_arr);
	} elseif (isset($and_arr[0]) && $and_arr[0] != '') {
		$final_str_arr[] = $and_arr[0];
	}
	
	if (count($or_str_arr) > 1) {
		$final_str_arr[] = implode('</b> AND <b>', $or_str_arr);
	} elseif (isset($or_str_arr[0]) && $or_str_arr[0] != '') {
		$final_str_arr[] = $or_str_arr[0];
	}
	
	if (count($not_arr) > 1) {
		$final_str_arr[] = '-'.implode('</b> AND <b>-', $not_arr);
	} elseif (isset($not_arr[0]) && $not_arr[0] != '') {
		$final_str_arr[] = '-'.$not_arr[0];
	}
	
	if (count($final_str_arr) > 1) {
		$formatted_search = '<b>'.implode('</b> AND <b>', $final_str_arr).'</b>';
	} else {
		$formatted_search = '<b>'.$final_str_arr[0].'</b>';
	}
		
	// check against the NOT
	foreach($not_arr as $s) {
		if (ereg($s, $haystack) == true) {
			return array(false,$formatted_search);
		}
	}
	
	// check against the AND
	foreach($and_arr as $s) {
		if (ereg($s,$haystack) == false) {
			return array(false,$formatted_search);
		}
	}
	
	// check against the OR
	foreach($or_arr as $or) {
		$is_false = true;
		foreach($or as $s) {
			if (ereg($s,$haystack) == true) {
				$is_false = false;
				break;
			}
		}
		if ($is_false) return array(false,$formatted_search);	
	}
	
	// if we haven't returned false, then we return true
	return array(true,$formatted_search);
}

$search_string = 'final japan';

if (isset($master_array) && is_array($master_array)) {
	foreach($master_array as $date_key_tmp => $date_tmp) {
		if (is_array($date_tmp)) {
			foreach($date_tmp as $time_tmp) {
				if (is_array($time_tmp)) {
					foreach ($time_tmp as $event_tmp) {
						if (is_array($event_tmp)) {
							$results1 = search_boolean($search_string,$event_tmp['event_text']);
							$formatted_search = $results1[1];
							if (!$results1[0]) {
								$results2 = search_boolean($search_string,$event_tmp['description']);
							}
							if ($results1[0] || $results2[0]) {
								$event_tmp['date'] = $date_key_tmp;
								$the_arr[] = $event_tmp;
							}
						}
					}
				}
			}
		}
	}
}
	
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
		<td align="center" class="sideback"><font class="G10BOLD"><?php print "Search Results" ?></font></td>
		<td align="right" valign="top" width="1%"  class="sideback"><?php echo "<a class=\"psf\" href=\"month.php?cal=$cal&getdate=$next_day\"><img src=\"styles/$style_sheet/right_arrows.gif\" alt=\"right\" border=\"0\" align=\"right\"></a>"; ?></td>
	</tr>
	<tr>
		<td colspan="3">
				<table border="0" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td align="center" valign="top">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td align="left" valign="top" width="160" class="montheventtop"><?php echo "<img src=\"images/spacer.gif\" alt=\"right\" width=\"16\" height=\"20\" border=\"0\" align=\"left\"></a>"; ?></td>
									<td align="center" class="montheventtop" width="417" nowrap><font class="G10B"><?php echo 'Search: '.$formatted_search; ?></font></td>
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
