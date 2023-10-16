<?php
class DAOKhachHang{

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
           $this->conn =  mysqli_connect($this->host,$this->username,$this->password,$this->database);
        }
    }

    public function disConnect(){
        if($this->conn){
            mysqli_close($this->conn);
        }
    }

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