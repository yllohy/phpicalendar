<?php
class Configs{
	private static $instance;
	private function __construct(){
		$this->phpicalendar_version = '2.4';
	// Configuration file for PHP iCalendar 2.4
	//
	// To set values, change the text between the single quotes
	// Follow instructions to the right for detailed information
#=================Initialize global variables=================================
// Define some magic strings.
		$this->ALL_CALENDARS_COMBINED = 'all_calendars_combined971';
		$this->template 				= 'default';		// Template support
		$this->default_view 			= 'day';			// Default view for calendars = 'day', 'week', 'month', 'year'
		$this->minical_view 			= 'current';		// Where do the mini-calendars go when clicked? = 'day', 'week', 'month', 'current'
		$this->default_cal 				= $this->ALL_CALENDARS_COMBINED;		// Exact filename of calendar without .ics. Or set to $this->ALL_CALENDARS_COMBINED to open all calenders combined into one.
		$this->language 				= 'English';		// Language support - 'English', 'Polish', 'German', 'French', 'Dutch', 'Danish', 'Italian', 'Japanese', 'Norwegian', 'Spanish', 'Swedish', 'Portuguese', 'Catalan', 'Traditional_Chinese', 'Esperanto', 'Korean'
		$this->week_start_day 			= 'Sunday';			// Day of the week your week starts on
		$this->week_length				= '7';				// Number of days to display in the week view
		$this->day_start 				= '0600';			// Start time for day grid
		$this->day_end					= '2000';			// End time for day grid
		$this->gridLength 				= '15';				// Grid distance in minutes for day view, multiples of 15 preferred
		$this->num_years 				= '1';				// Number of years (up and back) to display in 'Jump to'
		$this->month_event_lines 		= '0';				// Number of lines to wrap each event title in month view, 0 means display all lines.
		$this->tomorrows_events_lines 	= '1';				// Number of lines to wrap each event title in the 'Tommorrow's events' box, 0 means display all lines.
		$this->allday_week_lines 		= '1';				// Number of lines to wrap each event title in all-day events in week view, 0 means display all lines.
		$this->week_events_lines 		= '1';				// Number of lines to wrap each event title in the 'Tommorrow's events' box, 0 means display all lines.
		$this->timezone 				= '';				// Set timezone. Read TIMEZONES file for more information
		$this->calendar_path 			= '';				// Leave this blank on most installs, place your full FILE SYSTEM PATH to calendars if they are outside the phpicalendar folder.
		$this->second_offset			= '';				// The time in seconds between your time and your server's time.
		$this->bleed_time				= '-1';				// This allows events past midnight to just be displayed on the starting date, only good up to 24 hours. Range from '0000' to '2359', or '-1' for no bleed time.
		$this->cookie_uri				= ''; 				// The HTTP URL to the PHP iCalendar directory, ie. http://www.example.com/phpicalendar -- AUTO SETTING -- Only set if you are having cookie issues.
		$this->download_uri				= ''; 				// The HTTP URL to your calendars directory, ie. http://www.example.com/phpicalendar/calendars -- AUTO SETTING -- Only set if you are having subscribe issues.
		$this->default_path				= ''; 				// The HTTP URL to the PHP iCalendar directory, ie. http://www.example.com/phpicalendar
		$this->cpath	     			= ''; 				// optional subdirectory
		$this->charset					= 'UTF-8';			// Character set your calendar is in, suggested UTF-8, or iso-8859-1 for most languages.

		// Yes/No questions --- 'yes' means Yes, anything else means no. 'yes' must be lowercase.
		$this->allow_webcals 			= 'no';				// Allow http:// and webcal:// prefixed URLs to be used as the $this->cal for remote viewing of "subscribe-able" calendars. This does not have to be enabled to allow specific ones below.
		$this->month_locations  		= 'yes';			// Display location in the month view.
		$this->this_months_events 		= 'yes';			// Display "This month's events" at the bottom off the month page.
		$this->enable_rss				= 'yes';			// Enable RSS access to your calendars (good thing).
		$this->rss_link_to_event		= '';				// Set to yes to have links in the feed popup an event window.  Default is to link to day.php
		$this->show_search				= 'no';			// Show the search box in the sidebar.
		$this->allow_preferences		= 'yes';			// Allow visitors to change various preferences via cookies.
		$this->printview_default		= 'no';				// Set print view as the default view. day, week, and month only supported views for $this->default_view (listed well above).
		$this->show_todos				= 'yes';			// Show your todo list on the side of day and week view.
		$this->show_completed			= 'yes';				// Show completed todos on your todo list.
		$this->event_download			= 'no';				// Show completed todos on your todo list.
		$this->allow_login				= 'no';				// Set to yes to prompt for login to unlock calendars.
		$this->login_cookies			= 'no';			// Set to yes to store authentication information via (unencrypted) cookies. Set to no to use sessions.
		$this->support_ical				= 'no';			// Set to yes to support the Apple iCal calendar database structure.
		$this->recursive_path			= 'no';			// Set to yes to recurse into subdirectories of the calendar path.

		// Calendar Caching (decreases page load times)
		$this->save_parsed_cals 		= 'no';				// Saves a copy of the cal in /tmp after it's been parsed. Improves performance.
		$this->tmp_dir					= '/tmp';			// The temporary directory on your system (/tmp is fine for UNIXes including Mac OS X). Any php-writable folder works.
		$this->webcal_hours				= '24';				// Number of hours to cache webcals. Setting to '0' will always re-parse webcals if they've been modified.

		// Webdav style publishing
		$this->phpicalendar_publishing 	= '0';				// Set to '1' to enable remote webdav style publish. See 'calendars/publish.php' for complete information;

		// Administration settings (/admin/)
		$this->allow_admin				= 'no';			// Set to yes to allow the admin page - remember to change the default password if using 'internal' as the $this->auth_method
		$this->auth_method				= 'internal';			// Valid values are: 'ftp', 'internal', or 'none'. 'ftp' uses the ftp server's username and password as well as ftp commands to delete and copy files. 'internal' uses $this->auth_internal_username and $this->auth_internal_password defined below - CHANGE the password. 'none' uses NO authentication - meant to be used with another form of authentication such as http basic.
		$this->auth_internal_username	= 'admin';			// Only used if $this->auth_method='internal'. The username for the administrator.
		$this->auth_internal_password	= 'admin';			// Only used if $this->auth_method='internal'. The password for the administrator.
		$this->ftp_server				= 'localhost';		// Only used if $this->auth_method='ftp'. The ftp server name. 'localhost' will work for most servers.
		$this->ftp_port					= '21';				// Only used if $this->auth_method='ftp'. The ftp port. '21' is the default for ftp servers.
		$this->ftp_calendar_path		= '';				// Only used if $this->auth_method='ftp'. The full path to the calendar directory on the ftp server. If = '', will attempt to deduce the path based on $this->calendar_path, but may not be accurate depending on ftp server config.
		$this->salt                     = '';
		// Calendar colors
		//
		// You can increase the number of unique colors by adding additional images (monthdot_n.gif)
		// and in the css file (default.css) classes .alldaybg_n, .eventbg_n and .eventbg2_n
		// Colors will repeat from the beginning for calendars past $this->unique_colors (7 by default), with no limit.
		$this->unique_colors			= '7';

		return true;
	}

	public static function getInstance(){
		if (empty(self::$instance)){
			self::$instance = new Configs;
		}
		return self::$instance;
	}

	# val can be an array
	public function setProperty($key,$val){
		$this->$key = $val;
		return;
	}
	public function getProperty($key){
		return $this->$key;
	}
}

$phpiCal_config = Configs::getInstance();

?>
