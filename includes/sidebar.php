<?php
// Get the real date to display in the sidebar, not the date displayed in the calendar
$really_unix_time = strtotime(date('Ymd'));
$really_today_today = date ('Ymd', $really_unix_time);

if ($cal == $ALL_CALENDARS_COMBINED) {
	$cal_displayname2 = $all_cal_comb_lang;
} else {
	$cal_displayname2 = $calendar_name . " $calendar_lang";
}
if (strlen($cal_displayname2) > 24) {
	$cal_displayname2 = substr("$cal_displayname2", 0, 21);
	$cal_displayname2 = $cal_displayname2 . "...";
}
	
$search_box = '<form style="margin-bottom:0;" action="search.php" method="GET"><input type="hidden" name="cal" value="'.$cal.'"><input type="hidden" name="getdate" value="'.$getdate.'"><input type="text" style="font-size:10px" size="15" class="search_style" name="query" value="'.$search_lang.'" onfocus="javascript:if(this.value==\''.$search_lang.'\') {this.value=\'\';}" onblur="javascript:if(this.value==\'\') {this.value=\''.$search_lang.'\'}"><INPUT type="image" src="styles/'.$style_sheet.'/search.gif" name="submit" value="Search"></form>';

?>
<table width="170" border="0" cellpadding="0" cellspacing="0" class="calborder">
	<tr>
		<td align="left" valign="top" width="24" class="sideback"><?php echo "<a class=\"psf\" href=\"day.php?cal=$cal&amp;getdate=$yesterdays_date\"><img src=\"styles/$style_sheet/left_arrows.gif\" alt=\"[$prev_lang]\" width=\"16\" height=\"20\" border=\"0\" align=\"left\"></a>"; ?></td>
		<td align="center" width="112" class="sideback"><font class="G10BOLD"><?php echo "$thisday2"; ?></font></td>
		<td align="right" valign="top" width="24" class="sideback"><?php echo "<a class=\"psf\" href=\"day.php?cal=$cal&amp;getdate=$tomorrows_date\"><img src=\"styles/$style_sheet/right_arrows.gif\" alt=\"[$next_lang]\" width=\"16\" height=\"20\" border=\"0\" align=\"right\"></a>"; ?></td>
	</tr>
	<tr>
		<td colspan="3" bgcolor="#FFFFFF" align="left">
			<?php 
				echo '<div style="padding: 5px;">';
				echo '<font class="G10BOLD">'.$cal_displayname2.'</font><br>';
				echo '<span class="G10">';
				echo "<a class=\"psf\" href=\"day.php?cal=$cal&amp;getdate=$really_today_today\">$goday_lang</a><br>\n";
				echo "<a class=\"psf\" href=\"week.php?cal=$cal&amp;getdate=$really_today_today\">$goweek_lang</a><br>\n";
				echo "<a class=\"psf\" href=\"month.php?cal=$cal&amp;getdate=$really_today_today\">$gomonth_lang</a><br>\n";
				echo "<a class=\"psf\" href=\"year.php?cal=$cal&amp;getdate=$really_today_today\">$goyear_lang</a><br>\n";
				echo "<a class=\"psf\" href=\"print.php?cal=$cal&amp;getdate=$getdate&amp;printview=$current_view\">$goprint_lang</a><br>\n";
				if ($allow_preferences != 'no') echo "<a class=\"psf\" href=\"preferences.php?cal=$cal&amp;getdate=$getdate\">$preferences_lang</a><br>\n";
				if ($cal != $ALL_CALENDARS_COMBINED && $subscribe_path != '' && $download_filename != '') echo "<a class=\"psf\" href=\"$subscribe_path\">$subscribe_lang</a>&nbsp;|&nbsp;<a class=\"psf\" href=\"$download_filename\">$download_lang</a>\n";
				echo '</span></div>';
			 ?>
		</td>
	</tr>
