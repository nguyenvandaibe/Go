$('#table2').tablesorter({
    widgets: ['stickyHeaders'],
    widgetOptions: {
		// jQuery selector or object to attach sticky header to
	    stickyHeaders_attachTo : '#table-schedule' // or $('.wrapper')
    }
});
