<?php
if (isset($_POST['hd'])) {
    $hd = $_POST['hd'];
    include '../../db/dbconnect.php';
    //kiểm tra điều kiện pattern
    if (isset($_POST['id']))
        $id = $_POST['id'];

    $soluong=$_POST['soluong'];
    $dongia=$_POST['dongia'];
    (int)$tongtien=(int)$soluong * (int)$dongia;
    switch ($hd) {
        case "Thêm":
            // Thêm vào db
            $sql = "INSERT INTO chitietphieunhap (MaSP , MaPhieu ,  SoLuong ,  Gia ,  TongGia ,  TrangThai )
            VALUES (
            '".$_POST['sanpham']."',
            $id,
            " . $_POST['soluong'] . ",
            " . $_POST['dongia'] . ",
            $tongtien ,
            1)";
            $result = mysqli_query($conn, $sql);
            echo $sql;
            if ($result) {
                $sql = "UPDATE phieunhaphang SET TongDon =TongDon +$tongtien where MaPhieu = $id";
                echo $sql;
                $result = mysqli_query($conn, $sql);
                echo "<script>
                alert('Thêm Thành Công');
                window.location = '../ChiTietPhieuNhap.php?CT=$id';
                </script>";
                $conn->close();
                return;
            } else {
                echo "<script>
                alert('Đã thêm sản phẩm này rồi');
                window.location = '../ChiTietPhieuNhap.php?CT=$id';
                </script>";
                $conn->close();
                return;
            }
    }
}

?>