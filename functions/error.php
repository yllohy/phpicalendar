<?php
if (!defined('BASE')) define('BASE','../');
require_once(BASE.'config.inc.php');
require_once(BASE.'functions/init.inc.php');
require_once(BASE.'functions/template.php');

function error($error_msg='There was an error processing the request.', $file='NONE') {
	global $template, $language, $enable_rss, $lang;
	if (!isset($template))					$template = 'default';
	if (!isset($lang['l_powered_by']))		$lang['l_powered_by'] = 'Powered by';
	if (!isset($lang['l_error_title']))		$lang['l_error_title'] = 'Error!';
	if (!isset($lang['l_error_window']))	$lang['l_error_window'] = 'There was an error!';
	if (!isset($lang['l_error_calendar']))	$lang['l_error_calendar'] = 'The calendar "%s" was being processed when this error occurred.';
	if (!isset($lang['l_error_back']))		$lang['l_error_back'] = 'Please use the "Back" button to return.';
	if (!isset($lang['l_this_site_is']))	$lang['l_this_site_is'] = 'This site is';
	if (!isset($enable_rss))				$enable_rss = 'no';
		
	$error_calendar 	= sprintf($lang['l_error_calendar'], $file);
	$current_view 		= 'error';
	$display_date 		= $lang['l_error_title'];
	$calendar_name 		= $lang['l_error_title'];	
	
	$page = new Page(BASE.'templates/'.$template.'/error.tpl');

	$page->replace_tags(array(
		'header'			=> BASE.'templates/'.$template.'/header.tpl',
		'footer'			=> BASE.'templates/'.$template.'/footer.tpl',
		'calendar_nav'		=> BASE.'templates/'.$template.'/calendar_nav.tpl',
		'default_path'		=> '',
		'template'			=> $template,
		'cal'				=> $cal,
		'getdate'			=> $getdate,
		'calendar_name'		=> $calendar_name,
		'display_date'		=> $display_date,
		'rss_powered'	 	=> $rss_powered,
		'rss_available' 	=> '',
		'event_js'			=> '',
		'todo_js'			=> '',
		'todo_available' 	=> '',
		'rss_valid' 		=> '',
		'error_msg'	 		=> $error_msg,
		'error_calendar' 	=> $error_calendar,
		'generated'	 		=> $generated,
		'l_powered_by'		=> $lang['l_powered_by'],
		'l_error_back'		=> $lang['l_error_back'],
		'l_error_window'	=> $lang['l_error_window']
				
		));
		
	$page->output();

	

}

?>