</table>
<img src="images/spacer.gif" width="1" height="10" alt=" "><br>
<table width="170" border="0" cellpadding="0" cellspacing="0" class="calborder">
	<tr height="20">
		<td align="center" class="sideback"><div style="height: 20px; margin-top: 3px;" class="G10BOLD"><?php echo "$jump_lang"; ?></div></td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" align="left">
			<?php 
			
			echo '<div style="padding: 5px;">';
			echo '<form style="margin-bottom:0;" action="day.php" method="GET">';
			echo "<select name=\"action\" class=\"query_style\" onChange=\"window.location=(this.options[this.selectedIndex].value+'";
			if (isset($query)) echo $query;
			echo "');\">";
			include('./functions/list_icals.php');
			include('./functions/list_years.php');
			include('./functions/list_months.php');
			include('./functions/list_weeks.php');
			echo '</form>';
			if ($show_search == 'yes') {
				echo $search_box;
			}
			if ($display_custom_goto == "yes") {
				echo '<form style="margin-bottom:0;" action="day.php" method="GET">';
				echo '<input type="hidden" name="cal" value="'.urlencode($cal).'">';	
				echo '<input type="text" style="width:160px; font-size:10px" name="jumpto_day">';
				echo '<input type="submit" value="Go">';
				echo '</form>';
			} 
			echo '</div>';
			?>
		</td>
	</tr>
</table>
<img src="images/spacer.gif" width="1" height="10" alt=" "><br>
	
