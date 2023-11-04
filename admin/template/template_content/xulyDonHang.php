<?php
    include("../../../db/DAOChiTietDonHang.php");
    include("../../../db/DAO/DataProvider.php");
    include("../../../db/DAOSP.php");
    include("../../../db/DAODonHang.php");
    if(isset($_GET['MaDon'])){
        $MaDon = $_GET['MaDon'];
        $dbCTDH = new DAOChiTietDonHang();

        $dbSP = new DAOSP();
        $dbSP->connect();


        $db = new DAODonHang();
        $db->connect();

        //Lấy 2 danh sách ra
        $dataCTDH = $dbCTDH->getList($MaDon);


        //Tạo biến đếm số sản phẩm thiếu hàng

        $count = 0;
        $ThongTin = array();
        $k = 0;

        echo print_r($dataCTDH);
        foreach($dataCTDH as $data ) {
            $MaSP = $data->getMaSanPham();
            $Size = $data->getSize();
            $dataSP = $dbSP->getThongTinSanPham($MaSP,$Size);
            print_r($dataSP);
            $SoLuongMoi = $dataSP["SLTonKho"] - $data->getSoLuong();
            array_push($ThongTin,array($MaSP,$Size,$SoLuongMoi)); // thông tin chứa mảng 2 chiều, mỗi phần tử con chứa mảng theo chỉ mục
                                                            // 0 là mã sp , 1 là size, 2 là So lượng sau khi bán 
            if($SoLuongMoi < 0) {
                $count+=1;
            }
        }

        // for ($i = 0; $i < count($dataCTDH);$i++){
        //     for ($j = 0; $j < count($dataSP);$j++){
        //         if($dataCTDH[$i][0] == $dataSP[$j][0]){
        //             $SoLuongMoi = $dataSP[$j][9] - $dataCTDH[$i][1];
        //             $ThongTin[$dataCTDH[$i][0]] = $SoLuongMoi;
        //             if($SoLuongMoi < 0){
        //                 $count += 1;
                        
        //             }
        //             break;
        //         }
        //     }
        // }

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
            foreach($ThongTin as $value)
            {
                echo print_r($value);
                if($dbSP->TruSLBanHang($value[0],$value[1],$value[2])){

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