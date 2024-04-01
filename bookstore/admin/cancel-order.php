<?php 
    include('../config/constants.php');

    $id_don_hang = $_GET['id_don_hang'];
    $sql2 = "SELECT * FROM don_hang WHERE id = $id_don_hang";
    $res2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($res2);
    
    if($row2['trang_thai']=='Đang chờ duyệt'){
        $sql = "UPDATE don_hang SET trang_thai='Đã hủy' WHERE id = $id_don_hang";
        $res = mysqli_query($conn, $sql);
    
        if($res==true)
        {
            $_SESSION['cancel-order'] = "<div class='success text-center'>Đã hủy đơn hàng!</div>";
            header('location:'.SITEURL."admin/order-detail.php?id_don_hang=$id_don_hang");
        }
        else
        {
            $_SESSION['cancel-order'] = "<div class='error text-center'>Không hủy được đơn hàng! Vui lòng thử lại</div>";
            header('location:'.SITEURL."admin/order-detail.php?id_don_hang=$id_don_hang");
        }
    } else {
        $sql = "UPDATE don_hang SET trang_thai='Đã hủy' WHERE id = $id_don_hang";
        $res = mysqli_query($conn, $sql);
        
        $sql2 = "UPDATE don_hang_chi_tiet
                INNER JOIN san_pham ON san_pham.id = don_hang_chi_tiet.id_san_pham 
                SET san_pham.so_luong = (san_pham.so_luong + don_hang_chi_tiet.so_luong)
                WHERE id_don_hang = $id_don_hang";
        $res2 = mysqli_query($conn, $sql2);

        if($res==true AND $res2==true)
        {
            $_SESSION['cancel-order'] = "<div class='success text-center'>Đã hủy đơn hàng!</div>";
            header('location:'.SITEURL."admin/order-detail.php?id_don_hang=$id_don_hang");
        }
        else
        {
            $_SESSION['cancel-order'] = "<div class='error text-center'>Không hủy được đơn hàng! Vui lòng thử lại</div>";
            header('location:'.SITEURL."admin/order-detail.php?id_don_hang=$id_don_hang");
        }
    }

?>