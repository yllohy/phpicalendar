<?php

$year_time = strtotime($getdate);
print "<select name=\"action\" class=\"query_style\" onChange=\"window.location=(this.options[this.selectedIndex].value);\">\n";

// Print the previous year options.
for ($i=0; $i < $num_years; $i++) {
	$offset = $num_years - $i;
	$prev_time = strtotime("-$offset year", $year_time);
	$prev_date = date("Ymd", $prev_time);
	$prev_year = date("Y", $prev_time);
	print "<option value=\"year.php?cal=$cal&amp;getdate=$prev_date\">$prev_year</option>\n";
}

// Print the current year option.
$getdate_date = date("Ymd", $year_time);
$getdate_year = date("Y", $year_time);
print "<option value=\"year.php?cal=$cal&amp;getdate=$getdate_date\" selected>$getdate_year</option>\n";

// Print the next year options.
for ($i=0; $i < $num_years; $i++) {
	$offset = $i + 1;
	$next_time = strtotime("+$offset year", $year_time);
	$next_date = date("Ymd", $next_time);
	$next_year = date("Y", $next_time);
	print "<option value=\"year.php?cal=$cal&amp;getdate=$next_date\">$next_year</option>\n";
}

// finish <select>
print "</select>";
?>
