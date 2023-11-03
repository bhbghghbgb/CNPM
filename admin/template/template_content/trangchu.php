<?php
include('../db/dbconnect.php');
include('../db/DAOChiTietDonHang.php');

$tongSPDaBan = 0;
$sql = " SELECT SUM(SoLuong) AS TongSanPhamDaBan FROM chitietdonhang;";
$result = $conn->query($sql);
if ($row = $result->fetch_assoc()) {
    $tongSPDaBan = $row['TongSanPhamDaBan'];
}

$sql = "SELECT YEAR(NgayDat) AS Nam ,QUARTER(NgayDat) AS Quy, SUM(TongTien) AS TongDoanhThu FROM donhang WHERE TrangThai = 1 GROUP BY YEAR(NgayDat),QUARTER(NgayDat);";
$data = [];
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

$sql = " SELECT sanpham.Ten, SUM(chitietdonhang.SoLuong) AS TongSoLuong
                FROM chitietdonhang
                JOIN sanpham ON chitietdonhang.MaSP = sanpham.MaSP
                GROUP BY chitietdonhang.MaSP";
$dataPhanTramSP = [];
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $dataPhanTramSP[] = $row;
}
$sql = " SELECT hang.Ten AS TenHang, SUM(chitietdonhang.SoLuong) AS TongSoLuong
FROM chitietdonhang
JOIN sanpham ON chitietdonhang.MaSP = sanpham.MaSP
JOIN hang ON sanpham.MaHang = hang.MaHang
GROUP BY hang.Ten;";
$dataPhanTramHang = [];
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
    $dataPhanTramHang[] = $row;
}
?>
<div id="thongke" class="container-fluid">
    <div class="row">
        Tổng số lượng đơn hàng đã bán:
        <?php echo $tongSPDaBan; ?> sản phẩm
    </div>
    <div class="row">
        <div class="col col-12 col-md-6">
            <html>

            <head>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                    google.charts.load("current", { packages: ['corechart'] });
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ["Element", "Total", { role: "style" }],
                            <?php
                            foreach ($data as $key)
                                echo "['Quý " . $key['Quy'] . " Năm " . $key['Nam'] . "'," . $key['TongDoanhThu'] . ",'#ccc'],";
                            ?>
                        ]);

                        var view = new google.visualization.DataView(data);
                        view.setColumns([0, 1,
                            {
                                calc: "stringify",
                                sourceColumn: 1,
                                type: "string",
                                role: "annotation"
                            },
                            2]);

                        var options = {
                            title: "Biểu đồ doanh thu theo quý của các năm (VND)",
                            bar: { groupWidth: "95%" },
                            legend: { position: "none" },
                        };
                        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                        chart.draw(view, options);
                    }
                </script>
            </head>

            <body>
                <div id="columnchart_values" style=" height: 500px;"></div>
            </body>

            </html>
        </div>

        <div class="col col-12 col-md-6">
            <html>

            <head>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                    google.charts.load('current', { 'packages': ['corechart'] });
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {

                        var data = google.visualization.arrayToDataTable([
                            ['Ten', 'TongSoLuong'],
                            <?php foreach ($dataPhanTramSP as $key)
                                echo "['" . $key['Ten'] . "'," . $key['TongSoLuong'] . "],";
                            ?>
                        ]);

                        var options = {
                            title: 'Tỉ lệ bán từng sản phẩm'
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                        chart.draw(data, options);
                    }
                </script>
            </head>

            <body>
                <div id="piechart" style="height: 500px;"></div>
            </body>

            </html>
            Sản phẩm bán chạy nhất:
        <?php
        $SPPB = '';
        $max = 0; foreach ($dataPhanTramSP as $key) {
            if ($key['TongSoLuong'] > $max)
                $max = $key['TongSoLuong'];
        }
        foreach ($dataPhanTramSP as $key) {
            if ($key['TongSoLuong'] == $max)
                $SPPB = $key['Ten'];
        }

        echo $SPPB . $max;
        ?>


        </div>

    </div>
    <div class="row">
        <div class="col col-12 col-md-6">
            <html>

            <head>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                    google.charts.load('current', { 'packages': ['corechart'] });
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {

                        var data = google.visualization.arrayToDataTable([
                            ['MaHang', 'TongSoLuong'],
                            <?php foreach ($dataPhanTramHang as $key)
                                echo "['" . $key['TenHang'] . "'," . $key['TongSoLuong'] . "],";
                            ?>
                        ]);

                        var options = {
                            title: 'Tỉ lệ bán từng Hãng'
                        };

                        var chart = new google.visualization.PieChart(document.getElementById('piechart1'));

                        chart.draw(data, options);
                    }
                </script>
            </head>

            <body>
                <div id="piechart1" style=" height: 500px;"></div>
            </body>

            </html>

        </div>
    </div>
</div>
<?php $conn->close(); ?>