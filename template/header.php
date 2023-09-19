<script src="./js/login.js"></script>
<script>
    $(document).ready(function() {
        $('#find').keydown(function() {
            let keycode = event.which;
            if(keycode == 13){
                let text = $(this).val();
                window.location = "./DanhSach.php?Find=" +text;
            }
        });

    });


</script>
        <header>
            <div id = "header">
                <div class="container2">
                    <div class = "content1">
                        <p class = " ti-headphone"></p>
                        <div id = "phone_header">0909 123 456</div>
                    </div>

                    <div class = "content2">
                        <img src=".\img\img-header\logo_header.png">
                    </div>
                    <div class = "content3">
                        <ul>
                            <li>
                                <div id="search-box">
                                    <input type="text" name = "find" value="" id = "find" placeholder="Bạn muốn tìm gì ?" required>
                                    <button id="btn-search"><i class = "ti-search"></i></button>
                                </div>
                            </li>

                            <?php 
                                if (isset($_SESSION['MaTaiKhoan']) ){
                                    ?>
                                        <li><a href="./account/logout.php"><i class="ti-share-alt"></i></a></li>
                                    
                                    <?php
                                }
                                else{
                                ?>
                                    <li class="ti-user user" onclick="hienthi()"></li>

                            <?php

                                }
                        ?>
                            <li>
                                <a href="GioHang.php"><i class="ti-shopping-cart gh"></i></a>
                                <span>
                                    <?php
                                        $Cart = 0;
                                        if(isset($_SESSION['cart'])){
                                            foreach($_SESSION['cart'] as $key => $value){
                                                $Cart += $value['SL'];
                                            }
                                        }
                                        echo $Cart;
                                    ?>
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>
