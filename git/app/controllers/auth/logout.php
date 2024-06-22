<?php
    session_start();
    session_destroy();
    header("location: /git/login");
    exit();
?>