<?php
print "<form>\n<select name=\"action\" class=\"query_style\" onChange=\"window.location=(this.options[this.selectedIndex].value);\">\n";
$month_time = strtotime("$this_year-01-01");
$getdate_month = date("m", strtotime($getdate));

// echo "$this_day, $this_year";
// build the <option> tags
for ($i=0; $i<12; $i++) {
	$monthdate = date ("Ymd", $month_time);
	$month_month = date("m", $month_time);
	$select_month = localizeDate($dateFormat_month, $month_time);
	if ($month_month == $getdate_month) {
		print "<option value=\"month.php?cal=$cal&amp;getdate=$monthdate\" selected>$select_month</option>\n";
	} else {
		print "<option value=\"month.php?cal=$cal&amp;getdate=$monthdate\">$select_month</option>\n";
	}
	$month_time = strtotime ("+1 month", $month_time);
}

// finish <select>
print "</select>\n</form>";
?>