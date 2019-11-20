function removeComment(commentId)
{
    $('#remove-comment-' + commentId).click(function() {
        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            url: '/plans/' + planId + '/comments/remove/' + commentId,
            success: function() {

                $('#comment-container').empty();

                showComments();

                setNullComment();
            }
        });
    });
}