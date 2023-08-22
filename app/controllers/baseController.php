<?php

class BaseController
{
  protected $folder; // Biến có giá trị là thư mục nào đó trong thư mục views, chứa các file view template của phần đang truy cập.

  // Hàm hiển thị kết quả ra cho người dùng.
  function render($file, $data = array())
  {
    $view_file = 'views/' . $this->folder . '/' . $file . '.php';
    require_once(realpath(dirname(__FILE__)) .'/../' . $view_file);
  }
}

