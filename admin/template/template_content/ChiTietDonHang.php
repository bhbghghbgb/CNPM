<link rel="stylesheet" href="../../css/bootstrap.min.css">
<link rel="stylesheet" href="../../css/ChiTietDonHang.css">


<?php
    $Madon = $_GET['CT'];
    $MaTK = $_GET['MaTK'];
    $Date = $_GET['Date'];
    $TT = $_GET['TT'];
    include('../../../db/DAOKhachHang.php');
    $db_kh = new DAOKhachHang();
    $db_kh->connect();
    $data = $db_kh->LayThongTinKhach($MaTK);
    
    if(isset($_GET['PQ'])){
        if($data == null){
            header("location:../../../GioHang.php");
        }
    }
    else{
        if($data == null){
            header("location:../../index.php?id=dh");
        }
    }
?>

<div id="ctdh" class="container">
    <h2>Chi Tiết Hóa Đơn</h2>
    <div class="row">
        <div class="col col-6">
                <p>Mã đơn hàng:  <?php echo $Madon?></p>
                <p>Mã tài khoản: <?php echo $MaTK?></p>
                <p>Địa chỉ: <?php echo $data[2]?></p>
                <!-- Hien thi theo tien viet nam -->
                <p>Tổng tiền: <?php echo number_format($TT,0,',','.')."đ"?></p>
        </div>
        <div class="col col-6">
            <p>Tên khách hàng: <?php echo $data[1]?></p>
            <p>Số điện thoại: <?php echo $data[3]?></p>  
            <p>Ngày đặt: <?php echo $Date?></p>
        </div>
    </div>
    
    
    

    <table id="ds_donhang">
        <tr>
            <th>Mã sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Tổng tiền</th>
        </tr>
        <?php
            include("../../../db/DAOChiTietDonHang.php");
            $db = new DAOChiTietDonHang();
            $db->connect();
            $data = $db->getList($Madon);
            $i=0;
            while ($i < count($data)){
        ?>
                <tr>
                    <td><?php echo $data[$i][0]?></td>
                    <td><?php echo $data[$i][1]?></td>
                    <td><?php echo number_format($data[$i][2],0,',','.')."đ"?></td>
                    <td><?php echo number_format($data[$i][3],0,',','.')."đ"?></td>
                </tr>
        <?php
                $i++;
            }
        ?>
    </table>

    <?php
        if(isset($_GET['PQ'])){
    ?>
        <a href="../../../GioHang.php"><div id="back">Xác nhận</div></a>
    <?php        
         }
         else{
    ?>
            <a href="../../index.php?id=dh"><div id="back">Xác nhận</div></a>
    <?php 

         }
    ?>

</div>