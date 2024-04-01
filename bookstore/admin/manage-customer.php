<?php include('partials/menu.php') ?>

<!-- Main Content Section Starts -->
<div class="container">
    <div class="wrapper">
        <h1>Quản lý khách hàng</h1>
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

        if (isset($_SESSION['change-pwd'])) {
            echo $_SESSION['change-pwd'];
            unset($_SESSION['change-pwd']);
        }
        ?>

        <br><br>
        <table id="manage_customer" class="table">
            <thead>

                <tr>
                    <th>STT</th>
                    <th>Họ tên</th>
                    <th>Tên tài khoản</th>
                    <th>Điện thoại</th>
                    <th>Email</th>
                    <th>Địa chỉ</th>
                    <th>Chỉnh sửa</th>
                </tr>

            </thead>
            <tbody>

                <?php
                $sql = "SELECT * FROM nguoi_dung WHERE vai_tro='Khách Hàng'";
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE) {
                    $count = mysqli_num_rows($res); // So luong hang trong bang

                    $sn = 1;

                    // Kiem tra so luong hang trong bang
                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $id = $rows['id'];
                            $ho_ten = $rows['ho_ten'];
                            $ten_tai_khoan = $rows['ten_tai_khoan'];
                            $dien_thoai = $rows['dien_thoai'];
                            $email = $rows['email'];
                            $dia_chi = $rows['dia_chi'];

                            // Hien thi du lieu
                ?>

                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $ho_ten; ?></td>
                                <td><?php echo $ten_tai_khoan; ?></td>
                                <td><?php echo $dien_thoai; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $dia_chi; ?></td>
                                <td>
                                    <!-- <a href="<?php echo SITEURL; ?>admin/update-customer-password.php?id=<?php echo $id; ?>" class="btn btn-primary">Đổi mật khẩu</a> -->
                                    <a href="<?php echo SITEURL; ?>admin/update-customer.php?id=<?php echo $id; ?>" class="btn btn-secondary">Cập nhật</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-customer.php?id=<?php echo $id; ?>" class="btn btn-danger">Xóa</a>
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

        <div class="clearfix"></div>
    </div>
</div>
<!-- Main Content Section Ends -->

<script>
    new DataTable('#manage_customer');
</script>

<?php include('partials/footer.php') ?>