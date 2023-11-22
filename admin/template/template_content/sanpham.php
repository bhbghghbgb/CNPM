<?php
include '../db/DAOSP.php';
include '../db/DAOHang.php';
include '../db/DAOKhuyenMai.php';
include '../db/DAOSoSize.php';

$daoSP = new DAOSP();
$daoHang = new DAOHang();
$daoKM = new DAOKhuyenMai();
$daoSoSize = new DAOSoSize();


$data = array();
// Kiểm tra nếu có dữ liệu được gửi đi từ form tìm kiếm
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    // Truy vấn danh sách sản phẩm dựa trên từ khóa tìm kiếm
    $data = $daoSP->findSP("Ten", $search);
} else {
    // Truy vấn danh sách sản phẩm khi không có từ khóa tìm kiếm
    $data = $daoSP->getList1();
}

?>
<div id="sanpham">
    <div class="row my-3  justify-content-end">
        <div class="col-md-6">
            <form method="GET" action="">
                <div class="input-group">
                    <div class="w-75">
                        <input type="text" name="search" class="position-relative form-control w-100" placeholder="Tìm kiếm...">
                        <input type="hidden" name="id" value="sp">
                        <div id="search-suggestions" class=" position-absolute col-md-6 w-75 bg-white p-2" style="display:none"></div>
                    </div>
                    <div class="input-group-append">
                        <button type="submit " class="mx-3 btn btn-success">Tìm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php
    // echo isset($_GET['search']) ? "Kết quả tìm kiếm cho '<p class='d-inline text-danger'><strong>" . $_GET['search'] . "</strong></p>' là:" : '';
    ?>

    <div class="row">
        <div class="col mx-2 adminthem">
            <a href="editsp.php" class="row">
                <div class="col text-black">Thêm Sản Phẩm</div>
            </a>
        </div>
        <?php

        // Kiểm tra kết quả trả về
        if (count($data) > 0) {
            // Hiển thị danh sách sản phẩm
            echo "<table class='w-100  bangnoidung' id='result'>
            <thead>
            <tr>
                <th id='sort-id'>ID<i class='fas fa-caret-up'>  </i> </th>
                <th id='img-table'>Ảnh </th>
                <th id='sort-name'>Tên sản phẩm<i class='fas fa-caret-up'></i> </th>
                <th id='sort-quantity'>Số lượng<i class='fas fa-caret-up'></i> </th>
                <th id='sort-firm'>Hãng<i class='fas fa-caret-up'></i> </th>
                <th id='sort-sale'>Khuyến Mãi<i class='fas fa-caret-up'>  </i> </th>
            </tr>
            </thead>
            <tbody >";
            foreach ($data as $row) {
                $hang = $daoHang->getTenTheoMa($row["MaHang"]);
                $khuyenMai = $daoKM->getTenTheoMa($row["MaKhuyenMai"]);
                $soLuong = $daoSoSize->getSLSoSize($row["MaSP"]);
                if ($row["AnhChinh"] == " ")
                    $row["AnhChinh"] = "giay404.jpg";

                echo "<tr class='productRow'>
                <td>" . $row["MaSP"] . "</td>";
                echo "
            <td> <img style='max-height:60px; max-width:60px' src='../img/products/" . $row["AnhChinh"] . "' alt=''> </td>
            <td> <div class='row'>" . $row["Ten"] . " </div>
                <div class='row hanhdong'>";
                echo "<a href='../chitietsp.php?MaSP=" . $row["MaSP"] . "' class='xem'>
                        <div class='col'>Xem</div>
                    </a>";

                echo "<a href='editsp.php?hd=s&id=" . $row["MaSP"] . "' class='sua'>
                        <div class='col'>Sửa</div>
                    </a>";

                if ($soLuong == 0)
                    echo "<a href='xuly/xulyXoaSP.php?idsp=" . $row["MaSP"] . "' class='xoa' onclick=\"return confirm('Bạn có chắc chắn muốn xóa sản phẩm " . $row["Ten"] . "')\">";
                else
                    echo "<a href='#' class='xoa' onclick=\"return confirm('Số lượng sản phẩm lớn hơn 0 nên không được phép xóa')\">";
                echo "
                        <div class='col'>Xóa</div>
                    </a>";

                echo "        </div>
            </td>
            <td>" . $soLuong . "</td>
            <td>" . $hang . "</td>
            <td>" . $khuyenMai . "</td>
        </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "Không có sản phẩm.";
        }
        ?>
    </div>
</div>
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