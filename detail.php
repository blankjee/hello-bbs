<?php
    ini_set("error_reporting","E_ALL & ~E_NOTICE");
    header("Content-type: text/html; charset=utf-8");
    require('config.inc.php');

    //根据ID获得帖子记录
    $id = $_GET['topic_id'];
    $sql = "SELECT * FROM forum_topic WHERE id = '$id'";

    $result = mysql_query($sql);
    $rows = mysql_fetch_array($result);

    if (!$rows){    //帖子不存在
        ExitMessage("该贴可能被删除了...", "index.php");
    }

    //置顶标记
    $sticky = $rows['sticky'];

    //查找areaid对应的版块名
    $areaid = $rows['areaid'];
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
    <title>帖子详情</title>
    <link href="static/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="static/css/bulma.min.css" rel="stylesheet"/>
    <link href="static/plugins/noty/noty.css" rel="stylesheet"/>
    <link rel="stylesheet" href="static/css/roo.css?v=${version}"/>
    <link rel="stylesheet" href="static/plugins/mditor/css/mditor.min.css"/>
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
        <div class="column">
            <div class="message is-light">
                <div class="message-header">
                    <div class="has-text-left">
                        <div style="padding-bottom: 10px;">
                            <a href="area.php?id=<?php echo $areaid; ?>" title="<?php echo $rows_areaname['name']; ?>"><?php echo $rows_areaname['name']; ?></a>
                            /
                            <span style="color: #222527;"><?php echo $rows['topic'];?></span>
                        </div>
                        <div class="topic-head-meta">
                            <a href="#"
                               title="${topic.username}"><b><?php echo $rows['name'];?></b></a> · 发布于 <abbr><?php echo $rows['datetime'];?></abbr>

                            <span><?php echo $rows['view'];?></span> 次阅读
                        </div>
                    </div>
                    <div class="has-text-right">
                        <p class="image is-48x48">
                            <a href="#">
                                <img class="avatar-48" src="static/images/topic-img.png">
                            </a>
                        </p>
                    </div>

                </div>
                <div class="content topic-content">
                    <?php
                        /**
                         * 输出整理好的内容
                         * nl2br():在字符串中的每个新行（\n）之前插入 HTML 换行符
                         * htmlspecialchars():把一些预定义的字符转换为 HTML 实体。如：<转&lt;
                         */
                        //echo nl2br(htmlspecialchars($rows['detail']));
                        //不需要整理再发出了，直接发出
                        echo $rows['detail'];
                    ?>
                </div>
                <div class="message-header topic-footer">
                    <div class="has-text-left">
                        <!-- 暂时赞数是浏览数 -->
                        <span><span id="likeCount"><?php echo $rows['likes'];?></span> 个赞</span>&nbsp;·&nbsp;
                        <span>收藏</span>&nbsp;·&nbsp;
                        <!-- sharePage START -->
                        <?php include('partials/share.html'); ?>
                        <!-- SharePage END -->

                    </div>
                    <div class="has-text-right">
                        <i id="like" class="fa fa-thumbs-up"></i>
                    </div>
                </div>
            </div>

            <div class="message is-light">
                <div class="content">
                    <!-- #for(comment : topic.commentList) -->
                    <?php
                        //获取回复的内容
                        $sql = "SELECT * FROM forum_reply WHERE topic_id = '$id'";
                        $result = mysql_query($sql);
                        $num_rows = mysql_num_rows($result);
                        $index = 0;
                        if ($num_rows){
                            //循环取出记录内容
                            while($rows = mysql_fetch_array($result)){
                                $index ++;
                        ?>
                        <article id="#" class="media" style="padding: 8px 10px; margin-top:0;">
                            <figure class="media-left" style="padding: 5px 0;">
                                <p class="image is-48x48">
                                    <a href="#">
                                        <img class="avatar-48" src="static/images/profile_boy.png">
                                    </a>
                                </p>
                            </figure>
                            <div class="media-content">
                                <div class="topic-head-meta">
                                    <a href="#"><b><?php echo $rows['reply_name'];?></b></a> ·
                                    回复于 <?php echo $rows['reply_datetime']; ?> · <a href="#">#<?php echo $index; ?></a>
                                </div>
                                <div style="margin-top: 10px;">
                                    <?php
                                        //输出整理好的内容
                                        echo nl2br(htmlspecialchars($rows['reply_detail']));
                                    ?>
                                </div>
                            </div>
                            <div class="media-right" style="line-height: 55px;">
                                <!-- TODO: 回复该评论 -->
                            </div>
                        </article>
                        <?php
                            }
                        }else{
                           ?>
                            <article class="message is-blue">
                                赶快来成为第一个评论的人吧！
                            </article>
                    <?php
                        }?>
                    <!--#end -->
                </div>
            </div>

            <?php
            //判断用户是否登录，从而显示不同的功能界面
            if (isset($_SESSION['username']) && $_SESSION['username']){
            ?>

            <div class="message is-light">
                <form id="comment-form">
                    <div class="bd-snippet-preview" style="padding: 10px;">
                        <input type="hidden" name="topic_id" value="<?php echo $id; ?>"/>
                        <input type="hidden" name="reply_name" value="<?php echo $_SESSION['username']; ?>"/>

                        <div class="field">
                            <div class="control">
                                <textarea id="comment-editor" name="reply_detail" class="textarea" placeholder="请输入评论" required></textarea>
                            </div>
                        </div>
                        <div class="field is-grouped">
                            <div class="control">
                                <button id="comment" type="button" class="button is-link">发布评论</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php }else{ ?>
                <div class="message is-light">
                    <div class="message-header">发表评论</div>
                    <div class="message-body has-text-centered" style="line-height: 30px;">
                        需要 <a class="button is-success is-small" data-no-instant href="signin.php">登录</a> 后方可回复,
                        如果你还没有账号请点击这里 <a class="button is-danger is-small" data-no-instant href="signup.php">注册</a>
                    </div>
                </div>
            <?php } ?>

        </div>
        <?php
            //浏览量+1
            $sql = "UPDATE forum_topic set view=view+1 WHERE id='$id'";
            $result = mysql_query($sql);
        ?>
        <!-- SideBar START -->
        <?php include('partials/sidebar.php'); ?>
        <!-- SideBar END -->
    </div>
    <!-- Main_Content END -->
    <!-- Footer START -->
    <?php include('partials/footer.html'); ?>
    <!-- Footer END -->
</div>



<script type="text/javascript" src="static/plugins/mditor/js/mditor.min.js"></script>
<script type="text/javascript" src="static/js/topic.js"></script>
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
<script type="text/javascript">
    $(function(){
        $("#like").click(function(){
            var like = $(this);
            $.ajax({
                type:"POST",
                url:"like.php",
                data:"topic_id="+<?php echo $id;?>,
                cache:false,
                success:function(data){
                    //alert(data.toString());
                    if (data.toString() != "-1"){
                        var obj = document.getElementById("likeCount");
                        obj.innerText = data.toString();
                        Roo.alertOk('赞 +1');
                    }else{
                        Roo.alertError('您已经赞过了！', function () {
                            if (data.code && data.code == 10000) {
                                window.location.reload();
                            }
                        });
                    }


                }
            });
            return false;
        });
    });
</script>

</body>
</html>


