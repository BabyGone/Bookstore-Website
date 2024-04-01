<?php include('config/constants.php') ?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nhà sách Tiền Phong</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Jquery UI -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css" integrity="sha512-ELV+xyi8IhEApPS/pSj66+Jiw+sOT1Mqkzlh8ExXihe4zfqbWkxPRi8wptXIO9g73FSlhmquFlUOuMSoXz5IRw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js" integrity="sha512-57oZ/vW8ANMjR/KQ6Be9v/+/h6bq9/l3f0Oc7vn6qMqyhvPd1cvKBRWWpzu0QoneImqr2SkmO4MSqU+RpHom3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section>
        <nav class="navbar navbar-expand-sm bg-light">
            <div class="container">
                <a class="navbar-brand" href="<?php echo SITEURL; ?>">
                    <img src="images/logo.webp" alt="Logo Nhà sách Tiền Phong" style="width:200px;">
                </a>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITEURL; ?>">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITEURL; ?>categories.php">Thể loại</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo SITEURL; ?>products.php">Sản phẩm</a>
                    </li class="nav-item">
                    <li class="nav-item">
                        <?php
                        if (!isset($_SESSION['customer-user'])) {
                        ?>
                            <a class="nav-link" href="<?php echo SITEURL; ?>login.php">Đăng nhập</a>
                        <?php
                        } else {
                        ?>
                            <a class="nav-link" href="<?php echo SITEURL; ?>manage-account.php">Tài khoản</a>
                        <?php
                        }
                        ?>
                    </li>
                    <li class="nav-item">
                        <?php
                        if (!isset($_SESSION['customer-user'])) {
                        ?>
                            <a class="nav-link" href="<?php echo SITEURL; ?>login.php">Đơn hàng</a>
                        <?php
                        } else {
                        ?>
                            <a class="nav-link" href="<?php echo SITEURL; ?>order.php">Đơn hàng</i></a>
                        <?php
                        }
                        ?>
                    </li class="nav-item">
                    <li class="nav-item">
                        <?php
                        if (!isset($_SESSION['customer-user'])) {
                        ?>
                            <a class="nav-link" href="<?php echo SITEURL; ?>login.php"><i class="fa-solid fa-cart-shopping"></i></a>
                        <?php
                        } else {
                            $ten_tai_khoan = $_SESSION['customer-user'];
                            $sql2 = "SELECT * FROM nguoi_dung WHERE ten_tai_khoan='$ten_tai_khoan'";
                            $res2 = mysqli_query($conn, $sql2);
                            $row2 = mysqli_fetch_assoc($res2);
                            $id_khach_hang = $row2['id'];

                            $sql = "SELECT san_pham.anh_nen AS hinh_anh, san_pham.ten_san_pham, don_hang_chi_tiet.gia_tien, don_hang_chi_tiet.so_luong, don_hang_chi_tiet.thanh_tien 
                            FROM don_hang_chi_tiet 
                            INNER JOIN san_pham ON san_pham.id = don_hang_chi_tiet.id_san_pham 
                            WHERE id_khach_hang=$id_khach_hang AND id_don_hang IS NULL";
                            $res = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($res);
                        ?>
                            <a class="nav-link" href="<?php echo SITEURL; ?>cart.php">
                                <i class="fa-solid fa-cart-shopping"></i>(<?php echo $count ?>)
                            </a>
                        <?php
                        }
                        ?>
                    </li class="nav-item">
                </ul>
            </div>
        </nav>
    </section>
    <!-- Navbar Section Ends Here -->