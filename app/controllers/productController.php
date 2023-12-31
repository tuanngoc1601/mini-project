<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath.'/../models/productModel.php');
include_once($filepath.'/../../helper/format.php');
include_once($filepath.'/../../helper/validate.php');
include_once($filepath.'/../../app/controllers/baseController.php');
?>

<?php
class ProductController extends BaseController
{
    private $model;
    private $fm;

    public function __construct()
    {
        $this->model = new ProductModel();
        $this->fm = new Format();
        $this->folder = 'product';
    }

    public function list($page = 0, $limit = 20) {
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
            return $this->render('list', ['products' => $products, 'totalPages' => $totalPages]);
        } else {
            return ['error' => 'No products found'];
        }
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


    public function detail()
    {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
        }
        $data = $this->model->getOne($id);
        return $this->render('detail', ['product' => $data->fetch_assoc()]);
    }    

    public function getOne($id) {
        $data = $this->model->getOne($id);
        if ($data != false) {
            return ['product' => $data->fetch_assoc()];
        } else {
            return ['error' => 'No product found'];
        }
    }

    public function add() 
    {
        return $this->render('add');
    }

    public function insertOne($name, $price, $description) {
        Session::checkLogin();
        if (!Validation::validateProductName($name)) {
            return ["error" => "Name must contain only alphanumeric characters and spaces. Length is from 1 to 255 characters"];
        }
        if (!Validation::validateProductPrice($price)) {
            return ["error" => "Price must be a positive number"];
        }
        $data = $this->model->insert($name, floatval($price), $description);
        if ($data != false) {
            return ['success' => "Product successfully added"];
        } else {
            return ['error' => "Product added failed"];
        }
    }

    public function edit() {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
        }
        $data = $this->model->getOne($id);
        return $this->render('edit', ['product' => $data->fetch_assoc()]);
    }

    public function update($name, $price, $description, $id) {
        Session::checkLogin();
        if (!Validation::validateProductName($name)) {
            return ["error" => "Name must contain only alphanumeric characters and spaces. Length is from 1 to 255 characters"];
        }
        if (!Validation::validateProductPrice($price)) {
            return ["error" => "Price must be a positive number"];
        }
        $data = $this->model->update($name, floatval($price), $description, $id);
        if ($data != false) {
            return ['success' => "Product successfully updated"];
        } else {
            return ['error' => "Product update failed"];
        }
    }

    public function delete() {
        $id = intval($_GET['id']);
        $data = $this->model->delete($id);
        if ($data != false) {
            return $this->render('delete', ["success" => "Product successfully deleted"]);
        } else {
            return $this->render('delete',  ['error' => "Delete product failed"]);
        }
    }
}
?>