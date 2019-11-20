var planId = JSON.parse($('#my_data').text()).id;

/* Xóa từng nút theo id */
// function removeSpecifiedButton(wrapper, buttonId)
// {
//     if ( $('#' + wrapper).length ) {
//         $('#' + buttonId).remove();
//     }
// }

/* Xóa các nút cũ */
// function removeOldButton()
// {
//     removeSpecifiedButton('status-run-container', 'button-run');

//     removeSpecifiedButton('status-end-container', 'button-end');

//     removeSpecifiedButton('status-cancel-container', 'button-cancel');

//     $('#edit-plan-container').remove();
// }

/* Vẽ nút mới*/


function removeOldStatus()
{
	$('#plan-status').remove();
}


