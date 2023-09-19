<div id="backgroundDN"></div>
<form method="post" action="./index.php" id="form">
    <p class="icon-close" onclick=tatdn()>X</p>
    <h2>Đăng nhập</h2>
    Username:
    <input type="text" name="username" value="" required />
    Password:
    <input type="password" name="password" value="" required />
    <br />
    <br />
    <input type="submit" class="buttonDN" name="dangnhap" value="Đăng Nhập" />
    <br />
    <br />
    <input type="button" class="buttonDN" name="dangky" value="Đăng Ký" onclick=hienthidangky() />
    <?php require 'login_submit.php'; ?>
</form>