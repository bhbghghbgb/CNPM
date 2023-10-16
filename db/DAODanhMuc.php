<?php
class DAODanhMuc{
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
        $sql = "SELECT * FROM danhmuc";
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

    public function hasDanhMuc($MaDanhMuc){
        $sql = "SELECT * FROM danhmuc WHERE MaDM='".$MaDanhMuc."'";
        if($result = mysqli_query($this->conn,$sql)){
            if($result->num_rows != 0){
                return true;
            }
        }
        return false;
    }

    public function checkDanhMucDaXoa($MaDanhMuc){
        $sql = "SELECT * FROM danhmuc WHERE MaDM='".$MaDanhMuc."'";
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



    public function insertDanhMuc($MaDanhMuc,$Ten){
        $sql = "INSERT INTO danhmuc (MaDM,TenDM,TrangThai) VALUES ('$MaDanhMuc', '$Ten',1)";
        if($result = mysqli_query($this->conn,$sql)){
            return true;
        }
        return false;
    }

    public function updateDanhMuc($MaDanhMuc,$Ten){
        $sql = "UPDATE danhmuc SET TenDM = '".$Ten."' WHERE MaDM = '".$MaDanhMuc."'";
        if($result = mysqli_query($this->conn,$sql)){
            return true;
        }
        return false;
    }

    public function insertDanhMucDaXoa($MaDanhMuc,$Ten){
        $sql = "UPDATE danhmuc SET  TrangThai = 1 ,TenDM = '".$Ten."' WHERE MaDM = '".$MaDanhMuc."'";
        if($result = mysqli_query($this->conn,$sql)){
            return true;
        }
        return false;
    }
    
    public function deleteDanhMuc($MaDanhMuc){
        $sql = "UPDATE danhmuc SET TrangThai = 0 WHERE MaDM = '".$MaDanhMuc."'";
        if($result = mysqli_query($this->conn,$sql)){
            return true;
        }
        return false;
    }
}
?>