<?php
function error($error_msg="There was an error processing the request.") {
	global $style_sheet, $powered_by_lang, $version_lang;
	if (!$style_sheet) $style_sheet = "silver";
	if (!$powered_by_lang) $powered_by_lang = "Powered by";
	if (!$version_lang) $version_lang = "0.6";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<title>Error!</title>
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
					<td align="center" valign="center" class="navback"><font class="H20">There was an Error!</font></td>
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
						<? echo $error_msg; ?>
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