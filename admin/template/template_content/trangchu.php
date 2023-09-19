<div id="thongke"  class="container">
        <?php include('../db/dbconnect.php');?>
            <div class="row">
                <div class="row">
                    <?php
                        $tongSPDaBan=0;
                         $sql = " SELECT SUM(SoLuong) AS TongSanPhamDaBan FROM chitietdonhang;";
                        $result = $conn->query($sql);
                        if ($row = $result->fetch_assoc()) {
                            $tongSPDaBan=$row['TongSanPhamDaBan'];
                        }
                    ?>
                    Tổng số lượng đơn hàng đã bán: <?php echo $tongSPDaBan;?> sản phẩm
                </div>
                <div class="row">
                    Biểu đồ doanh thu theo quý của các năm :
                    <?php
                        $sql = "SELECT YEAR(NgayDat) AS Nam ,QUARTER(NgayDat) AS Quy, SUM(TongTien) AS TongDoanhThu FROM donhang WHERE TrangThai = 1 GROUP BY YEAR(NgayDat),QUARTER(NgayDat);";
                        $data=[];
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    $data[]=$row;
                                }
                    ?>
                        <html>
                        <head>
                            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                            <script type="text/javascript">
                                google.charts.load("current", {packages:['corechart']});
                                google.charts.setOnLoadCallback(drawChart);
                                function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                    ["Element", "Total", { role: "style" } ],
                                    <?php 
                                    foreach ($data as $key)
                                        echo "['Quý ".$key['Quy']." Năm ".$key['Nam']."',".$key['TongDoanhThu'].",'#ccc'],";
                                    ?>
                                ]);

                                var view = new google.visualization.DataView(data);
                                view.setColumns([0, 1,
                                                { calc: "stringify",
                                                    sourceColumn: 1,
                                                    type: "string",
                                                    role: "annotation" },
                                                2]);

                                var options = {
                                    title: "Tổng tiền tính theo đơn vị vnđ",
                                    bar: {groupWidth: "95%"},
                                    legend: { position: "none" },
                                };
                                var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                                chart.draw(view, options);
                            }
                            </script>
                        </head>
                        <body>
                            <div id="columnchart_values" style="width: 1000px; height: 400px;"></div>
                        </body>
                        </html>

                </div>
                <div class="row">
                    Phần trăm bán từng sản phẩm:
                    <?php
                        $sql = " SELECT sanpham.Ten, SUM(chitietdonhang.SoLuong) AS TongSoLuong
                        FROM chitietdonhang
                        JOIN sanpham ON chitietdonhang.MaSP = sanpham.MaSP
                        GROUP BY chitietdonhang.MaSP";
                        $data=[];
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                    $data[]=$row;
                                }
                    ?>
                    <html>
                        <head>
                            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                            <script type="text/javascript">
                            google.charts.load('current', {'packages':['corechart']});
                            google.charts.setOnLoadCallback(drawChart);
                            function drawChart() {

                                var data = google.visualization.arrayToDataTable([
                                    ['Ten','TongSoLuong'],
                                <?php 
                                foreach ($data as $key)
                                    echo "['".$key['Ten']."',".$key['TongSoLuong']."],";
                                ?>
                                ]);

                                var options = {
                                title: 'My Daily Activities'
                                };

                                var chart = new google.visualization.PieChart(document.getElementById('piechart'));

                                chart.draw(data, options);
                            }
                            </script>
                        </head>
                        <body>
                            <div id="piechart" style="width: 1000px; height: 500px;"></div>
                        </body>
                        </html>

                </div>
                <div class="row">
                    Sản phẩm bán chạy nhất: <?php
                    $SPPB='';
                    $max=0;
                    foreach ($data as $key){
                        if($key['TongSoLuong']>$max)
                            $max=$key['TongSoLuong'];
                    }
                    foreach ($data as $key){
                        if($key['TongSoLuong']==$max)
                            $SPPB=$key['Ten'];
                    }
                
                    echo $SPPB.$max;
                    ?>

                </div>             
            </div>
        <?php $conn->close();?>
    </div>