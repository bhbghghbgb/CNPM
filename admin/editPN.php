<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="./css/font-awesome_5.15.4_css_all.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">

    
    <script src="./js/admin.js"></script>
    <script src="../resources/ckeditor/ckeditor.js"></script>


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
                        
                            // Phiếu nhập
                              
                                echo '<div class="row justify-content-center display-4">Thêm Phiếu Nhập</div>';
                               
                            
                            //Luu bảng khuyen mãi, hang va danh muc
                                // Xuat danh sách hãng db ra mảng
                                $listHang = [];
                                $sql = "SELECT * FROM hang";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $listHang[$row['MaHang']]=$row['Ten'];
                                    }
                                }
                                
                                $listNhanVien = [];
                                $sql = "SELECT nhanvien.MaTaiKhoan, nhanvien.TenNhanVien , taikhoan.Quyen  from nhanvien 
                                join taikhoan on taikhoan.MaTaiKhoan= nhanvien.MaNhanVien WHERE nhanvien.TrangThai=1 AND taikhoan.TrangThai=1 AND taikhoan.quyen <> 'User'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $listNhanVien[$row['MaTaiKhoan']]=$row['TenNhanVien'];
                                    }
                                }
                            ?>
                            <!-- Tạo form thêm / sửa -->
                            <form action="xuly/xulyEditpn.php" method="post">
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Hãng</div>
                                        <div class="col col-7">
                                            <select class="w-100" name="hang">
                                            <?php
                                                foreach($listHang as $ma=>$ten){
                                                    echo'<option value='.$ma.'>'.$ten.'</option>';                                                
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col col-2">
                                            Xác Nhận
                                        </div>
                                    </label>
                                </div>

                            </form>
                            <form action="xuly/xulyEditCTPN.php" method="post">
                    
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Tên sản phẩm:</div>
                                        <div class="col col-9">
                                            <select class="w-100" name="sanpham">
                                           
                                            </select>
                                        </div>
                                    </label>
                                </div>
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Số lượng: </div>
                                        <div class="col col-9">
                                            <input class="w-100" required type="text" name='soluong' >
                                        </div>
                                    </label>
                                </div>
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Đơn Giá: </div>
                                        <div class="col col-9">
                                            <input class="w-100"  type="text" name='dongia' value="">
                                        </div>
                                    </label>
                                </div>
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Size: </div>
                                        <div class="col col-9">
                                            <input class="w-100"  type="text" name='size' value="">
                                        </div>
                                    </label>
                                </div>
                                
                                
                                <input type="hidden" name="id" value="<?php echo $Madon?>">
                                <div class="row mt-2">
                                    <div class="col col-3"></div>
                                    <div class="col col-9">
                                        <?php
                                            echo '<input type="submit" class="btn bg-success"name="hd" value="Thêm">';
                                        ?>
                                    </div>
                                </div>
                            </form>
                            
                            <div id="ctdh" >
                                <table class="w-100"id="ds_donhang">
                                    <tr>
                                        <th>Mã sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Giá</th>
                                        <th>Tổng tiền</th>
                                        <th style="width:15%">Xóa</th>
                                    </tr>
                                        <tr>
                                            <td>1
                                            </td>
                                            <td>
1                                            </td>
                                            <td>
1                                            </td>
                                            <td>
1                                            </td>
                                            <td> <a href="xuly/xulyXoaCTPN.php?idsp=<?php echo $data[$i][0] ?>&idpn=<?php echo $Madon?>">
                                                    <div>Xóa</div>
                                                </a>
                                            </td>
                                        </tr>
                            </div>
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