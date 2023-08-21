<?php
$filepath = realpath(dirname(__FILE__));
include($filepath.'/../../config/session.php');
Session::checkLogin();
include($filepath.'/../models/userModel.php');
include($filepath.'/../helper/format.php');
?>

<?php
class userController
{
    private $model;
    private $fm;

    public function __construct()
    {
        $this->model = new userModel();
        $this->fm = new Format();
    }

    public function login($username, $password, $remember)
    {
        $username = $this->fm->validation($username); //gọi ham validation từ file Format để ktra
        $password = $this->fm->validation($password);

        $result = $this->model->login_user($username, $password);

        if ($result != false) {
            $value = $result->fetch_assoc();
            Session::set('user_login', true); // set user_login đã tồn tại
            // gọi function Checklogin để kiểm tra true.
            Session::set('user_id', $value['id']);
            Session::set('name', $value['username']);
            if ($remember) {
                setcookie('user_login', true, time() + (86400 * 30), "/");
                setcookie('user_id', $value['id'], time() + (86400 * 30), "/");
                setcookie('name', $value['username'], time() + (86400 * 30), "/");
            }
            header("Location:productList.php");
        } else {
            $alert = "User and Pass not match";
            return $alert;
        }
    }

    public function register($username, $password) {
        $username = $this->fm->validation($username); //gọi ham validation từ file Format để ktra
        $password = $this->fm->validation($password);

        $result = $this->model->register_user($username, $password);
        
        if ($result != false) {
            header("Location:login.php");
        } else {
            $alert = "Cannot registration";
            return $alert;
        }
    }
}
?>