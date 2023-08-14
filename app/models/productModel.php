<?php
$filepath = realpath(dirname(__FILE__));
include($filepath . '/../../config/database.php');
?>

<?php
class ProductModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll($offset = 0, $limit = 20)
    {
        $queryProducts = "SELECT * FROM products LIMIT $limit OFFSET $offset";
        $products = $this->db->select($queryProducts);

        $queryCount = "SELECT COUNT(*) FROM products";
        $count = $this->db->select($queryCount);

        return ['products' => $products, 'count' => $count];
    }

    public function getOne($id) {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "SELECT * FROM products WHERE id = $id LIMIT 1";
        $result = $this->db->select($query);

        return $result;
    }

    public function insert($name, $price, $description) {
        $name = mysqli_real_escape_string($this->db->link, $name);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $description = mysqli_real_escape_string($this->db->link, $description);
        $query = "INSERT INTO products(name, price, description) VALUES ('$name', '$price', '$description')"; 
        $result = $this->db->insert($query);
        
        return $result;
    }

    public function update($name, $price, $description, $id) {
        $name = mysqli_real_escape_string($this->db->link, $name);
        $price = mysqli_real_escape_string($this->db->link, $price);
        $description = mysqli_real_escape_string($this->db->link, $description);
        $query = "UPDATE products SET `name` = '" .$name. "', `price` = '" .$price. "', `description` = '" .$description. "' 
                WHERE `products`.`id` = '" .$id. "' "; 
        $result = $this->db->update($query);
        
        return $result;
    }

    public function delete($id) {
        $query = "DELETE FROM `products` WHERE `id` =  '" .$id. "' "; 
        $result = $this->db->delete($query);
        
        return $result;
    }
}
?>