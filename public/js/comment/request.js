var plan = JSON.parse($('#my_data').text()),
    planId = plan.id;

function requestCreateComment()
{
	$.ajax({

		type: 'POST',
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        url: '/plans/' + planId + '/comments/create',
        data: {
        	'plan_id': planId,
            'parent_id': null,
        	'text': $('#new-comment').val(),
        	'images': $('#comment-image').prop('files'),
        },
        success: function () {

            console.log('post');

            $('#input-container').remove();

            $('#comment-container').empty();
        }
	});
}