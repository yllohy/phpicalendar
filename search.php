<?php

define('BASE','./');
$current_view = 'search';
include('./functions/ical_parser.php');

// yet to be implemented
switch($HTTP_GET_VARS['mode']) {
	case 'advanced_search':
		// display advanced search stuff
		break;
	case 'search':
		// display simple search stuff
		break;
	case 'results':
		// display results of either simple or advanced search
		break;
	default:
		// some generic thing, maybe same as search
}

// takes a boolean search and formats it into an array
// use with sister function search_boolean()
function format_search($search_str) {
	// init arrays
	$and_arr = array();
	$or_arr = array();
	$not_arr = array();
	$or_str_arr = array();

	$search_str = strtolower($search_str);
	
	// clean up search string
	$search_str = trim($search_str);
	$search_str = str_replace(' and ', ' ', $search_str);
	$search_str = ereg_replace('[[:space:]]+',' ', $search_str);
	$search_str = str_replace(' not ', ' -', $search_str);
	
	// start out with an AND array of all the items
	$and_arr = explode(' ', $search_str);
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
	
	return array($formatted_search, $and_arr, $or_arr, $not_arr);
}

// takes an array made by format_search() and checks to see if it 
// it matches against a string
function search_boolean($needle_arr, $haystack) {
	// init arrays
	$and_arr = $needle_arr[1];
	$or_arr = $needle_arr[2];
	$not_arr = $needle_arr[3];
	
	// compare lowercase versions of the strings
	$haystack = strtolower($haystack);

	// check against the NOT
	foreach($not_arr as $s) {
		if (ereg($s, $haystack) == true) {
			return false;
		}
	}
	
	// check against the AND
	foreach($and_arr as $s) {
		if (ereg($s,$haystack) == false) {
			return false;
		}
	}
	
	// check against the OR
	foreach($or_arr as $or) {
		$is_false = true;
		foreach($or as $s) {
			if (substr($s,0,1) == '-') {
				if (ereg(substr($s,1),$haystack) == false) {
					$is_false = false;
					break;
				}			
			} elseif (ereg($s,$haystack) == true) {
				$is_false = false;
				break;
			}
		}
		if ($is_false) return false;	
	}
	
	// if we haven't returned false, then we return true
	return true;
}

$search_string = 'final';

$format_search_arr = format_search($search_string);
$formatted_search = $format_search_arr[0];

if (isset($master_array) && is_array($master_array)) {
	foreach($master_array as $date_key_tmp => $date_tmp) {
		if (is_array($date_tmp)) {
			foreach($date_tmp as $time_tmp) {
				if (is_array($time_tmp)) {
					foreach ($time_tmp as $event_tmp) {
						if (is_array($event_tmp)) {
							$results1 = search_boolean($format_search_arr,$event_tmp['event_text']);
							if (!$results1) {
								$results2 = search_boolean($format_search_arr,$event_tmp['description']);
							}
							if ($results1 || $results2) {
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
	<title><?php echo "$calendar_name - Search Results"; ?></title>
	<link rel="stylesheet" type="text/css" href="styles/<?php echo "$style_sheet/default.css"; ?>">
	<?php include "functions/event.js"; ?>
</head>
<body>
<center>
<table border="0" width="520" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="calborder">
	<tr>
		<td align="left" valign="top" width="1"  class="sideback"><?php echo "<img src=\"images/spacer.gif\" alt=\"right\" width=\"1\" height=\"20\" border=\"0\" align=\"left\">"; ?></td>
		<td align="center" class="sideback"><font class="G10BOLD"><?php print "Search Results" ?></font></td>
		<td align="right" valign="top" width="1"  class="sideback"><?php echo "<img src=\"images/spacer.gif\" alt=\"right\" width=\"1\" height=\"20\" border=\"0\" align=\"right\">"; ?></td>
	</tr>
	<tr>
		<td colspan="3">
				<table border="0" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td align="center" valign="top">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td align="left" valign="top" width="1" height="20" class="montheventtop"><?php echo "<img src=\"images/spacer.gif\" alt=\"right\" width=\"1\" height=\"20\" border=\"0\" align=\"left\">"; ?></td>
									<td align="center" class="montheventtop" height="20" width="320" nowrap><font class="G10B"><?php echo 'Search: '.$formatted_search; ?></font></td>
									<td align="right" valign="top" width="1" height="20" class="montheventtop"><?php echo "<img src=\"images/spacer.gif\" alt=\"right\" width=\"1\" height=\"20\" border=\"0\" align=\"right\">"; ?></td>
								</tr>
								<tr>
									<td colspan="3" height="1"></td>
								</tr>
								<?php	
									// Iterate the search results
									if (is_array($the_arr)) {
												echo "<tr>\n";
												echo "<td colspan=\"3\"><table width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">\n";
										foreach($the_arr as $val) {
											$thedate = $val['date'];
											$dayofmonth = strtotime ($thedate);
											$dayofmonth = localizeDate ($dateFormat_week_list, $dayofmonth);
											$i = 0;
											if ($getdate == $thedate) {
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
												echo "<tr><td width=\"30%\" class=\"montheventline\" nowrap align=\"left\" valign=\"top\"><font $fontclass>&nbsp;<a class=\"psf\" href=\"day.php?cal=$cal&getdate=$thedate\">$dayofmonth</a></font> <font class=\"V9G\">($event_start)</font></td>\n";
												echo "<td width=\"30%\" class=\"montheventline\" nowrap align=\"left\" valign=\"top\">\n";
												echo "&nbsp;<a class=\"psf\" href=\"javascript:openEventInfo('$event_text2', '$calendar_name', '$event_start2', '$event_end', '$description')\"><font class=\"G10B\">$event_text</font></a>\n";
												echo "</td>\n";
												echo "<td align=\"left\" valign=\"top\" nowrap>\n";
												echo '<font class="G10B">'.htmlspecialchars(urldecode($val["description"])).'</font>';
												echo "</td></tr>\n";
											}
										}
												echo "</table></td>\n";
												echo "</tr>\n";

									} else {
										echo "<tr>\n";
										echo "<td colspan=\"3\" align=\"center\"><font class=\"G10B\">No results found</font></td>\n";
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
<?php include (BASE.'footer.inc.php'); ?>
</center>
</body>
</html>
