<?php
include("./checkperm.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./css/font-awesome_5.15.4_css_all.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">


    <script src="./js/admin.js"></script>


    <link rel="stylesheet" href="./css/admin.css">
    <script src="./js/edit.js"></script>
    <title>Admin</title>
</head>

<body>
    <div class="wrapper">
        <?php include('template/topbar_ad.php'); ?>
        <div class="container-fluid">
            <?php include('template/menu_ad.php'); ?>
            <div id="main">
                <?php include('template/header_ad.php'); ?>
                <div id="content" class="row" style="background-color:#f0f5f8;height:calc(100% - 72px)">
                    <div class="main mx-auto ">
                        <?php
                        include('../db/dbconnect.php');
                        // Sửa Khách Hàng
                        if (isset($_GET['id'])) {

                            $id = $_GET['id'];
                            echo '<div class="row justify-content-center display-4">Sửa Khách Hàng</div>';
                            $sql = 'SELECT * FROM khachhang WHERE MaKhach="' . $id . '"';
                            $result = $conn->query($sql);
                            if (mysqli_num_rows($result) > 0) {
                                // Lấy thông tin Khách Hàng
                                $row = mysqli_fetch_assoc($result);
                                $ten = $row["TenKhach"];
                                $diaChi = $row["DiaChi"];
                                $sdt = "" . $row["SDT"];
                                $matk = $row['MaTaiKhoan'];
                                //lấy quyền Khách Hàng
                                $selectTaiKhoan = 'SELECT * FROM taikhoan WHERE MaTaiKhoan = "' . $row['MaTaiKhoan'] . '"';
                                $resultTaiKhoan = mysqli_query($conn, $selectTaiKhoan);
                                $rowTaiKhoan = mysqli_fetch_assoc($resultTaiKhoan);
                                $tenDN = $rowTaiKhoan['TenDN'];
                                $matKhau = $rowTaiKhoan['MatKhau'];
                                $tinhTrang = $rowTaiKhoan['TinhTrang'];
                                $quyen = $rowTaiKhoan['Quyen'];
                                $email = $rowTaiKhoan['Email'];
                                $ngayTao = $rowTaiKhoan['NgayTao'];
                            } else {
                                echo "lỗi";
                            }
                        }
                        // Thêm sản phẩm
                        else {
                            echo '<div class="row justify-content-center display-4">Thêm Khách Hàng</div>';
                            $ten = '';
                            $diaChi = '';
                            $sdt = '';
                            $tenDN = '';
                            $matKhau = '';
                            $tinhTrang = '';
                            $quyen = '';
                            $email = '';
                            $ngayTao = '';
                        }
                        //Luu bảng khuyen mãi, hang va danh muc
                        //lấy quyền người dùng

                        // Xuat danh sách
                        $listQuyen = [];
                        $sql = "SELECT * FROM quyen";
                        $result = $conn->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $listQuyen[$row['MaQuyen']] = $row['TenQuyen'];
                            }
                        }

                        ?>
                        <!-- Tạo form thêm / sửa -->
                        <form action="xuly/xulyEditKH.php" method="post">
                            <div class="row mt-2">
                                <label class="row">
                                    <div class="col col-3">Tên Khách Hàng: </div>
                                    <div class="col col-9">
                                        <input class="w-100" required type="text" name='ten' value="<?php echo $ten; ?>">
                                    </div>
                                </label>
                            </div>
                            <div class="row mt-2">
                                <label class="row">
                                    <div class="col col-3">Địa Chỉ Khách Hàng: </div>
                                    <div class="col col-9">
                                        <input class="w-100" required type="text" name='diachi' value="<?php echo $diaChi; ?>">
                                    </div>
                                </label>
                            </div>
                            <div class="row mt-2">
                                <label class="row">
                                    <div class="col col-3">Số Điện Thoại: </div>
                                    <div class="col col-9">
                                        <input class="w-100" required type="number" name='sdt' value="<?php echo $sdt; ?>">
                                    </div>
                                </label>
                            </div>
                            <div class="row mt-2">
                                <label class="row">
                                    <div class="col col-3">Tên Đăng Nhập: </div>
                                    <div class="col col-9">
                                        <input class="w-100" required type="text" name='tendn' value="<?php echo $tenDN; ?>">
                                        <input type="hidden" name="MaTKKH" value="<?php if (isset($_GET['id'])) {
                                                                                        echo $_GET['id'];
                                                                                    } ?>">
                                    </div>
                                </label>
                            </div>
                            <!-- ------------------------------------------------------------------------------------------------ -->
                            <div class="row mt-2">
                                <label class="row">
                                    <div class="col col-3">Mật khẩu: </div>
                                    <div class="col col-9">
                                        <?php
                                        if (isset($_GET['hd'])) {
                                            echo '<input class="w-100" type="text" name="matkhau" value="">';
                                        } else {
                                            echo '<input class="w-100" required type="text" name="matkhau" value="">';
                                        }
                                        ?>
                                    </div>
                                </label>
                            </div>
                            <!-- ------------------------------------------------------------------------------------------------- -->
                            <div class="row mt-2">
                                <label class="row">
                                    <div class="col col-3">Tình Trạng: </div>
                                    <div class="col col-9">
                                        <select class="w-100" name="tinhtrang">
                                            <?php
                                            if ($tinhTrang == "0") {
                                                echo "<option value='1' >Không khóa</option>";
                                                echo "<option value='0' selected>Khóa</option>";
                                            } else {
                                                echo "<option value='1' selected>Không khóa</option>";
                                                echo "<option value='0' >Khóa</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </label>
                            </div>
                            <div class="row mt-2">
                                <label class="row">
                                    <div class="col col-3">Email: </div>
                                    <div class="col col-9">
                                        <input class="w-100" required type="text" name='email' value="<?php echo $email; ?>">
                                    </div>
                                </label>
                            </div>

                            <div class="row mt-2">
                                <label class="row">
                                    <div class="col col-3">Quyền:</div>
                                    <div class="col col-9">
                                        <select class="w-100" name="quyen">
                                            <?php
                                            foreach ($listQuyen as $ma => $ten) {
                                                if ($ma == $quyen)
                                                    echo '<option value=' . $ma . ' selected>' . $ten . '</option>';
                                                else
                                                    echo "<option value='$ma'>$ten</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </label>
                            </div>



                            <div class="row mt-2">
                                <div class="col col-3"></div>
                                <div class="col col-9">
                                    <?php
                                    if (isset($_GET['id'])) {
                                        echo "<input type='hidden' name='idtk' value=" . $matk . ">";
                                        echo "<input type='hidden' name='id' value=" . $id . ">";
                                        echo '<a><input type="submit" class="btn bg-success" name="hd" value="Lưu"></a>';
                                        echo "<a class='text-black' href='editkh.php'> 
                                                <div class='btn bg-secondary'>Thêm mới</div>
                                            </a>";
                                    } else
                                        echo '<input type="submit" class="btn bg-success"name="hd" value="Thêm">';
                                    ?>
                                    <a href="index.php?id=nd">
                                        <div class='btn text-black bg-danger'>Hủy</div>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

    </div>
    <?php
    $conn->close();
    ?>
    <script>
        showmenu();
        choosemenu();
    </script>
</body>

</html>