<?php
if ($display_ical_list == "yes") {
	echo "<select name=\"action\" class=\"query_style\" onChange=\"window.location=(this.options[this.selectedIndex].value+'";
	if (isset($query)) echo $query;
	echo "');\">";
	
	// List the calendars.
	display_ical_list(availableCalendars($username, $password, $ALL_CALENDARS_COMBINED));
	
	print "</select>";
}
?>	
