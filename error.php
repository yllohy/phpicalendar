<?php
if (!defined('BASE')) define('BASE','./');
require_once(BASE.'functions/template.php');


function error($error_msg='There was an error processing the request.', $file='NONE', $error_base='') {
	global $getdate, $rss_powered, $lang, $phpiCal_config, $cal;
	if (!isset($template))					$template = $phpiCal_config->template;
		
	$error_calendar 	= sprintf($lang['l_error_calendar'], print_r($file,true));
	$current_view 		= 'error';
	$display_date 		= $lang['l_error_title'];
	$calendar_name 		= $lang['l_error_title'];
	
	$default_path = $phpiCal_config->default_path;
	if (empty($phpiCal_config->default_path)) {
		if (isset($_SERVER['HTTPS']) || strtolower($_SERVER['HTTPS']) == 'on' ) {
			$default_path = 'https://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].substr($_SERVER['PHP_SELF'],0,strpos($_SERVER['PHP_SELF'],'/rss/'));
		} else {
			$default_path = 'http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].substr($_SERVER['PHP_SELF'],0,strpos($_SERVER['PHP_SELF'],'/rss/'));
		}
	}
	$page = new Page(BASE.'templates/'.$template.'/error.tpl');
	
	$page->replace_files(array(
	'header'			=> BASE.'templates/'.$template.'/header.tpl',
	'footer'			=> BASE.'templates/'.$template.'/footer.tpl',
	));

	$page->replace_tags(array(
		'version'			=> $phpiCal_config->phpicalendar_version,
		'default_path'		=> $phpiCal_config->default_path.$error_base,
		'template'			=> $template,
		'cal'				=> $cal,
		'getdate'			=> $getdate,
		'charset'			=> $phpiCal_config->charset,
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
		'l_powered_by'		=> $lang['l_powered_by'],
		'l_error_back'		=> $lang['l_error_back'],
		'l_error_window'	=> $lang['l_error_window'],
		'l_this_site_is'	=> $lang['l_this_site_is']			
				
		));
		
	$page->output();

	

}

?>