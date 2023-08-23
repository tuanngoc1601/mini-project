<?php

/**
 *Session Class
 **/
// init khởi tạo file session
class Session
{
    public static function init()
    {
        if (version_compare(phpversion(), '5.4.0', '<')) {
            if (session_id() == '') {
                session_start();
            }
        } else {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
        }
    }

    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }
    //set key thành giá trị

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public static function checkSession()
    {
        self::init();
        if (self::get("user_login") == false && $_GET['controller'] != 'user') {
            self::destroy();
            header("Location:/?controller=user&action=viewLogin");
        }
    }
    //check phiên làm việc có tồn tại hay không
    public static function checkLogin()
    {
        self::init();
        if (self::get("user_login") == true && $_GET['controller'] != 'product') {
            header("Location:/?controller=product&action=list");
        }
    }

    public static function destroy()
    {
        session_destroy();
        setcookie("user_login", "", time() - 3600);
        setcookie("user_id", "", time() - 3600);
        setcookie('name', "", time() - 3600);
        header("Location:index.php");
    }
    // xóa or hủy phiên làm việc
}