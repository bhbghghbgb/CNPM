<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/admin.js"></script>
    <script src="../resources/ckeditor/ckeditor.js"></script>


    <link rel="stylesheet" href="./css/admin.css">
    <script src="./js/edit.js"></script>
    <title>Admin</title>
</head>

<body>
    <div class="wrapper" style=" background-color: #6c757d;height:100%;min-height:100vh">
        <?php include('template/topbar_ad.php'); ?>
        <div class="container">
            <div class="row " style="min-height:1200px;padding-bottom:50px;position: relative;">
                <div class="col-2 d-none d-lg-block d-md-block"></div>
                <?php include('template/menu_ad.php'); ?>
                <div id="main" class="col col-12 col-lg-10 col-md-10 ">
                    <?php include('template/header_ad.php'); ?>
                    <div id="content" class="row" style="background-color:#f0f5f8;height:calc(100% - 72px)">
                        <div class="main mx-auto ">
                            <?php
                            include('../db/dbconnect.php');
                            // Sửa Nhân viên
                            if (isset($_GET['id'])) {
                                
                                $id = $_GET['id'];
                                echo '<div class="row justify-content-center display-4">Sửa Nhân Viên</div>';
                                $sql = 'SELECT * FROM nhanvien WHERE MaNhanVien="' . $id . '"';
                                $result = $conn->query($sql);
                                if (mysqli_num_rows($result) > 0) {
                                    // Lấy thông tin nhân viên
                                    $row = mysqli_fetch_assoc($result);
                                    $ten = $row["TenNhanVien"];
                                    $diaChi = $row["DiaChi"];
                                    $sdt = "".$row["SDT"];        
                                    $matk=$row['MaTaiKhoan'];
                                    //lấy quyền nhân viên
                                    $selectTaiKhoan = 'SELECT * FROM taikhoan WHERE MaTaiKhoan = "'. $row['MaTaiKhoan'] . '"';
                                    $resultTaiKhoan = mysqli_query($conn, $selectTaiKhoan);
                                    $rowTaiKhoan = mysqli_fetch_assoc($resultTaiKhoan); 
                                    $tenDN=$rowTaiKhoan['TenDN'];
                                    $matKhau=$rowTaiKhoan['MatKhau'];
                                    $tinhTrang=$rowTaiKhoan['TinhTrang'];
                                    $quyen=$rowTaiKhoan['Quyen'];
                                    $email=$rowTaiKhoan['Email'];
                                    $ngayTao=$rowTaiKhoan['NgayTao'];
                                }
                                else {echo"lỗi";}
                            }
                            // Thêm sản phẩm
                             else {
                                echo '<div class="row justify-content-center display-4">Thêm Nhân Viên</div>';
                                $ten = '';
                                $diaChi = '';
                                $sdt = '';
                                $tenDN='';
                                $matKhau='';
                                $tinhTrang='';
                                $quyen='';
                                $email='';
                                $ngayTao='';
                            }
                            //Luu bảng khuyen mãi, hang va danh muc
                            //lấy quyền người dùng
                               
                                // Xuat danh sách
                                $listQuyen = [];
                                $sql = "SELECT * FROM quyen";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $listQuyen[$row['MaQuyen']]=$row['TenQuyen'];
                                    }
                                }
                           
                            ?>
                            <!-- Tạo form thêm / sửa -->
                            <form action="xuly/xulyEditNV.php" method="post" >
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Tên Nhân Viên: </div>
                                        <div class="col col-9">
                                            <input class="w-100" required type="text" name='ten' value="<?php echo $ten; ?>">
                                        </div>
                                    </label>
                                </div>
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Địa Chỉ Nhân Viên: </div>
                                        <div class="col col-9">
                                            <input class="w-100" required type="text" name='diachi' value="<?php echo $diaChi; ?>">
                                        </div>
                                    </label>
                                </div>
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Số Điện Thoại: </div>
                                        <div class="col col-9">
                                            <input class="w-100" required type="text" name='sdt' value="<?php echo $sdt; ?>">
                                        </div>
                                    </label>
                                </div>
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Tên Đăng Nhập: </div>
                                        <div class="col col-9">
                                            <input class="w-100" required type="text" name='tendn' value="<?php echo $tenDN; ?>">
                                        </div>
                                    </label>
                                </div>
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Mật khẩu: </div>
                                        <div class="col col-9">
                                            <input class="w-100" required type="text" name='matkhau' value="<?php echo $matKhau; ?>">
                                        </div>
                                    </label>
                                </div>
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Tình Trạng: </div>
                                        <div class="col col-9">
                                            <select class="w-100" name="tinhtrang">
                                                <?php
                                                
                                                if($tinhTrang=="0"){
                                                    echo "<option value='0' selected>Khóa</option>";
                                                    echo "<option value='1' >Không khóa</option>";   
                                                }
                                                else {
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
                                                foreach($listQuyen as $ma=>$ten){
                                                    if($ma==$quyen)
                                                    echo'<option value='.$ma.' selected>'.$ten.'</option>';    
                                                    else
                                                    echo"<option value='$ma'>$ten</option>";                                                
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
                                            echo "<a class='text-black' href='editnv.php'> 
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