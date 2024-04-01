<?php 
include('partials-front/menu.php');
include('partials-front/login-check.php');  
?>

<!-- Main Content Section Starts -->
<div class="container">
    <h1 class="mt-5">Quản lý đơn hàng</h1>
    <br>

    <?php
    if (isset($_SESSION['delete'])) {
        echo $_SESSION['delete'];
        unset($_SESSION['delete']);
    }

    if (isset($_SESSION['update'])) {
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }

    if (isset($_SESSION['cancel-order'])) {
        echo $_SESSION['cancel-order'];
        unset($_SESSION['cancel-order']);
    }
    ?>

    <br>
    <table class="table">
        <tr>
            <th>STT</th>
            <th>Mã đơn hàng</th>
            <th>Ngày đặt hàng</th>
            <th>Thành tiền</th>
            <th>Trạng thái</th>
            <th>Chỉnh sửa</th>
        </tr>

        <?php
        $ten_tai_khoan = $_SESSION['customer-user'];
        $sql = "SELECT * FROM nguoi_dung WHERE ten_tai_khoan='$ten_tai_khoan'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $id_khach_hang = $row['id'];

        $stt = 1;
        $sql2 = "SELECT * FROM don_hang WHERE id_khach_hang=$id_khach_hang";
        $res2 = mysqli_query($conn, $sql2);

        if ($res2 == TRUE) {
            $count2 = mysqli_num_rows($res2); // So luong hang trong bang


            // Kiem tra so luong hang trong bang
            if ($count2 > 0) {
                while ($row2 = mysqli_fetch_assoc($res2)) {
                    $id_don_hang = $row2['id'];
                    $ghi_chu = $row2['ghi_chu'];
                    $ngay_dat_hang = $row2['ngay_dat_hang'];
                    $thanh_tien = $row2['thanh_tien'];
                    $trang_thai = $row2['trang_thai'];
                    // Hien thi du lieu
        ?>

                    <tr>
                        <td><?php echo $stt++; ?></td>
                        <td>#<?php echo $id_don_hang; ?></td>
                        <td><?php echo $ngay_dat_hang; ?></td>
                        <td><?php echo number_format($thanh_tien); ?>₫</td>
                        <td><?php echo $trang_thai; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>order-detail.php?id_don_hang=<?= $id_don_hang?>" class="btn btn-primary">Đơn hàng chi tiết</a>
                        </td>
                    </tr>

        <?php
                }
            } else {
                // Khong co du lieu
            }
        }

        ?>

    </table>

</div>
<!-- Main Content Section Ends -->

<?php include('partials-front/footer.php') ?>