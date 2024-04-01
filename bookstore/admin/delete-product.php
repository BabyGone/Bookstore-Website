<?php
    include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['anh_nen'])) {
        $id = $_GET['id'];
        $anh_nen = $_GET['anh_nen'];
        if($anh_nen != "") {
            $path = "../images/product/".$anh_nen;
            $remove = unlink($path);
            if($remove==false) {
                $_SESSION['upload'] = "<div class='error'>Không thể xóa ảnh sản phẩm! Vui lòng thử lại!</div>";
                header('location:'.SITEURL.'admin/manage-product.php');
                die();
            }
        }

        $sql = "DELETE FROM san_pham WHERE id=$id";
        $res = mysqli_query($conn, $sql);
        if($res == true) {
            $_SESSION['delete'] = "<div class='success'>Xóa sản phẩm thành công!</div>";
            header('location:'.SITEURL.'admin/manage-product.php');
        } else {
            $_SESSION['delete'] = "<div class='error'>Xóa sản phẩm thất bại! Vui lòng thử lại!</div>";
            header('location:'.SITEURL.'admin/manage-product.php');
        }
    } else {
        $_SESSION['unauthorize'] = "<div class='error'>Không tìm thấy sản phẩm!</div>";
        header('location:'.SITEURL.'admin/manage-product.php');
    }
?>