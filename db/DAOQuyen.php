<?php
class DAOQuyen{
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


    public function getList() {
        $sql = "SELECT * FROM quyen";
        $data=null;
        if($result = mysqli_query($this->conn,$sql)){
            while($row=mysqli_fetch_array($result)){
                    $data[] = $row;
            }
            mysqli_free_result($result);
        }
        return $data;
    }

    public function hasQuyen($MaQuyen){
        $sql = "SELECT * FROM quyen WHERE MaQuyen='".$MaQuyen."'";
        if($result = mysqli_query($this->conn,$sql)){
            if($result->num_rows != 0){
                return false;
            }
        }
        return true;
    }

    public function insertQuyen($MaQuyen,$TenQuyen){
        $sql = "INSERT INTO quyen (MaQuyen,TenQuyen) VALUES ('$MaQuyen', '$TenQuyen')";
        if($result = mysqli_query($this->conn,$sql)){
            return true;
        }
        return false;
    }

    public function deleteQuyen($MaQuyen){
        $sql = "DELETE FROM quyen WHERE MaQuyen = '".$MaQuyen."'";
        if($result = mysqli_query($this->conn,$sql)){
            return true;
        }
        return false;
    }
}
?>