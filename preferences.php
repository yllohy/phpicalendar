<?php

define('BASE','./');
$current_view = "preferences";
include(BASE.'functions/ical_parser.php');
$default_path = 'http://'.$HTTP_SERVER_VARS['SERVER_NAME'].substr($HTTP_SERVER_VARS['PHP_SELF'],0,strpos($HTTP_SERVER_VARS['PHP_SELF'], '/rss/'));
$default_view = "$default_view" . ".php";
if ($allow_preferences == 'no') header("Location: $default_view");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<title><?php echo "$cal $calendar_lang - $preferences_lang"; ?></title>
  	<link rel="stylesheet" type="text/css" href="<?php echo BASE."styles/$style_sheet/default.css"; ?>">
</head>
<body bgcolor="#FFFFFF">
<?php include (BASE.'header.inc.php'); ?>
<center>
<table border="0" width="700" cellspacing="0" cellpadding="0">
	<tr>
		<td width="520" valign="top" align="center">
			<table width="640" border="0" cellspacing="0" cellpadding="0" class="calborder">
				<tr>
					<td align="center" valign="middle">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td align="left" width="90" class="navback"><?php echo '<a href="'.$back_page.'"><img src="'.BASE.'/styles/'.$style_sheet.'/back.gif" alt="" border="0" align="left"></a>'; ?></td>
								<td class="navback">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="center" class="navback" nowrap valign="middle"><font class="H20"><?php echo "$preferences_lang"; ?></font></td>
										</tr>
									</table>
								</td>
								<td align="right" width="90" class="navback">	
									<table width="90" border="0" cellpadding="0" cellspacing="0">
										<tr>
											<td><?php echo '<a class="psf" href="day.php?cal='.$cal.'&getdate='.$getdate.'"><img src="'.BASE.'/styles/'.$style_sheet.'/day_on.gif" alt="" border="0"></td>'; ?>
											<td><?php echo '<a class="psf" href="week.php?cal='.$cal.'&getdate='.$getdate.'"><img src="'.BASE.'/styles/'.$style_sheet.'/week_on.gif" alt="" border="0"></td>'; ?>
											<td><?php echo '<a class="psf" href="month.php?cal='.$cal.'&getdate='.$getdate.'"><img src="'.BASE.'/styles/'.$style_sheet.'/month_on.gif" alt="" border="0"></td>'; ?>
										</tr>
									</table>
								</td>
							</tr>
			      		</table>
					</td>
				</tr>
				<tr>
					<td class="dayborder"><img src="images/spacer.gif" width="1" height="5"></td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="G10B">	
							<tr>
								<td width="2%"></td>
								<td width="98%" valign="top" align="left">
								<form action="preferences.php?action=setcookie">
								<?php 
								
								
								
								
								// Begin Language Selection
								//
								echo 'Select your default language:<br><br>';
								print "<select name=\"cookie_language\" class=\"query_style\">\n";
								$dir_handle = @opendir(BASE.'languages/');
								$tmp_pref_language = urlencode(ucfirst($language));
								while ($file = readdir($dir_handle)) {
									if (substr($file, -8) == ".inc.php") {
										$language_tmp = urlencode(ucfirst(substr($file, 0, -8)));
										if ($language_tmp == $tmp_pref_language) {
											print "<option value=\"$language_tmp\" selected>in $language_tmp</option>\n";
										} else {
											print "<option value=\"$language_tmp\">in $language_tmp</option>\n";
										}
									}
								}
								closedir($dir_handle);
								print "</select>\n";
								echo '<br><br>';
								
								// Begin Calendar Selection
								//
								echo 'Select your default calendar:<br><br>';
								print "<select name=\"cookie_calendar\" class=\"query_style\">\n";
								$dir_handle = @opendir($calendar_path) or die(error(sprintf($error_path_lang, $calendar_path), $cal_filename));
								while ($file = readdir($dir_handle)) {
									if (substr($file, -4) == ".ics") {
										$cal_filename_tmp = substr($file,0,-4);
										$cal_tmp = urlencode($cal_filename_tmp);
										$cal_displayname_tmp = str_replace("32", " ", $cal_filename_tmp);
										if (!in_array($cal_filename_tmp, $blacklisted_cals)) {
											if ($cal_tmp == $cal) {
												print "<option value=\"$cal_tmp\" selected>$cal_displayname_tmp $calendar_lang</option>\n";
											} else {
												print "<option value=\"$cal_tmp\">$cal_displayname_tmp $calendar_lang</option>\n";	
											}		
										}	
									}
								}			
								foreach($list_webcals as $cal_tmp) {
									if ($cal_tmp != '') {
										$cal_displayname_tmp = basename($cal_tmp);
										$cal_displayname_tmp = str_replace("32", " ", $cal_displayname_tmp);
										$cal_displayname_tmp = substr($cal_displayname_tmp,0,-4);
										$cal_encoded_tmp = urlencode($cal_tmp);
										if ($cal_tmp == $cal_httpPrefix || $cal_tmp == $cal_webcalPrefix) {
											print "<option value=\"$cal_encoded_tmp\" selected>$cal_displayname_tmp Webcal</option>\n";
										} else {
											print "<option value=\"$cal_encoded_tmp\">$cal_displayname_tmp Webcal</option>\n";	
										}		
									}
								}
								closedir($dir_handle);
								print "</select>\n";
								echo '<br><br>';
								
								// Begin View Selection
								//
								echo 'Select your default view:<br><br>';
								print "<select name=\"cookie_view\" class=\"query_style\">\n";
								print "<option value=\"day\">$day_lang</option>\n";
								print "<option value=\"week\">$week_lang</option>\n";
								print "<option value=\"month\">$month_lang</option>\n";
								print "<option value=\"print\">$printer_lang</option>\n";
								print "</select>\n";
								echo '<br><br>';
								
								// Begin Day Start Selection
								//
								echo 'Select your start day of week:<br><br>';
								print "<select name=\"cookie_view\" class=\"query_style\">\n";
								$i=1;
								foreach ($daysofweek_lang as $daysofweek) {
									print "<option value=\"$i\">$daysofweek</option>\n";
									$i++;
								}
								print "</select>\n";
								echo '<br><br>';
								
								// Begin Style Selection
								//
								echo 'Select your default style:<br><br>';
								print "<select name=\"cookie_style\" class=\"query_style\">\n";
								$dir_handle = @opendir(BASE.'styles/');
								while ($file = readdir($dir_handle)) {
									if (($file != ".") && ($file != "..") && ($file != "CVS")) {
										if (!is_file($file)) {
											$file = ucfirst($file);
											print "<option value=\"$file\">$file</option>\n";
										}
									}
								}
								closedir($dir_handle);
								print "</select>\n";
								echo '<br><br>';
								 
								echo '<button type="submit" name="set" value="true" class=\"query_style\"><font class="G10">Set Cookie</font></button>';
								echo '</form><br>'; 
								 ?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php include (BASE.'footer.inc.php'); ?>
</center>
</body>
</html>
