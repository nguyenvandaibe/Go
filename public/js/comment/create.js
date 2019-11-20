function addComment()
{
    setNewCommentInput();

    $('#comment-submit').click( function(event) {

        event.preventDefault();

        $('#form-input-comment').submit();
        
    });

    $('#form-input-comment').submit(function (event) {

        event.preventDefault();

        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            url: '/plans/' + planId + '/comments/create',
            data:formData,
            cache:false,
            contentType: false,
            processData: false,

            success: function() {

                $('#comment-container').empty();

                showComments();

                setNullComment();
            }
        });
    });
}



function setNewCommentInput()
{
    appendElement(
        '#input-comment-container',
        '<form id="form-input-comment" class="col-md-8 offset-md-1" enctype="multipart/form-data">'
    );

    appendElement(
        '#form-input-comment',
        '<p id="form-new-comment-title">'        
    );

    $('#form-new-comment-title').text('Nhập bình luận của bạn');

    appendElement(
        '#form-input-comment',
        '<textarea id="new-comment-text" name="new-comment-text">'
    );

    appendElement(
        '#form-input-comment',
        '<div id="new-comment-action" class="row">'
    );

    appendElement(
        '#new-comment-action',
        '<input id="new-comment-image" name="images[]" type="file" multiple>'
    ); 

    appendElement(
        '#new-comment-action',
        '<button type="button" id="comment-submit">'
    );

    appendElement(
        '#new-comment-action',
        '<button type="button" id="comment-cancel" onclick="setNullComment()">'
    );

    $('#title-form').text('Nhập bình luận của bạn');

    $('#comment-submit').text('Đăng');

    $('#comment-cancel').text('Hủy');
}

function setNullComment()
{
    console.log('setNullComment');

    $('#new-comment-text').val('');

    $('#new-comment-image').val('');
}

function appendElement(parent, child)
{
    return $(parent).append($(child));
}