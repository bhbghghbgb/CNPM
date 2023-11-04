<?php

if (isset($_GET['MaSP'])) {
    $MaSP = $_GET["MaSP"];


    include("./db/DAOSP.php");
    $db = new DAOSP();
    $db->connect();

    $data = $db->getSP($MaSP);
    $dataLq = $db->getListLienQuan($data["MaHang"], $MaSP);
    $dataSize = $db->getListSize($MaSP);
    if ($dataLq != null) {
        shuffle($dataLq);
    }



    $Tilegiam = $db->getTiLeGiam($MaSP);


    function TinhTienGiam($Tilegiam, $gia)
    {
        return $gia - $gia * $Tilegiam / 100;
    }
}

?>
<script>
    var tilegiam = <?php echo json_decode($Tilegiam) ?>

    var sosize = <?php echo json_encode($dataSize) ?>

    function formatCash(str) {
        str = str + "";
        return str.replace(/\B(?=(\d{3})+(?!\d))/g, '.') + "đ";
    }
    function changeSize(price, count) {
        var firstChild = document.querySelector('#price :first-child');
        var secondChild = document.querySelector('#price :nth-child(2)');
        var priceGiam = Math.round(price - price * tilegiam / 100);
        firstChild.innerHTML = formatCash(priceGiam);
        secondChild.innerHTML = formatCash(price);

        var tonkho = document.querySelector('#tonkho p span')
        tonkho.innerHTML = count
    }

    function validate() {
        if (<?php echo isset($_SESSION["MaTaiKhoan"]) ? 'true' : 'false'; ?>) {
            return true;
        } else {
            addmess("Vui lòng đăng nhập!", "#434343", "white", 1500);
            return false;
        }
    }

</script>

<form method="POST" action="GioHang.php" onsubmit="return validate()">
    <input type="hidden" name="MaSP" value="<?php echo $data["MaSP"] ?>">
    <div id="main_product" class="container">
        <div id="top_main">
            <div id="selection">
                <div class="item_selection">
                    <label>
                        <input type="radio" name="img_selected"
                            onclick="ChuyenAnh('./img/products/<?php if ($data['AnhChinh'])
                                echo $data['AnhChinh'];
                            else
                                echo 'giay404.jpg'; ?>')"
                            checked />
                        <img src="./img/products/<?php echo $data['AnhChinh'] ?>">
                    </label>
                </div>
                <?php
                for ($i = 1; $i < 4; $i++) {
                    ?>
                    <div class="item_selection">
                        <label>
                            <input type="radio" name="img_selected" onclick="ChuyenAnh('./img/products/giay404.jpg')" />
                            <img src="./img/products/giay404.jpg">
                        </label>
                    </div>
                <?php } ?>
            </div>
            <div id="image">
                <img src="./img/products/<?php echo $data["AnhChinh"] ?>" id="AnhChinh">
            </div>
            <div id="info">
                <h1>
                    <?php echo $data["Ten"] ?>
                </h1>
                <?php
                if ($data['GiaMin']) {
                    echo '<div id="price">';
                    echo '<p>' . number_format(TinhTienGiam($Tilegiam, $data['GiaMin']), 0, ',', '.') . 'đ</p>';
                    echo '<p id="niemyet">' . number_format($data['GiaMin'], 0, ',', '.') . 'đ</p>';
                    echo '</div>';
                    echo '<p>Kích thước</p>';
                    echo '<div id="size">';
                    echo '<ul id="size_list">';
                    foreach ($dataSize as $size) {
                        $checked = ($size["Size"] == $data["Size"]) ? " checked" : "";
                        echo '<li class="size-item" onclick="changeSize(' . $size['GiaBan'] . ',' . $size['SoLuong'] . ')">';
                        echo '<label>';
                        echo '<input type="radio" name="Size" value="' . $size['Size'] . '"' . $checked . '>';
                        echo '<span>' . $size['Size'] . '</span>';
                        echo '</label>';
                        echo '</li>';
                    }
                    echo '</ul>';
                    echo '</div>';
                    echo '<div id="tonkho">';
                    echo '<p>Còn lại: <span>' . $data["SoLuong"] . '</span></p>';
                    echo '</div>';
                    echo '<label id="giohang">';
                    echo '<input type="submit" name="add_to_cart" value="ThemGio">';
                    echo '<span id="icon"><i class="ti-shopping-cart"></i></span>';
                    echo '<span id="themvaogio">Thêm vào giỏ</span>';
                    echo '</label>';
                } else {
                    echo "Sản phẩm sắp ra mắt";
                }
                ?>


            </div>
        </div>
</form>
<div id="bottom_main">
    <div id="MoTa">
        <div id="title">
            <h2>Mô tả sản phẩm</h2>
        </div>
        <div id="content">
            <?php echo htmlspecialchars_decode($data["MoTa"]); ?>
        </div>
    </div>
    <div id="danhsach">
        <div id="list_sp">
            <h3>Các sản phẩm liên quan</h3>
        </div>
        <ul>

            <?php
            if ($dataLq != null) {
                $n = 3;
                if (count($dataLq) > 3) {
                    $n = 4;
                } else {
                    $n = count($dataLq);
                }
                for ($i = 0; $i < $n; $i++) {


                    ?>
                    <li>
                        <a href="ChiTietSP.php?MaSP=<?php echo $dataLq[$i][0] ?>">
                            <div class="item">
                                <img src="./img/products/<?php echo $dataLq[$i][3] ?>">
                                <div class="content_list">
                                    <h2>
                                        <?php echo $dataLq[$i][1] ?>
                                    </h2>
                                    <span>
                                        <?php echo number_format($dataLq[$i]["GiaMin"], 0, ',', '.') . "đ" ?>
                                    </span>
                                </div>
                            </div>
                        </a>
                    </li>
                <?php
                }
            }
            ?>
        </ul>
        <div id="danhmuc">
            <div class="item">
                <a href="./DanhSach.php?MaHang=MH-001">
                    <img src="./img/img-danhmuc/adidas.jpg">
                </a>
            </div>
            <div class="item">
                <a href="./DanhSach.php?MaHang=MH-002">
                    <img src="./img/img-danhmuc/nike.jpg">
                </a>
            </div>
            <div class="item">
                <a href="./DanhSach.php?MaHang=MH-021">
                    <img src="./img/img-danhmuc/pan.jpg">
                </a>
            </div>
        </div>
    </div>
</div>
</div>