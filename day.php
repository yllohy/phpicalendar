<?php
if (isset($HTTP_GET_VARS['jumpto_day'])) {
	$jumpto_day_time = strtotime($HTTP_GET_VARS['jumpto_day']);
	if ($jumpto_day_time == -1) {
		$getdate = date('Ymd');
	} else {
		$getdate = date('Ymd', $jumpto_day_time);
	}
}
$current_view = 'day';
include('./functions/ical_parser.php');
if ($minical_view == "current") $minical_view = "day";



//if ($use_sessions == 'yes') {
//	session_start();
//	if (is_array($aArray)) $master_array = $aArray;
//	echo 'using sessions';
//}

$starttime = '0500';
$weekstart = 1;
// dpr 20020926: moved variable gridLength to config.inc.php
//$gridLength = 30;
$unix_time = strtotime($getdate);
$today_today = date ('Ymd');
$tomorrows_date = date( 'Ymd', strtotime('+1 day',  $unix_time));
$yesterdays_date = date( 'Ymd', strtotime('-1 day',  $unix_time));
$display_date = localizeDate($dateFormat_day, $unix_time);

// For the side months
ereg ('([0-9]{4})([0-9]{2})([0-9]{2})', $getdate, $day_array2);
$this_day = $day_array2[3]; 
$this_month = $day_array2[2];
$this_year = $day_array2[1];

$parse_month = date ('Ym', $date);
$thisday2 = localizeDate($dateFormat_week_list, $unix_time);

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
	<title><?php echo $calendar_name; ?></title>
  	<link rel="stylesheet" type="text/css" href="styles/<?php echo $style_sheet.'/default.css'; ?>">
	<?php include ('./functions/event.js'); ?>
</head>
<body bgcolor="#FFFFFF">
<center>
<table border="0" width="700" cellspacing="0" cellpadding="0">
	<tr>
		<td width="520" valign="top">
