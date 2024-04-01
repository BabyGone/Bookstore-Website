<?php 
    include('../config/constants.php');

    $id_don_hang = $_GET['id_don_hang'];
    $sql2 = "SELECT * FROM don_hang WHERE id = $id_don_hang";
    $res2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($res2);
    
    if($row2['trang_thai']=='Đang chờ duyệt'){
        $sql = "UPDATE don_hang SET trang_thai='Đang giao hàng' WHERE id = $id_don_hang";
        $res = mysqli_query($conn, $sql);
        
        $sql2 = "UPDATE don_hang_chi_tiet
                INNER JOIN san_pham ON san_pham.id = don_hang_chi_tiet.id_san_pham 
                SET san_pham.so_luong = (san_pham.so_luong - don_hang_chi_tiet.so_luong)
                WHERE id_don_hang = $id_don_hang";
        $res2 = mysqli_query($conn, $sql2);

        if($res==true and $res2==true)
        {
            $_SESSION['update-order'] = "<div class='success text-center'>Đơn hàng đang được vận chuyển đến khách hàng!</div>";
            header('location:'.SITEURL."admin/order-detail.php?id_don_hang=$id_don_hang");
        }
        else
        {
            $_SESSION['update-order'] = "<div class='error text-center'>Không cập nhật được đơn hàng! Vui lòng thử lại</div>";
            header('location:'.SITEURL."admin/order-detail.php?id_don_hang=$id_don_hang");
        }
    } else if($row2['trang_thai']=='Đang giao hàng'){
        $sql = "UPDATE don_hang SET trang_thai='Đã thanh toán' WHERE id = $id_don_hang";
        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['update-order'] = "<div class='success text-center'>Đơn hàng đã được thanh toán!</div>";
            header('location:'.SITEURL."admin/order-detail.php?id_don_hang=$id_don_hang");
        }
        else
        {
            $_SESSION['update-order'] = "<div class='error text-center'>Không cập nhật được đơn hàng! Vui lòng thử lại</div>";
            header('location:'.SITEURL."admin/order-detail.php?id_don_hang=$id_don_hang");
        }
    }

?>