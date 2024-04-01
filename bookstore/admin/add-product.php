<?php include('partials/menu.php') ?>

<div class="container">
    <div class="wrapper">
        <h1>Thêm sản phẩm</h1>
        <br>
        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>       
        <br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <td>Tên sản phẩm: </td>
                    <td>
                        <input type="text" name="ten_san_pham" required>
                    </td>
                </tr>

                <tr>
                    <td>Mô tả: </td>
                    <td>
                        <textarea name="mo_ta" cols="30" rows="10" required></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Giá tiền: </td>
                    <td>
                        <input type="number" name="gia_tien" min=0 step=1000 required>
                    </td>
                </tr>
                <tr>
                    <td>Giảm giá: </td>
                    <td>
                        <input type="number" name="giam_gia" min=0> %
                    </td>
                </tr>
                
                <tr>
                    <td>Chọn ảnh: </td>
                    <td>
                        <input type="file" name="anh_nen">
                    </td>
                </tr>

                <tr>
                    <td>Tác giả: </td>
                    <td>
                        <input type="text" name="tac_gia" required>
                    </td>
                </tr>

                <tr>
                    <td>Số lượng: </td>
                    <td>
                        <input type="number" name="so_luong" min=0 required>
                    </td>
                </tr>

                <tr>
                    <td>Năm xuất bản: </td>
                    <td>
                        <input type="text" name="nam_xuat_ban" required>
                    </td>
                </tr>

                <tr>
                    <td>Nhà xuất bản: </td>
                    <td>
                        <select name="nha_xuat_ban">
                            <?php
                                $sql1 = "SELECT * FROM nha_xuat_ban";
                                $res1 = mysqli_query($conn, $sql1);
                                $count1 = mysqli_num_rows($res1);
                                if($count1 > 0) {
                                    while($row1 = mysqli_fetch_assoc($res1)) {
                                        $id_nha_xuat_ban = $row1['id'];
                                        $ten_nxb = $row1['ten_nxb'];
                                        ?>

                                        <option value="<?php echo $id_nha_xuat_ban ?>"><?php echo $ten_nxb ?></option>
                                        
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <option value="0">Không có nhà xuất bản</option>
                                    <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Thể loại: </td>
                    <td>
                        <select name="the_loai">
                            <?php
                                $sql2 = "SELECT * FROM the_loai WHERE trang_thai='Có'";
                                $res2 = mysqli_query($conn, $sql2);
                                $count2 = mysqli_num_rows($res2);
                                if($count2 > 0) {
                                    while($row2 = mysqli_fetch_assoc($res2)) {
                                        $id_the_loai = $row2['id'];
                                        $ten_the_loai = $row2['ten_the_loai'];
                                        ?>

                                        <option value="<?php echo $id_the_loai ?>"><?php echo $ten_the_loai ?></option>
                                        
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <option value="0">Không có thể loại</option>
                                    <?php
                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Nổi bật: </td>
                    <td>
                        <input type="radio" name="noi_bat" value="Có"> Có
                        <input type="radio" name="noi_bat" value="Không"> Không
                    </td>
                </tr>

                <tr>
                    <td>Trạng thái: </td>
                    <td>
                        <input type="radio" name="trang_thai" value="Có"> Có
                        <input type="radio" name="trang_thai" value="Không"> Không
                    </td>
                </tr>
                
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Thêm" class="btn btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if(isset($_POST['submit'])) {
                $ten_san_pham = $_POST['ten_san_pham'];
                $mo_ta = $_POST['mo_ta'];
                $gia_tien = $_POST['gia_tien'];
                $giam_gia = $_POST['giam_gia'];
                $tac_gia = $_POST['tac_gia'];
                $so_luong = $_POST['so_luong'];
                $nam_xuat_ban = $_POST['nam_xuat_ban'];
                $nha_xuat_ban = $_POST['nha_xuat_ban'];
                $the_loai = $_POST['the_loai'];

                if(isset($_POST['noi_bat'])) {
                    $noi_bat = $_POST['noi_bat'];
                } else {
                    $noi_bat = "Không";
                }  
    
                if(isset($_POST['trang_thai'])) {
                    $trang_thai = $_POST['trang_thai'];
                } else {
                    $trang_thai = "Không";
                }
    
                if(isset($_FILES['anh_nen']['name'])) {
                    $anh_nen = $_FILES['anh_nen']['name'];
                } else {
                    $anh_nen = "";
                }

                $sql3 = "INSERT INTO san_pham SET
                    ten_san_pham = '$ten_san_pham',
                    mo_ta = '$mo_ta',
                    gia_tien = $gia_tien,
                    anh_nen = '$anh_nen',
                    tac_gia = '$tac_gia',
                    so_luong = $so_luong,
                    nam_xuat_ban = '$nam_xuat_ban',
                    noi_bat = '$noi_bat',
                    trang_thai = '$trang_thai',
                    giam_gia = $giam_gia,
                    id_nha_xuat_ban = $nha_xuat_ban,
                    id_the_loai = $the_loai
                ";

                $res3 = mysqli_query($conn, $sql3);

                if($res3 == true) {
                    $_SESSION['add'] = "<div class='success'>Thêm sản phẩm thành công!</div>";
                    // header('location:'.SITEURL.'admin/manage-product.php');
                    echo "<script>location.href = '".SITEURL."admin/manage-product.php';</script>";
                } else {
                    $_SESSION['add'] = "<div class='error'>Thêm sản phẩm thất bại! Vui lòng thử lại!</div>";
                    // header('location:'.SITEURL.'admin/manage-product.php');
                    echo "<script>location.href = '".SITEURL."admin/add-product.php';</script>";
                }
            }

        ?>

    </div>
</div>

<?php include('partials/footer.php') ?>