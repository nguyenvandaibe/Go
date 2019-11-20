var planId = JSON.parse($('#my_data').text()).id;

function runPlan()
{
	$.ajax({
        type: 'POST',
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        url: '/plans/status/run/' + planId,
        data: {},
        success: function() {

            $.ajax({
                type: 'GET',
                url: '/get/status/' + planId,
                dataType: 'json',
                success: function(status) {
					
                    $('#plan-status').empty();

                    $('#status-button-holder').empty();

                    showStatus(status);

                    drawEndButton(status);
                }
            });
        }
    });
}

function cancelPlan()
{
    $.ajax({
        type: 'POST',
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        url: '/plans/status/cancel/' + planId,
        data: {},
        success: function () {

            $.ajax({
				type: 'GET',
				url: '/get/status/' + planId,
				dataType: 'json',
				success: function(status) {
					
                    $('#plan-status').empty();

                    $('#status-button-holder').empty();
					
                    showStatus(status);
				}
            });
        }
    });
}

function endPlan()
{
    $.ajax({
        type: 'POST',
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        url: '/plans/status/end/' + planId,
        data: {},
        success: function () {

    		$.ajax({
                type: 'GET',
                url: '/get/status/' + planId,
                dataType: 'json',
                success: function(status) {
					
                    $('#plan-status').empty();

                    $('#status-button-holder').empty();

                    showStatus(status);
                }
            });
        }
    });
}

function showStatus(status)
{
    if ( status === 'running' ) {

        $('#plan-status').text('Đang chạy');

    } else if ( status === 'ended' ) {

        $('#plan-status').text('Đã kết thúc');

    } else {

        $('#plan-status').text('Đã hủy');
    }
}


function drawEndButton(status)
{
    $('#status-button-holder').append(
        $('<div id="status-end-container" class="row status-container">')
    );

    $('#status-end-container').append(
        $('<button id="button-end" onclick="endPlan()">').text('Kết thúc')
    );
}