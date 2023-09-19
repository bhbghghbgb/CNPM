<?php
    session_start();
    // header('Content-Type: text/html; charset=utf-8');
    $conn = mysqli_connect('localhost', 'root', '', 'ql_cuahanggiay') or die ('Lỗi kết nối'); mysqli_set_charset($conn, "utf8");
    if (isset($_POST['dangnhap'])) {
        $username = trim($_POST['username']); //trim để loại bỏ khoảng trắng ở đầu và cuối của username
        $password = trim($_POST['password']);

        if(!$username || !$password) {
            echo '<script language="javascript">alert("Vui lòng nhập đầy đủ thông tin!"); window.location="index.php";</script>';
        }


        $sql = "SELECT MaTaiKhoan,TenDN,MatKhau,Quyen FROM taikhoan WHERE TrangThai=1 AND TenDN = '$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) == 0){
            echo '<script language="javascript">alert("Username không tồn tại!"); window.location="index.php";</script>';
            // Dừng chương trình
            die ();
        }
        //Kiểm tra mật khẩu có đúng không:
        $row = mysqli_fetch_array($result);
        $password = md5($password);
        if ($password != $row['MatKhau']) {
            echo '<script language="javascript">alert("Mật khẩu không đúng. Vui lòng nhập lại!"); window.location="index.php";</script>';
            exit;
        }
        if($row['Quyen'] != "User") {
            $_SESSION['MaTaiKhoan'] = $row['MaTaiKhoan'];
            $_SESSION['MaQuyen'] = $row['Quyen'];
            echo '<script language="javascript">alert("Ban da dang nhap thanh cong!"); window.location="admin/index.php";</script>';
        }
        else{
            //Lưu tên đăng nhập
            $_SESSION['MaTaiKhoan'] = $row['MaTaiKhoan'];
            
            echo '<script language="javascript">alert("Ban da dang nhap thanh cong!"); window.location="index.php";</script>';
            die();
        }
        
    }
?>