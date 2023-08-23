<?php
$filepath = realpath(dirname(__FILE__));
// include($filepath.'/../../config/session.php');
// Session::checkLogin();
include_once($filepath.'/../models/userModel.php');
include_once($filepath.'/../../helper/format.php');
include($filepath.'\baseController.php');
?>

<?php
class UserController extends BaseController
{
    private $model;
    private $fm;

    public function __construct()
    {
        $this->model = new userModel();
        $this->fm = new Format();
        $this->folder = 'auth';
    }

    public function viewLogin() {
        $this->render('login');
    }

    public function viewRegister() {
        $this->render('register');
    }

    public function login()
    {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $remember = isset($_POST['remember']);

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
            header("Location:index.php");
        } else {
            return $this->render('login', ['login_check' => "User and Pass not match"]);
        }
    }

    public function register() {
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $username = $this->fm->validation($username); //gọi ham validation từ file Format để ktra
        $password = $this->fm->validation($password);

        $result = $this->model->register_user($username, $password);
        
        if ($result != false) {
            header("Location:/?controller=user&action=viewLogin");
        } else {
            return $this->render('login', ['register_check' => "Cannot registration"]);
        }
    }
}
?>