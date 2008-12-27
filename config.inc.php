<?php
/* Customizing phpicalendar configuration:

phpicalendar 2.3 should work with no additional configuration. This file can be changed to customize the behavior of phpicalendar.
In version 2.3, there has been a change in the way configuration works in order to reduce the number of confusing global variables.  Unfortunately, this means that config.inc.php files from older installations will have to be translated to the new format.  The conversion is simple: use the old variable names as array keys for the $configs array below:
*/
$secs = 6*60*60;
$configs = array(
#	'calendar_path'	=>	'/Library/WebServer/Documents/phpicalendar/calendars',
#	'timezone'	=> 'US/Central', 
#	'allow_admin'	=> 'yes', 
#	'allow_login'	=> 'yes', 
	'allow_preferences'	=> 'yes', 
	'show_search'	=> 'yes',
#	'show_todos'	=> 'no',
	'show_completed'	=> 'no',
#	'timezone'	=> 'US/Central',
#	'timezone'	=> 'America/Bogota',
#	'timezone'	=> 'Europe/Paris',
#	'gridLength' => 5,
#	'second_offset'	=> $secs,
#	'cookie_uri'	=> '' 
);

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

#$more_webcals['cpath'][] = ''				//add webcals that will show up only for a particular cpath.

$locked_cals[] = '';						// Fill in-between the quotes the names of the calendars you wish to hide
$locked_cals[] = '';						// unless unlocked by a username/password login. This should be the
$locked_cals[] = '';						// exact calendar filename without the .ics suffix.
$locked_cals[] = '';						//
// add more lines as necessary

$locked_map['user1:pass'] = array('');		// Map username:password accounts to locked calendars that should be
$locked_map['user2:pass'] = array('');		// unlocked if logged in. Calendar names should be the same as what is
$locked_map['user3:pass'] = array('');		// listed in the $locked_cals, again without the .ics suffix.
$locked_map['user4:pass'] = array('');		// Example: $locked_map['username:password'] = array('Locked1', 'Locked2');
// add more lines as necessary

$apache_map['user1'] = array('');			// Map HTTP authenticated users to specific calendars. Users listed here and
$apache_map['user2'] = array('');			// authenticated via HTTP will not see the public calendars, and will not be
$apache_map['user3'] = array('');			// given any login/logout options. Calendar names not include the .ics suffix.
$apache_map['user4'] = array('');			// Example: $apache_map['username'] = array('Calendar1', 'Calendar2');
