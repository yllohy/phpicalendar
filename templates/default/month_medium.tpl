<table border="0" width="210" cellspacing="0" cellpadding="0" class="calborder">
	<tr>
		<td align="center" class="sideback"><div style="height: 16px; margin-top: 3px;" class="G10BOLD"><a class="ps3" href="month.php?cal={CAL}&amp;getdate={MONTH_DATE}">{MONTH_TITLE}</a></div></td>
	</tr>
	<tr>
		<td>
			<table border="0" width="210" cellspacing="1" cellpadding="0" class="yearmonth">
				<tr>
					<!-- loop weekday on -->
					<td width="30" height="14" class="dateback" align="center"><font class="V9BOLD">{LOOP_WEEKDAY}</font></td>
					<!-- loop weekday off -->
				</tr>
				<!-- loop monthweeks on -->
				<tr>
					<!-- loop monthdays on -->
					<!-- switch notthismonth on -->
					<td class="yearoff" onmouseover="this.style.backgroundColor='#DDDDDD'" onmouseout="this.style.backgroundColor='#F2F2F2'" onclick="window.location.href='day.php?cal=all_calendars_combined971&amp;getdate={DAYLINK}'">
						<div align="right" class="V9"><a class="psf" href="day.php?cal={CAL}&amp;getdate={DAYLINK}">{DAY}</a></div>
					</td>
					<!-- switch notthismonth off -->
					<!-- switch istoday on -->
					<td class="yearreg" onmouseover="this.style.backgroundColor='#DDDDDD'" onmouseout="this.style.backgroundColor='#FFFFFF'" onclick="window.location.href='day.php?cal=all_calendars_combined971&amp;getdate={DAYLINK}'">
						<div align="right" class="V9"><a class="psf" href="day.php?cal={CAL}&amp;getdate={DAYLINK}">{DAY}</a></div>
						<div align="center">
							{ALLDAY}
							{EVENT}
						</div>
					</td>
					<!-- switch istoday off -->
					<!-- switch ismonth on -->
					<td class="yearreg" onmouseover="this.style.backgroundColor='#DDDDDD'" onmouseout="this.style.backgroundColor='#FFFFFF'" onclick="window.location.href='day.php?cal=all_calendars_combined971&amp;getdate={DAYLINK}'">
						<div align="right" class="V9"><a class="psf" href="day.php?cal={CAL}&amp;getdate={DAYLINK}">{DAY}</a></div>
						<div align="center">
							{ALLDAY}
							{EVENT}
						</div>
					</td>
					<!-- switch ismonth off -->
					<!-- loop monthdays off -->
				</tr>
				<!-- loop monthweeks off -->	
			</table>
		</td>
	</tr>
</table>
