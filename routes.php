<?php
// danh sách các routes
$controllers = array(
  'product' => ['list', 'edit','delete','add','error'],
  'user' => ['login','register']
);

// Nếu các tham số nhận được từ URL không hợp lệ (không thuộc list controller và action có thể gọi
if (!array_key_exists($controller, $controllers) || !in_array($action, $controllers[$controller])) {
  $controller = 'product';
  $action = 'error';
}

// Nhúng file định nghĩa controller vào để có thể dùng được class định nghĩa trong file đó
include_once('./app/controllers/' . $controller . 'Controller.php');
// Tạo ra tên controller class từ các giá trị lấy được từ URL sau đó gọi ra để hiển thị trả về cho người dùng.
$klass = ucwords($controller) . 'Controller';
$controller = new $klass;
$controller->$action();
