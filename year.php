<?php
$current_view = 'year';
include('./functions/ical_parser.php');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/1999/REC-html401-19991224/loose.dtd">
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<title><?php echo $calendar_name; ?></title>
	<link rel="stylesheet" type="text/css" href="styles/<?php echo $style_sheet.'/default.css'; ?>">
	<meta name="generator" content="BBEdit 6.5.3">
</head>
<body>
<center>
<table border="0" width="670" cellspacing="0" cellpadding="0">
	<tr>
		<td width="210">
			<table border="0" width="210" cellspacing="0" cellpadding="0" class="calborder">
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="0" cellpadding="0">
							<tr>
								<td width="1" class="sideback"><img src="images/spacer.gif" width="1" height="20" alt=""></td>
								<td align="center" class="sideback"><font class="G10BOLD">January 2002</font></td>
								<td width="1" class="sideback"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Sun</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Mon</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Tue</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Wed</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Thu</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Fri</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Sat</font></td>
				</tr>
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="1" cellpadding="0" class="yearmonth">
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">1</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">2</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">3</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">4</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">5</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">6</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">7</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">8</a>
											</td>
										</tr>
										<tr>
											<td align="center" valign="top"><img src="styles/silver/allday_dot.gif" alt="" border="0"><img src="styles/silver/event_dot.gif" alt="" border="0"></td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">9</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">10</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">11</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">12</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">13</a>
											</td>
										</tr>
										<tr>
											<td align="center" valign="top"><img src="styles/silver/event_dot.gif" alt="" border="0"></td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">14</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">15</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">16</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">17</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">18</a>
											</td>
										</tr>
										<tr>
											<td align="center">
												<img src="styles/silver/allday_dot.gif" alt="" border="0">
											</td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">19</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">20</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">21</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">22</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">23</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">24</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">25</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">26</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">27</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">28</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">29</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">30</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">31</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">1</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">2</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">3</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">4</font></a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
		<td width="20"><img src="images/spacer.gif" width="20" height="1" alt=""></td>
		<td width="210">
			<table border="0" width="210" cellspacing="0" cellpadding="0" class="calborder">
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="0" cellpadding="0">
							<tr>
								<td width="1" class="sideback"><img src="images/spacer.gif" width="1" height="20" alt=""></td>
								<td align="center" class="sideback"><font class="G10BOLD">February 2002</font></td>
								<td width="1" class="sideback"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Sun</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Mon</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Tue</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Wed</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Thu</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Fri</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Sat</font></td>
				</tr>
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="1" cellpadding="0" class="yearmonth">
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">1</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">2</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">3</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">4</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">5</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">6</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">7</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">8</a>
											</td>
										</tr>
										<tr>
											<td align="center" valign="top"><img src="styles/silver/allday_dot.gif" alt="" border="0"><img src="styles/silver/event_dot.gif" alt="" border="0"></td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">9</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">10</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">11</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">12</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">13</a>
											</td>
										</tr>
										<tr>
											<td align="center" valign="top"><img src="styles/silver/event_dot.gif" alt="" border="0"></td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">14</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">15</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">16</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">17</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">18</a>
											</td>
										</tr>
										<tr>
											<td align="center">
												<img src="styles/silver/allday_dot.gif" alt="" border="0">
											</td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">19</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">20</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">21</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">22</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">23</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">24</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">25</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">26</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">27</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">28</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">29</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">30</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">31</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">1</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">2</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">3</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">4</font></a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
		<td width="20"><img src="images/spacer.gif" width="20" height="1" alt=""></td>
		<td width="210">
			<table border="0" width="210" cellspacing="0" cellpadding="0" class="calborder">
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="0" cellpadding="0">
							<tr>
								<td width="1" class="sideback"><img src="images/spacer.gif" width="1" height="20" alt=""></td>
								<td align="center" class="sideback"><font class="G10BOLD">March 2002</font></td>
								<td width="1" class="sideback"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Sun</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Mon</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Tue</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Wed</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Thu</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Fri</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Sat</font></td>
				</tr>
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="1" cellpadding="0" class="yearmonth">
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">1</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">2</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">3</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">4</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">5</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">6</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">7</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">8</a>
											</td>
										</tr>
										<tr>
											<td align="center" valign="top"><img src="styles/silver/allday_dot.gif" alt="" border="0"><img src="styles/silver/event_dot.gif" alt="" border="0"></td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">9</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">10</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">11</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">12</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">13</a>
											</td>
										</tr>
										<tr>
											<td align="center" valign="top"><img src="styles/silver/event_dot.gif" alt="" border="0"></td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">14</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">15</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">16</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">17</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">18</a>
											</td>
										</tr>
										<tr>
											<td align="center">
												<img src="styles/silver/allday_dot.gif" alt="" border="0">
											</td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">19</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">20</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">21</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">22</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">23</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">24</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">25</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">26</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">27</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">28</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">29</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">30</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">31</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">1</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">2</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">3</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">4</font></a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="5"><img src="images/spacer.gif" width="1" height="20" alt=""></td>
	</tr>
	<tr>
		<td width="210">
			<table border="0" width="210" cellspacing="0" cellpadding="0" class="calborder">
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="0" cellpadding="0">
							<tr>
								<td width="1" class="sideback"><img src="images/spacer.gif" width="1" height="20" alt=""></td>
								<td align="center" class="sideback"><font class="G10BOLD">April 2002</font></td>
								<td width="1" class="sideback"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Sun</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Mon</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Tue</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Wed</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Thu</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Fri</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Sat</font></td>
				</tr>
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="1" cellpadding="0" class="yearmonth">
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">1</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">2</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">3</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">4</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">5</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">6</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">7</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">8</a>
											</td>
										</tr>
										<tr>
											<td align="center" valign="top"><img src="styles/silver/allday_dot.gif" alt="" border="0"><img src="styles/silver/event_dot.gif" alt="" border="0"></td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">9</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">10</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">11</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">12</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">13</a>
											</td>
										</tr>
										<tr>
											<td align="center" valign="top"><img src="styles/silver/event_dot.gif" alt="" border="0"></td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">14</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">15</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">16</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">17</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">18</a>
											</td>
										</tr>
										<tr>
											<td align="center">
												<img src="styles/silver/allday_dot.gif" alt="" border="0">
											</td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">19</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">20</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">21</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">22</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">23</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">24</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">25</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">26</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">27</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">28</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">29</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">30</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">31</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">1</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">2</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">3</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">4</font></a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
		<td width="20"><img src="images/spacer.gif" width="20" height="1" alt=""></td>
		<td width="210">
			<table border="0" width="210" cellspacing="0" cellpadding="0" class="calborder">
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="0" cellpadding="0">
							<tr>
								<td width="1" class="sideback"><img src="images/spacer.gif" width="1" height="20" alt=""></td>
								<td align="center" class="sideback"><font class="G10BOLD">May 2002</font></td>
								<td width="1" class="sideback"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Sun</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Mon</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Tue</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Wed</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Thu</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Fri</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Sat</font></td>
				</tr>
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="1" cellpadding="0" class="yearmonth">
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">1</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">2</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">3</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">4</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">5</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">6</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">7</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">8</a>
											</td>
										</tr>
										<tr>
											<td align="center" valign="top"><img src="styles/silver/allday_dot.gif" alt="" border="0"><img src="styles/silver/event_dot.gif" alt="" border="0"></td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">9</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">10</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">11</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">12</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">13</a>
											</td>
										</tr>
										<tr>
											<td align="center" valign="top"><img src="styles/silver/event_dot.gif" alt="" border="0"></td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">14</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">15</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">16</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">17</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">18</a>
											</td>
										</tr>
										<tr>
											<td align="center">
												<img src="styles/silver/allday_dot.gif" alt="" border="0">
											</td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">19</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">20</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">21</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">22</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">23</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">24</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">25</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">26</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">27</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">28</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">29</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">30</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">31</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">1</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">2</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">3</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">4</font></a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
		<td width="20"><img src="images/spacer.gif" width="20" height="1" alt=""></td>
		<td width="210">
			<table border="0" width="210" cellspacing="0" cellpadding="0" class="calborder">
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="0" cellpadding="0">
							<tr>
								<td width="1" class="sideback"><img src="images/spacer.gif" width="1" height="20" alt=""></td>
								<td align="center" class="sideback"><font class="G10BOLD">June 2002</font></td>
								<td width="1" class="sideback"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Sun</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Mon</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Tue</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Wed</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Thu</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Fri</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Sat</font></td>
				</tr>
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="1" cellpadding="0" class="yearmonth">
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">1</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">2</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">3</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">4</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">5</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">6</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">7</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">8</a>
											</td>
										</tr>
										<tr>
											<td align="center" valign="top"><img src="styles/silver/allday_dot.gif" alt="" border="0"><img src="styles/silver/event_dot.gif" alt="" border="0"></td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">9</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">10</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">11</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">12</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">13</a>
											</td>
										</tr>
										<tr>
											<td align="center" valign="top"><img src="styles/silver/event_dot.gif" alt="" border="0"></td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">14</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">15</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">16</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">17</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">18</a>
											</td>
										</tr>
										<tr>
											<td align="center">
												<img src="styles/silver/allday_dot.gif" alt="" border="0">
											</td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">19</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">20</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">21</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">22</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">23</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">24</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">25</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">26</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">27</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">28</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">29</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">30</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">31</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">1</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">2</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">3</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">4</font></a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="5"><img src="images/spacer.gif" width="1" height="20" alt=""></td>
	</tr>
	<tr>
		<td width="210">
			<table border="0" width="210" cellspacing="0" cellpadding="0" class="calborder">
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="0" cellpadding="0">
							<tr>
								<td width="1" class="sideback"><img src="images/spacer.gif" width="1" height="20" alt=""></td>
								<td align="center" class="sideback"><font class="G10BOLD">July 2002</font></td>
								<td width="1" class="sideback"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Sun</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Mon</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Tue</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Wed</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Thu</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Fri</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Sat</font></td>
				</tr>
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="1" cellpadding="0" class="yearmonth">
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">1</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">2</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">3</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">4</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">5</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">6</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">7</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">8</a>
											</td>
										</tr>
										<tr>
											<td align="center" valign="top"><img src="styles/silver/allday_dot.gif" alt="" border="0"><img src="styles/silver/event_dot.gif" alt="" border="0"></td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">9</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">10</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">11</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">12</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">13</a>
											</td>
										</tr>
										<tr>
											<td align="center" valign="top"><img src="styles/silver/event_dot.gif" alt="" border="0"></td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">14</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">15</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">16</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">17</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">18</a>
											</td>
										</tr>
										<tr>
											<td align="center">
												<img src="styles/silver/allday_dot.gif" alt="" border="0">
											</td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">19</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">20</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">21</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">22</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">23</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">24</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">25</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">26</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">27</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">28</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">29</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">30</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">31</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">1</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">2</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">3</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">4</font></a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
		<td width="20"><img src="images/spacer.gif" width="20" height="1" alt=""></td>
		<td width="210">
			<table border="0" width="210" cellspacing="0" cellpadding="0" class="calborder">
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="0" cellpadding="0">
							<tr>
								<td width="1" class="sideback"><img src="images/spacer.gif" width="1" height="20" alt=""></td>
								<td align="center" class="sideback"><font class="G10BOLD">August 2002</font></td>
								<td width="1" class="sideback"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Sun</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Mon</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Tue</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Wed</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Thu</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Fri</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Sat</font></td>
				</tr>
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="1" cellpadding="0" class="yearmonth">
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">1</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">2</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">3</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">4</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">5</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">6</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">7</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">8</a>
											</td>
										</tr>
										<tr>
											<td align="center" valign="top"><img src="styles/silver/allday_dot.gif" alt="" border="0"><img src="styles/silver/event_dot.gif" alt="" border="0"></td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">9</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">10</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">11</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">12</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">13</a>
											</td>
										</tr>
										<tr>
											<td align="center" valign="top"><img src="styles/silver/event_dot.gif" alt="" border="0"></td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">14</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">15</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">16</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">17</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">18</a>
											</td>
										</tr>
										<tr>
											<td align="center">
												<img src="styles/silver/allday_dot.gif" alt="" border="0">
											</td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">19</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">20</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">21</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">22</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">23</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">24</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">25</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">26</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">27</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">28</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">29</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">30</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">31</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">1</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">2</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">3</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">4</font></a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
		<td width="20"><img src="images/spacer.gif" width="20" height="1" alt=""></td>
		<td width="210">
			<table border="0" width="210" cellspacing="0" cellpadding="0" class="calborder">
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="0" cellpadding="0">
							<tr>
								<td width="1" class="sideback"><img src="images/spacer.gif" width="1" height="20" alt=""></td>
								<td align="center" class="sideback"><font class="G10BOLD">September 2002</font></td>
								<td width="1" class="sideback"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Sun</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Mon</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Tue</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Wed</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Thu</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Fri</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Sat</font></td>
				</tr>
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="1" cellpadding="0" class="yearmonth">
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">1</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">2</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">3</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">4</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">5</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">6</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">7</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">8</a>
											</td>
										</tr>
										<tr>
											<td align="center" valign="top"><img src="styles/silver/allday_dot.gif" alt="" border="0"><img src="styles/silver/event_dot.gif" alt="" border="0"></td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">9</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">10</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">11</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">12</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">13</a>
											</td>
										</tr>
										<tr>
											<td align="center" valign="top"><img src="styles/silver/event_dot.gif" alt="" border="0"></td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">14</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">15</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">16</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">17</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">18</a>
											</td>
										</tr>
										<tr>
											<td align="center">
												<img src="styles/silver/allday_dot.gif" alt="" border="0">
											</td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">19</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">20</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">21</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">22</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">23</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">24</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">25</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">26</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">27</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">28</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">29</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">30</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">31</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">1</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">2</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">3</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">4</font></a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="5"><img src="images/spacer.gif" width="1" height="20" alt=""></td>
	</tr>
	<tr>
		<td width="210">
			<table border="0" width="210" cellspacing="0" cellpadding="0" class="calborder">
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="0" cellpadding="0">
							<tr>
								<td width="1" class="sideback"><img src="images/spacer.gif" width="1" height="20" alt=""></td>
								<td align="center" class="sideback"><font class="G10BOLD">October 2002</font></td>
								<td width="1" class="sideback"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Sun</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Mon</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Tue</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Wed</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Thu</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Fri</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Sat</font></td>
				</tr>
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="1" cellpadding="0" class="yearmonth">
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">1</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">2</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">3</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">4</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">5</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">6</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">7</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">8</a>
											</td>
										</tr>
										<tr>
											<td align="center" valign="top"><img src="styles/silver/allday_dot.gif" alt="" border="0"><img src="styles/silver/event_dot.gif" alt="" border="0"></td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">9</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">10</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">11</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">12</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">13</a>
											</td>
										</tr>
										<tr>
											<td align="center" valign="top"><img src="styles/silver/event_dot.gif" alt="" border="0"></td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">14</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">15</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">16</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">17</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">18</a>
											</td>
										</tr>
										<tr>
											<td align="center">
												<img src="styles/silver/allday_dot.gif" alt="" border="0">
											</td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">19</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">20</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">21</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">22</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">23</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">24</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">25</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">26</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">27</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">28</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">29</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">30</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">31</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">1</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">2</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">3</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">4</font></a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>	
		</td>
		<td width="20"><img src="images/spacer.gif" width="20" height="1" alt=""></td>
		<td width="210">
			<table border="0" width="210" cellspacing="0" cellpadding="0" class="calborder">
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="0" cellpadding="0">
							<tr>
								<td width="1" class="sideback"><img src="images/spacer.gif" width="1" height="20" alt=""></td>
								<td align="center" class="sideback"><font class="G10BOLD">November 2002</font></td>
								<td width="1" class="sideback"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Sun</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Mon</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Tue</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Wed</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Thu</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Fri</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Sat</font></td>
				</tr>
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="1" cellpadding="0" class="yearmonth">
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">1</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">2</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">3</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">4</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">5</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">6</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">7</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">8</a>
											</td>
										</tr>
										<tr>
											<td align="center" valign="top"><img src="styles/silver/allday_dot.gif" alt="" border="0"><img src="styles/silver/event_dot.gif" alt="" border="0"></td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">9</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">10</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">11</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">12</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">13</a>
											</td>
										</tr>
										<tr>
											<td align="center" valign="top"><img src="styles/silver/event_dot.gif" alt="" border="0"></td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">14</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">15</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">16</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">17</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">18</a>
											</td>
										</tr>
										<tr>
											<td align="center">
												<img src="styles/silver/allday_dot.gif" alt="" border="0">
											</td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">19</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">20</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">21</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">22</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">23</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">24</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">25</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">26</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">27</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">28</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">29</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">30</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">31</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">1</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">2</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">3</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">4</font></a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
		<td width="20"><img src="images/spacer.gif" width="20" height="1" alt=""></td>
		<td width="210">
			<table border="0" width="210" cellspacing="0" cellpadding="0" class="calborder">
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="0" cellpadding="0">
							<tr>
								<td width="1" class="sideback"><img src="images/spacer.gif" width="1" height="20" alt=""></td>
								<td align="center" class="sideback"><font class="G10BOLD">December 2002</font></td>
								<td width="1" class="sideback"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Sun</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Mon</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Tue</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Wed</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Thu</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Fri</font></td>
					<td width="30" height="14" class="monthoff" align="center"><font class="V9BOLD">Sat</font></td>
				</tr>
				<tr>
					<td colspan="7">
						<table border="0" width="210" cellspacing="1" cellpadding="0" class="yearmonth">
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">1</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">2</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">3</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">4</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">5</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">6</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">7</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">8</a>
											</td>
										</tr>
										<tr>
											<td align="center" valign="top"><img src="styles/silver/allday_dot.gif" alt="" border="0"><img src="styles/silver/event_dot.gif" alt="" border="0"></td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">9</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">10</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">11</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">12</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="1">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">13</a>
											</td>
										</tr>
										<tr>
											<td align="center" valign="top"><img src="styles/silver/event_dot.gif" alt="" border="0"></td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">14</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">15</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">16</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">17</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<table width="100%" border="0" cellspacing="0" cellpadding="0">
										<tr>
											<td align="right" valign="top" class="V9">
											<a class="psf" href="day.php?cal=Home&getdate=20021001">18</a>
											</td>
										</tr>
										<tr>
											<td align="center">
												<img src="styles/silver/allday_dot.gif" alt="" border="0">
											</td>
										</tr>
									</table>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">19</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">20</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">21</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">22</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">23</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">24</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">25</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">26</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">27</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">28</a></font>
								</td>
							</tr>
							<tr height="30">
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">29</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">30</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthreg" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#FFFFFF" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<font class="V9"><a class="psf" href="day.php?cal=Home&getdate=20021001">31</a></font>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">1</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">2</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">3</font></a>
								</td>
								<td width="30" height="30" align="right" valign="top" class="monthoff" onMouseOver=this.style.backgroundColor="#DDDDDD" onMouseOut=this.style.backgroundColor="#F2F2F2" onclick="window.location.href='day.php?cal=Home&getdate=20021001'">
									<a class="psf" href="day.php?cal=Home&getdate=20021001"><font class="V9G">4</font></a>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

</center>
</body>
</html>
