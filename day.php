<?php
if (isset($HTTP_GET_VARS['jumpto_day'])) {
	$jumpto_day_time = strtotime($HTTP_GET_VARS['jumpto_day']);
	if ($jumpto_day_time == -1) {
		$getdate = date('Ymd', strtotime("now + $second_offset seconds"));
	} else {
		$getdate = date('Ymd', $jumpto_day_time);
	}
}
define('BASE', './');
$current_view = 'day';
include(BASE.'functions/ical_parser.php');
if ($minical_view == 'current') $minical_view = 'day';

$starttime = '0500';
$weekstart = 1;
$unix_time = strtotime($getdate);
$today_today = date ('Ymd', $unix_time);
$tomorrows_date = date( 'Ymd', strtotime('+1 day',  $unix_time));
$yesterdays_date = date( 'Ymd', strtotime('-1 day',  $unix_time));
$display_date = localizeDate($dateFormat_day, $unix_time);

// For the side months
ereg ('([0-9]{4})([0-9]{2})([0-9]{2})', $getdate, $day_array2);
$this_day = $day_array2[3]; 
$this_month = $day_array2[2];
$this_year = $day_array2[1];

$parse_month = date ('Ym', $unix_time);
$thisday2 = localizeDate($dateFormat_week_list, $unix_time);
$start_week_time = strtotime(dateOfWeek($getdate, $week_start_day));

$dayborder = 0;

