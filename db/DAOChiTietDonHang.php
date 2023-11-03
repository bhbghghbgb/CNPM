<?php
include("DTO/DTOChiTietDonHang.php");
include("DAO/DataProvider.php");
class DAOChiTietDonHang
{
    private $table="chitietdonhang";
    public function getList($madon)    {
        $ctdhs=array();
        $data=new DataProvider();

        $result=$data->Select($this->table,"MaDonHang = $madon"); 
        if($result){
            while($row = mysqli_fetch_array($result)){
                $ctdh=new DTOChiTietDonHang();
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
    public function Insert($MaSanPham,$MaDonHang,$SoLuong,$GiaBan,$TongTien,$Size){
        $data=new DataProvider();

        $ColumnValues['MaSP']=$MaSanPham;
        $ColumnValues['MaDonHang']=$MaDonHang;
        $ColumnValues['SoLuong']=$SoLuong;
        $ColumnValues['GiaBan']=$GiaBan;
        $ColumnValues['TongTien']=$TongTien;
        $ColumnValues['Size']=$Size;

        $result=$data->Insert($this->table,$ColumnValues); 
        if($result){
            return true;
        }
        else
            return false;
    }
    public function Remove($MaSP,$MaDonHang){
        $data=new DataProvider();
        $result=$data->Delete($this->table,"MaSP=$MaSP AND MaDonHang=$MaDonHang"); 
        if($result)
            return true;
        else
            return false;
    }
}
?>