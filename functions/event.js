<script language="JavaScript">
<!--
	function openEventInfo(event, calendarname, start, end)
	{	
		var windowW = 450;
		var windowH = 175;
	
		var url = "event.php?event="+escape(event)+
			"&calendar_name="+escape(calendarname)+
			"&start="+escape(start)+
			"&end="+escape(end);
				
		options = "scrollbars=no"+",width="+windowW+",height="+windowH;
	
		info = window.open(url, "Popup", options);
		
		info.focus();
	}

//-->
</script>