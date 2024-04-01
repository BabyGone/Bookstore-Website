<?php include('partials-front/menu.php') ?>

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

<?php
if (isset($_SESSION['product-added'])) {
    echo $_SESSION['product-added'];
    unset($_SESSION['product-added']);
}
?>

<!-- Product Menu Section Starts Here -->
<?php
if (isset($_GET['product_id'])) {
    $id_san_pham = $_GET['product_id'];
    $sql = "SELECT *, nha_xuat_ban.ten_nxb, the_loai.ten_the_loai 
    FROM san_pham
    INNER JOIN nha_xuat_ban ON nha_xuat_ban.id = san_pham.id_nha_xuat_ban 
    INNER JOIN the_loai ON the_loai.id = san_pham.id_the_loai 
    WHERE san_pham.id=$id_san_pham";

    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if ($count > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
            $ten_san_pham = $row['ten_san_pham'];
            $mo_ta = $row['mo_ta'];
            $gia_tien = $row['gia_tien'];
            $giam_gia = $row['giam_gia'];
            $gia_giam = $gia_tien * (100 - $giam_gia) / 100;
            $anh_nen = $row['anh_nen'];
            $tac_gia = $row['tac_gia'];
            $so_luong = $row['so_luong'];
            $nam_xuat_ban = $row['nam_xuat_ban'];
            $nha_xuat_ban = $row['ten_nxb'];
            $ten_the_loai = $row['ten_the_loai'];
        }
    } else {
        echo "<div class='error'>Không có sản phẩm</div>";
    }
} else {
    echo "<script>location.href = '" . SITEURL . "';</script>";
}
?>
<div class="container mt-5 mb-5">
    <div class="row d-flex justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="row product">
                    <div class="col-md-6">
                        <div class="images p-3">
                            <div class="text-center p-4"> <img id="main-image" src="<?php echo SITEURL ?>images/product/<?php echo $anh_nen ?>" width="250" /> </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-4">
                            <div class="d-flex align-items-center"> <span class="ml-1"><b>Số lượng còn lại: </b><?php echo $so_luong ?></span></div>
                            <div class="d-flex justify-content-between align-items-center">
                                <form action="" method="POST">
                                    <input class="btn btn-danger text-uppercase mt-3 mb-2 px-4" value="<?php if ($so_luong != 0) echo 'Thêm vào giỏ hàng';
                                                                                                        else echo 'Hết hàng' ?>" type="submit" name="submit" <?php
                                                                                                                                                                if ($so_luong == 0) echo 'disabled';
                                                                                                                                                                ?>>
                                    <p class="about"> <b>Số lượng mua: </b><input type="number" name="so_luong_mua" min=1 max=<?=$so_luong?> value=1 class="mt-3 w-25"></p>
                                </form>
                            </div>
                            <div class="mt-2 mb-3">
                                <h5 class="text-uppercase"><?php echo $ten_san_pham ?></h5>
                                <div class="price d-flex flex-row align-items-center">
                                    <span class="act-price"><?php echo number_format($gia_giam) ?>₫</span>
                                    <div class="ml-2">
                                        <small class="dis-price"><?php echo number_format($gia_tien) ?>₫</small>
                                        <span class="act-price">-<?php echo $giam_gia ?>%</span>
                                    </div>
                                </div>
                            </div>
                            <p class="about"><b>Tác giả:</b> <?php echo $tac_gia ?></p>
                            <p class="about"><b>Năm xuất bản:</b> <?php echo $nam_xuat_ban ?></p>
                            <p class="about"><b>Nhà xuất bản:</b> <?php echo $nha_xuat_ban ?></p>
                            <p class="about"><b>Thể loại:</b> <?php echo $ten_the_loai ?></p>                            
                        </div>
                    </div>
                    <div class="container m-2">
                        <p class="about"><b>Mô tả:</b> <?php echo $mo_ta ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Product Menu Section Ends Here -->

<?php
if (isset($_POST['submit']) and isset($_SESSION['customer-user'])) {
    $ten_tai_khoan = $_SESSION['customer-user'];
    $sql5 = "SELECT * FROM nguoi_dung WHERE ten_tai_khoan = '$ten_tai_khoan'";
    $res5 = mysqli_query($conn, $sql5);
    $row5 = mysqli_fetch_assoc($res5);

    $id_khach_hang = $row5['id'];
    $so_luong_mua = $_POST['so_luong_mua'];

    $sql6 = "SELECT * FROM don_hang_chi_tiet WHERE id_khach_hang = $id_khach_hang AND id_san_pham = $id_san_pham and id_don_hang IS NULL";
    $res6 = mysqli_query($conn, $sql6);
    if (mysqli_num_rows($res6) > 0) {
        $_SESSION['product-added'] = "<div class='text-center'>Sản phẩm đã có trong giỏ hàng!</div>";
        echo "<script>location.href = '" . SITEURL . "product-detail.php?product_id=$id_san_pham'</script>";
    } else {
        $sql4 = "INSERT INTO don_hang_chi_tiet SET
        id_khach_hang = $id_khach_hang,
        id_san_pham = $id_san_pham,
        gia_tien = $gia_giam,
        so_luong = $so_luong_mua,
        thanh_tien = ($gia_giam*$so_luong_mua)
        ";
        $res4 = mysqli_query($conn, $sql4);
        if ($res4 == true) {
            $_SESSION['product-added'] = "<div class='text-center'>Đã thêm vào giỏ hàng!</div>";
            echo "<script>location.href = '" . SITEURL . "product-detail.php?product_id=$id_san_pham'</script>";
        }
    }
} else if (isset($_POST['submit']) and !isset($_SESSION['customer-user'])) {
    $_SESSION['login-to-use-cart'] = "<div class='text-center'>Vui lòng đăng nhập để sử dụng chức năng giỏ hàng!</div>";
    echo "<script>location.href = '" . SITEURL . "login.php'</script>";
}
?>

<style>
    body {
        background-color: #bbb;
    }

    .card {
        border: none
    }

    .product {
        background-color: #eee
    }

    .brand {
        font-size: 13px
    }

    .act-price {
        color: red;
        font-weight: 700
    }

    .dis-price {
        text-decoration: line-through
    }

    .about {
        font-size: 14px
    }

    .color {
        margin-bottom: 10px
    }

    label.radio {
        cursor: pointer
    }

    label.radio input {
        position: absolute;
        top: 0;
        left: 0;
        visibility: hidden;
        pointer-events: none
    }

    label.radio span {
        padding: 2px 9px;
        border: 2px solid #ff0000;
        display: inline-block;
        color: #ff0000;
        border-radius: 3px;
        text-transform: uppercase
    }

    label.radio input:checked+span {
        border-color: #ff0000;
        background-color: #ff0000;
        color: #fff
    }

    .btn-danger {
        background-color: #ff0000 !important;
        border-color: #ff0000 !important
    }

    .btn-danger:hover {
        background-color: #da0606 !important;
        border-color: #da0606 !important
    }

    .btn-danger:focus {
        box-shadow: none
    }

    .cart i {
        margin-right: 10px
    }
</style>

<?php include('partials-front/footer.php') ?>