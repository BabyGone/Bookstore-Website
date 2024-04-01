<?php 
    include('config/constants.php');
        $ten_tai_khoan = $_SESSION['customer-user'];
        $sql = "SELECT * FROM nguoi_dung WHERE ten_tai_khoan='$ten_tai_khoan'";
        $res = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($res);
        $id_khach_hang = $row['id'];

        $sql = "DELETE FROM don_hang_chi_tiet WHERE id_don_hang is NULL and id_khach_hang=$id_khach_hang";
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            header('location:'.SITEURL.'cart.php');
        }
        else
        {
            header('location:'.SITEURL.'cart.php');
        }

?>