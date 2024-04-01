<?php include('partials/menu.php') ?>

<div class="container">
    <div class="wrapper">
        <h1>Thêm nhà xuất bản</h1>
        <br>

        <?php
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>

        <br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <td>Tên nhà xuất bản: </td>
                    <td>
                        <input type="text" name="ten_nxb" required>
                    </td>
                </tr>
                <tr>
                    <td>Địa chỉ: </td>
                    <td>
                        <input type="text" name="dia_chi">
                    </td>
                </tr>
                <tr>
                    <td>Điện thoại: </td>
                    <td>
                        <input type="text" name="dien_thoai">
                    </td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="email" name="email">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Thêm" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if(isset($_POST['submit'])) {
                $ten_nxb = $_POST['ten_nxb'];
                $dia_chi = $_POST['dia_chi'];
                $dien_thoai = $_POST['dien_thoai'];
                $email = $_POST['email'];

                $sql = "INSERT INTO nha_xuat_ban SET
                    ten_nxb = '$ten_nxb',
                    dia_chi = '$dia_chi',
                    dien_thoai = '$dien_thoai',
                    email = '$email'
                ";

                $res = mysqli_query($conn, $sql);

                if($res == true) {
                    $_SESSION['add'] = "<div class='success'>Thêm nhà xuất bản thành công!</div>";
                    header('location:'.SITEURL.'admin/manage-publisher.php');
                } else {
                    $_SESSION['add'] = "<div class='error'>Thêm nhà xuất bản thất bại! Vui lòng thử lại!</div>";
                    header('location:'.SITEURL.'admin/add-publisher.php');
                }
            }

        ?>

    </div>
</div>

<?php include('partials/footer.php') ?>