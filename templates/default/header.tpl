<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="content-type" content="text/html; charset={CHARSET}" />
	<title>{CALENDAR_NAME} - {DISPLAY_DATE}</title>
  	<link rel="stylesheet" type="text/css" href="{DEFAULT_PATH}templates/{TEMPLATE}/default.css" />
	<!-- switch rss_available on -->
	<link rel="alternate" type="application/rss+xml" title="RSS" href="{DEFAULT_VIEW}/rss/rss.php?cal={CAL}&amp;rssview={CURRENT_VIEW}">
	<!-- switch rss_available off -->		
	{EVENT_JS}
	{TODO_JS}
</head>
<body>
<form name="eventPopupForm" id="eventPopupForm" method="post" action="includes/event.php" style="display: none;">
  <input type="hidden" name="event" id="event" value="" />
  <input type="hidden" name="cal" id="cal" value="" />
  <input type="hidden" name="start" id="start" value="" />
  <input type="hidden" name="end" id="end" value="" />
  <input type="hidden" name="description" id="description" value="" />
  <input type="hidden" name="status" id="status" value="" />
  <input type="hidden" name="location" id="location" value="" />
  <input type="hidden" name="organizer" id="organizer" value="" />
  <input type="hidden" name="attendee" id="attendee" value="" />
  <input type="hidden" name="url" id="url" value="" />
</form>