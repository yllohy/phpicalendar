<?php

// This function returns a list of all calendars that the current user
// has access to. Basically, all local calendars found in the calendar
// directory, plus any webcals listed in the configuration file, but
// excluding blacklisted calendars and locked calendars which the user,
// if logged in, does not have access to.
//
// $username		= The username. Empty if no username provided.
// $password		= The password. Empty if no password provided.
// $cal_filename	= The calendar name without .ics.
// $admin			= True if this is an administrative request, in
//					  which case all local calendars only will be
//					  returned.
function availableCalendars($username, $password, $cal_filename, $admin = false) {
	// Import globals.
	global $calendar_path, $blacklisted_cals, $list_webcals, $locked_cals, $locked_map, $apache_map, $error_path_lang, $error_restrictedcal_lang, $error_invalidcal_lang, $ALL_CALENDARS_COMBINED, $_SERVER;

	// Create the list of available calendars.
	$calendars = array();

	// Grab any HTTP authentication.
	unset($http_user);
	if (isset($_SERVER['PHP_AUTH_USER'])) {
		$http_user = $_SERVER['PHP_AUTH_USER'];
	}

	// Grab the list of unlocked calendars.
	$unlocked_cals = array();
	if (isset($locked_map["$username:$password"])) {
		$unlocked_cals = $locked_map["$username:$password"];
	}
	
	// Include all local and web calendars if asking for all calendars
	// combined.
	if ($cal_filename == $ALL_CALENDARS_COMBINED || $admin) {
		// Add local calendars.
		$dir_handle = @opendir($calendar_path)
			or die(error(sprintf($error_path_lang, $calendar_path), $cal_filename));
		while (($file = readdir($dir_handle)) != false) {
			// Make sure this is not a dot file and it ends with .ics,
			// and that it is not blacklisted.
			if (!preg_match("/^[^.].+\.ics$/i", $file)) continue;
			$cal_name = substr($file, 0, -4);
			if (in_array($cal_name, $blacklisted_cals)) continue;

			// If HTTP authenticated, make sure this calendar is available
			// to the user.
			if (isset($http_user)) {
				if (!in_array($cal_name, $apache_map[$http_user])) continue;
			}
			
			// Otherwise exclude locked calendars.
			else if (!$admin &&
				in_array($cal_name, $locked_cals) &&
				!in_array($cal_name, $unlocked_cals))
			{
				continue;
			}
			
			// Add this calendar.
			array_push($calendars, "$calendar_path/$file");
		}
		
		// Add web calendars.
		if (!isset($http_user) && !$admin) {
			foreach ($list_webcals as $file) {
				// Make sure the URL ends with .ics.
				if (!preg_match("/.ics$/i", $file)) continue;
				
				// Add this calendar.
				array_push($calendars, $file);
			}
		}
	}
	
	// Otherwise just include the requested calendar.
	else {
		// Make sure this is not a blacklisted calendar. We don't have
		// to remove a .ics suffix because it would not have been passed
		// in the argument.
		if (in_array($cal_filename, $blacklisted_cals))
			exit(error($error_restrictedcal_lang, $cal_filename));

		// If HTTP authenticated, make sure this calendar is available
		// to the user.
		if (isset($http_user)) {
			if (!in_array($cal_filename, $apache_map[$http_user])) {
				// Use the invalid calendar message so that the user is
				// not made aware of locked calendars.
				exit(error($error_invalidcal_lang, $cal_filename));
			}
		}
		
		// Otherwise make sure this calendar is not locked.
		else if (in_array($cal_filename, $locked_cals) &&
			!in_array($cal_filename, $unlocked_cals))
		{
			// Use the invalid calendar message so that the user is
			// not made aware of locked calendars.
			exit(error($error_invalidcal_lang, $cal_filename));
		}
		
		// Add this calendar.
		array_push($calendars, "$calendar_path/$cal_filename.ics");
	}
	
	// Return the sorted calendar list.
	natcasesort($calendars);
	return $calendars;
}

// This function returns the result of the availableCalendars function
// but only includes the calendar filename (including the .ics) and not
// the entire path.
//
// $username		= The username. Empty if no username provided.
// $password		= The password. Empty if no password provided.
// $cal_filename	= The calendar name without .ics.
// $admin			= True if this is an administrative request, in
//					  which case all local calendars only will be
//					  returned.
function availableCalendarNames($username, $password, $cal_filename, $admin = false) {
	// Grab the available calendar paths.
	$calendars = availableCalendars($username, $password, $cal_filename, $admin);

	// Strip the paths off the calendars.
	foreach (array_keys($calendars) as $key) {
		$calendars[$key] = basename($calendars[$key]);
	}
	
	// Return the sorted calendar names.
	natcasesort($calendars);
	return $calendars;
}

// This function prints out the calendars available to the user, for
// selection. Should be enclosed within a <select>...</select>, which
// is not printed out by this function.
//
// $cals	= The calendars (entire path, e.g. from availableCalendars).
function display_ical_list($cals) {
	global $cal, $ALL_CALENDARS_COMBINED, $current_view, $getdate, $calendar_lang, $all_cal_comb_lang;

	// Print each calendar option.
	foreach ($cals as $cal_tmp) {
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
}