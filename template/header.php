<script src="./js/login.js"></script>
<script src="./js/header-effects.js"></script>

<script>
    $(document).ready(function() {
        // Xử lý khi nhấn Enter trong input
        $('#find').keydown(function(event) {
            let keycode = event.which;
            if (keycode == 13) {
                let text = $(this).val();
                window.location = "./danhsach.php?Find=" + text;
            }
        });

        // Xử lý khi click vào nút search
        $('#btn-search').click(function(event) {
            event.preventDefault();
            
            // Nếu có text trong input thì submit search
            if($('#find').val().trim() !== '') {
                let text = $('#find').val();
                window.location = "./danhsach.php?Find=" + text;
            } 
            // Nếu không có text, toggle trạng thái active của search box
            else {
                $('#search-box').toggleClass('active');
                if($('#search-box').hasClass('active')) {
                    $('#find').focus();
                }
            }
        });

        // Đóng search box khi click ra ngoài
        $(document).click(function(event) {
            if (!$(event.target).closest('#search-box').length) {
                $('#search-box').removeClass('active');
            }
        });
    });
</script>
<header>
    <div id="header">
        <div class="container2">
            <div class="content1">
                <p class=" ti-headphone"></p>
                <div id="phone_header">0909 123 456</div>
            </div>

            <div class="content2">
                <a href="./"><img style="height :70px" src=".\img\img-logo\sneaker.jpg"></a>
            </div>
            <div class="content3">
                <ul>
                    <li>
                        <div id="search-box">
                            <input type="text" name="find" value="" id="find" placeholder="Bạn muốn tìm gì ?" required>
                            <button id="btn-search"><i class="ti-search"></i></button>
                        </div>
                    </li>

                    <?php
                    if (isset($_SESSION['MaTaiKhoan'])) {
                    ?>
                        <li><a href="./account/logout.php"><i class="ti-share-alt"></i></a></li>
                        <li><a href="./account.php"><i class="ti-settings"></i></a></li>
                    <?php
                    } else {
                    ?>
                        <li class="ti-user user" onclick="hienthi()"></li>

                    <?php

                    }
                    ?>
                    <li>
                        <a href="giohang.php"><i class="ti-shopping-cart gh"></i></a>
                        <span id="quantity">
                            <?php
                            include __DIR__ . "/../db/DAOGioHang.php";
                            $dgh = new DAOGioHang();
                            $dgh->connect();
                            $Cart = 0;
                            if (isset($_SESSION['MaTaiKhoan'])) {
                                $Cart += $dgh->getSL($_SESSION['MaTaiKhoan']);
                            }
                            echo $Cart;
                            ?>
                        </span>
                    </li>
                    <li><?php if (isset($_SESSION['MaQuyen']) && $_SESSION['MaQuyen'] != "User") echo "<a style='cusor:poiter;' href='./admin'>Admin</a>" ?></li>

                </ul>
            </div>
        </div>
    </div>
</header>