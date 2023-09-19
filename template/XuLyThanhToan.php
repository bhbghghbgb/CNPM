<?php
    session_start();

    include("../db/DAODonHang.php");
    include("../db/DAOChiTietDonHang.php");

    $db = new DAODonHang();
    $db->connect();

    $dbCTHD = new DAOChiTietDonHang();
    $dbCTHD->connect();


    if(!isset($_SESSION['MaTaiKhoan'])){

        echo '<script>alert("Bạn chưa đăng nhập vào hệ thống nên không thanh toán được"); window.location="../GioHang.php";</script>';
    }

    $MaTK =  $_SESSION['MaTaiKhoan'];

    $NgayDat= date("Y-m-d");


    $TongTien = 0 ;

    if(isset($_SESSION['cart'])){
                            
        foreach ($_SESSION['cart'] as $key => $value){
            $TongTien += $value['SL'] * $value['Price'];
        }
    }

    if($db->Insert($MaTK,$NgayDat,$TongTien)){
        $MaDon = $db->getMaDon();
        foreach ($_SESSION['cart'] as $key => $value){
            $ThanhTien = $value['SL'] * $value['Price'];
            if($dbCTHD->Insert($value['ID'],$MaDon[0],$value['SL'],$value['Price'],$ThanhTien)){

            }
            else{
                echo "Error" . $value['ID'];
            }
        }
        unset($_SESSION['cart']);
        echo "<script>window.location='../admin/template/template_content/ChiTietDonHang.php?PQ=User&CT=$MaDon[0]&MaTK=$MaTK&Date=$NgayDat&TT=$TongTien';</script>";
        
    }
    else{
        echo '<script>alert("Tạo đơn thất bại"); window.location="../GioHang.php";</script>';
    }
    
?>