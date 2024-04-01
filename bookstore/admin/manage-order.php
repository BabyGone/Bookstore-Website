<?php include('partials/menu.php') ?>

<!-- Main Content Section Starts -->
<div class="container">
    <div class="wrapper">
        <h1>Quản lý đơn hàng</h1>
        <br>

        <?php
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
        <table id="manage_order" class="table">
            <thead>

                <tr>
                    <th>STT</th>
                    <th>Mã đơn hàng</th>
                    <th>Mã khách hàng</th>
                    <th>Ngày đặt hàng</th>
                    <th>Thành tiền</th>
                    <th>Trạng thái</th>
                    <th>Chỉnh sửa</th>
                </tr>

            </thead>
            <tbody>

                <?php
                $stt = 1;
                $sql2 = "SELECT * FROM don_hang";
                $res2 = mysqli_query($conn, $sql2);

                if ($res2 == TRUE) {
                    $count2 = mysqli_num_rows($res2); // So luong hang trong bang


                    // Kiem tra so luong hang trong bang
                    if ($count2 > 0) {
                        while ($row2 = mysqli_fetch_assoc($res2)) {
                            $id_don_hang = $row2['id'];
                            $ma_khach_hang = $row2['id_khach_hang'];
                            $ghi_chu = $row2['ghi_chu'];
                            $ngay_dat_hang = $row2['ngay_dat_hang'];
                            $thanh_tien = $row2['thanh_tien'];
                            $trang_thai = $row2['trang_thai'];
                            // Hien thi du lieu
                ?>

                            <tr>
                                <td><?php echo $stt++; ?></td>
                                <td>#<?php echo $id_don_hang; ?></td>
                                <td>#<?php echo $ma_khach_hang; ?></td>
                                <td><?php echo $ngay_dat_hang; ?></td>
                                <td><?php echo number_format($thanh_tien); ?>₫</td>
                                <td><?php echo $trang_thai; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/order-detail.php?id_don_hang=<?= $id_don_hang ?>" class="btn btn-primary">Đơn hàng chi tiết</a>
                                </td>
                            </tr>

                <?php
                        }
                    } else {
                        // Khong co du lieu
                    }
                }

                ?>

            </tbody>
        </table>

    </div>
</div>
<!-- Main Content Section Ends -->

<script>
    new DataTable('#manage_order');
</script>

<?php include('partials/footer.php') ?>