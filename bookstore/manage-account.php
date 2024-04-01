<?php 
include('partials-front/menu.php');
include('partials-front/login-check.php');  
?>

<!-- Main Content Section Starts -->
<div class="container">
    <h1 class="mt-5">Quản lý tài khoản</h1>
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

    <br>
    <table class="table">
        <tr>
            <th>Họ tên</th>
            <th>Tên tài khoản</th>
            <th>Điện thoại</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Chỉnh sửa</th>
        </tr>

        <?php
        $ten_tai_khoan = $_SESSION['customer-user'];
        $sql = "SELECT * FROM nguoi_dung WHERE ten_tai_khoan='$ten_tai_khoan'";
        $res = mysqli_query($conn, $sql);

        if ($res == TRUE) {
            $count = mysqli_num_rows($res); // So luong hang trong bang


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
                        <td><?php echo $ho_ten; ?></td>
                        <td><?php echo $ten_tai_khoan; ?></td>
                        <td><?php echo $dien_thoai; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $dia_chi; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>update-account-password.php" class="btn btn-primary">Đổi mật khẩu</a>
                            <a href="<?php echo SITEURL; ?>update-account.php" class="btn btn-secondary">Cập nhật thông tin</a>
                            <a href="<?php echo SITEURL; ?>logout.php" class="btn btn-danger">Đăng xuất</a>
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