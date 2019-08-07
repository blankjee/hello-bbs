<?php
    ini_set("error_reporting","E_ALL & ~E_NOTICE");
    header("Content-type: text/html; charset=utf-8");

    require('../config.inc.php');

    //判断是否是登录状态，如果登录跳转至登录界面
    if (!isset($_SESSION['username'])){
        header("Location: signin.php");
    }

    //将站点统计计算出来，并发送到SESSION范围
    //会员数
    $sql_user_count = "SELECT COUNT(*) FROM forum_user";
    $result_user_count = mysql_query($sql_user_count);
    $rows_user_count = mysql_fetch_array($result_user_count);
    $usercount = $rows_user_count[0];
    //主题数
    $sql_topic_count = "SELECT COUNT(*) FROM forum_topic";
    $result_topic_count = mysql_query($sql_topic_count);
    $rows_topic_count = mysql_fetch_array($result_topic_count);
    $topiccount = $rows_topic_count[0];
    //回帖数
    $sql_reply_count = "SELECT COUNT(*) FROM forum_reply";
    $result_reply_count = mysql_query($sql_reply_count);
    $rows_reply_count = mysql_fetch_array($result_reply_count);
    $replycount = $rows_reply_count[0];
    session_start();
    $_SESSION["usercount"] = $usercount;
    $_SESSION["topiccount"] = $topiccount;
    $_SESSION["replycount"] = $replycount;

    //将用户的信息发送至SESSION
    $username = $_SESSION['username'];
    $sql_user = "SELECT * FROM forum_user WHERE username='$username'";
    $result_user = mysql_query($sql_user);
    $rows_user = mysql_fetch_array($result_user);
    $curuser_email = $rows_user['email'];
    $curuser_phonenum = $rows_user['phonenum'];
    $_SESSION['curuser_email'] = $curuser_email;
    //$_SESSION['curuser_phonenum'] = $curuser_phonenum;

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BBS论坛系统后台端 - 主页</title>
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
                            <h1>Hello, <span>欢迎使用BBS论坛系统后台端！</span></h1>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li class="active">主页</li>
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

                        <div class="col-lg-4">
                            <div class="card p-0">
                                <div class="stat-widget-three">
                                    <div class="stat-icon bg-primary">
                                        <i class="ti-user"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="stat-text">系统用户数</div>
                                        <div class="stat-digit"><?php echo $_SESSION["usercount"]; ?></div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card p-0">
                                <div class="stat-widget-three">
                                    <div class="stat-icon bg-success">
                                        <i class="ti-shield"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="stat-text">话题数</div>
                                        <div class="stat-digit"><?php echo $_SESSION["topiccount"]; ?></div>

                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="card p-0">
                                <div class="stat-widget-three">
                                    <div class="stat-icon bg-warning">
                                        <i class="ti-envelope"></i>
                                    </div>
                                    <div class="stat-content">
                                        <div class="stat-text">评论数</div>
                                        <div class="stat-digit"><?php echo $_SESSION["replycount"]; ?></div>
                                    </div>

                                </div>
                            </div>
                        </div>



                        </div>
                    </div>
                </div>
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
</body>

</html>