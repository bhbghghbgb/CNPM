<?php
include("./db/DAOThongTinTaiKhoan.php");
include("./db/DAODonHang.php");
include("./db/DAOChiTietDonHang.php");
$daoTTTK = new DAOThongTinTaiKhoan();
$daoDonHang = new DAODonHang();
$MaTK = null;
if (isset($_SESSION['MaTaiKhoan']))
    $MaTK = $_SESSION['MaTaiKhoan'];


/////////////////////////////////////
// xử lý chỉnh thông tin người dùng 
if (isset($_POST['ten'])) {
    $pattern = '/^\+(?:[0-9] ?){6,14}[0-9]$/';
    if (preg_match($pattern, $_POST['sodienthoai'])) {
        
        if ($daoTTTK->hasKhach($MaTK)) {
            if ($daoTTTK->updateKhachHang($MaTK, $_POST['ten'], $_POST['diachi'], $_POST['sodienthoai'])) {
                $_SESSION["message"] = "Thay đổi thông tin thành công";
            }
        } else
            if ($daoTTTK->updateNhanVien($MaTK, $_POST['ten'], $_POST['diachi'], $_POST['sodienthoai'])) {
                $_SESSION["message"] = "Thay đổi thông tin thành công";
        }

    }
    else  echo "<script>addmessText('Số điện thoại bắt buộc 10 chữ số')</script>";
        
    

}

// xử lý chỉnh thông tin người dùng 
if (isset($_POST['tenDN'])) {
    if ($_POST['matkhau'] === $_POST['matkhau1'])
        if ($daoTTTK->updateTaiKhoan($MaTK, $_POST['tenDN'], $_POST['matkhau'], $_POST['email'])) {
            $_SESSION["message"] = "Thay đổi thông tin đăng nhập thành công";
        } else
            echo "<script>alert('Xác nhận mật khẩu lại')</script>";
}




$data = [
    "HoTen" => "",
    "SDT" => "",
    "Email" => "",
    "DiaChi" => "",
    "NgayTao" => "",
    "quyen" => "",
    "TenDN" => ""
];
$SoDonHang = 0;
$SoSP = 0;
if (isset($_SESSION['MaTaiKhoan'])) {
    $data = $daoTTTK->getTaiKhoan($MaTK);
    $SoDonHang = $daoDonHang->getCountDHForTK($MaTK);
    $SoSP = $daoDonHang->getCountSPForTK($MaTK);
}





?>

<link rel="stylesheet" href="./admin/css/bootstrap.min.css">

<div class="row">
    <div class="col col-12 col-sm-7">
        <form action="" method="post">
            <div class="row m-2 ">
                <div class="col col-12 bg-secondary text-light p-3 rounded">
                    <h3>Thông tin người dùng</h3>
                    <div class="box ">
                        <div class="box-text">
                            <div class="row py-2">
                                <div class="col-4">Tên:</div>
                                <div class="col-8">
                                    <input class="w-100" type="text" name="ten" value="<?php echo $data['HoTen'] ?>">
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col-4">Số điện thoại:</div>
                                <div class="col-8">
                                    <input class="w-100" type="text" name="sodienthoai"
                                        value="<?php echo $data['SDT'] ?>">
                                </div>
                            </div>

                            <div class="row py-2">
                                <div class="col-4">Địa chỉ: </div>
                                <div class="col-8">
                                    <input class="w-100" type="text" name="diachi"
                                        value="<?php echo $data['DiaChi'] ?>">
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col-4">Ngày tạo: </div>
                                <div class="col-8">
                                    <input class="w-100" type="text" value="<?php echo $data['NgayTao'] ?>" disabled>
                                </div>
                            </div>
                            <div class="row py-2">
                                <div class="col-4">Quyền: </div>
                                <div class="col-8">
                                    <input class="w-100" type="text" value="<?php echo $data['quyen'] ?>" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="p-1">Lưu thay đổi</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col col-12 col-sm-5">
        <form action="" method='post'>
            <div class="row my-2">
                <div class="col col-12  bg-secondary text-light p-3  rounded">
                    <h3>Thông tin tài khoản</h3>

                    <div class="row py-2">
                        <div class="col-5">Tên Đăng Nhập:</div>
                        <div class="col-7">
                            <input class="w-100" name="tenDN" type="text" value="<?php echo $data['TenDN'] ?>">
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-5">Email:</div>
                        <div class="col-7">
                            <input class="w-100" type="email" name="email" value="<?php echo $data['Email'] ?>">
                        </div>
                    </div>
                    <div class="row py-2">
                        <div class="col-5">Mật khẩu:</div>
                        <div class="col-7">
                            <input class="w-100" id="matkhau" name="matkhau" type="password"
                                placeholder="Nhập mật khẩu mới">
                            <input type="checkbox" onclick="myFunction()">Show Password
                            <input class="w-100" name="matkhau1" type="password" placeholder="Xác nhận mật khẩu mới">
                        </div>
                    </div>
                    <button class="p-1">Lưu thay đổi</button>
                </div>
            </div>
        </form>
        <div class="row my-2">
            <div class="col col-12 bg-secondary text-light p-3 rounded">
                <h3>Thông tin đơn hàng</h3>
                <p>Đơn hàng đã mua:
                    <?php echo $SoDonHang ?> đơn
                </p>
                <p>Sản phẩm đã mua:
                    <?php echo $SoSP ?> sản phẩm
                </p>
                <p>
                    <a class="text-light" href="./giohang.php">Xem chi tiết</a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    function myFunction() {
        var x = document.getElementById("matkhau");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>