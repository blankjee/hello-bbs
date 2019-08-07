$(document).ready(function () {
    // 发帖
    var editor = document.getElementById('editor');
    if(editor){
        var mditor = Mditor.fromTextarea(editor);
        mditor.on('ready', function () {
            mditor.value = '> 请输入主题内容';
        });

        $("#topic-form").validate({
            rules: {
                title: {
                    required: true,
                    minlength: 5
                },
                editor: {
                    required: true,
                    minlength: 5
                },
                nodeSlug: {
                    required: true
                }
            },
            messages: {
                title: {
                    required: '请输入主题标题',
                    minlength: '标题最少5个字符'
                },
                editor: {
                    required: '请输入主题内容',
                    minlength: '内容最少5个字符'
                },
                nodeSlug: {
                    required: '请选择节点'
                }
            }
        });
    }

    // 评论
    var commentEitor = document.getElementById('comment-editor');
    if(commentEitor){
        // var mditor = Mditor.fromTextarea(commentEitor);
        // mditor.split = false;
        // mditor.height = '250px';
        $('#comment-form #comment').click(function () {
            var content = $("#comment-editor").val();
            if (!content || content.length == 0) {
                Roo.alertError('请输入评论内容');
                return;
            }
            var btn = $(this);
            btn.addClass('is-loading');
            Roo.post("addreply.php", $('#comment-form').serialize(),
                function (data, textStatus, jqXHR) {
                    btn.removeClass('is-loading');
                    if (data) {
                        Roo.alertOk('评论成功', function () {
                            $("#comment-editor").val('');
                            window.location.reload();
                        });
                    } else {
                        Roo.alertError(data.msg || '评论失败', function () {
                            if (data.code && data.code == 10000) {
                                window.location.reload();
                            }
                        });
                    }
                });

        });
    }

});
