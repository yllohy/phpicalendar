<?php
if ($display_ical_list == "yes") {
	// start of <select> tag
	echo "<select name=\"action\" class=\"query_style\" onChange=\"window.location=(this.options[this.selectedIndex].value+'";
	if (isset($query)) echo $query;
	echo "');\">";

	// Get all calendars.
	$all_cals = availableCalendars($username, $password, $ALL_CALENDARS_COMBINED);
	foreach ($all_cals as $cal_tmp) {
		// Format the calendar path for display.
		//
		// Only display the calendar name, replace all instances of "32" with " ",
		// and remove the .ics suffix.
		$cal_displayname_tmp = basename($cal_tmp);
		$cal_displayname_tmp = str_replace("32", " ", $cal_displayname_tmp);
		$cal_displayname_tmp = substr($cal_displayname_tmp, 0, -4);

		// If this is a webcal, add 'Webcal' to the display name.
		if (preg_match("/^(https?|webcal):\/\//i", $cal_tmp)) {
			$cal_displayname_tmp .= " Webcal";
		}

		// Otherwise, remove all the path information, since that should
		// not be used to identify local calendars. Also add the calendar
		// label to the display name.
		else {
			// Strip path and .ics suffix.
			$cal_tmp = basename($cal_tmp);
			$cal_tmp = substr($cal_tmp, 0, -4);

			// Add calendar label.
			$cal_displayname_tmp .= " $calendar_lang";
		}

		// Encode the calendar path.
		$cal_encoded_tmp = urlencode($cal_tmp);

		// Display the option.
		//
		// The submitted calendar will be encoded, and always use http://
		// if it is a webcal. So that is how we perform the comparison when
		// trying to figure out if this is the selected calendar.
		$cal_httpPrefix_tmp = str_replace('webcal://', 'http://', $cal_tmp);
		if ($cal_httpPrefix_tmp == urldecode($cal)) {
			print "<option value=\"$current_view.php?cal=$cal_encoded_tmp&amp;getdate=$getdate\" selected>$cal_displayname_tmp</option>";
		} else {
			print "<option value=\"$current_view.php?cal=$cal_encoded_tmp&amp;getdate=$getdate\">$cal_displayname_tmp</option>";	
		}
	}			

	// option to open all (non-web) calenders together
	if ($cal == $ALL_CALENDARS_COMBINED) {
		print "<option value=\"$current_view.php?cal=$ALL_CALENDARS_COMBINED&amp;getdate=$getdate\" selected>$all_cal_comb_lang</option>";
	} else {
		print "<option value=\"$current_view.php?cal=$ALL_CALENDARS_COMBINED&amp;getdate=$getdate\">$all_cal_comb_lang</option>";
	}
	
	// finish <select>
	print "</select>";
}
?>	
