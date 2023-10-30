<?php
class DAOGioHang{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'ql_cuahanggiay';

    private $conn;

    public function __construct(){
        $this->connect();
    }

    public function connect(){
        if(!$this->conn){
            $this->conn=mysqli_connect($this->host,$this->username,$this->password,$this->database);
        }
    }

    public function disConnect() {
        if($this->conn){
            mysqli_close($this->conn);
        }
    }

    public function getListGioHang($MaTK) { 
        $sql = "SELECT giohang.MaSP,sanpham.Ten,sosize.GiaBan,sanpham.AnhChinh,giohang.Size,giohang.SoLuong,sosize.SoLuong as SLTonKho FROM giohang,sanpham,sosize WHERE MaTaiKhoan = ". $MaTK." and giohang.MaSP = sanpham.MaSP and sosize.MaSP = sanpham.MaSP and giohang.Size = sosize.Size";
        $data = null;
        if($result = mysqli_query($this->conn,$sql)) {
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            mysqli_free_result($result);
        }
        return $data;
    }

    public function getSL($MaTK) {
        $sql = "SELECT SUM(SoLuong) from giohang where MaTaiKhoan = ".$MaTK;
        $data = null;
if($result = mysqli_query($this->conn,$sql)) {
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            mysqli_free_result($result);
        }
        echo $data[0][0];
    }

    public function addSP($MaTK, $MaSP, $SoLuong, $Size){
        $sql = "INSERT INTO giohang(MaTaiKhoan,MaSP,SoLuong,Size) VALUES ( $MaTK, '$MaSP', $SoLuong,$Size)";
        if($result=mysqli_query($this->conn,$sql)){
            return true;
        }
        return false;
    }

    public function deleteSP($MaTK, $MaSP) {
        $sql = "DELETE FROM giohang WHERE MaTaiKhoan = '$MaTK' AND MaSP = '$MaSP'";
        if($result=mysqli_query($this->conn,$sql)) {
            return true;
        }
        return false;
    }

    public function updateGiohang($MaTK, $MaSP, $SoLuong) {
        $sql = "UPDATE giohang SET SoLuong = '$SoLuong' WHERE MaTaiKhoan = '$MaTK' AND MaSP = '$MaSP'";
        if($result=mysqli_query($this->conn,$sql)){
            return true;
        }
        return false;
    }
}
?>