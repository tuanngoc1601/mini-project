<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/stylesheets/loginStyle.css">
</head>

<body>
    <div class="container">
        <section id="content">
            <form action="/?controller=user&action=login" method="post">
                <h1>LOGIN</h1>
                <span>
                    <?php
                    if (isset($data['login_check'])) {
                        echo $data['login_check'];
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
                <div class="form-group remember">
                    <input type="checkbox" name="remember" value="remember" />
                    <label for="remember">Remember me?</label>
                </div>
                <div class="form-group">
                    <input type="submit" value="Login" />
                </div>
                <div style="text-align: center; font-size: 1.2rem;">
                    <a href="./?controller=user&action=viewRegister">Register now!</a>
                </div>
            </form><!-- form -->
        </section><!-- content -->
    </div><!-- container -->
</body>

</html>