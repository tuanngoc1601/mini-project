<?php 
    session_start();
    $filepath = realpath(dirname(__FILE__));
    include($filepath . '/../config/session.php');
    include_once($filepath . '/../config/cookie.php');
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['name'])) {
        if (Cookie::checkCookie($_COOKIE['name'], $_COOKIE['user_id'])) {
            Session::set('user_id', $_COOKIE['user_id']);
            Session::set('name', $_COOKIE['name']);
            Session::set('user_login', $_COOKIE['user_login']);
        }else {
            Session::destroy();
        }
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