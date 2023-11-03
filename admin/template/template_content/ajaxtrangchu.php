<?php
include('../../../db/DAOChiTietDonHang.php');
include('../../../db/DAOHang.php');
include('../../../db/DAO/DataProvider.php');

$daoCTDH = new DAOChiTietDonHang();
$daoHang = new DAOHang();
// $tongSPDaBan = $daoCTDH->TongSanPhamBan();
if (isset($_POST['quarter']))
    if ($_POST['quarter'] != 0) {
        $dataDoanhThu = $daoCTDH->ListDoanhThu(false, $_POST['quarter']);

        echo '[["Element", "Total", { "role": "style" }],';
        foreach ($dataDoanhThu as $key)
            echo '["Tháng ' . $key["Thang"] . '", ' . $key["TongDoanhThu"] . ',"#ccc"],';
        echo ']';
    } else {
        $dataDoanhThu = $daoCTDH->ListDoanhThu();
        echo '[["Element", "Total", { "role": "style" }],';
        foreach ($dataDoanhThu as $key)
            echo '["Quý ' . $key["Quy"] . '", ' . $key["TongDoanhThu"] . ',"#ccc"],';
        echo ']';
    }
if (isset($_POST['hang'])) {
    if ($_POST['hang'] !=0) {
        $dataDoanhThu = $daoCTDH->ListPhanTram($_POST['hang']);
        echo '[["Ten", "TongSoLuong"],';
         foreach ($dataDoanhThu as $key)
                echo '["' . $key['Ten'] . '",' . $key['TongSoLuong'] . '],';
        echo ']';
    } else {
        $dataDoanhThu = $daoCTDH->ListPhanTram();
        echo '[["Ten", "TongSoLuong"],';
         foreach ($dataDoanhThu as $key)
                echo '["' . $key['Ten'] . '",' . $key['TongSoLuong'] . '],';
        echo ']';
    }
}
