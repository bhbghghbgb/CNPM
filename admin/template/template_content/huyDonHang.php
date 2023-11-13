<?php
include("../../../db/DAOChiTietDonHang.php");
include("../../../db/DAO/DataProvider.php");
include("../../../db/DAODonHang.php");

if (isset($_GET['MaDon'])) {
    $MaDon = $_GET['MaDon'];
    $dbCTDH = new DAOChiTietDonHang();
    $dbDH = new DAODonHang();
    $dbDH->connect();
    if($dbCTDH->RemoveAll($MaDon) && $dbDH->Remove($MaDon)){
        echo "<script>alert('Hủy thành công đơn ".$MaDon."!')</script>";
        if (isset($_GET['pq'])) {
            echo "<script>window.location='index.php?id=dh'</script>";
        } else {
            echo "<script>window.location='GioHang.php'</script>";
        }    
    }else{
        echo "<script>alert('Hủy thất bại!')</script>";
    }
}
?>



