<?php


ereg ("([0-9]{4})([0-9]{2})([0-9]{2})", $getdate, $day_array2);
$this_day = $day_array2[3]; 
$this_month = $day_array2[2];
$this_year = $day_array2[1];

$check_week = strtotime($getdate);

$start_week_time = strtotime(dateOfWeek(date("Ymd", strtotime("$this_year-01-01")), $week_start_day));
$end_week_time = $start_week_time + (6 * 25 * 60 * 60);

print "<form>\n<select name=\"action\" class=\"query_style\" onChange=\"window.location=(this.options[this.selectedIndex].value);\">\n";

// build the <option> tags
do {
	$weekdate = date ("Ymd", $start_week_time);
	$select_week1 = localizeDate($dateFormat_week_jump, $start_week_time);
	$select_week2 = localizeDate($dateFormat_week_jump, $end_week_time);

	if (($check_week >= $start_week_time) && ($check_week <= $end_week_time)) {
		print "<option value=\"week.php?cal=$cal&getdate=$weekdate\" selected>$select_week1 - $select_week2</option>\n";
	} else {
		print "<option value=\"week.php?cal=$cal&getdate=$weekdate\">$select_week1 - $select_week2</option>\n";
	}
	$start_week_time =  strtotime ("+1 week", $start_week_time);
	$end_week_time = $start_week_time + (6 * 25 * 60 * 60);
} while (date("Y", $start_week_time) <= $this_year);

// finish <select>
print "</select>\n</form>";
?>