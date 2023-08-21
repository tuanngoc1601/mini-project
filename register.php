<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/app/controllers/userController.php');
?>

<?php
$user = new userController();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // LẤY DỮ LIỆU TỪ PHƯƠNG THỨC Ở FORM POST
    $error = ["username" => "", "password" => ""];
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username)) {
        $error["username"] = "This field cannot be left blank";
    }
    if(empty($password)) {
        $error["password"] = "This field cannot be left blank";
    } else if(strlen($password) < 6) {
        $error["password"] = "Minimum 6 characters required";
    }

    if($error["username"] == "" && $error["password"] == "") {
        $username = $_POST['username'];
        $password = md5($_POST['password']);
        $remember = isset($_POST['remember']);

        $register_check = $user->register($username, $password); // hàm check User and Pass khi submit lên
    }
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
            <form action="register.php" method="post">
                <h1>REGISTER</h1>
                <span>
                    <?php
                    if (isset($register_check)) {
                        echo $register_check;
                    }
                    ?>
                </span>
                <div class="form-group">
                    <label for="username">Username: </label><br />
                    <input class="form-control" type="text" placeholder="Username" name="username"/>
                    <?php if (isset($error)) {?>
                        <span style="color: red; font-size: 17px;"><?=$error["username"]?></span>
                    <?php } ?>    
                </div>
                <div class="form-group">
                    <label for="password">Password: </label><br />
                    <input class="form-control" type="password" placeholder="Password" name="password"/>
                    <?php if (isset($error)) {?>
                        <span style="color: red; font-size: 17px;"><?=$error["password"]?></span>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <input type="submit" value="Register" />
                </div>
                <div>
                    <a href="./login.php">
                        <button class="btn info" type="button">Back to login</button>
                    </a>
                </div>
            </form><!-- form -->
        </section><!-- content -->
    </div><!-- container -->
</body>

</html>