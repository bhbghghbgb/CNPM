<?php
include_once("DataBaseConfig.php");
class DAOChiTietPhieuNhap extends DatabaseConfig
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
        if ($this->conn)
            mysqli_close($this->conn);
    }

    public function getList($maphieu)
    {
        $sql = 'SELECT * FROM chitietphieunhap WHERE  MaPhieu =' . $maphieu;
        $data = null;
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $data[] = $row;
            }
            mysqli_free_result($result);
            return $data;
        } else
            return false;
    }

    public function getListCTPN($maphieu)
    {
        $sql = 'SELECT * FROM chitietphieunhap, sanpham WHERE  chitietphieunhap.MaSP = sanpham.MaSP AND MaPhieu =' . $maphieu;
        $data = null;
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $data[] = $row;
            }
            mysqli_free_result($result);
            return $data;
        } else
            return false;
    }


    public function getTenHang($MaH)
    {
        $sql = "SELECT Ten FROM hang WHERE MaHang = '" . $MaH . "'";
        $data = null;
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $data = $row;
            }
            mysqli_free_result($result);
            return $data;
        } else
            return false;

    }

    public function getTenNhanVien($MaNV)
    {
        $sql = "SELECT TenNhanVien FROM NhanVien WHERE  MaTaiKhoan = '" . $MaNV . "'";
        $data = null;
        if ($result = mysqli_query($this->conn, $sql)) {
            while ($row = mysqli_fetch_array($result)) {
                $data = $row;
            }
            mysqli_free_result($result);
            return $data;
        } else
            return false;

    }

    public function addCTPN($MaSP, $MaPhieu, $SoLuong, $GiaNhap, $TongGia, $TrangThai, $Size)
    {

        $sql = "INSERT INTO `chitietphieunhap` ( `MaSP`, `MaPhieu`, `SoLuong`, `GiaNhap`, `TongGia`, `TrangThai`, `Size`) 
        VALUES ('" . $MaSP . "', '" . $MaPhieu . "', '" . $SoLuong . "', '" . $GiaNhap . "', '" . $TongGia . "', '" . $TrangThai . "', '" . $Size . "');";
        if (mysqli_query($this->conn, $sql)) {
            return true;
        }
        return false;
    }

    public function deleteCTPN($maPN)
    {
        $sql = "DELETE FROM chitietphieuNhap WHERE MaPhieu = '" . $maPN . "'";
        if (mysqli_query($this->conn, $sql)) {
            return true;
        }
        return false;
    }
    public function TongSanPhamNhap()
    {
        $data = 0;
        $data = new DataProvider();
        $sql = "SELECT SUM(SoLuong) AS TongSanPhamDaNhap FROM chitietphieunhap";
        $result = $data->executeQuery($sql);
        if ($result)
            while ($row = mysqli_fetch_array($result)) {
                $data = $row["TongSanPhamDaNhap"];
            }
        return $data;
    }
    public function ListDoanhThu($year = true, $quarter = null)
    {
        $dataPRO = new DataProvider();
        if ($year && $quarter == null) {
            $sql = "SELECT YEAR(NgayTao) AS Nam ,QUARTER(NgayTao) AS Quy, SUM(TongDon) AS TongDoanhThu 
            FROM phieunhaphang WHERE TrangThai = 1 
            GROUP BY YEAR(NgayTao),QUARTER(NgayTao);";
            $result = $dataPRO->executeQuery($sql);
            $data = [
                ["Quy" => 1, "TongDoanhThu" => 0],
                ["Quy" => 2, "TongDoanhThu" => 0],
                ["Quy" => 3, "TongDoanhThu" => 0],
                ["Quy" => 4, "TongDoanhThu" => 0]

            ];
            if ($result) {
                while ($row = mysqli_fetch_array($result)) {
                    $data[$row["Quy"] - 1]["TongDoanhThu"] = $row["TongDoanhThu"];
                }
            }
        } else {
            $sql = "SELECT 
            MONTH(NgayTao) AS Thang,
            SUM(TongDon) AS TongDoanhThu
        FROM  phieunhaphang
        WHERE TrangThai = 1
        AND MONTH(NgayTao) IN (" . $quarter * 3 - 2 . " ," . $quarter * 3 - 1 . ", " . $quarter * 3 . ")
        GROUP BY 
        MONTH(NgayTao)";
            $result = $dataPRO->executeQuery($sql);
            $data = [
                ["Thang" => $quarter * 3 - 2, "TongDoanhThu" => 0],
                ["Thang" => $quarter * 3 - 1, "TongDoanhThu" => 0],
                ["Thang" => $quarter * 3, "TongDoanhThu" => 0]
            ];

            if ($result) {
                while ($row = mysqli_fetch_array($result)) {
                    $data[$row['Thang'] - ($quarter - 1) * 3 - 1]["TongDoanhThu"] = $row["TongDoanhThu"];
                }
            }
        }

        return $data;
    }
    public function ListPhanTram($hang = null, )
    {
        $dataPRO = new DataProvider();
        if ($hang)
            $sql = "SELECT sanpham.Ten, SUM(chitietphieunhap.SoLuong) AS TongSoLuong 
            FROM chitietphieunhap JOIN sanpham ON chitietphieunhap.MaSP = sanpham.MaSP 
            JOIN phieunhaphang ON chitietphieunhap.MaPhieu = phieunhaphang.MaPhieu
            WHERE phieunhaphang.MaHang = '$hang'
            GROUP BY chitietphieunhap.MaSP;";
        else
            $sql = "SELECT sanpham.Ten, SUM(chitietphieunhap.SoLuong) AS TongSoLuong
            FROM chitietphieunhap
            JOIN sanpham ON chitietphieunhap.MaSP = sanpham.MaSP
            GROUP BY chitietphieunhap.MaSP";
        $result = $dataPRO->executeQuery($sql);
        if ($result)
            while ($row = mysqli_fetch_array($result)) {
                $data[] = $row;
            }
        return $data;
    }
    public function ListPhanTramTungHang($type = true, $quarter = null)
    {
        $dataPRO = new DataProvider();
        $sql = "SELECT hang.Ten AS TenHang, SUM(chitietphieunhap.SoLuong) AS TongSoLuong
        FROM chitietphieunhap
        JOIN sanpham ON chitietphieunhap.MaSP = sanpham.MaSP
        JOIN hang ON sanpham.MaHang = hang.MaHang
        GROUP BY hang.Ten;";
        $result = $dataPRO->executeQuery($sql);
        if ($result)
            while ($row = mysqli_fetch_array($result)) {
                $data[] = $row;
            }
        return $data;
    }
}
?>