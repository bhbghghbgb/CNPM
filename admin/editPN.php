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
                            ?>
                            
                            <a href="" type="button"  style="width: 80px; height:30px; background-color:burlywood; text-align:center; margin-bottom:10px; border:2px solid black; color:black;" >Thoát</a>

                            <!-- List hãng-->
                            <form action="" method="" style="border:2px solid black; background-color:bisque; padding:10px;"   >
                                <button type="button" style="width: 200px; height:30px;background-color:burlywood;" >Gửi yêu cầu nhập hàng</button>
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Hãng</div>
                                        <div class="col col-7">
                                            <select class="w-100" name="hang"  id="selectHang" >
                                            <?php

                                                ?>
                                            </select>
                                        </div>
                                        <button type="button" id="buttonXacNhan" style="width: 100px; height:30px ; text-align:center;background-color:burlywood;" >  Xác nhận </button>
                                    </label>
                                </div>
                                <!-- List sản phẩm -->
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Tên sản phẩm:</div>
                                        <div class="col col-9">
                                            <select class="w-100" name="sanpham" id="selectSanPham" >
                                           
                                            </select>
                                        </div>
                                    </label>
                                </div>
                                <!-- Nhập số lượng -->
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Số lượng: </div>
                                        <div class="col col-9">
                                            <input class="w-100" required type="number" name='soluong' id="inputSoLuong" value="" >
                                        </div>
                                    </label>
                                </div>
                                <!-- Nhập giá nhập -->
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Giá Nhập: </div>
                                        <div class="col col-9">
                                            <input class="w-100"  type="number" name='dongia' value="" id="inputGiaNhap" >
                                        </div>
                                    </label>
                                </div>
                                <!-- List size -->
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Size: </div>
                                        <div class="col col-9">
                                            <select name="soSize" class="w-100" id="selectSize">

                                            </select>
                                        </div>
                                    </label>
                                </div>

                                <button type="button" id="buttonThem"  style="margin-left: 323px; margin-top:10px; width:80px; height:30px;background-color:burlywood; margin-bottom:10px;" >Thêm</button>
                                
                                                     
                            <div id="ctdh" >
                                <style>
                                    .btn {
                                        display: none;
                                    }

                                    tr:hover .btn {
                                        display: inline-block;
                                    }
                                    
                                    #tableCTPN th {
                                        text-align: center;
                                        border: 1px solid black;
                                        padding: 5px;
                                        font-size: 18px;
                                        background-color: orange;
                                    }

                                    #tableCTPN td {
                                        text-align: center;
                                        font-size: 16px;
                                        border: 1px solid black;
                                        padding: 5px;
                                    }
                                
                                </style>
                                <table class="w-100"id="tableCTPN" style="background-color: #f0f5f8;" >
                                    <thead>
                                        <th>Mã sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Size</th>
                                        <th>Giá</th>
                                        <th>Tổng tiền</th>
                                        <th>Hành động</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>001</td>
                                            <td>ADIDAS PRO</td>
                                            <td>5</td>
                                            <td>41</td>
                                            <td>20000</td>
                                            <td>1000000</td>
                                            <td> <button class = "btn" type= "button" style="background-color:red; height:auto;"  >Xóa</button> </ </td>
                                        </tr>
                                        <tr>
                                            <td>001</td>
                                            <td>ADIDAS PRO</td>
                                            <td>5</td>
                                            <td>41</td>
                                            <td>20000</td>
                                            <td>1000000</td>
                                            <td> <button class = "btn" type= "button" style="background-color:red; height:auto;"  >Xóa</button> </td>
                                        </tr>
                                    </tbody>   
                                </table>
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