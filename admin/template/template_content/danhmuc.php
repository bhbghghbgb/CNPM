<div id="danhmuc">
    <div class="row">
        <div class="col mx-2 adminthem">
            <a href="editdm.php" class="row">
                <div class="col text-black">Thêm Danh Mục</div>
            </a>
        </div>
    </div>
<?php
include '../db/dbconnect.php';

// Truy vấn danh sách sản phẩm
$sql = "SELECT * FROM danhmuc";
$result = $conn->query($sql);

// Kiểm tra kết quả trả về
if ($result->num_rows > 0) {
    // Hiển thị danh sách sản phẩm
    echo "<table class='w-100  bangnoidung'>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Trạng thái</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        $sqlDemDM = 'SELECT COUNT(*) as count FROM sanpham WHERE TrangThai=1 AND MaDM = "'. $row['MaDM'] . '"';
        $resultDemDM = mysqli_query($conn, $sqlDemDM);
        $soSP = mysqli_fetch_assoc($resultDemDM);
        echo "<tr>
            <td>" . $row['MaDM']. "</td>
            <td>
                <div class='row'>"
                    .$row['TenDM']."
                </div>
                <div class='row hanhdong'>";
                echo"<a href='#' class='xem'>
                
                        <div class='col'>
                            Xem
                        </div>
                    </a>";
                
                echo"
                <a href='editdm.php?hd=s&id=".$row['MaDM']."' class='sua'>
                        <div class='col'>
                            Sửa
                        </div>
                    </a>";
                
                echo"<a href='xuly/xulyXoaDM.php?idsp=".$row['MaDM']."' class='xoa' onclick='if(".$soSP["count"].">0) return confirm(`Bạn không thể xóa vì! có ".$soSP["count"]." sản phẩm thuộc danh mục này`) '>
                
                        <div class='col'>
                            Xóa
                        </div>
                    </a>";
                
        echo "        </div>
            </td>
            <td>" . $soSP["count"]. "</td>
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