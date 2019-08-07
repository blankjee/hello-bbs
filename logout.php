<?php

    require('config.inc.php');
    //清空SESSION
    $_SESSION = array();
    session_unset();
    session_destroy();

    header("Location: index.php");
?>
