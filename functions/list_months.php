<?php

ereg ("([0-9]{4})([0-9]{2})([0-9]{2})", $getdate, $day_array2);
$this_day = $day_array2[3]; 
$this_month = $day_array2[2];
$this_year = $day_array2[1];

print "<form>\n<select name=\"action\" class=\"query_style\" onChange=\"window.location=(this.options[this.selectedIndex].value);\">\n";
$i = 0;
$month_time = mktime (0,0,0,1,$this_day,$this_year);
echo "$this_day, $this_year";
// build the <option> tags
while ($i != 12) {
	$monthdate = date ("Ymd", $month_time);
	$select_month = strftime($dateFormat_month, $month_time);
	if ($monthdate == $getdate) {
		print "<option value=\"month.php?cal=$cal&getdate=$monthdate\" selected>$select_month</option>\n";
	} else {
		print "<option value=\"month.php?cal=$cal&getdate=$monthdate\">$select_month</option>\n";
	}
	$month_time = strtotime ("+1 month", $month_time);
	$i++;	
}

// finish <select>
print "</select>\n</form>";
?>