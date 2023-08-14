<?php
include './templates/header.php';
?>

<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath . '/app/controllers/productController.php');
?>

<?php
$controller = new ProductController();
$currentPage = 1;
if (isset($_GET['page'])) {
    $currentPage = intval($_GET['page']);
}
$data = $controller->getAll($currentPage - 1);
$totalPages = 1;
$products = [];
if (!isset($data['error'])) {
    $totalPages = $data['totalPages'];
    $products = $data['products'];
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Product list page</title>
        <link rel="stylesheet" href="./assets/stylesheets/productStyle.css" />
        <link
            rel="stylesheet"
            href="./assets/stylesheets/productListStyle.css"
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
                        <h1>Product list page</h1>
                    </div>
                    <div class="new">
                        <a href="./newProduct.php">
                            <button class="btn success">
                                <i class="fa-solid fa-circle-plus"></i>
                                <span>New</span>
                            </button>
                        </a>
                    </div>
                    <div class="product-table">
                        <table border="1">
                            <tr>
                                <th style="width: 5%">ID</th>
                                <th style="width: 50%">Name</th>
                                <th style="width: 15%">Price</th>
                                <th style="width: 30%">Action</th>
                            </tr>
                            <?php
                            if (!empty($products)) {
                                foreach ($products as $product) {
                                    $id = $product[0];
                                    $name = $product[1];
                                    $price = $product[2];
                                    echo "<tr>
                                    <td> $id </td>
                                    <td> $name </td>
                                    <td> $price </td>
                                    <td class='action'>
                                        <a href='./productDetail.php?id=$id'><button class='btn info text-small'>View</button></a>
                                        <a href='./editProduct.php?id=$id'><button class='btn primary text-small'>Edit</button></a>
                                        <button class='btn danger text-small'>Delete</button>
                                    </td>
                                    </tr>";
                                }
                            }
                            ?>
                        </table>
                    </div>
                    <div class="pagination">
                        <form id="page-switch" action="" method="get">
                            <button
                                class="btn secondary"
                                type="button"
                                onclick="handleDecreasePage()"
                            >
                                <i class="fa-solid fa-arrow-left"></i>
                            </button>
                            <div class="page-input">
                                <input
                                    type="number"
                                    name="page"
                                    min="1"
                                    max="<?php echo $totalPages ?>"
                                    value="<?php echo $currentPage ?>"
                                /><span>/<?php echo $totalPages ?></span>
                            </div>
                            <button
                                class="btn secondary"
                                type="button"
                                onclick="handleIncreasePage()"
                            >
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script src="./assets/javascript/productListScript.js"></script>
</html>
