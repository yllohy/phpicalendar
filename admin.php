<?php
// TODO - Remove before going live
//error_reporting (E_ALL);

define('BASE', './');
include (BASE.'functions/init.inc.php');
include (BASE.'functions/upload_functions.php');

// Redirect if administration is not allowed
if ($allow_admin != "yes") {
	header("Location: index.php");
	die();
}

// Load variables from forms, query strings, and cookies into local scope
if($HTTP_POST_VARS) 	{extract($HTTP_POST_VARS, EXTR_PREFIX_SAME, "post_");}
if($HTTP_GET_VARS)  	{extract($HTTP_GET_VARS, EXTR_PREFIX_SAME, "get_");}
if($HTTP_COOKIE_VARS)	{extract($HTTP_COOKIE_VARS, EXTR_PREFIX_SAME, "cookie_");}

// Logout by clearing user info in cookies
if ($action == "logout") {
    setcookie("md5_password","");
	setcookie("username","");
}


// if $external_auth == 'yes', don't do any authentication
if ($external_auth == "yes") {
	$is_loged_in = TRUE;
}
// Check if The User is Identified
else {
	$is_loged_in = FALSE;
	
	if (isset($username) && $action != "logout") {
	    if (!isset($HTTP_COOKIE_VARS["md5_password"])) {
			$md5_password = md5($password);
	    }
	    else {
			$md5_password = $HTTP_COOKIE_VARS["md5_password"];
	    }
		if ($admin_username == $username && md5($admin_password) == $md5_password) {
//TODO lastusername doesn't appear to be working
			$is_loged_in = TRUE;
			setcookie("lastusername", $username, time()+1012324305);
			setcookie("username", $username);
			setcookie("md5_password", $md5_password);
		}
		else {
			$login_error = "<font color=\"red\">$invalid_login_lang</font>";
			$is_loged_in = FALSE;
		}
	}
	
	if ($is_loged_in == FALSE) {
		setcookie("username","");
		setcookie("password","");
		setcookie("md5_password","");
	}
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<title><?php echo "$admin_header_lang"; ?></title>
  	<link rel="stylesheet" type="text/css" href="<?php echo BASE."styles/$style_sheet/default.css"; ?>">
  	
  	<script>
  	<!--
		function verify(){
		    msg = "<?php echo $confirm_lang; ?>";
		    //all we have to do is return the return value of the confirm() method
		    return confirm(msg);
		}
	-->
	</script>

</head>
<body bgcolor="#FFFFFF">
<center>

<?php include (BASE.'includes/header.inc.php'); ?>

<table width="640" border="0" cellspacing="0" cellpadding="0" class="calborder">
	<tr>
		<td align="center" valign="middle">

			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align="left" width="20" class="navback">&nbsp;</td>
					<td align="center" class="navback" nowrap valign="middle"><font class="H20"><?php echo "$admin_header_lang"; ?></font></td>
					<td align="right" width="20" class="navback" nowrap valign="middle"><font class="G10"><?php if ($external_auth != "yes" && $is_loged_in == TRUE) { echo "<a href=\"{$HTTP_SERVER_VARS['PHP_SELF']}?action=logout\">{$logout_lang}</a>"; } ?></font>&nbsp;</td>
				</tr>
				<tr>
					<td colspan="3" class="dayborder"><img src="images/spacer.gif" width="1" height="5" alt=" "></td>
				</tr>
				<tr>
					<td align="left" width="20">&nbsp;</td>
					<td colspan="2">

<?php 



// If User is Not Logged In, Display The Login Page
if ($is_loged_in == FALSE) {
    echo <<<EOT
	<form action="{$HTTP_SERVER_VARS['PHP_SELF']}" method="post">
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td nowrap>{$username_lang}: </td>
				<td align="left"><input type="text" name="username" value="$lastusername"></td>
			</tr>
			<tr>
				<td>{$password_lang}: </td>
				<td align="left"><input type="password" name="password"></td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td align="left"><input type="submit" value="{$login_lang}"></td>
			</tr>
			<tr>
				<td align="center" colspan="3">{$login_error}&nbsp;</td>
			</tr>
	    </table>
	</form>
EOT;


	echo "
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>";

	include (BASE.'includes/footer.inc.php');
	
	echo "
	</center>
	</body>
	</html>";
	
	die();
}


// The user is logged in if we get here



// Add or Update a calendar
if ($action == "addupdate") {
	$addupdate_success = FALSE;
	if (!is_uploaded_file_v4($HTTP_POST_FILES['calfile']['tmp_name'])) {
		$upload_error = get_upload_error($HTTP_POST_FILES['calfile']);
	}
	elseif (!is_uploaded_ics($HTTP_POST_FILES['calfile']['name'])) {
		$upload_error = $upload_error_type_lang;
	}
	// copy() should be replaced with move_uploaded_file(), but only if we can require PHP 4 >= 4.0.3
	elseif (!copy($HTTP_POST_FILES['calfile']['tmp_name'], $calendar_path . "/" . $HTTP_POST_FILES['calfile']['name'])) {
		$upload_error = $copy_error_lang . " " . $HTTP_POST_FILES['calfile']['tmp_name'] . " - " . $calendar_path . "/" . $HTTP_POST_FILES['calfile']['name'];
	}
	else {
		$addupdate_success = TRUE;
	}
}

// Delete a calendar
//  Not at all secure - need to strip out path info if used by users besides admin in the future
if ($action == "delete") {
	$delete_success = FALSE;
	
	if (!unlink($calendar_path . "/" . urldecode($delete_calendar))) {
		$delete_error = $delete_error_lang . " " . $calendar_path . "/" . urldecode($delete_calendar);
	}
	else {
		$delete_success = TRUE;
	}
}

?>


<h2><?php echo $addupdate_cal_lang; ?></h2>
<p><?php echo $addupdate_desc_lang; ?></p>
<form action="<?php echo $HTTP_SERVER_VARS['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" <?php if($confirm_changes != "no") { echo "onSubmit=\"return verify()\""; } ?> >
    <input type="hidden" name="action" value="addupdate">
	<table border="0" cellspacing="0">
		<tr>
			<td nowrap><?php echo $cal_file_lang; ?>: </td>
			<td><input type="file" name="calfile"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="<?php echo $submit_lang; ?>"></td>
		</tr>
		<tr>
			<td align="center" colspan="2"><?php if($addupdate_success) { echo "<font color=\"green\">{$action_success_lang}</font>"; } ?><font color="red"><?php echo $upload_error; ?></font>&nbsp;</td>
		</tr>
    </table>
</form>
	
<h2><?php echo $delete_cal_lang; ?></h2>
<form action="<?php echo $HTTP_SERVER_VARS['PHP_SELF']; ?>" method="post" <?php if($confirm_changes != "no") { echo "onSubmit=\"return verify()\""; } ?> >
	<input type="hidden" name="action" value="delete">
	<table border="0" cellspacing="0">
		<tr>
			<td nowrap><?php echo $cal_file_lang; ?>: </td>
			<td>
				<?php
				
					// Begin Calendar Selection
					//
					print "<select name=\"delete_calendar\">\n";
					$filelist = get_calendar_files($calendar_path);
					foreach ($filelist as $file) {
						$cal_filename_tmp = substr($file,0,-4);
						$cal_tmp = urlencode($file);
						$cal_displayname_tmp = str_replace("32", " ", $cal_filename_tmp);
						print "<option value=\"$cal_tmp\">$cal_displayname_tmp $calendar_lang</option>\n";	
					}			
					print "</select>\n";
				?>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="submit" value="<?php echo $submit_lang; ?>"></td>
		</tr>
		<tr>
			<td align="center" colspan="2"><?php if($delete_success) { echo "<font color=\"green\">{$action_success_lang}</font>"; } ?><font color="red"><?php echo $delete_error; ?></font>&nbsp;</td>
		</tr>
	</table>
</form>


<?php
echo "
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>";

include (BASE.'includes/footer.inc.php');

echo "</center>
	</body>
	</html>";
?>

