{HEADER}
<center>
<table border="0" width="700" cellspacing="0" cellpadding="0">
	<tr>
		<td width="520" valign="top">
			<table width="520" border="0" cellspacing="0" cellpadding="0" class="calborder">
				<tr>
					<td align="center" valign="middle">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td align="left" width="120" class="navback">&nbsp;</td>
								<td class="navback">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="right" width="40%" class="navback"><a class="psf" href="day.php?cal={CAL}&amp;getdate={PREV_DAY}"><img src="templates/{TEMPLATE}/images/left_day.gif" alt="{L_PREV}" border="0" align="right"></a></td>
											<td align="center" width="20%" class="navback" nowrap valign="middle"><font class="H20">{DISPLAY_DATE}</font></td>
											<td align="left" width="40%" class="navback"><a class="psf" href="day.php?cal={CAL}&amp;getdate={NEXT_DAY}"><img src="templates/{TEMPLATE}/images/right_day.gif" alt="{L_NEXT}" border="0" align="left"></a></td>
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
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="G10B">	
							<!-- loop allday on -->
							<tr>
								<td height="24">
									<table width="100%" border="0" cellspacing="1" cellpadding="4">
										<tr>
											<td valign="top" align="center" class="eventbg_{EVENT_CALNO}">
												<font color="#ffffff"><i>{EVENT}</i></font>
											</td>
										</tr>
									</table>
								</td>
							</tr>
							<!-- loop allday off -->
						</table>
					</td>
				</tr>
				<!-- switch showdays on -->
				<tr>	
					<td>
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td colspan="7"><img src="images/spacer.gif" width="70" height="1" alt=" "></td>
							</tr>
							<tr>
								<td width="74" valign="top" align="center" class="dateback">
									<font class="V9"><a class="psf" href="day.php?cal={CAL}&amp;getdate={THISDAY}">{DAY}</a></font>
								</td>
							</tr>	
						</table>
					</td>
				</tr>      			
				<!-- switch showdays off -->
      			<tr>
					<td align="center" valign="top" colspan="3">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td width="60"><img src="images/spacer.gif" width="60" height="1" alt=" "></td>
								<td width="1"></td>
								<!-- loop spacer on -->
								<td><img src="images/spacer.gif" width="{NBRGRIDCOLS_SPACE}" height="1" alt=" "></td>
								<!-- loop spacer off -->
							</tr>
							<!-- loop row on -->
							<tr>
								<td rowspan="{ROWSPAN}" align="center" valign="top" width="60" class="timeborder">{TIME}</td>
								<td width="1" height="{GRIDLENGTH}"></td>
								<!-- switch event on -->
								<td rowspan="6" colspan="1" align="left" valign="top" class="eventbg2_1">
									<table width="100%" border="0" cellspacing="0" cellpadding="2">
										<tr>
											<td class="eventborder"><font class="eventfont"><b>{EVENT_START}</b> - {EVENT_END}</font></td>
										</tr>
										<tr>
											<td colspan="2">
												<table width="100%" border="0" cellpadding="1" cellspacing="0">
													<tr>
														<td class="eventbg_{CALNO}">{SUMMARY}</td>
													</tr>
												</table>
											</td>
										</tr>
									</table>
								</td>
								<!-- switch event off -->
							</tr>
							<tr>
								<td width="1" height="{GRIDLENGTH}"></td>
							</tr>
							<tr>
								<td width="1" height="{GRIDLENGTH}"></td>
							</tr>
							<tr>
								<td width="1" height="{GRIDLENGTH}"></td>
							</tr>
							<tr>
							<!-- loop row off -->
						</table>
					</td>
				</tr>
        	</table>
    	</td>
	</tr>
</table>
</td>
<td width="10"><img src="images/spacer.gif" width="10" height="1" alt=" "></td>
		<td width="170" valign="top">
			{SIDEBAR}
		</td>
	</tr>
</table>
</center>
{FOOTER}

