<table width="170" border="0" cellpadding="0" cellspacing="0" class="calborder">
	<tr>
		<td align="left" valign="top" width="24" class="sideback"><a class="psf" href="day.php?cal={CAL}&amp;getdate={YESTERDAYS_DATE}"><img src="templates/{TEMPLATE}/images/left_arrows.gif" alt="{PREV_LANG}" width="16" height="20" border="0" align="left"></a></td>
		<td align="center" width="112" class="sideback"><font class="G10BOLD">{DISPLAY_DATE}</font></td>
		<td align="right" valign="top" width="24" class="sideback"><a class="psf" href="day.php?cal={CAL}&amp;getdate={TOMORROWS_DATE}"><img src="templates/{TEMPLATE}/images/right_arrows.gif" alt="{NEXT_LANG}" width="16" height="20" border="0" align="right"></a></td>
	</tr>
	<tr>
		<td colspan="3" bgcolor="#FFFFFF" align="left">
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
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4"></td>
		<td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4"></td>
		<td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4"></td>
	</tr>
</table>
<img src="images/spacer.gif" width="1" height="10" alt=" "><br>

<table width="170" border="0" cellpadding="0" cellspacing="0" class="calborder">
	<tr height="20">
		<td align="center" class="sideback"><div style="height: 20px; margin-top: 3px;" class="G10BOLD">{L_JUMP}</div></td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" align="left">
			<div style="padding: 5px;">
				<form style="margin-bottom:0;" action="{CURRENT_VIEW}.php" method="GET">
					<select name="action" class="query_style" onChange="window.location=(this.options[this.selectedIndex].value);">{LIST_ICALS}</select><br>
					<select name="action" class="query_style" onChange="window.location=(this.options[this.selectedIndex].value);">{LIST_YEARS}</select><br>
					<select name="action" class="query_style" onChange="window.location=(this.options[this.selectedIndex].value);">{LIST_MONTHS}</select><br>
					<select name="action" class="query_style" onChange="window.location=(this.options[this.selectedIndex].value);">{LIST_WEEKS}</select><br>
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
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4"></td>
		<td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4"></td>
		<td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4"></td>
	</tr>
</table>
<img src="images/spacer.gif" width="1" height="10" alt=" "><br>

<!-- switch tomorrows_events on -->

<table width="170" border="0" cellpadding="0" cellspacing="0" class="calborder">
	<tr height="20">
		<td align="center" class="sideback"><div style="height: 20px; margin-top: 3px;" class="G10BOLD">{L_TOMORROWS}</div></td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" align="left">
			<div style="padding: 5px;">
				<!-- switch t_allday on -->
				<i>{T_ALLDAY}</i><br>
				<!-- switch t_allday off -->
				<!-- switch t_event on -->
				&#149; {T_EVENT}<br>
				<!-- switch t_event off -->
			</div>
		</td>
	</tr>
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4"></td>
		<td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4"></td>
		<td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4"></td>
	</tr>
</table>
<img src="images/spacer.gif" width="1" height="10" alt=" "><br>

<!-- switch tomorrows_events off -->

<!-- switch todo on -->

<table width="170" border="0" cellpadding="0" cellspacing="0" class="calborder">
	<tr height="20">
		<td align="center" width="98%" class="sideback"><div style="height: 20px; margin-top: 3px;" class="G10BOLD">{L_TODO}</div></td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" align="left">
			<div style="padding: 5px;">
				<table cellpadding="0" cellspacing="0" border="0">
					<!-- switch show_completed on -->
					<tr>
						<td><img src="images/completed.gif" alt=" " width="13" height="11" border="0" align="middle"></td>
						<td><img src="images/spacer.gif" width="2" height="1" border"0" /></td>
						<td><s><a class="psf" href="javascript:openTodoInfo('{VTODO_ARRAY}')"><font class="G10B"> {VTODO_TEXT}</font></a></s></td>
					</tr>
					<!-- switch show_completed off -->
					<!-- switch show_important on -->
					<tr>
						<td><img src="images/important.gif" alt=" " width="13" height="11" border="0" align="middle"></td>
						<td><img src="images/spacer.gif" width="2" height="1" border"0" /></td>
						<td><a class="psf" href="javascript:openTodoInfo('{VTODO_ARRAY}')"><font class="G10B"> {VTODO_TEXT}</font></a></td>
					</tr>
					<!-- switch show_important off -->
					<!-- switch show_normal on -->
					<tr>
						<td><img src="images/not_completed.gif" alt=" " width="13" height="11" border="0" align="middle"></td>
						<td><img src="images/spacer.gif" width="2" height="1" border"0" /></td>
						<td><a class="psf" href="javascript:openTodoInfo('{VTODO_ARRAY}')"><font class="G10B"> {VTODO_TEXT}</font></a></td>
					</tr>
					<!-- switch show_normal on -->
				</table>
			</div>
		</td>
	</tr>			
</table>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4"></td>
		<td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4"></td>
		<td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4"></td>
	</tr>
</table>
<img src="images/spacer.gif" width="1" height="10" alt=" "><br>


<!-- switch todo off -->

{MONTH_SMALL|-1}
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4"></td>
		<td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4"></td>
		<td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4"></td>
	</tr>
</table>
<img src="images/spacer.gif" width="1" height="10" alt=" "><br>

{MONTH_SMALL|+0}
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4"></td>
		<td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4"></td>
		<td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4"></td>
	</tr>
</table>
<img src="images/spacer.gif" width="1" height="10" alt=" "><br>

{MONTH_SMALL|+1}
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td class="tbll"><img src="images/spacer.gif" alt="" width="8" height="4"></td>
		<td class="tblbot"><img src="images/spacer.gif" alt="" width="8" height="4"></td>
		<td class="tblr"><img src="images/spacer.gif" alt="" width="8" height="4"></td>
	</tr>
</table>