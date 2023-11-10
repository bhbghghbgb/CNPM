<?php
include('../../../db/DAOChiTietDonHang.php');
include('../../../db/DAOChiTietPhieuNhap.php');
include('../../../db/DAOHang.php');
include('../../../db/DAO/DataProvider.php');

$daoCTDH = new DAOChiTietDonHang();
$daoCTPN = new DAOChiTietPhieuNhap();
$daoHang = new DAOHang();
if (isset($_POST['daban']) && $_POST['daban']) {
    if (isset($_POST['quarter'])) {
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
    }
    if (isset($_POST['hang'])) {
        if ($_POST['hang'] != 0) {
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
    if (isset($_POST['bieudotronhang'])) {
        $ListPhanTramHangDaBan = $daoCTDH->ListPhanTramTungHang();
        echo '[["MaHang", "TongSoLuong"],';
        foreach ($ListPhanTramHangDaBan as $key)
            echo '["' . $key['TenHang'] . '",' . $key['TongSoLuong'] . '],';
        echo ']';
    }

}
else {
    if (isset($_POST['quarter'])) {
        if ($_POST['quarter'] != 0) {
            $dataDoanhThu = $daoCTPN->ListDoanhThu(false, $_POST['quarter']);

            echo '[["Element", "Total", { "role": "style" }],';
            foreach ($dataDoanhThu as $key)
                echo '["Tháng ' . $key["Thang"] . '", ' . $key["TongDoanhThu"] . ',"#ccc"],';
            echo ']';
        } else {
            $dataDoanhThu = $daoCTPN->ListDoanhThu();
            echo '[["Element", "Total", { "role": "style" }],';
            foreach ($dataDoanhThu as $key)
                echo '["Quý ' . $key["Quy"] . '", ' . $key["TongDoanhThu"] . ',"#ccc"],';
            echo ']';
        }
    }
    if (isset($_POST['hang'])) {
        if ($_POST['hang'] != 0) {
            $dataDoanhThu = $daoCTPN->ListPhanTram($_POST['hang']);
            echo '[["Ten", "TongSoLuong"],';
            foreach ($dataDoanhThu as $key)
                echo '["' . $key['Ten'] . '",' . $key['TongSoLuong'] . '],';
            echo ']';
        } else {
            $dataDoanhThu = $daoCTPN->ListPhanTram();
            echo '[["Ten", "TongSoLuong"],';
            foreach ($dataDoanhThu as $key)
                echo '["' . $key['Ten'] . '",' . $key['TongSoLuong'] . '],';
            echo ']';
        }
    }
    if (isset($_POST['bieudotronhang'])) {
        $ListPhanTramHangDaBan = $daoCTPN->ListPhanTramTungHang();
        echo '[["MaHang", "TongSoLuong"],';
        foreach ($ListPhanTramHangDaBan as $key)
            echo '["' . $key['TenHang'] . '",' . $key['TongSoLuong'] . '],';
        echo ']';
    }
}