<?php


ereg ("([0-9]{4})([0-9]{2})([0-9]{2})", $getdate, $day_array2);
$this_day = $day_array2[3]; 
$this_month = $day_array2[2];
$this_year = $day_array2[1];
$i = 0;
$check_week = strtotime($getdate);
$week_time = sundayOfWeek($this_year,"1","1");
$start_week_time = strtotime(dateOfWeek($week_time, substr($week_start_day, 0, 2)));
$end_week_time2 = $start_week_time + (6 * 25 * 60 * 60);
$week_time = $start_week_time;

print "<form>\n<select name=\"action\" class=\"query_style\" onChange=\"window.location=(this.options[this.selectedIndex].value);\">\n";

// build the <option> tags
do {
	$weekdate = date ("Ymd", $week_time);
	$select_week1 = strftime($dateFormat_week_jump, $start_week_time);
	$select_week2 = strftime($dateFormat_week_jump, $end_week_time);

	if (($check_week >= $start_week_time) && ($check_week <= $end_week_time)) {
		print "<option value=\"week.php?cal=$cal&getdate=$weekdate\" selected>$select_week1 - $select_week2</option>\n";
	} else {
		print "<option value=\"week.php?cal=$cal&getdate=$weekdate\">$select_week1 - $select_week2</option>\n";
	}
	$week_time = strtotime ("+1 week", $week_time);
	$week_year = date("Y", $month_time);
	$wDay = date ("d", $week_time);
	$wMonth = date ("m", $week_time); 
	$start_week_time = sundayOfWeek($this_year,$wMonth,$wDay);
	$start_week_time = strtotime($start_week_time);
	$end_week_time = $start_week_time + (6 * 25 * 60 * 60);
	$i++;	
} while (((date("Y", $start_week_time)) == $this_year) && ($i > 0));

// finish <select>
print "</select>\n</form>";
?>