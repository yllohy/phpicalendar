<?php

// start of <select> tag
if (isset($getdate)) {
	$query="&getdate=$getdate";
} else {
	$query="";
}
print "<form>\n<select name=\"action\" class=\"query_style\" onChange=\"window.location=(this.options[this.selectedIndex].value+'$query');\">\n";
#print "<option value=\"null\">Select a Calendar</option>\n";

// open file
$dir_handle = @opendir($calendar_path) or die("Unable to open $calendar_path");

// build the <option> tags
while ($file = readdir($dir_handle)) {
	if (strstr ($file, ".ics")) {
		// $cal_filename is the filename of the calendar without .ics
		// $cal is a urlencoded version of $cal_filename
		// $cal_displayname is $cal_filename with occurrences of "32" replaced with " "
		$cal_filename = substr($file,0,-4);
		$cal_tmp = urlencode($cal_filename);
		$cal_displayname = str_replace("32", " ", $cal_filename);
		
		if ($cal_tmp == $cal) {
			print "<option value=\"$current_view.php?cal=$cal_tmp\" selected>$cal_displayname Calendar</option>\n";
		} else {
			print "<option value=\"$current_view.php?cal=$cal_tmp\">$cal_filename Calendar</option>\n";	
		}
		
	}
}

// close file
closedir($dir_handle);

// finish <select>
print "</select>\n</form>";
?>