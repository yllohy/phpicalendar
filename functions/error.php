<?php
function error($error_msg='There was an error processing the request.', $file='NONE') {
	global $style_sheet, $powered_by_lang, $version_lang, $error_title_lang, $error_window_lang, $error_calendar_lang, $error_back_lang;
	if (!isset($style_sheet))			$style_sheet = 'silver';
	if (!isset($powered_by_lang))		$powered_by_lang = 'Powered by';
	if (!isset($version_lang))			$version_lang = '0.6';
	if (!isset($error_title_lang))		$error_title_lang = 'Error!';
	if (!isset($error_window_lang))		$error_window_lang = 'There was an error!';
	if (!isset($error_calendar_lang))	$error_calendar_lang = 'The calendar "%s" was being processed when this error occurred.';
	if (!isset($error_back_lang))		$error_back_lang = 'Please use the "Back" button to return.';
	
	$error_calendar = sprintf($error_calendar_lang, $file);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<title><?php echo $error_title_lang; ?></title>
  	<link rel="stylesheet" type="text/css" href="styles/<?php echo "$style_sheet/default.css"; ?>">
</head>
<body bgcolor="#FFFFFF">
<center>
<table border="0" width="700" cellspacing="0" cellpadding="0">
	<tr>
		<td width="520" valign="top" align="center">
<table width="520" border="0" cellspacing="0" cellpadding="0" class="calborder">
    <tr>
     	<td align="center" valign="middle">
      		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="G10B">
      			<tr>
      				<td size="30" class="navback"><img height="30" width="1" src="images/spacer.gif"></td>
					<td align="center" valign="center" class="navback"><font class="H20"><?php echo $error_window_lang; ?></font></td>
					<td size="30" class="navback"><img height="30" width="1" src="images/spacer.gif"></td>
      			</tr>
      		</table>
      	</td>
	</tr>
	<tr>
		<td>
      		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="G10B">	
				<tr>
					<td height="300"><img height="300" width="1" src="images/spacer.gif"></td>
					<td align="center" valign="top">
						<br>
						<?php echo $error_msg; ?>
						<br>
						<br>
						<?php echo $error_calendar; ?>
						<br>
						<br>
						<?php echo $error_back_lang; ?>
					</td>
					<td height="300"><img height="300" width="1" src="images/spacer.gif"></td>
				</tr>
        	</table>
    	</td>
	</tr>
</table>
		<?php echo "<font class=\"V9\"><br>$powered_by_lang <a class=\"psf\" href=\"http://phpicalendar.sourceforge.net/\">PHP iCalendar $version_lang</a></font>"; ?></center></td>

</td>
	</tr>
</table>
</center>
</body>
</html>

<?php
}
?>