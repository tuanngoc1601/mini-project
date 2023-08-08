<?php 
    $filepath = realpath(dirname(__FILE__));
    include($filepath . '/../config/session.php');
    Session::checkSession();
?>

<?php
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
    header("Cache-Control: max-age=2592000");
?>