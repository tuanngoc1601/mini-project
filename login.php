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
    <link rel="stylesheet" href="./assets/stylesheets/loginStyle.css">
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
                <div class="form-group">
                    <label for="username">Username: </label><br />
                    <input class="form-control" type="text" placeholder="Username" required="" name="username" />
                </div>
                <div class="form-group">
                    <label for="password">Password: </label><br />
                    <input class="form-control" type="password" placeholder="Password" required="" name="password" />
                </div>
                <div class="form-group remember">
                    <input type="checkbox" name="remember" />
                    <label for="remember">Remember me?</label>
                </div>
                <div class="form-group">
                    <input type="submit" value="Login" />
                </div>
            </form><!-- form -->
        </section><!-- content -->
    </div><!-- container -->
</body>

</html>