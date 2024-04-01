<?php 
    include('config/constants.php');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM don_hang_chi_tiet WHERE id = $id";
        $res = mysqli_query($conn, $sql);
    
        if($res==true)
        {
            header('location:'.SITEURL.'cart.php');
        }
        else
        {
            header('location:'.SITEURL.'cart.php');
        }
    } else {
        header('location:'.SITEURL.'cart.php');
    }
?>