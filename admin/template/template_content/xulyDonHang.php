<?php
include("../../../db/DAOChiTietDonHang.php");
include("../../../db/DAO/DataProvider.php");
include("../../../db/DAOSP.php");
include("../../../db/DAODonHang.php");
if (isset($_GET['MaDon'])) {
    $MaDon = $_GET['MaDon'];
    $dbCTDH = new DAOChiTietDonHang();

    $dbSP = new DAOSP();
    $dbSP->connect();


    $db = new DAODonHang();
    $db->connect();

    //Lấy 2 danh sách ra
    $dataCTDH = $dbCTDH->getList($MaDon);


    //Tạo biến đếm số sản phẩm thiếu hàng

    $count = 0;
    $ThongTin = array();
    $k = 0;

    foreach ($dataCTDH as $data) {
        $MaSP = $data->getMaSanPham();
        $Size = $data->getSize();
        $dataSP = $dbSP->getThongTinSanPham($MaSP, $Size);

        $SoLuongMoi = $dataSP["SLTonKho"] - $data->getSoLuong();
        array_push($ThongTin, array($MaSP, $Size, $SoLuongMoi)); // thông tin chứa mảng 2 chiều, mỗi phần tử con chứa mảng theo chỉ mục
        // 0 là mã sp , 1 là size, 2 là So lượng sau khi bán 
        if ($SoLuongMoi < 0) {
            $count += 1;
        }
    }

    if ($count != 0) {
        $HangThieu = "";
?>
        <p id="ThongBao-title">Đơn hàng: <?php echo $MaDon ?></p>
        <?php
        foreach ($ThongTin as $value) {
            if ($value[2] <= 0) {
                $HangThieu = $HangThieu . '\nMã hàng ' . $value[0] . " Size " . $value[1] . ' thiếu ' . -1 * $value[2] . ' đôi';
        ?>
                <p class="ThongBao-content">Mã hàng <?php echo $value[0] ?> Size <?php echo $value[1] ?> thiếu <?php echo -1 * $value[2] ?> đôi</p>
<?php
            }
        }
        echo '<script>alert("Xử lý đơn ' . $MaDon . ' thất bại ' . $HangThieu . '");</script>';
    } else {
        foreach ($ThongTin as $value) {
            if ($dbSP->TruSLBanHang($value[0], $value[1], $value[2])) {
            } else {
                echo "<script>alert('Xử lý đơn " . $MaDon . " thất bại')</script>";
                return;
            }
        }

        if ($db->xulyDon($MaDon)) {
            echo "<script>alert('Xử lý đơn " . $MaDon . " thành công');window.location='index.php?id=dh';</script>";
        }
    }
}
?>