<?php 
// Version Info:
// 21-jan-03, Marook: Removed Scrollbar param, to allow browser to auto-disply when needed.
?>
<script language="JavaScript" type="text/javascript">
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
				
		options = "width="+windowW+",height="+windowH; //"scrollbars=no"+",
	
		info = window.open(url, "Popup", options);
		
		info.focus();
	}

//-->
</script>
