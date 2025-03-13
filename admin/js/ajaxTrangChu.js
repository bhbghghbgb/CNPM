google.charts.load("current", { packages: ["corechart"] });

//js tìm kiếm
$(document).ready(function () {
    $("#result").on("click", "th:not(#img-table)", function () {
        var clickedTh = $(this);

        var sortType = clickedTh.attr("id");
        var sortOrder = clickedTh.hasClass("asc") ? "desc" : "asc";

        $.ajax({
            type: "POST",
            url: "./template/template_content/ajaxsanpham.php",
            data: { daban: true, sort: sortType, order: sortOrder },
            success: function (response) {
                $("#result tbody").html(response);
                $("th").removeClass("asc desc");
                clickedTh.addClass(sortOrder); // Sử dụng biến lưu trữ đối tượng thẻ th
            },
        });
    });

    $("input[name='search']").on("input", function () {
        var searchQuery = $(this).val();
        var searchSuggestions = $("#search-suggestions");
        if (searchQuery === "") searchSuggestions.hide();
        else {
            searchSuggestions.show();
            $.ajax({
                // Thực hiện AJAX request để lấy gợi ý tìm kiếm
                type: "GET",
                url: "./template/template_content/ajaxsanpham.php", // Thay đổi thành địa chỉ URL xử lý gợi ý tìm kiếm trên máy chủ
                data: { daban: true, search: searchQuery },
                success: function (response) {
                    // Hiển thị kết quả gợi ý trong khu vực search-suggestions
                    $("#search-suggestions").html(response);
                },
            });
        }
    });
});

//ajax khi khởi tạo
$(document).ready(function () {
    $.ajax({
        url: "./template/template_content/ajaxtrangchu.php",
        method: "POST",
        data: { daban: true, quarter: 0 },
        success: function (response) {
            google.charts.setOnLoadCallback(function () {
                VeBieuDoCotDaBan(response);
            });
        },
    });
    $.ajax({
        url: "./template/template_content/ajaxtrangchu.php",
        method: "POST",
        data: { daban: true, hang: 0 },
        success: function (response) {
            google.charts.setOnLoadCallback(function () {
                VeBieuDoTronSPDaBan(response);
            });
        },
    });
    $.ajax({
        url: "./template/template_content/ajaxtrangchu.php",
        method: "POST",
        data: { daban: true, bieudotronhang: 1 },
        success: function (response) {
            google.charts.setOnLoadCallback(function () {
                VeBieuDoTronHangDaBan(response);
            });
        },
    });
});

$(document).ready(function () {
    //js vẽ biểu đồ cột
    document
        .getElementById("BieuDoCotSPDaBan-sel")
        .addEventListener("change", function () {
            var valueQuy = document.getElementById(
                "BieuDoCotSPDaBan-sel"
            ).value;
            $.ajax({
                url: "./template/template_content/ajaxtrangchu.php",
                method: "POST",
                data: { daban: true, quarter: valueQuy },
                success: function (response) {
                    google.charts.setOnLoadCallback(function () {
                        VeBieuDoCotDaBan(response, valueQuy);
                    });
                },
            });
        });

    //js gọi hàm vẽ biểu đồ tròn sp
    document
        .getElementById("BieuDoTronSPDaBan-sel")
        .addEventListener("change", function () {
            var valueHang = document.getElementById("BieuDoTronSPDaBan-sel");
            var selectedOption = valueHang.options[valueHang.selectedIndex];
            var dataName = selectedOption.getAttribute("data-name");
            $.ajax({
                url: "./template/template_content/ajaxtrangchu.php",
                method: "POST",
                data: { daban: true, hang: valueHang.value },
                success: function (response) {
                    google.charts.setOnLoadCallback(function () {
                        VeBieuDoTronSPDaBan(response, dataName);
                    });
                },
            });
        });
});

// hàm vẽ biểu đồ tròn hãng
function VeBieuDoTronHangDaBan(dataPhanTram) {
    var stringData = dataPhanTram.replace(/,]/g, "]");
    var dataArray = JSON.parse(stringData);

    var data = google.visualization.arrayToDataTable(dataArray);

    var options = {
        title: "Tỉ lệ bán từng Hãng",
    };

    var chart = new google.visualization.PieChart(
        document.getElementById("BieuDoTronHangDaBan")
    );

    chart.draw(data, options);
}

// hàm vẽ biểu đồ tròn sp
function VeBieuDoTronSPDaBan(dataPhanTram, valueHang = null) {
    var stringData = dataPhanTram.replace(/,]/g, "]");
    var dataArray = JSON.parse(stringData);

    var data = google.visualization.arrayToDataTable(dataArray);
    if (valueHang)
        var options = { title: "Tỉ lệ bán từng sản phẩm của " + valueHang };
    else var options = { title: "Tỉ lệ bán từng sản phẩm" };
    var chart = new google.visualization.PieChart(
        document.getElementById("BieuDoTronSPDaBan")
    );
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
    document.getElementById("SanPhamBanChay").innerHTML =
        "Sản phẩm bán chạy nhất: " +
        maxProductName +
        "<br> Bán được " +
        maxProductQuantity +
        " Sản phẩm.";
}

