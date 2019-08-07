<div class="column is-one-quarter">
    <?php
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


    //判断用户是否登录，从而显示不同的功能界面
    if (isset($_SESSION['username']) && $_SESSION['username']) {
        ?>
        <div class="message is-light">
            <div class="message-header">BBS论坛系统</div>
            <div class="message-body has-text-centered">
                <h6 class="subtitle is-6">
                    <a class="button is-danger" href="new.php">
                    <span class="icon">
                      <i class="fa fa-pencil-square-o"></i>
                    </span>
                        <span>发布主题</span>
                    </a>
                </h6>
            </div>
        </div>
    <?php } else { ?>
        <div class="message is-light">
            <div class="message-header">BBS论坛系统</div>
            <div class="message-body has-text-centered">
                <a class="button is-danger is-outlined" data-no-instant href="signup.php">马上注册</a>
                <a class="button is-info is-outlined" data-no-instant href="signin.php">登录</a>
            </div>
        </div>
    <?php } ?>

    <div class="message is-light">
        <div class="message-header">公告</div>
        <div class="message-body">
            <h6 class="subtitle is-6">
                Enjoy It!
            </h6>
        </div>
    </div>
    <div class="message-header">站点统计</div>
    <div class="message-body">
        <span>社区会员: <?php echo $_SESSION["usercount"]; ?> 人</span>
        <hr/>
        <span>主题数: <?php echo $_SESSION["topiccount"]; ?> 个</span>
        <hr/>
        <span>回帖数: <?php echo $_SESSION["replycount"]; ?> 条</span>
    </div>
</div>

</div>