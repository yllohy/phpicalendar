{HEADER}
<center>
<table border="0" width="650" cellspacing="0" cellpadding="0" class="calborder">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align="left" width="120" class="navback"><a href="{BACK_PAGE}"><img src="templates/{TEMPLATE}/images/back.gif" alt="{L_BACK}" border="0" align="left" /></a></td>
					<td class="navback">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td align="center" class="navback" nowrap valign="middle"><font class="H20">{L_PREFERENCES}</font></td>
							</tr>
						</table>
					</td>
					<td align="right" width="120" class="navback">	
						<table width="120" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td><a class="psf" href="day.php?cal={CAL}&amp;getdate={GETDATE}"><img src="templates/{TEMPLATE}/images/day_on.gif" alt="{L_DAY}" border="0" /></a></td>
								<td><a class="psf" href="week.php?cal={CAL}&amp;getdate={GETDATE}"><img src="templates/{TEMPLATE}/images/week_on.gif" alt="{L_WEEK}" border="0" /></a></td>
								<td><a class="psf" href="month.php?cal={CAL}&amp;getdate={GETDATE}"><img src="templates/{TEMPLATE}/images/month_on.gif" alt="{L_MONTH}" border="0" /></a></td>
								<td><a class="psf" href="year.php?cal={CAL}&amp;getdate={GETDATE}"><img src="templates/{TEMPLATE}/images/year_on.gif" alt="{L_YEAR}" border="0" /></a></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td class="dayborder"><img src="images/spacer.gif" width="1" height="5" alt=" " /></td>
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
							<td align="left" valign="top" width="300" nowrap>{L_SELECT_LANG}</td>
							<td align="left" valign="top" width="20"><img src="images/spacer.gif" alt=" " width="20" height="1" border="0" /></td>
							<td align="left" valign="top"><select name="cookie_language" class="query_style">{LANGUAGE_SELECT}</select></td>
						</tr>
						<tr>
							<td align="left" valign="top" width="300" nowrap>{L_SELECT_CAL}</td>
							<td align="left" valign="top"><img src="images/spacer.gif" alt=" " width="20" height="1" border="0" /></td>
							<td align="left" valign="top"><select name="cookie_calendar" class="query_style">{CALENDAR_SELECT}</select></td>
						</tr>
						<tr>
							<td align="left" valign="top" width="300" nowrap>{L_SELECT_VIEW}</td>
							<td align="left" valign="top"><img src="images/spacer.gif" alt=" " width="20" height="1" border="0" /></td>
							<td align="left" valign="top"><select name="cookie_view" class="query_style">{VIEW_SELECT}</select></td>
						</tr>
						<tr>
							<td align="left" valign="top" width="300" nowrap>{L_SELECT_TIME}</td>
							<td align="left" valign="top"><img src="images/spacer.gif" alt=" " width="20" height="1" border="0" /></td>
							<td align="left" valign="top"><select name="cookie_time" class="query_style">{TIME_SELECT}</select></td>
						</tr>
						<tr>
							<td align="left" valign="top" width="300" nowrap>{L_SELECT_DAY}</td>
							<td align="left" valign="top"><img src="images/spacer.gif" alt=" " width="20" height="1" border="0" /></td>
							<td align="left" valign="top"><select name="cookie_startday" class="query_style">{STARTDAY_SELECT}</select></td>
						</tr>
						<tr>
							<td align="left" valign="top" width="300" nowrap>{L_SELECT_STYLE}</td>
							<td align="left" valign="top"><img src="images/spacer.gif" alt=" " width="20" height="1" border="0" /></td>
							<td align="left" valign="top"><select name="cookie_style" class="query_style">{STYLE_SELECT}</select></td>
						</tr>
						<!-- switch cookie_already_set on -->
						<tr>
							<td align="left" valign="top" nowrap>{L_UNSET_PREFS}</td>
							<td align="left" valign="top"><img src="images/spacer.gif" alt=" " width="20" height="1" border="0" /></td>
							<td align="left" valign="top"><INPUT TYPE="checkbox" NAME="unset" VALUE="true"></td>
						</tr>
						<!-- switch cookie_already_set off -->
						<!-- switch cookie_not_set on -->
						<tr>
							<td align="left" valign="top" nowrap>&nbsp;</td>
							<td align="left" valign="top"><img src="images/spacer.gif" alt=" " width="20" height="1" border="0" /></td>
							<td align="left" valign="top"><input type="submit" name="set" value="{L_SET_PREFS}" /></td>
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

</center>
{FOOTER}
