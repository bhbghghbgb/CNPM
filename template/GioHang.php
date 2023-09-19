<?php
    include('./db/DAOSP.php');
    $db = new DAOSP();
    $db->connect();
    
    
    if(isset($_POST['update-click'])){
        foreach($_POST['quantity'] as $id => $quantity){
            foreach($_SESSION['cart'] as $key => $value){
                if($value['ID'] == $id){
                    $_SESSION['cart'][$key]['SL'] = $quantity;
                }
            }


        }
       echo ' <script>window.location="GioHang.php";</script>';
    }


    if(isset($_GET['action'])){
        $action = $_GET['action'];
        if($action == 'remove'){
            foreach($_SESSION['cart'] as $key => $value){
                if($value['ID'] == $_GET['id']){
                    unset($_SESSION['cart'][$key]);
                    echo ' <script>window.location="GioHang.php";</script>';
                }
            }
        }
    }

    if(isset($_POST['add_to_cart'])){
        $MaSP = $_POST['MaSP'];
        $Size = $_POST['Size'];


        $data = $db->getList($MaSP);

        $TiLegiam = $db->getTiLeGiam($MaSP);

        function TinhTienGiam($TiLegiam, $data){
            return $data[0][2] - $data[0][2]*$TiLegiam/100;
        }
        
        $TongTien = 0;

        


        if(isset($_SESSION['cart'])){
            $session_array_id = array_column($_SESSION['cart'], 'ID');

            if(!in_array($MaSP,$session_array_id)){
                $session_array = array(
                    "ID" => $data[0][0],
                    "Name" => $data[0][1],
                    "Price" => TinhTienGiam($TiLegiam,$data),
                    "Img" => $data[0][4],
                    "Size" => $Size,
                    "SL" => "1",
                    "SLTonKho" => $data[0][9]
                );
    
                $_SESSION['cart'][] = $session_array;
            }
        }
        else{
            $session_array = array(
                "ID" => $data[0][0],
                "Name" => $data[0][1],
                "Price" => TinhTienGiam($TiLegiam,$data),
                "Img" => $data[0][4],
                "Size" => $Size,
                "SL" => "1",
                "SLTonKho" => $data[0][9]
            );

            $_SESSION['cart'][] = $session_array;
        }
    }
    
?>



<div id = "gio_hang_container">
    <form method="POST" action="">
        <div id = "thong_tin">
            <h1>Giỏ hàng</h1>
            <div id="cart_form">
                <form>
                    <table id = "don_hang">
                        <tbody>
                            <tr>
                                <th>&ensp;&ensp;&ensp;</th>
                                <th>Sản phẩm</th>
                                <th>Đơn giá</th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                                <th>&ensp; </th>
                            </tr>
                            <?php
                                if(isset($_SESSION['cart'])){
                                    foreach($_SESSION['cart'] as $key => $value)
                                    {
                            ?>
                            <tr>
                                <td><a href="#"><img src = "./img/products/<?php echo $value['Img']?>"></a></td>
                                <td><a href="#">
                                    <strong><?php echo $value['Name']?></strong>
                                    <span class="variant_title">Size: <?php echo $value['Size']?></span>
                                </a></td>
                                <td>
                                    <?php echo number_format($value['Price'],0,",",".")."đ"?>
                                </td>
                                <td style="padding: 20px 5px;">
                                    <input type = "number" value="<?php echo $value['SL']?>" min = "1" max = "<?php echo $value['SLTonKho']?>" class = "sl" name="quantity[<?=$value['ID']?>]">
                                </td>
                                <td>
                                <?php echo number_format($value['Price'] * $value['SL'],0,",",".")."đ"?>
                                </td>
                                <td>
                                    <a href = "GioHang.php?action=remove&id=<?php echo $value['ID']?>"> 
                                    <button type = "button" class = "delete"><i class="ti-trash trash"></i></button>
                                </td>
                            </tr>
                            <?php } 
                                }
                            ?>
                        </tbody>
                        
                    </table>
                </form>
            </div>
            
            <div class="clearfix">
                <a href="index.php">mua tiếp</a>
                <input type="submit" name="update-click" id="update-click" value = "Cập nhật giỏ hàng">
            </div>
        </div>
    </form>
        <div id = "thanh_toan">
            <h2>Đơn hàng</h2>
            <div id="thanh_toan_container">
                <h2>
                    <label>Tổng tiền</label>
                    <label class="tien"><?php 
                        $TongTien = 0;
                        if(isset($_SESSION['cart'])){
                            
                            foreach ($_SESSION['cart'] as $key => $value){
                                $TongTien += $value['SL'] * $value['Price'];
                            }

                        }
                        echo number_format($TongTien,0,",",".") . "đ";
                    ?></label>
                </h2>
                <?php
                    if(isset($_SESSION['cart']) and count($_SESSION['cart']) != 0){
                        

                ?>
                    <a href="./template/XuLyThanhToan.php">THANH TOÁN</a>
                <?php
                    }
                    else{
                        
                ?>
                    <a href="index.php">Tiếp tục mua hàng</a>
                <?php        
                    }
                ?>
            </div>
        </div>
</div>
