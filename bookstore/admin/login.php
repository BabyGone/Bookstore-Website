<?php include('../config/constants.php'); ?>

<html>

<head>
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="../css/admin.css">
    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <br>
    <div class="text-center">
        <img src="../images/logo.webp" alt="Logo Nhà sách Tiền Phong" class="img-responsive">
    </div>
    <div class="form-control container">
        <h1 class="text-center">Đăng nhập Admin</h1>
        <br>
        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }
        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }
        ?>
        <br>
        <!-- Login Form Starts Here -->
        <form action="" method="POST" class="text-center">
            Tài khoản: <br>
            <input type="text" name="ten_tai_khoan" required><br><br>

            Mật khẩu: <br>
            <input type="password" name="mat_khau" required><br><br>

            <input type="submit" name="submit" value="Đăng nhập" class="btn btn-primary">
            <br><br>
        </form>
        <!-- Login Form Ends Here -->

        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 Copyright:
            <a class="fw-bold text-danger" href="<?php echo SITEURL; ?>admin">Nhà sách Tiền Phong</a>
        </div>
        <!-- Copyright -->
    </div>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    $ten_tai_khoan = mysqli_real_escape_string($conn, $_POST['ten_tai_khoan']);
    $mat_khau = mysqli_real_escape_string($conn, md5($_POST['mat_khau']));

    $sql = "SELECT * FROM nguoi_dung WHERE ten_tai_khoan='$ten_tai_khoan' AND mat_khau='$mat_khau' AND vai_tro='Quản Trị Viên'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $_SESSION['login'] = "<div class='success'>Đăng nhập thành công!</div>";
        $_SESSION['admin-user'] = $ten_tai_khoan;
        header('location:' . SITEURL . 'admin/');
    } else {
        $_SESSION['login'] = "<div class='error text-center'>Đăng nhập thất bại! Vui lòng thử lại!</div>";
        header('location:' . SITEURL . 'admin/login.php');
    }
}
?>