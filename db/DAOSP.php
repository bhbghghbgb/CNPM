<?php
class DAOSP{
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


    public function getList($MaSP) {
        $sql = "SELECT * FROM sanpham WHERE TrangThai=1 AND MaSP = ".$MaSP;
        $data=null;
        if($result = mysqli_query($this->conn,$sql)){
            while($row=mysqli_fetch_array($result)){
                    $data[] = $row;
            }
            mysqli_free_result($result);
        }
        return $data;
    }


    public function getListLienQuan($MaH,$MaSP) {
        $sql = "SELECT * FROM sanpham WHERE TrangThai=1 AND MaHang = '".$MaH."' AND MaSP != ".$MaSP ;
        $data=null;
        if($result = mysqli_query($this->conn,$sql)){
            while($row=mysqli_fetch_array($result)){
                    $data[] = $row;
            }
            mysqli_free_result($result);
        }
        return $data;
    }

    public function getTiLeGiam($MaSP) {
        $sql = "SELECT TiLeGiam FROM sanpham,khuyenmai WHERE MaSP = ".$MaSP." AND sanpham.MaKhuyenMai = khuyenmai.MaKhuyenMai";
        $data=null;
        if($result = mysqli_query($this->conn,$sql)){
            while($row=mysqli_fetch_array($result)){
                    $data[] = $row;
            }
            mysqli_free_result($result);
        }
        return $data[0][0];
    }

    public function getListDanhMuc($MaDM) {
        $sql = "SELECT *, hang.Ten as TenHang FROM sanpham,hang WHERE sanpham.TrangThai=1 AND MaDM = '".$MaDM."' AND sanpham.MaHang = hang.MaHang" ;
        $data=null;
        if($result = mysqli_query($this->conn,$sql)){
            while($row=mysqli_fetch_array($result)){
                    $data[] = $row;
            }
            mysqli_free_result($result);
        }
        return $data;
    }

    public function getListDanhSach($sql) {
        $data=null;
        if($result = mysqli_query($this->conn,$sql)){
            while($row=mysqli_fetch_array($result)){
                    $data[] = $row;
            }
            mysqli_free_result($result);
        }
        return $data;
    } 

    public function getALL() {
        $sql = "SELECT * FROM sanpham ";
        $data=null;
        if($result = mysqli_query($this->conn,$sql)){
            while($row=mysqli_fetch_array($result)){
                    $data[] = $row;
            }
            mysqli_free_result($result);
        }
        return $data;
    }

    public function TruSLBanHang($MaSP, $SoLuongMoi){
        $sql = 'UPDATE sanpham SET SLTonKho = '.$SoLuongMoi.' WHERE MaSP = '.$MaSP;
        if($result = mysqli_query($this->conn,$sql)){
            return true;
        }
        else
            return false;
    }

    public function checkSoLuongTonKho($MaSP) {
        $sql = "SELECT * FROM sanpham WHERE SLTonKho = 0 AND TrangThai=1 AND MaSP = ".$MaSP;
        $data=null;
        if($result = mysqli_query($this->conn,$sql)){
            while($row=mysqli_fetch_array($result)){
                    $data[] = $row;
            }
            mysqli_free_result($result);
        }
        return $data;
    }
}
?>