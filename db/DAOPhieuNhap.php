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
        $sql = 'SELECT * FROM phieunhaphang where TrangThai=1 ';
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

}
?>