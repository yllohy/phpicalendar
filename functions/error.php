<?php
if (!defined('BASE')) define('BASE','../');

function error($error_msg='There was an error processing the request.', $file='NONE') {
	global $style_sheet, $powered_by_lang, $version_lang, $error_title_lang, $error_window_lang, $error_calendar_lang, $error_back_lang, $enable_rss, $this_site_is_lang;
	if (!isset($style_sheet))			$style_sheet = 'silver';
	if (!isset($powered_by_lang))		$powered_by_lang = 'Powered by';
	if (!isset($version_lang))			$version_lang = '0.8';
	if (!isset($error_title_lang))		$error_title_lang = 'Error!';
	if (!isset($error_window_lang))		$error_window_lang = 'There was an error!';
	if (!isset($error_calendar_lang))	$error_calendar_lang = 'The calendar "%s" was being processed when this error occurred.';
	if (!isset($error_back_lang))		$error_back_lang = 'Please use the "Back" button to return.';
	if (!isset($enable_rss))			$enable_rss = 'no';
	if (!isset($this_site_is_lang))		$this_site_is_lang = 'This site is';
		
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
								<td align="left" valign="top" width="1%" class="sideback"><img src="images/spacer.gif" width="1" height="20"></td>
								<td align="center" valign="middle" width="98%" class="sideback"><b><?php echo $error_window_lang; ?></b></td>
								<td class="sideback" width="1%"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="G10B">	
							<tr>
								<td align="center" valign="top">
									<br>
									<?php echo $error_msg; ?>
									<br>
									<br>
									<?php echo $error_calendar; ?>
									<br>
									<br>
									<?php echo $error_back_lang; ?>
									<br>
									<br>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
<?php include (BASE.'includes/footer.inc.php'); ?>
</center>
</body>
</html>

<?php
}
?>