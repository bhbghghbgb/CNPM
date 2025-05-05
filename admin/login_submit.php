<?php
session_start();
include('../db/dbconnect.php');

if (isset($_POST['admin_login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Kiểm tra username có tồn tại không
    $sql = "SELECT MaTaiKhoan, TenDN, MatKhau, Quyen FROM taikhoan WHERE TrangThai=1 AND TinhTrang=1 AND TenDN='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        $_SESSION['admin_message'] = "Tên đăng nhập không tồn tại!";
        $_SESSION['admin_message_type'] = "error";
        header("Location: login.php");
        exit;
    }

    // Kiểm tra mật khẩu có đúng không
    $row = mysqli_fetch_array($result);
    $hashed_password = md5($password);
    if ($hashed_password != $row['MatKhau']) {
        $_SESSION['admin_message'] = "Mật khẩu không đúng. Vui lòng nhập lại!";
        $_SESSION['admin_message_type'] = "error";
        header("Location: login.php");
        exit;
    }

    // Kiểm tra có quyền admin hoặc các quyền khác ngoài User không
    if ($row['Quyen'] == 'User') {
        $_SESSION['admin_message'] = "Bạn không có quyền truy cập vào trang quản trị!";
        $_SESSION['admin_message_type'] = "error";
        header("Location: login.php");
        exit;
    }

    // Đăng nhập thành công, lưu session và chuyển hướng
    $_SESSION['MaTaiKhoan'] = $row['MaTaiKhoan'];
    $_SESSION['MaQuyen'] = $row['Quyen'];
    $_SESSION['admin_message'] = "Chào mừng " . $row['TenDN'] . " đã đăng nhập thành công!";
    $_SESSION['admin_message_type'] = "success";
    
    header("Location: index.php");
    exit;
}

// Nếu không phải POST request, chuyển hướng về trang đăng nhập
header("Location: login.php");
exit;
?>
