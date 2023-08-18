<?php
include './templates/header.php';
?>

<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/app/controllers/productController.php');
?>

<?php
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    Session::destroy();
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}
$controller = new ProductController();
    // delete controller
    $result = [];
    $result = $controller->delete($id);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Delete product</title>
        <link rel="stylesheet" href="./assets/stylesheets/productStyle.css" />
        <link
            rel="stylesheet"
            href="./assets/stylesheets/newProductStyle.css"
        />
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
            integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
    </head>

    <body>
        <div class="container">
            <div class="sidebar">
                <div class="image-text logo">
                    <div class="image">
                        <img src="./assets/images/logo.png" alt="logo" />
                    </div>
                    <div class="text">
                        <p>Product management service</p>
                    </div>
                </div>
                <div class="image-text">
                    <div class="image">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                    <a href="./productList.php">
                        <div class="text">
                            <p>Product list</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="main-wrapper">
            <div class="navbar">
                <div class="icon">
                    <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="user" />
                    <?php
                        $name = Session::get("name");
                        echo "<p>$name</p>";
                    ?>
                </div>
                <div class="logout">
                    <a href="?action=logout"><i class="fa-solid fa-right-from-bracket"></i></a>
                </div>
            </div>
                <div class="content">
                    <div class="title">
                        <span>></span>
                        <h1>Delete product page</h1>
                    </div>
                    <?php 
                    if (isset($result['success'])) {
                        $success = $result['success'];
                        echo "<p class='noti success'>
                            <span onclick='removeNotification()'>x</span
                            >&nbsp;&nbsp; $success
                        </p>";
                    }
                    ?>
                    <?php 
                    if (isset($result['error'])) {
                        $error = $result['error'];
                        echo "<p class='noti danger'>
                            <span onclick='removeNotification()'>x</span
                            >&nbsp;&nbsp; $error
                        </p>";
                    }
                    ?>
                    <div class="content">
                        <a href='./productList.php'><button class='btn secondary'>Back to home</button></a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
