<?php
    session_start();

    define('SITEURL', 'http://localhost/bookstore/');
    define('LOCALHOST', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'website-ban-sach');

    // Ket noi Database
    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error());
    // Chon Database
    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());

    // set the default timezone to use.
    date_default_timezone_set('Asia/Ho_Chi_Minh');
?>