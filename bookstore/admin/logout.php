<?php 
    include('../config/constants.php');
    // Huy session
    // session_destroy(); // Unsets $_SESSION['admin-user']
    unset($_SESSION['admin-user']);
    
    // Tro ve trang dang nhap
    header('location:'.SITEURL.'admin/login.php');

?>