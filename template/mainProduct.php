<?php

    if(isset($_GET['MaSP'])){
        $MaSP = $_GET["MaSP"];


        include("./db/DAOSP.php");
        $db = new DAOSP();
        $db->connect();

        $data = $db->getList($MaSP);
        $dataLq = $db->getListLienQuan($data[0][8], $MaSP);
        if($dataLq != null){
            shuffle($dataLq);
        }



        $Tilegiam = $db->getTiLeGiam($MaSP);


        function TinhTienGiam($Tilegiam, $data){
            return $data[0][2] - $data[0][2]*$Tilegiam/100;
        }
    }

?>
<form method="POST" action="GioHang.php">
<input type="hidden" name="MaSP" value="<?php echo $data[0][0]?>">
<div id="main_product" class="container">
    <div id = "top_main">
        <div id = "selection">
            <div class = "item_selection">
                <label>
                        <input type = "radio" name = "img_selected" onclick="ChuyenAnh('./img/products/<?php echo $data[0][4]?>')" checked/>
                        <img src = "./img/products/<?php echo $data[0][4]?>">
                </label>
            </div>
            <?php
                for($i = 1; $i < 4;$i++){

            ?>
            <div class = "item_selection">
                <label>
                        <input type = "radio" name = "img_selected" onclick="ChuyenAnh('./img/products/<?php echo $data[0][0]?>_<?php echo $i?>.jpg')"/>
                        <img src = "./img/products/<?php echo $data[0][0]?>_<?php echo $i?>.jpg">
                </label>
            </div>
            <?php } ?>
        </div>
        <div id = "image">
            <img src = "./img/products/<?php echo $data[0][4]?>" id="AnhChinh">
        </div>
        <div id = "info">
            <h1><?php echo $data[0][1]?></h2>
            <div id = "price">
                <p><?php echo number_format(TinhTienGiam($Tilegiam,$data),0,',','.')."đ"?></p>
                <p id="niemyet"><?php echo number_format($data[0][2],0,',','.')."đ"?></p>
            </div>
            <p>Kích thước</p>
            <div id = "size">
                <ul id = "size_list">
                    <li class = "size-item">
                        <label>
                            <input type = "radio" name = "Size" value = "39">
                            <span>39</span>
                        </label>
                    </li>
                    <li class = "size-item">
                        <label>
                            <input type = "radio" name = "Size" value = "40" checked>
                            <span>40</span>
                        </label>
                    </li>
                    <li class = "size-item">
                        <label>
                            <input type = "radio" name = "Size" value = "41">
                            <span>41</span>
                        </label>
                    </li>
                    <li class = "size-item">
                        <label>
                            <input type = "radio" name = "Size" value = "42">
                            <span>42</span>
                        </label>
                    </li>
                    <li class = "size-item">
                        <label>
                            <input type = "radio" name = "Size" value = "43">
                            <span>43</span>
                        </label>
                    </li>
                    <li class = "size-item">
                        <label>
                            <input type = "radio" name = "Size" value = "44">
                            <span>44</span>
                        </label>
                    </li>
                </ul>
            </div>
            <div id = "tonkho">
                <p>
                    Tồn kho:
                    <span><?php echo $data[0][9]?></span>  
                </p>
            </div>
            <label id="giohang">
                    <input type = "submit" name = "add_to_cart" value = "ThemGio">
                    <span id="icon"><i class="ti-shopping-cart"></i></span> 
                    <span id = "themvaogio">Thêm vào giỏ</span>
            </label>

        </div>
    </div>
</form>
    <div id = "bottom_main">
        <div id = "MoTa">
            <div id = "title">
                <h2>Mô tả sản phẩm</h2>
            </div>
            <div id = "content">
                <?php echo $data[0][6]?>
            </div>
        </div>
        <div id = "danhsach">
            <div id = "list_sp">
                    <h3>Các sản phẩm liên quan</h3>
            </div>
            <ul>
                
                <?php
                if($dataLq!=null){
                    $n = 3;
                    if(count($dataLq) > 3){
                        $n = 4;
                    }
                    else{
                        $n = count($dataLq);
                    }
                    for($i=0;$i<$n;$i++){ 
                    
                    
                ?>
                        <li>
                            <a href="ChiTietSP.php?MaSP=<?php echo $dataLq[$i][0]?>">
                                <div class="item">
                                    <img src="./img/products/<?php echo $dataLq[$i][4]?>">
                                    <div class = "content_list">
                                        <h2><?php echo $dataLq[$i][1]?></h2>
                                        <span><?php echo number_format($dataLq[$i][2],0,',','.')."đ"?></span>
                                    </div>
                                </div>
                            </a>
                        </li>
                <?php 
                    }
                } 
                ?>
            </ul>
            <div id = "danhmuc">
                <div class = "item">
                    <a href="./DanhSach.php?MaHang=MH-001">
                        <img src="./img/img-danhmuc/adidas.jpg">
                    </a>
                </div>
                <div class = "item">
                    <a href="./DanhSach.php?MaHang=MH-002">
                        <img src="./img/img-danhmuc/nike.jpg">
                    </a>
                </div>
                <div class = "item">
                    <a href="./DanhSach.php?MaHang=MH-021">
                        <img src="./img/img-danhmuc/pan.jpg">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>