<?php
class DTOChiTietPhieuNhap
{
    private $maSanPham;
    private $giaNhap;
    private $tongGia;
    private $maPhieuNhap;
    private $soLuong;
    private $size;

    public function getMaSanPham(){
        return $this->maSanPham;
    }
    public function getMaPhieuNhap(){
        return $this->maPhieuNhap;
    }
    public function getTongGia(){
        return $this->tongGia;
    }
    public function getGiaNhap(){
        return $this->giaNhap;
    }
    public function getSoLuong(){
        return $this->soLuong;
    }
    public function setMaSanPham($value){
        $this->maSanPham=$value;
    }
    public function setMaPhieuNhap($value){
        $this->maPhieuNhap=$value;
    }
    public function setTongTien($value){
        $this->tongTien=$value;
    }
    public function setGiaNhap($value){
        $this->giaNhap=$value;
    }
    public function setSoLuong($soLuong){
        $this->soLuong=$soLuong;
    }
    public function setSize($value){
        $this->size=$value;   
    }
}
?>