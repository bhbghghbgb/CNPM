<?php
class DAOChiTietPhieuNhap
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $databaseName = 'ql_cuahanggiay';

    private $conn;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        if(!$this->conn){
            $this->conn = mysqli_connect($this->host,$this->username,$this->password,$this->databaseName);
        }
    }
    
    public function disConnect()
    {
        if($this->conn)
            mysqli_close($this->conn);
    }

    public function getList($maphieu)
    {
        $sql = 'SELECT * FROM chitietphieunhap WHERE  MaPhieu ='.$maphieu;
        $data = null;
        if($result = mysqli_query($this->conn,$sql)){
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            mysqli_free_result($result);
            return $data;
        }
        else
            return false;
    }

    public function getListCTPN($maphieu)
    {
        $sql = 'SELECT * FROM chitietphieunhap, sanpham WHERE  chitietphieunhap.MaSP = sanpham.MaSP AND MaPhieu ='.$maphieu;
        $data = null;
        if($result = mysqli_query($this->conn,$sql)){
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            mysqli_free_result($result);
            return $data;
        }
        else
            return false;
    }


    public function getTenHang($MaH){
        $sql = "SELECT Ten FROM hang WHERE MaHang = '".$MaH."'";
        $data = null;
        if($result = mysqli_query($this->conn,$sql)){
            while($row = mysqli_fetch_array($result)){
                $data = $row;
            }
            mysqli_free_result($result);
            return $data;
        }
        else
            return false;

    }

    public function getTenNhanVien($MaNV){
        $sql = "SELECT TenNhanVien FROM NhanVien WHERE  MaTaiKhoan = '".$MaNV."'";
        $data = null;
        if($result = mysqli_query($this->conn,$sql)){
            while($row = mysqli_fetch_array($result)){
                $data = $row;
            }
            mysqli_free_result($result);
            return $data;
        }
        else
            return false;

    }

    public function addCTPN ($MaSP, $MaPhieu, $SoLuong, $GiaNhap, $TongGia, $TrangThai, $Size){

        $sql = "INSERT INTO `chitietphieunhap` ( `MaSP`, `MaPhieu`, `SoLuong`, `GiaNhap`, `TongGia`, `TrangThai`, `Size`) 
        VALUES ('" . $MaSP . "', '" . $MaPhieu . "', '" . $SoLuong . "', '" . $GiaNhap . "', '" . $TongGia . "', '". $TrangThai . "', '" . $Size ."');";
        if (mysqli_query($this->conn, $sql)) {
            return true;
        }
        return false;
    }

    public function deleteCTPN ($maPN) {
        $sql = "DELETE FROM chitietphieuNhap WHERE MaPhieu = '".$maPN."'";
        if (mysqli_query($this->conn, $sql)) {
            return true;
        }
        return false;
    }
}
?>