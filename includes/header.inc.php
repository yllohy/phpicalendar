<? if ($current_view == 'preferences') $display_date = $preferences_lang; ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<title><?php echo "$calendar_name - $display_date"; ?></title>
  	<link rel="stylesheet" type="text/css" href="<?php echo BASE."styles/$style_sheet/default.css"; ?>">
   <?php 
		
		// if RSS is enabled, set the RSS auto-discovery link
		if ($enable_rss == 'yes') {
			echo "<link rel=\"alternate\" type=\"application/rss+xml\" title=\"RSS\" href=\"".$default_path."/rss/rss.php?cal=".$cal."&amp;rssview=week\">";
		} 
		if (isset($master_array['-2'])) include (BASE.'functions/todo.js'); 
		
	?>
</head>
<body bgcolor="#FFFFFF">