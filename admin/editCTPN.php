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
                        
                            // Phiếu nhập
                              
                                echo '<div class="row justify-content-center display-4">Thêm Chi Tiết Phiếu Nhập</div>';
                               
                            
                            //Luu bảng khuyen mãi, hang va danh muc
                                // Xuat danh sách hãng db ra mảng
                                if(!isset($_GET['CT'])) return;
                                else  {
                                        $Madon=$_GET['CT'];
                                        $MaH = $_GET['Hang'];
                                    }
                                $listSP = [];
                                $sql = "SELECT * FROM sanpham where TrangThai=1 AND MaHang = '".$MaH."'";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $listSP[$row['MaSP']]=$row['Ten'];
                                    }
                                }
                            
                            ?>
                            <!-- Tạo form thêm / sửa -->
                            <form action="xuly/xulyEditCTPN.php" method="post">
                    
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Tên sản phẩm:</div>
                                        <div class="col col-9">
                                            <select class="w-100" name="sanpham">
                                            <?php
                                                foreach($listSP as $ma=>$ten){
                                                    echo"<option value='$ma'>$ten</option>";                                                
                                                }
                                                ?>
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
                                
                                <input type="hidden" name="id" value="<?php echo $Madon?>">
                                <div class="row mt-2">
                                    <div class="col col-3"></div>
                                    <div class="col col-9">
                                        <?php
                                            echo '<input type="submit" class="btn bg-success"name="hd" value="Thêm">';
                                        ?>
                                        <a href="ChiTietPhieuNhap.php?CT=<?php echo$Madon?>">
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