<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
		"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<title>{CAL}</title>
	<link rel="stylesheet" type="text/css" href="../templates/{TEMPLATE}/default.css">
</head>
<body>
<center>
	<table border="0" width="430" cellspacing="0" cellpadding="0" class="calborder">
		<tr>
			<td align="center" class="sideback"><div style="height: 17px; margin-top: 3px;" class="G10BOLD">{CAL_TITLE_FULL}</div></td>
		</tr>
		<tr>
			<td align="left" class="V12">
				<div style="margin-left: 10px; margin-bottom:10px;">
					<p>{EVENT} - <span class="V9">(<i>{EVENT_TIMES}</i>)</font></p>
					<!-- switch description on -->
					<p>{DESCRIPTION}</p>
					<!-- switch description off -->
					<!-- switch organizer on -->
					<p><b>{ORGANIZER_LANG}</b>: {ORGANIZER}</p>
					<!-- switch organizer off -->
					<!-- switch attendee on -->
					<p><b>{ATTENDEE_LANG}</b>: {ATTENDEE}</p>
					<!-- switch attendee off -->
					<!-- switch status on -->
					<p><b>{STATUS_LANG}</b>: {STATUS}</p>
					<!-- switch status off -->
					<!-- switch location on -->
					<p><b>{LOCATIon_LANG}</b>: {LOCATIon}</p>
					<!-- switch location off -->
				</div>
			</td>
		</tr>
	</table>
</center>
</body>
</html>

