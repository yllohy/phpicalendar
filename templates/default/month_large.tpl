
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
