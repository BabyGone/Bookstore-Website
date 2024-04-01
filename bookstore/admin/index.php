<?php include('partials/menu.php') ?>

<!-- Main Content Section Starts -->
<div class="container-fluid text-center bg-secondary">

    <h1 class="text-white pt-3">Tổng quan</h1>

    <?php
    if (isset($_SESSION['login'])) {
        echo $_SESSION['login'];
        unset($_SESSION['login']);
    }
    ?>

    <div class="text-center container py-5">
        <div class="row">
            <div class="col-lg-4 col-md-12 mb-4">
                <a class="text-reset" href="manage-category.php">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">

                                <?php
                                $sql = "SELECT * FROM the_loai";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);
                                ?>

                                <h1><?php echo $count; ?></h1>
                                <br>
                                Thể loại
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-12 mb-4">
                <a class="text-reset" href="manage-product.php">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">

                                <?php
                                $sql2 = "SELECT * FROM san_pham";
                                $res2 = mysqli_query($conn, $sql2);
                                $count2 = mysqli_num_rows($res2);
                                ?>

                                <h1><?php echo $count2; ?></h1>
                                <br>
                                Sản phẩm
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-12 mb-4">
                <a class="text-reset" href="manage-order.php">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">

                                <?php
                                $sql3 = "SELECT * FROM don_hang";
                                $res3 = mysqli_query($conn, $sql3);
                                $count3 = mysqli_num_rows($res3);
                                ?>

                                <h1><?php echo $count3; ?></h1>
                                <br>
                                Đơn hàng
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-12 mb-4">
                <a class="text-reset" href="manage-order.php">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center">

                                <?php
                                $sql4 = "SELECT SUM(thanh_tien) AS doanh_thu FROM don_hang WHERE trang_thai='Đã thanh toán'";
                                $res4 = mysqli_query($conn, $sql4);
                                $row4 = mysqli_fetch_assoc($res4);
                                $doanh_thu = number_format($row4['doanh_thu']);
                                ?>

                                <h1><?php echo $doanh_thu; ?>₫</h1>
                                <br>
                                Doanh thu
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-12 mb-4">
                <a class="text-reset" href="manage-publisher.php">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            $sql5 = "SELECT * FROM nha_xuat_ban";
                            $res5 = mysqli_query($conn, $sql5);
                            $count5 = mysqli_num_rows($res5);
                            ?>

                            <h1><?php echo $count5; ?></h1>
                            <br>
                            Nhà xuất bản
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-12 mb-4">
                <a class="text-reset" href="manage-customer.php">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            $sql6 = "SELECT * FROM nguoi_dung WHERE vai_tro='Khách Hàng'";
                            $res6 = mysqli_query($conn, $sql6);
                            $count6 = mysqli_num_rows($res6);
                            ?>

                            <h1><?php echo $count6; ?></h1>
                            <br>
                            Khách hàng
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-md-12 mb-4">
                <a class="text-reset" href="manage-admin.php">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            $sql7 = "SELECT * FROM nguoi_dung WHERE vai_tro='Quản Trị Viên'";
                            $res7 = mysqli_query($conn, $sql7);
                            $count7 = mysqli_num_rows($res7);
                            ?>

                            <h1><?php echo $count7; ?></h1>
                            <br>
                            Quản trị viên
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>


</div>
<!-- Main Content Section Ends -->

<style>
    a {
        text-decoration: none;
    }
</style>

<?php include('partials/footer.php') ?>