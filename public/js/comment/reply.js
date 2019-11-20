function setReplyElements(commentId)
{
    appendElement(
        '#comment-' + commentId,
        '<form id="form-reply-' + commentId + '" enctype="multipart/form-data">'
    );

    appendElement(
        '#form-reply-' + commentId,
        '<div id="reply-area-' + commentId + '" class="reply-area col-md-6 offset-md-2">'
    );

    appendElement(
        '#reply-area-' + commentId,
        '<p id="reply-title-' + commentId + '">'
    );

    appendElement(
        '#reply-area-' + commentId,
        '<textarea id="reply-text-' + commentId + '" class="reply-text" name="reply-text-' + commentId + '">'
    );

    appendElement(
        '#reply-area-' + commentId,
        '<div id="reply-row-' + commentId + '" class="row">'
    );

    appendElement(
        '#reply-row-' + commentId,
        '<input id="reply-image-' + commentId + '" name="replyImages[]' + commentId + '" type="file" multiple>'
    );

    appendElement(
        '#reply-row-' + commentId,
        '<button id="submit-reply-' + commentId + '" onclick="replyComment(' + commentId + ')">'
    );

    appendElement(
        '#reply-row-' + commentId,
        '<button id="cancel-reply-' + commentId + '" onclick="setNullReply(' + commentId + ')">'
    );
    
    $('#reply-title-' + commentId).text('Trả lời:');    

    $('#submit-reply-' + commentId).text('Đăng');
    
    $('#cancel-reply-' + commentId).text('Hủy');
}

function replyComment(commentId) {
    
    $('#submit-reply-' +commentId).click(function(event) {

        event.preventDefault();

        $('#form-reply-' + commentId).submit();
    });

    $('#form-reply-' + commentId).submit(function(event) {
        
        event.preventDefault();

        var formData = new FormData(this);

        console.log(formData);
        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            url: '/plans/' + planId + '/comments/reply/' + commentId,
            data:formData,
            cache:false,
            contentType: false,
            processData: false,

            success: function() {

                $('#comment-container').empty();

                showComments();

                setNullReply(commentId);
            }
        });
    });
}

function setNullReply(commentId)
{
    $('#reply-text-' + commentId).val('');

    $('#reply-image-' + commentId).val('');
}