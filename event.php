<?php 

include "init.inc.php"; 
$event = stripslashes($event);
$event = str_replace("\\", "", $event);
$description = stripslashes($description);
$description = str_replace("\\", "", $description);

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
  <meta http-equiv="content-type" content="text/html;charset=UTF-8">
  <title><?php echo "$calendar_name"; ?></title>
	<link rel="stylesheet" type="text/css" href="styles/<?php echo "$style_sheet"; ?>">
</head>
<body bgcolor="#eeeeee"><center>
<table border="0" width="430" cellspacing="0" cellpadding="0" class="calborder">
	<tr>
		<td align="left" valign="top" bgcolor="#DDDDDD" width="1%" background="images/side_bg.gif"><img src="images/spacer.gif" width="1" height="20"></td>
		<td bgcolor="#DDDDDD" align="center" class="G10B" width="98%" background="images/side_bg.gif"><b><?php echo "$calendar_name $calendar_lang"; ?></b></td>
		<td align="right" valign="top" bgcolor="#DDDDDD" width="1%" background="images/side_bg.gif"></td>
	</tr>
	<tr>
		<td colspan="3"><img src="images/spacer.gif" width="1" height="6"></td>
	</tr>
	<tr>
		<td colspan="3">  
	   		<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<?php if (($start) && ($end)) $event_times = " - <font class=\"V9\">(<i>$start - $end</i>)</font>"; ?>
				<tr>
					 <td width="1%"><img src="images/spacer.gif" width="6" height="1"></td>
		 			 <td align="left" colspan="2" class="V12"><?php echo "$event $event_times<br><br>"; ?></td>
				</tr>
				
				<?php if ($description) { ?>    
					<tr>
					 <td width="1%"><img src="images/spacer.gif" width="6" height="1"></td>
					 <td align="left" colspan="2" class="V12"><?php echo "$description"; ?></td>
					</tr>
				<?php } ?>
	
	   </table>
   </td>
	</tr>
</table> 
</center>
</body>
</html>