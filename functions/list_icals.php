<?php
if ($display_ical_list == "yes") {

	// start of <select> tag
	if (isset($getdate)) {
		$query="&amp;getdate=$getdate";
	} else {
		$query="";
	}	
	// open file
	$dir_handle = @opendir($calendar_path) or die(error(sprintf($error_path_lang, $calendar_path), $cal_filename));
	
	// empty the filelist array
	$filelist = array();

	// build the <option> tags
	while (false != ($file = readdir($dir_handle))) {
		if (preg_match("/^[^.].+\.ics$/", $file)) {
			array_push($filelist, $file);
		}
	}
	natcasesort($filelist);
	foreach ($filelist as $file) {
		
		// $cal_filename is the filename of the calendar without .ics
		// $cal is a urlencoded version of $cal_filename
		// $cal_displayname is $cal_filename with occurrences of "32" replaced with " "
		$cal_filename_tmp = substr($file,0,-4);
		$cal_tmp = urlencode($cal_filename_tmp);
		$cal_displayname_tmp = str_replace("32", " ", $cal_filename_tmp);
		if (!in_array($cal_filename_tmp, $blacklisted_cals)) {
			if ($cal_tmp == $cal) {
				print "<option value=\"$current_view.php?cal=$cal_tmp&amp;getdate=$getdate\" selected>$cal_displayname_tmp $calendar_lang</option>";
			} else {
				print "<option value=\"$current_view.php?cal=$cal_tmp&amp;getdate=$getdate\">$cal_displayname_tmp $calendar_lang</option>";	
			}
		}	
	}			

	// option to open all (non-web) calenders together
	if ($cal == $ALL_CALENDARS_COMBINED) {
		print "<option value=\"$current_view.php?cal=$ALL_CALENDARS_COMBINED&amp;getdate=$getdate\" selected>$all_cal_comb_lang</option>";
	} else {
		print "<option value=\"$current_view.php?cal=$ALL_CALENDARS_COMBINED&amp;getdate=$getdate\">$all_cal_comb_lang</option>";
	}
		
	foreach($list_webcals as $cal_tmp) {
		if ($cal_tmp != '') {
			$cal_displayname_tmp = basename($cal_tmp);
			$cal_displayname_tmp = str_replace("32", " ", $cal_displayname_tmp);
			$cal_displayname_tmp = substr($cal_displayname_tmp,0,-4);
			$cal_encoded_tmp = urlencode($cal_tmp);
			if ($cal_tmp == $cal_httpPrefix || $cal_tmp == $cal_webcalPrefix) {
				print "<option value=\"$current_view.php?cal=$cal_encoded_tmp&amp;getdate=$getdate\" selected>$cal_displayname_tmp Webcal</option>";
			} else {
				print "<option value=\"$current_view.php?cal=$cal_encoded_tmp&amp;getdate=$getdate\">$cal_displayname_tmp Webcal</option>";	
			}		
		}
	}

	// close file
	closedir($dir_handle);
	
	// finish <select>
	print "</select>";
	
}


?>	
