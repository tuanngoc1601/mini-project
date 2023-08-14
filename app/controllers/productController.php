<?php
$filepath = realpath(dirname(__FILE__));
include($filepath.'/../models/productModel.php');
include($filepath.'/../helper/format.php');
?>

<?php
class ProductController
{
    private $model;
    private $fm;

    public function __construct()
    {
        $this->model = new ProductModel();
        $this->fm = new Format();
    }

    public function getAll($page = 0, $limit = 20) {
        $data = $this->model->getAll($page*$limit, $limit);
        if ($data['products'] != false && $data['count'] != false) {
            $products = $data['products']->fetch_all();
            $count = $data['count']->fetch_assoc()["COUNT(*)"];
            $totalPages = 1;
            if ($count % $limit == 0) {
                $totalPages = intval($count/$limit);
            } else {
                $totalPages = intval($count/$limit) + 1;
            }
            return ['products' => $products, 'totalPages' => $totalPages];
        } else {
            return ['error' => 'No products found'];
        }
    }

    public function getOne($id) {
        $data = $this->model->getOne($id);
        if ($data != false) {
            return ['product' => $data->fetch_assoc()];
        } else {
            return ['error' => 'No product found'];
        }
    }

    public function insertOne($name, $price, $description) {
        Session::checkLogin();
        $namePattern = '/^[a-zA-Z0-9\s]{1,255}$/';
        if (!preg_match($namePattern, $name)) {
            return ["error" => "Name must contain only alphanumeric characters and spaces. Length is from 1 to 255 characters"];
        }
        if (!is_numeric($price) || floatval($price) < 0) {
            return ["error" => "Price must be a positive number"];
        }
        $data = $this->model->insert($name, floatval($price), $description);
        if ($data != false) {
            return ['success' => "Product successfully added"];
        } else {
            return ['error' => "Product added failed"];
        }
    }

    public function update($name, $price, $description, $id) {
        Session::checkLogin();
        $namePattern = '/^[a-zA-Z0-9\s]{1,255}$/';
        if (!preg_match($namePattern, $name)) {
            return ["error" => "Name must contain only alphanumeric characters and spaces. Length is from 1 to 255 characters"];
        }
        if (!is_numeric($price) || floatval($price) < 0) {
            return ["error" => "Price must be a positive number"];
        }
        $data = $this->model->update($name, floatval($price), $description, $id);
        if ($data != false) {
            return ['success' => "Product successfully updated"];
        } else {
            return ['error' => "Product update failed"];
        }
    }
}
?>