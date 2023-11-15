<?php
include("DTO/DTOChiTietDonHang.php");
class DAOChiTietDonHang
{
    private $table = "chitietdonhang";
    public function getList($madon)
    {
        $ctdhs = array();
        $data = new DataProvider();
        $result = $data->Select($this->table, "MaDonHang = $madon");
        if ($result) {
            while ($row = mysqli_fetch_array($result)) {
                $ctdh = new DTOChiTietDonHang();
                $ctdh->setGiaBan($row['GiaBan']);
                $ctdh->setMaSanPham($row['MaSP']);
                $ctdh->setMaDonHang($row['MaDonHang']);
                $ctdh->setTongTien($row['TongTien']);
                $ctdh->setSoLuong($row['SoLuong']);
                $ctdh->setSize($row['Size']);
                $ctdhs[] = $ctdh;
            }
            return $ctdhs;
        }
        return $result;
    }
    public function Insert($MaSanPham, $MaDonHang, $SoLuong, $GiaBan, $TongTien, $Size)
    {
        $data = new DataProvider();

        $ColumnValues['MaSP'] = $MaSanPham;
        $ColumnValues['MaDonHang'] = $MaDonHang;
        $ColumnValues['SoLuong'] = $SoLuong;
        $ColumnValues['GiaBan'] = $GiaBan;
        $ColumnValues['TongTien'] = $TongTien;
        $ColumnValues['Size'] = $Size;

        $result = $data->Insert($this->table, $ColumnValues);
        if ($result) {
            return true;
        } else
            return false;
    }
    public function Remove($MaSP, $MaDonHang)
    {
        $data = new DataProvider();
        $result = $data->Delete($this->table, "MaSP=$MaSP AND MaDonHang=$MaDonHang");
        if ($result)
            return true;
        else
            return false;
    }

    public function RemoveAll($MaDonHang){
        $data = new DataProvider();
        $result = $data->Delete($this->table, "MaDonHang=$MaDonHang");
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function TongSanPhamBan()
    {
        $data = 0;
        $data = new DataProvider();
        $sql = "SELECT SUM(SoLuong) AS TongSanPhamDaBan FROM chitietdonhang";
        $result = $data->executeQuery($sql);
        if ($result)
            while ($row = mysqli_fetch_array($result)) {
                $data = $row["TongSanPhamDaBan"];
            }
        return $data;
    }
    // nếu year đúng thì xếp theo bảng doanh thu theo quý
    public function ListDoanhThu($year = true, $quarter = null)
    {
        $dataPRO = new DataProvider();
        if ($year && $quarter == null) {
            $sql = "SELECT YEAR(NgayDat) AS Nam ,QUARTER(NgayDat) AS Quy, SUM(TongTien) AS TongDoanhThu FROM donhang WHERE TrangThai = 1 GROUP BY YEAR(NgayDat),QUARTER(NgayDat);";
            $result = $dataPRO->executeQuery($sql);
            $data = [
                ["Quy" => 1, "TongDoanhThu" => 0],
                ["Quy" => 2, "TongDoanhThu" => 0],
                ["Quy" => 3, "TongDoanhThu" => 0],
                ["Quy" => 4, "TongDoanhThu" => 0]
               
            ];
            if ($result) {
                while ($row = mysqli_fetch_array($result)) {
                    $data[$row["Quy"]-1]["TongDoanhThu"] = $row["TongDoanhThu"];
                }
            }
        } else {
            $sql = "SELECT 
            MONTH(NgayDat) AS Thang,
            SUM(TongTien) AS TongDoanhThu
        FROM 
            donhang
        WHERE 
            TrangThai = 1
            AND MONTH(NgayDat) IN (" . $quarter * 3 - 2 . " ," . $quarter * 3 - 1 . ", " . $quarter * 3 . ")
        GROUP BY 
        MONTH(NgayDat)";
            $result = $dataPRO->executeQuery($sql);
            $data = [
                ["Thang" => $quarter * 3 - 2, "TongDoanhThu" => 0],
                ["Thang" => $quarter * 3 - 1, "TongDoanhThu" => 0],
                ["Thang" => $quarter * 3, "TongDoanhThu" => 0]
            ];

            if ($result) {
                while ($row = mysqli_fetch_array($result)) {
                    $data[$row['Thang']-($quarter-1)*3-1]["TongDoanhThu"] = $row["TongDoanhThu"];
                }
            }
        }

        return $data;
    }
    public function ListPhanTram($hang = null)
    {
        $dataPRO = new DataProvider();
        if($hang)
        $sql = "SELECT sanpham.Ten, SUM(chitietdonhang.SoLuong) AS TongSoLuong
        FROM chitietdonhang
        JOIN sanpham ON chitietdonhang.MaSP = sanpham.MaSP
        where MaHang = '$hang'
        GROUP BY chitietdonhang.MaSP";
        else
        $sql = "SELECT sanpham.Ten, SUM(chitietdonhang.SoLuong) AS TongSoLuong
        FROM chitietdonhang
        JOIN sanpham ON chitietdonhang.MaSP = sanpham.MaSP
        GROUP BY chitietdonhang.MaSP";
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
        $sql = "SELECT hang.Ten AS TenHang, SUM(chitietdonhang.SoLuong) AS TongSoLuong
        FROM chitietdonhang
        JOIN sanpham ON chitietdonhang.MaSP = sanpham.MaSP
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