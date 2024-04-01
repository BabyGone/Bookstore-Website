<?php
include('partials-front/menu.php');
include('partials-front/login-check.php');
?>

<?php
if (isset($_POST['mang_so_luong']) and isset($_POST['mang_id_dhct'])) {
    $mang_so_luong = [];
    $mang_so_luong = $_POST['mang_so_luong'];
    $mang_id_dhct = [];
    $mang_id_dhct = $_POST['mang_id_dhct'];
    $count=0;
    foreach ($mang_so_luong as $so_luong) {
        // echo $so_luong;
        $sql3 = "UPDATE don_hang_chi_tiet SET 
            so_luong=$so_luong,
            thanh_tien=(gia_tien*$so_luong)
            WHERE id=$mang_id_dhct[$count]";
        $res3 = mysqli_query($conn, $sql3);
        $count++;
    }
}
?>

<!-- Main Content Section Starts -->
<div class="container">
    <h1 class="mt-5">Giỏ hàng</h1>
    <br>

    <?php
    if (isset($_SESSION['checkout'])) {
        echo $_SESSION['checkout'];
        unset($_SESSION['checkout']);
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
                <th>Chỉnh sửa</th>
            </tr>

            <?php
            $stt = 1;

            $ten_tai_khoan = $_SESSION['customer-user'];
            $sql2 = "SELECT * FROM nguoi_dung WHERE ten_tai_khoan='$ten_tai_khoan'";
            $res2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($res2);
            $id_khach_hang = $row2['id'];

            $sql = "SELECT don_hang_chi_tiet.id AS id_dhct, san_pham.anh_nen AS hinh_anh, san_pham.ten_san_pham, san_pham.gia_tien as gia_goc, san_pham.giam_gia as chiet_khau, don_hang_chi_tiet.gia_tien, don_hang_chi_tiet.so_luong, don_hang_chi_tiet.thanh_tien 
        FROM don_hang_chi_tiet 
        INNER JOIN san_pham ON san_pham.id = don_hang_chi_tiet.id_san_pham 
        WHERE id_khach_hang=$id_khach_hang and id_don_hang IS NULL";
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
                            <td width=100>
                                <input type="hidden" name="mang_id_dhct[]" class="form-control" value="<?php echo $id_dhct; ?>">
                                <input type="number" name="mang_so_luong[]" class="form-control" value="<?php echo $so_luong; ?>" min=1>
                            </td>
                            <td><?php echo number_format($thanh_tien); ?>₫</td>
                            <td>
                                <a href="<?php echo SITEURL; ?>delete-cart.php?id=<?php echo $id_dhct ?>" class="btn btn-danger">Xóa sản phẩm</a>
                            </td>
                        </tr>
            <?php
                    }
                } else {
                    // Khong co du lieu
                }
            }

            ?>
            <tr>
                <td colspan="8">
                <td>
                    <a href="<?php echo SITEURL; ?>delete-all-cart.php" class="btn btn-danger">Xóa tất cả sản phẩm</a><br><br>
                    <button type="submit" class="btn btn-secondary">Cập nhật giỏ hàng</button>
                </td>
            </tr>
            <tr>
                <td class="text-right" colspan="7"><b>Tổng:</b></td>
                <td><?php echo number_format($tong_tien); ?>₫</td>
                <td>
                    <a href="<?php echo SITEURL; ?>checkout.php" class="btn btn-primary">Tiến hành đặt hàng</a>
                </td>
            </tr>
        </table>
    </form>
</div>
<!-- Main Content Section Ends -->

<?php include('partials-front/footer.php') ?>