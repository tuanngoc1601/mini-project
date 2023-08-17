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

    public function login_user($username, $password)
    {
        //mysqli gọi 2 biến. (username and password) biến link -> gọi conect db từ file db
        $username = mysqli_real_escape_string($this->db->link, $username);
        $password = mysqli_real_escape_string($this->db->link, $password);
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' LIMIT 1 ";
        return $this->db->select($query);
    }
}
?>
