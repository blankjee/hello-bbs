<?php
    //检索记录，按照置顶标记和时间排序
    $sql = "SELECT * FROM forum_topic
            ORDER BY sticky DESC, datetime DESC LIMIT $start, $each_page";
    $result = mysql_query($sql);
    $nums = mysql_num_rows($result);
?>

<div class="columns is-mobile node-icon">

    <?php
    //获取所有版块信息
    $sql_area = "SELECT * FROM forum_area";
    $result_area = mysql_query($sql_area);
    //循环取出记录内容
    while($rows_area = mysql_fetch_array($result_area)){
    ?>

    <div class="column">
        <div class="notification shadow-1 is-<?php echo $rows_area['color'];?> has-text-centered">
            <div class="item-icon">
                <a href="area.php?id=<?php echo $rows_area['id'];?>" title="<?php echo $rows_area['name'];?>"><i class="fa fa-<?php echo $rows_area['icon'];?>"></i></a>
            </div>
            <div>
                <a href="area.php?id=<?php echo $rows_area['id'];?>" title="<?php echo $rows_area['name'];?>"><?php echo $rows_area['name'];?></a>
            </div>
        </div>
    </div>

    <?php } ?>
</div>

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
                //循环输出记录列表
                for($index = 0; $index < $nums && $index < 6; $index ++) {
                    $rows = mysql_fetch_array($result);
                    //查找areaid对应的版块名
                    $areaid = $rows['areaid'];
                    $sql_find_areaname = "SELECT * from forum_area WHERE id=$areaid";
                    $result_areaname = mysql_query($sql_find_areaname);
                    $rows_areaname = mysql_fetch_array($result_areaname);
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
                                <a class="topic-meta" href="${siteUrl('/node/' + topic.nodeSlug)}" title="<?php echo $rows_areaname['name']; ?>"><?php echo $rows_areaname['name']; ?></a>
                                <span> • </span>
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
                ?>
            </div>
            <div class="message-header">
                <a class="button is-dark" href="area.php?id=1">更多主题...</a>
            </div>
        </div>
    </div>
    <!-- Side_Bar START -->
    <?php include('partials/sidebar.php'); ?>
    <!-- Side_Bar END -->
</div>



