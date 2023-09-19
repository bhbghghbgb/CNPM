<div id="nguoidung">

<?php
include '../db/dbconnect.php';
$listQuyen = [];
$sql = "SELECT * FROM quyen";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $listQuyen[$row['MaQuyen']]=$row['TenQuyen'];
    }
}
// Truy vấn danh sách sản phẩm
$sql = "SELECT * FROM khachhang Where TrangThai=1";
$result = $conn->query($sql);

// Kiểm tra kết quả trả về
if ($result->num_rows > 0) {
    // Hiển thị danh sách sản phẩm
    echo "
    <div id='khachhang' class='d-block'>
    <div class='row mark m-0'>
    <p class='text-center'>Bảng khách hàng</p></div>
    <div class='row m-2'>
        <div class='col mx-2 adminthem'>
            <a href='editkh.php?' class='row'>
                <div class='col text-black'>Thêm Khách Hàng</div>
            </a>
        </div>
    </div>
    <table class='w-100  bangnoidung'>
            <tr>
                <th>ID</th>
                <th>Tên Khách Hàng</th>
                <th>Tên đăng nhập</th>
                <th>Mat Khau</th>
                <th>Tình trạng</th>
                <th>Quyền</th>
            </tr>";
    while($row = $result->fetch_assoc()) {
        $selectTaiKhoan = 'SELECT * FROM taikhoan WHERE TrangThai=1 AND MaTaiKhoan = "'. $row['MaTaiKhoan'] . '"';
        $resultTaiKhoan = mysqli_query($conn, $selectTaiKhoan);
        $rowTaiKhoan = mysqli_fetch_assoc($resultTaiKhoan);
        echo "<tr>
            <td>" . $row['MaKhach']. "</td>
            <td style='width:160px;'>
                <div class='row'>"
                    .$row['TenKhach']."
                </div>
                <div class='row hanhdong'>";
                echo"<a href='#' class='xem'>
                        
                        <div class='col'>
                            Xem
                        </div>
                    </a>";
                
                echo"<a href='editkh.php?hd=s&id=".$row['MaKhach']."' class='sua'>
                        <div class='col'>
                            Sửa
                        </div>
                    </a>";
                
                echo"<a href='xuly/xulyXoaKH.php?idnd=".$row['MaKhach']."&idtk=".$row['MaTaiKhoan']."' class='xoa' onclick=\"return confirm('Bạn có chắc chắn muốn xóa sản phẩm ".$row['TenKhach']."  <3')\">
                
                        <div class='col'>
                            Xóa
                        </div>
                    </a>";
           
        echo "        </div>
            </td>
            <td>" . $rowTaiKhoan["TenDN"]. "</td>
            <td>" . $rowTaiKhoan["MatKhau"]. "</td>";
            if( $rowTaiKhoan["TinhTrang"]=="0")
            echo" <td>Khóa</td>";
            else
            echo" <td>Không Khóa</td>";
           
            foreach ($listQuyen as $ma=>$ten ){
                if($rowTaiKhoan["Quyen"]==$ma){
                    echo "<th>$ten</th>";
            }
           }
        echo "</tr>";
    }
    echo "</table>
    </div>";
} else {
    echo "Không có sản phẩm.";
}

$sql = "SELECT * FROM nhanvien Where TrangThai=1 ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "
    <div id='nhanvien' class='d-block mt-5'>
    <div class='row mark m-0'>
    <p class='text-center'>Bảng nhân viên</p></div>
    <div class='row m-2'>
        <div class='col mx-2 adminthem'>
            <a href='editnv.php?' class='row'>
                <div class='col text-black'>Thêm Nhân Viên</div>
            </a>
        </div>
    </div>
    <table class='w-100 bangnoidung'>
        <tr>
            <th>ID</th>
            <th>Tên Nhân viên</th>
            <th>Tên đăng nhập</th>
            <th>Mat Khau</th>
            <th>Tình trạng</th>
            <th>Quyền</th>
        </tr>";
    while($row = $result->fetch_assoc()) {
        $selectTaiKhoan = 'SELECT * FROM taikhoan WHERE TrangThai=1 AND MaTaiKhoan = "'. $row['MaTaiKhoan'] . '"';
        $resultTaiKhoan = mysqli_query($conn, $selectTaiKhoan);
        $rowTaiKhoan = mysqli_fetch_assoc($resultTaiKhoan);
        echo "<tr>
            <td>" . $row['MaNhanVien']. "</td>
            <td style='width:160px;'>
                <div class='row'>"
                    .$row['TenNhanVien']."
                </div>
                <div class='row hanhdong'>";
                echo"<a href='#' class='xem'>
                        
                        <div class='col'>
                            Xem
                        </div>
                    </a>";
                
                echo"<a href='editnv.php?hd=s&id=".$row['MaNhanVien']."' class='sua'>
                        <div class='col'>
                            Sửa
                        </div>
                    </a>";
                echo"<a href='xuly/xulyXoanv.php?&idnd=".$row['MaNhanVien']."&idtk=".$row['MaTaiKhoan']."' class='xoa' onclick=\"return confirm('Bạn có chắc chắn muốn xóa sản phẩm ".$row['TenNhanVien']." <3')\">                
                        <div class='col'>
                            Xóa
                        </div>
                    </a>";
            
        echo "        </div>
            </td>
            <td>" . $rowTaiKhoan["TenDN"]. "</td>
            <td>" . $rowTaiKhoan["MatKhau"]. "</td>";
            if( $rowTaiKhoan["TinhTrang"]==0)
            echo" <td>Khóa</td>";
            else
            echo" <td>Không Khóa</td>";
            foreach ($listQuyen as $ma=>$ten ){
                if($rowTaiKhoan["Quyen"]==$ma){
                    echo "<th>$ten</th>";
            }
           }
        echo"</tr>";
    }
    echo "</table>
    </div>";
} else {
    echo "Không có sản phẩm.";
}

// Đóng kết nối
$conn->close();
?>
</div>