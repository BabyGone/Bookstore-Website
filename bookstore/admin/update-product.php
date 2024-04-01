<?php include('partials/menu.php') ?>
<?php
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql2 = "SELECT * FROM san_pham WHERE id=$id";
        $res2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($res2);

        $ten_san_pham = $row2['ten_san_pham'];
        $mo_ta = $row2['mo_ta'];
        $gia_tien = $row2['gia_tien'];
        $giam_gia = $row2['giam_gia'];
        $anh_hien_tai = $row2['anh_nen'];
        $tac_gia = $row2['tac_gia'];
        $so_luong = $row2['so_luong'];
        $nam_xuat_ban = $row2['nam_xuat_ban'];
        $nha_xuat_ban = $row2['id_nha_xuat_ban'];
        $the_loai_hien_tai = $row2['id_the_loai'];
        $noi_bat = $row2['noi_bat'];
        $trang_thai = $row2['trang_thai'];
    } else {
        header('location:'.SITEURL.'admin/manage-product.php');
    }
?>
<div class="container">
    <div class="wrapper">
        <h1>Cập nhật sản phẩm</h1>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <td>Tên sản phẩm: </td>
                    <td>
                        <input type="text" name="ten_san_pham" value="<?php echo $ten_san_pham ?>" required>
                    </td>                    
                </tr>
                <tr>
                    <td>Mô tả: </td>
                    <td>
                        <textarea name="mo_ta" cols="30" rows="10" required><?php echo $mo_ta ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Giá tiền: </td>
                    <td>
                        <input type="number" name="gia_tien" min=0 step=1000 value="<?php echo $gia_tien ?>" required>
                    </td> 
                </tr>
                <tr>
                    <td>Giảm giá: </td>
                    <td>
                        <input type="number" name="giam_gia" min=0 value="<?php echo $giam_gia ?>"> %
                    </td>
                </tr>
                <tr>
                    <td>Ảnh hiện tại: </td>
                    <td>
                        <?php 
                            if($anh_hien_tai == "")
                            {
                                echo "<div class='error'>Không có ảnh</div>";
                            }
                            else
                            {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/product/<?php echo $anh_hien_tai; ?>" width="150px">
                                <?php
                            }
                        ?>
                    </td> 
                </tr>
                <tr>
                    <td>Chọn ảnh mới: </td>
                    <td>
                        <input type="file" name="anh_moi">
                    </td>
                </tr>
                <tr>
                    <td>Tác giả: </td>
                    <td>
                        <input type="text" name="tac_gia" value="<?php echo $tac_gia ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>Số lượng: </td>
                    <td>
                        <input type="number" name="so_luong" min=0 value="<?php echo $so_luong ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>Năm xuất bản: </td>
                    <td>
                        <input type="text" name="nam_xuat_ban" value="<?php echo $nam_xuat_ban ?>" required>
                    </td>
                </tr>
                <tr>
                    <td>Thể loại: </td>
                    <td>
                        <select name="the_loai">

                            <?php
                                $sql = "SELECT * FROM the_loai WHERE trang_thai='Có'";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);
                                if($count > 0) {
                                    while($row=mysqli_fetch_assoc($res)) {
                                        $id_the_loai = $row['id'];
                                        $ten_the_loai = $row['ten_the_loai'];
                                        ?>
                                        <option <?php if($the_loai_hien_tai==$id_the_loai){echo "selected";} ?> value='<?php echo $id_the_loai ?>'><?php echo $ten_the_loai ?></option>;
                                        <?php 
                                    }
                                } else {
                                    echo "<option value='0'>Không có thể loại</option>";
                                }
                            ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Nhà xuất bản: </td>
                    <td>
                        <select name="nha_xuat_ban">

                            <?php
                                $sql4 = "SELECT * FROM nha_xuat_ban";
                                $res4 = mysqli_query($conn, $sql4);
                                $count4 = mysqli_num_rows($res4);
                                if($count4 > 0) {
                                    while($row4=mysqli_fetch_assoc($res4)) {
                                        $id_nha_xuat_ban = $row4['id'];
                                        $ten_nxb = $row4['ten_nxb'];
                                        ?>
                                        <option <?php if($nha_xuat_ban==$id_nha_xuat_ban){echo "selected";} ?> value='<?php echo $id_nha_xuat_ban ?>'><?php echo $ten_nxb ?></option>;
                                        <?php 
                                    }
                                } else {
                                    echo "<option value='0'>Không có nhà xuất bản</option>";
                                }
                            ?>

                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Nổi bật: </td>
                    <td>
                        <input <?php if($noi_bat=="Có"){echo "checked";} ?> type="radio" name="noi_bat" value="Có"> Có
                        <input <?php if($noi_bat=="Không"){echo "checked";} ?> type="radio" name="noi_bat" value="Không"> Không
                    </td> 
                </tr>
                <tr>
                    <td>Trạng thái: </td>
                    <td>
                        <input <?php if($trang_thai=="Có"){echo "checked";} ?> type="radio" name="trang_thai" value="Có"> Có
                        <input <?php if($trang_thai=="Không"){echo "checked";} ?> type="radio" name="trang_thai" value="Không"> Không
                    </td> 
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="anh_hien_tai" value="<?php echo $anh_hien_tai; ?>">
                        <input type="submit" name="submit" value="Cập nhật" class="btn btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if(isset($_POST['submit'])) {
                $id = $_POST['id'];
                $ten_san_pham = $_POST['ten_san_pham'];
                $mo_ta = $_POST['mo_ta'];
                $gia_tien = $_POST['gia_tien'];
                $giam_gia = $_POST['giam_gia'];
                $anh_hien_tai = $_POST['anh_hien_tai'];
                $tac_gia = $_POST['tac_gia'];
                $so_luong = $_POST['so_luong'];
                $nam_xuat_ban = $_POST['nam_xuat_ban'];
                $nha_xuat_ban = $_POST['nha_xuat_ban'];
                $the_loai = $_POST['the_loai'];
                $noi_bat = $_POST['noi_bat'];
                $trang_thai = $_POST['trang_thai'];

                if(isset($_FILES['anh_moi']['name'])) {
                    $anh_nen = $_FILES['anh_moi']['name'];

                    // if($anh_nen != "")
                    // {
                    //     $src_path = $_FILES['anh_moi']['tmp_name'];
                    //     $dest_path = "../images/product/".$anh_nen;

                    //     $upload = move_uploaded_file($src_path, $dest_path);
                    //     if($upload==false) {
                    //         $_SESSION['upload'] = "<div class='error'>Không thể cập nhật ảnh mới! Vui lòng thử lại!</div>";
                    //         // header('location:'.SITEURL.'admin/manage-product.php');
                    //         echo "<script>location.href = '".SITEURL."admin/manage-product.php';</script>";
                    //         die();
                    //     }
                    //     if($anh_hien_tai != "")
                    //     {
                    //         $remove_path = "../images/product/".$anh_hien_tai;

                    //         $remove = unlink($remove_path);

                    //         if($remove==false)
                    //         {
                    //             $_SESSION['remove-failed'] = "<div class='error'>Không thể xóa ảnh hiện tại! Vui lòng thử lại!</div>";
                    //             // header('location:'.SITEURL.'admin/manage-product.php');
                    //             echo "<script>location.href = '".SITEURL."admin/manage-product.php';</script>";
                    //             die();
                    //         }
                    //     }
                    // } else {
                    //     $anh_nen = $anh_hien_tai;
                    // }
                } else {
                    $anh_nen = $anh_hien_tai;
                }

                $sql3 = "UPDATE san_pham SET 
                    ten_san_pham = '$ten_san_pham',
                    mo_ta = '$mo_ta',
                    gia_tien = $gia_tien,
                    giam_gia = $giam_gia,
                    anh_nen = '$anh_nen',
                    tac_gia = '$tac_gia',
                    so_luong = $so_luong,
                    nam_xuat_ban = '$nam_xuat_ban',
                    id_nha_xuat_ban = $nha_xuat_ban,
                    id_the_loai = $the_loai,
                    noi_bat = '$noi_bat',
                    trang_thai = '$trang_thai'
                    WHERE id=$id
                ";

                $res3 = mysqli_query($conn, $sql3);

                if($res3==true) {
                    $_SESSION['update'] = "<div class='success'>Cập nhật sản phẩm thành công!</div>";
                    // header('location:'.SITEURL.'admin/manage-product.php');
                    echo "<script>location.href = '".SITEURL."admin/manage-product.php';</script>";
                } else {
                    $_SESSION['update'] = "<div class='error'>Cập nhật sản phẩm thất bại! Vui lòng thử lại!</div>";
                    // header('location:'.SITEURL.'admin/manage-product.php');
                    echo "<script>location.href = '".SITEURL."admin/manage-product.php';</script>";
                }
            }
        ?>

    </div>
</div>

<?php include('partials/footer.php') ?>
