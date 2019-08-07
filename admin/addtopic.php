<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
header("Content-type: text/html; charset=utf-8");

require('../config.inc.php');

//判断是否是登录状态，如果登录跳转至登录界面
if (!isset($_SESSION['username'])){
    header("Location: signin.php");
}

if (isset($_POST['submit']) && $_POST['submit']){
    //获取POST值
    $cur_areaid = $_POST['areaid'];
    $cur_topic = $_POST['topic'];
    $cur_detail = $_POST['detail'];
    $cur_name = $_SESSION['username'];
    $cur_email = $_SESSION['curuser_email'];
    $cur_view = 0;
    $cur_reply = 0;
    $cur_sticky = $_POST['sticky'];

    $sql = "INSERT INTO forum_topic (areaid, topic, detail, name, email, datetime, view, reply, sticky)
            VALUES('$cur_areaid', '$cur_topic', '$cur_detail', '$cur_name', '$cur_email', NOW(), '$cur_view', '$cur_reply', '$cur_sticky')";
    $result = mysql_query($sql);

    //判断成功
    if($result){ //成功
        header("Location: addtopic.php");
    }else{
        ExitMessage("添加失败，请重试！", "addtopic.php");
    }

}else{

    ?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>学生综合素质测评系统 - 添加主题帖子</title>

        <!-- ================= Favicon ================== -->

        <!-- Styles -->
        <link href="assets/css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
        <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
        <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
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
                                <h1>添加主题信息</h1>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="#"></a>主题管理</li>
                                    <li class="active">添加主题信息</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->

                <section id="main-content">
                    <div class="card alert">
                        <div class="card-body">
                            <div class="card-header m-b-20">
                                <h4>&nbsp;</h4>

                            </div>

                            <form method="POST" action="addtopic.php">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="basic-form">
                                            <div class="form-group">
                                                <label>所在版块</label>
                                                <select class="form-control bg-ash border-none" name="areaid">
                                                <?php
                                                //获取所有版块信息
                                                $sql_area = "SELECT * FROM forum_area";
                                                $result_area = mysql_query($sql_area);
                                                //循环取出记录内容
                                                while($rows_area = mysql_fetch_array($result_area)){
                                                ?>
                                                    <option value="<?php echo $rows_area['id'] ?>"><?php echo $rows_area['name'] ?></option>
                                                <?php } ?>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="basic-form">
                                            <div class="form-group">
                                                <label>主题</label>
                                                <input name="topic" type="text" class="form-control border-none input-flat bg-ash" placeholder="" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="basic-form">
                                            <div class="form-group">
                                                <label>是否置顶</label>
                                                <select class="form-control bg-ash border-none" name="sticky">
                                                    <option value="0">否</option>
                                                    <option value="1">是</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="basic-form">
                                            <div class="form-group">
                                                <label>内容</label>
                                                <textarea name="detail" rows="5" type="text" class="form-control border-none input-flat bg-ash" placeholder="" value="">
                                                </textarea>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <input name="submit" class="btn btn-default bg-warning border-none" type="submit" value="保存">
                                <input class="btn btn-default sbmt-btn" type="reset" value="清空">

                            </form>
                        </div>
                    </div>

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
    <!-- jquery vendor -->
    <script src="assets/js/lib/jquery.min.js"></script>
    <script src="assets/js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="assets/js/lib/menubar/sidebar.js"></script>
    <script src="assets/js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->
    <script src="assets/js/lib/bootstrap.min.js"></script>
    <!-- bootstrap -->


    <script src="assets/js/lib/calendar-2/moment.latest.min.js"></script>
    <!-- scripit init-->
    <script src="assets/js/lib/calendar-2/semantic.ui.min.js"></script>
    <!-- scripit init-->
    <script src="assets/js/lib/calendar-2/prism.min.js"></script>
    <!-- scripit init-->
    <script src="assets/js/lib/calendar-2/pignose.calendar.min.js"></script>
    <!-- scripit init-->
    <script src="assets/js/lib/calendar-2/pignose.init.js"></script>
    <!-- scripit init-->

    <script src="assets/js/scripts.js"></script>
    <!-- scripit init-->





    </body>

    </html>
<?php }?>