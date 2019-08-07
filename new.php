<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
header("Content-type: text/html; charset=utf-8");

require('config.inc.php');
require('lib/HyperDown/Parser.php');


if (!$_SESSION['username']){    //权限判断
    ExitMessage("您未登录，没有发帖权限！", "signin.php");
}

if (isset($_POST['submit']) && $_POST['submit']){
    //获得用户信息
    $username = $_SESSION['username'];
    $sql = "SELECT * FROM forum_user WHERE username='$username'";
    $result = mysql_query($sql);
    $info = mysql_fetch_array($result);

    //获取表单信息
    $areaid = $_POST['nodeSlug'];
    $topic = $_POST['topic'];
    $detail = $_POST['detail'];
    $name = $username;
    //默认0
    $view = 0;
    $reply = 0;
    //自己发表的默认不置顶，sticky=0
    $sticky = 0;

    if (!$topic){
        ExitMessage("请输入标题！");
    }
    if (!$detail){
        ExitMessage("请输入正文！");
    }
    //对Makedown进行处理，使用了第三方库HyperDown
    $parser = new HyperDown\Parser;
    $html = $parser->makeHtml($detail);

    //将数据插入数据库
    $sql = "INSERT INTO forum_topic(areaid, topic, detail, name, email, datetime, view, reply, sticky) VALUES ('$areaid', '$topic', '$html', '$name', '$email', NOW(), '$view', '$reply', '$sticky')";
    $result = mysql_query($sql);
    if ($result){
        header("Location: index.php");
    }else{
        ExitMessage("创建新帖失败！");
    }
}else{
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>发表帖子</title>
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
        <div class="column home-topic">
            <div class="message is-light">
                <div class="message-header">
                    <div class="is-left">
                        <a href="">首页</a> / <span>发布新主题</span>
                    </div>
                </div>
                <div class="message-body">
                    <form id="topic-form" method="post" action="new.php">
                        <div class="bd-snippet-preview ">

                            <input type="hidden" name="nodeTitle" id="nodeTitle"/>
                            <input type="hidden" name="textType" id="textType" value="1"/>
                            <input type="hidden" name="csrf_token" value="${csrf_token}"/>

                            <div class="field">
                                <div class="control">
                                    <input class="input" id="topic" name="topic" type="text" placeholder="请输入主题标题"
                                           required/>
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                    <div class="select" style="vertical-align: sub;">
                                        <select id="nodeSlug" name="nodeSlug">
                                            <option value="" selected>请选择版块</option>
                                            <?php
                                                //获取所有版块信息
                                                $sql = "SELECT * FROM forum_area";
                                                $result = mysql_query($sql);
                                                //循环取出记录内容
                                                while($rows = mysql_fetch_array($result)){
                                            ?>

                                                <option value="<?php echo $rows['id'];?>"><?php echo $rows['name'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="field">
                                <div class="control">
                                <textarea id="editor" name="detail" class="textarea" placeholder="请输入主题内容"
                                          required></textarea>
                                </div>
                            </div>

                            <div class="field is-grouped">
                                <div class="control">
                                    <input id="publish-btn" type="submit" class="button is-link" name="submit" value="发布主题" />
                                </div>
                                <div class="control">
                                    <a href="index.php" class="button">取消发布</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <!--<div class="message-header">-->
                <!--<a href="">使用富文本编辑器</a>-->
                <!--</div>-->

            </div>
        </div>
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
<script type="text/javascript" src="static/plugins/jquery.validation/jquery.validate.min.js"></script>
<script type="text/javascript" src="static/plugins/jquery.validation/localization/messages_zh.min.js"></script>

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

<?php }?>
