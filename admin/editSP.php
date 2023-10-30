<?php
include('../db/DAOSP.php');
include('../db/DAOHang.php');
include('../db/DAODanhMuc.php');
include('../db/DAOKHuyenMai.php');
include('../db/DAOSosize.php');
$listconvert="";
$daoSP = new DAOSP();
$daoHang = new DAOHang();
$daoDM = new DAODanhMuc();
$daoKM = new DAOKhuyenMai();
$daoSoSize = new DAOSoSize();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sp = $daoSP->getListSP($id);
    if ($daoSoSize->hasSize($id)) {
        $listconvert = array();
        $listSize = $daoSoSize->getSoSize($id);
        foreach ($listSize as $list) {
            $item = [
                "price" => $list['GiaBan'],
                "quantity" => $list['SoLuong'],
                "size" => $list['Size']
            ];
            $listconvert[] = $item;
        }
    }
} else {
    $sp["Ten"] = '';
    $sp["MoTa"] = '';
    $sp["MaDM"] = '';
    $sp["AnhChinh"] = '';
    $sp["AnhChinh"] = '';
    $sp["MaHang"] = '';
    $sp["MaKhuyenMai"] = '';
    $listconvert="";
}
$listHang = $daoHang->getList();
$listDM = $daoDM->getList();
$listKM = $daoKM->getList();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/font-awesome_5.15.4_css_all.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">


    <script src="./js/admin.js"></script>
    <script src="../resources/ckeditor/ckeditor.js"></script>


    <link rel="stylesheet" href="./css/admin.css">
    <script src="./js/edit.js"></script>
    <title>Admin</title>
</head>

