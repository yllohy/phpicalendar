<script language="JavaScript" type="text/javascript">
<!--
function openEventWindow(num) {
	// populate the hidden form
	var data = document.popup_data[num];
	var form = document.forms.eventPopupForm;
	form.elements.event.value = data.event;
	form.elements.cal.value = data.cal;
	form.elements.start.value = data.start;
	form.elements.end.value = data.end;
	form.elements.description.value = data.description;
	form.elements.status.value = data.status;
	form.elements.location.value = data.location;
	form.elements.organizer.value = data.organizer;
	form.elements.attendee.value = data.attendee;    
	
	// open a new window
	var w = window.open('', 'Popup', 'scrollbars=yes,width=460,height=275');
	form.target = 'Popup';
	form.submit();
}

function EventData(event, cal, start, end, description, status, location, organizer, attendee) {
	this.event = event;
	this.cal = cal;
	this.start = start;
	this.end = end;
	this.description = description;
	this.status = status;
	this.location = location;
	this.organizer = organizer;
	this.attendee = attendee;
}

document.popup_data = new Array();
//-->
</script>