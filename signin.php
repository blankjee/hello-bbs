<?php
    ini_set("error_reporting","E_ALL & ~E_NOTICE");
    header("Content-type: text/html; charset=utf-8");

    require('config.inc.php');

    if (isset($_COOKIE['username']) && isset($_COOKIE['password'])){
        $cookie_username = $_COOKIE['username'];
        $cookie_password = $_COOKIE['password'];
    }
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登录</title>
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
                <h1 style="font-size: large; padding: 5px;">登录</h1>
                <div class="message-body">
                    <form id="signin-form" method="post" action="signin.php">
                        <div class="field">
                            <div class="control has-icons-left has-icons-right">
                                <input id="username" name="username" class="input" type="text" placeholder="用户名/邮箱" value="<?php echo $cookie_username;?>"/>
                                <span class="icon is-small is-left">
                          <i class="fa fa-user"></i>
                        </span>
                            </div>
                        </div>

                        <div class="field">
                            <p class="control has-icons-left">
                                <input id="password" name="password" class="input" type="password" placeholder="密码" value="<?php echo $cookie_password;?>">
                                <span class="icon is-small is-left">
                          <i class="fa fa-lock"></i>
                        </span>
                            </p>
                        </div>

                        <!-- VALIDCODE START -->
                        <?php include('partials/validcode.html'); ?>
                        <!-- VALIDCODE START -->
                        <div class="field">
                            <p class="control">
                            <div class="field">
                                <div class="control">
                                    <div class="is-pulled-left">
                                        <label class="checkbox">
                                            <input value="yes" id="remeberMe" name="remeberMe" type="checkbox"/> 记住我
                                        </label>
                                    </div>
                                    <div class="is-pulled-right">
                                        <a href="#">忘记密码</a>
                                    </div>
                                    <div class="is-clearfix"></div>
                                </div>
                            </div>
                            <div class="has-text-centered">
                                <button id="signin-btn" type="button" class="button is-link button is-success">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;登录&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                            </div>
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
<script type="text/javascript" src="static/plugins/jquery.validation/localization/messages_zh.min.js"></script>
<script type="text/javascript" src="static/js/login.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#signin-form").validate({
            rules: {
                username: {
                    required: true,
                    minlength: 4
                },
                password: {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                username: {
                    required: "请输入用户名",
                    minlength: "请输入4位以上用户名"
                },
                password: {
                    required: "请输入密码",
                    minlength: "密码长度不能小于6位"
                }
            },
            submitHandler: function () {
                $('#signin-form #signin-btn').addClass('is-loading');
                Roo.post("tool/login.php", $('#signin-form').serialize(),
                    $('#signin-form #signin-btn').addClass('is-loading')
                function (data, textStatus, jqXHR) {
                    console.log(data);
                    if (data && data.success) {
                        window.location.href = '/';
                    } else {
                        Roo.alertError(data.msg || '登录失败');
                    }
                });
            }
        });
    });
</script>

</body>
</html>
