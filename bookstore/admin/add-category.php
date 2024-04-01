<?php include('partials/menu.php') ?>

<div class="container">
    <div class="wrapper">
        <h1>Thêm thể loại</h1>
        <br>

        <?php 
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <br>
        <!-- Add Category Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <td>Tên thể loại: </td>
                    <td>
                        <input type="text" name="ten_the_loai" required>
                    </td>
                </tr>

                <tr>
                    <td>Nổi bật: </td>
                    <td>
                        <input type="radio" name="noi_bat" value="Có"> Có 
                        <input type="radio" name="noi_bat" value="Không"> Không 
                    </td>
                </tr>

                <tr>
                    <td>Trạng thái: </td>
                    <td>
                        <input type="radio" name="trang_thai" value="Có"> Có 
                        <input type="radio" name="trang_thai" value="Không"> Không 
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
        <!-- Add Category Form Ends -->

        <?php
            if(isset($_POST['submit'])) {
                $ten_the_loai = $_POST['ten_the_loai'];

                if(isset($_POST['noi_bat'])) {
                    $noi_bat = $_POST['noi_bat'];
                } else {
                    $noi_bat = "Không";
                }

                if(isset($_POST['trang_thai'])) {
                    $trang_thai = $_POST['trang_thai'];
                } else {
                    $trang_thai = "Không";
                }
                
                $sql = "INSERT INTO the_loai SET 
                    ten_the_loai='$ten_the_loai',
                    noi_bat='$noi_bat',
                    trang_thai='$trang_thai'
                ";

                $res = mysqli_query($conn, $sql);

                if($res == true) {
                    $_SESSION['add'] = "<div class='success'>Thêm thể loại thành công!</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                } else {
                    $_SESSION['add'] = "<div class='error'>Thêm thể loại thất bại! Vui lòng thử lại!</div>";
                    header('location:'.SITEURL.'admin/add-category.php');
                }
            }
        ?>
    </div>
</div>

<?php include('partials/footer.php') ?>