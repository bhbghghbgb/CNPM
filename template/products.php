    <div class="block-main">
        <div class="block-product favorite-categories">
            <div class="container">
                <div class="category-title-section">
                    <h3 class="category-title">Danh mục ưa thích</h3>
                    <div class="category-subtitle">Danh mục được nhiều khách hàng yêu thích</div>
                </div>
                <div class="categories-grid">
                    <a href="./danhsach.php?MaDM=DM-2" class="category-card">
                        <img src=".\img\img-listFav\banner_index_1.webp" alt="Giày đá bóng sân cỏ tự nhiên">
                        <div class="category-overlay">
                            <h4 class="category-name">Giày đá bóng sân cỏ tự nhiên</h4>
                            <p class="category-description">Giày đá banh đinh SG/MG/FG cập nhật thường xuyên</p>
                        </div>
                    </a>
                    <a href="./danhsach.php?MaDM=DM-1" class="category-card">
                        <img src=".\img\img-listFav\banner_index_2.webp" alt="Giày đá bóng sân cỏ nhân tạo">
                        <div class="category-overlay">
                            <h4 class="category-name">Giày đá bóng sân cỏ nhân tạo</h4>
                            <p class="category-description">Giày đá bóng đinh TF cập nhật thường xuyên</p>
                            <span class="category-badge">Hot</span>
                        </div>
                    </a>
                    <a href="./danhsach.php?MaDM=DM-4" class="category-card">
                        <img src=".\img\img-listFav\banner_index_3.webp" alt="Giày đá bóng futsal">
                        <div class="category-overlay">
                            <h4 class="category-name">Giày đá bóng futsal</h4>
                            <p class="category-description">Giày đá banh đế bằng IC cập nhật thường xuyên</p>
                        </div>
                    </a>
                    <a href="./danhsach.php?MaDM=DM-5" class="category-card">
                        <img src=".\img\img-listFav\banner_index_4.webp" alt="Phụ kiện bóng đá">
                        <div class="category-overlay">
                            <h4 class="category-name">Phụ kiện bóng đá</h4>
                            <p class="category-description">Phụ kiện bóng đá chất lượng cao</p>
                        </div>
                    </a>
                    <a href="./danhsach.php?Sale=1" class="category-card">
                        <img src=".\img\img-listFav\banner_index_5.webp" alt="Sản phẩm giảm giá">
                        <div class="category-overlay">
                            <h4 class="category-name">Sản phẩm giảm giá</h4>
                            <p class="category-description">Cơ hội mua sắm với giá tốt nhất</p>
                            <span class="category-badge">Sale</span>
                        </div>
                    </a>
                    <a href="./danhsach.php?MaDM=DM-3" class="category-card">
                        <img src=".\img\img-listFav\banner_index_6.webp" alt="Giày trẻ em">
                        <div class="category-overlay">
                            <h4 class="category-name">Giày trẻ em</h4>
                            <p class="category-description">Giày bóng đá dành cho trẻ em</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div id="artificial_turf " class="block-product">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="modern-product-title">Giày đá bóng sân cỏ nhân tạo</h2>
                    <div class="modern-product-subtitle">Giày đá bóng đinh TF cập nhật thường xuyên</div>
                </div>

                <div class="modern-products-grid">
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
                        <div class="modern-product-card">
                            <div class="modern-product-image">
                                <?php if($TiLeGiam > 0): ?>
                                <div class="modern-product-discount">-<?php echo $TiLeGiam; ?>%</div>
                                <?php endif; ?>
                                <div class="modern-product-favorite">
                                    <i class="ti-heart"></i>
                                </div>
                                <img src="./img/products/<?php echo $data[$i]['AnhChinh'] ?>" alt="<?php echo $data[$i][1] ?>">
                            </div>
                            <div class="modern-product-info">
                                <div class="modern-product-vendor"><?php echo $data[$i]['TenHang'] ?></div>
                                <div class="modern-product-name">
                                    <a href="./chitietsp.php?MaSP=<?php echo $data[$i][0] ?>"><?php echo $data[$i][1] ?></a>
                                </div>
                                <div class="modern-product-price">
                                    <span class="price-new"><?php echo number_format(TinhTienGiam($TiLeGiam, $data[$i]['GiaMin']), 0, ',', '.') . "đ" ?></span>
                                    <span class="price-old"><?php echo $TiLeGiam == 0 ? "" : number_format($data[$i]['GiaMin'], 0, ',', '.') . "đ" ?></span>
                                </div>
                            </div>
                            <div class="modern-product-actions">
                                <a href="./chitietsp.php?MaSP=<?php echo $data[$i][0] ?>" class="modern-product-button">Chi tiết</a>
                                <button class="modern-product-button" onclick="addToCart('<?php echo $data[$i][0] ?>')"><i class="ti-shopping-cart"></i> Mua</button>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div id="get_data_NT"></div>
                <div class="text-center">
                    <a href="./danhsach.php?MaDM=DM-1" class="product-viewall-link">
                        <div class="viewall-button">Xem tất cả</div>
                    </a>
                </div>

            </div>
        </div>


        <div id="natural_turf " class="block-product">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="modern-product-title">Giày đá bóng sân cỏ tự nhiên</h2>
                    <div class="modern-product-subtitle">Giày đá banh đinh SG/MG/FG cập nhật thường xuyên</div>
                </div>
                <div class="modern-products-grid">
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
                        <div class="modern-product-card">
                            <div class="modern-product-image">
                                <?php if($TiLeGiam > 0): ?>
                                <div class="modern-product-discount">-<?php echo $TiLeGiam; ?>%</div>
                                <?php endif; ?>
                                <div class="modern-product-favorite">
                                    <i class="ti-heart"></i>
                                </div>
                                <img src="./img/products/<?php echo $data[$i]['AnhChinh'] ?>" alt="<?php echo $data[$i][1] ?>">
                            </div>
                            <div class="modern-product-info">
                                <div class="modern-product-vendor"><?php echo $data[$i]['TenHang'] ?></div>
                                <div class="modern-product-name">
                                    <a href="./chitietsp.php?MaSP=<?php echo $data[$i][0] ?>"><?php echo $data[$i][1] ?></a>
                                </div>
                                <div class="modern-product-price">
                                    <span class="price-new"><?php echo number_format(TinhTienGiam($TiLeGiam, $data[$i]['GiaMin']), 0, ',', '.') . "đ" ?></span>
                                    <span class="price-old"><?php echo $TiLeGiam == 0 ? "" : number_format($data[$i]['GiaMin'], 0, ',', '.') . "đ" ?></span>
                                </div>
                            </div>
                            <div class="modern-product-actions">
                                <a href="./chitietsp.php?MaSP=<?php echo $data[$i][0] ?>" class="modern-product-button">Chi tiết</a>
                                <button class="modern-product-button" onclick="addToCart('<?php echo $data[$i][0] ?>')"><i class="ti-shopping-cart"></i> Mua</button>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <div id="get_data_TN"></div>
                <div class="text-center">
                    <a href="./danhsach.php?MaDM=DM-2" class="product-viewall-link">
                        <div class="viewall-button">Xem tất cả</div>
                    </a>
                </div>
            </div>

        </div>
        <div id="futsal_turf " class="block-product">
            <div class="container">
                <div class="text-center mb-5">
                    <h2 class="modern-product-title">GIÀY ĐÁ BÓNG FUTSAL</h2>
                    <div class="modern-product-subtitle">Giày đá banh đế bằng IC cập nhật thường xuyên</div>
                </div>
                <div class="modern-products-grid">
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
                        <div class="modern-product-card">
                            <div class="modern-product-image">
                                <?php if($TiLeGiam > 0): ?>
                                <div class="modern-product-discount">-<?php echo $TiLeGiam; ?>%</div>
                                <?php endif; ?>
                                <div class="modern-product-favorite">
                                    <i class="ti-heart"></i>
                                </div>
                                <img src="./img/products/<?php echo $data[$i]['AnhChinh'] ?>" alt="<?php echo $data[$i][1] ?>">
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


                <div class="text-center">
                    <a href="./danhsach.php?MaDM=DM-4" class="product-viewall-link">
                        <div class="viewall-button">Xem tất cả</div>
                    </a>
                </div>
            </div>
        </div>

    </div>

    <form action="./giohang.php" method="post">
        <input type="hidden" name="MaSP" value="<?php echo $data[0][0] ?>">
    </form>

    </script>