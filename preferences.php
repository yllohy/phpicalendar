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
								<br>
								Select your default language:<br>
								<?php include (BASE.'functions/list_languages.php'); ?>
								<br>
								Select your default calendar:<br>
								<?php include (BASE.'functions/list_icals.php'); ?>
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
<?php include (BASE.'footer.inc.php'); ?>
</center>
</body>
</html>
