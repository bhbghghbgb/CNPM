<?php
include_once("DataBaseConfig.php");
class DAOHang extends DatabaseConfig{

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
    public function getTenTheoMa($maHang){
        $sql = "SELECT Ten FROM hang where MaHang = '$maHang'";
        if($result = mysqli_query($this->conn,$sql)){
            $row=mysqli_fetch_array($result);
            return $row["Ten"];
        }
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
    public function hasHangSP ($MaHang) {
        $sql = "SELECT * FROM sanpham WHERE MaHang = '".$MaHang."'";
        $data=null;
        if($result = mysqli_query($this->conn,$sql)){
            while($row=mysqli_fetch_array($result)){
                    $data[] = $row;
            }
            mysqli_free_result($result);
        }
        if ($data ==null) {
            return true;
        } else {
            return false;
        } 
        
    }
    
    public function deleteHang($MaHang){
        if ($this->hasHangSP($MaHang) == true) { 

        $sql = "UPDATE hang SET TrangThai = 0 WHERE MaHang = '".$MaHang."'";
        if($result = mysqli_query($this->conn,$sql)){
            return true;
        } } else {
            return false;
        }
       
    }

   

}
?>