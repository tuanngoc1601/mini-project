<?php 
    session_start();
    $filepath = realpath(dirname(__FILE__));
    include($filepath . '/../config/session.php');
    if (isset($_COOKIE['user_id'])) {
        Session::set('user_id', $_COOKIE['user_id']);
    }

    if (isset($_COOKIE['name'])) {
        Session::set('name', $_COOKIE['name']);
    }
    
    if (isset($_COOKIE['user_login'])) {
        Session::set('user_login', $_COOKIE['user_login']);
    }
    Session::checkSession();
    Session::checkLogin();
?>

<?php
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    header("Cache-Control: max-age=2592000");
?>