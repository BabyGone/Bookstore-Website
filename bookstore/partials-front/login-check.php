<?php 
    if(!isset($_SESSION['customer-user'])) // Kiem tra session cua user
    {
        // Loi chua dang nhap
        $_SESSION['no-login-message'] = "<div class='error text-center'>Vui lòng đăng nhập để mua sản phẩm!</div>";
        header('location:'.SITEURL.'login.php');
    }
?>