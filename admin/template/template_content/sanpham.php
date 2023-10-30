<?php
include '../db/DAOSP.php';
include '../db/DAOHang.php';
include '../db/DAOKhuyenMai.php';
include '../db/DAOSoSize.php';

$daoSP=new DAOSP();
$daoHang=new DAOHang();
$daoKM=new DAOKhuyenMai();
$daoSoSize=new DAOSoSize();


$data=array();
// Kiểm tra nếu có dữ liệu được gửi đi từ form tìm kiếm
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    // Truy vấn danh sách sản phẩm dựa trên từ khóa tìm kiếm
    $data=$daoSP->findSP("Ten",$search);
} else {
    // Truy vấn danh sách sản phẩm khi không có từ khóa tìm kiếm
    $data=$daoSP->getList1();
}

?>
<div id="sanpham">
    <div class="row my-3">
        <div class="col-md-6 offset-md-6">
            <form method="GET" action="">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Tìm kiếm...">
                    <input type="hidden" value="sp" name="id">
                    <div class="input-group-append">
                        <button type="submit" class="btn">Tìm</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php
    echo isset($_GET['search']) ? "Kết quả tìm kiếm cho '<p class='d-inline text-danger'><strong>" . $_GET['search'] . "</strong></p>' là:" : '';
    ?>

    <div class="row">
        <div class="col mx-2 adminthem">
            <a href="editsp.php" class="row">
                <div class="col text-black">Thêm Sản Phẩm</div>
            </a>
        </div>
        <?php

        // Kiểm tra kết quả trả về
        if (count($data)>0) {
            // Hiển thị danh sách sản phẩm
            echo "<table class='w-100  bangnoidung'>
            <tr>
                <th>ID</th>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Số lượng</th>
                <th>Hãng</th>
                <th>Khuyến Mãi</th>
            </tr>";
            foreach ($data as $row) {
                $hang=$daoHang->getTenTheoMa($row["MaHang"]);
                $khuyenMai=$daoKM->getTenTheoMa($row["MaKhuyenMai"]);
                $soLuong =$daoSoSize->getSLSoSize($row["MaSP"]);

            echo "<tr class='productRow'>
            <td>" . $row["MaSP"] . "</td>
            <td> <img style='max-height:60px; max-width:60px' src='../img/products/" . $row["AnhChinh"] . "' alt=''> </td>
            <td>
                <div class='row'>"
                    . $row["Ten"] . "
                </div>
                <div class='row hanhdong'>";
                echo "<a href='../ChiTietSP.php?MaSP=" . $row["MaSP"] . "' class='xem'>
                
                        <div class='col'>
                            Xem
                        </div>
                    </a>";

                echo "<a href='editsp.php?hd=s&id=" . $row["MaSP"] . "' class='sua'>
                        <div class='col'>
                            Sửa
                        </div>
                    </a>";

                if ($soLuong == 0)
                    echo "<a href='xuly/xulyXoaSP.php?idsp=" . $row["MaSP"] . "' class='xoa' onclick=\"return confirm('Bạn có chắc chắn muốn xóa sản phẩm " . $row["Ten"] . "')\">";
                else
                    echo "<a href='#' class='xoa' onclick=\"return confirm('Số lượng sản phẩm lớn hơn 0 nên không được phép xóa')\">";
                echo "
                        <div class='col'>
                            Xóa
                        </div>
                    </a>";

                echo "        </div>
            </td>
            <td>" . $soLuong . "</td>
            <td>" . $hang . "</td>
            <td>" . $khuyenMai . "</td>
        </tr>";
            }
            echo "</table>";
        } else {
            echo "Không có sản phẩm.";
        }
        ?>
    </div>
</div>



