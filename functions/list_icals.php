<?php
if ($display_ical_list == "yes") {

	// start of <select> tag
	if (isset($getdate)) {
		$query="&getdate=$getdate";
	} else {
		$query="";
	}
	print "<form>\n<select name=\"action\" class=\"query_style\" onChange=\"window.location=(this.options[this.selectedIndex].value+'$query');\">\n";
	
	// open file
	$dir_handle = @opendir($calendar_path) or die(error(sprintf($error_path_lang, $calendar_path), $cal_filename));
	
	// build the <option> tags
	while ($file = readdir($dir_handle)) {
		if (substr($file, -4) == ".ics") {
			
			// $cal_filename is the filename of the calendar without .ics
			// $cal is a urlencoded version of $cal_filename
			// $cal_displayname is $cal_filename with occurrences of "32" replaced with " "
			$cal_filename_tmp = substr($file,0,-4);
			$cal_tmp = urlencode($cal_filename_tmp);
			$cal_displayname_tmp = str_replace("32", " ", $cal_filename_tmp);
			if (!in_array($cal_filename_tmp, $blacklisted_cals)) {
				if ($cal_tmp == $cal) {
					print "<option value=\"$current_view.php?cal=$cal_tmp\" selected>$cal_displayname_tmp $calendar_lang</option>\n";
				} else {
					print "<option value=\"$current_view.php?cal=$cal_tmp\">$cal_displayname_tmp $calendar_lang</option>\n";	
				}		
			}	
		}
	}			
	foreach($list_webcals as $cal_tmp) {
		if ($cal_tmp != '') {
			$cal_displayname_tmp = basename($cal_tmp);
			$cal_displayname_tmp = str_replace("32", " ", $cal_displayname_tmp);
			$cal_displayname_tmp = substr($cal_displayname_tmp,0,-4);
			$cal_encoded_tmp = urlencode($cal_tmp);
			if ($cal_tmp == $cal_httpPrefix || $cal_tmp == $cal_webcalPrefix) {
				print "<option value=\"$current_view.php?cal=$cal_encoded_tmp\" selected>$cal_displayname_tmp Webcal</option>\n";
			} else {
				print "<option value=\"$current_view.php?cal=$cal_encoded_tmp\">$cal_displayname_tmp Webcal</option>\n";	
			}		
		}
	}
	
	
	// close file
	closedir($dir_handle);
	
	// finish <select>
	print "</select>\n</form>";
	
}
?>	