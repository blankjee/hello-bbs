<?php

    //开启SESSION
    session_start();
    //创建黑色画布
    $image = imagecreatetruecolor(100, 30);
    //为画布定义背景颜色
    $bgcolor = imagecolorallocate($image, 255, 255, 255);
    //填充颜色
    imagefill($image, 0, 0, $bgcolor);
    //定义验证码的内容
    $content = "ABCDEFGHJKMNPQRSTUVWXYZabcdefghjkmnpqrstuvwxyz23456789";        //去除了易混的字母数字
    //创建变量存储验证码数据
    $captcha = "";
    for ($i = 0; $i < 4; $i++){
        $fontsize = 10;
        $fontcolor = imagecolorallocate($image, mt_rand(30, 120), mt_rand(30, 120), mt_rand(30, 120));
        $fontcontent = substr($content, mt_rand(0, strlen($content)), 1);
        $captcha .= $fontcontent;
        $x = ($i * 100 / 4) + mt_rand(5, 10);
        $y = mt_rand(5, 10);
        imagestring($image, $fontsize, $x, $y, $fontcontent, $fontcolor);
    }
    $_SESSION["captcha"] = $captcha;

    //设置背景干扰元素
    for ($i=0; $i < 100; $i++){
        $pointcolor = imagecolorallocate($image, mt_rand(50, 200), mt_rand(50, 200), mt_rand(50, 200));
        imagesetpixel($image, mt_rand(1, 99), mt_rand(1, 29), $pointcolor);
    }
    //设置干扰线
    for ($i = 0; $i < 3; $i++){
        $linecolor = imagecolorallocate($image, mt_rand(50, 200), mt_rand(50, 200), mt_rand(50, 200));
        imageline($image, mt_rand(1, 99), mt_rand(1, 29), mt_rand(1, 99), mt_rand(1, 29), $linecolor);
    }
    //向浏览器输出图片头信息
    header('content-type:image/png');
    //输出图片到浏览器
    imagepng($image);
    //销毁图片
    imagedestroy($image);
?>
