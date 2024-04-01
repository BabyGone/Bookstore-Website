<?php 
    include('../config/constants.php');

    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql = "DELETE FROM the_loai WHERE id=$id";
        $res = mysqli_query($conn, $sql);

        if($res == true) {
            $_SESSION['delete'] = "<div class='success'>Xóa thể loại thành công!</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        } else {
            $_SESSION['delete'] = "<div class='error'>Không thể xóa thể loại! Vui lòng thử lại!</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
    } else {
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>