<center>
<table border="0" width="700" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF" class="calborder">
	<tr>
		<td>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
      			<tr>
      				<td align="left" width="90" class="navback"><a href="{PRINTVIEW}.php?cal={CAL}&amp;getdate={GETDATE}"><img src="templates/{TEMPLATE}/images/back.gif" alt="{L_BACK}" border="0" align="left"></a>'; ?></td>
      				<td class="navback">
      					<table width="100%" border="0" cellspacing="0" cellpadding="0">
      						<tr>
								<td align="right" width="40%" class="navback"><a class="psf" href="print.php?cal={CAL}&amp;getdate={PREV}&amp;printview={PRINTVIEW}"><img src="templates/{TEMPLATE}/images/left_day.gif" alt="{L_PREV}" border="0" align="right"></a></td>
								<td align="center" width="20%" class="navback" nowrap valign="middle"><font class="H20">{display_date}</font></td>
      							<td align="left" width="40%" class="navback"><a class="psf" href="print.php?cal={CAL}&amp;getdate={NEXT}&amp;printview={PRINTVIEW}"><img src="templates/{TEMPLATE}/images/right_day.gif" alt="{L_NEXT}" border="0" align="left"></a></td>
      						</tr>
      					</table>
      				</td>
      				<td align="right" width="90" class="navback">	
      					<table width="90" border="0" cellpadding="0" cellspacing="0">
							<tr>
								<td><a class="psf" href="day.php?cal={CAL}&amp;getdate={GETDATE}"><img src="templates/{TEMPLATE}/images/day_on.gif" alt="{L_DAY}" border="0"></a></td>
								<td><a class="psf" href="week.php?cal={CAL}&amp;getdate={GETDATE}"><img src="templates/{TEMPLATE}/images/week_on.gif" alt="{L_WEEK}" border="0"></a></td>
								<td><a class="psf" href="month.php?cal={CAL}&amp;getdate={GETDATE}"><img src="templates/{TEMPLATE}/images/month_on.gif" alt="{L_MONTH}" border="0"></a></td>
							</tr>
						</table>
					</td>
      			</tr>
      		</table>
      	</td>
    </tr>
	<tr>
		<td colspan="3" class="dayborder"><img src="images/spacer.gif" width="1" height="5" alt=" "></td>
	</tr>
	<tr>
		<td colspan="3">
				<table border="0" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td align="center" valign="top">
							<table width="100%" border="0" cellspacing="0" cellpadding="0">
								<tr>
									<td colspan="3" height="1"></td>
								</tr>
								<tr>
									<td width="10"><img src="images/spacer.gif" width="10" height="1" alt=" "></td>
									<td align="left" colspan="2"><font class="V12"><b>{DAYOFMONTH}</b></font></td>
								</tr>
								<tr>
									<td colspan="3"><img src="images/spacer.gif" width="1" height="5" alt=" "></td>
								</tr>
											
								<!-- loop events on -->
								<tr>
									<td width="10"><img src="images/spacer.gif" width="10" height="1" alt=" "></td>
									<td width="10"><img src="images/spacer.gif" width="10" height="1" alt=" "></td>
									<td align="left">
										<table width="100%" border="0" cellspacing="1" cellpadding="1">
											<tr>
												<td width="100" class="G10BOLD">{L_TIME}:</td>
												<td align="left" class="G10B">{EVENT_START}</td>
											</tr>
											<tr>
												<td valign="top" width="100" class="G10BOLD">{L_SUMMARY}:</td>
												<td valign="top" align="left" class="G10B">{EVENT_TEXT}</td>
											</tr>
											<!-- switch description_events on -->
											<tr>
												<td valign="top" width="100" class="G10BOLD">{L_DESCRIPTION}:</td>
												<td valign="top" align="left" class="G10B">{DESCRIPTION}</td>
											</tr>
											<!-- switch description_events off -->
										</table>
									</td>
								</tr>			
								<tr>
									<td colspan="3"><img src="images/spacer.gif" width="1" height="10" alt=" "></td>
								</tr>
								<!-- loop events off -->
																	
								<!-- switch no_events on -->
								<tr>
									<td width="10"><img src="images/spacer.gif" width="10" height="1" alt=" "></td>
									<td align="left" colspan="2"><font class="V12"><br><center><b>{L_ZERO_EVENTS}</b></center></font><br></td>
								</tr>
								<tr>
									<td colspan="3"><img src="images/spacer.gif" width="1" height="5" alt=" "></td>
								</tr>
								<!-- switch no_events off -->
								
						</table>
					</td>
				</tr>
			</table>		
		</td>
	</tr>
</table>
