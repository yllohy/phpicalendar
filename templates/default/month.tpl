{HEADER}
<center>
	<table width="735" border="0" cellspacing="0" cellpadding="0" class="calborder">
		<tr>
			<td align="center" valign="middle" bgcolor="white">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td align="left" width="120" class="navback">&nbsp;</td>
						<td class="navback">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td align="right" width="40%" class="navback"><a class="psf" href="month.php?cal={CAL}&amp;getdate={PREV_GETMONTH}"><img src="templates/{TEMPLATE}/images/left_day.gif" alt="{L_PREV}" border="0" align="right"></a></td>
									<td align="center" width="20%" class="navback" nowrap valign="middle"><font class="H20">{MONTH_TITLE}</font></td>
									<td align="left" width="40%" class="navback"><a class="psf" href="month.php?cal={CAL}&amp;getdate={NEXT_GETMONTH}"><img src="templates/{TEMPLATE}/images/right_day.gif" alt="{L_NEXT}" border="0" align="left"></a></td>
								</tr>
							</table>
						</td>
						<td align="right" width="120" class="navback">
							<table width="120" border="0" cellpadding="0" cellspacing="0">
								<tr>
								<td><a class="psf" href="day.php?cal={CAL}&amp;getdate={GETDATE}"><img src="templates/{TEMPLATE}/images/day_on.gif" alt="{L_DAY}" border="0"></a></td>
								<td><a class="psf" href="week.php?cal={CAL}&amp;getdate={GETDATE}"><img src="templates/{TEMPLATE}/images/week_on.gif" alt="{L_WEEK}" border="0"></a></td>
								<td><a class="psf" href="month.php?cal={CAL}&amp;getdate={GETDATE}"><img src="templates/{TEMPLATE}/images/month_on.gif" alt="{L_MONTH}" border="0"></a></td>
								<td><a class="psf" href="year.php?cal={CAL}&amp;getdate={GETDATE}"><img src="templates/{TEMPLATE}/images/year_on.gif" alt="{L_YEAR}" border="0"></a></td>
							</tr>
							</table>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td align="center" valign="top">
				<table width="100%" border="0" cellspacing="1" cellpadding="2" class="monthback">
					<tr>
						<!-- loop weekday on -->
						<td valign="top" width="105" height="12" class="dateback">
							<center class="V9BOLD">
								{LOOP_WEEKDAY}
							</center>
						</td>
						<!-- loop weekday off -->
					</tr>
					<!-- loop monthweeks on -->
					<tr height="105">
						<!-- switch notthismonth on -->
						<td valign="top" align="left" class="monthoff" width="105" height="105">
							<div align="right">
								<font class="G10"><a class="psf" href="day.php?cal={CAL}&amp;getdate={DAYLINK}"><font class="G10G">{DAY}</font></a></font>
							</div>
							<div align="left">
								<div align="left" class="V9">
									&nbsp; {JS_OPEN_EVENT} <a class="ps3" href="#" onclick="openEventWindow({EVENT_NUMBER}); return false;">{EVENT_TITLE}</a> 
								</div>
							</div>
						</td>
						<!-- switch notthismonth off -->
						<!-- switch isevent on -->
						<td valign="top" align="left" class="monthreg" width="105" height="105">
							<div align="right">
								<font class="G10"><a class="psf" href="day.php?cal={CAL}&amp;getdate={DAYLINK}">{DAY}</a></font>
							</div>
							<div align="left">
								<div align="left" class="V9">
									&nbsp; {JS_OPEN_EVENT} <a class="ps3" href="#" onclick="openEventWindow({EVENT_NUMBER}); return false;">{EVENT_TITLE}</a> 
								</div>
							</div>
						</td>
						<!-- switch isevent off -->
						<!-- switch notevent on -->
						<td valign="top" align="left" class="monthreg" width="105" height="105">
							<div align="right">
								<font class="G10"><a class="psf" href="day.php?cal={CAL}&amp;getdate={DAYLINK}">{DAY}</a></font>
							</div>
							<div align="left">
								<div align="left" class="V9">
									&nbsp; {JS_OPEN_EVENT} <a class="ps3" href="#" onclick="openEventWindow({EVENT_NUMBER}); return false;">{EVENT_TITLE}</a> 
								</div>
							</div>
						</td>
						<!-- switch notevent off -->
					</tr>
					<!-- loop monthweeks off -->
				</table>
			</td>
		</tr>
	</table>
	<br>
	{CALENDAR_NAV}
	<!-- switch showbottom on -->
	<br>
	<table width="737" border="0" cellspacing="0" cellpadding="3" class="calborder">
		<tr>
			<td colspan="3" align="center" class="sideback" nowrap>
				<div style="height: 16px;" class="G10BOLD">
					{L_THIS_MONTHS_EVENTS}
				</div>
			</td>
		</tr>
		<tr align="left" valign="top">
			<td width="155" class="G10B" nowrap>
				<a class="psf" href="{CAL}&amp;getdate={DAYLINK}">{START_DATE}</a> <font class="V9G">({START_TIME})</font>
			</td>
			<td width="5" class="montheventline" {ROWSPAN}></td>
			<td>
				{JS_OPENEVENT}<a class="psf" href="#" onclick="openEventWindow({EVENT_NUMBER}); return false;"><font class="G10B">{EVENT_TEXT}</font></a> 
			</td>
		</tr>
	</table>
	<!-- switch showbottom off -->
</center>
{FOOTER}
