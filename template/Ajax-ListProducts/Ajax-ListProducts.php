<?php
if (isset($_GET['MaDM']) || isset($_GET['Sale']) || isset($_GET['MaHang']) || isset($_GET['Find'])) {

    function TinhTienGiam($TiLegiam, $data)
    {
        return $data - $data * $TiLegiam / 100;
    }

    include('../../db/DAOSP.php');
    $db = new DAOSP();
    $db->connect();
    $data = null;

    $sql = "SELECT sp.*, hang.Ten AS TenHang, MIN(ss.GiaBan) AS GiaThapNhat
            FROM sanpham AS sp
            INNER JOIN hang ON sp.MaHang = hang.MaHang
            LEFT JOIN sosize AS ss ON sp.MaSP = ss.MaSP
            WHERE sp.TrangThai = 1 ";

    //su dung cach ghep chuoi de toi uu hoa cac thao tac loc
    if (isset($_GET['MaDM'])) {
        $MaDM = $_GET['MaDM'];
        //Khoi tao chuoi de truy van theo danh muc
        $sql = $sql . " AND sp.MaDM = '" . $MaDM . "' ";
    }

    if (isset($_GET['Sale'])) {
        $sql = $sql . " AND MaKhuyenMai != '#' ";
    }

    //Kiem tra xem nguoi dung co chon rieng 1 hang nao tu top menu khong
    if (isset($_GET['MaHang'])) {
        $Hang = $_GET['MaHang'];
        $sql = $sql . "AND sp.MaHang = '" . $Hang . "' ";
    }

    //kiem tra xem co loc hay khong
    if (isset($_GET['Hang'])) {
        //Neu co chon Hang thi them dieu kien loc hang vao chuoi truy van
        $Hang = $_GET['Hang'];
        if ($Hang != "All" && $Hang != "") {
            $sql = $sql . "AND sp.MaHang = '" . $Hang . "' ";
        }
    }
    //Thuoc hien tim kiem theo chu nguoi dung nhap
    if (isset($_GET['Find'])) {
        $Find = $_GET['Find'];
        $sql = $sql . " AND sp.Ten LIKE '%" . $Find . "%' ";
    }

    $sql .= "GROUP BY sp.Ten";
    if (isset($_GET['Gia'])) {
        // Dua dieu kien loc theo gia vao cau truy van
        $Gia = $_GET['Gia'];
        if ($Gia != "") {
            $sql = $sql . ' HAVING GiaThapNhat ';
            switch ($Gia) {
                case '0-1000000': {
                        $sql = $sql . " < 1000000 ";
                        break;
                    }
                case '1000000-1500000': {
                        $sql = $sql . " BETWEEN 1000000 AND 1500000 ";
                        break;
                    }
                case "1500000-2000000": {
                        $sql = $sql . " BETWEEN 1500000 AND 2000000 ";
                        break;
                    }
                case "2000000-3000000": {
                        $sql = $sql . " BETWEEN 2000000 AND 3000000 ";
                        break;
                    }
                case "3000000-": {
                        $sql = $sql . " > 3000000 ";
                        break;
                    }
            }
        }
    }

    //Bien de xac dinh so trang khi nguoi dung nhan
    $SoTrang = $_GET['Trang'];
    $From = 6 * ($SoTrang - 1);

    $sql = $sql . " LIMIT " . $From . ",6";
    $data = $db->getListDanhSach($sql);

    $n = 0;

    if ($data != null) {
        $n = count($data);
    }

    for ($i = 0; $i < $n; $i++) {
        $TiLeGiam = $db->getTiLeGiam($data[$i]['MaSP']);
        if (!$data)
            return;
?>
        <div class="modern-product-card">
            <div class="modern-product-image">
                <?php if($TiLeGiam > 0): ?>
                <div class="modern-product-discount">-<?php echo $TiLeGiam; ?>%</div>
                <?php endif; ?>
                <div class="modern-product-favorite">
                    <i class="ti-heart"></i>
                </div>
                <img src="./img/products/<?php echo $data[$i]['AnhChinh'] ?>" alt="<?php echo $data[$i][1] ?>">
            </div>
            <div class="modern-product-info">
                <div class="modern-product-vendor"><?php echo $data[$i]['TenHang'] ?></div>
                <div class="modern-product-name">
                    <a href="./chitietsp.php?MaSP=<?php echo $data[$i][0] ?>"><?php echo $data[$i][1] ?></a>
                </div>
                <div class="modern-product-price">
                    <?php if ($data[$i]['GiaMin'] === null) { ?>
                        <span class="price-new coming-soon">Sắp ra mắt</span>
                    <?php } else { ?>
                        <span class="price-new"><?php echo number_format(TinhTienGiam($TiLeGiam, $data[$i]['GiaMin']), 0, ',', '.') . "đ" ?></span>
                        <?php if ($TiLeGiam > 0) { ?>
                            <span class="price-old"><?php echo number_format($data[$i]['GiaMin'], 0, ',', '.') . "đ" ?></span>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>
            <div class="modern-product-actions">
                <a href="./chitietsp.php?MaSP=<?php echo $data[$i][0] ?>" class="modern-product-button btn-details">Xem chi tiết</a>
                <button class="modern-product-button btn-add-to-cart" onclick="addToCart('<?php echo $data[$i][0] ?>')"><i class="ti-shopping-cart"></i> Thêm vào giỏ</button>
            </div>
        </div>
<?php
    }
}
?>