<?php
include '../../db/dbconnect.php';
if(isset($_GET['idpn'])) {
    $idpn = $_GET['idpn'];
    $idsp = $_GET['idsp'];
    $sql = 'DELETE FROM chitietphieunhap
    WHERE MaPhieu = '.$idpn.' AND MaSP = "'.$idsp.'"';
    $result = $conn->query($sql);
    if($result)
    echo "<script>
    alert('Xóa Thành Công');
    window.location = '../ChiTietPhieuNhap.php?CT=$idpn';
    </script>";
    $conn->close();
    return;
}
?>
