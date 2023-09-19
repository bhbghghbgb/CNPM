<?php
class DAOChiTietDonHang
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

    public function getList($madon)
    {
        $sql = 'SELECT MaSP,SoLuong,Gia,TongTien FROM chitietdonhang WHERE MaDonHang ='.$madon;
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

    public function Insert($MaSP,$MaDon,$SoLuong,$Gia,$ThanhTien){
        $sql = "INSERT INTO chitietdonhang (MaSP,MaDonHang,SoLuong,Gia,TongTien) VALUES ('$MaSP','$MaDon',$SoLuong,$Gia,$ThanhTien)";
        if($result = mysqli_query($this->conn,$sql)){
            return true;
        }
        else
            return false;
    
    }
}
?>