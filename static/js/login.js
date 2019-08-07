$(document).ready(function () {
    // 登录
    var signinForm = document.getElementById('signin-form');
    if (signinForm) {
        // var mditor = Mditor.fromTextarea(commentEitor);
        // mditor.split = false;
        // mditor.height = '250px';
        $('#signin-form #signin-btn').click(function () {
            //四个参数
            var username = $("#username").val();
            var password = $('#password').val();
            var remeberMe = $('#remeberMe').val();
            var checkNum = $('#checkNum').val();
            var btn = $(this);
            btn.addClass('is-loading');
            Roo.post("tool/login.php", $('#signin-form').serialize(),
                function (data, textStatus, jqXHR) {
                    //alert(data);
                    //alert(data.success);
                    btn.removeClass('is-loading');
                    if (data == 1) {
                        Roo.alertOk('登录成功，正在跳转...', function () {
                            $("#comment-editor").val('');
                            window.location.href = "index.php";
                        });
                    } else if (data == -1){
                        Roo.alertError(data.msg || '验证码错误！', function () {
                            if (data.code && data.code == 10000) {
                                window.location.reload();
                            }
                        });
                    } else if (data == -2){
                        Roo.alertError(data.msg || '账号或密码失败！', function () {
                            if (data.code && data.code == 10000) {
                                window.location.reload();
                            }
                        });
                    }
                });

        });
    }
});
