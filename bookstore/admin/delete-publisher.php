<?php 
    include('../config/constants.php');

    $id = $_GET['id'];
    $sql = "DELETE FROM nha_xuat_ban WHERE id = $id";
    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        $_SESSION['delete'] = "<div class='success'>Xóa nhà xuất bản thành công!</div>";
        header('location:'.SITEURL.'admin/manage-publisher.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'>Xóa nhà xuất bản thất bại!</div>";
        header('location:'.SITEURL.'admin/manage-publisher.php');
    }
?>