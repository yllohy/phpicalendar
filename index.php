<?php

if (!isset($ALL_CALENDARS_COMBINED))  $ALL_CALENDARS_COMBINED = 'all_calendars_combined971';
include "./config.inc.php";
if (isset($HTTP_COOKIE_VARS['phpicalendar'])) {
	$phpicalendar 		= unserialize(stripslashes($HTTP_COOKIE_VARS['phpicalendar']));
	$default_view 		= $phpicalendar['cookie_view'];
}
if ($printview_default == 'yes') {
	$default_view = "print.php?printview=$default_view";
} else {
	$default_view = "$default_view" . ".php";
}
/*header("Location: $default_view");*/

include( $default_view );

?>