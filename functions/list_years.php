<?php

$year_time = strtotime("$getdate");
$getdate_year = date("Y", strtotime($getdate));
$num_years2 = $num_years;
//echo "$num_years2";
print "<form action=\"day.php\" method=\"GET\">\n<select name=\"action\" class=\"query_style\" onChange=\"window.location=(this.options[this.selectedIndex].value);\">\n";
// build the <option> tags
for ($i=0; $i < ($num_years2 +2); $i++) {
	$year_time2 = strtotime ("-$num_years2 year", $year_time);
	$yeardate = date("Ymd", $year_time2);
	$year_year = date ("Y", $year_time2);
	print "<option value=\"year.php?cal=$cal&amp;getdate=$yeardate\">$year_year</option>\n";
	$num_years2--;
}
$year_time = strtotime("$this_year-01-01");
$getdate_year = date("Y", strtotime($getdate));
for ($i=0; $i < ($num_years +1); $i++) {
	$year_year = date ("Y", $year_time);
	$yeardate = date("Ymd", $year_time);
	if ($year_year == $getdate_year) {
		print "<option value=\"year.php?cal=$cal&amp;getdate=$yeardate\" selected>$year_year</option>\n";
	} else {
		print "<option value=\"year.php?cal=$cal&amp;getdate=$yeardate\">$year_year</option>\n";
	}
	$year_time = strtotime ("+1 year", $year_time);
}

// finish <select>
print "</select>\n</form>";
?>