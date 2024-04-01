<?php 
    include('config/constants.php');

    $id_don_hang = $_GET['id_don_hang'];
    $sql = "UPDATE don_hang SET trang_thai='Đã hủy' WHERE id = $id_don_hang";
    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        $_SESSION['cancel-order'] = "<div class='success text-center'>Đã hủy đơn hàng!</div>";
        header('location:'.SITEURL.'order.php');
    }
    else
    {
        $_SESSION['cancel-order'] = "<div class='error text-center'>Không hủy được đơn hàng! Vui lòng thử lại</div>";
        header('location:'.SITEURL."order-detail.php?id_don_hang=$id_don_hang");
    }
?>