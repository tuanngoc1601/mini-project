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
                    if (isset($data['register_check'])) {
                        echo $data['register_check'];
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