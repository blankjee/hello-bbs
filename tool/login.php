<?php
    ini_set("error_reporting","E_ALL & ~E_NOTICE");
    header("Content-type: text/html; charset=utf-8");
    require('../config.inc.php');


    //用户信息
    $username = $_POST['username'];
    $password = $_POST['password'];
    //验证码
    $checkNum = $_POST['checkNum']; //表单输入
    $validcode = $_SESSION['captcha']; //系统产生

    if (strtolower($checkNum) != strtolower($validcode)){   //验证码错误，错误代码-1
        echo -1;
    }else{
        $_SESSION["captcha"] = "";

        $remeberMe = "";
        if(isset($_POST['remeberMe'])){
            $remeberMe = $_POST['remeberMe'];
        }

        //从数据库中检索用户名，密码是否匹配
        $origin_password = $password;
        $password = md5(md5($password));
        $sql = "SELECT * FROM forum_user
                WHERE username = '$username' AND password = '$password'";
        $result = mysql_query($sql);
        $num_rows = mysql_num_rows($result);
        //用户校验
        if($num_rows == 1){ //成功
            $_SESSION['username'] = $username;
            if ($remeberMe == "yes"){
                setcookie("username", $username, time()+3600*24);   //一天后过期
                setcookie("password", $origin_password, time()+3600*24);
            }
            echo true;
            //header("Location: index.php");
        }else{
            echo -2;
            //ExitMessage("用户名或密码错误！", "login.php");
        }
    }

?>