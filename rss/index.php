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
								<td align="left" valign="top" width="1%" class="sideback"><img src="../images/spacer.gif" width="1" height="20"></td>
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
									<?php echo "$this_site_is_lang "; ?><a class="psf" href="http://www.oreillynet.com/rss/">RSS 0.91 enabled</a>.<br>
									<br>
									<?php 
									
									// open file
									$dir_handle = @opendir($calendar_path) or die(error(sprintf($error_path_lang, $calendar_path), $cal_filename));
									
									// build the <option> tags
									while ($file = readdir($dir_handle)) {
										if (substr($file, -4) == ".ics") {
											
											// $cal_filename is the filename of the calendar without .ics
											// $cal is a urlencoded version of $cal_filename
											// $cal_displayname is $cal_filename with occurrences of "32" replaced with " "
											$cal_filename_tmp = substr($file,0,-4);
											$cal_tmp = urlencode($cal_filename_tmp);
											$cal_displayname_tmp = str_replace("32", " ", $cal_filename_tmp);
											if (!in_array($cal_filename_tmp, $blacklisted_cals)) {
												echo '<font class="V12" color="blue"><b>'.$cal_displayname_tmp.' '. $calendar_lang.'</b></font><br>';
												echo $default_path.'/rss/rss.php?cal='.$cal_tmp.'&rssview=day<br>';
												echo $default_path.'/rss/rss.php?cal='.$cal_tmp.'&rssview=week<br>';
												echo $default_path.'/rss/rss.php?cal='.$cal_tmp.'&rssview=month<br>';
												echo '<br><br>';		
											}	
										}
									}
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