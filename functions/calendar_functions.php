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
	global $calendar_path, $blacklisted_cals, $list_webcals, $locked_cals, $locked_map, $error_path_lang, $error_restrictedcal_lang, $ALL_CALENDARS_COMBINED;

	// Create the list of available calendars.
	$calendars = array();

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
			
			// Exclude locked calendars.
			if (!$admin &&
				in_array($cal_name, $locked_cals) &&
				!in_array($cal_name, $unlocked_cals))
			{
				continue;
			}
			
			// Add this calendar.
			array_push($calendars, "$calendar_path/$file");
		}
		
		// Add web calendars.
		if (!$admin) {
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
		
		// Make sure this calendar is not locked.
		if (in_array($cal_filename, $locked_cals) &&
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
