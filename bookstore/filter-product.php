<?php
include('config/constants.php');

if (isset($_POST['action'])) {
    $sql = "SELECT san_pham.id,san_pham.ten_san_pham,san_pham.gia_tien,san_pham.giam_gia,san_pham.anh_nen,nha_xuat_ban.ten_nxb,san_pham.nam_xuat_ban,san_pham.tac_gia,san_pham.id_the_loai 
    FROM san_pham 
    INNER JOIN nha_xuat_ban ON nha_xuat_ban.id=san_pham.id_nha_xuat_ban
    WHERE trang_thai = 'Có'";

    if (isset($_POST['search_by_name'])) {
        $search_by_name = $_POST['search_by_name'];
        $sql .= "AND ten_san_pham LIKE '%$search_by_name%'";
    }
    if (isset($_POST['search_by_publisher'])) {
        $search_by_publisher = $_POST['search_by_publisher'];
        $sql .= "AND ten_nxb LIKE '%$search_by_publisher%'";
    }
    if (isset($_POST['search_by_year'])) {
        $search_by_year = $_POST['search_by_year'];
        $sql .= "AND nam_xuat_ban LIKE '%$search_by_year%'";
    }
    if (isset($_POST['search_by_author'])) {
        $search_by_author = $_POST['search_by_author'];
        $sql .= "AND tac_gia LIKE '%$search_by_author%'";
    }

    if (isset($_POST['the_loai'])) {
        $the_loai = implode("','", $_POST['the_loai']);
        $sql .= "AND id_the_loai IN('" . $the_loai . "')";
    }

    $res = mysqli_query($conn, $sql);
    $output = '';

    if (mysqli_num_rows($res) > 0) {
        while ($row = mysqli_fetch_assoc($res)) {
            $id = $row['id'];
            $ten_san_pham = $row['ten_san_pham'];
            $gia_tien = $row['gia_tien'];
            $giam_gia = $row['giam_gia'];
            $gia_giam = $gia_tien * (100 - $giam_gia) / 100;
            $anh_nen = $row['anh_nen'];

            $output .= '<div class="text-center col-lg-4 col-md-12 mb-4">
                <div class="card">
                    <div class="bg-image hover-zoom ripple ripple-surface ripple-surface-light" data-mdb-ripple-color="light">
                        <img src="'.SITEURL.'images/product/'.$anh_nen.'" class="w-50" style="height: 200px;" />
                    </div>
                    <div class="card-body">
                        <a href="'.SITEURL.'product-detail.php?product_id='.$id.'" class="text-reset">
                            <h6 class="card-title mb-3">'.$ten_san_pham.'</h6>
                        </a>
                        <span class="act-price">'.number_format($gia_giam).'₫</span>
                        <div class="ml-2">
                            <small style="text-decoration: line-through">' . number_format($gia_tien) . '₫</small>
                            <span class="act-price">-'.$giam_gia.'%</span>
                        </div>
                        <a href="'.SITEURL.'product-detail.php?product_id='.$id.'" class="btn btn-primary mt-3">Xem sản phẩm</a>
                    </div>
                </div>
            </div>';
        }
    } else {
        $output = "<h3 class='text-center'>Không có sản phẩm</h3>";
    }
    echo $output;
}
?>