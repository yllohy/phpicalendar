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
								<td class="navback"><div style="padding: 5px;" class="H20">&nbsp;{DISPLAY_DATE}</div></td>
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
							<tr>	
								<td colspan="2">
									<table width="100%" border="0" cellspacing="1" cellpadding="2">
										<tr>
											<!-- loop daysofweek on -->
											<td width="14%" align="center" class="sideback">
												<a class="psf" href="day.php?cal={CAL}&amp;getdate={DAYLINK}"><span class="V9">{DAY}</span></a>
											</td>
											<!-- loop daysofweek off -->
										</tr>	
									</table>
								</td>
							</tr>      			
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<!-- loop allday on -->
						<div class="alldaybg_{CALNO}">
							{EVENT}
						</div>
						<!-- loop allday off -->
					</td>
				</tr>
      			<tr>
					<td align="center" valign="top" colspan="3">
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<!-- loop row on -->
							<tr>
								<td rowspan="4" align="center" valign="top" width="60" class="timeborder">11:00 AM</td>
								<td width="1" height="15"></td>
								<td class="dayborder">&nbsp;</td>
							</tr>
							<tr>
								<td width="1" height="15"></td>
								<td class="dayborder2">&nbsp;</td>
							</tr>
							<tr>
								<td width="1" height="15"></td>
								<td class="dayborder">&nbsp;</td>
							</tr>
							<tr>
								<td width="1" height="15"></td>
								<td class="dayborder2">&nbsp;</td>
							</tr>
							<!-- loop row off -->
							<tr>
								<td rowspan="4" align="center" valign="top" width="60" class="timeborder">12:00 PM</td>
								<td width="1" height="15"></td>
								<td class="dayborder">&nbsp;</td>
							</tr>
							<tr>
								<td width="1" height="15"></td>
								<td class="dayborder2">&nbsp;</td>
							</tr>
							<tr>
								<td width="1" height="15"></td>
								<td class="dayborder">&nbsp;</td>
							</tr>
							<tr>
								<td width="1" height="15"></td>
								<td class="dayborder2">&nbsp;</td>
							</tr>
						</table>
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
    	</td>
		<td width="10"><img src="images/spacer.gif" width="10" height="1" alt=" "></td>
		<td width="170" valign="top">
			{SIDEBAR}
		</td>
	</tr>
</table>
</center>
{FOOTER}

