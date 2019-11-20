function deleteComment(commentId)
{
    console.log(1);
    $.ajax({
        type: 'POST',
        headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
        url: '/plans/' + planId + '/comments/delete/' + commentId,
        data: {
            "planId": planId,
            "commentId": commentId
        },
        success: function() {

            $('#comment-container').empty();

            showComments();
        }
    });
}