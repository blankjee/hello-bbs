<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
header("Content-type: text/html; charset=utf-8");

require('../config.inc.php');

//判断是否是登录状态，如果登录跳转至登录界面
if (!isset($_SESSION['username'])){
    header("Location: signin.php");
}

if (isset($_GET['id'])) {
    //获取GET值
    $id = $_GET['id'];
    $sql = "DELETE FROM forum_user WHERE id='$id'";
    $result = mysql_query($sql);

    //更新状态判断
    if($result){ //成功
        header("Location: user.php");
    }else{
        ExitMessage("删除失败！", "user.php");
    }
}else{
    ExitMessage("删除失败！", "user.php");
}

?>