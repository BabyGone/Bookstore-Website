<?php include('partials/menu.php') ?>

<div class="container">
    <div class="wrapper">
        <h1>Cập nhật thể loại</h1>
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
                
                $sql = "SELECT * FROM the_loai WHERE id=$id";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //Get all the data
                    $row = mysqli_fetch_assoc($res);
                    $ten_the_loai = $row['ten_the_loai'];
                    $noi_bat = $row['noi_bat'];
                    $trang_thai = $row['trang_thai'];
                }
                else
                {
                    $_SESSION['no-category-found'] = "<div class='error'>Không tìm thấy thể loại!</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            }
            else
            {
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>
        <br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <td>Tên thể loại: </td>
                    <td>
                        <input type="text" name="ten_the_loai" value="<?php echo $ten_the_loai ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>Nổi bật: </td>
                    <td>
                        <input <?php if($noi_bat=="Có"){echo "checked";} ?> type="radio" name="noi_bat" value="Có"> Có
                        <input <?php if($noi_bat=="Không"){echo "checked";} ?> type="radio" name="noi_bat" value="Không"> Không
                    </td>
                </tr>
                <tr>
                    <td>Trạng thái: </td>
                    <td>
                        <input <?php if($trang_thai=="Có"){echo "checked";} ?> type="radio" name="trang_thai" value="Có"> Có
                        <input <?php if($trang_thai=="Không"){echo "checked";} ?> type="radio" name="trang_thai" value="Không"> Không
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
                $ten_the_loai = $_POST['ten_the_loai'];
                $noi_bat = $_POST['noi_bat'];
                $trang_thai = $_POST['trang_thai'];
    
                $sql2 = "UPDATE the_loai SET 
                    ten_the_loai = '$ten_the_loai',
                    noi_bat = '$noi_bat',
                    trang_thai = '$trang_thai'                     
                    WHERE id = $id
                ";
    
                $res2 = mysqli_query($conn, $sql2);
    
                if($res2==true) {
                    $_SESSION['update'] = "<div class='success'>Cập nhật thể loại thành công!</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                else {                  
                    $_SESSION['update'] = "<div class='error'>Cập nhật thể loại thất bại! Vui lòng thử lại!</div>";
                    header('location:'.SITEURL.'admin/update-category.php?id='.$id);
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php') ?>
