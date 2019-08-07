<?php
    ini_set("error_reporting","E_ALL & ~E_NOTICE");
    header("Content-type: text/html; charset=utf-8");
    require('config.inc.php');


    //获得当前页数
    if ($_GET["page"] == null){
        $page = 1;
    }else{
        $page = $_GET["page"];
    }
    //获取查询的板块ID
    $areaid = $_GET['id'];
    if ($areaid == null){
        $areaid = 1;
    }

    //获取当前板块总共有多少主题，并计算共多少页
    $sql_areaname_total = "SELECT * FROM forum_topic WHERE areaid='$areaid'";
    $result_areaname_total = mysql_query($sql_areaname_total);
    $rows_total_number = mysql_num_rows($result_areaname_total);

    //每页最多显示的记录数
    $each_page = 4;
    //总页数
    $total_page = (int)($rows_total_number / $each_page + 1);

    //计算页面开始位置
    if (!$page || $page == 1){
        $start = 0;
    }else{
        $offset = $page - 1;
        $start = ($offset * $each_page);
    }


    //查找areaid对应的版块名
    $sql_find_areaname = "SELECT * from forum_area WHERE id=$areaid";
    $result_areaname = mysql_query($sql_find_areaname);
    $rows_areaname = mysql_fetch_array($result_areaname);
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>论坛详情</title>
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
    <?php
    //检索记录，按照置顶标记和时间排序
    $sql = "SELECT * FROM forum_topic WHERE areaid='$areaid'
            ORDER BY sticky DESC, datetime DESC LIMIT $start, $each_page";
    $result = mysql_query($sql);
    ?>
    <article class="message is-white">
        <div class="message-body shadow-1 boom">
            <div class="media">
                <div class="media-body" style="text-align: center;">
                    <div>
                        <h1>
                            <?php echo $rows_areaname['name']; ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </article>

    <div class="columns">
        <div class="column home-topic">
            <div class="message is-light">
                <div class="message-header">
                <span class="has-text-left"><span class="icon is-small"><i
                            class="fa fa-first-order"></i></span> 首页主题</span>
                    <span class="has-text-right">
                    </span>
                </div>
                <div class="message-body has-text-centered">
                    <!--#for(topic : topics)-->
                    <?php
                    if ($rows_total_number == 0){
                        //无记录
                        echo "这个版块还没有帖子，快来发布吧！";
                    }else{

                    //循环输出记录列表
                    while($rows = mysql_fetch_array($result)) {
                    ?>
                        <article class="media">
                            <figure class="media-left">
                                <p class="image is-48x48">
                                    <a href="" title="${topic.username}">
                                        <img class="avatar-48" src="static/images/topic-img.png">
                                    </a>
                                </p>
                            </figure>
                            <div class="media-content">
                                <div class="content">
                                    <p class="topic-title">
                                        <a href="detail.php?topic_id=<?php echo $rows['id']; ?>" title="<?php echo $rows['topic']; ?>"><?php if ($rows['sticky'] == 1){ echo "<span class='badge badge-danger'>置顶</span>&nbsp;".$rows['topic'];}else {echo $rows['topic'];} ?></a>
                                    </p>
                                    <p class="topic-meta">
                                        <a class="topic-meta" href="${siteUrl('/@' + topic.username)}" title="<?php echo $rows['name']; ?>"><?php echo $rows['name']; ?></a>
                                        <span> • </span>
                                        <small>发布于<?php echo $rows['datetime']; ?></small>
                                    </p>
                                </div>
                            </div>
                            <div class="media-right" style="line-height: 55px;">
                                <a href="${siteUrl('/topic/' + topic.tid + '#reply-' + topic.replyId)}" title="查看评论">
                                    <span class="tag is-rounded" style="background-color: #aab0c6"><?php echo $rows['reply']; ?></span>
                                </a>
                            </div>
                        </article>
                        <?php
                    }
                    }
                    ?>
                </div>
                <div class="message-header">
                    <nav class="pagination">
                        <?php
                        if ($page == null || $page == 1){
                            ?>
                            <a disabled="true" class="pagination-previous" href="javascript:void(0);">上一页</a>
                            <?php
                        }else{
                        ?>
                        <a class="pagination-previous" href="area.php?id=<?php echo $areaid;?>&page=<?php echo $page-1;?>">上一页</a>
                        <?php }?>

                        <?php
                        if ($page == $total_page || $page == null && $total_page == 1){
                            ?>
                            <a disabled="true" class="pagination-previous" href="javascript:void(0);">下一页</a>
                            <?php
                        }else{
                            ?>
                            <a class="pagination-previous" href="area.php?id=<?php echo $areaid;?>&page=<?php echo $page+1;?>">下一页</a>
                        <?php }?>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Side_Bar START -->
        <?php include('partials/sidebar.php'); ?>
        <!-- Side_Bar END -->
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

</body>
</html>