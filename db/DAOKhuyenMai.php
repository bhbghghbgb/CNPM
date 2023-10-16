<?php
class DAOKhuyenMai{
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
        $sql = "SELECT * FROM khuyenmai";
        $data=null;
        if($result = mysqli_query($this->conn,$sql)){
            while($row=mysqli_fetch_array($result)){
                if($row[0] != '#'){
                    $data[] = $row;
                }
            }
            mysqli_free_result($result);
        }
        return $data;
    }

    public function hasKM($MaKM){
        $sql = "SELECT * FROM khuyenmai WHERE MaKhuyenMai='".$MaKM."'";
        if($result = mysqli_query($this->conn,$sql)){
            if($result->num_rows != 0){
                return false;
            }
        }
        return true;
    }

    public function insertKM($MaKM,$TenKM,$MoTa,$TiLeGiam){
        $sql = "INSERT INTO khuyenmai (MaKhuyenMai,TenKhuyenMai,MoTa,TiLeGiam) VALUES ('$MaKM', '$TenKM', '$MoTa', '$TiLeGiam')";
        if($result = mysqli_query($this->conn,$sql)){
            return true;
        }
        return false;
    }

    public function updateKM($MaKM,$TenKM,$MoTa,$TiLeGiam){
        $sql = "UPDATE khuyenmai SET TenKhuyenMai = '".$TenKM."' ,MoTa = '".$MoTa."' ,TiLeGiam = ".$TiLeGiam." WHERE MaKhuyenMai = '".$MaKM."'";
        if($result = mysqli_query($this->conn,$sql)){
            return true;
        }
        return false;
    }

    public function hasSP($MaKM){
        $sql = "SELECT * FROM sanpham WHERE TrangThai=1 AND KhuyenMai='".$MaKM."'";
        if($result = mysqli_query($this->conn,$sql)){
            if($result->num_rows != 0){
                return false;
            }
        }
        return true;
    }
    
    public function deleteKM($MaKM){
        $sql = "DELETE FROM khuyenmai WHERE MaKhuyenMai = '".$MaKM."'";
        if($result = mysqli_query($this->conn,$sql)){
            return true;
        }
        return false;
    }
}
?>