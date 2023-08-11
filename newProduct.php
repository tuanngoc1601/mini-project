<?php
include './templates/header.php';
?>

<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/app/controllers/productController.php');
?>

<?php
$controller = new ProductController();
$result = [];
if (isset($_POST['name']) && $_POST['price']) {
    $result = $controller->insertOne($_POST['name'], $_POST['price'], $_POST['description']);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Add new product page</title>
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
                    <a href="/productList.php">
                        <div class="text">
                            <p>Product list</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="main-wrapper">
                <div class="navbar">
                    <div class="icon">
                        <img
                            src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                            alt="user"
                        />
                        <p>Test user</p>
                    </div>
                    <div class="logout">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </div>
                </div>
                <div class="content">
                    <div class="title">
                        <span>></span>
                        <h1>Add new product page</h1>
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
                    
                    
                    <form action="" method="post" class="new-product-form">
                        <div class="form-content">
                            <div class="form-group w-75">
                                <label for="name">Product name: </label><br />
                                <input
                                    class="form-control"
                                    type="text"
                                    name="name"
                                    id="name"
                                    required
                                    minlength="1"
                                />
                            </div>
                            <div class="form-group w-25">
                                <label for="price">Product price: </label><br />
                                <input
                                    class="form-control"
                                    type="number"
                                    name="price"
                                    id="price"
                                    required
                                    min="0"
                                    pattern="[0-9]*[.,]?[0-9]+"
                                />
                            </div>
                            <div class="form-group w-100">
                                <label for="description"
                                    >Product description: </label
                                ><br />
                                <textarea
                                    name="description"
                                    id="description"
                                    cols="30"
                                    rows="10"
                                ></textarea>
                            </div>
                            <div class="w-50">
                                <button type="submit" class="btn success w-100">
                                    Add
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script src="./assets/javascript/newProductScript.js"></script>
</html>
