<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="stylesheet" href="../../css/ChiTietDonHang.css">


<?php
$Madon = $_GET['CT'];
$MaTK = $_GET['MaTK'];
$Date = $_GET['Date'];
$TT = $_GET['TT'];
include('../../../db/DAOKhachHang.php');
include('../../../db/DAOSP.php');
$db_kh = new DAOKhachHang();
$db_kh->connect();

$data = $db_kh->LayThongTinKhach($MaTK);

$db_sp = new DAOSP();
$db_sp->connect();

if (isset($_GET['PQ'])) {
    if ($data == null) {
        header("location:../../../giohang.php");
    }
} else {
    if ($data == null) {
        header("location:../../index.php?id=dh");
    }
}
?>

<div id="ctdh" class="container-fluid">
    <h2>Chi Tiết Hóa Đơn</h2>
    <div class="row">
        <div class="col col-6">
            <p>Mã đơn hàng: <?php echo $Madon ?></p>
            <p>Mã tài khoản: <?php echo $MaTK ?></p>
            <p>Địa chỉ: <?php echo $data[2] ?></p>
            <!-- Hien thi theo tien viet nam -->
            <p>Tổng tiền: <?php echo number_format($TT, 0, ',', '.') . "đ" ?></p>
        </div>
        <div class="col col-6">
            <p>Tên khách hàng: <?php echo $data[1] ?></p>
            <p>Số điện thoại: <?php echo $data[3] ?></p>
            <p>Ngày đặt: <?php echo $Date ?></p>
        </div>
    </div>


    <?php
    $MaQuyen = '';
    if (isset($_GET['PQ'])) {
        $MaQuyen = $_GET['PQ'];
    }
    if ($MaQuyen != 'User') {
        echo '    <button type="button" id="buttonXuatHoaDon" style="background-color:burlywood; margin-left: 50px; width: 150px; height: 30px; " >Xuất hóa đơn</button>';
    }
    ?>


    <table id="ds_donhang">
        <tr>
            <th>Mã sản phẩm</th>
            <th>Tên sản phẩm</th>
            <th>Size</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Tổng tiền</th>
        </tr>
        <?php
        include("../../../db/DAOChiTietDonHang.php");
        include("../../../db/DAO/DataProvider.php");
        $db = new DAOChiTietDonHang();
        $data = $db->getList($Madon);
        $i = 0;
        while ($i < count($data)) {
            $sp = $db_sp->getTenSanPham($data[$i]->getMaSanPham());
        ?>
            <tr>
                <td><?php echo $data[$i]->getMaSanPham() ?></td>
                <td><?php echo $sp[0] ?></td>
                <td><?php echo $data[$i]->getSize() ?></td>
                <td><?php echo $data[$i]->getSoLuong() ?></td>
                <td><?php echo number_format($data[$i]->getGiaBan(), 0, ',', '.') . "đ" ?></td>
                <td><?php echo number_format($data[$i]->getTongTien(), 0, ',', '.') . "đ" ?></td>
            </tr>
        <?php
            $i++;
        }
        ?>
    </table>

    <?php
    if (isset($_GET['PQ'])) {
    ?>
        <a href="../../../giohang.php">
            <div id="back">Xác nhận</div>
        </a>
    <?php
    } else {
    ?>
        <a href="../../index.php?id=dh">
            <div id="back">Xác nhận</div>
        </a>
    <?php

    }
    ?>
    <?php // xuất hóa đơn.
    require('../../../tcpdf/tcpdf.php');
    // Tạo một đối tượng TCPDF
    $db_kh->connect();
    $data = $db_kh->LayThongTinKhach($MaTK);
    $pdf = new TCPDF();
    // Thiết lập thông tin tài liệu
    $pdf->SetCreator('Your Name');
    $pdf->SetAuthor('Your Name');
    $pdf->SetTitle('HÓA ĐƠN BÁN HÀNG');
    $pdf->SetSubject('Test PDF');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
    // Thêm một trang mới
    $pdf->AddPage();
    // Bắt đầu nội dung của tài liệu
    $pdf->SetFont('dejavusans', '', 12);
    $pdf->Cell(0, 10, 'HÓA ĐƠN BÁN HÀNG', 0, 1, 'C');
    $pdf->Cell(0, 10, 'Mã hóa đơn: ' . $Madon, 0, 1, 'L');
    $pdf->Cell(0, 10, 'Ngày đặt: ' . $Date, 0, 1, 'L');
    $pdf->Cell(0, 10, 'Mã khách hàng: ' . $MaTK, 0, 1, 'L');
    $pdf->Cell(0, 10, 'Tên khách hàng: ' . $data[1], 0, 1, 'L');
    $pdf->Cell(0, 10, 'Số điện thoại: ' . $data[3], 0, 1, 'L');
    $pdf->Cell(0, 10, 'Địa chỉ: ' . $data[2], 0, 1, 'L');
    $pdf->Cell(0, 10, 'Tổng tiền: ' .  number_format($TT, 0, ',', '.') . "đ", 0, 1, 'L');
    $pdf->SetFillColor(255, 255, 255); // Màu nền cho bảng
    // Định nghĩa số cột và chiều rộng của từng cột
    $columnCount = 6;
    $columnWidths = array(17, 80, 15, 17, 32, 32); // Đơn vị là mm
    // Tiêu đề bảng
    $pdf->Cell(array_sum($columnWidths), 10, 'Chi tiết hóa đơn', 0, 1, 'C', 1);
    // Tiêu đề cột
    $pdf->SetFillColor(192, 192, 192); // Màu nền cho tiêu đề cột
    $pdf->SetFont('dejavusans', 'B', 12);
    $pdf->Cell($columnWidths[0], 10, 'Mã', 1, 0, 'C', 1);
    $pdf->Cell($columnWidths[1], 10, 'Tên', 1, 0, 'C', 1);
    $pdf->Cell($columnWidths[2], 10, 'Size', 1, 0, 'C', 1);
    $pdf->Cell($columnWidths[3], 10, 'SL', 1, 0, 'C', 1);
    $pdf->Cell($columnWidths[4], 10, 'Giá', 1, 0, 'C', 1);
    $pdf->Cell($columnWidths[5], 10, 'Tổng tiền', 1, 0, 'C', 1);
    $pdf->Ln(); // Xuống dòng
    // Dữ liệu cho bảng
    // In dữ liệu vào bảng
    $pdf->SetFont('dejavusans', '', 10);
    $db = new DAOChiTietDonHang();
    $data = $db->getList($Madon);
    $i = 0;
    while ($i < count($data)) {
        // for ($i = 0; $i < $columnCount; $i++) {
        $sp = $db_sp->getTenSanPham($data[$i]->getMaSanPham());
        $pdf->MultiCell($columnWidths[0], 10, $data[$i]->getMaSanPham(), 1, 'L', 0, 0, '', '', true, 0, false, true, 0, 'T');
        $pdf->MultiCell($columnWidths[1], 10, $sp[0], 1, 'L', 0, 0, '', '', true, 0, false, true, 0, 'T');
        $pdf->MultiCell($columnWidths[2], 10, $data[$i]->getSize(), 1, 'L', 0, 0, '', '', true, 0, false, true, 0, 'T');
        $pdf->MultiCell($columnWidths[3], 10, $data[$i]->getSoLuong(), 1, 'L', 0, 0, '', '', true, 0, false, true, 0, 'T');
        $pdf->MultiCell($columnWidths[4], 10, number_format($data[$i]->getGiaBan(), 0, ',', '.') . "đ", 1, 'L', 0, 0, '', '', true, 0, false, true, 0, 'T');
        $pdf->MultiCell($columnWidths[5], 10, number_format($data[$i]->getTongTien(), 0, ',', '.') . "đ", 1, 'L', 0, 0, '', '', true, 0, false, true, 0, 'T');
        // }
        $pdf->Ln(); // Xuống dòng
        $i++;
    }
    $pdf->SetFont('dejavusans', '', 12);
    $pdf->Cell(0, 10, '', 0, 1, 'L');
    $pdf->Cell(15);
    $pdf->Cell(0, 10, 'Chữ ký nhân viên                                                        Chữ ký khách hàng', 0, 1, 'L');
    $pdf->Cell(15);
    $pdf->Cell(0, 10, '(Ký, ghi rõ họ tên)                                                       (Ký, ghi rõ họ tên)', 0, 1, 'L');
    // Kết thúc tài liệu
    $pdfData = $pdf->Output('', 'S'); // Lưu tệp PDF vào biến $pdfData
    ?>

    <script>
        document.getElementById("buttonXuatHoaDon").addEventListener("click", function(e) {
            // Dữ liệu PDF Base64 của bạn
            var pdfData = "<?php echo base64_encode($pdfData); ?>";
            // Tạo một URL cho dữ liệu Base64
            var pdfUrl = "data:application/pdf;base64," + pdfData;
            // Mở tab mới và tạo một iframe để hiển thị PDF
            var newTab = window.open();
            newTab.document.write('<iframe width="100%" height="100%" src="' + pdfUrl + '"></iframe>');
        });
    </script>
</div>