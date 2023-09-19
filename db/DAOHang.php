<?php
class DAOHang{
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

    public function getList(){
        $sql = "SELECT * FROM hang";
        $data=null;
        if($result = mysqli_query($this->conn,$sql)){
            while($row=mysqli_fetch_array($result)){
                if($row['TrangThai'] != 0){
                    $data[] = $row;
                }
            }
            mysqli_free_result($result);
        }
        return $data;
    }

    public function hasHang($MaHang){
        $sql = "SELECT * FROM hang WHERE MaHang='".$MaHang."'";
        if($result = mysqli_query($this->conn,$sql)){
            if($result->num_rows != 0){
                return false;
            }
        }
        return true;
    }

    public function checkHangDaXoa($MaHang){
        $sql = "SELECT * FROM hang WHERE MaHang='".$MaHang."'";
        if($result = mysqli_query($this->conn,$sql)){
            while($row=mysqli_fetch_array($result)){
                if($row['TrangThai'] == 0){
                    return true;
                }
            }
            mysqli_free_result($result);
        }
        return false;
    }



    public function insertHang($MaHang,$Ten,$NgayTao){
        $sql = "INSERT INTO hang (MaHang,Ten,NgayTao,TrangThai) VALUES ('$MaHang', '$Ten','$NgayTao',1)";
        if($result = mysqli_query($this->conn,$sql)){
            return true;
        }
        return false;
    }

    public function updateHang($MaHang,$Ten){
        $sql = "UPDATE hang SET Ten = '".$Ten."' WHERE MaHang = '".$MaHang."'";
        if($result = mysqli_query($this->conn,$sql)){
            return true;
        }
        return false;
    }

    public function insertHangDaXoa($MaHang,$Ten,$NgayTao){
        $sql = "UPDATE hang SET  TrangThai = 1 ,Ten = '".$Ten."',NgayTao = '".$NgayTao."' WHERE MaHang = '".$MaHang."'";
        if($result = mysqli_query($this->conn,$sql)){
            return true;
        }
        return false;
    }
    
    public function deleteHang($MaHang){
        $sql = "UPDATE hang SET TrangThai = 0 WHERE MaHang = '".$MaHang."'";
        if($result = mysqli_query($this->conn,$sql)){
            return true;
        }
        return false;
    }
}
?>