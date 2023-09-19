<?php
if (isset($_POST['hd'])) {
    $hd = $_POST['hd'];
    include '../../db/dbconnect.php';
    



    switch ($hd) {
        case "Lưu":
            //kiểm tra điều kiện pattern
            if(isset($_POST['id']))$id=$_POST['id'];

            if (preg_match('/^0\d{9}$/', $_POST['sdt']) == false) {
                echo "<script>
                    alert('Số điện thoại không hợp lệ. Vui lòng nhập số điện thoại 10 chữ số và bắt đầu bằng số 0.');
                    window.location = '../editnv.php?id=$id&hd=$hd'
                    </script>";
                return;
            }

            if (!preg_match('/^[a-zA-Z0-9]{5,}$/', $_POST['tendn'])) {
                echo "<script>alert('Tên đăng nhập phải có ít nhất 5 kí tự và chỉ chứa chữ cái và số.'); window.location = '../editnv.php?id=$id&hd=$hd';</script>";
                return;
            }
            if (substr($_POST['email'], -10) !== "@gmail.com") {
                echo "<script>alert('Email phải có đuôi @gmail.com.'); window.location = '../editnv.php?id=$id&hd=$hd';</script>";
                return;
            }
            
            // Truy vấn danh sách tai khoan
            $mataikhoan=$_POST['idtk'];
            $sql = "UPDATE taikhoan  SET TenDN='" . $_POST['tendn'] . "',
                                        MatKhau='" . md5($_POST['matkhau']) . "',
                                        Email ='" . $_POST['email'] ."',
                                        Quyen ='". $_POST['quyen'] ."',
                                        TinhTrang ='". $_POST['tinhtrang'] ."'
                                        WHERE MaTaiKhoan='" . $_POST['idtk'] . "'";
                                       
            $result = mysqli_query($conn, $sql);
            if(!$result)return;
            // Truy vấn danh sách khách hàng
            $sql = "UPDATE nhanvien   SET TenNhanVien='" . $_POST['ten'] . "',
                                        DiaChi='" . $_POST['diachi'] . "',
                                        SDT ='" . $_POST['sdt'] . "',
                                        MaTaiKhoan='" . $_POST['idtk'] . "'
                                        WHERE MaNhanVien='" . $_POST['id'] . "'";
                                       
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>
                alert('Sửa Thành Công');
                window.location = '../editnv.php?id=$id&hd=$hd';
                </script>";
                $conn->close();
                return;
            } else {
                echo "<script>
                alert('Sửa không Thành Công');
                 window.location = '../editnv.php';
                </script>";
                $conn->close();
                return;
            }
        case "Thêm":

            //kiểm tra điều kiện pattern
            if(isset($_POST['id']))$id=$_POST['id'];

            if (preg_match('/^0\d{9}$/', $_POST['sdt']) == false) {
                echo "<script>
                    alert('Số điện thoại không hợp lệ. Vui lòng nhập số điện thoại 10 chữ số và bắt đầu bằng số 0.');
                    window.location = '../editnv.php'
                    </script>";
                return;
            }

            if (!preg_match('/^[a-zA-Z0-9]{5,}$/', $_POST['tendn'])) {
                echo "<script>alert('Tên đăng nhập phải có ít nhất 5 kí tự và chỉ chứa chữ cái và số.'); window.location = '../editnv.php';</script>";
                return;
            }
            if (substr($_POST['email'], -10) !== "@gmail.com") {
                echo "<script>alert('Email phải có đuôi @gmail.com.'); window.location = '../editnv.php';</script>";
                return;
            }

            //tạo id mơi
            // Tao listid da co san
            $listId = [];
            $sql = "SELECT MaNhanVien FROM nhanvien";
            $result = $conn->query($sql);
            // Kiểm tra kết quả trả về
            if ($result->num_rows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $listId[$i] = $row['MaNhanVien'];
                    $i++;
                }
            }
            // tìm id thích hợp
            for ($i = 1; $i < 1000; $i++) {
                $found = false;
                if (!in_array($i, $listId)) {
                    $id = $i;
                    break;
                }
            }
            // ép kiểu string
            $id = (string) $id;
            //////////////////////////////////////
            //tạo mã taikhoan mới
            // Tao listid da co san
            $listId = [];
            $sql = "SELECT MaTaiKhoan FROM taikhoan";
            $result = $conn->query($sql);
            // Kiểm tra kết quả trả về
            if ($result->num_rows > 0) {
                $i = 0;
                while ($row = $result->fetch_assoc()) {
                    $listId[$i] = $row['MaTaiKhoan'];
                    $i++;
                }
            }
            // tìm id thích hợp
            for ($i = 1; $i < 1000; $i++) {
                $found = false;
                if (!in_array($i, $listId)) {
                    $mataikhoan = $i;
                    break;
                }
            }
            // ép kiểu string
            $mataikhoan = (string) $mataikhoan;

            // Thêm vào db
            $sql = "INSERT INTO taikhoan (TenDN,MatKhau,Email ,Quyen ,TinhTrang ,MaTaiKhoan,NgayTao ,TrangThai)
            VALUES (
            '" . $_POST['tendn'] . "',
            '" . md5($_POST['matkhau']). "',
            '" . $_POST['email'] . "',
            '" . $_POST['quyen'] . "',
            '" . $_POST['tinhtrang'] . "',
            '" . $mataikhoan . "',
            CURDATE(),1)";                                      
            $result = mysqli_query($conn, $sql);
            if(!$result)return;
            // Truy vấn danh sách khách hàng
            $sql = "INSERT INTO nhanvien  (TenNhanVien,DiaChi,SDT ,MaTaiKhoan,MaNhanVien,TrangThai)
            VALUES (
                '" . $_POST['ten'] . "',
                '" . $_POST['diachi'] . "',
                '" . $_POST['sdt'] . "',
                '" . $mataikhoan . "',
                '" . $id . "',
                1)";
                                       
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>
                alert('Thêm Thành Công');
                window.location = '../index.php?id=nd';
                </script>";
                $conn->close();
                return;
            } else {
                echo "<script>
                alert('Thêm không Thành Công');
                window.location = '../editnv.php?id=$id&hd=$hd';
                </script>";
                $conn->close();
                return;
            }
    }
    // Đóng kết nối
}

?>