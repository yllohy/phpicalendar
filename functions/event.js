<?php 
// Version Info:
// 21-jan-03, Marook: Removed Scrollbar param, to allow browser to auto-disply when needed.
?>
<script language="JavaScript" type="text/javascript">
<!--
	function openEventInfo(event, calendarname, start, end, description, status)
	{	
		var windowW = 460;
		var windowH = 275;
	
		var url = "includes/event.php?event="+event+
			"&cal="+calendarname+
			"&start="+start+
			"&end="+end+
			"&description="+description+
			"&status="+status;
				
		options = "scrollbars=yes,width="+windowW+",height="+windowH;
	
		info = window.open(url, "Popup", options);
		
		info.focus();
	}

//-->
</script>
