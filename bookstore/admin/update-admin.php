<?php include('partials/menu.php') ?>

<div class="container">
    <div class="wrapper">
        <h1>Cập nhật thông tin quản trị viên</h1>
        <br><br>

        <?php
            if(isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if(isset($_SESSION['user-exist'])) {
                echo $_SESSION['user-exist'];
                unset($_SESSION['user-exist']);
            }
        ?>
        
        <?php 
            $id = $_GET['id'];
            $sql = "SELECT * FROM nguoi_dung WHERE id = $id";
            $res = mysqli_query($conn, $sql);

            if($res == true) {
                $count = mysqli_num_rows($res); // So luong hang trong bang

                if($count == 1) {
                    $row = mysqli_fetch_assoc($res);

                    $ho_ten = $row['ho_ten'];
                    $dien_thoai = $row['dien_thoai'];
                    $email = $row['email'];
                    $dia_chi = $row['dia_chi'];
                } else {
                    header("location:".SITEURL.'admin/manage-admin.php');
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
                    <td></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" required>
                        <input type="submit" name="submit" value="Cập nhật" class="btn btn-secondary">
                    </td>
                </tr>
            </table>

        </form>
    </div>
</div>

<?php 
    if(isset($_POST['submit'])) {
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $ho_ten = mysqli_real_escape_string($conn, $_POST['ho_ten']);
        $dien_thoai = mysqli_real_escape_string($conn, $_POST['dien_thoai']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $dia_chi = mysqli_real_escape_string($conn, $_POST['dia_chi']);

        $sql2 = "SELECT * FROM nguoi_dung WHERE email='$email'";
        $res2 = mysqli_query($conn, $sql2);
        $count2 = mysqli_num_rows($res2);

        if($count2 > 1) {
            $_SESSION['user-exist'] = "<div class='error'>Email đã tồn tại! Vui lòng thử lại!</div>";
            header("location:".SITEURL."admin/update-admin.php?id=$id");
        } else {
            $sql = "UPDATE nguoi_dung SET
                ho_ten = '$ho_ten',
                dien_thoai = '$dien_thoai',
                email = '$email',
                dia_chi = '$dia_chi'
                WHERE id = '$id'
            ";
    
            $res = mysqli_query($conn, $sql);
    
            if($res == true) {
                $_SESSION['update'] = "<div class='success'>Cập nhật quản trị viên thành công!</div>";
                header("location:".SITEURL.'admin/manage-admin.php');
            } else {
                $_SESSION['update'] = "<div class='error'>Cập nhật quản trị viên thất bại!</div>";
                header("location:".SITEURL."admin/update-admin.php?id=$id");
            }
        }
    }
?>

<?php include('partials/footer.php') ?>