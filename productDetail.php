<?php
    include './templates/header.php';
    
    $filepath = realpath(dirname(__FILE__));
    include_once($filepath . '/app/controllers/productController.php');
    
    $id = 1;
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
    }
    
    $controller = new ProductController();
    $data = $controller->getOne($id);
    $product = NULL;
    if (!isset($data['error'])) {
        $product = $data['product'];
    }
    
    if (isset($_GET['action']) && $_GET['action'] == 'logout') {
        Session::destroy();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <title>Product detail page</title>
    <link rel="stylesheet" href="./assets/stylesheets/productStyle.css"/>
    <link rel="stylesheet" href="./assets/stylesheets/productDetailStyle.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
</head>

<body>
<div class="container">
    <div class="sidebar">
        <div class="image-text logo">
            <div class="image">
                <img src="./assets/images/logo.png" alt="logo"/>
            </div>
            <div class="text">
                <p>Product management service</p>
            </div>
        </div>
        <div class="image-text">
            <div class="image">
                <i class="fa-solid fa-cart-shopping"></i>
            </div>
            <a href="/mini-project/productList.php">
                <div class="text">
                    <p>Product list</p>
                </div>
            </a>
        </div>
    </div>
    <div class="main-wrapper">
        <div class="navbar">
            <div class="icon">
                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="user"/>
                   <p><?php echo Session::get("name");?></p>
            </div>
            <div class="logout">
                <a href="?action=logout"><i class="fa-solid fa-right-from-bracket"></i></a>
            </div>
        </div>
        <div class="content">
            <div class="title">
                <span>></span>
                <h1>Product detail page</h1>
            </div>
            <div class="detail">
                <?php
                if ($product != NULL) {
                    $name = $product['name'];
                    $price = $product['price'];
                    $description = $product['description'];
                    echo "<div class='image'>
                                    <img
                                        src='https://media.istockphoto.com/id/533728266/photo/thin-golden-frame-with-clipping-path.jpg?s=612x612&w=0&k=20&c=07L_oV-EyMif0W_iEsEYy8TbOFXsIV7Mm6Vcyp-RNbw='
                                        alt='product image'
                                    />
                                    </div>
                                    <div class='product-info'>
                                        <div>
                                            <p><b>Product name:</b></p>
                                            <p>$name</p>
                                        </div>
                                        <div>
                                            <p><b>Product price:</b></p>
                                            <p>$price USD</p>
                                        </div>
                                        <div>
                                            <p><b>Product description:</b></p>
                                            <p>$description</p>
                                        </div>
                                        <div class='action'>
                                            <a href='/mini-project/editProduct.php?id=$id'><button class='btn primary'>Edit</button></a>
                                            <a href='/mini-project/productList.php'><button class='btn secondary'>Cancel</button></a>
                                        </div>
                                </div>";
                } else {
                    echo "<h2>No product found</h2>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>

</html>
