<?php
	// Hide the login block if logged in, there are no lock usernames,
	// or if authenticated via HTTP.
	if ($username == '' && $allow_login == 'yes' && !isset($_SERVER['PHP_AUTH_USER'])) {
		// Set the login table width if not set.
		if (!isset($login_width)) $login_width = "100%";

		// Remove the username, password, and action values from the form action.
		$form_action = preg_replace("/(username|password|action)=[^&]+/", "", $REQUEST_URI);

		echo '<form style="margin-bottom:0;" action="'.$form_action.'" method="POST">';
		echo '<input type="hidden" name="action" value="login">';
		foreach (array_keys($HTTP_GET_VARS) as $key) {
			if ($key == 'action' || $key == 'username' || $key == 'password') {
				continue;
			}
			echo '<input type="hidden" name="'.$key.'" value="'.$HTTP_GET_VARS[$key].'">';
		}
		
		// For Wesley
		$login_message = ($user_passed == TRUE) ? $invalid_login_lang : $login_lang;

echo <<<END

	<table cellpadding="0" cellspacing="0" border="0" width="{$login_width}" class="calborder">
		<tr>
			<td align="center" class="sideback"><div style="height: 17px; margin-top: 3px;" class="G10BOLD">{$login_message}</div></td>
		</tr>
		<tr>
			<td align="left" class="G10B">
				<div style="padding: 5px;">
				<table border="0" width="100%" cellspacing="0" cellpadding="2">
					<tr>
						<td width="5%">{$username_lang}:</td>
						<td width="95%"><input class="login_style" type="text" size="8" name="username"></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><input class="login_style" type="{$password_lang}" size="8" name="password"></td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td><input class="login_style" type="submit" value="{$login_lang}"></td>
					</tr>
				</table>
				</div>
			</td>
		</tr>
	</table>
	</form>
	<img src="images/spacer.gif" width="1" height="10" alt=" "><br>

END;

}

?>
