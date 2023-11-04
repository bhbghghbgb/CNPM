<?php 
include("../../../db/DAOPhieuNhap.php");
include("../../../db/DAOChiTietPhieuNhap.php");
include("../../../db/DAOSoSize.php");
if (isset($_POST['flag'])) {
    $daoPhieuNhap = new DAOPhieuNhap();
    $listPhieuNhap = $daoPhieuNhap->getListFollow();
    $flag = $_POST['flag'];
    loadListPN($listPhieuNhap, $flag);
}

if (isset($_POST['maPNDuyet'])) {
    $maPN = $_POST['maPNDuyet'];
    $daoPhieuNhap = new DAOPhieuNhap();
    $daoPhieuNhap->updateTrangThaiPN (1, $maPN);

    // update lại số lượng trong sản phẩm
    $daoCTPN = new DAOChiTietPhieuNhap();
    $daoSoSize = new DAOSoSize ();
    $ListCTPN = $daoCTPN->getList($maPN);
    foreach ($ListCTPN as $row) {
        $MaSP =  $row['MaSP'];
        $Size = $row['Size'];
        $SoLuong = $row['SoLuong'];
        $daoSoSize->updateSoLuong($MaSP, $Size, $SoLuong);
    }

    echo $maPN;
}
 
if (isset($_POST['maPNTuChoi'])) {
    $maPN = $_POST['maPNTuChoi'];
    $daoPhieuNhap = new DAOPhieuNhap();
    $daoPhieuNhap->updateTrangThaiPN (2, $maPN);
    echo $maPN;
}

if (isset($_POST['maPNXoa'])) {
    $maPN = $_POST['maPNXoa'];
    $daoCTPN = new DAOChiTietPhieuNhap();
    $daoCTPN->deleteCTPN($maPN);
    $daoPhieuNhap = new DAOPhieuNhap();
    $daoPhieuNhap->deletePhieuNhap($maPN);
    echo $maPN;
}

if (isset ($_POST['dateStart']) && isset($_POST['dateEnd']) && isset($_POST['flagValueLoc'])  ) {
    $dateStart = $_POST['dateStart'];
    $dateEnd = $_POST['dateEnd'];
    $flag = $_POST['flagValueLoc'];
    $daoPhieuNhap = new DAOPhieuNhap();
    $listPhieuNhap = $daoPhieuNhap->LocTheoKhoangTG($dateStart,$dateEnd);
    loadListPN($listPhieuNhap, $flag);

}

if (isset ($_POST['dateValueLoc'])&& isset($_POST['flagValueLocNgay']) ) {
    $date = $_POST['dateValueLoc'];
    $flag = $_POST['flagValueLocNgay'];
    $daoPhieuNhap = new DAOPhieuNhap();
    $listPhieuNhap = $daoPhieuNhap->LocTheoKhoangTG($date,$date);
    loadListPN($listPhieuNhap, $flag);
}



function loadListPN ($listPhieuNhap, $flag) {
    $rows = '';
    echo '<thead>';
    echo '<th>Mã phiếu</th>';
    echo '<th>Hãng</th>';
    echo '<th>Tổng đơn</th>';
    echo '<th>Nhân viên</th>';
    echo '<th>Ngày tạo</th>';
    echo '<th>Trạng thái</th>';
    echo '<th>Xem Chi tiết</th>';
   if ($flag == 'getList'){echo '<th>Hành động</th>';}
    echo '</thead>';
    
    foreach ($listPhieuNhap as $row) {
        $MaPhieu = $row['MaPhieu'];
        $MaHang = $row['Ten'];
        $Tongdon = $row['TongDon'];
        $MaTaiKhoan = $row['TenNhanVien'];
        $NgayTao = $row['NgayTaoPN'];
        // $GhiChu= $row['GhiChu'];
        $TrangThai = $row['TrangThaiPN'];
        
        if ($TrangThai == '1'){ // đã duyệt
            $TrangThai = 'Đã duyệt';
            $css ="style = 'background-color:chartreuse'";
            $XemChiTiet = '<button type="button" class="btn" style="background-color:burlywood" onclick="xemChiTiet(this)"  >Xem chi tiết</button>';
            $HanhDong = '';
        } else if ($TrangThai == '0') { // chờ duyệt
            $TrangThai = 'Chờ duyệt';
            $css ="style = 'background-color:yellow'";
            $XemChiTiet = '<button type="button" class="btn" style="background-color:burlywood" onclick="xemChiTiet(this)"  >Xem chi tiết</button>';
            $HanhDong = '<button type="button" class="btn" style="background-color:chartreuse" onclick="duyet(this)" >Duyệt</button> 
            <button type="button" class="btn" style="background-color:red" onclick="tuChoi(this)" >Từ chối</button> 
            ';
        } else if ($TrangThai == '2') { // từ chối
            $TrangThai = 'Bị từ chối';
            $css ="style = 'background-color:red'";
            $XemChiTiet = '<button type="button" class="btn" style="background-color:burlywood" onclick="xemChiTiet(this)"  >Xem chi tiết</button>';
            $HanhDong = ' 
            <button type="button" class="btn" style="background-color:red" onclick="xoa(this)">Xóa</button>
            ';
        }

        $rows .= "<tr><td>$MaPhieu</td><td>$MaHang</td><td>$Tongdon</td><td>$MaTaiKhoan</td><td>$NgayTao</td><td $css >$TrangThai</td><td>$XemChiTiet</td>";
        if ($flag == 'getList'){
             $rows.= "<td>$HanhDong</td>";}
        
        $rows.="</tr>";
        
        }
       echo '<tbody>';
       echo $rows;       
       echo '</tbody>';
}






// $daoPhieuNhap = new DAOPhieuNhap();
// $daoPhieuNhap->addPhieuNhap('2023-11-09', 220211, 'MH-002', 8, 1, 'Khong co');









?>