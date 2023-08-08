<?php
include './templates/header.php';
?>
<div class="main">
    <!-- nội dung khi khởi chạy project -->
    <?php echo "Hello World"; ?>
    <?php
        if (isset($_GET['action']) && $_GET['action'] == 'logout') {
            Session::destroy();
        }
    ?>
    <li><a href="?action=logout">Đăng xuất</a></li>
</div>


<?php
include './templates/footer.php';
?>