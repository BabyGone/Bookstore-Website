<?php 
    include('../config/constants.php');

    $id = $_GET['id'];
    $sql = "DELETE FROM nguoi_dung WHERE id = $id";
    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        $_SESSION['delete'] = "<div class='success'>Xóa khách hàng thành công!</div>";
        header('location:'.SITEURL.'admin/manage-customer.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'>Xóa khách hàng thất bại!</div>";
        header('location:'.SITEURL.'admin/manage-customer.php');
    }
?>