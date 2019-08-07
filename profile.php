<?php
    ini_set("error_reporting","E_ALL & ~E_NOTICE");
    header("Content-type: text/html; charset=utf-8");
    require('config.inc.php');

    //判断是否是登录状态，如果登录跳转至登录界面
    if (!isset($_SESSION['username'])){
        header("Location: signin.php");
    }

    //根据当前用户的username
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM forum_user WHERE username = '$username'";
    $result = mysql_query($sql);
    $rows = mysql_fetch_array($result);

    if ($rows['permission'] == "1"){
        $permission = "管理员";
    }else{
        $permission = "普通用户";
    }


?>

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>个人主页</title>
    <link href="static/plugins/noty/noty.css" rel="stylesheet"/>
    <link rel="stylesheet" href="static/css/roo.css?v=${version}"/>
    <link href="static/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="static/css/bootstrap.min.css" rel="stylesheet">
    <link href="static/css/bulma.min.css" rel="stylesheet"/>

</head>
<body>
<!-- Header START -->
<?php include('partials/header.php'); ?>
<!-- Header END -->


<div class="container">


    <div class="columns">
        <div class="column home-topic">
            <div class="message is-light">
                <div class="message-header">
                <span class="has-text-left"><span class="icon is-small"></span> 个人主页</span>
                    <span class="has-text-right">
                    </span>
                </div>

                <section id="main-content">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert">
                                <div class="card-body">
                                    <div class="user-profile m-t-15">
                                        <div class="row">
                                            <div class="col-lg-4">
                                                <div class="user-photo m-b-30">
                                                    <img class="img-responsive" src="static/images/profile_boy_big.png" alt="" />
                                                </div>
                                            </div>
                                            <div class="col-lg-8">
                                                <h1 style="font-size: 18px"><strong><?php echo $rows['username'];?></strong> 的个人详情</h1><br/>

                                                <div>
                                                    <fieldset>
                                                        <legend></legend><br/>
                                                        <div class="tab-content">
                                                            <div>
                                                                <div class="">
                                                                    <div class="field">
                                                                        <label style="font-weight: normal">用户名称：&nbsp;&nbsp;</label>
                                                                        <input style="border: hidden; text-align: center" readonly value="<?php echo $rows['username']; ?>" />
                                                                    </div>
                                                                    <div class="field">
                                                                        <label style="font-weight: normal">电话号码：&nbsp;&nbsp;</label>
                                                                        <input style="border: hidden; text-align: center" readonly value="<?php echo $rows['phonenum']; ?>" />
                                                                    </div>
                                                                    <div class="field">
                                                                        <label style="font-weight: normal">电子邮件：&nbsp;&nbsp;</label>
                                                                        <input style="border: hidden; text-align: center" readonly value="<?php echo $rows['email']; ?>" />
                                                                    </div>
                                                                    <div class="field">
                                                                        <label style="font-weight: normal">身份权限：&nbsp;&nbsp;</label>
                                                                        <input style="border: hidden; text-align: center" readonly value="<?php echo $permission; ?>" />
                                                                    </div>
                                                                    <div class="field">
                                                                        <label style="font-weight: normal">注册时间：&nbsp;&nbsp;</label>
                                                                        <input style="border: hidden; text-align: center" readonly value="<?php echo $rows['regdate']; ?>" />
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /# column -->
                    </div>
            </div>
        </div>
        <!-- Side_Bar START -->
        <?php include('partials/sidebar.php'); ?>
        <!-- Side_Bar END -->
    </div>
        <!-- Footer START -->
        <?php include('partials/footer.html'); ?>
        <!-- Footer END -->
</div>
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

</body>
</html>