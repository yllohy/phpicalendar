<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
		"http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8">
	<title>{CALENDAR_NAME}</title>
	<link rel="stylesheet" type="text/css" href="{SHEET_HREF}">
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
					<p>{VTODO_TEXT}</p>
					<!-- Switch Description On -->
					<p>{DESCRIPTION}</p>
					<!-- Switch Description Off -->
					<!-- Switch Status On -->
					<p>{STATUS_LANG}: {STATUS}</p>
					<!-- Switch Status Off -->
					<!-- Switch Priority On -->
					<p>{PRIORITY_LANG}: {PRIORITY}</p>
					<!-- Switch Priority Off -->
					<!-- Switch Created On -->
					<p>{CREATED_LANG}: {START_DATE}</p>
					<!-- Switch Created Off -->
					<!-- Switch Due On -->
					<p>{DUE_LANG}: {DUE_DATE}</p>
					<!-- Switch Due Off -->
				</div>
			</td>
		</tr>
	</table>
</center>
</body>
</html>
