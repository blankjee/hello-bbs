<?php
ini_set("error_reporting","E_ALL & ~E_NOTICE");
header("Content-type: text/html; charset=utf-8");

require('../config.inc.php');
if (isset($_POST['submit']) && $_POST['submit']){
    //用户信息
    $username = $_POST['username'];
    $password = $_POST['password'];
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
    $rows = mysql_fetch_array($result);

    //用户校验
    if($num_rows == 1 && $rows['permission'] == "1"){ //成功
        $_SESSION['username'] = $username;
        if ($remeberMe == "yes"){
            setcookie("username", $username, time()+3600*24);   //一天后过期
            setcookie("password", $origin_password, time()+3600*24);
        }
        header("Location: index.php");
    }else{
        ExitMessage("用户名或密码错误！", "signin.php");
    }
}else{
    if (isset($_COOKIE['username']) && isset($_COOKIE['password'])){
        $cookie_username = $_COOKIE['username'];
        $cookie_password = $_COOKIE['password'];
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BBS论坛系统后台端 - 登录</title>

    <!-- ================= Favicon ================== -->

    <!-- Styles -->
    <link href="assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/lib/unix.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>

<body class="bg-primary">

<div class="unix-login">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <div class="login-content">
                    <div class="login-logo">
                        <a href="index.jsp"><span>BBS论坛系统后台端</span></a>
                    </div>
                    <div class="login-form">
                        <h4>登录</h4>
                        <form method="post" action="signin.php">
                            <div class="form-group">
                                <label>用户名</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $cookie_username;?>" placeholder="请输入您的用户名...">
                            </div>
                            <div class="form-group">
                                <label>密码</label>
                                <input type="password" name="password" class="form-control" value="<?php echo $cookie_password;?>" placeholder="请输入您的密码...">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input value="yes" name="rembpwd" type="checkbox"> 记住密码
                                </label>
                                <label class="pull-right">
                                    <a href="#">忘记密码?</a>
                                </label>

                            </div>
                            <input type="submit" name="submit" class="btn btn-primary btn-flat m-b-30 m-t-30" value="登录">
                            <a class="button" href="../index.php">返回前台</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>
<?php }?>