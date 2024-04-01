<?php include('partials-front/menu.php') ?>

<!-- Product Search Section Starts Here -->
<div class="container text-center my-5 w-50">
    <form class="mb-3 text-center" action="" method="POST">
        <input type="search" name="name" placeholder="Tìm kiếm sản phẩm..." class="form-control" required>
        <input type="submit" name="submit" value="Tìm kiếm" class="btn btn-primary mt-2">
    </form>
    <?php
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            header('location:'.SITEURL."products.php?name=$name");
        }
    ?>
</div>
<!-- Product Search Section Ends Here -->

<!-- Categories Section Starts Here -->
<section style="background-color: #eee;">
    <div class="text-center container py-5">
        <h2 class="mt-4 mb-5"><strong>Thể loại</strong></h2>
        <div class="row">
            <?php
            $sql = "SELECT * FROM the_loai WHERE trang_thai='Có'";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $ten_the_loai = $row['ten_the_loai'];
            ?>

                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body bg-danger">
                                <a href="<?php echo SITEURL; ?>products.php?<?php echo htmlspecialchars("category[]=").$id; ?>" class="text-light">
                                    <h5 class="card-title mb-3"><?php echo $ten_the_loai ?></h5>
                                </a>
                            </div>
                        </div>
                    </div>

            <?php
                }
            } else {
                echo "<div class='error'>Chưa có thể loại</div>";
            }
            ?>
        </div>
    </div>
</section>
<!-- Categories Section Ends Here -->

<?php include('partials-front/footer.php') ?>