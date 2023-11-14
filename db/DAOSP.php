<?php
include_once("DataBaseConfig.php");
class DAOSP extends DatabaseConfig
{

    private $conn;

    public function __construct()
    {
        $this->connect();
    }

    public function connect()
    {
        if (!$this->conn) {
            $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
        }
    }

    public function disConnect()
    {
        if ($this->conn) {
            mysqli_close($this->conn);
        }
    }


    public function getSP($MaSP)
    {
        $sql = "SELECT * FROM sanpham WHERE TrangThai=1 AND MaSP = " . $MaSP;
        $data = array();
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                //Lấy giá thấp nhất để hiển thị và gán váo biến rowGia
                $sqltGia = 'SELECT MIN(GiaBan)FROM sosize  WHERE MaSP = "' . $row['MaSP'] . '"';
                $resultGia = mysqli_query($this->conn, $sqltGia);
                $rowGia = mysqli_fetch_assoc($resultGia);
                if($rowGia['MIN(GiaBan)']){
                    
                    //lấy list bao gồm số lượng và số size của sản phẩm có giá nhỏ nhất
                    $sqlSoLuong = 'SELECT SoLuong,Size FROM sosize WHERE MaSP = "' . $row['MaSP'] . '" AND GiaBan=' . $rowGia['MIN(GiaBan)'];
                    
                    $resultSoLuong = mysqli_query($this->conn, $sqlSoLuong);
                    if ($resultSoLuong) {
                        $rowSoLuong = mysqli_fetch_array($resultSoLuong);
                        $row['GiaMin'] = $rowGia['MIN(GiaBan)'];
                        $row['SoLuong'] = $rowSoLuong['SoLuong'];
                        $row["Size"] = $rowSoLuong['Size'];
                        $data[] = $row;
                    }
                }else{
                    $row["GiaMin"] = null;
                    $data[] = $row;

                }
            }
        }
        return $data[0];
    }
    public function getListSize($MaSP)
    {
        $sql = "SELECT * FROM sosize WHERE MaSP = " . $MaSP;
        $data = array();
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $data[] = $row;
            }
            mysqli_free_result($result);
        }
        return $data;
    }


    public function getListLienQuan($MaH, $MaSP)
    {
        $sql = "SELECT * FROM sanpham WHERE TrangThai=1 AND MaHang = '" . $MaH . "' AND MaSP != " . $MaSP;
        $data = null;
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $selectGia = 'SELECT MIN(GiaBan) FROM sosize  WHERE MaSP = "' . $row['MaSP'] . '"';
                $resultGia = mysqli_query($this->conn, $selectGia);
                $rowGia = mysqli_fetch_assoc($resultGia);
                $row['GiaMin'] = $rowGia['MIN(GiaBan)'];
                $data[] = $row;
            }
            mysqli_free_result($result);
        }
        return $data;
    }

    public function getTiLeGiam($MaSP)
    {
        $sql = "SELECT TiLeGiam FROM sanpham,khuyenmai WHERE MaSP = " . $MaSP . " AND sanpham.MaKhuyenMai = khuyenmai.MaKhuyenMai";
        $data = null;
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $data[] = $row;
            }
            mysqli_free_result($result);
        }
        return $data[0][0];
    }

    public function getTenSanPham($MaSP) {
        $sql = "SELECT Ten FROM sanpham WHERE MaSP = '$MaSP'";
        $data = null;
        if($result = mysqli_query($this->conn,$sql)) {
            while($row = mysqli_fetch_array($result)){
                $data[] = $row;
            }
            mysqli_free_result($result);
        }
        return $data[0];
    }
    public function getThongTinSanPham($MaSP,$Size) {
        $sql = "SELECT sanpham.MaSP,Ten,GiaBan,AnhChinh,SoLuong as SLTonKho,Size FROM sanpham,sosize where sanpham.MaSP = sosize.MaSP and sanpham.MaSP = '$MaSP' and sosize.Size = '$Size'";
        $data = null;
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $data[] = $row;
            }
            mysqli_free_result($result);
        }
        return $data[0];
    }

    public function getListDanhMuc($MaDM)
    {
        $sql = "SELECT *, hang.Ten as TenHang FROM sanpham,hang WHERE sanpham.TrangThai=1 AND MaDM = '" . $MaDM . "' AND sanpham.MaHang = hang.MaHang";
        $data = null;
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $selectGia = 'SELECT MIN(GiaBan) FROM sosize  WHERE MaSP = "' . $row['MaSP'] . '"';
                $resultGia = mysqli_query($this->conn, $selectGia);
                $rowGia = mysqli_fetch_assoc($resultGia);
                $row['GiaMin'] = $rowGia['MIN(GiaBan)'];
                $data[] = $row;
            }
            mysqli_free_result($result);
        }
        return $data;
    }

    public function getListDanhSach($sql)
    {
        $data = null;
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $selectGia = 'SELECT MIN(GiaBan) FROM sosize  WHERE MaSP = "' . $row['MaSP'] . '"';
                $resultGia = mysqli_query($this->conn, $selectGia);
                $rowGia = mysqli_fetch_assoc($resultGia);
                $row['GiaMin'] = $rowGia['MIN(GiaBan)'];
                $data[] = $row;
            }
            mysqli_free_result($result);
        }
        return $data;
    }

    public function getALL()
    {
        $sql = "SELECT * FROM sanpham where TrangThai = 1 ";
        $data = null;
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $data[] = $row;
            }
            mysqli_free_result($result);
        }
        return $data;
    }
    public function getAllID()
    {
        $sql = "SELECT MaSP FROM sanpham ";
        $data = array();
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $data[] = $row['MaSP'];
            }
        }
        return $data;
    }

    public function TruSLBanHang($MaSP,$Size, $SoLuongMoi)
    {
        $sql = "UPDATE sosize SET SoLuong = $SoLuongMoi WHERE MaSP = $MaSP AND Size = $Size";
        echo $sql;
        if ($result = mysqli_query($this->conn, $sql)) {
            return true;
        } else
            return false;
    }

    public function checkSoLuongTonKho($MaSP)
    {
        $sql = "SELECT * FROM sanpham WHERE SLTonKho = 0 AND TrangThai=1 AND MaSP = " . $MaSP;
        $data = null;
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $data[] = $row;
            }
            mysqli_free_result($result);
        }
        return $data;
    }
    public function insertSP($MaSP, $Ten, $MaKhuyenMai, $AnhChinh, $MaDM, $MoTa, $MaHang)
    {
        $sql = "INSERT INTO `sanpham` (`MaSP`, `Ten`, `MaKhuyenMai`, `AnhChinh`, `MaDM`, `MoTa`, `MaHang`,`TrangThai`) 
        VALUES ('" . $MaSP . "', '" . $Ten . "', '" . $MaKhuyenMai . "', '". $AnhChinh . "', '" . $MaDM . "', '" . $MoTa . "', '" . $MaHang . "','1');";
        if (mysqli_query($this->conn, $sql)) {
            return true;
        }
        return false;
    }

    public function deleteSP($MaSP)
    {
        $sql = "UPDATE sanpham SET TrangThai=0 where  MaSP = '" . $MaSP . "'";
        if (mysqli_query($this->conn, $sql)) {
            return true;
        }
        return false;
    }
    public function updateSP($MaSP, $Ten, $MaKhuyenMai, $AnhChinh, $MaDM, $MoTa, $MaHang)
    {
        $sql = "UPDATE `sanpham` SET `Ten` = '" . $Ten . "',`MaKhuyenMai` = '" . $MaKhuyenMai . "',`AnhChinh` = '" . $AnhChinh . "', `MaDM` = '" . $MaDM . "', `MoTa` = '" . $MoTa . "',  `MaHang` = '" . $MaHang . "' WHERE `MaSP` = '" . $MaSP . "'";
        if (mysqli_query($this->conn, $sql)) {
            return true;
        }
        return false;
    }
    public function findSP($properties, $value)
    {
        $sql = "SELECT * FROM sanpham WHERE $properties LIKE '%$value%' AND TrangThai = 1";
        $data = array();
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $data[] = $row;
            }
            mysqli_free_result($result);
        }
        return $data;
    }
    public function getListSP($MaSP)
    {
        $sql = "SELECT * FROM sanpham WHERE TrangThai=1 AND MaSP = " . $MaSP;
        $data = array();
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $data[] = $row;
            }

            mysqli_free_result($result);
        }
        return $data[0];
    }
    // if sort = 1 asc else desc
    public function getList1($OderBy = null, $sort = null)
    {
        $data = array();
        if ($OderBy)
            if ($sort == 1)
                $sql = "SELECT * FROM sanpham WHERE TrangThai=1 ORDER BY `sanpham`.`" . $OderBy . "` ASC";
            else
                $sql = "SELECT * FROM sanpham WHERE TrangThai=1 ORDER BY `sanpham`.`" . $OderBy . "` DESC";
        else
            $sql = "SELECT * FROM sanpham WHERE TrangThai=1";
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $data[] = $row;
            }
            mysqli_free_result($result);
        }
        return $data;
    }
    public function getListSPFollow($maHang)
    {
        $sql = "SELECT * FROM sanpham WHERE TrangThai=1 AND MaHang = '" . $maHang . "'";
        $data = null;
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $data[] = $row;
            }
            mysqli_free_result($result);
        }
        return $data;

    }
}
?>