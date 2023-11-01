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
                            include("../db/DAOChiTietPhieuNhap.php");
                            $db = new DAOChiTietPhieuNhap();
                            $db->connect();
                            include('../db/dbconnect.php');
                            
                            
                            $Madon = $_GET['CT'];
                            $sql = "SELECT * FROM phieunhaphang where TrangThai=1 AND MaPhieu=$Madon" ;
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                if ($row = $result->fetch_assoc()) {
                                    $NgayTao = $row['NgayTao'];
                                    $MaH = $row['MaHang'];
                                    $MaTK = $row['MaTaiKhoan'];
                                } 
                            }
                            $TenH = $db->getTenHang($MaH);
                            $TenNV = $db->getTenNhanVien($MaTK);

                            ?>

                            <div id="ctdh" >
                                <h2>Chi Tiết Phiếu Nhập</h2>
                                <div class="row mx-5">
                                    <div class="col col-6">
                                        <p>Mã phiếu:
                                            <?php echo $Madon ?>
                                        </p>
                                        <p>Ngày tạo:
                                            <?php echo $NgayTao ?>
                                        </p>
                                        <p>Mã hãng:
                                            <?php echo $MaH ?>
                                        </p>
                                        <p>Tên hãng:
                                            <?php echo $TenH[0] ?>
                                        </p>
                                    </div>
                                    <div class="col col-6">
                                        <p>Mã tài khoản:
                                            <?php echo $MaTK ?>
                                        </p>
                                        <p>Tên nhân viên:
                                            <?php echo $TenNV[0] ?>
                                        </p>
                                        <!-- Hien thi theo tien viet nam -->

                                    </div>
                                    <div class="buttonadd">
                                        <a href="editCTPN.php?CT=<?php echo$Madon?>&Hang=<?php echo $MaH?>">
                                            <div class="col text-black">
                                                Thêm Chi tiết
                                            </div>
                                        </a>
                                    </div>
                                </div>



                                <table id="ds_donhang">
                                    <tr>
                                        <th>Mã sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Giá</th>
                                        <th>Tổng tiền</th>
                                        <th style="width:15%">Xóa</th>
                                    </tr>
                                    <?php

                                    $data = $db->getList($Madon);
                                    if ($data == null) {
                                        return;
                                    }
                                    $i = 0;
                                    while ($i < count($data)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $data[$i][0] ?>
                                            </td>
                                            <td>
                                                <?php echo $data[$i][1] ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($data[$i][2], 0, ',', '.') . "đ" ?>
                                            </td>
                                            <td>
                                                <?php echo number_format($data[$i][3], 0, ',', '.') . "đ" ?>
                                            </td>
                                            <td> <a href="xuly/xulyXoaCTPN.php?idsp=<?php echo $data[$i][0] ?>&idpn=<?php echo $Madon?>">
                                                    <div>Xóa</div>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    ?>
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