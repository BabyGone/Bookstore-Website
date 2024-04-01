<?php include('./config/constants.php'); ?>

<html>

<head>
    <title>Đăng ký</title>
    <link rel="stylesheet" href="./css/admin.css">
    <!-- <link rel="stylesheet" href="./css/style.css"> -->
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
        <img src="./images/logo.webp" alt="Logo Nhà sách Tiền Phong" class="img-responsive">
    </div>
    <div class="form-control container">
        <h1 class="text-center">Đăng ký</h1>
        <br>
        <?php
        if (isset($_SESSION['user-exist'])) {
            echo $_SESSION['user-exist'];
            unset($_SESSION['user-exist']);
        }
        if (isset($_SESSION['pwd-not-match'])) {
            echo $_SESSION['pwd-not-match'];
            unset($_SESSION['pwd-not-match']);
        }
        if (isset($_SESSION['register'])) {
            echo $_SESSION['register'];
            unset($_SESSION['register']);
        }
        ?>
        <br>
        <!-- Login Form Starts Here -->
        <form action="" method="POST" class="text-center">
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
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Đăng ký" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Login Form Ends Here -->

        <p class="text-center">Đã có tài khoản? <a style="color:red" href="<?php echo SITEURL; ?>login.php">Đăng nhập tại đây.</a></p>
        <br>
        <!-- Copyright -->
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 Copyright:
            <a class="fw-bold text-danger" href="<?php echo SITEURL; ?>">Nhà sách Tiền Phong</a>
        </div>
        <!-- Copyright -->
    </div>
</body>

</html>

<?php
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
        $_SESSION['user-exist'] = "<div class='error text-center'>Tên tài khoản và Email đã tồn tại! Vui lòng thử lại!</div>";
        header('location:' . SITEURL . "register.php");
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
                    vai_tro = 'Khách Hàng'
                ";

            // 3. Chay truy van va luu vao database
            $res = mysqli_query($conn, $sql);

            // 4. Kiem tra truy van duoc chay co thanh cong khong
            if ($res == TRUE) {
                $_SESSION['register'] = "<div class='success text-center'>Đăng ký thành công!</div>";
                header("location:" . SITEURL . 'login.php');
            } else {
                $_SESSION['register'] = "<div class='error text-center'>Đăng ký thất bại! Vui lòng thử lại</div>";
                header("location:" . SITEURL . 'register.php');
            }
        } else {
            $_SESSION['pwd-not-match'] = "<div class='error text-center'>Mật khẩu xác nhận không trùng khớp! Vui lòng thử lại!</div>";
            header('location:' . SITEURL . "register.php");
        }
    }
}
?>