$nbrGridCols = 1;
if (is_array($master_array[($getdate)])) {
	foreach($master_array[($getdate)] as $ovlKey => $ovlValue) {
		if ($ovlKey != '-1') {
			foreach($ovlValue as $ovl2Value) {
				$nbrGridCols = kgv($nbrGridCols, ($ovl2Value['event_overlap'] + 1));
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
	<title><?php echo "$calendar_name - $display_date"; ?></title>
  	<link rel="stylesheet" type="text/css" href="<?php echo BASE."styles/$style_sheet/default.css"; ?>">
   <?php 
		// if RSS is enabled, set the RSS auto-discovery link
		if ($enable_rss == 'yes') 
		{
    		echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"RSS\" href=\"".$default_path."/rss/rss.php?cal=".$cal."&amp;rssview=day\">";
		} 
	?>

<?php if (is_array($master_array['-2'])) include (BASE.'functions/todo.js'); ?>
</head>
<body bgcolor="#FFFFFF">
<?php include (BASE.'includes/header.inc.php'); ?>
<center>
<table border="0" width="700" cellspacing="0" cellpadding="0">
	<tr>
		<td width="520" valign="top">
<table width="520" border="0" cellspacing="0" cellpadding="0" class="calborder">
    <tr>
     	<td align="center" valign="middle">
      		<table width="100%" border="0" cellspacing="0" cellpadding="0">
      			<tr>
      				<td align="left" width="120" class="navback">&nbsp;</td>
      				<td class="navback">
      					<table width="100%" border="0" cellspacing="0" cellpadding="0">
      						<tr>
								<td align="right" width="40%" class="navback"><?php echo '<a class="psf" href="day.php?cal='.$cal.'&amp;getdate='.$yesterdays_date.'"><img src="styles/'.$style_sheet.'/left_day.gif" alt="['.$last_day_lang.']" border="0" align="right"></a>'; ?></td>
								<td align="center" width="20%" class="navback" nowrap valign="middle"><font class="H20"><?php echo $display_date; ?></font></td>
      							<td align="left" width="40%" class="navback"><?php echo '<a class="psf" href="day.php?cal='.$cal.'&amp;getdate='.$tomorrows_date.'"><img src="styles/'.$style_sheet.'/right_day.gif" alt="['.$next_day_lang.']" border="0" align="left"></a>'; ?></td>
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
				<?php
					// The all day events returned here.
					if ($master_array[($getdate)]['-1']) {
					   echo "<tr>\n";
					   echo '<td colspan="3" height="24">'."\n";
					   echo '<table width="100%" border="0" cellspacing="1" cellpadding="4">'."\n";
					   foreach($master_array[($getdate)]['-1'] as $allday) {
						 echo "<tr>\n";
						 echo '<td valign="top" align="center" class="eventbg">';
						 openevent("$calendar_name",
							   "",
							   "",
							   $allday,
							   0,
							   "",
							   '<font color="#ffffff"><i>',
							   "</i></font>");
						 echo "</td>\n</tr>\n";
					   }
					   echo '</table>'."\n";
					   echo '</td>'."\n";
					   echo '</tr>'."\n";
					}
					if ($daysofweek_dayview == 'yes') {
				?>

		<tr>	
			<td>
      			<table width="100%" border="0" cellspacing="0" cellpadding="0">
      			<?php
      				echo '<tr><td colspan="7"><img src="images/spacer.gif" width="70" height="1" alt=" "></td></tr>';
					echo "<tr>";
					$thisdate = $start_week_time;
					$start_day = strtotime($week_start_day);
					$i = 0;
					do {
						$day_num = date("w", $start_day);
						$day = $daysofweek_lang[$day_num];
						$thisday = date("Ymd", $thisdate);
						echo "<td width=\"74\" valign=\"top\" align=\"center\" class=\"dateback\">\n";
						echo "<font class=\"V9\"><a class=\"psf\" href=\"day.php?cal=$cal&amp;getdate=$thisday\">$day</a></font>\n";
						echo "</td>\n";
						$start_day = strtotime("+1 day", $start_day);
						$thisdate = strtotime("+1 day", $thisdate);
						$i++;
					} while ($i < 7);
					echo '</tr>';			
		      		echo '</table>';
      				echo '</td>';
      				echo '</tr>';
      				}
      				?>
      			
      			<tr>
					<td align="center" valign="top" colspan="3">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="60"><img src="images/spacer.gif" width="60" height="1" alt=" "></td>
								<td width="1"></td>
								<?php for ($m=0;$m < $nbrGridCols;$m++) { 
									echo '<td><img src="images/spacer.gif" width="' . (520 / $nbrGridCols) . '" height="1" alt=" "></td>';
								} ?>
							</tr>
							<?php
								// $master_array[($getdate)][$day_time]
								$event_length = array ();
								$border = 0;
								foreach ($day_array as $key) {
									ereg('([0-9]{2})([0-9]{2})', $key, $regs_tmp);
									$cal_time = $key;
									$key = mktime($regs_tmp[1],$regs_tmp[2],0,$this_month,$this_day,$this_year);
									$key = date ($timeFormat, $key);
									unset($this_time_arr);
									
									// add events that overlap the start time
									if (isset($master_array[$getdate][$cal_time]) && sizeof($master_array[$getdate][$cal_time]) > 0) {
										$this_time_arr = $master_array[$getdate][$cal_time];
									}
									
									// add events that overlap $day_start instead of cutting them out completely
									if ("$day_start" == "$cal_time" && is_array($master_array[$getdate])) {
										foreach($master_array[$getdate] as $time_key => $time_arr) {
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
											$drawEvent = drawEventTimes ($cal_time, $loopevent['event_end']);
											$j = 0;
											while (isset($event_length[$j])) {
												if ($event_length[$j]['state'] == 'ended') {
													$event_length[$j] = array ('length' => ($drawEvent['draw_length'] / $gridLength), 'key' => $eventKey, 'overlap' => $loopevent['event_overlap'],'state' => 'begin');
													break;
												}
												$j++;
											}
											if ($j == sizeof($event_length)) {
												array_push ($event_length, array ('length' => ($drawEvent['draw_length'] / $gridLength), 'key' => $eventKey, 'overlap' => $loopevent['event_overlap'],'state' => 'begin'));
											}
										}
									}
									if (ereg('([0-9]{1,2}):00', $key)) {
										echo '<tr>'."\n";
										echo '<td rowspan="' . (60 / $gridLength) . '" align="center" valign="top" width="60" class="timeborder">'.$key.'</td>'."\n";
										echo '<td width="1" height="' . $gridLength . '"></td>'."\n";
									} elseif("$cal_time" == "$day_start") {
										$size_tmp = 60 - (int)substr($cal_time,2,2);
										echo "<tr>\n";
										echo "<td rowspan=\"" . ($size_tmp / $gridLength) . "\" align=\"center\" valign=\"top\" width=\"60\" class=\"timeborder\">$key</td>\n";
										echo "<td width=\"1\" height=\"" . $gridLength . "\"></td>\n";
									} else {
										echo '<tr>'."\n";
										echo '<td width="1" height="' . $gridLength . '"></td>'."\n";
									}
									if ($dayborder == 0) {
										$class = ' class="dayborder"';
										$dayborder++;
									} else {
										$class = ' class="dayborder2"';
										$dayborder = 0;
									}
									if (sizeof($event_length) == 0) {
										echo '<td bgcolor="#ffffff" colspan="' . $nbrGridCols . '" '.$class.'>&nbsp;</td>'."\n";
										
									} else {
										$emptyWidth = $nbrGridCols;
										for ($i=0;$i<sizeof($event_length);$i++) {
											$drawWidth = $nbrGridCols / ($event_length[$i]['overlap'] + 1);
											$emptyWidth = $emptyWidth - $drawWidth;
											switch ($event_length[$i]['state']) {
												case 'begin':
												  $event_length[$i]['state'] = 'started';
												  $event_start 	= strtotime ($this_time_arr[($event_length[$i]['key'])]['event_start']);
												  $event_end	= strtotime ($this_time_arr[($event_length[$i]['key'])]['event_end']);
												  $event_start 	= date ($timeFormat, $event_start);
												  $event_end	= date ($timeFormat, $event_end);
								
												  echo '<td rowspan="' . $event_length[$i]['length'] . '" colspan="' . $drawWidth . '" align="left" valign="top" class="eventbg2">'."\n";
												  echo '<table width="100%" border="0" cellspacing="0" cellpadding="2">'."\n";
												  echo '<tr>'."\n";
												  echo '<td class="eventborder"><font class="eventfont"><b>'.$event_start.'</b> - '.$event_end.'</font></td>'."\n";
												  echo '</tr>'."\n";
												  echo '<tr>'."\n";
												  echo '<td>'."\n";
												  echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">'."\n";
												  echo '<tr>'."\n";
												  echo '<td class="eventbg">';
										  		  openevent("$calendar_name",
												  "$event_start",
												  "$event_end",
												  $this_time_arr[($event_length[$i]['key'])],
												  "",
												  0,
												  "<font class=\"eventfont\">",
												  "</font>");
												  echo '</td></tr>'."\n";
												  echo '</table>'."\n";
												  echo '</td>'."\n";           
												  echo '</tr>'."\n";
												  echo '</table>'."\n";
												  echo '</td>'."\n";
												  break;
												case 'started':
													break;
												case 'ended':
													echo '<td bgcolor="#ffffff" colspan="' . $drawWidth . '" ' . $class . '>&nbsp;</td>'."\n";
													break;
											}
											$event_length[$i]['length']--;
											if ($event_length[$i]['length'] == 0) {
												$event_length[$i]['state'] = 'ended';
											}
										}
										//fill emtpy space on the right
										if ($emptyWidth > 0) {
											echo '<td bgcolor="#ffffff" colspan="' . $emptyWidth . '" ' . $class . '>&nbsp;</td>'."\n";
										}
										while (isset($event_length[(sizeof($event_length) - 1)]) && $event_length[(sizeof($event_length) - 1)]['state'] == 'ended') {
											array_pop($event_length);
										}
										
									}
									echo '</tr>'."\n";
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
		<td width="20"><img src="images/spacer.gif" width="20" height="1" alt=" "></td>
		<td width="160" valign="top">
			<?php include (BASE.'includes/sidebar.php'); ?>
			<?php include (BASE.'includes/footer.inc.php'); ?>
		</td>
	</tr>
</table>
</center>
</body>
</html>

