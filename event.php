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
 <body bgcolor="#eeeeee">
<table border="0" width="430" cellspacing="2" cellpadding="4">
	<tr>
		<td>  
   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="calborder">
    <tr height="18">
     <td align="right" valign="top" width="80" class="V12">&nbsp;<b><?php echo "$event_lang"; ?>:</b></td>
     <td nowrap width="7" height="18"></td>
     <td align="left" valign="top" height="18" class="V12"><?php echo "$event"; ?></td>
    </tr>
    
<?php if ($start) { ?> 
    <tr height="18">
     <td align="right" valign="top" width="80" class="V12">&nbsp;<b><?php echo "$event_start_lang"; ?>:</b></td>
     <td width="7" height="18"></td>
     <td align="left" valign="top" height="18" class="V12"><?php echo "$start"; ?></td>
    </tr>
<?php } ?>    
    
<?php if ($end) { ?> 
    <tr height="18">
     <td align="right" valign="top" width="80" class="V12">&nbsp;<b><?php echo "$event_end_lang"; ?>:</b></td>
     <td width="7" height="18"></td>
     <td align="left" valign="top" height="18" class="V12"><?php echo "$end"; ?></td>
    </tr>
<?php } ?>

<?php if ($description) { ?>    
    <tr height="18">
     <td align="right" valign="top" width="80" class="V12">&nbsp;<b><?php echo "$notes_lang"; ?>:</b></td>
     <td width="7" height="18"></td>
     <td align="left" valign="top" height="18" class="V12"><?php echo "$description"; ?></td>
    </tr>
<?php } ?>

   </table>
   </td>
	</tr>
</table> 
 </body>
</html>