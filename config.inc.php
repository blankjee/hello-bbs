<?php
    //ini_set("error_reporting","E_ALL & ~E_NOTICE");
    header("Content-type: text/html; charset=utf-8");
    /*系统参数设置*/
    //数据库
    define('DB_USER', "root");
    define('DB_PSWD', "" );
    define('DB_HOST', "localhost");
    define('DB_NAME', "mybbs");
    //管理员用户
    define('ADMIN_USER', "admin");
    //分页设置
    define('EACH_PAGE', 5);

    /*公共函数*/
    //检查E-email地址是否正确
    function CheckEmail($email){
        $check = "/^[0-9a-zA-Z_-]+@[0-9a-zA-Z_-]+(\.[0-9a-zA-Z_-]+){0,3}$/";
        if (preg_match($check, $email)){
            return true;
        }else{
            return false;
        }
    }
    /*显示错误位置和返回的链接地址，并终止程序执行*/
    function ExitMessage($message, $url=''){
        echo '<p class="message">';
        echo $message;
        echo '<br>';
        if ($url){
            echo '<a href="'.$url.'">返回</a>';
        }else{
            echo '<a href="index.php" ">返回</a>';
        }
        echo '</p>';
        exit;
    }

    /*初始化程序*/
    //开启SESSION
    session_start();
    //打开数据连接
    $db = mysql_pconnect(DB_HOST, DB_USER, DB_PSWD);
    mysql_query("set names utf8");
    if (!$db){
        die('<b>数据库连接失败！</b>');
        exit;
    }
    //选择数据库
    mysql_select_db(DB_NAME);

?>