// hàm vẽ biểu đồ cột hãng
function VeBieuDoCotDaBan(dataDoanhThu, quarter = null) {
    var stringData = dataDoanhThu.replace(/,]/g, "]");

    var dataArray = JSON.parse(stringData);

    var data = google.visualization.arrayToDataTable(dataArray);

    var view = new google.visualization.DataView(data);
    view.setColumns([
        0,
        1,
        {
            calc: "stringify",
            sourceColumn: 1,
            type: "string",
            role: "annotation",
        },
        2,
    ]);
    if (quarter)
        var options = {
            title:
                "Biểu đồ doanh thu theo tháng trong quý " + quarter + " (VND)",
            bar: { groupWidth: "95%" },
            legend: { position: "none" },
        };
    else
        var options = {
            title: "Biểu đồ doanh thu theo quý (VND)",
            bar: { groupWidth: "95%" },
            legend: { position: "none" },
        };
    var chart = new google.visualization.ColumnChart(
        document.getElementById("BieuDoCotSPDaBan")
    );
    chart.draw(view, options);
}

///////////////////////////////////////////////////////////////////

$(document).ready(function () {
    $.ajax({
        url: "./template/template_content/ajaxtrangchu.php",
        method: "POST",
        data: { quarter: 0 },
        success: function (response) {
            google.charts.setOnLoadCallback(function () {
                VeBieuDoCotNhap(response);
            });
        },
    });
    $.ajax({
        url: "./template/template_content/ajaxtrangchu.php",
        method: "POST",
        data: { hang: 0 },
        success: function (response) {
            google.charts.setOnLoadCallback(function () {
                VeBieuDoTronSPNhap(response);
            });
        },
    });
    $.ajax({
        url: "./template/template_content/ajaxtrangchu.php",
        method: "POST",
        data: { bieudotronhang: 1 },
        success: function (response) {
            google.charts.setOnLoadCallback(function () {
                VeBieuDoTronHangNhap(response);
            });
        },
    });
});

$(document).ready(function () {
    //js vẽ biểu đồ cột
    document
        .getElementById("BieuDoCotSPNhap-sel")
        .addEventListener("change", function () {
            var valueQuy = document.getElementById("BieuDoCotSPNhap-sel").value;
            $.ajax({
                url: "./template/template_content/ajaxtrangchu.php",
                method: "POST",
                data: { quarter: valueQuy },
                success: function (response) {
                    google.charts.setOnLoadCallback(function () {
                        VeBieuDoCotNhap(response, valueQuy);
                    });
                },
            });
        });

    //js gọi hàm vẽ biểu đồ tròn sp
    document
        .getElementById("BieuDoTronSPNhap-sel")
        .addEventListener("change", function () {
            var valueHang = document.getElementById("BieuDoTronSPNhap-sel");
            var selectedOption = valueHang.options[valueHang.selectedIndex];
            var dataName = selectedOption.getAttribute("data-name");
            $.ajax({
                url: "./template/template_content/ajaxtrangchu.php",
                method: "POST",
                data: { hang: valueHang.value },
                success: function (response) {
                    google.charts.setOnLoadCallback(function () {
                        VeBieuDoTronSPNhap(response, dataName);
                    });
                },
            });
        });
});

// hàm vẽ biểu đồ tròn hãng
function VeBieuDoTronHangNhap(dataPhanTram) {
    var stringData = dataPhanTram.replace(/,]/g, "]");
    var dataArray = JSON.parse(stringData);

    var data = google.visualization.arrayToDataTable(dataArray);

    var options = {
        title: "Tỉ lệ nhập từng hãng",
    };

    var chart = new google.visualization.PieChart(
        document.getElementById("BieuDoTronHangNhap")
    );

    chart.draw(data, options);
}

// hàm vẽ biểu đồ tròn sp
function VeBieuDoTronSPNhap(dataPhanTram, valueHang = null) {
    var stringData = dataPhanTram.replace(/,]/g, "]");
    var dataArray = JSON.parse(stringData);

    var data = google.visualization.arrayToDataTable(dataArray);
    if (valueHang)
        var options = { title: "Tỉ lệ nhập từng sản phẩm của " + valueHang };
    else var options = { title: "Tỉ lệ nhập từng sản phẩm" };
    var chart = new google.visualization.PieChart(
        document.getElementById("BieuDoTronSPNhap")
    );
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
    document.getElementById("SanPhamNhapNhieu").innerHTML =
        "Sản phẩm nhập nhiều nhất: " +
        maxProductName +
        "<br> Nhập " +
        maxProductQuantity +
        " Sản phẩm.";
}

// hàm vẽ biểu đồ cột hãng
function VeBieuDoCotNhap(dataDoanhThu, quarter = null) {
    var stringData = dataDoanhThu.replace(/,]/g, "]");
    var dataArray = JSON.parse(stringData);

    var data = google.visualization.arrayToDataTable(dataArray);

    var view = new google.visualization.DataView(data);
    view.setColumns([
        0,
        1,
        {
            calc: "stringify",
            sourceColumn: 1,
            type: "string",
            role: "annotation",
        },
        2,
    ]);
    if (quarter)
        var options = {
            title:
                "Biểu đồ số tiền nhập hàng theo tháng trong quý " +
                quarter +
                " (VND)",
            bar: { groupWidth: "95%" },
            legend: { position: "none" },
        };
    else
        var options = {
            title: "Biểu đồ số tiền nhập hàng theo quý (VND)",
            bar: { groupWidth: "95%" },
            legend: { position: "none" },
        };
    var chart = new google.visualization.ColumnChart(
        document.getElementById("BieuDoCotSPNhap")
    );
    chart.draw(view, options);
}
