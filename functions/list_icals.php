<?php
if ($display_ical_list == "yes") {
	echo "<select name=\"action\" class=\"query_style\" onChange=\"window.location=(this.options[this.selectedIndex].value+'";
	if (isset($query)) echo $query;
	echo "');\">";

	$all_cals = availableCalendars($username, $password, $ALL_CALENDARS_COMBINED);
	foreach ($all_cals as $cal_tmp) {
		$cal_displayname_tmp = basename($cal_tmp);
		$cal_displayname_tmp = str_replace("32", " ", $cal_displayname_tmp);
		$cal_displayname_tmp = substr($cal_displayname_tmp, 0, -4);

		if (preg_match("/^(https?|webcal):\/\//i", $cal_tmp)) {
			$cal_displayname_tmp .= " Webcal";
		} else {
			$cal_tmp = basename($cal_tmp);
			$cal_tmp = substr($cal_tmp, 0, -4);
			$cal_displayname_tmp .= " $calendar_lang";
		}
		$cal_encoded_tmp = urlencode($cal_tmp);
		$cal_httpPrefix_tmp = str_replace('webcal://', 'http://', $cal_tmp);
		if ($cal_httpPrefix_tmp == urldecode($cal)) {
			print "<option value=\"$current_view.php?cal=$cal_encoded_tmp&amp;getdate=$getdate\" selected>$cal_displayname_tmp</option>";
		} else {
			print "<option value=\"$current_view.php?cal=$cal_encoded_tmp&amp;getdate=$getdate\">$cal_displayname_tmp</option>";	
		}
	}			
	if ($cal == $ALL_CALENDARS_COMBINED) {
		print "<option value=\"$current_view.php?cal=$ALL_CALENDARS_COMBINED&amp;getdate=$getdate\" selected>$all_cal_comb_lang</option>";
	} else {
		print "<option value=\"$current_view.php?cal=$ALL_CALENDARS_COMBINED&amp;getdate=$getdate\">$all_cal_comb_lang</option>";
	}
	
	print "</select>";
}
?>	
