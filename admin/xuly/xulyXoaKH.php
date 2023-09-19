<?php
include '../../db/dbconnect.php';
if (isset($_GET['idnd'])) {
    
    $idnd = $_GET['idnd'];
    $idtk = $_GET['idtk'];
    $sql = 'UPDATE khachhang SET TrangThai=0 WHERE MaKhach = "' . $idnd . '"';
    $result = $conn->query($sql);
    if ($result) {
        $sql = 'UPDATE taikhoan SET TrangThai=0 WHERE MaTaiKhoan = "' . $idtk . '"';
        $result = $conn->query($sql);
        if($result){
            echo "<script>
            alert('Xóa Thành Công');
            window.location = '../index.php?id=nd'
            </script>";
            $conn->close();
            return;
        }
    }
    echo "<script>
    alert('Xóa không Thành Công');
    window.location = '../index.php?id=nd'
    </script>";
    $conn->close();
    return;
}
?>