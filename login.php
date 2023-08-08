<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/app/controllers/userController.php');
?>

<?php
$user = new userController();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $login_check = $user->login($username, $password); // hàm check User and Pass khi submit lên

}
?>

<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <!-- <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" /> -->
</head>

<body>
    <div class="container">
        <section id="content">
            <form action="login.php" method="post">
                <h1>ĐĂNG NHẬP</h1>
                <span>
                    <?php
                    if (isset($login_check)) {
                        echo $login_check;
                    }
                    ?>
                </span>
                <div>
                    <input type="text" placeholder="Username" required="" name="username" />
                </div>
                <div>
                    <input type="password" placeholder="Password" required="" name="password" />
                </div>
                <div>
                    <input type="submit" value="Login" />
                </div>
            </form><!-- form -->
        </section><!-- content -->
    </div><!-- container -->
</body>

</html>