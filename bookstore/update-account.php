<?php include('partials-front/menu.php') ?>
<div class="container">
    <h1 class="mt-5">Cập nhật thông tin</h1>
    <br><br>
    <?php
    if (isset($_SESSION['update'])) {
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }
    if (isset($_SESSION['user-exist'])) {
        echo $_SESSION['user-exist'];
        unset($_SESSION['user-exist']);
    }
    $ten_tai_khoan = $_SESSION['customer-user'];
    $sql = "SELECT * FROM nguoi_dung WHERE ten_tai_khoan = '$ten_tai_khoan'";
    $res = mysqli_query($conn, $sql);
    if ($res == true) {
        $count = mysqli_num_rows($res); // So luong hang trong bang
        if ($count == 1) {
            $row = mysqli_fetch_assoc($res);
            $ho_ten = $row['ho_ten'];
            $dien_thoai = $row['dien_thoai'];
            $email = $row['email'];
            $dia_chi = $row['dia_chi'];
        } else {
            header("location:" . SITEURL . 'manage-account.php');
        }
    }
    ?>
    <form action="" method="POST">
        <table class="table">
            <tr>
                <td>Họ tên: </td>
                <td>
                    <input type="text" name="ho_ten" value="<?php echo $ho_ten; ?>" required>
                </td>
            </tr>
            <tr>
                <td>Điện thoại: </td>
                <td>
                    <input type="text" name="dien_thoai" value="<?php echo $dien_thoai; ?>" required>
                </td>
            </tr>
            <tr>
                <td>Email: </td>
                <td>
                    <input type="email" name="email" value="<?php echo $email; ?>" required>
                </td>
            </tr>
            <tr>
                <td>Địa chỉ: </td>
                <td>
                    <input type="text" name="dia_chi" value="<?php echo $dia_chi; ?>" required>
                </td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <input type="submit" name="submit" value="Cập nhật" class="btn btn-secondary">
                </td>
            </tr>
        </table>
    </form>
</div>
<?php
if (isset($_POST['submit'])) {
    $ho_ten = mysqli_real_escape_string($conn, $_POST['ho_ten']);
    $dien_thoai = mysqli_real_escape_string($conn, $_POST['dien_thoai']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $dia_chi = mysqli_real_escape_string($conn, $_POST['dia_chi']);
    $sql2 = "SELECT * FROM nguoi_dung WHERE email='$email'";
    $res2 = mysqli_query($conn, $sql2);
    $count2 = mysqli_num_rows($res2);
    if ($count2 > 1) {
        $_SESSION['user-exist'] = "<div class='error'>Email đã tồn tại! Vui lòng thử lại!</div>";
        header("location:" . SITEURL . "update-account.php");
    } else {
        $sql3 = "UPDATE nguoi_dung SET
                ho_ten = '$ho_ten',
                dien_thoai = '$dien_thoai',
                email = '$email',
                dia_chi = '$dia_chi'
                WHERE ten_tai_khoan = '$ten_tai_khoan'
            ";
        $res3 = mysqli_query($conn, $sql3);
        if ($res3 == true) {
            $_SESSION['update'] = "<div class='success'>Cập nhật tài khoản thành công!</div>";
            // header("location:" . SITEURL . 'manage-account.php');
            echo "<script>location.href = '" . SITEURL . "manage-account.php';</script>";
        } else {
            $_SESSION['update'] = "<div class='error'>Cập nhật tài khoản thất bại! Vui lòng thử lại</div>";
            header("location:" . SITEURL . "update-account.php");
        }
    }
}
?>
<?php include('partials-front/footer.php') ?>