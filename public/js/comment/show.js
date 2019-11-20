if ($('#comment-container').length > 0) {

    showComments();

    addComment();
}

function showComments()
{
    $.ajax({
        type: 'GET',
        url: '/get/comments/' + planId,
        dataType: 'json',
        success: function (comments) {
            $('#comment-container').empty();
            indexComments(comments);
        }
    });
} 

function indexComments(comments)
{
    $.each(comments, function(key, comment) {

        var cmtId = comment.id;

        if (comment.parent_id == null) {

            appendElement(
                '#comment-container',
                '<div id="comment-' + cmtId + '" class="col-md-11 offset-md-1">'
            );

            setContent(comment, cmtId, '#comment-' + cmtId);

        } else {

            appendElement(
                '#comment-' + comment.parent_id,
                '<div id="comment-' + cmtId + '" class="col-md-10 offset-md-2">'
            );

            setContent(comment, cmtId, '#comment-' + cmtId);
        }
    });

    $.each(comments, function(key, comment) {
        
        var commentId = comment.id;
        
        if(!comment.parent_id) {
            setReplyElements(commentId);
        }
    });
}

function setContent(comment, commentId, parentElement)
{
    setCommentElements(comment, commentId, parentElement);

    setElementValue(comment, commentId);

    $.each(comment.images, function(i, image) {

        appendElement(
            '#comment-image-' + commentId,
            '<img class="cmt-img" src="' + comment.images[i].path + '">'
        );
    });
}

function setCommentElements(comment, commentId, parentElement)
{
    appendElement(
        parentElement,
        '<div id="comment-author-' + commentId + '" class="comment-author">'
    );
	
    appendElement(
        parentElement,
        '<div id="comment-text-' + commentId + '" class="comment-text">'
    );

    appendElement(
        parentElement,
        '<div id="comment-image-' + commentId + '" class="row">'
    );
    appendElement(
        parentElement,
        '<div id="comment-control-' + commentId + '" class="row comment-control">'
    );

    if (plan.author_id == comment.author_id) {

        appendElement(
            '#comment-control-' + commentId,
            '<button id="edit-comment-' + commentId + '" class="button-control">'
        );

        appendElement(
            '#comment-control-' + commentId,
            '<button id="remove-comment-' + commentId + '" class="button-control" onclick="deleteComment('+ commentId +')">'
        );
    }
}



function setElementValue(comment, cmtId)
{
    $('#comment-author-' + cmtId).text(comment.user.full_name);

    $('#comment-text-' + cmtId).text(comment.text);

    $('#edit-comment-' + cmtId).text('Sửa');

    $('#remove-comment-' + cmtId).text('Xóa');

}

