<?php
session_start();
if (!isset($_SESSION['MaQuyen']) || !in_array($_SESSION['MaQuyen'], ['Admin', 'QLKho', 'NVBanHang'])) {
    $_SESSION['admin_message'] = "Vui lòng đăng nhập với tư cách nhan viên!";
    $_SESSION['admin_message_type'] = "error";
    header("Location: login.php");
    exit;
}
?>