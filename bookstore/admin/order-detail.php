<?php
include('partials/menu.php');
include('partials/login-check.php');
?>

<!-- Main Content Section Starts -->
<div class="container">
    <h1 class="mt-5">Đơn hàng chi tiết #<?= $_GET['id_don_hang'] ?></h1>
    <br>

    <?php
    if (isset($_SESSION['checkout'])) {
        echo $_SESSION['checkout'];
        unset($_SESSION['checkout']);
    }
    if (isset($_SESSION['cancel-order'])) {
        echo $_SESSION['cancel-order'];
        unset($_SESSION['cancel-order']);
    }
    if (isset($_SESSION['update-order'])) {
        echo $_SESSION['update-order'];
        unset($_SESSION['update-order']);
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
                echo "<script>location.href = '" . SITEURL . "admin';</script>";
            }

            $stt = 1;

            $sql = "SELECT don_hang_chi_tiet.id AS id_dhct, san_pham.anh_nen AS hinh_anh, san_pham.ten_san_pham, san_pham.gia_tien as gia_goc, san_pham.giam_gia as chiet_khau, don_hang_chi_tiet.gia_tien, don_hang_chi_tiet.so_luong, don_hang_chi_tiet.thanh_tien 
        FROM don_hang_chi_tiet 
        INNER JOIN san_pham ON san_pham.id = don_hang_chi_tiet.id_san_pham 
        WHERE id_don_hang=$id_don_hang";
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
                <td colspan="6"></td>
                <td class="text-right"><b>Tổng:</b></td>
                <td><?php echo number_format($tong_tien); ?>₫</td>
            </tr>
        </table>

        <h1 class="mt-5">Thông tin khách hàng</h1>
        <?php
        $sql2 = "SELECT * FROM don_hang 
            WHERE id=$id_don_hang";
        $res2 = mysqli_query($conn, $sql2);
        while ($row2 = mysqli_fetch_assoc($res2)) {
            $id_don_hang = $row2['id'];
            $ho_ten = $row2['ho_ten'];
            $dien_thoai = $row2['dien_thoai'];
            $email = $row2['email'];
            $dia_chi = $row2['dia_chi'];
            $ghi_chu = $row2['ghi_chu'];
            $ngay_dat_hang = $row2['ngay_dat_hang'];
            $thanh_tien = $row2['thanh_tien'];
            $trang_thai = $row2['trang_thai'];
        ?>
            <table class="table w-50 mb-5">
                <tr>
                    <td><b>Họ tên: </b></td>
                    <td><?php echo $ho_ten; ?></td>
                </tr>
                <tr>
                    <td><b>Điện thoại: </b></td>
                    <td><?php echo $dien_thoai; ?></td>
                </tr>
                <tr>
                    <td><b>Email: </b></td>
                    <td><?php echo $email; ?></td>
                </tr>
                <tr>
                    <td><b>Địa chỉ: </b></td>
                    <td><?php echo $dia_chi; ?></td>
                </tr>
                <tr>
                    <td><b>Ghi chú: </b></td>
                    <td><?php echo $ghi_chu; ?></td>
                </tr>
                <tr>
                    <td><b>Ngày đặt hàng: </b></td>
                    <td><?php echo $ngay_dat_hang; ?></td>
                </tr>
                <tr>
                    <td><b>Trạng thái: </b></td>
                    <td>
                        <!-- <select name="trang_thai">
                            <option <?php if ($trang_thai == "Đang chờ duyệt") {
                                        echo "selected";
                                    } ?> value='Đang chờ duyệt'>Đang chờ duyệt
                            </option>;
                            <option <?php if ($trang_thai == "Đang giao hàng") {
                                        echo "selected";
                                    } ?> value='Đang giao hàng'>Đang giao hàng
                            </option>;
                            <option <?php if ($trang_thai == "Đã giao hàng") {
                                        echo "selected";
                                    } ?> value='Đã giao hàng'>Đã giao hàng
                            </option>;
                            <option <?php if ($trang_thai == "Đã hủy") {
                                        echo "selected";
                                    } ?> value='Đã hủy'>Đã hủy
                            </option>;
                        </select> -->
                        <?php echo $trang_thai; ?>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <a href="<?php echo SITEURL; ?>admin/update-order.php?id_don_hang=<?= $id_don_hang ?>" class="btn btn-primary" <?php if ($trang_thai == "Đã hủy" or $trang_thai == "Đã thanh toán") echo 'hidden' ?>>
                            <?php
                                if($trang_thai=="Đang chờ duyệt"){ 
                                    echo 'Xác nhận đơn hàng';
                                } else if($trang_thai=="Đang giao hàng"){
                                    echo 'Xác nhận thanh toán';
                                }
                            ?>
                        </a>
                        <a href="<?php echo SITEURL; ?>admin/cancel-order.php?id_don_hang=<?= $id_don_hang ?>" class="btn btn-danger" <?php if ($trang_thai == "Đã hủy" or $trang_thai == "Đã thanh toán") echo 'hidden' ?>>Hủy đơn hàng</a>
                    </td>
                </tr>
            </table>
        <?php
        }
        ?>
    </form>
</div>
<!-- Main Content Section Ends -->

<?php include('partials/footer.php') ?>