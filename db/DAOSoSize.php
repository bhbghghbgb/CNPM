<?php
include_once("DataBaseConfig.php");
class DAOSoSize extends DatabaseConfig
{
    public function getSoSize($MaSP) {
        $sql = "SELECT * FROM sosize Where MaSP='".$MaSP."'";
        $data=null;
        if($result = mysqli_query($this->conn,$sql)){
            while($row=mysqli_fetch_array($result)){
                    $data[] = $row;
            }
            mysqli_free_result($result);
        }
        return $data;
    }
    
    public function getSLSoSize($MaSP) {
        $sql = "SELECT SoLuong FROM sosize WHERE MaSP='" . $MaSP . "'";
        $result = mysqli_query($this->conn, $sql);
        $count=0;
        if ($result) {
            while($row=mysqli_fetch_array($result)){
               $count+= $row["SoLuong"];
        }
        }
        return $count;
    }
    public function hasSize($MaSP) {
        $sql = "SELECT COUNT(*) FROM sosize WHERE MaSP='" . $MaSP . "'";
        $result = mysqli_query($this->conn, $sql);
        if ($result) {
            $count = mysqli_fetch_row($result)[0]; // Lấy giá trị đếm từ kết quả
            if ($count == 0) {
                return false;
            }
        }
        
        return true;
    }
    public function insertSozise($MaSP,$Size,$SoLuong,$GiaBan){
        $sql = "INSERT INTO `sosize` (`MaSP`, `SoLuong`, `Size`, `GiaBan`) VALUES ('".$MaSP."','".$SoLuong."','".$Size."','".$GiaBan."')";
        if(mysqli_query($this->conn,$sql)){
            return true;
        }
        return false;
    }

    public function deleteSosize($MaSP,$Size){
        $sql = "DELETE FROM sosize WHERE MaSP = '".$MaSP."'AND Size ='".$Size."'";
        if(mysqli_query($this->conn,$sql)){
            return true;
        }
        return false;
    }
    public function deleteAllSozsize($MaSP){
        $sql = "DELETE FROM sosize WHERE MaSP = '".$MaSP."'";
        if(mysqli_query($this->conn,$sql)){
            return true;
        }
        return false;
    }
    public function editSozise($MaSP,$Size,$SoLuong=0,$GiaBan=0){
        $sql = "UPDATE `sosize` SET `SoLuong` = '".$SoLuong."' , `GiaBan` = '".$GiaBan."' WHERE `MaSP` = '".$MaSP."' AND `Size` = '".$Size."'";
        if(mysqli_query($this->conn,$sql)){
            return true;
        }
        return false;
    }

    public function updateSoLuong ($maSP, $size,$soLuongAdd) {
        $sql = "UPDATE `sosize` SET `SoLuong` = SoLuong + '".$soLuongAdd."' WHERE `MaSP` = '".$maSP."' AND `Size` = '".$size."'";
        
        if(mysqli_query($this->conn,$sql)){
            return true;
        }
        return false;
    } 
}
?>