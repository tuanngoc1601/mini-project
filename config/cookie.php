<?php
$filepath = realpath(dirname(__FILE__));
include_once($filepath."/../app/models/userModel.php");

class Cookie {
    public static function checkCookie($username, $id) {
        $model = new userModel();
        if ($model->get_user_by_id_and_username($id, $username)) {
            return true;
        } else {
            return false;
        }
    }
}