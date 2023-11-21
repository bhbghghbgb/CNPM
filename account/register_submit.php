<?php
// session_start();
// Kết nối cơ sở dữ liệu
include("./db/dbconnect.php");
include("./db/DAOThongTinTaiKhoan.php");
function getMaTaiKhoan($conn){
    $sql5 = 'SELECT MAX(MaTaiKhoan) FROM taikhoan';
    $data = null;
    if($result = mysqli_query($conn,$sql5)){
        while($row = mysqli_fetch_array($result)){
            $data[] = $row;
        }
        mysqli_free_result($result);
        return $data[0];
    }
}

// Dùng isset để kiểm tra Form
if(isset($_POST['dangky'])){
    $username = trim($_POST['username']); //trim để loại bỏ khoảng trắng ở đầu và cuối của username
    $password = trim($_POST['password']);
    $email = trim($_POST['email']);
    $TenKhach= trim($_POST['TenKhach']);
    $DiaChi= trim($_POST['DiaChi']);
    $SDT= trim($_POST['SDT']);


    if(!$username || !$password || !$email) {
        $_SESSION["message"] = "Vui lòng nhập đầy đủ thông tin!";
        header("Location: index.php");
        exit;
    }

    if (!preg_match('/^[a-zA-Z0-9]{5,}$/', $username)) {
        $_SESSION["message"] = "Tên đăng nhập phải có ít nhất 5 kí tự và chỉ chứa chữ cái và số !";
        header("Location: index.php");
        exit;
    }
    if (!preg_match('/^\S{5,}$/', trim($password))) {
        $_SESSION["message"] = "Mật khẩu phải lớn hơn hoặc bằng 5 ký tự, và không chứa khoảng trắng !";
        header("Location: index.php");
        exit;
    }
    

    $pattern = '/^0[0-9]{9}$/';
    if (preg_match($pattern, $SDT) == false) {
        $_SESSION["message"] = "Sai định dạng số điện thoại";
        header("Location: index.php");
        exit;
    }
   
    

    

    

    

    //Mã hoá mật khẩu:
    $password = md5($password);

    // Kiểm tra username hoặc email có bị trùng hay không
    $sql = "SELECT * FROM taikhoan WHERE TrangThai = 1 AND TenDN = '$username' OR TrangThai = 1 AND Email = '$email'";
    // Thực thi câu truy vấn
    $result = mysqli_query($conn, $sql);
    $tinhtrang=1;
    $quyen="User";
    $today = date("Y-m-d");
     // Nếu kết quả trả về lớn hơn 1 thì nghĩa là username hoặc email đã tồn tại trong CSDL
    if (mysqli_num_rows($result) > 0)
    {
        $_SESSION["message"] = "Username hoặc Email đã tồn tại!";
        header("Location: index.php");
        exit;
    }
    else {
        $sql1 = "INSERT INTO `taikhoan`( `TenDN`, `MatKhau`, `Email`, `NgayTao`, `TinhTrang`, `Quyen`,`TrangThai`) VALUES ('$username','$password','$email','$today','$tinhtrang','$quyen',1)";
        $result1= mysqli_query($conn, $sql1);
        $mataikhoan=getMaTaiKhoan($conn);
        $sql2 = "INSERT INTO `khachhang`(`TenKhach`, `DiaChi`, `SDT`, `MaTaiKhoan`) VALUES ('$TenKhach','$DiaChi','$SDT','$mataikhoan[0]')";
        $result2= mysqli_query($conn, $sql2);

        $_SESSION['MaTaiKhoan'] = $mataikhoan[0];
        $_SESSION["message"] = "Bạn đã đăng kí thành công!";
        header("Location: index.php");
        exit;
    }
}
?>
