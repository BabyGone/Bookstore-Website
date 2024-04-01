<?php include('partials/menu.php') ?>

<!-- Main Content Section Starts -->
<div class="container">
    <div class="wrapper">
        <h1>Quản lý nhà xuất bản</h1>
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
        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <br>
        <a href="add-publisher.php" class="btn btn-primary">Thêm</a>
        <br><br>
        <table id="manage_publisher" class="table">
            <thead>

                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Địa chỉ</th>
                    <th>Điện thoại</th>
                    <th>Email</th>
                    <th>Chỉnh sửa</th>
                </tr>

            </thead>
            <tbody>

                <?php
                $sql = "SELECT * FROM nha_xuat_ban";
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE) {
                    $count = mysqli_num_rows($res); // So luong hang trong bang

                    $sn = 1;

                    // Kiem tra so luong hang trong bang
                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $id = $rows['id'];
                            $ten_nxb = $rows['ten_nxb'];
                            $dien_thoai = $rows['dien_thoai'];
                            $email = $rows['email'];
                            $dia_chi = $rows['dia_chi'];

                            // Hien thi du lieu
                ?>

                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td>Nhà xuất bản <?php echo $ten_nxb; ?></td>
                                <td width=250><?php echo $dia_chi; ?></td>
                                <td><?php echo $dien_thoai; ?></td>
                                <td><?php echo $email; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>admin/update-publisher.php?id=<?php echo $id; ?>" class="btn btn-secondary">Cập nhật</a>
                                    <a href="<?php echo SITEURL; ?>admin/delete-publisher.php?id=<?php echo $id; ?>" class="btn btn-danger">Xóa</a>
                                </td>
                            </tr>

                <?php
                        }
                    } else {
                        // Khong co du lieu
                    }
                }

                ?>

            </tbody>
        </table>

        <div class="clearfix"></div>
    </div>
</div>
<!-- Main Content Section Ends -->

<script>
    new DataTable('#manage_publisher');
</script>

<?php include('partials/footer.php') ?>