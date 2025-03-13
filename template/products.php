    <div class="block-main">
        <div class="block-product">
            <div class="container">
                <div class="title-block">
                    <div class="title-content">
                        <h3 class="title">Danh mục ưa thích</h3>
                        <div class="describe">Danh mục được nhiều khách hàng yêu thích</div>
                    </div>
                </div>
                <div id="row">
                    <div class="box-banner-index">
                        <div class="index">
                            <a href="./danhsach.php?MaDM=DM-2">
                                <img src=".\img\img-listFav\banner_index_1.webp">
                            </a>
                        </div>
                    </div>
                    <div class="box-banner-index">
                        <div class="index">
                            <a href="./danhsach.php?MaDM=DM-1">
                                <img src=".\img\img-listFav\banner_index_2.webp">
                            </a>
                        </div>
                    </div>
                    <div class="box-banner-index">
                        <div class="index">
                            <a href="./danhsach.php?MaDM=DM-4">
                                <img src=".\img\img-listFav\banner_index_3.webp">
                            </a>
                        </div>
                    </div>
                    <div class="box-banner-index">
                        <div class="index">
                            <a href="./danhsach.php?MaDM=DM-5">
                                <img src=".\img\img-listFav\banner_index_4.webp">
                            </a>
                        </div>
                    </div>
                    <div class="box-banner-index">
                        <div class="index">
                            <a href="./danhsach.php?Sale=1">
                                <img src=".\img\img-listFav\banner_index_5.webp">
                            </a>
                        </div>
                    </div>
                    <div class="box-banner-index">
                        <div class="index">
                            <a href="./danhsach.php?MaDM=DM-3">
                                <img src=".\img\img-listFav\banner_index_6.webp" style="width: 360px; max-height: 200px;">
                            </a>
                        </div>
                    </div>




                </div>
            </div>
        </div>

        <div id="artificial_turf " class="block-product">
            <div class="container">
                <div class="title-block">
                    <div class="title-content">
                        <h2 class="title">Giày đá bóng sân cỏ nhân tạo</h2>
                        <div class="describe">Giày đá bóng đinh TF cập nhật thường xuyên</div>
                    </div>
                </div>

                <div class="products">
                    <?php
                    function TinhTienGiam($TiLegiam, $data)
                    {
                        return $data - $data * $TiLegiam / 100;
                    }

                    include('./db/DAOSP.php');
                    $db = new DAOSP();
                    $db->connect();

                    $MaDM1 = "DM-1";
                    $data = $db->getListDanhMuc($MaDM1);
                    $n = 8;
                    if (count($data) < 8) {
                        $n = count($data);
                    }

                    for ($i = 0; $i < $n; $i++) {
                        $TiLeGiam = $db->getTiLeGiam($data[$i]['MaSP']);
                    ?>
                        <div class="product">
                            <div class="product-image">
                                <div class="quickview-background">


                                </div>
                                <img src="./img/products/<?php echo $data[$i]['AnhChinh'] ?>" alt="">
                            </div>
                            <div class="product-info">
                                <div class="product-name">
                                    <a href="./chitietsp.php?MaSP=<?php echo $data[$i][0] ?>"><?php echo $data[$i][1] ?></a>
                                </div>
                                <div class="product-vendor"><?php echo $data[$i]['TenHang'] ?></div>
                                <div class="product-price">
                                    <span class="price-new price"><?php echo number_format(TinhTienGiam($TiLeGiam, $data[$i]['GiaMin']), 0, ',', '.') . "đ" ?></span>
                                    <span class="price-old price"><?php echo $TiLeGiam == 0 ? "" : number_format($data[$i]['GiaMin'], 0, ',', '.') . "đ" ?></span>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div id="get_data_NT"></div>
                <div class="viewall">
                    <a href="./danhsach.php?MaDM=DM-1">
                        <div class="viewall-content">Xem tất cả</div>
                    </a>
                </div>

            </div>
        </div>


        <div id="natural_turf " class="block-product">
            <div class="container">
                <div class="title-block">
                    <div class="title-content">
                        <h2 class="title">Giày đá bóng sân cỏ tự nhiên</h2>
                        <div class="describe">Giày đá banh đinh SG/MG/FG cập nhật thường xuyên</div>
                    </div>
                </div>
                <div class="products">
                    <?php
                    $MaDM1 = "DM-2";
                    $data = $db->getListDanhMuc($MaDM1);
                    $n = 8;
                    if (count($data) < 8) {
                        $n = count($data);
                    }

                    for ($i = 0; $i < $n; $i++) {
                        $TiLeGiam = $db->getTiLeGiam($data[$i]['MaSP']);
                    ?>
                        <div class="product">
                            <div class="product-image">
                                <div class="quickview-background">
                                </div>
                                <img src="./img/products/<?php echo $data[$i]['AnhChinh'] ?>" alt="">
                            </div>
                            <div class="product-info">
                                <div class="product-name">
                                    <a href="./chitietsp.php?MaSP=<?php echo $data[$i][0] ?>"><?php echo $data[$i][1] ?></a>
                                </div>
                                <div class="product-vendor"><?php echo $data[$i]['TenHang'] ?></div>
                                <div class="product-price">
                                    <span class="price-new price"><?php echo number_format(TinhTienGiam($TiLeGiam, $data[$i]['GiaMin']), 0, ',', '.') . "đ" ?></span>
                                    <span class="price-old price"><?php echo $TiLeGiam == 0 ? "" : number_format($data[$i]['GiaMin'], 0, ',', '.') . "đ" ?></span>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div id="get_data_TN"></div>
                <div class="viewall">
                    <a href="./danhsach.php?MaDM=DM-2">
                        <div class="viewall-content">Xem tất cả</div>
                    </a>
                </div>
            </div>

        </div>
        <div id="futsal_turf " class="block-product">
            <div class="container">
                <div class="title-block">
                    <div class="title-content">
                        <h2 class="title">GIÀY ĐÁ BÓNG FUTSAL</h2>
                        <div class="describe">Giày đá banh đế bằng IC cập nhật thường xuyên</div>
                    </div>
                </div>
                <div class="products">
                    <?php
                    $MaDM1 = "DM-4";
                    $data = $db->getListDanhMuc($MaDM1);
                    $n = 8;
                    if (count($data) < 8) {
                        $n = count($data);
                    }

                    for ($i = 0; $i < $n; $i++) {
                        $TiLeGiam = $db->getTiLeGiam($data[$i]['MaSP']);
                    ?>
                        <div class="product">
                            <div class="product-image">
                                <div class="quickview-background">


                                </div>
                                <img src="./img/products/<?php echo $data[$i]['AnhChinh'] ?>" alt="">
                            </div>
                            <div class="product-info">
                                <div class="product-name">
                                    <a href="./chitietsp.php?MaSP=<?php echo $data[$i][0] ?>"><?php echo $data[$i][1] ?></a>
                                </div>
                                <div class="product-vendor"><?php echo $data[$i]['TenHang'] ?></div>
                                <div class="product-price">
                                    <span class="price-new price"><?php echo number_format(TinhTienGiam($TiLeGiam, $data[$i]['GiaMin']), 0, ',', '.') . "đ" ?></span>
                                    <span class="price-old price"><?php echo $TiLeGiam == 0 ? "" : number_format($data[$i]['GiaMin'], 0, ',', '.') . "đ" ?></span>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div id="get_data_FS"></div>


                <div class="viewall">
                    <a href="./danhsach.php?MaDM=DM-4">
                        <div class="viewall-content">Xem tất cả</div>
                    </a>
                </div>
            </div>
        </div>

    </div>

    <form action="./giohang.php" method="post">
        <input type="hidden" name="MaSP" value="<?php echo $data[0][0] ?>">
    </form>

    </script>