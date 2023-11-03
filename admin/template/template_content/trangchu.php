<?php
include('../db/DAOChiTietDonHang.php');
include('../db/DAOHang.php');
include('../db/DAO/DataProvider.php');

$daoCTDH = new DAOChiTietDonHang();
$daoHang = new DAOHang();
$tongSPDaBan = $daoCTDH->TongSanPhamBan();

$dataPhanTramSP = $daoCTDH->ListPhanTram();

$listHang = $daoHang->getList();

$dataPhanTramHang = $daoCTDH->ListPhanTramTungHang();

?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<!-- html -->
<div id="thongke" class="container-fluid">
    <div class="row">
        Tổng số lượng đơn hàng đã bán:
        <?php echo $tongSPDaBan; ?> sản phẩm
    </div>
    <div class="row">
        <div class="col col-12 col-md-6">
            <select name="doanhthu" id="columnchart_values_sel">
                <option selected value="0">--Tất Cả--</option>
                <option value="1">Quý 1</option>
                <option value="2">Quý 2</option>
                <option value="3">Quý 3</option>
                <option value="4">Quý 4</option>
            </select>

            <div id="columnchart_values" style=" height: 500px;"></div>
        </div>
        <div class="col col-12 col-md-6">
            <select name="hang" id="piechart_sel">
                <option value="0">--Tất Cả--</option>
                <?php
                foreach ($listHang as $key) {
                    echo '<option data-name="' . $key['Ten'] . '" value="' . $key['MaHang'] . '">' . $key['Ten'] . '</option>';
                }
                ?>
            </select>

            <div id="piechart" style="height: 500px;"></div>
            <div id="sanphambanchay"></div>

        </div>
    </div>
    <div class="row">
        <div class="col col-12 col-md-6">
            <div id="piechart1" style=" height: 500px;"></div>
        </div>
    </div>
</div>
<!-- /html -->

<!-- js charts -->
<script type="text/javascript">

    google.charts.load("current", { packages: ['corechart'] });
    function drawChart(dataDoanhThu, quarter = null) {

        var stringData = dataDoanhThu.replace(/,]/g, ']');

        var dataArray = JSON.parse(stringData);

        var data = google.visualization.arrayToDataTable(dataArray);

        var view = new google.visualization.DataView(data);
        view.setColumns([0, 1,
            {
                calc: "stringify",
                sourceColumn: 1,
                type: "string",
                role: "annotation"
            },
            2
        ]);
        if (quarter)
            var options = {
                title: "Biểu đồ doanh thu theo tháng trong quý " + quarter + " (VND)",
                bar: { groupWidth: "95%" },
                legend: { position: "none" },
            };
        else
            var options = {
                title: "Biểu đồ doanh thu theo quý (VND)",
                bar: { groupWidth: "95%" },
                legend: { position: "none" },
            };
        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
        chart.draw(view, options);
    }



    $(document).ready(function () {
        $.ajax({
            url: './template/template_content/ajaxtrangchu.php',
            method: 'POST',
            data: { quarter: 0 },
            success: function (response) {
                google.charts.setOnLoadCallback(function () { drawChart(response) });
            }
        });

        document.getElementById('columnchart_values_sel').addEventListener('change', function () {
            var valueQuy = document.getElementById('columnchart_values_sel').value;
            $.ajax({
                url: './template/template_content/ajaxtrangchu.php',
                method: 'POST',
                data: { quarter: valueQuy },
                success: function (response) {
                    google.charts.setOnLoadCallback(function () { drawChart(response,valueQuy) });
                }
            });
        });
    });
</script>


<script>
    google.charts.load('current', { 'packages': ['corechart'] });
    $(document).ready(function () {
        $.ajax({
            url: './template/template_content/ajaxtrangchu.php',
            method: 'POST',
            data: { hang: 0 },
            success: function (response) {
                google.charts.setOnLoadCallback(function () { drawChart2(response) });
            }
        });

        document.getElementById('piechart_sel').addEventListener('change', function () {
            var valueHang = document.getElementById('piechart_sel');
            var selectedOption = valueHang.options[valueHang.selectedIndex];
            var dataName = selectedOption.getAttribute("data-name");
            $.ajax({
                url: './template/template_content/ajaxtrangchu.php',
                method: 'POST',
                data: { hang: valueHang.value },
                success: function (response) {
                    google.charts.setOnLoadCallback(function () { drawChart2(response, dataName) });
                }
            });
        });

    })

    function drawChart2(dataPhanTram, valueHang = null) {

        var stringData = dataPhanTram.replace(/,]/g, ']');
        var dataArray = JSON.parse(stringData);
        console.log(dataArray)

        var data = google.visualization.arrayToDataTable(dataArray)
        if (valueHang)
            var options = { title: 'Tỉ lệ bán từng sản phẩm của ' + valueHang }
        else
            var options = { title: 'Tỉ lệ bán từng sản phẩm' }
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);


        var maxProductName = "";
        var maxProductQuantity = 0;

        for (var i = 1; i < dataArray.length; i++) {
            var productName = dataArray[i][0];
            var productQuantity = dataArray[i][1];

            if (productQuantity > maxProductQuantity) {
                maxProductName = productName;
                maxProductQuantity = productQuantity;
            }
        }
        document.getElementById('sanphambanchay').innerHTML = "Sản phẩm bán chạy nhất: " + maxProductName + "<br> Bán được " + maxProductQuantity + " Sản phẩm.";
    }

</script>
<script type="text/javascript">
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawChart1);
    function drawChart1() {
        var data1 = [
            ['MaHang', 'TongSoLuong'],
            <?php foreach ($dataPhanTramHang as $key)
                echo "['" . $key['TenHang'] . "'," . $key['TongSoLuong'] . "],";
            ?>
        ];
        var data = google.visualization.arrayToDataTable(data1);


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