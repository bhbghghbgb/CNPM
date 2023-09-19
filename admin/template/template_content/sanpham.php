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
    echo isset($_GET['search']) ? "Kết quả tìm kiếm cho '<p class='d-inline text-danger'><strong>".$_GET['search']."</strong></p>' là:" : '';
    ?>

    <div class="row">
        

        <div class="col mx-2 adminthem">
            <a href="editsp.php" class="row">
                <div class="col text-black">Thêm Sản Phẩm</div>
            </a>
        </div>
    <?php


    include '../db/dbconnect.php';

    // Kiểm tra nếu có dữ liệu được gửi đi từ form tìm kiếm
    if (isset($_GET['search'])) {
        $search = $_GET['search'];

        // Truy vấn danh sách sản phẩm dựa trên từ khóa tìm kiếm
        $sql = "SELECT * FROM sanpham WHERE Ten LIKE '%$search%' AND TrangThai = 1";
    } else {
        // Truy vấn danh sách sản phẩm khi không có từ khóa tìm kiếm
        $sql = "SELECT * FROM sanpham WHERE TrangThai = 1";
    }

    $result = $conn->query($sql);

    // Kiểm tra kết quả trả về
    if ($result->num_rows > 0) {
        // Hiển thị danh sách sản phẩm
        echo "<table class='w-100  bangnoidung'>
            <tr>
                <th>ID</th>
                <th>Ảnh</th>
                <th>Tên sản phẩm</th>
                <th>Giá</th>
                <th>Số lượng</th>
                <th>Hãng</th>
            </tr>";
        while ($row = $result->fetch_assoc()) {
            $selectTenHang = 'SELECT Ten FROM hang WHERE MaHang = "' . $row['MaHang'] . '"';
            $resultTenHang = mysqli_query($conn, $selectTenHang);
            $rowTenHang = mysqli_fetch_assoc($resultTenHang);
            echo "<tr class='productRow'>
            <td>" . $row['MaSP'] . "</td>
            <td> <img style='max-height:60px; max-width:60px' src='../img/products/" . $row['AnhChinh'] . "' alt=''> </td>
            <td>
                <div class='row'>"
                . $row['Ten'] . "
                </div>
                <div class='row hanhdong'>";
            echo "<a href='../ChiTietSP.php?MaSP=" . $row['MaSP'] . "' class='xem'>
                
                        <div class='col'>
                            Xem
                        </div>
                    </a>";

            echo "<a href='editsp.php?hd=s&id=" . $row['MaSP'] . "' class='sua'>
                        <div class='col'>
                            Sửa
                        </div>
                    </a>";

            if ($row["SLTonKho"] == 0)
                echo "<a href='xuly/xulyXoaSP.php?idsp=" . $row['MaSP'] . "' class='xoa' onclick=\"return confirm('Bạn có chắc chắn muốn xóa sản phẩm " . $row['Ten'] . "')\">";
            else
                echo "<a href='#' class='xoa' onclick=\"return confirm('Số lượng sản phẩm lớn hơn 0 nên không được phép xóa')\">";
            echo "
                        <div class='col'>
                            Xóa
                        </div>
                    </a>";

            echo "        </div>
            </td>
            <td>" . $row["Gia"] . "</td>
            <td>" . $row["SLTonKho"] . "</td>
            <td>" . $rowTenHang["Ten"] . "</td>
        </tr>";
        }
        echo "</table>";
    } else {
        echo "Không có sản phẩm.";
    }

    // Đóng kết nối
    $conn->close();
    ?>
</div>