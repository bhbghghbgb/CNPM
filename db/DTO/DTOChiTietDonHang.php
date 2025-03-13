<?php
class DTOChiTietDonHang
{
    private $maSanPham;
    private $giaBan;
    private $tongTien;
    private $maDonHang;
    private $soLuong;
    private $size;

    public function getMaSanPham()
    {
        return $this->maSanPham;
    }

    public function getMaDonHang()
    {
        return $this->maDonHang;
    }
    public function getTongTien()
    {
        return $this->tongTien;
    }
    public function getGiaBan()
    {
        return $this->giaBan;
    }
    public function getSoLuong()
    {
        return $this->soLuong;
    }
    public function setMaSanPham($value)
    {
        $this->maSanPham = $value;
    }
    public function setMaDonHang($value)
    {
        $this->maDonHang = $value;
    }
    public function setTongTien($value)
    {
        $this->tongTien = $value;
    }
    public function setGiaBan($value)
    {
        $this->giaBan = $value;
    }
    public function setSoLuong($soLuong)
    {
        $this->soLuong = $soLuong;
    }
    public function setSize($size)
    {
        $this->size = $size;
    }
    public function getSize()
    {
        return $this->size;
    }
}
