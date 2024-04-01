<?php include('partials/menu.php') ?>

<!-- Main Content Section Starts -->
<div class="container">
    <div class="wrapper">
        <h1>Quản lý thể loại</h1>
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

        if (isset($_SESSION['no-category-found'])) {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }
        ?>

        <br>
        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn btn-primary">Thêm</a>
        <br><br>
        <table id="manage_category" class="table">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Thể loại</th>
                    <th>Nổi bật</th>
                    <th>Trạng thái</th>
                    <th>Chỉnh sửa</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM the_loai";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                $stt = 1;

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $ten_the_loai = $row['ten_the_loai'];
                        $noi_bat = $row['noi_bat'];
                        $trang_thai = $row['trang_thai'];

                ?>

                        <tr>
                            <td><?php echo $stt++ ?></td>
                            <td><?php echo $ten_the_loai ?></td>
                            <td><?php echo $noi_bat ?></td>
                            <td><?php echo $trang_thai ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id ?>" class="btn btn-secondary">Cập nhật</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id ?>" class="btn btn-danger">Xóa</a>
                            </td>
                        </tr>

                <?php
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
    new DataTable('#manage_category');
</script>

<?php include('partials/footer.php') ?>