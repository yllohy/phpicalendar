<?php

$style_sheet = 'silver';				// Themes support
$calendar_path = './calendars';			// path to directory with calendars
$default_view = 'day';					// default view for calendars = 'day', 'week', 'month'
$default_cal = 'Home';					// exact filename of calendar without .ics
$language = 'english';					// Language support - 'English', 'Polish', 'German', 'French', 'Dutch', 'Danish', 'Italian', 'Japanese', 'Norwegian'
$week_start_day = 'sunday';				// Day of the week your week starts on
$day_start = '0700';					// Start time for day grid
$gridLength = '15';						// grid distance in minutes for day view, multiples of 15 preferred

// Yes/No questions --- 'yes' means Yes, anything else means no. 'yes' must be lowercase.
$use_sessions = 'yes';					// For speedy performance on web servers, not good for localhost use. This has not yet been implemented.
$display_custom_goto = 'no';			// in the 'Jump To' box, display the custom 'go to day' box.
$display_ical_list = 'yes';				// in the 'Jump To' box, display the pop-up menu with the list of all calendars in the $calendar_path directory.
$allow_webcals = 'yes';					// Allow http:// and webcal:// prefixed URLs to be used as the $cal for remote viewing of "subscribe-able" calendars. This does not have to be enabled to allow specific ones below.
										
$blacklisted_cals[] = '';				// fill in between the quotes the name of the calendars 
$blacklisted_cals[] = '';				// you wish to 'blacklist' or that you don't want to show up in your calendar
$blacklisted_cals[] = '';				// list. This should be the exact calendar filename without .ics
$blacklisted_cals[] = '';				// The parser will *not* parse any cal that is in this list (it will not be Web accessible)
// add more lines as necessary

$list_webcals[] = '';					// fill in between the quotes exact URL of a calendar that you wish
$list_webcals[] = '';					// to show up in your calendar list. You must prefix the URL with http://
$list_webcals[] = '';					// or webcal:// and the filename should contain the .ics suffix
$list_webcals[] = '';					// $allow_webcals does *not* need to be "yes" for these to show up and work
// add more lines as necessary

?>