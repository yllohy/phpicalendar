<?php

// Configuration file for PHP iCalendar 0.9.2
//
// To set values, change the text between the single quotes
// Follow instructions to the right for detailed information

$style_sheet 			= 'silver';			// Themes support - silver, red, green, orange, grey, tan
$default_view 			= 'day';			// Default view for calendars = 'day', 'week', 'month', 'year'
$minical_view 			= 'current';		// Where do the mini-calendars go when clicked? = 'day', 'week', 'month', 'current'
$default_cal 			= 'all_calenders_combined971';		// Exact filename of calendar without .ics. Or set to 'all_calenders_combined971' to open all calenders combined into one.
$language 				= 'English';		// Language support - 'English', 'Polish', 'German', 'French', 'Dutch', 'Danish', 'Italian', 'Japanese', 'Norwegian', 'Spanish', 'Swedish', 'Portuguese', 'Catalan', 'Traditional_Chinese', 'Esperanto'
$week_start_day 		= 'Saturday';			// Day of the week your week starts on
$day_start 				= '0800';			// Start time for day grid
$gridLength 			= '15';				// Grid distance in minutes for day view, multiples of 15 preferred
$num_years 				= '3';				// Number of years to display in 'Jump to'
$month_event_lines 		= '1';				// Number of lines to wrap each event title in month view, 0 means display all lines.
$tomorrows_events_lines = '1';				// Number of lines to wrap each event title in the 'Tommorrow's events' box, 0 means display all lines.
$allday_week_lines 		= '1';				// Number of lines to wrap each event title in all-day events in week view, 0 means display all lines.
$week_events_lines 		= '1';				// Number of lines to wrap each event title in the 'Tommorrow's events' box, 0 means display all lines.
$timezone 				= '';				// Set timezone. Read TIMEZONES file for more information
$default_path			= 'http://www.example.com/phpicalendar'; 	// The HTTP URL to the PHP iCalendar directory, ie. http://www.example.com/phpicalendar
$tmp_dir				= '/tmp';			// The temporary directory on your system (/tmp is fine for UNIXes including Mac OS X)
$calendar_path 			= '';				// Leave this blank on most installs, place your full path to calendars if they are outside the phpicalendar folder.
$second_offset			= '0';				// The time in seconds between your time and your server's time.

// Advanced settings for custom installs, cookies, etc.
// In most cases these will not need to be set.
$cookie_uri				= ''; 				// The HTTP URL to the PHP iCalendar directory, ie. http://www.example.com/phpicalendar
$download_uri			= ''; 				// The HTTP URL to your calendars directory, ie. http://www.example.com/phpicalendar/calendars

// Yes/No questions --- 'yes' means Yes, anything else means no. 'yes' must be lowercase.
$save_parsed_cals 		= 'no';				// Recommended 'yes'. Saves a copy of the cal in /tmp after it's been parsed. Improves performence.
$use_sessions 			= 'no';				// This has not yet been implemented.
$display_custom_goto 	= 'no';				// In the 'Jump To' box, display the custom 'go to day' box.
$display_ical_list 		= 'yes';			// In the 'Jump To' box, display the pop-up menu with the list of all calendars in the $calendar_path directory.
$allow_webcals 			= 'no';				// Allow http:// and webcal:// prefixed URLs to be used as the $cal for remote viewing of "subscribe-able" calendars. This does not have to be enabled to allow specific ones below.
$this_months_events 	= 'yes';			// Display "This month's events" at the bottom off the month page.
$use_color_cals 		= 'yes';			// Display each calendar in the pop-up as a different color.
$daysofweek_dayview 	= 'no';				// Display the days of the week in day.php view.
$enable_rss				= 'yes';			// Enable RSS access to your calendars (good thing).
$show_search			= 'yes';				// Show the search box in the sidebar.
$header_always			= 'yes';			// Set to yes to have header on print.php
$allow_preferences		= 'yes';			// Allow visitors to change various preferences via cookies.
$printview_default		= 'no';				// Set print view as the default view. day, week, and month only supported views for $default_view (listed well above).
$show_todos				= 'yes';			// Show your todo list on the side of day and week view.
$show_completed			= 'yes';			// Show completed todos on your todo list.

// Administration settings
$allow_admin			= 'no';				// Set to yes to allow the admin page - remember to change the default password if using 'internal' as the $auth_method			
$auth_method			= 'ftp';			// Valid values are: 'ftp', 'internal', or 'none'. 'ftp' uses the ftp server's username and password as well as ftp commands to delete and copy files. 'internal' uses $auth_internal_username and $auth_internal_password defined below - CHANGE the password. 'none' uses NO authentication - meant to be used with another form of authentication such as http basic.
$auth_internal_username	= 'admin';			// Only used if $auth_method='internal'. The username for the administrator.
$auth_internal_password	= 'default';		// Only used if $auth_method='internal'. The password for the administrator.
$ftp_server				= 'localhost';		// Only used if $auth_method='ftp'. The ftp server name. 'localhost' will work for most servers.
$ftp_calendar_path		= '';				// Only used if $auth_method='ftp'. The full path to the calendar directory on the ftp server. If = '', will attempt to deduce the path based on $calendar_path, but may not be accurate depending on ftp server config.

$blacklisted_cals[] = '';					// Fill in between the quotes the name of the calendars 
$blacklisted_cals[] = '';					// you wish to 'blacklist' or that you don't want to show up in your calendar
$blacklisted_cals[] = '';					// list. This should be the exact calendar filename without .ics
$blacklisted_cals[] = '';					// the parser will *not* parse any cal that is in this list (it will not be Web accessible)
// add more lines as necessary

$list_webcals[] = '';						// Fill in between the quotes exact URL of a calendar that you wish
$list_webcals[] = '';						// to show up in your calendar list. You must prefix the URL with http://
$list_webcals[] = '';						// or webcal:// and the filename should contain the .ics suffix
$list_webcals[] = '';						// $allow_webcals does *not* need to be "yes" for these to show up and work
// add more lines as necessary

$color_cals[] = 'silver';					// Fill in between the quotes the colors you want to display
$color_cals[] = 'red';						// multiple calendars in.
$color_cals[] = 'orange';					// The first color will be used if no color is selected.
$color_cals[] = 'grey';						// 
$color_cals[] = 'green';					// 
$color_cals[] = 'tan';						// 
// add more lines as necessary
?>