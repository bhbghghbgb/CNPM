<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
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
                            <link rel="stylesheet" href="./css/ChiTietDonHang.css">
                            <div class="row justify-content-center display-4">Chi tiết phiếu nhập</div>
                            
                            <?php 
                                $maPN = $_GET['MaPN'];
                                include('../db/DAOPhieuNhap.php');
                                $daoPhieuNhap = new DAOPhieuNhap();
                                $phieuNhap = $daoPhieuNhap->getPN($maPN);
                                ?>

                                <div id="ctdh" >
                                <a href="./index.php?id=pn" type="button"  style="width: 80px; height:30px; background-color:burlywood; text-align:center; margin-bottom:0px; border:2px solid black; color:black;" >Thoát</a>
                                <h2>Chi Tiết Phiếu Nhập</h2>
                                <div class="row mx-5">
                                    <div class="col col-6">
                                        <p>Mã phiếu:
                                           <?php echo  $phieuNhap[0]['MaPhieu'];  ?>
                                        </p>
                                        <p>Ngày tạo:
                                            <?php echo  $phieuNhap[0]['NgayTaoPN'];  ?>
                                        </p>
                                        <p>Mã hãng:
                                             <?php echo  $phieuNhap[0]['MaHang'];  ?>
                                        </p>
                                        <p>Tên hãng:
                                            <?php echo  $phieuNhap[0]['Ten'];  ?>
                                        </p>
                                    </div>
                                    <div class="col col-6">
                                        <p>Mã tài khoản:
                                            <?php echo  $phieuNhap[0]['MaTaiKhoan'];  ?>
                                        </p>
                                        <p>Tên nhân viên:
                                            <?php echo  $phieuNhap[0]['TenNhanVien'];  ?>
                                        </p>
                                        <!-- Hien thi theo tien viet nam -->
                                        <p>Tổng đơn:
                                            <?php echo  $phieuNhap[0]['TongDon'];  ?>
                                        </p>

                                    </div>
                                </div>



                                <table id="ds_donhang">
                                    <thead>
                                        <th>Mã sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Size</th>
                                        <th>Số Lượng</th>
                                        <th>Giá</th>
                                        <th>Tổng tiền</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                             $maPN = $_GET['MaPN'];
                                             include('../db/DAOChiTietPhieuNhap.php');
                                             $daoCTPN = new DAOChiTietPhieuNhap();
                                             $ListCTPN = $daoCTPN->getListCTPN($maPN);
                                             if ($ListCTPN!= null){
                                                foreach ($ListCTPN as $row) {
                                                    $MaSP =  $row['MaSP'];
                                                    $TenSP = $row['Ten'];
                                                    $Size = $row['Size'];
                                                    $SoLuong = $row['SoLuong'];
                                                    $Gia = $row['GiaNhap'];
                                                    $TongTien = $row['TongGia'];
                                                    
                                                    echo "<tr><td>$MaSP</td><td>$TenSP</td><td>$Size</td><td>$SoLuong</td><td>$Gia</td><td>$TongTien</td>";
                                                }
                                            }
                                        
                                        
                                        ?>
                                    </tbody>
                                </table>   
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    </div>
    <?php
    ?>
    <script>
        showmenu();
        choosemenu();
    </script>
</body>