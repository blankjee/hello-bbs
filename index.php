<?php
    ini_set("error_reporting","E_ALL & ~E_NOTICE");
    header("Content-type: text/html; charset=utf-8");
    require('config.inc.php');

    //获得当前页数
    $page = $_GET["page"];

    //每页最多显示的记录数
    $each_page = 8;

    //计算页面开始位置
    if (!$page || $page == 1){
        $start = 0;
    }else{
        $offset = $page - 1;
        $start = ($offset * $each_page);
    }
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>我的论坛首页</title>
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
    <?php include('home.php'); ?>
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

</body>
</html>