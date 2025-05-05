<footer>
    <div class="footer-col">
        <div class="container3">
            <div class="boxcenter">
                <div class="contact">
                    <h4>LIÊN HỆ</h4>
                    <p>Giày đá banh chính hãng - Giày đá bóng chính hãng, uy tín: 71/88/12G, Đ.Nguyễn Bặc, P.3,
                        Q.Tân Bình</p>
                    <p><a href="tel:0962888669">0962888669 - 0879293979</a></p>
                    <p><a href="mailto:giaybongdamysoccer@gmail.com">giaybongdamysoccer@gmail.com</a></p>
                </div>
                <div class="pocicy">
                    <h4>CHÍNH SÁCH HỖ TRỢ</h4>
                    <p><a href="./index.php">Giới thiệu</a></p>
                    <p><a href="./ChinhSachBaoHanh.php">Chính sách bảo hành</a></p>
                    <p><a href="">Chính sách bảo mật</a></p>
                    <p><a href="./ChinhSachThanhToan.php">Điều khoản dịch vụ</a></p>
                </div>
                <div class="links">
                    <h4>LIÊN KẾT</h4>
                    <p>Hãy kết nối với chúng tôi</p>
                    <div class="social-icons">
                        <i class="ti-facebook"></i>
                        <i class="ti-twitter-alt"></i>
                        <i class="ti-instagram"></i>
                        <i class="ti-youtube"></i>
                    </div>
                </div>
                <div class="fangape">
                    <h4>FANPAGE GIÀY ĐÁ BANH CHÍNH HÃNG</h4>
                    <img src="./img/img-footer/chantrang.jpg" alt="ảnh chân trang">
                    <p class="copyright">© 2025 Giày Đá Banh Chính Hãng. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Các tập tin CSS và JS cho hiệu ứng được chuyển lên header -->

<?php
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $messageType = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : 'info';
    
    echo '<script>console.log("' . $message . '")</script>';

    // Sử dụng json_encode để truyền dữ liệu PHP sang JavaScript an toàn
    echo '<script language="javascript">addmessText(' . json_encode($message) . ', ' . json_encode($messageType) . ');</script>';

    unset($_SESSION['message']); // Xóa thông báo sau khi hiển thị
    unset($_SESSION['message_type']); // Xóa loại thông báo
}
?>