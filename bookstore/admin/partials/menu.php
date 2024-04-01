<?php
include('../config/constants.php');
include('login-check.php');
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhà sách Tiền Phong</title>
    <!-- <link rel="stylesheet" href="../css/admin.css"> -->

    <!-- Bootstrap 5 -->
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font-Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    
</head>

<body>
    <!-- Menu Section Starts -->
    <section>
        <nav class="navbar navbar-expand-sm bg-light">
            <div class="container">
                <a class="navbar-brand" href="<?php echo SITEURL; ?>admin">
                    <img src="../images/logo.webp" alt="Logo Nhà sách Tiền Phong" style="width:200px;">
                </a>

                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="index.php">Trang chủ</a></li>
                    <li class="nav-item"><a class="nav-link" href="manage-admin.php">Admin</a></li>
                    <li class="nav-item"><a class="nav-link" href="manage-customer.php">Khách hàng</a></li>
                    <li class="nav-item"><a class="nav-link" href="manage-category.php">Thể loại</a></li>
                    <li class="nav-item"><a class="nav-link" href="manage-product.php">Sản phẩm</a></li>
                    <li class="nav-item"><a class="nav-link" href="manage-publisher.php">Nhà xuất bản</a></li>
                    <li class="nav-item"><a class="nav-link" href="manage-order.php">Đơn hàng</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Đăng xuất</a></li>
                </ul>
            </div>
        </nav>
    </section>
    <!-- Menu Section Ends -->