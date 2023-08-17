<?php
    $filepath = realpath(dirname(__FILE__));
    include($filepath . '/../models/productModel.php');
    include($filepath . '/../../helper/format.php');
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

    public function getAll($page = 0, $limit = 20)
    {
        $data = $this->model->getAll($page * $limit, $limit);
        if ($data['products'] && $data['count']) {
            $products = $data['products']->fetch_all();
            $count = $data['count']->fetch_assoc()["COUNT(*)"];
            if ($count % $limit == 0) {
                $totalPages = intval($count / $limit);
            } else {
                $totalPages = intval($count / $limit) + 1;
            }
            return ['products' => $products, 'totalPages' => $totalPages];
        } else {
            return ['error' => 'No products found'];
        }
    }

    public function getOne($id)
    {
        $data = $this->model->getOne($id);
        return $data ? ['product' => $data->fetch_assoc()] : ['error' => 'No product found'];
    }

    public function insertOne($name, $price, $description)
    {
        Session::checkLogin();
        $namePattern = '/^[a-zA-Z0-9\s]{1,255}$/';
        if (!preg_match($namePattern, $name)) {
            return ["error" => "Name must contain only alphanumeric characters and spaces. Length is from 1 to 255 characters"];
        }
        if (!is_numeric($price) || floatval($price) < 0) {
            return ["error" => "Price must be a positive number"];
        }
        $data = $this->model->insert($name, floatval($price), $description);
        return $data ? ['success' => "Product successfully added"] : ['error' => "Product added failed"];
    }

    public function update($name, $price, $description, $id)
    {
        Session::checkLogin();
        $namePattern = '/^[a-zA-Z0-9\s]{1,255}$/';
        if (!preg_match($namePattern, $name)) {
            return ["error" => "Name must contain only alphanumeric characters and spaces. Length is from 1 to 255 characters"];
        }
        if (!is_numeric($price) || floatval($price) < 0) {
            return ["error" => "Price must be a positive number"];
        }
        $data = $this->model->update($name, floatval($price), $description, $id);
        return $data ? ['success' => "Product successfully updated"] : ['error' => "Product update failed"];
    }

    public function delete($id)
    {
        $data = $this->model->delete($id);
        return $data ? ['success' => "Product successfully deleted"] : ['error' => "Delete product failed"];
    }
}

?>
