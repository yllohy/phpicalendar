<?php

define('BASE','./');
$current_view = 'search';
$display_date = $results_lang;
include('./functions/ical_parser.php');

if (isset($HTTP_SERVER_VARS['HTTP_REFERER']) && $HTTP_SERVER_VARS['HTTP_REFERER'] != '') {
	$back_page = $HTTP_SERVER_VARS['HTTP_REFERER'];
} else {
	$back_page = BASE.$default_view.'.php?cal='.$cal.'&amp;getdate='.$getdate;
}

$search_valid = false;
if (isset($HTTP_GET_VARS['query']) && $HTTP_GET_VARS['query'] != '') {
	$query = $HTTP_GET_VARS['query'];
	$search_valid = true;
}

$search_box = '';
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
	if (!$format_search_arr[0]) {
		$formatted_search = '<b>'.$no_query_lang.'</b>';
	} else {
		$formatted_search = $format_search_arr[0];
	}
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
	$formatted_search = '<b>'.$no_query_lang.'</b>';
}
$search_ended = getmicrotime();

$search_took = number_format(($search_ended-$search_started),3);

include (BASE.'includes/header.inc.php'); 

?>

<center>
<table border="0" width="700" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="calborder">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
      			<tr>
      				<td align="left" width="120" class="navback"><?php echo '<a href="'.$back_page.'"><img src="styles/'.$style_sheet.'/back.gif" alt="['.$back_lang.']" border="0" align="left"></a>'; ?></td>
      				<td class="navback">
      					<table width="100%" border="0" cellspacing="0" cellpadding="0">
      						<tr>
								<td align="center" class="navback" nowrap valign="middle"><font class="H20"><?php echo $results_lang; ?></font></td>
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
		<td class="dayborder"><img src="images/spacer.gif" width="1" height="5" alt=" "></td>
	</tr>
	<tr>
		<td align="left">
			<div style="padding: 10px;">
				<?php 
				
				echo '<div align="center"><p class="V12">'.$query_lang.': '.$formatted_search.'</p></div>';
				
				if (isset($the_arr) && is_array($the_arr)) {
					foreach($the_arr as $val) {
						$key = $val['date'];
						if ($key > 1) { 
							$dayofmonth = strtotime ($key);
							$dayofmonth = localizeDate ($dateFormat_day, $dayofmonth);
							echo '<font class="V12"><b><a class="ps3" href="day.php?cal='.$cal.'&amp;getdate='.$key.'">'.$dayofmonth.'</a></b></font><br>';
						}
						if ($val["event_text"]) {	
							$event_text 	= stripslashes(urldecode($val["event_text"]));
							$description 	= stripslashes(urldecode($val["description"]));
							$event_start 	= $val["event_start"];
							$event_end 		= $val["event_end"];
							$event_calna 	= $val["calname"];
							$event_start 	= date ($timeFormat, strtotime ("$event_start"));
							$event_end 		= date ($timeFormat, strtotime ("$event_end"));
							$event_start 	= "$event_start - $event_end";
							if (!$val["event_start"]) { 
								$event_start = "$all_day_lang";
								$event_start2 = '';
								$event_end = '';
							}
							echo '<div style="margin-left: 10px; margin-bottom: 10px;">';
							echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\n";
							echo "<tr>\n";
							echo "<td width=\"120\" class=\"G10BOLD\">$time_lang:</td>\n";
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
							echo '</div>';
							if (isset($val['exceptions'])) {
								echo "<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">\n";
								foreach($val['exceptions'] as $val2) {
									$key = $val2['date'];
									$dayofmonth = strtotime ($key);
									$dayofmonth = localizeDate ($dateFormat_day, $dayofmonth);
									echo "<td align=\"left\" colspan=\"2\"><font class=\"V10\"><i>$exception_lang</i>: <a class=\"ps3\" href=\"day.php?cal=$cal&amp;getdate=$key\">$dayofmonth</a></font></td></tr>";
									
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
										echo "<td align=\"left\">\n";
										echo '<div style="margin-left: 10px;">';
										echo "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"1\">\n";
										echo "<tr>\n";
										echo "<td width=\"100\" class=\"V10\">$time_lang:</td>\n";
										echo "<td align=\"left\" class=\"V10\">$event_start</td>\n";
										echo "</tr>\n";
										echo "<tr>\n";
										echo "<td valign=\"top\" width=\"100\" class=\"V10\">$summary_lang:</td>\n";
										echo "<td valign=\"top\" align=\"left\" class=\"V10\">$event_text</td>\n";
										echo "</tr>\n";
										if (isset($val2['recur'])) {
											$recur = $val2['recur'];
											echo "<tr>\n";
											echo "<td valign=\"top\" width=\"100\" class=\"V10\">$recurring_event_lang:</td>\n";
											echo "<td valign=\"top\" align=\"left\" class=\"V10\">$recur</td>\n";
											echo "</tr>\n";
										}
										if ($val2["description"]) {
											echo "<tr>\n";
											echo "<td valign=\"top\" width=\"100\" class=\"V10\">$description_lang:</td>\n";
											echo "<td valign=\"top\" align=\"left\" class=\"V10\">$description</td>\n";
											echo "</tr>\n";
										}
										echo "</table>";
										echo '</div><br>';
		
									}
								}
							}
						}
					}
				} else {
					echo '<div align="center">';
					echo '<p class="V12">'.$no_results_lang.'</p>';
					echo '</div>';
				}
					
					echo '<div align="center">';
					echo $search_box;
					echo '<p class="V9G">'.sprintf($search_took_lang,$search_took).'</p></div>';
					echo '</div>';
				?>

					</td>
				</tr>
			</table>		
		</td>
	</tr>
