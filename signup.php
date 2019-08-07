<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
header("Content-type: text/html; charset=utf-8");

require('config.inc.php');
if (isset($_POST['submit']) && $_POST['submit']){
    //用户信息
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phonenum = $_POST['phonenum'];
    //此处注册的默认等级为普通用户，level为0
    $permission = 0;


    //检测数据合法性
    if (!$username){
        ExitMessage('请输入用户名');
    }
    if (!$password){
        ExitMessage('请输入密码');
    }
    if (!$email) {
        ExitMessage('请输入电子邮件地址');
    }elseif (!CheckEmail($email)){
        ExitMessage('电子邮件格式错误');
    }

    //对密码进行双重MD5加密
    $password = md5(md5($password));

    //判断用户是否已经存在
    $sql = "SELECT * FROM forum_user WHERE username = '$username'";
    $result = mysql_query($sql);
    $num_rows = mysql_num_rows($result);
    if($num_rows > 0){
        ExitMessage('<p class="error">该用户已经存在！点击返回重新注册！</p>');
    }

    //创建用户
    $sql = "INSERT INTO forum_user (username, password, email, phonenum, permission, regdate)
            VALUES('$username', '$password', '$email', '$phonenum', '$permission', NOW())";
    $result = mysql_query($sql);

    //用户校验
    if($result){ //成功
        header("Location: signin.php");
    }else{
        ExitMessage("注册失败，请重试！", "signup.php");
    }
}else{
    ?>
    <!DOCTYPE html>
    <html lang="zh">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>注册</title>
        <link href="static/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="static/css/bulma.min.css" rel="stylesheet"/>
        <link href="static/plugins/noty/noty.css" rel="stylesheet"/>
        <link rel="stylesheet" href="static/css/roo.css?v=${version}"/>
        <script type="text/javascript" src="static/js/jquery.min.js"></script>
        <script type="text/javascript" src="static/js/roo.js?v=${version}"></script>
        <script type="text/javascript">
            Roo.Config = {
                current_user: "${login_user.username ?! ''}",
                token: "${csrf_token ?! ''}",
                upload_url: "${siteUrl('/upload_image')}",
                notification_url: "${siteUrl('/notification/count')}",
                version: '${version}'
            };
        </script>
    </head>
    <body>
    <!-- Header START -->
    <?php include('partials/header.php'); ?>
    <!-- Header END -->

    <div class="container">
        <!-- Main_Content START -->
        <div class="columns">
            <div class="column is-3"></div>
            <div class="column is-6">
                <div class="message is-light">
                    <div class="message-header">注册新用户</div>
                    <div class="message-body">
                        <form id="signupForm" method="post" action="signup.php">
                            <div class="field">
                                <div class="control has-icons-left has-icons-right">
                                    <input id="username" name="username" class="input" type="text" placeholder="用户名"/>
                                    <span class="icon is-small is-left">
                              <i class="fa fa-user"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="field">
                                <p class="control has-icons-left">
                             <span class="icon is-small is-left">
                          <i class="fa fa-lock"></i>
                        </span>
                                </p>
                            </div>

                            <div class="field">
                                <p class="control has-icons-left">
                                    <input id="password" name="password" class="input" type="password" placeholder="请输入密码"/>
                                    <span class="icon is-small is-left">
                          <i class="fa fa-lock"></i>
                        </span>
                                </p>
                            </div>

                            <div class="field">
                                <p class="control has-icons-left">
                                    <input id="repassword" name="repassword" class="input" type="password" placeholder="确认密码"/>
                                    <span class="icon is-small is-left">
                          <i class="fa fa-lock"></i>
                        </span>
                                </p>
                            </div>
                            <div class="field">
                                <div class="control has-icons-left has-icons-right">
                                    <input id="phonenum" name="phonenum" class="input" type="text" placeholder="请输入电话号码"/>
                                    <span class="icon is-small is-left">
                              <i class="fa fa-phone"></i>
                            </span>
                                </div>
                            </div>

                            <div class="field">
                                <div class="control has-icons-left has-icons-right">
                                    <input id="email" name="email" class="input" type="text" placeholder="请输入邮箱"/>
                                    <span class="icon is-small is-left">
                              <i class="fa fa-envelope"></i>
                            </span>
                                </div>
                            </div>
                            <!-- 验证码，暂时不用
                            <div class="field">
                                <p class="control has-icons-left">
                                    <input id="vcode" name="vcode" class="input" type="text" placeholder="验证码"/>
                                </p>
                            </div>
                            -->
                            <div class="field">
                                <p class="control">
                                    <input id="signup-btn" class="button is-success" type="submit" name="submit" value="&nbsp;&nbsp;&nbsp;注册&nbsp;&nbsp;&nbsp;"/>
                                    <a class="button" href="signin.php">返回登录</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="column is-3"></div>
        </div>

        <!-- Main_Content END -->
        <!-- Footer START -->
        <?php include('partials/footer.html'); ?>
        <!-- Footer END -->
    </div>

    <script type="text/javascript" src="static/plugins/noty/noty.min.js"></script>

    <script src="static/js/instantclick.min.js" data-no-instant></script>
    <script data-no-instant>
        InstantClick.on('change', function (isInitialLoad) {
            if (isInitialLoad === false) {
                if (typeof ga !== 'undefined') ga('send', 'pageview', location.pathname + location.search);
            }
        });
        InstantClick.init('mousedown');
    </script>
    <script type="text/javascript" src="static/plugins/jquery.validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="static/plugins/jquery.validation/additional-methods.min.js"></script>
    <script type="text/javascript" src="static/plugins/jquery.validation/localization/messages_zh.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $.validator.addMethod("checkUserName", function (value, element, params) {
                var checkName = /^\w{4,20}$/g;
                return this.optional(element) || (checkName.test(value));
            }, "只允许4-20位英文字母、数字或者下画线！");

            $("#signupForm").validate({
                rules: {
                    username: {
                        required: true,
                        rangelength: [4, 20],
                        checkUserName: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    },
                    repassword: {
                        required: true,
                        minlength: 6,
                        equalTo: "#password"
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    vcode: {
                        required: true
                    }
                },
                messages: {
                    username: {
                        required: "请输入用户名",
                        rangelength: "请输入4-20位用户名"
                    },
                    password: {
                        required: "请输入密码",
                        minlength: "密码长度不能小于6位"
                    },
                    repassword: {
                        required: "请输入密码",
                        minlength: "密码长度不能小于6位",
                        equalTo: "两次密码输入不一致"
                    },
                    vcode: {
                        required: "请输入验证码"
                    },
                    email: {
                        required: "请输入邮箱",
                        email: "请输入一个正确的邮箱"
                    }
                },
                submitHandler: function () {
                    $('#signup-form #signup-btn').addClass('is-loading');
                    Roo.post("/signup", $('#signup-form').serialize(),
                        function (data, textStatus, jqXHR) {
                            $('#signup-form #signup-btn').addClass('is-loading');
                            if (data && data.success) {
                                Roo.alertOk('注册成功');
                            } else {
                                Roo.alertError(data.msg || '注册失败');
                            }
                        });
                }
            });
        });
    </script>
    </body>
    </html>
<?php }?>