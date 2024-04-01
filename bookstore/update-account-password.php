<?php include('partials-front/menu.php') ?>

<div class="container">
    <h1 class="mt-5">Đổi mật khẩu</h1>
    <br><br>
    <?php
    if (isset($_SESSION['wrong-pwd'])) {
        echo $_SESSION['wrong-pwd'];
        unset($_SESSION['wrong-pwd']);
    }
    if (isset($_SESSION['change-pwd'])) {
        echo $_SESSION['change-pwd'];
        unset($_SESSION['change-pwd']);
    }
    if (isset($_SESSION['pwd-not-match'])) {
        echo $_SESSION['pwd-not-match'];
        unset($_SESSION['pwd-not-match']);
    }
    ?>
    <form action="" method="POST">
        <table class="table">
            <tr>
                <td>Mật khẩu hiện tại: </td>
                <td>
                    <input type="password" name="mk_hien_tai" required>
                </td>
            </tr>

            <tr>
                <td>Mật khẩu mới: </td>
                <td>
                    <input type="password" name="mk_moi" required>
                </td>
            </tr>

            <tr>
                <td>Nhập lại mật khẩu mới: </td>
                <td>
                    <input type="password" name="mk_xac_nhan" required>
                </td>
            </tr>

            <tr>
                <td colspan="2" class="text-center">
                    <input type="submit" name="submit" value="Đổi mật khẩu" class="btn btn-primary">
                </td>
            </tr>
        </table>
    </form>
</div>

<?php
if (isset($_POST['submit'])) {
    $ten_tai_khoan = $_SESSION['customer-user'];
    $mk_hien_tai = md5($_POST['mk_hien_tai']);
    $mk_moi = md5($_POST['mk_moi']);
    $mk_xac_nhan = md5($_POST['mk_xac_nhan']);

    $sql1 = "SELECT * FROM nguoi_dung WHERE ten_tai_khoan='$ten_tai_khoan' AND mat_khau = '$mk_hien_tai'";
    $res1 = mysqli_query($conn, $sql1);

    if ($res1 == true) {
        $count = mysqli_num_rows($res1);
        if ($count == 1) {
            if ($mk_moi == $mk_xac_nhan) {
                // Cap nhat mat khau moi
                $sql2 = "UPDATE nguoi_dung SET 
                        mat_khau = '$mk_moi' 
                        WHERE ten_tai_khoan='$ten_tai_khoan'
                    ";
                // Thuc thi cau truy van cap nhat
                $res2 = mysqli_query($conn, $sql2);
                // Kiem tra cau truy van chay thanh cong khong
                if ($res2 == true) {
                    $_SESSION['change-pwd'] = "<div class='success'>Đổi mật khẩu thành công!</div>";
                    header('location:' . SITEURL . "manage-account.php");
                } else {
                    $_SESSION['change-pwd'] = "<div class='error'>Đổi mật khẩu thất bại!</div>";
                    header('location:' . SITEURL . "update-account-password.php");
                }
            } else {
                $_SESSION['pwd-not-match'] = "<div class='error'>Mật khẩu xác nhận không trùng khớp với mật khẩu mới! Vui lòng thử lại!</div>";
                header('location:' . SITEURL . "update-account-password.php");
            }
        } else {
            $_SESSION['wrong-pwd'] = "<div class='error'>Mật khẩu hiện tại không đúng! Vui lòng thử lại!</div>";
            header('location:' . SITEURL . "update-account-password.php");
        }
    }
}

?>

<?php include('partials-front/footer.php') ?>