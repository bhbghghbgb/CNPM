<?php 
include('../db/DAOSP.php');
include('../db/DAOSoSize.php');
include('../db/DAOChiTietPhieuNhap.php');
include('../db/DAOPhieuNhap.php');
if (isset ($_POST["maHang"])) {
    $maHang  = $_POST["maHang"];
    $daoSP = new DAOSP();
    $ListSP = $daoSP->getListSPFollow($maHang);
    for ($i = 0; $i<count($ListSP); $i++) {
        $maSP =   $ListSP[$i]['MaSP']; // mã hãng
        $tenSP =   $ListSP[$i]['Ten']; // tên hãng
        echo"<option value='$maSP~$tenSP'>$tenSP</option>";   
    }
}

if (isset ($_POST["maSP"])) {
    $maSP = $_POST["maSP"];
    $daoSoSize = new DAOSoSize();
    $ListSoSize = $daoSoSize->getSoSize($maSP);
    for ($i = 0; $i<count($ListSoSize); $i++) {
        $size =   $ListSoSize[$i]['Size']; // mã hãng
        echo"<option value='$size'>$size</option>";   
    }

}

if (isset ($_POST["listCTPN"]) && isset ($_POST["tongTien"]) && isset ($_POST["maHangValue"])) {
    
    $daoPhieuNhap = new DAOPhieuNhap();
    $ngayTao = date("Y-m-d"); 
    $tongDon =  $_POST["tongTien"];
    $maHang = $_POST["maHangValue"];
    session_start();
    // Lấy giá trị của $_SESSION['MaTaiKhoan']
    $maTaiKhoan = $_SESSION['MaTaiKhoan'];
    
    $daoPhieuNhap->addPhieuNhap($ngayTao, $tongDon, $maHang, $maTaiKhoan, 0, NULL);

    $ListPN = $daoPhieuNhap->getListFollow();
    $indexSPEnd = count($ListPN) - 1 ;
    $maPN = $ListPN[$indexSPEnd]['MaPhieu'];
    

    $listCTPN = $_POST["listCTPN"];
    $daoCTPN = new DAOChiTietPhieuNhap();
    for ($i=0; $i<count($listCTPN); $i++) {
        $maSP = $listCTPN[$i][0];
        $size = $listCTPN[$i][1];
        $soLuong =  $listCTPN[$i][2];
        $gia =  $listCTPN[$i][3];
        $tongTien =  $listCTPN[$i][4];
        $trangThai = 0;
        $daoCTPN -> addCTPN($maSP,$maPN,$soLuong,  $gia, $tongTien,$trangThai, $size );
    }
    
    echo $maPN;
}





?>