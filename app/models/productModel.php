<?php
$filepath = realpath(dirname(__FILE__));
include($filepath . '/../../config/database.php');
?>

<?php
class userModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getAll()
    {
        $query = "SELECT * FROM products";
        $result = $this->db->select($query);

        return $result;
    }

    public function getOne($id) {
        $id = mysqli_real_escape_string($this->db->link, $id);
        $query = "SELECT * FROM products WHERE id = $id LIMIT 1";
        $result = $this->db->select($query);

        return $result;
    }
}
?>