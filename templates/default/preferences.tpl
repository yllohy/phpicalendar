<center>
<table border="0" width="700" cellspacing="0" cellpadding="0">
	<tr>
		<td width="520" valign="top" align="center">
			<table width="640" border="0" cellspacing="0" cellpadding="0" class="calborder">
				<tr>
					<td align="center" valign="middle">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td align="left" width="120" class="navback"><a href="{BACK_PAGE}"><img src="templates/{TEMPLATE}/images/back.gif" alt="Back" border="0" align="left"></a></td>
								<td class="navback">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="center" class="navback" nowrap valign="middle"><font class="H20">{PREFERENCES_LANG}</font></td>
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
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="G10B">	
							<!-- switch message on -->
							<tr>
								<td colspan="2" align="center"><font class="G10BOLD">{MESSAGE}</font></td>
							</tr>
							<!-- switch message off -->
							<tr>
								<td width="2%"></td>
								<td width="98%" valign="top" align="left">
								<form action="preferences.php?action=setcookie" METHOD="post">
								<table border="0" width="620" cellspacing="2" cellpadding="2" align="center">
									<tr>
										<td align="left" valign="top" width="300" nowrap>{SELECT_LANG_LANG}</td>
										<td align="left" valign="top" width="20"><img src="images/spacer.gif" alt=" " width="20" height="1" border="0"></td>
										<td align="left" valign="top"><select name="cookie_language" class="query_style">{COOKIE_LANGUAGE}</select></td>
									</tr>
									<tr>
										<td align="left" valign="top" width="300" nowrap>{SELECT_CAL_LANG}</td>
										<td align="left" valign="top"><img src="images/spacer.gif" alt=" " width="20" height="1" border="0"></td>
										<td align="left" valign="top"><select name="cookie_calendar" class="query_style">{COOKIE_CALENDAR}</select></td>
									</tr>
									<tr>
										<td align="left" valign="top" width="300" nowrap>{SELECT_VIEW_LANG}</td>
										<td align="left" valign="top"><img src="images/spacer.gif" alt=" " width="20" height="1" border="0"></td>
										<td align="left" valign="top"><select name="cookie_view" class="query_style">{COOKIE_VIEW}</select></td>
									</tr>
									<tr>
										<td align="left" valign="top" width="300" nowrap>{SELECT_TIME_LANG}</td>
										<td align="left" valign="top"><img src="images/spacer.gif" alt=" " width="20" height="1" border="0"></td>
										<td align="left" valign="top"><select name="cookie_time" class="query_style">{COOKIE_TIME}</select></td>
									</tr>
									<tr>
										<td align="left" valign="top" width="300" nowrap>{SELECT_DAY_LANG}</td>
										<td align="left" valign="top"><img src="images/spacer.gif" alt=" " width="20" height="1" border="0"></td>
										<td align="left" valign="top"><select name="cookie_startday" class="query_style">{COOKIE_STARTDAY}</select></td>
									</tr>
									<tr>
										<td align="left" valign="top" width="300" nowrap>{SELECT_STYLE_LANG}</td>
										<td align="left" valign="top"><img src="images/spacer.gif" alt=" " width="20" height="1" border="0"></td>
										<td align="left" valign="top"><select name="cookie_style" class="query_style">{COOKIE_STYLE}</select></td>
									</tr>
									<!-- switch cookie_already_set on -->
									<tr>
										<td align="left" valign="top" nowrap>{UNSET_PREFS_LANG}</td>
										<td align="left" valign="top"><img src="images/spacer.gif" alt=" " width="20" height="1" border="0"></td>
										<td align="left" valign="top"><INPUT TYPE="checkbox" NAME="unset" VALUE="true"></td>
									</tr>
									<!-- switch cookie_already_set off -->
									<!-- switch cookie_not_set on -->
									<tr>
										<td align="left" valign="top" nowrap>&nbsp;</td>
										<td align="left" valign="top"><img src="images/spacer.gif" alt=" " width="20" height="1" border="0"></td>
										<td align="left" valign="top"><input type="submit" name="set" value="{SET_PREFS_LANG}"></button></td>
									</tr>
									<!-- switch cookie_not_set off -->
								</table>
								</form>
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
</center>