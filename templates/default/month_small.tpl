<table width="170" border="0" cellpadding="3" cellspacing="0" class="calborder">
	<tr height="20">
		<td align="center" class="sideback"><font class="G10BOLD">{MONTH_TITLE}</font></td>
	</tr>
	<tr>
		<td bgcolor="#FFFFFF" align="center">
			<table border="0" cellspacing="0" cellpadding="0" bgcolor="#FFFFFF">
				<tr>
					<!-- loop weekday on -->	
					<td width="22" align="center" class="G10BOLD">{LOOP_WEEKDAY}</td>
					<!-- loop weekday off -->
				</tr>
				<!-- loop monthweeks on -->
				<tr>
					<!-- switch notthismonth on -->
					<td align="center" class="G10B">
						<a class="ps2" href="{MINICAL_VIEW}.php?cal={CAL}&amp;getdate={DAYLINK}"><span class="G10G">{DAY}</span></a>
					</td>
					<!-- switch notthismonth off -->
					<!-- switch isevent on -->
					<td align="center" class="G10B">
						<a class="ps2" href="{MINICAL_VIEW}.php?cal={CAL}&amp;getdate={DAYLINK}">{DAY}</a>
					</td>
					<!-- switch isevent off -->
					<!-- switch notevent on -->
					<td align="center" class="G10B">
						<a class="psf" href="{MINICAL_VIEW}.php?cal={CAL}&amp;getdate={DAYLINK}">{DAY}</a>
					</td>
					<!-- switch notevent off -->
				</tr>
				<!-- loop monthweeks off -->
			</table>
			<img src="images/spacer.gif" width="1" height="3" alt=" "><br>
		</td>
	</tr>
</table>