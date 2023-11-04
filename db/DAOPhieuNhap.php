<?php
class DAOPhieuNhap
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

    public function getList()
    {
        $sql = 'SELECT * FROM phieunhaphang';
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

    public function getPN($maPN)
    {
        $sql = 'SELECT *, phieunhaphang.NgayTao AS "NgayTaoPN" FROM phieunhaphang, hang, nhanvien  WHERE phieunhaphang.MaHang = hang.MaHang AND phieunhaphang.MaTaiKhoan = nhanvien.MaTaiKhoan AND MaPhieu = '.$maPN;
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

    public function getListFollow()
    {
        $sql = 'SELECT *, phieunhaphang.TrangThai AS "TrangThaiPN",  phieunhaphang.NgayTao AS "NgayTaoPN" FROM phieunhaphang, hang, nhanvien WHERE phieunhaphang.MaHang = hang.MaHang AND phieunhaphang.MaTaiKhoan = nhanvien.MaTaiKhoan ORDER BY phieunhaphang.MaPhieu; ';
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

    public function Loc($from,$to){
        $sql = "SELECT * FROM phieunhaphang WHERE NgayTao between '$from' AND '$to'";
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

    public function addPhieuNhap ( $NgayTao, $TongDon, $MaHang, $MaTaiKhoan, $TrangThai, $GhiChu){
        $sql = "INSERT INTO `phieunhaphang` ( `NgayTao`, `TongDon`, `MaHang`, `MaTaiKhoan`, `TrangThai`, `GhiChu`) 
        VALUES ('" . $NgayTao . "', '" . $TongDon . "', '" . $MaHang . "', '" . $MaTaiKhoan . "', '" . $TrangThai . "', '" . $GhiChu ."');";
        if (mysqli_query($this->conn, $sql)) {
            return true;
        }
        return false;
    }

    public function updateTrangThaiPN ($TrangThai, $MaPN)
    {
        $sql = "UPDATE `phieunhaphang` SET `TrangThai` = '" . $TrangThai . "' WHERE `MaPhieu` = '" . $MaPN ."'";
        if (mysqli_query($this->conn, $sql)) {
            return true;
        }
        return false;
    }

    public function deletePhieuNhap ($maPN) {
        $sql = "DELETE FROM phieunhaphang WHERE MaPhieu = '".$maPN."'";
        if (mysqli_query($this->conn, $sql)) {
            return true;
        }
        return false;
    }


    public function LocTheoKhoangTG ($DateStart, $DateEnd){
        $sql = 'SELECT *, phieunhaphang.TrangThai AS "TrangThaiPN",  phieunhaphang.NgayTao AS "NgayTaoPN" FROM phieunhaphang, hang, nhanvien WHERE phieunhaphang.MaHang = hang.MaHang AND phieunhaphang.MaTaiKhoan = nhanvien.MaTaiKhoan AND phieunhaphang.NgayTao >= "'.$DateStart.'" AND phieunhaphang.NgayTao <= "'.$DateEnd.'" ORDER BY phieunhaphang.MaPhieu; ';
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

    // SELECT * FROM phieunhaphang WHERE NgayTao >= '2023-11-08' AND NgayTao <= '2023-11-10';
    // SELECT *, phieunhaphang.TrangThai AS "TrangThaiPN",  phieunhaphang.NgayTao AS "NgayTaoPN" FROM phieunhaphang, hang, nhanvien WHERE phieunhaphang.MaHang = hang.MaHang AND phieunhaphang.MaTaiKhoan = nhanvien.MaTaiKhoan AND phieunhaphang.NgayTao >= "'.$DateStart.'" AND phieunhaphang.NgayTao <= "'.$DateEnd.'" ORDER BY phieunhaphang.MaPhieu; 
}

?>