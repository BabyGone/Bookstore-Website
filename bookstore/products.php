<?php include('partials-front/menu.php') ?>

<style>
    .act-price {
        color: red;
        font-weight: 700;
    }
</style>

<!-- Product Menu Section Starts Here -->
<section style="background-color: #eee;">
    <div class="container py-4">
        <h2 class="mt-2 mb-5 text-center"><strong>Sản phẩm</strong></h2>
        <form action="" method="GET">
            <div class="row">
                <div class="col-lg-3">
                    <ul class="list-group">
                        <h5 class="text-info">Sắp xếp</h5>
                        <div class="form-group">
                            <select name="sort" class="form-control">
                                <option value=''>Sắp xếp theo...</option>
                                <option value='latest' <?php if (isset($_GET['sort']) AND $_GET['sort']=='latest') echo 'selected' ?>>Mới nhất</option>
                                <option value='asc' <?php if (isset($_GET['sort']) AND $_GET['sort']=='asc') echo 'selected' ?>>Thứ tự từ A - Z</option>
                                <option value='desc' <?php if (isset($_GET['sort']) AND $_GET['sort']=='desc') echo 'selected' ?>>Thứ tự từ Z - A</option>
                                <option value='increase' <?php if (isset($_GET['sort']) AND $_GET['sort']=='increase') echo 'selected' ?>>Giá tăng dần</option>
                                <option value='decrease' <?php if (isset($_GET['sort']) AND $_GET['sort']=='decrease') echo 'selected' ?>>Giá giảm dần</option>
                            </select>
                        </div>
                    </ul>
                    <ul class="list-group">
                        <h5 class="text-info">Giá tiền</h5>
                        Từ:<input class="form-control" type="number" name="min" min=0 step=10000 value="<?php if (isset($_GET['min'])) echo $_GET['min'] ?>">
                        Đến:<input class="form-control" type="number" name="max" min=0 step=10000 value="<?php if (isset($_GET['max'])) echo $_GET['max'] ?>">
                    </ul>
                    <ul class="list-group">
                        <h5 class="text-info mt-3">Thể loại</h5>
                        <?php
                        $sql = "SELECT * FROM the_loai WHERE trang_thai='Có' ORDER BY ten_the_loai";
                        $res = mysqli_query($conn, $sql);
                        $count = mysqli_num_rows($res);
                        if ($count > 0) {
                            foreach ($res as $row) {
                                $checked = [];
                                if (isset($_GET['category'])) {
                                    $checked = $_GET['category'];
                                }
                        ?>
                                <li class="list-group-item">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input <?php if (in_array($row['id'], $checked)) {
                                                        echo "checked";
                                                    } ?> type="checkbox" name="category[]" class="form-check-input product_check" value="<?php echo $row['id'] ?>" id="the_loai"> <?php echo $row['ten_the_loai'] ?>
                                        </label>
                                    </div>
                                </li>
                        <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-lg-9">
                    <div class="row">
                        <div class="col-lg-3 mb-4">
                            <h5 class="text-info mt-3">Tên sản phẩm</h5>
                            <input type="text" name="name" id="search_by_name" placeholder="Tên sản phẩm" class="form-control search" value="<?php if (isset($_GET['name'])) echo $_GET['name'] ?>">
                        </div>
                        <div class="col-lg-3 mb-4">
                            <h5 class="text-info mt-3">Nhà xuất bản</h5>
                            <input type="text" name="publisher" id="search_by_publisher" placeholder="Nhà xuất bản" class="form-control search" value="<?php if (isset($_GET['publisher'])) echo $_GET['publisher'] ?>">
                        </div>
                        <div class="col-lg-3 mb-4">
                            <h5 class="text-info mt-3">Năm xuất bản</h5>
                            <input type="text" name="year" id="search_by_year" placeholder="Năm xuất bản" class="form-control search" value="<?php if (isset($_GET['year'])) echo $_GET['year'] ?>">
                        </div>
                        <div class="col-lg-3 mb-4">
                            <h5 class="text-info mt-3">Tác giả</h5>
                            <input type="text" name="author" id="search_by_author" placeholder="Tác giả" class="form-control search" value="<?php if (isset($_GET['author'])) echo $_GET['author'] ?>">
                        </div>
                        <div class="col-lg-3 mb-4">
                            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                        </div>
                    </div>
                    <div class="row" id="result">
                        <?php
                        // where
                        $where = "";
                        if (isset($_GET['category'])) {
                            $the_loai = implode("','", $_GET['category']);
                            $where .= "AND id_the_loai IN('" . $the_loai . "')";
                        } else {
                            $_GET['category'] = [];
                        }
                        if (isset($_GET['name'])) {
                            $ten_san_pham = $_GET['name'];
                            $where .= "AND ten_san_pham LIKE '%$ten_san_pham%'";
                        } else {
                            $_GET['name'] = '';
                        }
                        if (isset($_GET['publisher'])) {
                            $ten_nxb = $_GET['publisher'];
                            $where .= "AND ten_nxb LIKE '%$ten_nxb%'";
                        } else {
                            $_GET['publisher'] = '';
                        }
                        if (isset($_GET['year'])) {
                            $nam_xuat_ban = $_GET['year'];
                            $where .= "AND nam_xuat_ban LIKE '%$nam_xuat_ban%'";
                        } else {
                            $_GET['year'] = '';
                        }
                        if (isset($_GET['author'])) {
                            $tac_gia = $_GET['author'];
                            $where .= "AND tac_gia LIKE '%$tac_gia%'";
                        } else {
                            $_GET['author'] = '';
                        }
                        if (isset($_GET['min']) and isset($_GET['max']) and $_GET['min'] != '' and $_GET['max'] != '') {
                            $min = $_GET['min'];
                            $max = $_GET['max'];
                            $where .= "AND san_pham.gia_tien*(1-san_pham.giam_gia/100) BETWEEN $min AND $max";
                        } else {
                            $_GET['min'] = '';
                            $_GET['max'] = '';
                        }

                        // sort
                        $order = "";
                        if(isset($_GET['sort'])){
                            if ($_GET['sort']=='asc') {
                                $order = "ORDER BY ten_san_pham";
                            } else if ($_GET['sort']=='desc') {
                                $order = "ORDER BY ten_san_pham DESC";
                            } else if ($_GET['sort']=='increase') {
                                $order = "ORDER BY san_pham.gia_tien*(1-san_pham.giam_gia/100)";
                            } else if ($_GET['sort']=='decrease') {
                                $order = "ORDER BY san_pham.gia_tien*(1-san_pham.giam_gia/100) DESC";
                            } else if ($_GET['sort']=='latest') {
                                $order = "ORDER BY id DESC";
                            }
                        } else {
                            $_GET['sort']='';
                        }

                        // pagination
                        // index for limit in sql
                        $start = 0;
                        $rows_per_page = 3;

                        // number of rows
                        $result = mysqli_query($conn, "SELECT san_pham.*,san_pham.gia_tien*(1-san_pham.giam_gia/100) as gia_giam,nha_xuat_ban.ten_nxb FROM san_pham 
                                                        INNER JOIN nha_xuat_ban ON nha_xuat_ban.id = san_pham.id_nha_xuat_ban
                                                        WHERE trang_thai='Có' $where 
                                                        $order");
                        $nr_of_rows = mysqli_num_rows($result);
                        $pages = ceil($nr_of_rows / $rows_per_page);

                        if (isset($_GET['page-nr'])) {
                            $page = $_GET['page-nr'] - 1;
                            $start = $page * $rows_per_page;
                        } else {
                            $_GET['page-nr'] = 1;
                        }

                        // GET URL
                        // Category URL
                        $category_url = '';
                        foreach ($_GET['category'] as $category) {
                            // echo $category;
                            $category_url .= "&category%5B%5D=" . $category;
                        }
                        // Full URL
                        $get_url = $category_url . "&name=" . $_GET['name'] . "&publisher=" . $_GET['publisher'] . "&year=" . $_GET['year'] . "&author=" . $_GET['author'] . "&min=" . $_GET['min'] . "&max=" . $_GET['max']. "&sort=" . $_GET['sort'];

                        // product
                        $sql2 = "SELECT san_pham.*,san_pham.gia_tien*(1-san_pham.giam_gia/100) as gia_giam,nha_xuat_ban.ten_nxb FROM san_pham 
                                INNER JOIN nha_xuat_ban ON nha_xuat_ban.id = san_pham.id_nha_xuat_ban
                                WHERE trang_thai='Có' $where 
                                $order
                                LIMIT $start, $rows_per_page";

                        $res2 = mysqli_query($conn, $sql2);
                        $count2 = mysqli_num_rows($res2);
                        if ($count2 > 0) {
                            while ($row = mysqli_fetch_assoc($res2)) {
                                $id = $row['id'];
                                $ten_san_pham = $row['ten_san_pham'];
                                $gia_tien = $row['gia_tien'];
                                $giam_gia = $row['giam_gia'];
                                $gia_giam = $gia_tien * (100 - $giam_gia) / 100;
                                $anh_nen = $row['anh_nen'];
                        ?>
                                <div class="text-center col-lg-4 col-md-12 mb-4">
                                    <div class="card">
                                        <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">
                                            <img src="<?php echo SITEURL ?>images/product/<?php echo $anh_nen ?>" class="w-50" style="height: 200px;" />
                                        </div>
                                        <div class="card-body">
                                            <a href="<?php echo SITEURL; ?>product-detail.php?product_id=<?php echo $id; ?>" class="text-reset">
                                                <h6 class="card-title mb-3"><?php echo $ten_san_pham ?></h6>
                                            </a>
                                            <span class="act-price"><?php echo number_format($gia_giam) ?>₫</span>
                                            <div class="ml-2">
                                                <small style="text-decoration: line-through"><?php echo number_format($gia_tien) ?>₫</small>
                                                <span class="act-price">-<?php echo $giam_gia ?>%</span>
                                            </div>
                                            <a href="<?php echo SITEURL; ?>product-detail.php?product_id=<?php echo $id; ?>" class="btn btn-primary mt-3">Xem sản phẩm</a>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<div class='error'>Không có sản phẩm</div>";
                        }
                        ?>
                    </div>
                    <!-- Pagination -->
                    <ul class="pagination justify-content-center">
                        <!-- First -->
                        <li class="page-item <?php if ($_GET['page-nr'] == 1) echo 'disabled' ?>"><a class="page-link" href="?page-nr=1<?= $get_url ?>">Đầu</a></li>
                        <!-- Previous -->
                        <?php
                        if (isset($_GET['page-nr'])) {
                        ?>
                            <li class="page-item <?php if ($_GET['page-nr'] == 1) echo 'disabled' ?>"><a class="page-link" href="?page-nr=<?= $_GET['page-nr'] - 1 ?><?= $get_url ?>">Trước</a></li>
                        <?php
                        }
                        ?>
                        <!-- Page -->
                        <?php
                        for ($count = 1; $count <= $pages; $count++) {
                        ?>
                            <li class="page-item <?php if ($_GET['page-nr'] == $count) echo 'active' ?>"><a class="page-link" href="?page-nr=<?= $count ?><?= $get_url ?>"><?= $count ?></a></li>
                        <?php
                        }
                        ?>
                        <!-- Next -->
                        <?php
                        if (!isset($_GET['page-nr'])) {
                        ?>
                            <li class="page-item"><a class="page-link" href="?page-nr=2<?= $get_url ?>">Sau</a></li>
                        <?php
                        } else {
                        ?>
                            <li class="page-item <?php if ($_GET['page-nr'] >= $pages) echo 'disabled' ?>"><a class="page-link" href="?page-nr=<?= $_GET['page-nr'] + 1 ?><?= $get_url ?>">Sau</a></li>
                        <?php
                        }
                        ?>
                        <!-- Last -->
                        <li class="page-item <?php if ($_GET['page-nr'] >= $pages) echo 'disabled' ?>"><a class="page-link" href="?page-nr=<?= $pages ?><?= $get_url ?>">Cuối</a></li>
                    </ul>
                    <!-- Pagination -->
                </div>
            </div>
        </form>
    </div>
</section>

<!-- <script type="text/javascript">
    $(document).ready(function() {
        $('.search').keyup(function() {
            var action = 'data';
            var search_by_name = $('#search_by_name').val();
            var search_by_publisher = $('#search_by_publisher').val();
            var search_by_year = $('#search_by_year').val();
            var search_by_author = $('#search_by_author').val();
            $.ajax({
                url: 'filter-product.php',
                method: 'POST',
                data: {
                    action: action,
                    search_by_name: search_by_name,
                    search_by_publisher: search_by_publisher,
                    search_by_year: search_by_year,
                    search_by_author: search_by_author
                },
                success: function(response) {
                    $("#result").html(response);
                }
            });
        });

        $(".product_check").click(function() {
            var action = 'data';
            var the_loai = get_filter_text('the_loai');

            $.ajax({
                url: 'filter-product.php',
                method: 'POST',
                data: {
                    action: action,
                    the_loai: the_loai
                },
                success: function(response) {
                    $("#result").html(response);
                }
            });
        });

        function get_filter_text(text_id) {
            var filterData = [];
            $('#' + text_id + ':checked').each(function() {
                filterData.push($(this).val());
            });
            return filterData;
        }

    });
</script> -->
<!-- Product Menu Section Ends Here -->

<?php include('partials-front/footer.php') ?>