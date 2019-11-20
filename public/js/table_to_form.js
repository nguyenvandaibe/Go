function fillDataToForm()
{
	$(document).ready(function () {
		$("#table2 tbody tr").click(function () {
			var tableData = $(this).children("td").map(function () {
				return $(this).text();
			}).get();
		  	$('#old_order').val(tableData[0]);
		  	$('#new_order').val(tableData[0]);
		  	$('#place').val(tableData[1]);
		  	$('#place_lat').val(tableData[2]);
		  	$('#place_lng').val(tableData[3]);
		  	$('#arrive_time').val(tableData[4]);
		  	$('#depature_time').val(tableData[5]);
		  	$('#vehicle').val(tableData[6]);
		  	$('#activity').val(tableData[7]);
		  	$('#deleting-order').val(tableData[0]);

		  	map.setCenter({lat:tableData[2], lng:tableData[3]}, true);

		  	nonDisplayForm('new-point-container');
                
            displayForm('edit-point-container');
        
            displayForm('delete-point-container');
		});
	});
}

fillDataToForm();