<?php if (isset($master_array[($tomorrows_date)]) && sizeof($master_array[($tomorrows_date)]) > 0) { ?>
<table width="170" border="0" cellpadding="0" cellspacing="0" class="calborder">
	<tr height="20">
		<td align="center" class="sideback"><div style="height: 20px; margin-top: 3px;" class="G10BOLD"><?php echo "$tomorrows_lang"; ?></div></td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" align="center">
			<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" width="100%">
				<tr>
					<td colspan="7"><img src="images/spacer.gif" width="21" height="6" alt=" "></td>
				</tr>
				
				<?php
					echo "<tr>\n";
					echo "<td width=\"1%\"><img src=\"images/spacer.gif\" width=\"4\" height=\"1\" alt=\" \"></td>";
					echo "<td colspan=\"6\" class=\"G10B\" align=\"left\">\n";
					foreach ($master_array[("$tomorrows_date")] as $event_times) {
						foreach ($event_times as $val) {
							$event_text = stripslashes(urldecode($val["event_text"]));
							$event_text = strip_tags($event_text, '<b><i><u>');
							if ($event_text != "") {	
								$event_text2 	= rawurlencode(addslashes($val["event_text"]));
								$description 	= addslashes(urlencode($val["description"]));
								$event_start 	= @$val["event_start"];
								$event_end 		= @$val["event_end"];
								$event_start 	= date ($timeFormat, @strtotime ("$event_start"));
								$event_end 		= date ($timeFormat, @strtotime ("$event_end"));
								$calendar_name2	= addslashes($calendar_name);
								$calendar_name2 = urlencode($calendar_name2);
								$event_text = word_wrap($event_text, 21, $tomorrows_events_lines);
								
								if (!isset($val["event_start"])) { 
									$event_start = $all_day_lang; 
									$event_end = ''; 
									openevent($calendar_name2, $event_start, 
									$event_end, $val, $tomorrows_events_lines, 21, '<i>', '</i>', 'psf'); 
									echo "<br>\n"; 
								} else { 
									openevent($calendar_name2, $event_start, 
									$event_end, $val, $tomorrows_events_lines, 21, '<font class="G10B">&#149; ', '</font>', 'psf'); 
									echo "<br>\n"; 
								}


								
							}
						}
					}
					echo "</td>\n";
					echo "</tr>\n";
				?>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="148" height="6" alt=" "></td>
	</tr>
</table>
<img src="images/spacer.gif" width="1" height="10" alt=" "><br>

<?php } if ((isset($master_array['-2'])) && ($show_todos == 'yes')) { ?>
<table width="170" border="0" cellpadding="0" cellspacing="0" class="calborder">
	<tr height="20">
		<td align="center" width="98%" class="sideback"><div style="height: 20px; margin-top: 3px;" class="G10BOLD"><?php echo "$todo_lang"; ?></div></td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" align="center">
			<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" width="100%">
				<tr>
					<td colspan="7"><img src="images/spacer.gif" width="21" height="6" alt=" "></td>
				</tr>
				
				<?php
					echo "<tr>\n";
					echo "<td width=\"1%\"><img src=\"images/spacer.gif\" width=\"4\" height=\"1\" alt=\" \"></td>";
					echo "<td colspan=\"6\" class=\"G10B\" align=\"left\">\n";
					echo "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\">\n";
					foreach ($master_array['-2'] as $vtodo_times) {
						foreach ($vtodo_times as $val) {
							$vtodo_text = stripslashes(urldecode($val["vtodo_text"]));
							if ($vtodo_text != "") {	
								if (isset($val["description"])) { 
									$description 	= urldecode($val["description"]);
								} else {
									$description = ""; 
								}
								$completed_date = $val['completed_date'];
								$status 		= $val["status"];
								$priority 		= $val['priority'];
								$start_date 	= $val["start_date"];
								$due_date 		= $val['due_date'];
								$vtodo_array 	= array(
									'cal'			=> $calendar_name,
									'completed_date'=> $completed_date,
									'description'	=> $description,
									'due_date'		=> $due_date,
									'priority'		=> $priority,
									'start_date'	=> $start_date,
									'status'		=> $status,
									'vtodo_text' 	=> $vtodo_text);

								$vtodo_array 	= base64_encode(serialize($vtodo_array));
								
								$vtodo_text 	= word_wrap(strip_tags(str_replace('<br>',' ',$vtodo_text), '<b><i><u>'), 21, $tomorrows_events_lines);
										$vtodo_link = "<a class=\"psf\" href=\"javascript:openTodoInfo('$vtodo_array')\">";
								
								if ($status == 'COMPLETED' || (isset($val['completed_date']) && isset($val['completed_time']))) {
									if ($show_completed == 'yes') {
										$vtodo_text = "<S>$vtodo_text</S>";
										echo "<tr><td>$vtodo_link<img src=\"images/completed.gif\" alt=\" \" width=\"13\" height=\"11\" border=\"0\" align=\"middle\"></a></td>\n";
										echo "<td><img src=\"images/spacer.gif\" width=\"2\" height=\"1\" border\"0\" /></td><td>$vtodo_link<font class=\"G10B\"> $vtodo_text</font></a></td></tr>\n";
									}
								} elseif (isset($val['priority']) && ($val['priority'] != 0) && ($val['priority'] <= 5)) {
									echo "<tr><td>$vtodo_link<img src=\"images/important.gif\" alt=\" \" width=\"13\" height=\"11\" border=\"0\" align=\"middle\"></a></td>\n";
									echo "<td><img src=\"images/spacer.gif\" width=\"2\" height=\"1\" border\"0\" /></td><td>$vtodo_link<font class=\"G10B\"> $vtodo_text</font></a></td></tr>\n";
								} else {
									echo "<tr><td>$vtodo_link<img src=\"images/not_completed.gif\" alt=\" \" width=\"13\" height=\"11\" border=\"0\" align=\"middle\"></a></td>\n";
									echo "<td><img src=\"images/spacer.gif\" width=\"2\" height=\"1\" border\"0\" /></td><td>$vtodo_link<font class=\"G10B\"> $vtodo_text</font></a></td></tr>\n";
								}
							}
						}
					}
					echo "</table>\n";
					echo "</td>\n";
					echo "</tr>\n";
				?>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="3" bgcolor="#FFFFFF"><img src="images/spacer.gif" width="148" height="6" alt=" "></td>
	</tr>
</table>
<img src="images/spacer.gif" width="1" height="10" alt=" "><br>
<?php } 
		$fake_getdate_time = strtotime($this_year.'-'.$this_month.'-15');
