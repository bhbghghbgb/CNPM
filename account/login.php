<div id="backgroundDN"></div>
<form method="post" action="./index.php" id="form">
    <p class="icon-close" onclick=tatdn()>×</p>
    <h2>Đăng nhập</h2>
    <div class="input-group">
        <label for="username">Tên đăng nhập</label>
        <input type="text" id="username" name="username" value="" placeholder="Nhập tên đăng nhập" required />
    </div>
    <div class="input-group">
        <label for="password">Mật khẩu</label>
        <input type="password" id="password" name="password" value="" placeholder="Nhập mật khẩu" required />
    </div>
    <div class="forgot-password">
        <a href="#" onclick=hienformquenmatkhau()>Quên mật khẩu?</a>
    </div>
    <div class="form-action">
        <input type="submit" class="buttonDN" name="dangnhap" value="Đăng Nhập" />
    </div>
    <div class="form-footer">
        <p>Chưa có tài khoản? <a href="#" onclick=hienthidangky()>Đăng ký ngay</a></p>
    </div>
    <!-- <?php require 'login_submit.php'; ?> -->
</form>