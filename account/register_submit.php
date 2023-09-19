<?php
// session_start();
// Kết nối cơ sở dữ liệu
$conn = mysqli_connect('localhost', 'root', '', 'ql_cuahanggiay') or die ('Lỗi kết nối'); mysqli_set_charset($conn, "utf8");

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
        echo '<script language="javascript">alert("Vui lòng nhập đầy đủ thông tin!"); window.location="index.php";</script>';
    }

    //Mã hoá mật khẩu:
    $password = md5($password);

    // Kiểm tra username hoặc email có bị trùng hay không
    $sql = "SELECT * FROM taikhoan WHERE TenDN = '$username' OR Email = '$email'";
    // Thực thi câu truy vấn
    $result = mysqli_query($conn, $sql);
    $tinhtrang=1;
    $quyen="User";
    $today = date("Y-m-d");
     // Nếu kết quả trả về lớn hơn 1 thì nghĩa là username hoặc email đã tồn tại trong CSDL
    if (mysqli_num_rows($result) > 0)
    {
        echo '<script language="javascript">alert("Username hoặc Email đã tồn tại!"); window.location="index.php";</script>';
        // Dừng chương trình
        die ();
    }
    else {
        $sql1 = "INSERT INTO `taikhoan`( `TenDN`, `MatKhau`, `Email`, `NgayTao`, `TinhTrang`, `Quyen`,`TrangThai`) VALUES ('$username','$password','$email','$today','$tinhtrang','$quyen',1)";
        $result1= mysqli_query($conn, $sql1);
        $mataikhoan=getMaTaiKhoan($conn);
        $sql2 = "INSERT INTO `khachhang`(`TenKhach`, `DiaChi`, `SDT`, `MaTaiKhoan`) VALUES ('$TenKhach','$DiaChi','$SDT','$mataikhoan[0]')";
        $result2= mysqli_query($conn, $sql2);
        echo '<script language="javascript">alert("Ban da dang ky thanh cong!"); window.location="index.php";</script>';
        $_SESSION['MaTaiKhoan'] = $mataikhoan[0];
        die(); 
    }
}
?>
