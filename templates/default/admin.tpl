<center>
<table border="0" width="700" cellspacing="0" cellpadding="0">
	<tr>
		<td align="center" valign="middle">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align="left" width="120" class="navback"><a href="{BACK_PAGE}"><img src="templates/{TEMPLATE}/images/back.gif" alt="Back" border="0" align="left"></a></td>
					<td class="navback">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td align="center" class="navback" nowrap valign="middle"><font class="H20"><?php echo "$admin_header_lang"; ?></font></td>
							</tr>
						</table>
					</td>
					<td align="right" width="120" class="navback">	
						<table width="120" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td><a class="psf" href="{BASE}day.php?cal={CAL}&amp;getdate={GETDATE}"><img src="templates/{TEMPLATE}/images/day_on.gif" alt="{DAY_LANG}" border="0"></a></td>
								<td><a class="psf" href="{BASE}week.php?cal={CAL}&amp;getdate={GETDATE}"><img src="templates/{TEMPLATE}/images/week_on.gif" alt="{WEEK_LANG}" border="0"></a></td>
								<td><a class="psf" href="{BASE}month.php?cal={CAL}&amp;getdate={GETDATE}"><img src="templates/{TEMPLATE}/images/month_on.gif" alt="{MONTH_LANG}" border="0"></a></td>
								<td><a class="psf" href="{BASE}year.php?cal={CAL}&amp;getdate={GETDATE}"><img src="templates/{TEMPLATE}/images/year_on.gif" alt="{YEAR_LANG}" border="0"></a></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="dayborder"><img src="images/spacer.gif" width="1" height="5" alt=" "></td>
	</tr>
	<tr>
		<td class="G10" align="right">
			<!-- switch logged_in on -->
			<a href="admin.php?action=logout\">{LOGOUT_LANG}</a>&nbsp;
			<!-- switch logged_in off -->
		</td>
	</tr>
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="G10B">
				<tr>
					<td width="2%"></td>
					<td width="98%" valign="top" align="left">

						<!-- switch login_error on -->
						<font color="red">{INVALID_LOGIN_LANG}</font>
						<!-- switch login_error off -->
	
						<!-- switch display_login on -->
						<form action="admin.php" method="post">
							<table cellspacing="0" cellpadding="0">
								<tr>
									<td nowrap>{USERNAME_LANG}: </td>
									<td align="left"><input type="text" name="username"></td>
								</tr>
								<tr>
									<td>{PASSWORD_LANG}: </td>
									<td align="left"><input type="password" name="password"></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td align="left"><input type="submit" value="{$login_lang}"></td>
								</tr>
								<tr>
									<td align="center" colspan="3">{LOGIN_ERROR}&nbsp;</td>
								</tr>
							</table>
						</form>
						<!-- switch display_login off -->
						
						
						<!-- switch logged_in on -->
						
						<!-- switch action_message on -->
						<font color="green">{CAL_FILE_LANG} {FILENUMBER}: {ACTION_MSG}</font><br>
						<!-- switch action_message off -->
						<h2>{ADDUPDATE_CAL_LANG}</h2>
						<p>{ADDUPDATE_DESC_LANG}</p>
						<form action="admin.php" method="post" enctype="multipart/form-data">
							<input type="hidden" name="action" value="addupdate">
							<table width="100%" border="0" cellspacing="0" cellpadding="0" class="G10B">
								<tr>
									<td nowrap>{CAL_FILE_LANG} 1: </td>
									<td><input type="file" name="calfile[1]"></td>
								</tr>
								<tr>
									<td nowrap>{CAL_FILE_LANG} 2: </td>
									<td><input type="file" name="calfile[2]"></td>
								</tr>
								<tr>
									<td nowrap>{CAL_FILE_LANG} 3: </td>
									<td><input type="file" name="calfile[3]"></td>
								</tr>
								<tr>
									<td nowrap>{CAL_FILE_LANG} 4: </td>
									<td><input type="file" name="calfile[4]"></td>
								</tr>
								<tr>
									<td nowrap>{CAL_FILE_LANG} 5: </td>
									<td><input type="file" name="calfile[5]"></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
									<td><input type="submit" value="{SUBMIT_LANG}"></td>
								</tr>
								<tr>
									<td align="center" colspan="2">{ADDUPDATE_MSG} &nbsp;</td>
								</tr>
							</table>
						</form>
						
						<h2>{DELETE_CAL_LANG}</h2>
						<form action="admin.php" method="post">
							{DELETE_TABLE}
							<input type="hidden" name="action" value="delete">
							<p><input type="submit" value="{DELETE_LANG}"></p>
							<p>{DELETE_MSG} &nbsp;</p>
						</form>
						
						<!-- switch logged_in off -->
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>



