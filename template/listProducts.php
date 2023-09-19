<script>
    let SoTrang = 1;
    let ChonHang = "";
    let ChonGia = "";
    $(document).ready(function(){
        //Chay khi len web lan dau
        $.get('./template/Ajax-ListProducts/Ajax-ListProducts.php',
            {
                Trang:SoTrang
                <?php
                    if(isset($_GET['MaDM'])){
                        echo ",MaDM: '" . $_GET['MaDM']."'";
                    }
                ?>
                <?php
                    if(isset($_GET['MaHang'])){
                        echo ",MaHang: '" . $_GET['MaHang']."'";
                    }
                ?>
                <?php
                    if(isset($_GET['Sale'])){
                        echo ",Sale: '" . $_GET['Sale']."'";
                    }
                ?>
                <?php
                    if(isset($_GET['Find'])){
                        echo ",Find: '" . $_GET['Find']."'";
                    }
                ?>
            },
            function(data){
                    $(".products").append(data);
            }
        );

        //Bat dau xuat hien khi nguoi dung nhan xem them
        $("#xemthem").click(function(){
            SoTrang += 1;
            //Kiem tra xem co dieu kien loc hay khong
            $.get('./template/Ajax-ListProducts/Ajax-ListProducts.php',
            {
                Trang:SoTrang,
                Hang:ChonHang,
                Gia:ChonGia
                <?php
                    if(isset($_GET['MaDM'])){
                        echo ",MaDM: '" . $_GET['MaDM']."'";
                    }
                ?>
                <?php
                    if(isset($_GET['MaHang'])){
                        echo ",MaHang: '" . $_GET['MaHang']."'";
                    }
                ?>
                <?php
                    if(isset($_GET['Sale'])){
                        echo ",Sale: '" . $_GET['Sale']."'";
                    }
                ?>
                <?php
                    if(isset($_GET['Find'])){
                        echo ",Find: '" . $_GET['Find']."'";
                    }
                ?>
            },
            function(data){
                if(data!=""){
                    $(".products").append(data);
                }
                else{
                    let xemthem = document.getElementById("block-xemthem");
                    xemthem.style.display="none";
                }
            });
        });

        $(".ChonHang").click(function (){
            SoTrang = 1;
            ChonHang = $(this).val();
            $.get("./template/Ajax-ListProducts/Ajax-ListProducts.php",
            {
                Trang:SoTrang,
                Hang:ChonHang,
                Gia:ChonGia
                <?php
                    if(isset($_GET['MaDM'])){
                        echo ",MaDM: '" . $_GET['MaDM']."'";
                    }
                ?>
                <?php
                    if(isset($_GET['MaHang'])){
                        echo ",MaHang: '" . $_GET['MaHang']."'";
                    }
                ?>
                <?php
                    if(isset($_GET['Sale'])){
                        echo ",Sale: '" . $_GET['Sale']."'";
                    }
                ?>
                <?php
                    if(isset($_GET['Find'])){
                        echo ",Find: '" . $_GET['Find']."'";
                    }
                ?>
            },
            function (data){
                $(".products").html(data);
                let xemthem = document.getElementById("block-xemthem");
                xemthem.style.display="block";
            }
            );

        });


        $(".ChonGia").click(function (){
            SoTrang = 1;
            ChonGia = $(this).val();
            console.log(ChonGia);
            $.get("./template/Ajax-ListProducts/Ajax-ListProducts.php",
            {
                Trang:SoTrang,
                Gia:ChonGia,
                Hang:ChonHang
                <?php
                    if(isset($_GET['MaDM'])){
                        echo ",MaDM: '" . $_GET['MaDM']."'";
                    }
                ?>
                <?php
                    if(isset($_GET['MaHang'])){
                        echo ",MaHang: '" . $_GET['MaHang']."'";
                    }
                ?>
                <?php
                    if(isset($_GET['Sale'])){
                        echo ",Sale: '" . $_GET['Sale']."'";
                    }
                ?>
                <?php
                    if(isset($_GET['Find'])){
                        echo ",Find: '" . $_GET['Find']."'";
                    }
                ?>
            },
            function (data){
                $(".products").html(data);
                let xemthem = document.getElementById("block-xemthem");
                xemthem.style.display="block";
            }
            );

        });
    });


</script>
<div class="block-main">
        <div class = "Loc">
            <div class = "selection" id="Hang">
                <div class = "title">
                    <h3>Thương hiệu</h3>
                    <i class="ti-minus"></i>
                </div>
                <div class = "item">
                    <?php
                        include('./db/DAOHang.php');
                        $dbH = new DAOHang();
                        $dbH->connect();
                        $dataH = $dbH->getList();
                        $i = 0;
                        while ($i < count($dataH)){
                    ?>
                        <label>
                            <input type = "radio" name = "Hang" value = "<?php echo $dataH[$i][0]?>" class="ChonHang">
                            <div class = "content"><?php echo $dataH[$i][1]?></div>
                            <i class = "ti-check"></i>
                        </label>
                    <?php
                            $i++; 
                        }
                    ?>
                        <label>
                            <input type = "radio" name = "Hang" value = "All" class="ChonHang">
                            <div class = "content">Tất cả</div>
                            <i class = "ti-check"></i>
                        </label>
                </div>
            </div>
            <div class = "selection" id="Gia" class="ChonGia">
                <div class = "title">
                    <h3>Giá</h3>
                    <i class="ti-minus"></i>
                </div>
                <div class = "item">
                        <label>
                            <input type = "radio" name = "Gia" class="ChonGia" value = "0-1000000">
                            <div class = "content">Nhỏ hơn 1,000,000đ</div>
                            <i class = "ti-check"></i>
                        </label>
                        <label>
                            <input type = "radio" name = "Gia" class="ChonGia" value = "1000000-1500000">
                            <div class = "content">Từ 1,000,000₫ - 1,500,000₫</div>
                            <i class = "ti-check"></i>
                        </label>
                        <label>
                            <input type = "radio" name = "Gia" class="ChonGia" value = "1500000-2000000">
                            <div class = "content">Từ 1,500,000₫ - 2,000,000₫</div>
                            <i class = "ti-check"></i>
                        </label>
                        <label>
                            <input type = "radio" name = "Gia" class="ChonGia" value = "2000000-3000000">
                            <div class = "content">Từ 2,000,000₫ - 3,000,000₫</div>
                            <i class = "ti-check"></i>
                        </label>
                        <label>
                            <input type = "radio" name = "Gia" class="ChonGia" value = "3000000-">
                            <div class = "content">Lớn hơn 3,000,000₫</div>
                            <i class = "ti-check"></i>
                        </label>
                </div>
            </div>
        </div>
        
        <div id="artificial_turf " class="block-product">
            <div class="products" id="products">
                
            </div>
            <div id="block-xemthem">
                <button id = "xemthem" clicked> Xem thêm các sản phẩm khác</button>
            </div>
        </div>
    
    </div>