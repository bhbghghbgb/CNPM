<?php
include('../../../db/DTO/DTOChiTietPhieuNhap.php');
include('DataProvider.php');

class DAOChiTietPhieuNhap
{
    private $table="chitietphieunhap";
    public function getList($ma)    {
        $ctdhs=array();
        $ctdh=new DTOChiTietPhieuNhap();
        $data=new DataProvider();

        $result=$data->Select($this->table,"MaPhieu = $ma"); 
        if($result){
            while($row = mysqli_fetch_array($result)){
                $ctdh->setGiaNhap($row['GiaNhap']);
                $ctdh->setMaSanPham($row['MaSP']);
                $ctdh->setMaPhieuNhap($row['MaPhieu']);
                $ctdh->setTongTien($row['TongGia']);
                $ctdh->setSoLuong($row['SoLuong']);
                $ctdh->setSize($row['Size']);
                $ctdhs[]=$ctdh;
            }
            $data->Close();
            return $ctdhs;
        }
        return $result;
    }
    public function Insert($MaSanPham,$MaPhieuNhap,$SoLuong,$GiaBan,$ThanhTien,$Size){
        $data=new DataProvider();

        $ColumnValues['MaSP']=$MaSanPham;
        $ColumnValues['MaPhieuNhap']=$MaPhieuNhap;
        $ColumnValues['SoLuong']=$SoLuong;
        $ColumnValues['GiaBan']=$GiaBan;
        $ColumnValues['ThanhTien']=$ThanhTien;
        $ColumnValues['Size']=$Size;

        $result=$data->Insert($this->table,$ColumnValues); 
        $data->Close();
        if($result)
            return true;
        else
            return false;
    }
    public function Remove($MaSP,$MaPhieuNhap){
        $data=new DataProvider();
        $result=$data->Delete($this->table,"MaSP=$MaSP AND MaPhieuNhap=$MaPhieuNhap"); 
        $data->Close();
        if($result)
            return true;
        else
            return false;
    }
}
?>