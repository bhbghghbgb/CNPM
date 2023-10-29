<?php
include '../../db/dbconnect.php';
include("../../db/DAOSP.php");
$db = new DAOSP();
if (isset($_GET['idsp'])) {
    $idsp = $_GET['idsp'];
    $result = $db->deleteSP($idsp);
    if ($result)
        echo "<script>
        alert('Xóa Thành Công');
        window.location = '../index.php?id=sp'
        </script>";
    $conn->close();
    return;

} else {
    echo "<script>
    alert('Xóa không Thành Công');
    window.location = '../index.php?id=sp'
    </script>";
    $conn->close();
    return;
}
?>