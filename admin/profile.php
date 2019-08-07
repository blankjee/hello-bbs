<?php
    ini_set("error_reporting","E_ALL & ~E_NOTICE");
    header("Content-type: text/html; charset=utf-8");

    //判断是否是登录状态，如果登录跳转至登录界面
    if (!isset($_SESSION['username'])){
        header("Location: signin.php");
    }

    require('../config.inc.php');
    //判断是当前用户还是点击的查看的指定用户
    if (isset($_GET['username'])) {
        //获取GET值
        $cur_username = $_GET['username'];


    }else{
        $cur_username = $_SESSION['username'];
    }
    //查到该用户的详细信息
    $sql = "SELECT * FROM forum_user WHERE username='$cur_username'";
    $result = mysql_query($sql);
    $rows = mysql_fetch_array($result);
    $cur_id = $rows['id'];
    $cur_phonenum = $rows['phonenum'];
    $cur_email = $rows['email'];
    $cur_permission = (int)$rows['permission'];
    $cur_regdate = $rows['regdate'];

    //查询用户的额外信息：发帖数、收到评论、发出评论、访问量
    $curuser_topic_num = 0;
    $curuser_revreply_num = 0;
    $curuser_sendreply_num = 0;
    $curuser_view_num = 0;

    $sql_exinfo = "SELECT * FROM forum_topic WHERE name='$cur_username'";
    $result_exinfo = mysql_query($sql_exinfo);
    $num_rows_exinfo = mysql_num_rows($result_exinfo);

    $curuser_topic_num = $num_rows_exinfo;
    while($rows_exinfo = mysql_fetch_array($result_exinfo)){
        $curuser_revreply_num = $curuser_revreply_num + (int)$rows_exinfo['reply'];
        $curuser_view_num = $curuser_view_num + (int)$rows_exinfo['view'];
    }
    $sql_exinfo = "SELECT * FROM forum_reply WHERE reply_name='$cur_username'";
    $result_exinfo = mysql_query($sql_exinfo);
    $curuser_sendreply_num = mysql_num_rows($result_exinfo);

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>学生综合素质测评系统 - 用户信息</title>
    <!-- ================= Favicon ================== -->
    <!-- Styles -->
    <link href="assets/css/lib/chartist/chartist.min.css" rel="stylesheet">
    <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="assets/css/lib/weather-icons.css" rel="stylesheet" />
    <link href="assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/lib/unix.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

<!-- sidebar start -->
<?php include('partials/navigate.php'); ?>
<!-- sidebar end -->


<!-- header start -->
<?php include('partials/header.php'); ?>
<!-- header end -->

<div class="content-wrap">
    <div class="main">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <h1>Information</h1>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#"></a></li>
                                <li class="active"></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
            </div>
            <!-- /# row -->
            <section id="main-content">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card alert">
                            <div class="card-header">
                                <h4>个人资料</h4>

                            </div>
                            <div class="card-body">
                                <div class="user-profile m-t-15">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="user-photo m-b-30">
                                                <img class="img-responsive" src="assets/images/profile_boy.png" alt="" />
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="user-profile-name dib"><strong><?php echo $cur_username;?></strong> 的个人详情</div>
                                            <div class="useful-icon dib pull-right">
                                                <span><a href=""><i class="ti-pencil-alt"></i></a> </span>
                                            </div>
                                            <div class="custom-tab user-profile-tab">
                                                <ul class="nav nav-tabs" role="tablist">
                                                    <li role="presentation" class="active"><a href="#1" aria-controls="1" role="tab" data-toggle="tab">About</a></li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane active" id="1">
                                                        <div class="contact-information">
                                                            <div class="phone-content">
                                                                <span class="contact-title">用户名：</span>
                                                                <span class="phone-number"><?php echo $cur_username;?></span>
                                                            </div>
                                                            <div class="website-content">
                                                                <span class="contact-title">电话号码：</span>
                                                                <span class="contact-website"><?php echo $cur_phonenum;?></span>
                                                            </div>
                                                            <div class="website-content">
                                                                <span class="contact-title">电子邮件：</span>
                                                                <span class="contact-website"><?php echo $cur_email;?></span>
                                                            </div>
                                                            <div class="skype-content">
                                                                <span class="contact-title">身份权限：</span>
                                                                <span class="contact-skype">
                                                                    <?php
                                                                        if ($cur_permission == 1){
                                                                            ?>
                                                                            管理员
                                                                            <?php
                                                                        }else if($cur_permission == 0){
                                                                            ?>
                                                                            普通用户
                                                                    <?php
                                                                        }
                                                                    ?>
                                                                </span>
                                                            </div>
                                                            <div class="address-content">
                                                                <span class="contact-title">注册时间：</span>
                                                                <span class="mail-address"><?php echo $cur_regdate;?></span>
                                                            </div>
                                                            <div class="address-content">
                                                                <span class="contact-title">总发帖数：</span>
                                                                <span class="mail-address"><?php echo $curuser_topic_num;?></span>
                                                            </div>
                                                            <div class="address-content">
                                                                <span class="contact-title">总发出回复数：</span>
                                                                <span class="mail-address"><?php echo $curuser_sendreply_num;?></span>
                                                            </div>
                                                            <div class="address-content">
                                                                <span class="contact-title">总收到回复数：</span>
                                                                <span class="mail-address"><?php echo $curuser_revreply_num;?></span>
                                                            </div>
                                                            <div class="address-content">
                                                                <span class="contact-title">总访问量：</span>
                                                                <span class="mail-address"><?php echo $curuser_view_num;?></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <!-- footer start -->
                <?php include('partials/footer.php'); ?>
                <!-- footer end -->
            </section>
        </div>
    </div>
</div>

<div id="search">
    <button type="button" class="close">×</button>
    <form>
        <input type="search" value="" placeholder="type keyword(s) here" />
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>


</div>
<script src="assets/js/lib/jquery.min.js"></script>
<!-- jquery vendor -->
<script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
<!-- nano scroller -->
<script src="assets/js/lib/menubar/sidebar.js"></script>
<script src="assets/js/lib/preloader/pace.min.js"></script>
<!-- sidebar -->
<script src="assets/js/lib/bootstrap.min.js"></script>
<!-- bootstrap -->
<script src="assets/js/lib/weather/jquery.simpleWeather.min.js"></script>
<script src="assets/js/lib/weather/weather-init.js"></script>
<script src="assets/js/lib/circle-progress/circle-progress.min.js"></script>
<script src="assets/js/lib/circle-progress/circle-progress-init.js"></script>
<script src="assets/js/lib/chartist/chartist.min.js"></script>
<script src="assets/js/lib/chartist/chartist-init.js"></script>
<script src="assets/js/lib/sparklinechart/jquery.sparkline.min.js"></script>
<script src="assets/js/lib/sparklinechart/sparkline.init.js"></script>
<script src="assets/js/lib/owl-carousel/owl.carousel.min.js"></script>
<script src="assets/js/lib/owl-carousel/owl.carousel-init.js"></script>
<script src="assets/js/scripts.js"></script>
<script src="assets/js/lib/data-table/datatables.min.js"></script>
<script src="assets/js/lib/data-table/datatables-init.js"></script>

<!-- scripit init-->
</body>

</html>