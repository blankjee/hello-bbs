<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
header("Content-type: text/html; charset=utf-8");

require('../config.inc.php');

//判断是否是登录状态，如果登录跳转至登录界面
if (!isset($_SESSION['username'])){
    header("Location: signin.php");
}

//此页面有两个功能，故进行逻辑判断，看是GET过来的还是POST过来的。
if (isset($_GET['id'])) {
    //获取GET值
    $id = $_GET['id'];
    $sql = "SELECT * FROM forum_topic WHERE id='$id'";
    $result = mysql_query($sql);
    $rows = mysql_fetch_array($result);
    $cur_id = $rows['id'];
    $cur_areaid = $rows['areaid'];
    $cur_topic = $rows['topic'];
    $cur_detail = $rows['detail'];
    $cur_name = $rows['name'];
    $cur_email = $rows['email'];
    $cur_sticky = $rows['sticky'];
    //无需改变的参数
    $cur_datetime = $rows['datetime'];
    $cur_view = $rows['view'];
    $cur_likes = $rows['likes'];
    $cur_reply = $rows['reply'];

}else if (isset($_POST['submit']) && $_POST['submit']){
    //获取POST值
    $cur_id = $_POST['id'];
    $cur_areaid = $_POST['areaid'];
    $cur_topic = $_POST['topic'];
    //$cur_name = $_POST['name'];
    //$cur_email = $_POST['email'];
    $cur_sticky = $_POST['sticky'];

    $sql = "UPDATE forum_topic SET areaid='$cur_areaid', topic='$cur_topic', sticky='$cur_sticky' WHERE id='$cur_id'";
    $result = mysql_query($sql);

    //更新状态判断
    if($result){ //成功
        header("Location: topic.php");
    }else{
        ExitMessage("更新失败！", "edittopic.php?id=$cur_id");
    }

}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>学生综合素质测评系统 - 修改学生信息</title>

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
                            <h1>修改话题信息</h1>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#"></a>话题管理</li>
                                <li class="active">修改话题信息</li>
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

                        <form method="POST" action="edittopic.php">
                            <div class="row">
                                <input type="hidden" name="id" class="form-control border-none input-flat bg-ash" placeholder="未加载，请重试。" value="<?php echo $cur_id;?>">
                                <div class="col-md-4">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>主题名</label>
                                            <input name="topic" type="text" class="form-control border-none input-flat bg-ash" placeholder="" value="<?php echo $cur_topic;?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>发布内容</label>
                                            <textarea name="detail" type="text" class="form-control border-none input-flat bg-ash" placeholder=""><?php echo $cur_detail;?>
                                            </textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>话题板块</label>
                                            <?php
                                            $areaid = $rows['areaid'];
                                            $sql_area = "SELECT name FROM forum_area WHERE id='$areaid'";
                                            $result_area = mysql_query($sql_area);
                                            $rows_area = mysql_fetch_array($result_area);
                                            $areaName = $rows_area['name'];
                                            ?>
                                            <select name="areaid" class="form-control bg-ash border-none">
                                                <option selected value="<?php echo $areaid;?>"><?php echo $areaName;?>（不选择不更新）</option>
                                                <?php
                                                $sql_allarea = "SELECT * FROM forum_area";
                                                $result_allarea = mysql_query($sql_allarea);
                                                while($rows_allarea = mysql_fetch_array($result_allarea)){
                                                ?>
                                                <option value="<?php echo $rows_allarea['id']; ?>"><?php echo $rows_allarea['name']; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>是否置顶</label>
                                            <?php if ($cur_sticky == 0){
                                                ?>
                                                <select name="sticky" class="form-control bg-ash border-none">
                                                    <option selected value="0">否</option>
                                                    <option value="1">是</option>
                                                </select>
                                                <?php
                                            }else{
                                                ?>
                                                <select name="sticky" class="form-control bg-ash border-none">
                                                    <option value="0">否</option>
                                                    <option selected value="1">是</option>
                                                </select>
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>发布者（不可更改）</label>
                                            <input readonly name="name" type="text" class="form-control border-none input-flat bg-ash" placeholder="" value="<?php echo $cur_name;?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>发布者邮箱（不可更改）</label>
                                            <input readonly name="email" type="email" class="form-control border-none input-flat bg-ash" placeholder="" value="<?php echo $cur_email;?>">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>访问数（不可修改）</label>
                                            <input readonly name="view" type="text" class="form-control border-none input-flat bg-ash" placeholder="" value="<?php echo $cur_view;?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>回复数（不可修改）</label>
                                            <input readonly name="reply" type="text" class="form-control border-none input-flat bg-ash" placeholder="" value="<?php echo $cur_reply;?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>喜欢数（不可修改）</label>
                                            <input readonly name="likes" type="text" class="form-control border-none input-flat bg-ash" placeholder="" value="<?php echo $cur_likes;?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="basic-form">
                                        <div class="form-group">
                                            <label>发布时间（不可修改）</label>
                                            <input readonly name="datetime" type="text" class="form-control border-none input-flat bg-ash" placeholder="" value="<?php echo $cur_datetime;?>">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <input name="submit" class="btn btn-default bg-warning border-none" type="submit" value="更新">
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