<body>
    <div class="wrapper">
        <?php include('template/topbar_ad.php'); ?>
        <div class="container-fluid">
            <?php include('template/menu_ad.php'); ?>
            <div id="main">
                <?php include('template/header_ad.php'); ?>

                <div id="content" class="row" style="background-color:#f0f5f8;height:calc(100% - 72px)">
                    <div class="main mx-auto ">
                        <?php
                        // Sửa sản phẩm
                        if (isset($_GET['id'])) {
                            echo '<div class="row justify-content-center display-4">Sửa sản phẩm</div>';
                        }
                        // Thêm sản phẩm
                        else {
                            echo '<div class="row justify-content-center display-4">Thêm sản phẩm</div>';
                        }
                        ?>
                        <!-- Tạo form thêm / sửa -->
                        <form action="xuly/xulyEditSP.php?" method="post" enctype="multipart/form-data">
                            <div class="row mt-2">
                                <label class="row">
                                    <div class="col col-1">Tên sản phẩm: </div>
                                    <div class="col col-11">
                                        <input class="w-100" required type="text" name='ten'
                                            value="<?php echo $sp["Ten"]; ?>">
                                    </div>
                                </label>
                            </div>
                            <div class="row mt-2">
                                <label class="row">
                                    <div class="col col-1">Mô tả:</div>
                                    <div class="col col-11">
                                        <textarea id="textarea" class="w-100" rows="" cols="" name="mota"
                                            value=""><?php echo htmlspecialchars_decode($sp["MoTa"]); ?></textarea>
                                    </div>
                                </label>
                            </div>
                            <div class="row mt-2">
                                <div class="col col-1">Size:</div>
                                <div class="col col-11">
                                    <div class="row mt-2">
                                        <div class="col-4">
                                            <input id="size" class="w-100" type="number" placeholder="size">
                                        </div>
                                        <div class="col-4">
                                            <input id="price" class="w-100" type="number" placeholder="Giá bán">
                                        </div>
                                        <div class="col-4">
                                            <input id="add" class="w-50" type="button" value="Thêm">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-12">
                                            <table class="w-100" id="mytable">
                                                <thead style="background-color:#ccc">
                                                    <th class="w-25">Kích cỡ</th>
                                                    <th class="w-25">Giá tiền</th>
                                                    <th class="w-25">Số lượng </th>
                                                </thead>
                                                <style>
                                                    #mytable {
                                                        background-color: #fff;
                                                        border: 1px solid #000;
                                                    }

                                                    .xoa {
                                                        border-radius: 10px;
                                                        background-color: red;
                                                        color: #fff;
                                                        padding: 2px 5px;
                                                        cursor: pointer;
                                                    }

                                                    .sizerow td {
                                                        height: 30px;
                                                    }
                                                </style>
                                                <tbody id="tbody">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <script>
                                var arraysize = <?php if($listconvert!='') echo json_encode($listconvert);else echo"[]" ?>

                                var addsize = document.getElementById("add")
                                var size = document.getElementById("size")
                                var price = document.getElementById("price")
                                var tbody = document.getElementById("tbody")

                                function loadsize() {
                                    var stringtbody = ""
                                    for (var i = 0; i < arraysize.length; i++) {

                                        stringtbody += "<tr class='sizerow'>"
                                        stringtbody += "<td>" + arraysize[i].size +
                                            "<input type='hidden' name='ArraySize[]' value='" + arraysize[i].size + "'> </td>"
                                        stringtbody += "<td>" + arraysize[i].price +
                                            "<input type='hidden' name='ArrayPrice[]' value='" + arraysize[i].price + "'> </td>"
                                        stringtbody += "<td style='display:flex; justify-content:space-between'>" + arraysize[i].quantity +
                                            "<input type='hidden' name='ArrayQuantity[]' value='" + arraysize[i].quantity + "'>"
                                        if (arraysize[i].quantity == 0)
                                            stringtbody += " <div class='xoa' onclick='xoasize(" + i + ")'>Xóa</div>"
                                        stringtbody += "</td></tr>"

                                    }
                                    tbody.innerHTML = stringtbody
                                    price.value = ''
                                    size.value = ''
                                }
                                loadsize()
                                function addClick() {
                                    var valuePrice = price.value;
                                    var valueSize = size.value;
                                    if (valuePrice == '' || valueSize == '') return
                                    arraysize.push({ price: valuePrice, size: valueSize, quantity: 0 });
                                    loadsize()
                                }

                                function xoasize(index) {
                                    arraysize.splice(index, 1)
                                    loadsize()
                                }
                                addsize.onclick = addClick;

                            </script>

                            <div class="row mt-2">
                                <label class="row">
                                    <div class="col col-1">Danh mục:</div>
                                    <div class="col col-11">
                                        <select class="w-100" name="danhmuc">
                                            <?php
                                            foreach ($listDM as $list) {
                                                if ($sp["MaDM"] == $list["MaDM"])
                                                    echo '<option value="' . $list["MaDM"] . '" selected>' . $list["TenDM"] . '</option>';
                                                else
                                                    echo '<option value="' . $list["MaDM"] . '">' . $list["TenDM"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </label>
                            </div>
                            <div class="row mt-2">
                                <label class="row">
                                    <div class="col col-1">Ảnh :</div>
                                    <div class="col col-11">
                                        <input class="w-100" type="file" id="anhSP" name="anhchinh"
                                            onchange="getLinkImg()">
                                        <input class="w-100" type="hidden" name="anhchinhcu"
                                            value="<?php echo $sp["AnhChinh"]; ?> ">
                                    </div>
                                </label>
                            </div>
                            <div class="row">
                                <div class="col col-1"></div>
                                <div class="col col-11">
                                    <div class="row">
                                        <img style="width: 300px;min-height: 150px;" src="<?php
                                        echo "../img/products/" . $sp["AnhChinh"];
                                        ?>" alt="" id="imagePreview">
                                        <div id="myButton">Xóa ảnh</div>
                                        <div id="inner"></div>
                                        <script>
                                            var changeButton = document.getElementById('myButton');
                                            changeButton.addEventListener('click', function () {
                                                document.getElementById('inner').innerHTML = `<input class="w-100" type="hidden" name="xoa" value="">`;
                                                document.getElementById('imagePreview').style.display = 'none';
                                            });
                                        </script>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <label class="row">
                                    <div class="col col-1">Thư viện ảnh :</div>
                                    <div class="col col-11">
                                        <input class="w-100" type="file" id="anhSPs" name="anhphu" multiple
                                            enctype="multipart/form-data" onchange="getLinkImgs()">
                                    </div>
                                </label>
                            </div>
                            <div class="row">
                                <div class="col col-1"></div>
                                <div class="col col-11">
                                    <div class="row">
                                        <div id="ListAnhPhu"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <label class="row">
                                    <div class="col col-1">Hãng:</div>
                                    <div class="col col-11">
                                        <select class="w-100" name="hang">
                                            <?php
                                            foreach ($listHang as $list) {
                                                if ($sp["MaHang"] == $list["MaHang"])
                                                    echo '<option value="' . $list["MaHang"] . '" selected>' . $list["Ten"] . '</option>';
                                                else
                                                    echo '<option value="' . $list["MaHang"] . '">' . $list["Ten"] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </label>
                            </div>
                            <div class="row mt-2">
                                <label class="row">
                                    <div class="col col-1">Khuyến mãi:</div>
                                    <div class="col col-11">
                                        <select class="w-100" name="khuyenmai">
                                            <?php
                                            foreach ($listKM as $list) {
                                                if ($sp["MaKhuyenMai"] == $list["MaKhuyenMai"])
                                                    echo '<option value=' . $list["MaKhuyenMai"] . ' selected>' . $list["TenKhuyenMai"] . '</option>';
                                                else
                                                    echo '<option value=' . $list["MaKhuyenMai"] . '>' . $list["TenKhuyenMai"] . '</option>';
                                            }
                                            ?>
                                        </select>

                                    </div>
                                </label>
                            </div>
                            <div class="row mt-2">
                                <div class="col col-1"></div>
                                <div class="col col-11">
                                    <?php
                                    if (isset($_GET['id'])) {
                                        echo "<input type='hidden' name='id' value=" . $id . ">";
                                        echo '<a><input type="submit" class="btn bg-success" name="hd" value="Lưu"></a>';
                                        echo "<a class='text-black' href='editsp.php?'> 
                                                <div class='btn bg-secondary'>Thêm mới</div>
                                            </a>";
                                    } else
                                        echo '<input type="submit" class="btn bg-success"name="hd" value="Thêm">';
                                    ?>
                                    <a href="index.php?id=sp">
                                        <div class='btn text-black bg-danger'>Hủy</div>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>

    </div>
    <?php
    ?>
    <script>
        showmenu();
        choosemenu();
    </script>
    <script>
        CKEDITOR.replace('textarea');
    </script>
</body>

</html>