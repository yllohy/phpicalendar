<?php

/*
Extension to PHP iCalendar for supporting publishing from Apple iCal
Date: 11.12.2003
Author: Dietrich Ayala
Copyright 2003 Dietrich Ayala

Description:
This allows iCal to publish to your PHP iCalendar site *without* WebDAV support.
This helps with commercial hosts where WebDAV is not available.

Features:
- supports publishing and deleting calendars
- does not require WebDAV

Installation:
1. place this file in your PHP iCalendar calendars directory (or anywhere else)
2. configure path to PHP iCalendar config file (below)
3. make sure that PHP has write access to the calendars directory (or whatever you set $calendar_path to)
4. set up directory security on your calendars directory

Usage:
1. Open iCal, select a calendar for publishing
2. Select "Publish" from the "Calendar" menu
3. Configure to your liking, and set the URL to (eg): http://localhost/~dietricha/calendar/calendars/publish.php
4. Click the "Publish" button

Security:
The calendars directory should be configured to require authentication. This can be done via any methods
supported by your webserver. There is much documentation available on the web for doing per-directory
authentication for Apache. This protects any private calendar data, and prevents unauthorized users
from updating or deleting your calendar data.
There's also code below that forwards any GET requests to the PHP iCalendar front page.

Troubleshooting:
You can turn on logging by setting the PHPICALENDAR_LOG_PUBLISHING constant to 1 below.
This will write out a log file to the same directory as this script.
Don't forget to turn off logging when done!!

*/

// include PHP iCalendar configuration variables
include('../config.inc.php');

// set calendar path, or just use current directory
$calendar_path = (isset($calendar_path) && $calendar_path != '') ? $calendar_path : '';

// toggle logging
define( 'PHPICALENDAR_LOG_PUBLISHING', 0 );

// viewing
if($_SERVER['REQUEST_METHOD'] == 'GET')
{
	header('Location: '.$default_path);
	return;
}

// unpublishing
if($_SERVER['REQUEST_METHOD'] == 'DELETE')
{
	// get calendar filename
	$calendar_file = $calendar_path.substr($_SERVER['REQUEST_URI'] , ( strrpos($_SERVER['REQUEST_URI'], '/') + 1) ) ;
	
	logmsg('received request to delete '.$calendar_file);
	
	// remove calendar file
	if(!unlink($calendar_file))
	{
		logmsg('unable to delete the calendar file');
	}
	else
	{
		logmsg('deleted');
	}
	return;
}

// publishing
if($_SERVER['REQUEST_METHOD'] == 'PUT')
{
	// get calendar data
	$fp = fopen('php://input','r');
	
	while(!feof($fp))
	{
		$data .= fgets($fp,4096);
	}
	
	fclose($fp);
	
	if(isset($data))
	{
		
		// get calendar name
		$cal_arr = explode("\n",$data);
		
		foreach($cal_arr as $k => $v)
		{
			if(strstr($v,'X-WR-CALNAME:'))
			{
				$arr = explode(':',$v);
				$calendar_name = trim($arr[1]);
				break;
			}
		}
		
		$calendar_name = isset($calendar_name) ? $calendar_name : 'default';
		
		// write to file
		if($fp = fopen($calendar_path.$calendar_name.'.ics','w+'))
		{
			fputs($fp, $data, strlen($data) );
			fclose($fp);
		}
		else
		{
			logmsg( 'couldnt open file '.$calendar_path.$calendar_name.'.ics' );
		}
	}
}

// for logging
function logmsg($str){
	if(defined('PHPICALENDAR_LOG_PUBLISHING') && PHPICALENDAR_LOG_PUBLISHING == 1)
	{
		if($fp = fopen('publish_log.txt','a+'))
		{
			$str .= "\n";
			fputs($fp, $str, strlen($str) );
			fclose($fp);
		}
	}
}
?>
