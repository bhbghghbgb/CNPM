<form method="post" action="" id="formdk">
    <p class="icon-close" onclick=tatdk()>×</p>
    <h2>Đăng ký tài khoản</h2>
    <div class="input-group">
        <label for="reg-username">Tên đăng nhập</label>
        <input type="text" id="reg-username" name="username" placeholder="Nhập tên đăng nhập" required />
    </div>
    <div class="input-group">
        <label for="reg-password">Mật khẩu</label>
        <input type="password" id="reg-password" name="password" placeholder="Nhập mật khẩu" required />
    </div>
    <div class="input-group">
        <label for="reg-email">Email</label>
        <input type="email" id="reg-email" name="email" placeholder="Nhập địa chỉ email" required />
    </div>
    <div class="input-group">
        <label for="reg-name">Họ và tên</label>
        <input type="text" id="reg-name" name="TenKhach" placeholder="Nhập họ và tên" required />
    </div>
    <div class="input-group">
        <label for="reg-address">Địa chỉ</label>
        <input type="text" id="reg-address" name="DiaChi" placeholder="Nhập địa chỉ" required />
    </div>
    <div class="input-group">
        <label for="reg-phone">Số điện thoại</label>
        <input type="tel" id="reg-phone" name="SDT" placeholder="Nhập số điện thoại" required />
    </div>
    <div class="form-action">
        <input type="submit" class="buttonDN" name="dangky" value="Đăng Ký" />
    </div>
    <div class="form-footer">
        <p>Đã có tài khoản? <a href="#" onclick="hienthidangnhap()">Đăng nhập ngay</a></p>
    </div>
    <?php require 'register_submit.php'; ?>
</form>