</table>
</center>
<?php 

include (BASE.'includes/footer.inc.php');


// takes a boolean search and formats it into an array
// use with sister function search_boolean()
function format_search($search_str) {
	// init arrays
	$and_arr = array();
	$or_arr = array();
	$not_arr = array();
	$or_str_arr = array();

	$search_str = strtolower($search_str);
	
	if ($search_str == ' ') return array(false,$and_arr,$or_arr,$not_arr);
	
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
	
	if (!$needle_arr[0]) return false;
	if ((sizeof($and_arr) == 0) &&
		(sizeof($or_arr) == 0) &&
		(sizeof($not_arr) == 0)) return false;
	
	// compare lowercase versions of the strings
	$haystack = strtolower($haystack);

	// check against the NOT
	foreach($not_arr as $s) {
		if (is_string(strstr($haystack,$s)) == true) {
			return false;
		}
	}
	
	// check against the AND
	foreach($and_arr as $s) {
		if (is_string(strstr($haystack,$s)) == false) {
			return false;
		}
	}
	
	// check against the OR
	foreach($or_arr as $or) {
		$is_false = true;
		foreach($or as $s) {
			if (substr($s,0,1) == '-') {
				if (is_string(strstr($haystack,substr($s,1))) == false) {
					$is_false = false;
					break;
				}			
			} elseif (is_string(strstr($haystack,$s)) == true) {
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
	global $format_recur_lang, $monthsofyear_lang, $daysofweek_lang;
	
	$d = $format_recur_lang['delimiter'];
	$int = $arr['INTERVAL'];
	$tmp = (($int == '1') ? 0 : 1);
	
	$freq = $arr['FREQ'];
	$freq = $format_recur_lang[$freq][$tmp];
	
	if		(isset($arr['COUNT']))	$for = str_replace('%int%',$arr['COUNT'],$format_recur_lang['count']);
	elseif	(isset($arr['UNTIL']))	$for = str_replace('%date%',$arr['UNTIL'], $format_recur_lang['until']);
	else							$for = '';
	
	$print = $format_recur_lang['start'];
	$print = str_replace('%int%', $int, $print);
	$print = str_replace('%freq%', $freq, $print);
	$print = str_replace('%for%', $for, $print);
	
	if (isset($arr['BYMONTH'])) {
		$list = '';
		$last = count($arr['BYMONTH']) - 1;
		foreach ($arr['BYMONTH'] as $key => $month) {
			if ($key == $last)	$list .= $monthsofyear_lang[($month-1)];
			else 				$list .= $monthsofyear_lang[($month-1)].$d;
		}
		$print .= '<br>'."\n";
		$print .= str_replace('%list%', $list, $format_recur_lang['bymonth']);
	}
	
	if (isset($arr['BYMONTHDAY'])) {
		$list = '';
		if ($arr['BYMONTHDAY'][(count($arr['BYMONTHDAY']) - 1)] == '0') unset($arr['BYMONTHDAY'][$last]);
		$last = count($arr['BYMONTHDAY']) - 1;
		foreach ($arr['BYMONTHDAY'] as $key => $day) {
			ereg('(-{0,1})([0-9]{1,2})',$day,$regs);
			list($junk,$sign,$day) = $regs;
			if ($sign != '')	$list .= $sign;
			if ($key == $last)	$list .= $day;
			else				$list .= $day.$d;
		}
		$print .= '<br>'."\n";
		$print .= str_replace('%list%', $list, $format_recur_lang['bymonthday']);
	}
	
	if (isset($arr['BYDAY'])) {
		$list = '';
		$last = count($arr['BYDAY']) - 1;
		foreach ($arr['BYDAY'] as $key => $day) {
			ereg('([-\+]{0,1})([0-9]{0,1})([A-Z]{2})',$day,$regs);
			list($junk,$sign,$day_num,$day_txt) = $regs;
			$num = two2threeCharDays($day_txt,false);
			if ($sign != '')	$list .= $sign;
			if ($day_num != '')	$list .= $day_num.' ';
			if ($key == $last)	$list .= $daysofweek_lang[$num];
			else				$list .= $daysofweek_lang[$num].$d;
		}
		$print .= '<br>'."\n";
		$print .= str_replace('%list%', $list, $format_recur_lang['byday']);
	}
	
	return $print;
}

function getmicrotime() { 
	list($usec, $sec) = explode(' ',microtime()); 
	return ((float)$usec + (float)$sec); 
}
?>
