<?php 
    include('../config/constants.php');

    $id = $_GET['id'];
    $sql = "DELETE FROM nguoi_dung WHERE id = $id";
    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        $_SESSION['delete'] = "<div class='success'>Xóa quản trị viên thành công!</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'>Xóa quản trị viên thất bại!</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
?>