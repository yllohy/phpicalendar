<?php

include "./config.inc.php";
if ($printview_default == 'yes') {
	$default_view = "print.php?printview=$default_view";
} else {
	$default_view = "$default_view" . ".php";
}
header("Location: $default_view");

?>