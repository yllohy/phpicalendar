<?php
session_start();

define('BASE', './');
require_once(BASE.'functions/init.inc.php');
require_once(BASE.'functions/admin_functions.php');
require_once(BASE.'functions/list_functions.php');
require_once(BASE.'functions/template.php');

// Redirect if administration is not allowed
if ($allow_admin != "yes") {
	header("Location: index.php");
	die();
}

// Load variables from forms and query strings into local scope
if($HTTP_POST_VARS) 	{extract($HTTP_POST_VARS, EXTR_PREFIX_SAME, "post_");}
if($HTTP_GET_VARS)  	{extract($HTTP_GET_VARS, EXTR_PREFIX_SAME, "get_");}

if (!isset($action)) $action = '';

// Logout by clearing session variables
if ((isset($action)) && ($action == "logout")) {
	$HTTP_SESSION_VARS['phpical_loggedin'] = FALSE;
	unset($HTTP_SESSION_VARS['phpical_username']);
	unset($HTTP_SESSION_VARS['phpical_password']);
}


// if $auth_method == 'none', don't do any authentication
if ($auth_method == "none") {
	$is_loged_in = TRUE;
}
// Check if The User is Identified
else {
	$is_loged_in = FALSE;
	
	if (is_loggedin()) {
		$is_loged_in = TRUE;
	}
	if (isset($username) && $action != "logout") {
		$is_loged_in = login ($username, $password);
	}
}

$calendar_name = $lang['l_admin_header'];

$page = new Page(BASE.'templates/'.$template.'/admin.tpl');

$page->replace_tags(array(
	'header'			=> BASE.'templates/'.$template.'/header.tpl',
	'footer'			=> BASE.'templates/'.$template.'/footer.tpl',
	'sidebar'			=> BASE.'templates/'.$template.'/sidebar.tpl',
	'event_js'			=> BASE.'functions/event.js',
	'template'			=> $template,
	'cal'				=> $cal,
	'getdate'			=> $getdate,
	'calendar_name'		=> $calendar_name,
	'display_date'		=> $display_date,
	'current_view'		=> $current_view,
	'sidebar_date'		=> $sidebar_date,
	'rss_powered'	 	=> $rss_powered,
	'rss_available' 	=> '',
	'rss_valid' 		=> '',
	'todo_js' 			=> '',
	'show_search' 		=> ''		
	));

$page->output();

?>




