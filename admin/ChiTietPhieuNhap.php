<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/font-awesome_5.15.4_css_all.min.css">

    <script src="./js/admin.js"></script>


    <link rel="stylesheet" href="./css/admin.css">
    <script src="./js/edit.js"></script>
    <title>Admin</title>
</head>

<body>
    <div class="wrapper">
        <?php include('template/topbar_ad.php'); ?>
        <div class="container-fluid">
            <?php include('template/menu_ad.php'); ?>
            <div id="main">
                <?php include('template/header_ad.php'); ?>
                <div id="content" class="row" style="background-color:#f0f5f8;height:calc(100% - 72px)">
                    <div class="main mx-auto ">
                        <link rel="stylesheet" href="./css/ChiTietDonHang.css">
                        <div class="row justify-content-center display-4">Chi tiết phiếu nhập</div>

                        <?php
                        $maPN = $_GET['MaPN'];
                        include('../db/DAOPhieuNhap.php');
                        $daoPhieuNhap = new DAOPhieuNhap();
                        $phieuNhap = $daoPhieuNhap->getPN($maPN);
                        ?>

                        <div id="ctdh">
                            <a href="./index.php?id=pn" type="button" style="width: 80px; height:30px; margin-left:-1px; border-radius: 10px; ; background-color:burlywood; text-align:center; margin-bottom:20px; border:2px solid black; color:black;">Thoát</a>
                            <h2>Chi Tiết Phiếu Nhập</h2>
                            <div class="row mx-5">
                                <div class="col col-6">
                                    <p>Mã phiếu:
                                        <?php echo  $phieuNhap[0]['MaPhieu'];  ?>
                                    </p>
                                    <p>Ngày tạo:
                                        <?php echo  $phieuNhap[0]['NgayTaoPN'];  ?>
                                    </p>
                                    <p>Mã hãng:
                                        <?php echo  $phieuNhap[0]['MaHang'];  ?>
                                    </p>
                                    <p>Tên hãng:
                                        <?php echo  $phieuNhap[0]['Ten'];  ?>
                                    </p>
                                </div>
                                <div class="col col-6">
                                    <p>Mã tài khoản:
                                        <?php echo  $phieuNhap[0]['MaTaiKhoan'];  ?>
                                    </p>
                                    <p>Tên nhân viên:
                                        <?php echo  $phieuNhap[0]['TenNhanVien'];  ?>
                                    </p>
                                    <!-- Hien thi theo tien viet nam -->
                                    <p>Tổng đơn:
                                        <?php echo  $phieuNhap[0]['TongDon'];  ?>
                                    </p>

                                </div>
                            </div>


                            <button type="button" id="buttonXuatPhieu" style="background-color:burlywood; margin-left: 50px; width: 100px; height: 30px; ">Xuất phiếu</button>


                            <table id="ds_donhang">
                                <thead>
                                    <th>Mã sản phẩm</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Size</th>
                                    <th>Số Lượng</th>
                                    <th>Giá</th>
                                    <th>Tổng tiền</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $maPN = $_GET['MaPN'];
                                    include('../db/DAOChiTietPhieuNhap.php');
                                    $daoCTPN = new DAOChiTietPhieuNhap();
                                    $ListCTPN = $daoCTPN->getListCTPN($maPN);
                                    if ($ListCTPN != null) {
                                        foreach ($ListCTPN as $row) {
                                            $MaSP =  $row['MaSP'];
                                            $TenSP = $row['Ten'];
                                            $Size = $row['Size'];
                                            $SoLuong = $row['SoLuong'];
                                            $Gia = $row['GiaNhap'];
                                            $TongTien = $row['TongGia'];

                                            echo "<tr><td>$MaSP</td><td>$TenSP</td><td>$Size</td><td>$SoLuong</td><td>$Gia</td><td>$TongTien</td>";
                                        }
                                    }
                                    require('../tcpdf/tcpdf.php');
                                    // Tạo một đối tượng TCPDF
                                    $pdf = new TCPDF();
                                    // Thiết lập thông tin tài liệu
                                    $pdf->SetCreator('Your Name');
                                    $pdf->SetAuthor('Your Name');
                                    $pdf->SetTitle('PHIẾU NHẬP HÀNG');

                                    $pdf->SetSubject('Test PDF');
                                    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
                                    // Thêm một trang mới
                                    $pdf->AddPage();
                                    // Bắt đầu nội dung của tài liệu
                                    $pdf->SetFont('dejavusans', '', 12);
                                    if ($phieuNhap[0]['TrangThaiPN'] == 2) {
                                        $pdf->Cell(0, 10, 'PHIẾU NHẬP HÀNG (Đã bị từ chối)', 0, 1, 'C');
                                    } else {
                                        $pdf->Cell(0, 10, 'PHIẾU NHẬP HÀNG', 0, 1, 'C');
                                    }

                                    $pdf->Cell(0, 10, 'Mã phiếu: ' . $phieuNhap[0]['MaPhieu'], 0, 1, 'L');
                                    $pdf->Cell(0, 10, 'Ngày tạo: ' . $phieuNhap[0]['NgayTaoPN'], 0, 1, 'L');
                                    $pdf->Cell(0, 10, 'Mã hãng: ' . $phieuNhap[0]['MaHang'], 0, 1, 'L');
                                    $pdf->Cell(0, 10, 'Tên hãng: ' . $phieuNhap[0]['Ten'], 0, 1, 'L');
                                    $pdf->Cell(0, 10, 'Mã tài khoản: ' . $phieuNhap[0]['MaTaiKhoan'], 0, 1, 'L');
                                    $pdf->Cell(0, 10, 'Tên nhân viên: ' . $phieuNhap[0]['TenNhanVien'], 0, 1, 'L');
                                    $pdf->Cell(0, 10, 'Tổng đơn: ' .  $phieuNhap[0]['TongDon'] . ' VND', 0, 1, 'L');
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
                                    foreach ($ListCTPN as $row) {
                                        // for ($i = 0; $i < $columnCount; $i++) {
                                        $pdf->MultiCell($columnWidths[0], 10, $row['MaSP'], 1, 'L', 0, 0, '', '', true, 0, false, true, 0, 'T');
                                        $pdf->MultiCell($columnWidths[1], 10, $row['Ten'], 1, 'L', 0, 0, '', '', true, 0, false, true, 0, 'T');
                                        $pdf->MultiCell($columnWidths[2], 10, $row['Size'], 1, 'L', 0, 0, '', '', true, 0, false, true, 0, 'T');
                                        $pdf->MultiCell($columnWidths[3], 10, $row['SoLuong'], 1, 'L', 0, 0, '', '', true, 0, false, true, 0, 'T');
                                        $pdf->MultiCell($columnWidths[4], 10, $row['GiaNhap'], 1, 'L', 0, 0, '', '', true, 0, false, true, 0, 'T');
                                        $pdf->MultiCell($columnWidths[5], 10, $row['TongGia'], 1, 'L', 0, 0, '', '', true, 0, false, true, 0, 'T');
                                        // }
                                        $pdf->Ln(); // Xuống dòng
                                    }
                                    $pdf->SetFont('dejavusans', '', 12);
                                    $pdf->Cell(0, 10, '', 0, 1, 'L');
                                    $pdf->Cell(4);
                                    $pdf->Cell(0, 10, 'Chữ ký người nhập                           Chữ lý hãng nhập                           Chữ ký quản lý', 0, 1, 'L');
                                    $pdf->Cell(4);
                                    $pdf->Cell(0, 10, '(Ký, ghi rõ họ tên)                            (Ký, ghi rõ họ tên)                        (Ký, ghi rõ họ tên)', 0, 1, 'L');
                                    // Kết thúc tài liệu
                                    $pdfData = $pdf->Output('', 'S'); // Lưu tệp PDF vào biến $pdfData
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

    </div>
    <?php
    ?>
    <script>
        showmenu();
        choosemenu();
        document.getElementById("buttonXuatPhieu").addEventListener("click", function(e) {
            // Dữ liệu PDF Base64 của bạn
            var pdfData = "<?php echo base64_encode($pdfData); ?>";
            // Tạo một URL cho dữ liệu Base64
            var pdfUrl = "data:application/pdf;base64," + pdfData;
            // Mở tab mới và tạo một iframe để hiển thị PDF
            var newTab = window.open();
            newTab.document.write('<iframe width="100%" height="100%" src="' + pdfUrl + '"></iframe>');
        });
    </script>
</body>