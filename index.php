<?php
include './templates/header.php';
?>

<?php
if (isset($_GET['controller'])) {
  $controller = $_GET['controller'];
  if (isset($_GET['action'])) {
    $action = $_GET['action'];
  } else {
    $action = 'index';
  }
} else {
  $controller = 'product';
  $action = 'list';
}
require_once('routes.php');
?>

<?php
include './templates/footer.php';
?>