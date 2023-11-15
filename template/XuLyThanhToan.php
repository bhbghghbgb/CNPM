<?php
    session_start();

    include("../db/DAODonHang.php");
    include("../db/DAOChiTietDonHang.php");
    include("../db/DAO/DataProvider.php");
    include("../db/DAOGioHang.php");
    include("../db/DAOSP.php");
    $db = new DAODonHang();
    $db->connect();

    $dbCTHD = new DAOChiTietDonHang();
    // $dbCTHD->connect();
    $dbGH = new DAOGioHang();
    $dbGH->connect();
    $dbSP = new DAOSP();
    $dbSP->connect();
    if(!isset($_SESSION['MaTaiKhoan'])){

        echo '<script>alert("Bạn chưa đăng nhập vào hệ thống nên không thanh toán được"); window.location="../giohang.php";</script>';
    }

    $MaTK =  $_SESSION['MaTaiKhoan'];

    $NgayDat= date("Y-m-d");

    function TinhTienGiam($TiLegiam, $GiaBan)
    {
        return $GiaBan - $GiaBan * $TiLegiam / 100;
    }
    

    $TongTien = 0 ;
    $listGH = $dbGH->getListGioHang($MaTK);
    if($listGH!=null) {
        foreach ($listGH as $key => $value) {
            $TiLegiam = $dbSP->getTiLeGiam($value["MaSP"]);
            $listGH[$key]["GiaBan"] = TinhTienGiam($TiLegiam, $value["GiaBan"]);
            $TongTien += $value['SoLuong'] * $listGH[$key]["GiaBan"];
        }  
    }
    if($db->Insert($MaTK,$NgayDat,$TongTien)){
        $MaDon = $db->getMaDon();
        if($listGH!=null){
            foreach ($listGH as $key => $value){
                $ThanhTien = $value['SoLuong'] * $value['GiaBan'];
                if($dbCTHD->Insert($value['MaSP'],$MaDon[0],$value['SoLuong'],$value['GiaBan'],$ThanhTien,$value['Size'])){
                }
                else{
                    echo "Error" . $value['MaSP'];
                }
            }
            $dbGH->deleteAll($MaTK);
        }
        echo "<script>window.location='../admin/template/template_content/ChiTietDonHang.php?PQ=User&CT=$MaDon[0]&MaTK=$MaTK&Date=$NgayDat&TT=$TongTien';</script>";
    }
    else{
        echo '<script>alert("Tạo đơn thất bại"); window.location="../giohang.php";</script>';
    }
?>