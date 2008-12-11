<?php
if (!defined('BASE')) define('BASE', './');
include_once(BASE.'functions/init.inc.php');

if ($phpiCal_config->printview_default == 'yes') {
	$printview = $phpiCal_config->default_view;
	$phpiCal_config->setProperty('default_view', "print.php");
} else {
	$check = array ('day', 'week', 'month', 'year');
	if (in_array($phpiCal_config->default_view, $check)) {
		$phpiCal_config->setProperty('default_view', $phpiCal_config->default_view . '.php');
	} else {
		die('illegal view');
	}
}
if(isset($_GET['cpath'])){
	$phpiCal_config->default_view .= '?cpath='.$_GET['cpath'];
}
header("Location: $phpiCal_config->default_view");

?>
