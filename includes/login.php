<?php
	// Hide the login block if logged in or there are no lock usernames.
	if (!isset($username) && $allow_login == 'yes') {
		// Set the login table width if not set.
		if (!isset($login_width)) $login_width = "100%";

		// Remove the username, password, and action values from the form action.
		$form_action = preg_replace("/(username|password|action)=[^&]+/", "", $REQUEST_URI);
?>
	<form style="margin-bottom:0;" action="<?php echo $form_action; ?>" method="POST">
	<input type="hidden" name="action" value="login">
	<?php
		foreach (array_keys($HTTP_GET_VARS) as $key) {
			if ($key == 'action' ||
				$key == 'username' ||
				$key == 'password')
			{
				continue;
			}
			echo "<input type=\"hidden\" name=\"$key\" value=\"$HTTP_GET_VARS[$key]\">\n";
		}
	?>
	<table cellpadding="0" cellspacing="0" border="0" width="<?php echo $login_width; ?>" class="calborder">
		<tr>
			<td bgcolor="#FFFFFF" valign="middle" align="center">
				<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td align="left" valign="top" width="1%" class="sideback"><img src="images/spacer.gif" width="1" height="20" alt=" "></td>
						<td colspan="3" align="center" width="98%" class="sideback"><font class="G10BOLD">Login</font></td>
						<td align="right" valign="top" width="1%" class="sideback"><img src="images/spacer.gif" width="1" height="20" alt=" "></td>
					</tr>
					<tr>
						<td colspan="5"><img src="images/spacer.gif" width="148" height="6" alt=" "></td>
					</tr>
					<tr>
						<td width="1%"><img src="images/spacer.gif" width="4" height="1" alt=""></td>
						<td width="48%"><font class="G10B">Username:</font></td>
						<td width="1%"><img src="images/spacer.gif" width="4" height="1" alt=""></td>
						<td width="48%"><input class="login_style" type="text" size="8" name="username"></td>
						<td width="1%"><img src="images/spacer.gif" width="4" height="1" alt=""></td>
					</tr>
					<tr>
						<td width="1%"><img src="images/spacer.gif" width="4" height="1" alt=""></td>
						<td width="48%"><font class="G10B">Password:</font></td>
						<td width="1%"><img src="images/spacer.gif" width="4" height="1" alt=""></td>
						<td width="48%"><input class="login_style" type="password" size="8" name="password"></td>
						<td width="1%"><img src="images/spacer.gif" width="4" height="1" alt=""></td>
					</tr>
					<tr>
						<td width="1%"><img src="images/spacer.gif" width="4" height="1" alt=""></td>
						<td colspan="3" align="center"><input class="login_style" type="submit" value="Login"></td>
						<td width="1%"><img src="images/spacer.gif" width="4" height="1" alt=""></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td bgcolor="#FFFFFF"><img src="images/spacer.gif" width="148" height="6" alt=" "></td>
		</tr>
	</table>
	</form>
	<img src="images/spacer.gif" width="1" height="10" alt=" "><br>
<?php
	}
?>
