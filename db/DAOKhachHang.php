<?php
include_once("DataBaseConfig.php");
class DAOKhachHang extends DatabaseConfig{

    public function LayThongTinKhach($matk){
        $sql = "SELECT * FROM khachhang WHERE MaTaiKhoan = '$matk'";
        $data = null;
        if($result = mysqli_query($this->conn, $sql)){
           $data = mysqli_fetch_array($result);
           if($data!=null)
           return $data;
        }

        // nếu khách hàng là nhân viên
        $sql = "SELECT * FROM nhanvien WHERE MaTaiKhoan = '$matk'";
        if($result = mysqli_query($this->conn, $sql)){
            $row = mysqli_fetch_array($result);
            $data[0] = $row['MaNhanVien'];
            $data[1] = $row['TenNhanVien'];
            $data[2] = $row['DiaChi'];
            $data[3] = $row['SDT'];
            return $data;
         }
 
        return null;
    }
}

?>