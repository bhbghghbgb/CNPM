<?php
include('../db/DAOChiTietDonHang.php');
include('../db/DAOChiTietPhieuNhap.php');
include('../db/DAOHang.php');
include('../db/DAO/DataProvider.php');

$daoCTDH = new DAOChiTietDonHang();
$daoCTPN = new DAOChiTietPhieuNhap();
$daoHang = new DAOHang();
$tongSPDaBan = $daoCTDH->TongSanPhamBan();
$tongSPNhap = $daoCTPN->TongSanPhamNhap();


$listHang = $daoHang->getList();
?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script src="./js/ajaxTrangChu.js"></script>
<script>
    google.charts.load("current", {
        packages: ['corechart']
    });
</script>

<div id="thongke" class="container-fluid">
    <h2>Thống kê hóa đơn</h2>
    <div class="row">
        Tổng số lượng sản phẩm đã bán:
        <?php echo $tongSPDaBan; ?> sản phẩm
    </div>
    <div class="row">
        <div class="col col-12 col-md-6">
            <select id="BieuDoCotSPDaBan-sel">
                <option selected value="0">--Tất Cả--</option>
                <option value="1">Quý 1</option>
                <option value="2">Quý 2</option>
                <option value="3">Quý 3</option>
                <option value="4">Quý 4</option>
            </select>

            <div id="BieuDoCotSPDaBan" style=" height: 500px;"></div>
        </div>
        <div class="col col-12 col-md-6">
            <select id="BieuDoTronSPDaBan-sel">
                <option value="0">--Tất Cả--</option>
                <?php
                foreach ($listHang as $key) {
                    echo '<option data-name="' . $key['Ten'] . '" value="' . $key['MaHang'] . '">' . $key['Ten'] . '</option>';
                }
                ?>
            </select>

            <div id="BieuDoTronSPDaBan" style="height: 500px;"></div>
            <div id="SanPhamBanChay"></div>

        </div>
    </div>
    <div class="row">
        <div class="col col-12 col-md-6">
            <div id="BieuDoTronHangDaBan" style=" height: 500px;"></div>
        </div>
    </div>
</div>

<div id="thongke" class="container-fluid">
    <h2>Thống kê Phiếu Nhập</h2>
    <div class="row">
        Tổng số lượng sản phẩm đã nhập:
        <?php echo $tongSPNhap; ?> sản phẩm
    </div>
    <div class="row">
        <div class="col col-12 col-md-6">
            <select name="doanhthu" id="BieuDoCotSPNhap-sel">
                <option selected value="0">--Tất Cả--</option>
                <option value="1">Quý 1</option>
                <option value="2">Quý 2</option>
                <option value="3">Quý 3</option>
                <option value="4">Quý 4</option>
            </select>

            <div id="BieuDoCotSPNhap" style=" height: 500px;"></div>
        </div>
        <div class="col col-12 col-md-6">
            <select name="hang" id="BieuDoTronSPNhap-sel">
                <option value="0">--Tất Cả--</option>
                <?php
                foreach ($listHang as $key) {
                    echo '<option data-name="' . $key['Ten'] . '" value="' . $key['MaHang'] . '">' . $key['Ten'] . '</option>';
                }
                ?>
            </select>

            <div id="BieuDoTronSPNhap" style="height: 500px;"></div>
            <div id="SanPhamNhapNhieu"></div>

        </div>
    </div>
    <div class="row">
        <div class="col col-12 col-md-6">
            <div id="BieuDoTronHangNhap" style=" height: 500px;"></div>
        </div>
    </div>
</div>