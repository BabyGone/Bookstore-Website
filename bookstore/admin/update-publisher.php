<?php include('partials/menu.php') ?>

<div class="container">
    <div class="wrapper">
        <h1>Cập nhật nhà xuất bản</h1>
        <br>

        <?php       
            if(isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
        ?>

        <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
                
                $sql = "SELECT * FROM nha_xuat_ban WHERE id=$id";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Get all the data
                    $row = mysqli_fetch_assoc($res);
                    $ten_nxb = $row['ten_nxb'];
                    $dia_chi = $row['dia_chi'];
                    $dien_thoai = $row['dien_thoai'];
                    $email = $row['email'];
                }
            }
            else
            {
                header('location:'.SITEURL.'admin/manage-publisher.php');
            }
        ?>
        <br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <td>Tên nhà xuất bản: </td>
                    <td>
                        <input type="text" name="ten_nxb" value="<?php echo $ten_nxb ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>Địa chỉ: </td>
                    <td>
                        <input type="text" name="dia_chi" value="<?php echo $dia_chi ?>">
                    </td>
                </tr>
                <tr>
                    <td>Điện thoại: </td>
                    <td>
                        <input type="text" name="dien_thoai" value="<?php echo $dien_thoai ?>">
                    </td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td>
                        <input type="email" name="email" value="<?php echo $email ?>">
                    </td>
                </tr>                
                <tr>
                    <td></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id ?>">
                        <input type="submit" name="submit" value="Cập nhật" class="btn btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php  
            if(isset($_POST['submit'])) {
                $id = $_POST['id'];
                $ten_nxb = $_POST['ten_nxb'];
                $dia_chi = $_POST['dia_chi'];
                $dien_thoai = $_POST['dien_thoai'];
                $email = $_POST['email'];
    
                $sql2 = "UPDATE nha_xuat_ban SET 
                    ten_nxb = '$ten_nxb',
                    dia_chi = '$dia_chi',
                    dien_thoai = '$dien_thoai',                     
                    email = '$email'                     
                    WHERE id = $id
                ";
    
                $res2 = mysqli_query($conn, $sql2);
    
                if($res2==true) {
                    $_SESSION['update'] = "<div class='success'>Cập nhật nhà xuất bản thành công!</div>";
                    header('location:'.SITEURL.'admin/manage-publisher.php');
                }
                else {                  
                    $_SESSION['update'] = "<div class='error'>Cập nhật nhà xuất bản thất bại! Vui lòng thử lại!</div>";
                    header('location:'.SITEURL.'admin/update-publisher.php?id='.$id);
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php') ?>
