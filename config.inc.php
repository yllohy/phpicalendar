<?php

// Configuration file for PHP iCalendar 0.6
//
// To set values, change the text between the single quotes
// Follow instructions to the right for detailed information

$style_sheet = 'silver';				// Themes support
$calendar_path = './calendars';			// Path to directory with calendars
$default_view = 'day';					// Default view for calendars = 'day', 'week', 'month', 'year'
$minical_view = 'current';				// Where do the mini-calendars go when clicked? = 'day', 'week', 'month', 'current'
$default_cal = 'Home';					// Exact filename of calendar without .ics
$language = 'English';					// Language support - 'English', 'Polish', 'German', 'French', 'Dutch', 'Danish', 'Italian', 'Japanese', 'Norwegian', 'Spanish'
$week_start_day = 'Sunday';				// Day of the week your week starts on
$day_start = '0700';					// Start time for day grid
$gridLength = '15';						// Grid distance in minutes for day view, multiples of 15 preferred
$month_event_lines = '1';				// Number of lines to wrap each event title in month view, 0 means display all lines.
$tomorrows_events_lines = '1';			// Number of lines to wrap each event title in the 'Tommorrow's events' box, 0 means display all lines.
$allday_week_lines = '1';				// Number of lines to wrap each event title in all-day events in week view, 0 means display all lines.
$week_events_lines = '1';				// Number of lines to wrap each event title in the 'Tommorrow's events' box, 0 means display all lines.

// Yes/No questions --- 'yes' means Yes, anything else means no. 'yes' must be lowercase.
$save_parsed_cals = 'no';				// Recommended 'yes'. Saves a copy of the cal in /tmp after it's been parsed. Improves performence.
$use_sessions = 'yes';					// This has not yet been implemented.
$display_custom_goto = 'no';			// In the 'Jump To' box, display the custom 'go to day' box.
$display_ical_list = 'yes';				// In the 'Jump To' box, display the pop-up menu with the list of all calendars in the $calendar_path directory.
$allow_webcals = 'no';					// Allow http:// and webcal:// prefixed URLs to be used as the $cal for remote viewing of "subscribe-able" calendars. This does not have to be enabled to allow specific ones below.
$this_months_events = 'yes';			// Display "This month's events" at the bottom off the month page.
										
$blacklisted_cals[] = '';				// Fill in between the quotes the name of the calendars 
$blacklisted_cals[] = '';				// you wish to 'blacklist' or that you don't want to show up in your calendar
$blacklisted_cals[] = '';				// list. This should be the exact calendar filename without .ics
$blacklisted_cals[] = '';				// the parser will *not* parse any cal that is in this list (it will not be Web accessible)
// add more lines as necessary

$list_webcals[] = 'webcal://ical.mac.com/ical/Movies.ics';					// Fill in between the quotes exact URL of a calendar that you wish
$list_webcals[] = 'webcal://phpicalendar.sourceforge.net/phpicalendar-0.6/calendars/Jareds32Classes.ics';					// to show up in your calendar list. You must prefix the URL with http://
$list_webcals[] = '';					// or webcal:// and the filename should contain the .ics suffix
$list_webcals[] = '';					// $allow_webcals does *not* need to be "yes" for these to show up and work
// add more lines as necessary

?>