?>	
<table width="170" border="0" cellpadding="3" cellspacing="0" class="calborder">
	<tr height="20">
		<td align="center" class="sideback"><font class="G10BOLD"><?php print (localizeDate ($dateFormat_month, strtotime("-1 month", $fake_getdate_time))); ?></font></td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" align="center">
			<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
				<?php
					$start_day = strtotime($week_start_day);
					echo '<tr>';
					for ($i=0; $i<7; $i++) {
						$day_num = date("w", $start_day);
						$day = $daysofweekreallyshort_lang[$day_num];
						echo '<td align="center" class="G10BOLD">'.$day.'</td>';
						$start_day = strtotime("+1 day", $start_day); 
					}
					echo '</tr>';
					$minical_time 		= strtotime("-1 month", $fake_getdate_time);
					$minical_month 		= date("m", $minical_time);
					$minical_year 		= date("Y", $minical_time);
					$first_of_month 	= $minical_year.$minical_month."01";
					$start_day 			= strtotime(dateOfWeek($first_of_month, $week_start_day));
					$i 					= 0;
					$whole_month 		= TRUE;
					$num_of_events 		= 0;
					do {
						$day 			= date ("j", $start_day);
						$daylink 		= date ("Ymd", $start_day);
						$check_month 	= date ("m", $start_day);
						if ($check_month != $minical_month) $day = '<font class="G10G">'.$day.'</font>';
						if ($i == 0) echo "<tr>\n";
						if (isset($master_array[("$daylink")]) && ($check_month == $minical_month)) {
							echo '<td width="22" align="center" class="G10B">';
							echo '<a class="ps2" href="'.$minical_view.'.php?cal='.$cal.'&amp;getdate='.$daylink.'">'.$day.'</a>';
							echo '</td>';
						} else {
							echo '<td width="22" align="center" class="G10B">';
							echo '<a class="psf" href="'.$minical_view.'.php?cal='.$cal.'&amp;getdate='.$daylink.'">'.$day.'</a>';
							echo '</td>';
						}
						$start_day = strtotime("+1 day", $start_day); 
						$i++;
						if ($i == 7) { 
							echo '</tr>';
							$i = 0;
							$checkagain = date ("m", $start_day);
							if ($checkagain != $minical_month) $whole_month = FALSE;	
						}
					} while ($whole_month == TRUE);
				?>
			</table>
			<img src="images/spacer.gif" width="1" height="3" alt=" "><br>
		</td>
	</tr>
