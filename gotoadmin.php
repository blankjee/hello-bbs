<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- ================= Favicon ================== -->
    <!-- Styles -->
    <link href="admin/assets/css/lib/chartist/chartist.min.css" rel="stylesheet">
    <link href="admin/assets/css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="admin/assets/css/lib/themify-icons.css" rel="stylesheet">
    <link href="admin/assets/css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="admin/assets/css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="admin/assets/css/lib/weather-icons.css" rel="stylesheet" />
    <link href="admin/assets/css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="admin/assets/css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="admin/assets/css/lib/unix.css" rel="stylesheet">
    <link href="admin/assets/css/style.css" rel="stylesheet">
</head>
</html>
<?php
    //ini_set("error_reporting","E_ALL & ~E_NOTICE");
    //require('config.inc.php');
    //清空SESSION
//    session_start();
//    $_SESSION = array();
//    session_unset();
//    session_destroy();

    //header("Location: admin/index.php");
    $url="admin/index.php";
    echo "<SCRIPT>";
    echo "location.href='$url'";
    echo "</SCRIPT>";
?>