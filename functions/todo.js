
<script language="JavaScript" type="text/javascript">
<!--
	function openTodoInfo(vtodo_array)
	{	
		var windowW = 460;
		var windowH = 275;
	
		var url = "includes/todo.php?vtodo_array="+vtodo_array;
				
		options = "scrollbars=yes,width="+windowW+",height="+windowH;
	
		info = window.open(url, "Popup", options);
		
		info.focus();
	}

//-->
</script>
