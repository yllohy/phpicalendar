<script language="JavaScript">
<!--
	function openEventInfo(event, calendarname, start, end, description)
	{	
		var windowW = 450;
		var windowH = 275;
	
		var url = "event.php?event="+escape(event)+
			"&calendar_name="+escape(calendarname)+
			"&start="+escape(start)+
			"&end="+escape(end)+
			"&description="+escape(description);
				
		options = "scrollbars=no"+",width="+windowW+",height="+windowH;
	
		info = window.open(url, "Popup", options);
		
		info.focus();
	}

//-->
</script>