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
        $sql = 'SELECT MaSP,SoLuong,Gia,TongGia FROM chitietphieunhap WHERE Trangthai=1 AND MaPhieu ='.$maphieu;
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

}
?>