<?php
    ini_set("error_reporting","E_ALL & ~E_NOTICE");
    header("Content-type: text/html; charset=utf-8");
    require('config.inc.php');

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


    <div class="columns">
        <div class="column home-topic">
            <div class="message is-light">
                <div class="message-header">
                <span class="has-text-left"><span class="icon is-small"></span> 关于</span>
                    <span class="has-text-right">
                    </span>
                </div>
                <div class="message-body has-text-centered">
                    <article class="media">
                        <div class="media-content">
                            <div class="content">
                                <p class="topic-title">
                                    <h1>关于</h1>
                                </p>
                                <p class="topic-meta" style="font-size: 13px; line-height: 26px;">
                                    <br/>
                                    # Intro | 简介<br/>

                                    <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;现如今，互联网技术正在以前所未有的速度发展，网络已经不再仅仅是获取信息的来源，更是人们探讨问题，沟通思想的天地。其中，网络论坛就扮演着非常重要的角色，它给用户提供一个信息交流的场所，用户可以通过平台获取信息、发表言论，在自己擅长的领域进行经验分享、技术交流。因此非常有必要建设一个完善的BBS论坛系统。
                                    <br/><br/>
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;因此，作者设计了一套简单易用的BBS论坛系统，系统采用PHP语言编写，使用了HTML、JQuery、JavaScript、MySQL等技术。分角色的设计了系统注册登录、发帖、管理帖子、发表评论、管理评论等功能。方便了用户在网络上的交流。
                                </p>
                            </div>
                        </div>

                    </article>

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