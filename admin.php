<?php
define('BASE', './');
require_once(BASE.'functions/admin_functions.php');
require_once(BASE.'functions/ical_parser.php');
require_once(BASE.'functions/template.php');
header("Content-Type: text/html; charset=$charset");

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
	$_SESSION['phpical_loggedin'] = FALSE;
	unset($_SESSION['phpical_username']);
	unset($_SESSION['phpical_password']);
}


// if $auth_method == 'none', don't do any authentication
if ($auth_method == "none") {
	$is_loged_in = TRUE;
} else {
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
	'todo_js'			=> BASE.'functions/todo.js',
	'charset'			=> $charset,
	'default_path'		=> '',
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
	'show_search' 		=> '',
	'l_day'				=> $lang['l_day'],
	'l_week'			=> $lang['l_week'],
	'l_month'			=> $lang['l_month'],
	'l_year'			=> $lang['l_year'],
	'l_admin_header'	=> $lang['l_admin_header'],
	'l_admin_subhead'	=> $lang['l_admin_subhead'],
	'l_invalid_login'	=> $lang['l_invalid_login'],
	'l_username'		=> $lang['l_username'],
	'l_password'		=> $lang['l_password'],
	'l_cal_file'		=> $lang['l_cal_file'],
	'l_delete_cal'		=> $lang['l_delete_cal'],
	'l_delete'			=> $lang['l_delete'],
	'l_logout'			=> $lang['l_logout'],
	'l_login'			=> $lang['l_login'],
	'l_submit'			=> $lang['l_submit'],
	'l_addupdate_cal'	=> $lang['l_addupdate_cal'],
	'l_addupdate_desc'	=> $lang['l_addupdate_desc'],
	'l_powered_by'		=> $lang['l_powered_by'],
	'l_this_site_is'	=> $lang['l_this_site_is']			
	));

$page->draw_admin();
$page->output();

?>




