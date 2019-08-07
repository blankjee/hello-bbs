<?php
    ini_set("error_reporting","E_ALL & ~E_NOTICE");
    header("Content-type: text/html; charset=utf-8");
    require('config.inc.php');

    $topic_id = $_POST['topic_id'];
    $reply_name = $_POST['reply_name'];
    $content = $_POST['reply_detail'];

    //根据username查找评论人信息
    $sql_user = "SELECT * FROM forum_user WHERE username='$reply_name'";
    $result_user = mysql_query($sql_user);
    $rows_user = mysql_fetch_array($result_user);
    $reply_email = $rows_user['email'];
    $reply_phonenum = $rows_user['phonenum'];

    //将评论插入到数据库
    $sql = "INSERT INTO forum_reply (topic_id, reply_name, reply_email, reply_detail, reply_datetime) VALUES('$topic_id', '$reply_name', '$reply_email', '$content', NOW())";
    $result = mysql_query($sql);
    //将主题帖中的reply数+1
    $sql_replynum = "UPDATE forum_topic SET reply=reply+1 WHERE id=$topic_id";
    $result_replynum = mysql_query($sql_replynum);
    if ($result && $result_replynum){
        echo true;
    }else{
        echo false;
    }

?>