<?php
include('partials-front/menu.php');
include('partials-front/login-check.php');
?>

<!-- Main Content Section Starts -->
<div class="container">
    <h1 class="mt-5">Đơn hàng chi tiết #<?= $_GET['id_don_hang'] ?></h1>

    <?php
    $id_don_hang = $_GET['id_don_hang'];
    $sql = "SELECT * FROM don_hang WHERE id = $id_don_hang";
    $res = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($res);
    ?>

    <p class="mt-5"><b>Trạng thái: </b><?= $row['trang_thai'] ?></p>

    <?php
    if (isset($_SESSION['checkout'])) {
        echo $_SESSION['checkout'];
        unset($_SESSION['checkout']);
    }
    if (isset($_SESSION['cancel-order'])) {
        echo $_SESSION['cancel-order'];
        unset($_SESSION['cancel-order']);
    }
    ?>

    <br>
    <form action="" method="POST">
        <table class="table">
            <tr>
                <th>STT</th>
                <th>Hình ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá gốc</th>
                <th>Chiết khấu</th>
                <th>Giá tiền</th>
                <th>Số lượng</th>
                <th>Thành tiền</th>
            </tr>

            <?php
            if (isset($_GET['id_don_hang'])) {
                $id_don_hang = $_GET['id_don_hang'];
            } else {
                echo "<script>location.href = '" . SITEURL . "';</script>";
            }

            $stt = 1;
            $ten_tai_khoan = $_SESSION['customer-user'];
            $sql2 = "SELECT * FROM nguoi_dung WHERE ten_tai_khoan='$ten_tai_khoan'";
            $res2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($res2);
            $id_khach_hang = $row2['id'];

            $sql = "SELECT don_hang_chi_tiet.id AS id_dhct, san_pham.anh_nen AS hinh_anh, san_pham.ten_san_pham, san_pham.gia_tien as gia_goc, san_pham.giam_gia as chiet_khau, don_hang_chi_tiet.gia_tien, don_hang_chi_tiet.so_luong, don_hang_chi_tiet.thanh_tien 
        FROM don_hang_chi_tiet 
        INNER JOIN san_pham ON san_pham.id = don_hang_chi_tiet.id_san_pham 
        WHERE id_khach_hang=$id_khach_hang and id_don_hang=$id_don_hang";
            $res = mysqli_query($conn, $sql);

            if ($res == TRUE) {
                $count = mysqli_num_rows($res); // So luong hang trong bang
                $tong_tien = 0;

                // Kiem tra so luong hang trong bang
                if ($count > 0) {
                    while ($rows = mysqli_fetch_assoc($res)) {
                        $id_dhct = $rows['id_dhct'];
                        $hinh_anh = $rows['hinh_anh'];
                        $ten_san_pham = $rows['ten_san_pham'];
                        $gia_goc = $rows['gia_goc'];
                        $chiet_khau = $rows['chiet_khau'];
                        $gia_tien = $rows['gia_tien'];
                        $so_luong = $rows['so_luong'];
                        $thanh_tien = $rows['thanh_tien'];
                        $tong_tien += $rows['thanh_tien'];

                        // Hien thi du lieu
            ?>
                        <tr>
                            <td><?php echo $stt++; ?></td>
                            <td><img src="<?php echo SITEURL ?>images/product/<?php echo $hinh_anh ?>" width="75" /></td>
                            <td><?php echo $ten_san_pham; ?></td>
                            <td><?php echo number_format($gia_goc); ?>₫</td>
                            <td><?php echo $chiet_khau; ?>%</td>
                            <td><?php echo number_format($gia_tien); ?>₫</td>
                            <td><?php echo $so_luong; ?></td>
                            <td><?php echo number_format($thanh_tien); ?>₫</td>
                        </tr>
            <?php
                    }
                } else {
                    // Khong co du lieu
                }
            }

            ?>
            <tr>
                <td class="text-right" colspan="7"><b>Tổng:</b></td>
                <td><?php echo number_format($tong_tien); ?>₫</td>
            </tr>
            <tr>
                <td class="text-right" colspan="8">
                    <a href="<?php echo SITEURL; ?>cancel-order.php?id_don_hang=<?= $id_don_hang ?>" class="btn btn-danger"
                    <?php
                    $sql = "SELECT * FROM don_hang WHERE id = $id_don_hang";
                    $res = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($res);
                    if($row['trang_thai']!='Đang chờ duyệt') echo 'hidden';
                    ?>
                    >Hủy đơn hàng</a>
                </td>
            </tr>
        </table>
    </form>
</div>
<!-- Main Content Section Ends -->

<?php include('partials-front/footer.php') ?>