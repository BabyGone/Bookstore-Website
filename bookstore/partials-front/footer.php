<!-- Footer -->
<footer class="text-lg-start bg-body-tertiary text-muted">
  <!-- Section: Links  -->
  <section class="text-body">
    <div class="container text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4 text-danger">
            Nhà sách Tiền Phong
          </h6>
          <p>
            Nhà Sách Tiền Phong nhận đặt hàng trực tuyến và giao hàng tận nơi hoặc nhận hàng tại tất cả Hệ Thống Nhà Sách Tiền Phong trên toàn quốc.
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Xem thêm
          </h6>
          <p>
            <a href="<?php echo SITEURL; ?>products.php" class="text-reset">Sản phẩm</a>
          </p>
          <p>
            <a href="<?php echo SITEURL; ?>categories.php" class="text-reset">Thể loại</a>
          </p>
          <p>
            <a href="<?php echo SITEURL; ?>order.php" class="text-reset">Đơn hàng</a>
          </p>
          <p>
            <?php
            if (!isset($_SESSION['customer-user'])) {
            ?>
              <a class="text-reset" href="<?php echo SITEURL; ?>login.php">Đăng nhập</a>
            <?php
            } else {
              $ten_tai_khoan = $_SESSION['customer-user'];
              $sql = "SELECT * FROM nguoi_dung WHERE ten_tai_khoan = '$ten_tai_khoan'";
              $res = mysqli_query($conn, $sql);
              $row = mysqli_fetch_assoc($res);
            ?>
              <a class="text-reset" href="<?php echo SITEURL; ?>manage-account.php?id=<?php echo $row['id']; ?>">Tài khoản</a>
            <?php
            }
            ?>
          </p>
        </div>
        <!-- Grid column -->

        <!-- Grid column -->
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Liên hệ</h6>
          <p><i class="fas fa-home me-3"></i> Tầng 5, Tòa nhà Tiền phong, 15 Hồ Xuân Hương, Hà Nội</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            info@tienphongjsc.com
          </p>
          <p><i class="fas fa-phone me-3"></i> 0968.715.858</p>
          <p><i class="fas fa-print me-3"></i> 0968.715.858</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    <span class="text-body">© 2024 Copyright:</span>
    <a class="fw-bold text-danger" href="<?php echo SITEURL; ?>">Nhà sách Tiền Phong</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->
</body>

</html>