</table>
<img src="images/spacer.gif" width="1" height="10" alt=" "><br>
<table width="170" border="0" cellpadding="3" cellspacing="0" class="calborder">
	<tr height="20">
		<td align="center" class="sideback"><font class="G10BOLD"><?php print (localizeDate ($dateFormat_month, strtotime($getdate))); ?></font></td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" align="center">
			<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
				<?php
					$start_day = strtotime($week_start_day);
					echo '<tr>';
					for ($i=0; $i<7; $i++) {
						$day_num = date("w", $start_day);
						$day = $daysofweekreallyshort_lang[$day_num];
						echo '<td align="center" class="G10BOLD">'.$day.'</td>';
						$start_day = strtotime("+1 day", $start_day); 
					}
					echo '</tr>';
					$minical_time 		= $fake_getdate_time;
					$minical_month 		= date("m", $minical_time);
					$minical_year 		= date("Y", $minical_time);
					$first_of_month 	= $minical_year.$minical_month."01";
					$start_day 			= strtotime(dateOfWeek($first_of_month, $week_start_day));
					$i 					= 0;
					$whole_month 		= TRUE;
					$num_of_events 		= 0;
					do {
						$day 			= date ("j", $start_day);
						$daylink 		= date ("Ymd", $start_day);
						$check_month 	= date ("m", $start_day);
						if ($check_month != $minical_month) $day = '<font class="G10G">'.$day.'</font>';
						if ($i == 0) echo "<tr>\n";
						if (isset($master_array[("$daylink")]) && ($check_month == $minical_month)) {
							echo '<td width="22" align="center" class="G10B">';
							echo '<a class="ps2" href="'.$minical_view.'.php?cal='.$cal.'&amp;getdate='.$daylink.'">'.$day.'</a>';
							echo '</td>';
						} else {
							echo '<td width="22" align="center" class="G10B">';
							echo '<a class="psf" href="'.$minical_view.'.php?cal='.$cal.'&amp;getdate='.$daylink.'">'.$day.'</a>';
							echo '</td>';
						}
						$start_day = strtotime("+1 day", $start_day); 
						$i++;
						if ($i == 7) { 
							echo '</tr>';
							$i = 0;
							$checkagain = date ("m", $start_day);
							if ($checkagain != $minical_month) $whole_month = FALSE;	
						}
					} while ($whole_month == TRUE);
				?>
			</table>
			<img src="images/spacer.gif" width="1" height="3" alt=" "><br>
		</td>
	</tr>
</table>
<img src="images/spacer.gif" width="1" height="10" alt=" "><br>
<table width="170" border="0" cellpadding="3" cellspacing="0" class="calborder">
	<tr height="20">
		<td align="center" class="sideback"><font class="G10BOLD"><?php print (localizeDate ($dateFormat_month, strtotime("+1 month", strtotime($getdate)))); ?></font></td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" align="center">
			<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
				<?php
					$start_day = strtotime($week_start_day);
					echo '<tr>';
					for ($i=0; $i<7; $i++) {
						$day_num = date("w", $start_day);
						$day = $daysofweekreallyshort_lang[$day_num];
						echo '<td align="center" class="G10BOLD">'.$day.'</td>';
						$start_day = strtotime("+1 day", $start_day); 
					}
					echo '</tr>';
					$minical_time 		= strtotime("+1 month", $fake_getdate_time);
					$minical_month 		= date("m", $minical_time);
					$minical_year 		= date("Y", $minical_time);
					$first_of_month 	= $minical_year.$minical_month."01";
					$start_day 			= strtotime(dateOfWeek($first_of_month, $week_start_day));
					$i 					= 0;
					$whole_month 		= TRUE;
					$num_of_events 		= 0;
					do {
						$day 			= date ("j", $start_day);
						$daylink 		= date ("Ymd", $start_day);
						$check_month 	= date ("m", $start_day);
						if ($check_month != $minical_month) $day = '<font class="G10G">'.$day.'</font>';
						if ($i == 0) echo "<tr>\n";
						if (isset($master_array[("$daylink")]) && ($check_month == $minical_month)) {
							echo '<td width="22" align="center" class="G10B">';
							echo '<a class="ps2" href="'.$minical_view.'.php?cal='.$cal.'&amp;getdate='.$daylink.'">'.$day.'</a>';
							echo '</td>';
						} else {
							echo '<td width="22" align="center" class="G10B">';
							echo '<a class="psf" href="'.$minical_view.'.php?cal='.$cal.'&amp;getdate='.$daylink.'">'.$day.'</a>';
							echo '</td>';
						}
						$start_day = strtotime("+1 day", $start_day); 
						$i++;
						if ($i == 7) { 
							echo '</tr>';
							$i = 0;
							$checkagain = date ("m", $start_day);
							if ($checkagain != $minical_month) $whole_month = FALSE;	
						}
					} while ($whole_month == TRUE);
				?>
			</table>
			<img src="images/spacer.gif" width="1" height="3" alt=" "><br>
		</td>
	</tr>
</table>
