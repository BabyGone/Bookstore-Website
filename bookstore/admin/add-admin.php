<?php include('partials/menu.php') ?>

<div class="container">
    <h1 class="pt-3">Thêm quản trị viên</h1>
    <br>

    <?php
    if (isset($_SESSION['add'])) {
        echo $_SESSION['add'];
        unset($_SESSION['add']);
    }
    if (isset($_SESSION['pwd-not-match'])) {
        echo $_SESSION['pwd-not-match'];
        unset($_SESSION['pwd-not-match']);
    }
    if (isset($_SESSION['user-exist'])) {
        echo $_SESSION['user-exist'];
        unset($_SESSION['user-exist']);
    }
    ?>

    <form action="" method="POST">
        <table class="table">
            <tr>
                <td>Họ tên: </td>
                <td>
                    <input type="text" name="ho_ten" required>
                </td>
            </tr>
            <tr>
                <td>Tên tài khoản: </td>
                <td>
                    <input type="text" name="ten_tai_khoan" required>
                </td>
            </tr>
            <tr>
                <td>Mật khẩu: </td>
                <td>
                    <input type="password" name="mat_khau" required>
                </td>
            </tr>
            <tr>
                <td>Nhập lại mật khẩu: </td>
                <td>
                    <input type="password" name="mat_khau_xac_nhan" required>
                </td>
            </tr>
            <tr>
                <td>Điện thoại: </td>
                <td>
                    <input type="text" name="dien_thoai" required>
                </td>
            </tr>
            <tr>
                <td>Email: </td>
                <td>
                    <input type="email" name="email" required>
                </td>
            </tr>
            <tr>
                <td>Địa chỉ: </td>
                <td>
                    <input type="text" name="dia_chi" required>
                </td>
            </tr>
            <tr class="text-center">
                <td colspan="2">
                    <input type="submit" name="submit" value="Thêm" class="btn btn-primary">
                </td>
            </tr>
        </table>
    </form>

</div>

<?php include('partials/footer.php') ?>

<?php
// Xu ly thong tin trong Form va luu vao Database

// 1. Kiem tra nut submit duoc click chua
if (isset($_POST['submit'])) {
    // Lay du lieu tu form
    $ho_ten = mysqli_real_escape_string($conn, $_POST['ho_ten']);
    $ten_tai_khoan = mysqli_real_escape_string($conn, $_POST['ten_tai_khoan']);
    $mat_khau = mysqli_real_escape_string($conn, md5($_POST['mat_khau']));
    $mat_khau_xac_nhan = mysqli_real_escape_string($conn, md5($_POST['mat_khau_xac_nhan']));
    $dien_thoai = mysqli_real_escape_string($conn, $_POST['dien_thoai']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $dia_chi = mysqli_real_escape_string($conn, $_POST['dia_chi']);

    $sql2 = "SELECT * FROM nguoi_dung WHERE ten_tai_khoan='$ten_tai_khoan' OR email='$email'";
    $res2 = mysqli_query($conn, $sql2);
    $count2 = mysqli_num_rows($res2);
    if ($count2 > 0) {
        $_SESSION['user-exist'] = "<div class='error'>Tên tài khoản và Email đã tồn tại! Vui lòng thử lại!</div>";
        header('location:' . SITEURL . "admin/add-admin.php");
    } else {
        if ($mat_khau == $mat_khau_xac_nhan) {
            // 2. Truy van SQL de luu du lieu vao Database
            $sql = "INSERT INTO nguoi_dung SET
                    ho_ten = '$ho_ten',
                    ten_tai_khoan = '$ten_tai_khoan',
                    mat_khau = '$mat_khau',
                    dien_thoai = '$dien_thoai',
                    email = '$email',
                    dia_chi = '$dia_chi',
                    vai_tro = 'Quản Trị Viên'
                ";

            // 3. Chay truy van va luu vao database
            $res = mysqli_query($conn, $sql);

            // 4. Kiem tra truy van duoc chay co thanh cong khong
            if ($res == TRUE) {
                $_SESSION['add'] = "<div class='success'>Thêm quản trị viên thành công!</div>";
                header("location:" . SITEURL . 'admin/manage-admin.php');
            } else {
                $_SESSION['add'] = "<div class='error'>Thêm quản trị viên thất bại!</div>";
                header("location:" . SITEURL . 'admin/add-admin.php');
            }
        } else {
            $_SESSION['pwd-not-match'] = "<div class='error'>Mật khẩu xác nhận không trùng khớp! Vui lòng thử lại!</div>";
            header('location:' . SITEURL . "admin/add-admin.php");
        }
    }
}
?>