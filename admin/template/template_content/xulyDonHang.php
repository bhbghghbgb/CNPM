<?php
    include("../../../db/DAOChiTietDonHang.php");
    include("../../../db/DAOSP.php");
    include("../../../db/DAODonHang.php");
    if(isset($_GET['MaDon'])){
        $MaDon = $_GET['MaDon'];
        $dbCTDH = new DAOChiTietDonHang();
        $dbCTDH->connect();

        $dbSP = new DAOSP();
        $dbSP->connect();


        $db = new DAODonHang();
        $db->connect();

        //Lấy 2 danh sách ra
        $dataCTDH = $dbCTDH->getList($MaDon);

        $dataSP = $dbSP->getALL();


        //Tạo biến đếm số sản phẩm thiếu hàng

        $count = 0;
        $ThongTin = array();
        $k = 0;

        for ($i = 0; $i < count($dataCTDH);$i++){
            for ($j = 0; $j < count($dataSP);$j++){
                if($dataCTDH[$i][0] == $dataSP[$j][0]){
                    $SoLuongMoi = $dataSP[$j][9] - $dataCTDH[$i][1];
                    $ThongTin[$dataCTDH[$i][0]] = $SoLuongMoi;
                    if($SoLuongMoi < 0){
                        $count += 1;
                        
                    }
                    break;
                }
            }
        }

        if($count != 0){
            $HangThieu = "";
            ?>
                <p id="ThongBao-title">Đơn hàng: <?php echo $MaDon?></p>
            <?php
            foreach($ThongTin as $MaSP => $value)
            {       
                if($value <= 0)  {
                    $HangThieu = $HangThieu . '\nMã hàng ' . $MaSP . ' thiếu '. -1 * $value . 'đôi' ;
?>
                    <p class="ThongBao-content">Mã hàng <?php echo $MaSP?> thiếu <?php echo -1 * $value?> đôi</p>
<?php
                }
            }
            echo '<script>alert("Xử lý đơn '.$MaDon.' thất bại '.$HangThieu.'");</script>';
            
        }
        else{
            foreach($ThongTin as $MaSP => $value)
            {
                if($dbSP->TruSLBanHang($MaSP,$value)){

                }
                else{
                    echo "<script>alert('Xử lý đơn ".$MaDon." thất bại')</script>";
                    return;
                }
            }

            if($db->xulyDon($MaDon)){
                echo "<script>alert('Xử lý đơn ".$MaDon." thành công');window.location='index.php?id=dh';</script>";

            }
    
        }
    }
?>