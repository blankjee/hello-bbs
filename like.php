<?php
    ini_set("error_reporting","E_ALL & ~E_NOTICE");
    header("Content-type: text/html; charset=utf-8");
    require('config.inc.php');

    $ip = get_client_ip();
    $id = $_POST['topic_id'];
    if(!isset($id) || empty($id)) exit;

    $ip_sql=mysql_query("select * from forum_ip where topicId='$id' and ip='$ip'");
    $count=mysql_num_rows($ip_sql);

    if($count==0){
        $sql = "UPDATE forum_topic set likes=likes+1 WHERE id='$id'";
        mysql_query($sql);
        $sql_in = "insert into forum_ip (topicId,ip) values ('$id','$ip')";
        mysql_query( $sql_in);
        $result = mysql_query("SELECT * FROM forum_topic WHERE id='$id'");
        $rows = mysql_fetch_array($result);
        $likes = $rows['likes'];
        echo $likes;
    }else{
        $likes = -1;    //表示赞过了
        echo $likes;
    }

    //获取用户真实IP
    function get_client_ip() {
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
            $ip = getenv("HTTP_CLIENT_IP");
        else
            if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
                $ip = getenv("HTTP_X_FORWARDED_FOR");
            else
                if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
                    $ip = getenv("REMOTE_ADDR");
                else
                    if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
                        $ip = $_SERVER['REMOTE_ADDR'];
                    else
                        $ip = "unknown";
        return ($ip);
    }
?>