<?php
include('../../../db/DTO/DTOChiTietDonHang.php');
include('DataProvider.php');

class DAOChiTietDonHang
{
    private $table="chitietdonhang";
    public function getList($madon)    {
        $ctdhs=array();
        $ctdh=new DTOChiTietDonHang();
        $data=new DataProvider();

        $result=$data->Select($this->table,"MaDonHang = $madon"); 
        if($result){
            while($row = mysqli_fetch_array($result)){
                $ctdh->setGiaBan($row['GiaBan']);
                $ctdh->setMaSanPham($row['MaSP']);
                $ctdh->setMaDonHang($row['MaDonHang']);
                $ctdh->setTongTien($row['TongTien']);
                $ctdh->setSoLuong($row['SoLuong']);
                $ctdh->setSize($row['Size']);
                $ctdhs[]=$ctdh;
            }
            $data->Close();
            return $ctdhs;
        }
        return $result;
    }
    public function Insert($MaSanPham,$MaDonHang,$SoLuong,$GiaBan,$ThanhTien,$Size){
        $data=new DataProvider();

        $ColumnValues['MaSP']=$MaSanPham;
        $ColumnValues['MaDonHang']=$MaDonHang;
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
    public function Remove($MaSP,$MaDonHang){
        $data=new DataProvider();
        $result=$data->Delete($this->table,"MaSP=$MaSP AND MaDonHang=$MaDonHang"); 
        $data->Close();
        if($result)
            return true;
        else
            return false;
    }
}
?>