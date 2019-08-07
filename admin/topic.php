<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
header("Content-type: text/html; charset=utf-8");

require('../config.inc.php');

//判断是否是登录状态，如果登录跳转至登录界面
if (!isset($_SESSION['username'])){
    header("Location: signin.php");
}

//会员数
$sql = "SELECT * FROM forum_topic";
$result = mysql_query($sql);


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BBS论坛系统后台端 - 话题信息管理</title>
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
    <link href="assets/css/lib/bootstrap-switch.min.css" rel="stylesheet">
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
                            <h1>话题信息管理</h1>
                        </div>
                    </div>
                </div>
                <!-- /# column -->
                <div class="col-lg-4 p-l-0 title-margin-left">
                    <div class="page-header">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li><a href="#">话题管理</a></li>
                                <li class="active">话题信息表</li>
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
                                <h4>&nbsp;</h4>

                            </div>
                            <div class="bootstrap-data-table-panel">
                                <div class="table-responsive">
                                    <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th hidden="">ID</th>
                                            <th>所属板块</th>
                                            <th>主题名</th>

                                            <th>发布者</th>
                                            <th>发布者邮箱</th>
                                            <th>访问数</th>
                                            <th>回复数</th>
                                            <th>喜欢数</th>
                                            <th>是否置顶</th>
                                            <th>发布时间</th>
                                            <th>操作</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        //循环输出记录列表
                                        while($rows = mysql_fetch_array($result)) {
                                            //由areaid查找到areaName
                                            $areaid = $rows['areaid'];
                                            $sql_area = "SELECT name FROM forum_area WHERE id='$areaid'";
                                            $result_area = mysql_query($sql_area);
                                            $rows_area = mysql_fetch_array($result_area);
                                            $areaName = $rows_area['name'];
                                            ?>
                                            <tr>
                                                <td hidden=""><?php echo $rows['id']; ?></td>
                                                <td><?php echo $areaName; ?></td>
                                                <td><?php echo $rows['topic']; ?></td>

                                                <td><?php echo $rows['name']; ?></td>
                                                <td><?php echo $rows['email']; ?></td>
                                                <td><?php echo $rows['view']; ?></td>
                                                <td><?php echo $rows['reply']; ?></td>
                                                <td><?php echo $rows['likes']; ?></td>
                                                <td>
                                                    <div class="switch switch-mini">
                                                        <input name="my-checkbox" type="checkbox" <?php if($rows['sticky'] == 1) echo "checked='checked'" ?> />
                                                    </div>
                                                </td>
                                                <td><?php echo $rows['datetime']; ?></td>
                                                <td>
                                                    <span><a href="edittopic.php?id=<?php echo $rows['id']; ?>"><i class="ti-pencil-alt color-success"></i></a></span>
                                                    <span><a href="deltopic.php?id=<?php echo $rows['id']; ?>"><i class="ti-trash color-danger"></i></a></span>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /# card -->
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
<script src="assets/js/lib/bootstrap-switch.min.js"></script>
<!-- scripit init-->
<script>

    $("[name='my-checkbox']").bootstrapSwitch({
        onText : "是",      // 设置ON文本  
        offText : "否",    // 设置OFF文本  
        onColor : "success",// 设置ON文本颜色     (info/success/warning/danger/primary)  
        offColor : "info",  // 设置OFF文本颜色        (info/success/warning/danger/primary)  
        size : "small",    // 设置控件大小,从小到大  (mini/small/normal/large)  
        handleWidth:"10",//设置控件宽度
        // 当开关状态改变时触发  
        onSwitchChange : function(event, state) {
            var ProductId = event.target.defaultValue;
            var swicth = $(this).val();
            if (state == true) {
                //上线
                //alert(swicth);

            } else {
                //下线
                //alert(swicth);
            }
        }
    });

</script>

</body>
</html>