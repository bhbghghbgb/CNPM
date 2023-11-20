<?php
include_once("DataBaseConfig.php");

class DAOThongTinTaiKhoan extends DatabaseConfig
{

    public function getList()
    {
        $sql = "SELECT * FROM taikhoan";
        $data = null;
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $data[] = $row;
            }
            mysqli_free_result($result);
        }
        return $data;
    }
    public function hasKhach($MaTK)
    {
        $sql = "SELECT * FROM khachhang Where MaTaiKhoan = '$MaTK'";
        if ($result = mysqli_query($this->conn, $sql)) {
            if (mysqli_num_rows($result) > 0)
                return true;
            else
                return false;
        }
        return false;
    }
    public function getTaiKhoan($MaTK)
    {
        $sql = "SELECT tk.TenDN ,tk.Email,tk.NgayTao, tk.quyen";
        $join = '';
        if ($this->hasKhach($MaTK)) {
            $sql .= " ,kh.DiaChi , kh.TenKhach as HoTen, kh.SDT ";
            $join = ' left Join khachhang as kh on kh.MaTaiKhoan=tk.MaTaiKhoan ';
        } else {
            $sql .= " ,nv.DiaChi , nv.TenNhanVien as HoTen, nv.SDT ";
            $join = ' inner Join nhanvien as nv on nv.MaTaiKhoan=tk.MaTaiKhoan ';
        }


        $sql .= " FROM taikhoan as tk";
        $sql .= $join." where tk.MaTaiKhoan = $MaTK";
        $data = array();
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $data[] = $row;
            }
            mysqli_free_result($result);
        }
        if ($data)
            return $data[0];
        else
            return null;
    }
    public function insertTaiKhoan($MaTaiKhoan, $TenTaiKhoan, $TenDN, $MatKhau, $Email, $quyen = 'User')
    {
        $MatKhau = md5($MatKhau);
        $sql = "INSERT INTO taikhoan ( `TenDN`, `MatKhau`, `Email`, `NgayTao`, `TinhTrang`, `Quyen`,`TrangThai`) VALUES ('$TenDN','$MatKhau','$Email',CURDATE(),1,'$quyen',1)";
        if ($result = mysqli_query($this->conn, $sql)) {
            return true;
        }
        return false;
    }

    public function deleteTaiKhoan($MaTaiKhoan)
    {
        $sql = "DELETE FROM taikhoan WHERE MaTaiKhoan = '" . $MaTaiKhoan . "'";
        if ($result = mysqli_query($this->conn, $sql)) {
            return true;
        }
        return false;
    }
    public function updateTaiKhoan($MaTaiKhoan, $TenDN, $MatKhau, $Email)
    {
        if ($MatKhau == '') {
            $sql = "UPDATE taikhoan SET TenDN = '$TenDN', Email = '$Email'
             WHERE MaTaiKhoan = '$MaTaiKhoan'";
        } else {
            $MatKhau = md5($MatKhau);
             $sql = "UPDATE taikhoan SET TenDN = '$TenDN', MatKhau = '$MatKhau', Email = '$Email'
             WHERE MaTaiKhoan = '$MaTaiKhoan'";
        }

        
        if ($result = mysqli_query($this->conn, $sql)) {
            return true;
        }
        return false;
    }
    public function updatePassTaiKhoan($MatKhau, $Email)
    {
        $MatKhau = md5($MatKhau);
        $sql = "UPDATE taikhoan SET MatKhau = '$MatKhau'
        WHERE Email = '$Email'";
                
        if ($result = mysqli_query($this->conn, $sql)) {
            return true;
        }
        return false;
    }
    public function hasEmail( $Email)
    {
        $sql = "select * FROM taikhoan
        WHERE Email = '$Email'";
        if($result = mysqli_query($this->conn,$sql)){
            if($result->num_rows != 0){
                return true;
            }
        }
        return false;
    }


    public function insertNhanVien($MaNhanVien, $Quyen, $DiaChi, $TenNhanVien, $SDT, $MaTaiKhoan)
    {
        $sql = "INSERT INTO nhanvien (MaNhanVien, Quyen, DiaChi, TenNhanVien, SDT, MaTaiKhoan, TrangThai) 
            VALUES ('$MaNhanVien', '$Quyen', '$DiaChi', '$TenNhanVien', '$SDT', '$MaTaiKhoan', 1)";

        if ($result = mysqli_query($this->conn, $sql)) {
            return true;
        }

        return false;
    }
    public function updateNhanVien($MaTaiKhoan,$TenNhanVien ,$DiaChi,  $SDT)
    {
        $sql = "UPDATE nhanvien 
            SET  DiaChi = '$DiaChi', TenNhanVien = '$TenNhanVien', SDT = '$SDT'
            WHERE MaTaiKhoan = '$MaTaiKhoan'";

        if ($result = mysqli_query($this->conn, $sql)) {
            return true;
        }

        return false;
    }
    public function deleteNhanVien($MaNhanVien)
    {
        $sql = "DELETE FROM nhanvien WHERE MaNhanVien = '$MaNhanVien'";
        if ($result = mysqli_query($this->conn, $sql)) {
            return true;
        }

        return false;
    }
    public function insertKhachHang($MaKhach, $TenKhach, $DiaChi, $SDT, $MaTaiKhoan)
    {
        $sql = "INSERT INTO khachhang (MaKhach, TenKhach, DiaChi, SDT, MaTaiKhoan, TrangThai) 
            VALUES ('$MaKhach', '$TenKhach', '$DiaChi', '$SDT', '$MaTaiKhoan', 1)";

        if ($result = mysqli_query($this->conn, $sql)) {
            return true;
        }

        return false;
    }
    public function deleteKhachHang($MaTaiKhoan)
    {
        $sql = "DELETE FROM khachhang WHERE MaTaiKhoan = '$MaTaiKhoan'";

        if ($result = mysqli_query($this->conn, $sql)) {
            return true;
        }

        return false;
    }
    public function updateKhachHang($MaTaiKhoan, $TenKhach, $DiaChi, $SDT)
    {
        $sql = "UPDATE khachhang 
            SET TenKhach = '$TenKhach', DiaChi = '$DiaChi', SDT = '$SDT'
            WHERE MaTaiKhoan = '$MaTaiKhoan'";

        if ($result = mysqli_query($this->conn, $sql)) {
            return true;
        }

        return false;
    }

    public function hasTaiKhoan ($taiKhoan) {
        $sql = "SELECT * FROM taikhoan WHERE TrangThai = 1 AND TenDN = '".$taiKhoan."'";
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

    public function LayThongTinNhanVien($maNhanVien){
        $sql = "SELECT * FROM nhanvien WHERE TrangThai = 1 AND MaNhanVien = '$maNhanVien'";
        $data = null;
        if($result = mysqli_query($this->conn, $sql)){
           $data = mysqli_fetch_array($result);
           return $data;
        }
        return null;
    }

    public function LayMaTKKhachHang($maKhachHang){
        $sql = "SELECT * FROM khachhang WHERE TrangThai = 1 AND MaKhach = '$maKhachHang'";
        $data = null;
        if($result = mysqli_query($this->conn, $sql)){
           $data = mysqli_fetch_array($result);
           return $data;
        }
        return null;
    }

    public function hasEmail ($email) {
        $sql = "SELECT * FROM taikhoan WHERE TrangThai = 1 AND Email = '".$email."'";
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
}
?>