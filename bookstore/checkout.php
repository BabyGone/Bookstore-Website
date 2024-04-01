<?php
include('partials-front/menu.php');
include('partials-front/login-check.php');
?>

<!-- Main Content Section Starts -->
<div class="container">
    <h1 class="mt-5">Danh sách sản phẩm</h1><br>
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
        $stt = 1;

        $ten_tai_khoan = $_SESSION['customer-user'];
        $sql2 = "SELECT * FROM nguoi_dung WHERE ten_tai_khoan='$ten_tai_khoan'";
        $res2 = mysqli_query($conn, $sql2);
        while ($row2 = mysqli_fetch_assoc($res2)) {
            $id_khach_hang = $row2['id'];
            $ho_ten = $row2['ho_ten'];
            $dien_thoai = $row2['dien_thoai'];
            $email = $row2['email'];
            $dia_chi = $row2['dia_chi'];
        }

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
                        <td><?php echo $so_luong; ?></td>
                        <td><?php echo number_format($thanh_tien); ?>₫</td>
                    </tr>
        <?php
                }
            } else {
                $_SESSION['checkout'] = "<div class='error text-center'>Chưa có sản phẩm trong giỏ hàng!</div>";
                // header('location:' . SITEURL.'checkout.php');
                echo "<script>location.href = '".SITEURL."cart.php';</script>";
            }
        }

        ?>
        <tr>
            <td class="text-right" colspan="7"><b>Tổng:</b></td>
            <td><?php echo number_format($tong_tien); ?>₫</td>
        </tr>
    </table>

    <h1 class="mt-5">Thông tin đặt hàng</h1><br>
    <form action="" method="post">
        <div class="row">
            <div class="col">
                <p><b>Họ và tên</b></p>
                <input type="text" class="form-control my-3" name="ho_ten" value="<?= $ho_ten ?>" required>
            </div>
            <div class="col">
                <p><b>Điện thoại</b></p>
                <input type="text" class="form-control my-3" name="dien_thoai" value="<?= $dien_thoai ?>" required>
            </div>
            <div class="col">
                <p><b>Email</b></p>
                <input type="email" class="form-control my-3" name="email" value="<?= $email ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <b>Địa chỉ</b>
                <input type="text" class="form-control my-3" name="dia_chi" value="<?= $dia_chi ?>" required>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <b>Ghi chú</b>
                <textarea class="form-control my-3" name="ghi_chu" rows="3"></textarea>
            </div>
        </div>
        <input type="submit" name="submit" value="Xác nhận đơn hàng" class="btn btn-primary">
        <!-- here hehe -->
    </form>

    <?php
    if (isset($_POST['submit'])) {
        $ho_ten = $_POST['ho_ten'];
        $dien_thoai = $_POST['dien_thoai'];
        $email = $_POST['email'];
        $dia_chi = $_POST['dia_chi'];
        $ghi_chu = $_POST['ghi_chu'];
        $ngay_dat_hang = date("Y-m-d h:i:sa");
        $trang_thai = "Đang chờ duyệt";


        $sql2 = "INSERT INTO don_hang SET
            id_khach_hang = $id_khach_hang, 
            ho_ten = '$ho_ten',
            dien_thoai = '$dien_thoai',
            email = '$email',
            dia_chi = '$dia_chi',
            ghi_chu = '$ghi_chu',            
            ngay_dat_hang = '$ngay_dat_hang',
            thanh_tien = $tong_tien,
            trang_thai = '$trang_thai'
        ";
        $res2 = mysqli_query($conn, $sql2);

        $sql4 = "SELECT id FROM don_hang WHERE id_khach_hang = $id_khach_hang AND ngay_dat_hang = '$ngay_dat_hang'";
        $res4 = mysqli_query($conn, $sql4);
        $row4 = mysqli_fetch_assoc($res4);
        $id_don_hang = $row4['id'];

        $sql3 = "UPDATE don_hang_chi_tiet SET
            id_don_hang = $id_don_hang
            WHERE id_khach_hang=$id_khach_hang AND id_don_hang IS NULL
        ";
        $res3 = mysqli_query($conn, $sql3);

        if ($res2==true AND $res3==true AND $res4==true) {
            $_SESSION['checkout'] = "<div class='success text-center'>Đặt hàng thành công!</div>";
            // header('location:' . SITEURL);
            echo "<script>location.href = '".SITEURL."';</script>";
        } else {
            $_SESSION['checkout'] = "<div class='error text-center'>Đặt hàng thất bại! Vui lòng thử lại!</div>";
            // header('location:' . SITEURL.'checkout.php');
            echo "<script>location.href = '".SITEURL."checkout.php';</script>";

        }
    }
    ?>

</div>
<!-- Main Content Section Ends -->

<?php include('partials-front/footer.php') ?>