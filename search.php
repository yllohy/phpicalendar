<?php

define('BASE','./');
$current_view = 'search';
include('./functions/ical_parser.php');

if (isset($HTTP_SERVER_VARS['HTTP_REFERER']) && $HTTP_SERVER_VARS['HTTP_REFERER'] != '') {
	$back_page = $HTTP_SERVER_VARS['HTTP_REFERER'];
} else {
	$back_page = BASE.$default_view.'.php?cal='.$cal.'&getdate='.$getdate;
}

$search_valid = false;
if (isset($HTTP_GET_VARS['query']) && $HTTP_GET_VARS['query'] != '') {
	$query = $HTTP_GET_VARS['query'];
	$search_valid = true;
}

$search_box = '';
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

$search_box .= 
	'<form action="search.php" method="GET">'."\n".
	'<input type="hidden" name="cal" value="'.$cal.'">'."\n".
	'<input type="hidden" name="getdate" value="'.$getdate.'">'."\n".
	'<input type="text" size="15" name="query" value="'.$query.'">'."\n".
	'<INPUT type="image" src="styles/'.$style_sheet.'/search.gif" border=0 height="19" width="18" name="submit" value="Search">'."\n".
	'</form>';

$search_started = getmicrotime();
if ($search_valid) {
	$format_search_arr = format_search($query);
	$formatted_search = $format_search_arr[0];
	if (isset($master_array) && is_array($master_array)) {
		foreach($master_array as $date_key_tmp => $date_tmp) {
			if (is_array($date_tmp)) {
				foreach($date_tmp as $time_tmp) {
					if (is_array($time_tmp)) {
						foreach ($time_tmp as $uid_tmp => $event_tmp) {
							if (is_array($event_tmp)) {
								if (!isset($the_arr[$uid_tmp]) || isset($event_tmp['exception'])) {
									$results1 = search_boolean($format_search_arr,$event_tmp['event_text']);
									if (!$results1) {
										$results2 = search_boolean($format_search_arr,$event_tmp['description']);
									}
									if ($results1 || $results2) {
										$event_tmp['date'] = $date_key_tmp;
										if (isset($event_tmp['recur'])) {
											$event_tmp['recur'] = format_recur($event_tmp['recur']);
										}
										if (isset($the_arr[$uid_tmp])) {
											$the_arr[$uid_tmp]['exceptions'][] = $event_tmp;
										} else {
											$the_arr[$uid_tmp] = $event_tmp;
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
} else {
	$formatted_search = '<b>No query given</b>';
}
$search_ended = getmicrotime();

$search_took = number_format(($search_ended-$search_started),3);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<title><?php echo "$calendar_name - $results_lang"; ?></title>
  	<link rel="stylesheet" type="text/css" href="styles/<?php echo $style_sheet.'/default.css'; ?>">
</head>
<body bgcolor="#FFFFFF">
<center>
<table border="0" width="700" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="calborder">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
      			<tr>
      				<td align="left" width="90" class="navback"><?php echo '<a href="'.$back_page.'"><img src="styles/'.$style_sheet.'/back.gif" alt="" border="0" align="left"></a>'; ?></td>
      				<td class="navback">
      					<table width="100%" border="0" cellspacing="0" cellpadding="0">
      						<tr>
								<td align="center" class="navback" nowrap valign="middle"><font class="H20"><?php echo $results_lang; ?></font></td>
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
	<tr>
		<td colspan="3"  class="dayborder"><img src="images/spacer.gif" width="1" height="5"></td>
	</tr>
	<tr>
		<td colspan="3">
				<table border="0" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td align="center" valign="top">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td colspan="3" height="1"></td>
								</tr>							
								<tr>
									<td colspan="3" class="G10B" align="center"><?php echo $query_lang.$formatted_search; ?></td>
								</tr>
								<tr>
									<td colspan="3" class="G10B">&nbsp;</td>
								</tr>								
								<?php	
									if (isset($the_arr) && is_array($the_arr)) {
										foreach($the_arr as $val) {
											$key = $val['date'];
											$dayofmonth = strtotime ($key);
											$dayofmonth = localizeDate ($dateFormat_day, $dayofmonth);
											echo "<tr><td width=\"10\"><img src=\"images/spacer.gif\" width=\"10\" height=\"1\"></td>\n";
											echo "<td align=\"left\" colspan=\"2\"><font class=\"V12\"><b><a class=\"ps3\" href=\"day.php?cal=$cal&getdate=$key\">$dayofmonth</a></b></font></td></tr>";
											echo "<tr><td colspan=\"3\"><img src=\"images/spacer.gif\" width=\"1\" height=\"5\"></td></tr>\n";
											
											if ($val["event_text"]) {	
												$event_text 	= stripslashes(urldecode($val["event_text"]));
												$description 	= stripslashes(urldecode($val["description"]));
												$event_start 	= $val["event_start"];
												$event_end 		= $val["event_end"];
												$event_start 	= date ($timeFormat, strtotime ("$event_start"));
												$event_end 		= date ($timeFormat, strtotime ("$event_end"));
												$event_start 	= "$event_start - $event_end";
												if (!$val["event_start"]) { 
													$event_start = "$all_day_lang";
													$event_start2 = '';
													$event_end = '';
												}
												echo "<tr>\n";
												echo "<td width=\"10\"><img src=\"images/spacer.gif\" width=\"10\" height=\"1\"></td>\n";
												echo "<td width=\"10\"><img src=\"images/spacer.gif\" width=\"10\" height=\"1\"></td>\n";
												echo "<td align=\"left\">\n";
												echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\n";
												echo "<tr>\n";
												echo "<td width=\"100\" class=\"G10BOLD\">$time_lang:</td>\n";
												echo "<td align=\"left\" class=\"G10B\">$event_start</td>\n";
												echo "</tr>\n";
												echo "<tr>\n";
												echo "<td valign=\"top\" width=\"100\" class=\"G10BOLD\">$summary_lang:</td>\n";
												echo "<td valign=\"top\" align=\"left\" class=\"G10B\">$event_text</td>\n";
												echo "</tr>\n";
												if (isset($val['recur'])) {
													$recur = $val['recur'];
													echo "<tr>\n";
													echo "<td valign=\"top\" width=\"100\" class=\"G10BOLD\">Recurring event:</td>\n";
													echo "<td valign=\"top\" align=\"left\" class=\"G10B\">$recur</td>\n";
													echo "</tr>\n";
												}
												if ($val["description"]) {
													echo "<tr>\n";
													echo "<td valign=\"top\" width=\"100\" class=\"G10BOLD\">$description_lang:</td>\n";
													echo "<td valign=\"top\" align=\"left\" class=\"G10B\">$description</td>\n";
													echo "</tr>\n";
												}
												echo "</table>\n";
												echo "</td>\n";
												echo "</tr>\n";			
												echo "<tr><td colspan=\"3\"><img src=\"images/spacer.gif\" width=\"1\" height=\"10\"></td></tr>\n";
												if (isset($val['exceptions'])) {
													foreach($val['exceptions'] as $val2) {
														$key = $val2['date'];
														$dayofmonth = strtotime ($key);
														$dayofmonth = localizeDate ($dateFormat_day, $dayofmonth);
														echo "<tr><td width=\"10\"><img src=\"images/spacer.gif\" width=\"10\" height=\"1\"></td>\n";
														echo "<td align=\"left\" colspan=\"2\"><font class=\"V10\"><i>Exception:</i> <a class=\"ps3\" href=\"day.php?cal=$cal&getdate=$key\">$dayofmonth</a></font></td></tr>";
														echo "<tr><td colspan=\"3\"><img src=\"images/spacer.gif\" width=\"1\" height=\"5\"></td></tr>\n";
														
														if ($val2["event_text"]) {	
															$event_text 	= stripslashes(urldecode($val2["event_text"]));
															$description 	= stripslashes(urldecode($val2["description"]));
															$event_start 	= $val2["event_start"];
															$event_end 		= $val2["event_end"];
															$event_start 	= date ($timeFormat, strtotime ("$event_start"));
															$event_end 		= date ($timeFormat, strtotime ("$event_end"));
															$event_start 	= "$event_start - $event_end";
															if (!$val2["event_start"]) { 
																$event_start = "$all_day_lang";
																$event_start2 = '';
																$event_end = '';
															}
															echo "<tr>\n";
															echo "<td width=\"10\"><img src=\"images/spacer.gif\" width=\"10\" height=\"1\"></td>\n";
															echo "<td width=\"10\"><img src=\"images/spacer.gif\" width=\"10\" height=\"1\"></td>\n";
															echo "<td align=\"left\">\n";
															echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\n";
															echo "<tr>\n";
															echo "<td width=\"100\" class=\"G10BOLD\">$time_lang:</td>\n";
															echo "<td align=\"left\" class=\"G10B\">$event_start</td>\n";
															echo "</tr>\n";
															echo "<tr>\n";
															echo "<td valign=\"top\" width=\"100\" class=\"G10BOLD\">$summary_lang:</td>\n";
															echo "<td valign=\"top\" align=\"left\" class=\"G10B\">$event_text</td>\n";
															echo "</tr>\n";
															if (isset($val2['recur'])) {
																$recur = $val2['recur'];
																echo "<tr>\n";
																echo "<td valign=\"top\" width=\"100\" class=\"G10BOLD\">Recurring event:</td>\n";
																echo "<td valign=\"top\" align=\"left\" class=\"G10B\">$recur</td>\n";
																echo "</tr>\n";
															}
															if ($val2["description"]) {
																echo "<tr>\n";
																echo "<td valign=\"top\" width=\"100\" class=\"G10BOLD\">$description_lang:</td>\n";
																echo "<td valign=\"top\" align=\"left\" class=\"G10B\">$description</td>\n";
																echo "</tr>\n";
															}
															echo "</table>\n";
															echo "</td>\n";
															echo "</tr>\n";			
															echo "<tr><td colspan=\"3\"><img src=\"images/spacer.gif\" width=\"1\" height=\"10\"></td></tr>\n";
														}
													}
												}
											}
										}
									} else {
										echo '<tr><td colspan="3" class="G10B" align="center">';
										echo $no_results_lang;
										echo '</td></tr><tr><td class="G10B">&nbsp;</td></tr>';
									}
										
									
								
								?>
								<tr>
									<td colspan="3" class="G10B" align="center"><?php echo $search_box; ?></td>
								</tr>	
								<tr>
									<td colspan="3" class="G10B" align="center">
									<?php 
										echo '<font class="V9G">Search took '.$search_took.' seconds</font><br><br>';
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
</center>
<?php include (BASE.'footer.inc.php'); ?>
</body>
</html>
<?php

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
	$search_str = str_replace(' - ', ' ', $search_str);
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

function format_recur($arr) {
	global $monthsofyearshort_lang, $daysofweekshort_lang;
	$freq = $arr['FREQ'].(($arr['INTERVAL'] == 1) ? ' ' : 's ');
	$int = $arr['INTERVAL'];
	if (isset($arr['COUNT'])) $times = $arr['COUNT'].' time'.(($arr['COUNT'] == 1) ? ' ' : 's ');
	if (isset($arr['UNTIL'])) $until = 'until '.$arr['UNTIL'].' ';
	$by = '';
	if (isset($arr['BYMONTH'])) {
		$by .= 'on ';
		$count = count($arr['BYMONTH']);
		$last = $count - 1;
		if ($count == 1) {
			$month = $arr['BYMONTH'][0];
			$by .= $monthsofyearshort_lang[($month-1)];
		} else {
			foreach ($arr['BYMONTH'] as $key => $month) {
				if ($key == $last) $by .= $monthsofyearshort_lang[($month-1)];
				else $by .= $monthsofyearshort_lang[($month-1)].', ';
			}
		}
		$by .= ' ';
	}
	
	if (isset($arr['BYMONTHDAY'])) {
		$by .= 'on ';
		$last = count($arr['BYMONTHDAY']) - 1;
		if ($arr['BYMONTHDAY'][$last] == '0') unset($arr['BYMONTHDAY'][$last]);
		$count = count($arr['BYMONTHDAY']);
		$last = $count - 1;
		if ($count == 1) {
			ereg('([\-]{0,1})([0-9]{1,2})',$arr['BYMONTHDAY'][0],$regs);
			list($junk,$sign,$day) = $regs;
			$by .= $day;
		} else {
			foreach ($arr['BYMONTHDAY'] as $key => $day) {
				ereg('([\-]{0,1})([0-9]{1,2})',$day,$regs);
				list($junk,$sign,$day) = $regs;
				if ($key == $last) $by .= $day;
				else $by .= $day.', ';
			}
		}
		$by .= ' ';
	}
	if (isset($arr['BYDAY'])) {
		$by .= 'on ';
		$count = count($arr['BYDAY']);
		$last = $count-1;
		if ($count == 1) {
			ereg('([\-]{0,1})([0-9]{0,1})([A-Z]{2})',$arr['BYDAY'][0],$regs);
			list($junk,$sign,$day_num,$day_txt) = $regs;
			$num = two2threeCharDays($day_txt,false);
			if ($day_num != '') $by .= $day_num.' ';
			$by .= $daysofweekshort_lang[$num];
		} else {
			foreach ($arr['BYDAY'] as $key => $day) {
				ereg('([\-]{0,1})([0-9]{0,1})([A-Z]{2})',$day,$regs);
				list($junk,$sign,$day_num,$day_txt) = $regs;
				$num = two2threeCharDays($day_txt,false);
				if ($day_num != '') $by .= $day_num.' ';
				if ($key == $last) $by .= $daysofweekshort_lang[$num];
				else $by .= $daysofweekshort_lang[$num].', ';
			}
		}
		$by .= ' ';
	}
	return 'Every '.$int.' '.$freq.$times.$until.$by;
}

function getmicrotime() { 
	list($usec, $sec) = explode(' ',microtime()); 
	return ((float)$usec + (float)$sec); 
}
?>