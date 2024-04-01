<?php include('partials/menu.php') ?>

<!-- Main Content Section Starts -->
<div class="container">
    <div class="wrapper">
        <h1>Quản lý sản phẩm</h1>
        <br>
        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }
        if (isset($_SESSION['unauthorize'])) {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        if (isset($_SESSION['remove-failed'])) {
            echo $_SESSION['remove-failed'];
            unset($_SESSION['remove-failed']);
        }
        ?>
        <br>
        <a href="<?php echo SITEURL ?>admin/add-product.php" class="btn btn-primary">Thêm</a>
        <br><br>
        <table id="manage_product" class="table" border="1">
            <thead>

                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá tiền</th>
                    <th>Ảnh nền</th>
                    <th>Tác giả</th>
                    <th>Số lượng</th>
                    <th>Năm xuất bản</th>
                    <th>Nổi bật</th>
                    <th>Trạng thái</th>
                    <th>Chỉnh sửa</th>
                </tr>

            </thead>
            <tbody>

                <?php
                $sql = "SELECT * FROM san_pham";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                $stt = 1;
                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $ten_san_pham = $row['ten_san_pham'];
                        $gia_tien = $row['gia_tien'];
                        $anh_nen = $row['anh_nen'];
                        $tac_gia = $row['tac_gia'];
                        $so_luong = $row['so_luong'];
                        $nam_xuat_ban = $row['nam_xuat_ban'];
                        $noi_bat = $row['noi_bat'];
                        $trang_thai = $row['trang_thai'];
                ?>
                        <tr>
                            <td><?php echo $stt++ ?></td>
                            <td><?php echo $ten_san_pham ?></td>
                            <td><?php echo number_format($gia_tien) ?>₫</td>
                            <td>
                                <?php
                                if ($anh_nen == "") {
                                    echo "<div class='error'>Chưa có ảnh</div>";
                                } else {
                                ?>
                                    <img src="<?php echo SITEURL ?>images/product/<?php echo $anh_nen ?>" width="100px">
                                <?php
                                }
                                ?>
                            </td>
                            <td><?php echo $tac_gia ?></td>
                            <td><?php echo $so_luong ?></td>
                            <td><?php echo $nam_xuat_ban ?></td>
                            <td><?php echo $noi_bat ?></td>
                            <td><?php echo $trang_thai ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-product.php?id=<?php echo $id; ?>" class="btn btn-secondary">Cập nhật</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-product.php?id=<?php echo $id; ?>&anh_nen=<?php echo $anh_nen; ?>" class="btn btn-danger">Xóa</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='10' class='error'>Chưa có sản phẩm</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>
</div>
<!-- Main Content Section Ends -->

<script>
    new DataTable('#manage_product');
</script>

<?php include('partials/footer.php') ?>