<table border="0" width="737" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="calborder">
	<tr>
		<td align="left" valign="top" width="1%" class="sideback">
			<a class="psf" href="month.php?cal={CAL}&amp;getdate={PREV_GETDATE}"><img src="templates/{TEMPLATE}/images/left_arrows.gif" alt="{L_PREV_DAY}" border="0" align="left"></a>
		</td>
		<td align="center" class="sideback">
			<font class="G10B"><b>Thursday, January 29</b></font>
		</td>
		<td align="right" valign="top" width="1%" class="sideback">
			<a class="psf" href="month.php?cal={CAL}&amp;getdate={NEXT_GETDATE}"><img src="templates/{TEMPLATE}/images/right_arrows.gif" alt="{L_NEXT_DAY}" border="0" align="right"></a>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<img src="images/spacer.gif" width="1" height="5" alt=" ">
		</td>
	</tr>
	<tr>
		<td width="1%" valign="top" align="right">
			{MONTH_SMALL|-1}
		</td>
		<td width="98%" valign="top" align="center">
			<table border="0" width="330" cellspacing="0" cellpadding="0">
				<tr>
					<td width="160" valign="top">
						<div style="padding: 5px;">
							<form style="margin-bottom:0;" action="day.php" method="GET">
								{LIST_ICALS}<br>
								{LIST_YEARS}<br>
								{LIST_MONTHS}<br>
								{LIST_WEEKS}<br>
								<br>
							</form>
							<!-- switch show_search on -->
							{SEARCH_BOX}
							<!-- switch show_search off -->
							<!-- switch show_goto on -->
							<form style="margin-bottom:0;" action="day.php" method="GET">
								<input type="hidden" name="cal" value="{URL_CAL}">
								<input type="text" style="width:160px; font-size:10px" name="jumpto_day">
								<input type="submit" value="Go">
							</form>
							<!-- switch show_goto off -->
						</div>
					</td>
					<td>
						<img src="images/spacer.gif" width="20" height="1" alt=" ">
					</td>
					<td width="160" valign="top">
						<div style="padding: 5px;">
							<font class="G10BOLD">{CAL_DISPLAYNAME2}</font><br>
							<span class="G10">
								<a class="psf" href="day.php?cal={CAL}&amp;getdate={REALLY_TODAY_TODAY}">{L_GODAY}</a><br>
								<a class="psf" href="week.php?cal={CAL}&amp;getdate={REALLY_TODAY_TODAY}">{L_GOWEEK}</a><br>
								<a class="psf" href="month.php?cal={CAL}&amp;getdate={REALLY_TODAY_TODAY}">{L_GOMONTH}</a><br>
								<a class="psf" href="year.php?cal={CAL}&amp;getdate={REALLY_TODAY_TODAY}">{L_GOYEAR}</a><br>
								<a class="psf" href="print.php?cal={CAL}&amp;getdate={GETDATE}&amp;printview={CURRENT_VIEW}">{L_GOPRINT}</a><br>
								<!-- switch allow_preferences on -->
								<a class="psf" href="preferences.php?cal={CAL}&amp;getdate={GETDATE}">{L_PREFERENCES}</a><br>
								<!-- switch allow_preferences off -->
								<!-- switch display_download on -->
								<a class="psf" href="{SUBSCRIBE_PATH}">{SUBSCRIBE_LANG}</a>&nbsp;|&nbsp;<a class="psf" href="{DOWNLOAD_FILENAME}">{DOWNLOAD_LANG}</a><br>
								<!-- switch display_download off -->
								<!-- switch is_logged_in on -->
								<a class="psf" href="{SCRIPT_NAME}?{QUERYS}">Logout {USERNAME}</a>
								<!-- switch is_logged_in off -->
							</span>
						</div>
					</td>
				</tr>
			</table>
		</td>
		<td width="1%" valign="top" align="left">
			{MONTH_SMALL|+1}
		</td>
	</tr>
</table>