
<script language="JavaScript">
<!--
	function openTodoInfo(vtodo, calendarname, start, due, description, status)
	{	
		var windowW = 450;
		var windowH = 275;
	
		var url = "includes/todo.php?vtodo="+vtodo+
			"&calendar_name="+calendarname+
			"&start="+start+
			"&due="+due+
			"&description="+description+
			"&status="+status;
				
		options = "scrollbars=no"+",width="+windowW+",height="+windowH;
	
		info = window.open(url, "Popup", options);
		
		info.focus();
	}

//-->
</script>
