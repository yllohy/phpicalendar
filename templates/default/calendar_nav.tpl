<table border="0" width="737" cellspacing="0" cellpadding="0">
	<tr>
		<td width="1%" valign="top" align="right">
			{MONTH_SMALL|-1}
		</td>
		<td width="98%" valign="top" align="center">
			<table border="0" width="330" cellspacing="0" cellpadding="0">
				<tr>
					<td width="160" valign="top">
						<table width="170" border="0" cellpadding="3" cellspacing="0" class="calborder">
							<tr height="20">
								<td align="center" class="sideback"><b>{L_JUMP_TO}</b></td>
							</tr>
							<tr>
								<td>
									<div style="padding: 5px;">
										<form style="margin-bottom:0;" action="day.php" method="GET">
											<select name="action" class="query_style" onChange="window.location=(this.options[this.selectedIndex].value">{LIST_ICALS}</select><br>
											<select name="action" class="query_style" onChange="window.location=(this.options[this.selectedIndex].value">{LIST_YEARS}</select><br>
											<select name="action" class="query_style" onChange="window.location=(this.options[this.selectedIndex].value">{LIST_MONTHS}</select><br>
											<select name="action" class="query_style" onChange="window.location=(this.options[this.selectedIndex].value">{LIST_WEEKS}</select><br>
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
							</tr>
						</table>
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
								<a class="psf" href="{SUBSCRIBE_PATH}">{L_SUBSCRIBE}</a>&nbsp;|&nbsp;<a class="psf" href="{DOWNLOAD_FILENAME}">{L_DOWNLOAD}</a><br>
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