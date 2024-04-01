<?php 
    include('./config/constants.php');
    // Huy session
    // session_destroy(); 
    unset($_SESSION['customer-user']);

    // Tro ve trang dang nhap
    header('location:'.SITEURL);

?>