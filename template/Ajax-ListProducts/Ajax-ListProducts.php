<?php
        if(isset($_GET['MaDM']) || isset($_GET['Sale']) || isset($_GET['MaHang']) || isset($_GET['Find'])){

            function TinhTienGiam($TiLegiam, $data){
                return $data - $data*$TiLegiam/100;
            }

            include('../../db/DAOSP.php');
            $db = new DAOSP();
            $db->connect();
            $data = null;

            $sql = "SELECT *, hang.Ten as TenHang FROM sanpham,hang WHERE sanpham.TrangThai = 1 AND sanpham.MaHang = hang.MaHang ";

            //su dung cach ghep chuoi de toi uu hoa cac thao tac loc
            if(isset($_GET['MaDM'])){
                $MaDM = $_GET['MaDM'];
                //Khoi tao chuoi de truy van theo danh muc
                $sql = $sql . " AND MaDM = '".$MaDM."'";
            }

            if(isset($_GET['Sale'])){
                $sql = $sql . " AND MaKhuyenMai != '#' ";
            }





            //Kiem tra xem nguoi dung co chon rieng 1 hang nao tu top menu khong
            if(isset($_GET['MaHang'])){
                $Hang = $_GET['MaHang'];
                $sql = $sql . "AND sanpham.MaHang = '".$Hang."' ";
            }
            
            
            
            //kiem tra xem co loc hay khong
                if(isset($_GET['Hang'])){
                    //Neu co chon Hang thi them dieu kien loc hang vao chuoi truy van
                    $Hang = $_GET['Hang'];
                    if($Hang != "All" && $Hang != ""){
                        $sql = $sql . "AND sanpham.MaHang = '".$Hang."' ";
                    }
                }

                if (isset($_GET['Gia'])){
                    // Dua dieu kien loc theo gia vao cau truy van
                    $Gia = $_GET['Gia'];
                    if($Gia != ""){
                        $sql = $sql . ' AND sanpham.Gia';
                        switch ($Gia) {
                            case '0-1000000':{
                                $sql = $sql . " < 1000000 ";
                                break;
                            }
                            case '1000000-1500000':{
                                $sql = $sql . " BETWEEN 1000000 AND 1500000 " ;
                                break;
                            }
                            case "1500000-2000000":{
                                $sql = $sql . " BETWEEN 1500000 AND 2000000 " ;
                                break;
                            }
                            case "2000000-3000000":{
                                $sql = $sql . " BETWEEN 2000000 AND 3000000 " ;
                                break;
                            }
                            case "3000000-":{
                                $sql = $sql . " > 3000000 ";
                                break;
                            }

                        }
                    }

                }
            //Thuoc hien tim kiem theo chu nguoi dung nhap
            if(isset($_GET['Find'])){
                $Find = $_GET['Find'];
                $sql = $sql . " AND sanpham.Ten LIKE '%" . $Find . "%' ";
            }

            //Bien de xac dinh so trang khi nguoi dung nhan
            $SoTrang = $_GET['Trang'];
            $From = 6 * ($SoTrang - 1);

            $sql = $sql ." LIMIT ".$From.",6";

            $data = $db->getListDanhSach($sql);

            $n = 0;

            if($data != null) {
                $n = count($data);
            }

            for($i = 0; $i < $n ;$i++){
                $TiLeGiam = $db->getTiLeGiam($data[$i]['MaSP']);
    ?>
        <div class="product">
            <div class="product-image">
                <div class="quickview-background">
                </div>
                <img src="./img/products/<?php echo $data[$i]['AnhChinh']?>" alt="" id="product-image">
            </div>
            <div class="product-info">

                <div class="product-name">
                    
                    <a href = "./ChiTietSP.php?MaSP=<?php echo $data[$i][0]?>"><?php echo $data[$i][1]?></a>
                </div>
                <div class="product-vendor"><?php echo $data[$i]['TenHang']?></div>
                <div class="product-price">
                    <span class="price-new price"><?php echo number_format(TinhTienGiam($TiLeGiam,$data[$i]['Gia']),0,',','.') ."đ"?></span>
                    <span class="price-old price"><?php echo number_format($data[$i]['Gia'],0,',','.') ."đ"?></span>
                </div>
            </div>
        </div>
    <?php
            }
        }
    ?>