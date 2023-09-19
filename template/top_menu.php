<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<div id="toggle">
    <i class="fa-solid fa-bars"></i>
</div>
<nav>
    <div class="top_menu">
        <ul>
            <li>
                <a href="index.php">TRANG CHỦ</a>
            </li>
            <li>
                <a href="./DanhSach.php?Sale=1">GIÀY SALE</a>
            </li>
            <li>
                <a href="./DanhSach.php?MaDM=DM-3">GIÀY TRẺ EM</a>
            </li>
            <li>
                <a href="./DanhSach.php?MaDM=DM-1">GIÀY ĐINH SÂN CỎ NHÂN TẠO <i class="ti-angle-down"></i></a>
                <ul class="ds_phu">
                    <li><a href="./DanhSach.php?MaDM=DM-1&MaHang=MH-001">Adidas TF</a>
                        <!-- <ul class="ds_phu_phu">
                            <li><a href="">Adidas Nemeziz</a></li>
                            <li><a href="">Adidas Copa</a> </li>
                            <li><a href="">Adidas Predator</a> </li>
                            <li><a href="">Adidas X Ghosted</a></li>
                        </ul> -->
                    </li>
                    <li><a href="./DanhSach.php?MaDM=DM-1&MaHang=MH-002">Nike TF</a>
                        <!-- <ul class="ds_phu_phu">
                            <li><a href="">Nike Tiempo</a></li>
                            <li><a href="">Nike Mercurial</a></li>
                        </ul> -->
                    </li>
                    <li><a href="./DanhSach.php?MaDM=DM-1&MaHang=MH-033">Puma TF</a></li>
                    <li><a href="./DanhSach.php?MaDM=DM-1&MaHang=MH-021">Pan Thailand TF</a></li>
                </ul>
            </li>
            <li>
                <a href="./DanhSach.php?MaDM=DM-2">GIÀY ĐINH SÂN CỎ TỰ NHIÊN <i class="ti-angle-down"></i></a>
                <ul class="ds_phu">
                    <li><a href="./DanhSach.php?MaDM=DM-2&MaHang=MH-001">Adidas FG/MG</a></li>
                    <li><a href="./DanhSach.php?MaDM=DM-2&MaHang=MH-002">Nike FG/MG</a></li>
                    <li><a href="./DanhSach.php?MaDM=DM-2&MaHang=MH-033">Puma FG/MG</a></li>
                </ul>
            </li>
            <li>
                <a href="">GIỚI THIỆU <i class="ti-angle-down"></i></a>
                <ul class="ds_phu">
                    <li><a href="https://www.facebook.com/giaydabanhchinhhang.vn/photos/?tab=album&album_id=2420665091507845">Thêu tên FREE Tag ID</a></li>
                    <li><a href="https://www.facebook.com/giaydabanhchinhhang.vn/photos/?tab=album&album_id=2374627602778261">Album khách hàng</a></li>
                </ul>
            </li>
            <li>
                <a href="">HƯỚNG DẪN MUA HÀNG <i class="ti-angle-down"></i></a>
                <ul class="ds_phu">
                    <li><a href="ChinhSachBaoHanh.php">Chính sách bảo hành</a></li>
                    <li><a href="ChinhSachDoiHang.php">Chính sách đổi hàng</a></li>
                    <li><a href="ChinhSachThanhToan.php">Chính sách thanh toán</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<script>
    $(document).ready(function() {
        $('#toggle').click(function() {
            $('nav').slideToggle();
        })
    })
</script>