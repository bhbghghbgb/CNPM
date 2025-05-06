<?php
session_start();
$_SESSION['location'] = "index.php";
include('./db/dbconnect.php');
if (isset($_POST['dangnhap'])) {
    $username = trim($_POST['username']); //trim để loại bỏ khoảng trắng ở đầu và cuối của username
    $password = trim($_POST['password']);

    $sql = "SELECT MaTaiKhoan,TenDN,MatKhau,Quyen FROM taikhoan WHERE TrangThai=1 AND TinhTrang = 1 AND TenDN = '$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
        $_SESSION["message"] = "Username không tồn tại!";
        header("Location: index.php");
        exit;
    }
    //Kiểm tra mật khẩu có đúng không:
    $row = mysqli_fetch_array($result);
    $password = md5($password);
    if ($password != $row['MatKhau']) {
        $_SESSION["message"] = "Mật khẩu không đúng. Vui lòng nhập lại!";
        header("Location: index.php");
        exit;
    }
    // la nhan vien dang nhap, nhan vien ko dc dang nhap o day
    // Kiểm tra có quyền admin hoặc các quyền khác ngoài User không
    if ($row['Quyen'] != "User") {
        $_SESSION['message'] = "Username không tồn tại!";
        header("Location: index.php");
        exit;
    } else {
        //Lưu tên đăng nhập
        $_SESSION['MaTaiKhoan'] = $row['MaTaiKhoan'];
        $_SESSION["message"] = "Bạn đã đăng nhập thành công";
        header("Location: index.php");
        exit;
    }
}
