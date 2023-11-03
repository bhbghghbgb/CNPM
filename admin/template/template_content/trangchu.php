<?php
include('../db/dbconnect.php');
include('../db/DAOChiTietDonHang.php');
include('../db/DAOHang.php');
include('../db/DAO/DataProvider.php');

$daoCTDH = new DAOChiTietDonHang();
$daoHang = new DAOHang();
$tongSPDaBan = $daoCTDH->TongSanPhamBan();
$data = $daoCTDH->ListDoanhThu(false, 2);

$dataPhanTramSP = $daoCTDH->ListPhanTram();

$listHang = $daoHang->getList();

$dataPhanTramHang = $daoCTDH->ListPhanTramHang();

?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div id="thongke" class="container-fluid">
    <div class="row">
        Tổng số lượng đơn hàng đã bán:
        <?php echo $tongSPDaBan; ?> sản phẩm
    </div>
    <div class="row">
        <div class="col col-12 col-md-6">
            <select name="doanhthu" id="columnchart_values_sel">
                <option selected value="0">Chung Theo Năm</option>
                <option value="1">Quý 1</option>
                <option value="2">Quý 2</option>
                <option value="3">Quý 3</option>
                <option value="3">Quý 3</option>
            </select>

            <div id="columnchart_values" style=" height: 500px;"></div>
        </div>
        <div class="col col-12 col-md-6">
            <select name="hang" id="piechart_sel">
                <option value="0">--Chung--</option>
                <?php
                foreach ($listHang as $key) {
                    echo '<option value="' . $key['MaHang'] . '">' . $key['Ten'] . '</option>';
                }
                ?>
            </select>

            <div id="piechart" style="height: 500px;"></div>

            Sản phẩm bán chạy nhất:
            <?php
            $max=0;
            $SPPB='';
            foreach ($dataPhanTramSP as $key) {
                if ($key['TongSoLuong'] > $max) {
                    $max = $key['TongSoLuong'];
                    $SPPB = $key['Ten'];
                }
            }
            echo $SPPB ."<br> Bán được ". $max." Sản phẩm.";
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col col-12 col-md-6">
            <div id="piechart1" style=" height: 500px;"></div>
        </div>
    </div>
</div>
<script type="text/javascript">
    google.charts.load("current", { packages: ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ["Element", "Total", { role: "style" }],
            <?php foreach ($data as $key)
                echo "['Tháng " . $key["Thang"] . "'," . $key["TongDoanhThu"] . ",'#ccc'],";
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
            title: "Biểu đồ doanh thu theo tháng trong quý <?php echo "1"; ?> (VND)",
            bar: { groupWidth: "95%" },
            legend: { position: "none" },
        };
        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
        chart.draw(view, options);
    }



</script>
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
<script>
    $(document).ready(function () {
        $("#result").on("click", "th:not(#img-table)", function () {
            var clickedTh = $(this);

            var sortType = clickedTh.attr("id");
            var sortOrder = clickedTh.hasClass("asc") ? "desc" : "asc";

            $.ajax({
                type: "POST",
                url: "./template/template_content/ajaxsanpham.php",
                data: { sort: sortType, order: sortOrder },
                success: function (response) {
                    $("#result tbody").html(response);
                    $("th").removeClass("asc desc");
                    clickedTh.addClass(sortOrder); // Sử dụng biến lưu trữ đối tượng thẻ th
                }
            });
        });

        $("input[name='search']").on("input", function () {
            var searchQuery = $(this).val();
            var searchSuggestions = $("#search-suggestions");
            if (searchQuery === "")
                searchSuggestions.hide();
            else {
                searchSuggestions.show();
                $.ajax({
                    // Thực hiện AJAX request để lấy gợi ý tìm kiếm
                    type: "GET",
                    url: "./template/template_content/ajaxsanpham.php", // Thay đổi thành địa chỉ URL xử lý gợi ý tìm kiếm trên máy chủ
                    data: { search: searchQuery },
                    success: function (response) {
                        // Hiển thị kết quả gợi ý trong khu vực search-suggestions
                        $("#search-suggestions").html(response);
                    }
                });
            }
        });
    });
</script>