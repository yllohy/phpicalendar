<table width="735" border="0" cellspacing="1" cellpadding="2" class="monthback">
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
		<!-- loop monthdays on -->
		<!-- switch notthismonth on -->
		<td valign="top" align="left" class="monthoff" width="105" height="105">
			<div align="right">
				<a class="psf" href="day.php?cal={CAL}&amp;getdate={DAYLINK}"><font class="G10G">{DAY}</font></a>
			</div>
			<!-- switch allday on -->
				{ALLDAY}
			<!-- switch allday off -->
			<!-- switch event on -->
				{EVENT}	
			<!-- switch event off -->
			
		</td>
		<!-- switch notthismonth off -->
		<!-- switch istoday on -->
		<td valign="top" align="left" class="monthon" width="105" height="105">
			<div align="right">
				<a class="psf" href="day.php?cal={CAL}&amp;getdate={DAYLINK}">{DAY}</a>
			</div>
			<!-- switch allday on -->
				{ALLDAY}
			<!-- switch allday off -->
			<!-- switch event on -->
				{EVENT}
			<!-- switch event off -->
		</td>
		<!-- switch istoday off -->
		<!-- switch ismonth on -->
		<td valign="top" align="left" class="monthreg" width="105" height="105">
			<div align="right">
				<a class="psf" href="day.php?cal={CAL}&amp;getdate={DAYLINK}">{DAY}</a>
			</div>
			<!-- switch allday on -->
				{ALLDAY}
			<!-- switch allday off -->
			<!-- switch event on -->
				{EVENT}
			<!-- switch event off -->
		</td>
		<!-- switch ismonth off -->
		<!-- loop monthdays off -->
	</tr>
	<!-- loop monthweeks off -->
</table>
