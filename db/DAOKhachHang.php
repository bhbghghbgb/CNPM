<?php
include_once("DataBaseConfig.php");
class DAOKhachHang extends DatabaseConfig{

    public function LayThongTinKhach($matk){
        $sql = "SELECT * FROM khachhang WHERE MaTaiKhoan = '$matk'";
        $data = null;
        if($result = mysqli_query($this->conn, $sql)){
           $data = mysqli_fetch_array($result);
           return $data;
        }
        return null;
    }
}

?>