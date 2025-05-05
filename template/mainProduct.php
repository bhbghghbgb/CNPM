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
$urlAnh = './img/products/';
if ($data['AnhChinh'])
    $urlAnh = $urlAnh . $data['AnhChinh'];
else
    $urlAnh = $urlAnh . 'giay404.jpg';
?>
<script>
    var tilegiam = <?php echo json_decode($Tilegiam) ?>;

    var sosize = <?php echo json_encode($dataSize) ?>;

    function formatCash(str) {
        str = str + "";
        return str.replace(/\B(?=(\d{3})+(?!\d))/g, '.') + "đ";
    }

    function changeSize(price, count) {
        var firstChild = document.querySelector('#price :first-child');
        var secondChild = document.querySelector('#price :nth-child(2)');
        var priceGiam = Math.round(price - price * tilegiam / 100);
        if (tilegiam != 0) {
            firstChild.innerHTML = formatCash(priceGiam);
            secondChild.innerHTML = formatCash(price);
        } else {
            firstChild.innerHTML = formatCash(price);
        }

        var tonkho = document.querySelector('#tonkho p span')
        tonkho.innerHTML = count;
    }

    function validate() {
        if (<?php echo isset($_SESSION["MaTaiKhoan"]) ? 'true' : 'false'; ?>) {
            var sl = document.querySelector("#tonkho p span").textContent;
            if (sl == 0) {
                addmessText("Sản phẩm đã hết hàng!");
                return false;
            }
            return true;
        } else {
            addmessText("Vui lòng đăng nhập!");
            return false;
        }
    }
</script>

<form method="POST" action="giohang.php" onsubmit="return validate()">
    <input type="hidden" name="MaSP" value="<?php echo $data["MaSP"] ?>">
    <div id="main_product" class="container">
        <div id="top_main">
            <div id="selection">
                <div class="item_selection">
                    <label>
                        <input type="radio" name="img_selected" onclick="ChuyenAnh('<?php echo $urlAnh ?>')" checked />
                        <img src="./img/products/<?php echo $data['AnhChinh'] ?>">
                    </label>
                </div>
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
                    if ($Tilegiam != 0) {
                        echo '<p>' . number_format(TinhTienGiam($Tilegiam, $data['GiaMin']), 0, ',', '.') . 'đ</p>';
                        echo '<p id="niemyet">' . number_format($data['GiaMin'], 0, ',', '.') . 'đ</p>';
                    } else {
                        echo '<p>' . number_format($data['GiaMin'], 0, ',', '.') . 'đ</p>';
                    }
                    echo '</div>';
                    echo '<p>Kích thước</p>';
                    echo '<div id="size">';
                    echo '<ul id="size_list">';
                    foreach ($dataSize as $size) {
                        $checked = ($size["Size"] == $data["Size"]) ? " checked" : "";
                        echo '<li class="size-item">';
                        echo '<label>';
                        echo '<input type="radio" name="Size" value="' . $size['Size'] . '"' . $checked . '>';
                        echo '<span onclick="changeSize(' . $size['GiaBan'] . ',' . $size['SoLuong'] . ')"' . '>' . $size['Size'] . '</span>';
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
                        <a href="chitietsp.php?MaSP=<?php echo $dataLq[$i][0] ?>">
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
                <a href="./danhsach.php?MaHang=MH-001">
                    <img src="./img/img-danhmuc/adidas.jpg">
                </a>
            </div>
            <div class="item">
                <a href="./danhsach.php?MaHang=MH-002">
                    <img src="./img/img-danhmuc/nike.jpg">
                </a>
            </div>
            <div class="item">
                <a href="./danhsach.php?MaHang=MH-021">
                    <img src="./img/img-danhmuc/pan.jpg">
                </a>
            </div>
        </div>
    </div>
</div>
</div>