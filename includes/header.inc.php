<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<title><?php echo $calendar_name; ?><?php if ($display_date != '') echo " - $display_date"; ?></title>
  	<link rel="stylesheet" type="text/css" href="<?php echo BASE."styles/$style_sheet/default.css"; ?>">
   <?php 
		
		// if RSS is enabled, set the RSS auto-discovery link
		if ($enable_rss == 'yes') {
			echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"RSS\" href=\"".$default_path."/rss/rss.php?cal=".$cal."&amp;rssview=week\">";
		} 
		if (isset($master_array['-2'])) include (BASE.'functions/todo.js'); 
		include (BASE.'functions/event.js'); 
		
	?>
</head>
<body bgcolor="#FFFFFF">
<form name="eventPopupForm" id="eventPopupForm" method="post" action="includes/event.php" style="display: none;">
  <input type="hidden" name="event" id="event" value="">
  <input type="hidden" name="cal" id="cal" value="">
  <input type="hidden" name="start" id="start" value="">
  <input type="hidden" name="end" id="end" value="">
  <input type="hidden" name="description" id="description" value="">
  <input type="hidden" name="status" id="status" value="">
  <input type="hidden" name="location" id="location" value="">
  <input type="hidden" name="organizer" id="organizer" value="">
  <input type="hidden" name="attendee" id="attendee" value="">
  <input type="hidden" name="url" id="url" value="">
</form>
