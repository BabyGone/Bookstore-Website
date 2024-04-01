<?php include('partials-front/menu.php') ?>

<?php
if (isset($_SESSION['checkout'])) {
    echo $_SESSION['checkout'];
    unset($_SESSION['checkout']);
}
if (isset($_SESSION['login'])) {
    echo $_SESSION['login'];
    unset($_SESSION['login']);
}
?>

<!-- Product Search Section Starts Here -->
<div class="container text-center my-5 w-50">
    <form class="mb-3 text-center" action="" method="POST">
        <input type="search" name="name" placeholder="Tìm kiếm sản phẩm..." class="form-control" required>
        <input type="submit" name="submit" value="Tìm kiếm" class="btn btn-primary mt-2">
    </form>
    <?php
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            header('location:'.SITEURL."products.php?name=$name");
        }
    ?>
</div>
<!-- Product Search Section Ends Here -->

<!-- Categories Section Starts Here -->
<section style="background-color: #eee;">
    <div class="text-center container py-5">
        <h2 class="mt-4 mb-5"><strong>Thể loại</strong></h2>
        <div class="row">
            <?php
            $sql = "SELECT * FROM the_loai WHERE trang_thai='Có' AND noi_bat='Có' LIMIT 6";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $ten_the_loai = $row['ten_the_loai'];
            ?>

                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body bg-danger">
                                <a href="<?php echo SITEURL; ?>products.php?<?php echo htmlspecialchars("category[]=") . $id; ?>" class="text-light">
                                    <h5 class="card-title mb-3"><?php echo $ten_the_loai ?></h5>
                                </a>
                            </div>
                        </div>
                    </div>

            <?php
                }
            } else {
                echo "<div class='error'>Chưa có thể loại</div>";
            }
            ?>
        </div>
        <p class="text-center">
            <a href="<?php echo SITEURL; ?>categories.php">Xem tất cả thể loại</a>
        </p>

    </div>
</section>
<!-- Categories Section Ends Here -->

<!-- Product Menu Section Starts Here -->
<section style="background-color: #eee;">
    <div class="text-center container py-5">
        <h2 class="mt-4 mb-5"><strong>Sản phẩm</strong></h2>
        <div class="row">
            <?php
            $sql2 = "SELECT * FROM san_pham WHERE trang_thai='Có' AND noi_bat='Có' LIMIT 6";
            $res2 = mysqli_query($conn, $sql2);
            $count2 = mysqli_num_rows($res2);
            if ($count2 > 0) {
                while ($row = mysqli_fetch_assoc($res2)) {
                    $id = $row['id'];
                    $ten_san_pham = $row['ten_san_pham'];
                    $gia_tien = $row['gia_tien'];
                    $giam_gia = $row['giam_gia'];
                    $gia_giam = $gia_tien * (100 - $giam_gia) / 100;
                    $anh_nen = $row['anh_nen'];
            ?>

                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="card">
                            <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">
                                <img src="<?php echo SITEURL ?>images/product/<?php echo $anh_nen ?>" class="w-50" style="height: 300px;" />
                            </div>
                            <div class="card-body">
                                <a href="<?php echo SITEURL; ?>product-detail.php?product_id=<?php echo $id; ?>" class="text-reset">
                                    <h5 class="card-title mb-3"><?php echo $ten_san_pham ?></h5>
                                </a>
                                <span class="act-price"><?php echo number_format($gia_giam) ?>₫</span>
                                <div class="ml-2">
                                    <small style="text-decoration: line-through"><?php echo number_format($gia_tien) ?>₫</small>
                                    <span class="act-price">-<?php echo $giam_gia ?>%</span>
                                </div>
                                <a href="<?php echo SITEURL; ?>product-detail.php?product_id=<?php echo $id; ?>" class="btn btn-primary mt-3">Xem sản phẩm</a>
                            </div>
                        </div>
                    </div>

            <?php
                }
            } else {
                echo "<div class='error'>Không có sản phẩm</div>";
            }
            ?>
        </div>
        <p class="text-center">
            <a href="<?php echo SITEURL; ?>products.php">Xem tất cả sản phẩm</a>
        </p>
    </div>
</section>
<!-- Product Menu Section Ends Here -->

<style>
    .act-price {
        color: red;
        font-weight: 700;
    }
</style>

<?php include('partials-front/footer.php') ?>