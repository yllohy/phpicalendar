<script language="JavaScript">
<!--
	function openEventInfo(event, calendarname, start, end, description)
	{	
		var windowW = 450;
		var windowH = 275;
	
		var url = "includes/event.php?event="+event+
			"&calendar_name="+calendarname+
			"&start="+start+
			"&end="+end+
			"&description="+description;
				
		options = "scrollbars=no"+",width="+windowW+",height="+windowH;
	
		info = window.open(url, "Popup", options);
		
		info.focus();
	}

//-->
</script>