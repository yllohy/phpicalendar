<?php

define('BASE','../');
$current_view = "rssindex";
include(BASE.'functions/ical_parser.php');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<title><?php echo "$cal $calendar_lang - RSS Info"; ?></title>
  	<link rel="stylesheet" type="text/css" href="<?php echo BASE."styles/$style_sheet/default.css"; ?>">
</head>
<body bgcolor="#FFFFFF">
<center>
<table border="0" width="700" cellspacing="0" cellpadding="0">
	<tr>
		<td width="520" valign="top" align="center">
			<table width="640" border="0" cellspacing="0" cellpadding="0" class="calborder">
				<tr>
					<td align="center" valign="middle">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="G10B">
							<tr>
								<td align="left" valign="top" width="1%" class="sideback"><img src="images/spacer.gif" width="1" height="20"></td>
								<td align="center" valign="center" width="98%" class="sideback"><b><?php echo 'RSS information'; ?></b></td>
								<td class="sideback" width="1%"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="G10B">	
							<tr>
								<td width="2%"></td>
								<td width="98%" valign="top">
									<br>
									This website is RSS enabled.<br>
									<br>
									<b>Day View:</b><br>
									<?php echo $default_path.'/rss.php?cal='.$cal.'&rssview=day'; ?><br>
									<br>
									<b>Week View:</b><br>
									<?php echo $default_path.'/rss.php?cal='.$cal.'&rssview=week'; ?><br>
									<br>
									<b>Month View:</b><br>
									<?php echo $default_path.'/rss.php?cal='.$cal.'&rssview=month'; ?><br>
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
<?php include (BASE.'footer.inc.php'); ?>
</center>
</body>
</html>