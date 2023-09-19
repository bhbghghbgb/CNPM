<?php
class DAODonHang
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

    public function getList($table)
    {
        $sql = 'SELECT * FROM '.$table;
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

    public function xulyDon($madon){
        $sql = 'UPDATE donhang SET TrangThai = 1 WHERE MaDonHang = '.$madon;
        if($result = mysqli_query($this->conn,$sql)){
            return true;
        }
        else
            return false;
    }
    public function Loc($from,$to){
        $sql = "SELECT * FROM donhang WHERE NgayDat between '$from' AND '$to'";
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

    public function Insert($MaTK,$NgayDat,$TongTien){
        $sql = "INSERT INTO donhang (MaTaiKhoan,NgayDat,TrangThai,TongTien) VALUES ('$MaTK','$NgayDat',0,'$TongTien')";
        if($result = mysqli_query($this->conn,$sql)){
            return true;
        }
        else
            return false;
    
    }

    public function getMaDon(){
        $sql = 'SELECT MAX(MaDonHang) FROM donhang';
        $data = null;
        if($result = mysqli_query($this->conn,$sql)){
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            mysqli_free_result($result);
            return $data[0];
        }
    }

    public function getListDaDat($sql){
        $data = null;
        if($result = mysqli_query($this->conn,$sql)){
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            mysqli_free_result($result);
            return $data;
        }
    }
}
?>