<table width="520" border="0" cellspacing="0" cellpadding="0" class="calborder">
    <tr>
     	<td align="center" valign="middle">
      		<table width="100%" border="0" cellspacing="0" cellpadding="0">
      			<tr>
      				<td align="left" width="90" class="navback">&nbsp;</td>
      				<td>
      					<table width="100%" border="0" cellspacing="0" cellpadding="0">
      						<tr>
								<td align="right" width="40%" class="navback"><?php echo '<a class="psf" href="day.php?cal='.$cal.'&getdate='.$yesterdays_date.'"><img src="styles/'.$style_sheet.'/left_day.gif" alt="" border="0" align="right"></a>'; ?></td>
								<td align="center" width="20%" class="navback" nowrap valign="middle"><font class="H20"><?php echo $display_date; ?></font></td>
      							<td align="left" width="40%" class="navback"><?php echo '<a class="psf" href="day.php?cal='.$cal.'&getdate='.$tomorrows_date.'"><img src="styles/'.$style_sheet.'/right_day.gif" alt="" border="0" align="left"></a>'; ?></td>
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
		<td>
      		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="G10B">	
				<?php
					// The all day events returned here.
					if ($master_array[($getdate)]['-1']) {
						echo '<tr>'."\n";
						echo '<td colspan="3" height="24">'."\n";
						echo '<table width="100%" border="0" cellspacing="1" cellpadding="4">'."\n";
						foreach($master_array[($getdate)]['-1'] as $allday) {
							$all_day_text = $allday['event_text'];
							$description = $allday['description'];
							$event_text2 = urlencode(addslashes($all_day_text));
							$event_start = 'All';
							$event_end = 'Day';
					
							echo '<tr>'."\n";
							echo '<td valign="top" align="center" class="eventbg"><a class="psf" href="javascript:openEventInfo(\''.$event_text2.'\', \''.$calendar_name.'\', \''.$event_start.'\', \''.$event_end.'\', \''.$description.'\')"><font color="#ffffff"><i>'.$all_day_text.'</i></font></a></td>'."\n";
							echo '</tr>'."\n";
						}
						echo '</table>'."\n";
						echo '</td>'."\n";
						echo '</tr>'."\n";
					}
					?>

      			<tr>
					<td align="center" valign="top" colspan="3">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="60"><img src="images/spacer.gif" width="60" height="1" alt=""></td>
								<td width="1"></td>
								<?php for ($m=0;$m < $nbrGridCols;$m++) { 
									echo '<td><img src="images/spacer.gif" width="' . (520 / $nbrGridCols) . '" height="1" alt=""></td>';
								} ?>
							</tr>
							<?php
								// $master_array[($getdate)][$day_time]
								$event_length = array ();
								$border = 0;
								foreach ($day_array as $key) {
									$cal_time = $key;	
									$key = strtotime ($key);
									$key = date ($timeFormat, $key);
																		
									// check for eventstart 
									if (isset($master_array[($getdate)][$cal_time]) && sizeof($master_array[($getdate)][$cal_time]) > 0) {
										foreach ($master_array[($getdate)][$cal_time] as $eventKey => $loopevent) {
											$drawEvent = drawEventTimes ($loopevent['event_start'], $loopevent['event_end']);
											$j = 0;
											while ($event_length[$j]) {
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
										echo '<tr height="' . $gridLength . '">'."\n";
										echo '<td rowspan="' . (60 / $gridLength) . '" align="center" valign="top" width="60" class="timeborder">'.$key.'</td>'."\n";
										echo '<td width="1" height="' . $gridLength . '"></td>'."\n";
									} else {

										echo '<tr height="' . $gridLength . '">'."\n";
										echo '<td width="1" height="' . $gridLength . '"></td>'."\n";
									}
									if (sizeof($event_length) == 0) {
										if ($dayborder == 0) {
											$class = ' class="dayborder"';
											$dayborder++;
										} else {
											$class = ' class="dayborder2"';
											$dayborder = 0;
										}
										echo '<td bgcolor="#ffffff" colspan="' . $nbrGridCols . '" '.$class.'>&nbsp;</td>'."\n";
										
									} else {
										$emptyWidth = $nbrGridCols;
										for ($i=0;$i<sizeof($event_length);$i++) {
								//echo $master_array[($getdate)][$cal_time][($event_length[$i]['key'])]['event_text'] . ' ind: ' . $i . ' / anz: ' . $event_length[$i]['overlap'] . ' = ' . eventWidth($i,$event_length[$i]['overlap']) . '<br />';
											$drawWidth = $nbrGridCols / ($event_length[$i]['overlap'] + 1);
											//print $nbrGridCols.' -- ';
											//print $drawWidth;
											$emptyWidth = $emptyWidth - $drawWidth;
											switch ($event_length[$i]['state']) {
												case 'begin':
													$event_length[$i]['state'] = 'started';
													$event_text 	= $master_array[($getdate)][$cal_time][($event_length[$i]['key'])]['event_text'];
													$event_text2 	= addslashes($master_array[($getdate)][$cal_time][($event_length[$i]['key'])]['event_text']);
													$event_text2 	= urlencode($event_text2);
													$event_start 	= $master_array[($getdate)][$cal_time][($event_length[$i]['key'])]['event_start'];
													$event_end		= $master_array[($getdate)][$cal_time][($event_length[$i]['key'])]['event_end'];
													$description 	= addslashes($master_array[($getdate)][$cal_time][($event_length[$i]['key'])]['description']);
													$description	= urlencode($description);
													$event_start 	= strtotime ($event_start);
													$event_start 	= date ($timeFormat, $event_start);
													$event_end 		= strtotime ($event_end);
													$event_end 		= date ($timeFormat, $event_end);
													$calendar_name2	= addslashes($calendar_name);
													$calendar_name2 = urlencode($calendar_name2);
													echo '<td rowspan="' . $event_length[$i]['length'] . '" colspan="' . $drawWidth . '" align="left" valign="top" class="eventbg2">'."\n";
													echo '<table width="100%" border="0" cellspacing="0" cellpadding="2">'."\n";
													echo '<tr>'."\n";
													echo '<td class="eventborder"><font class="eventfont"><b>'.$event_start.'</b> - '.$event_end.'</font></td>'."\n";
													echo '</tr>'."\n";
													echo '<tr>'."\n";
													echo '<td>'."\n";
													echo '<table width="100%" border="0" cellpadding="1" cellspacing="0">'."\n";
													echo '<td class="eventbg"><a class="psf" href="javascript:openEventInfo(\''.$event_text2.'\', \''.$calendar_name2.'\', \''.$event_start.'\', \''.$event_end.'\', \''.$description.'\')"><font class="eventfont">'.$event_text.'</font></a></td>'."\n";
													echo '</tr>'."\n";
													echo '</table>'."\n";
													echo '</td>'."\n";           
													echo '</tr>'."\n";
													echo '</table>'."\n";
													echo '</td>'."\n";
													break;
												case 'started':
													break;
												case 'ended':
													echo '<td bgcolor="#ffffff" colspan="' . $drawWidth . '">&nbsp;</td>'."\n";
													break;
											}
											$event_length[$i]['length']--;
											if ($event_length[$i]['length'] == 0) {
												$event_length[$i]['state'] = 'ended';
											}
										}
										//fill emtpy space on the right
										if ($emptyWidth > 0) {
											echo '<td bgcolor="#ffffff" colspan="' . $emptyWidth . '">&nbsp;</td>'."\n";
										}
										while ($event_length[(sizeof($event_length) - 1)]['state'] == 'ended') {
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
		<td width="20"><img src="images/spacer.gif" width="20" height="1" alt=""></td>
		<td width="160" valign="top"><?php include('./sidebar.php'); ?><center>
		<?php echo '<font class="V9"><br>'.$powered_by_lang.' <a class="psf" href="http://phpicalendar.sourceforge.net/">PHP iCalendar '.$version_lang.'</a></font>'; ?></center></td>
	</tr>
</table>
</center>
</body>
</html>

