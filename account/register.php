<form method="post" action="" id="formdk">
    <p class="icon-close" onclick=tatdk()>X</p>
    <h2>Đăng ký</h2>
    Username: 
    <input type="text" name="username" value="" required/>
    Password: 
    <input type="password" name="password" value="" required/>
    Email: 
    <input type="text" name="email" value="" required/>
    Tên khách hàng:
    <input type="text" name="TenKhach" value="" required/>
    Địa chỉ:
    <input type="text" name="DiaChi" value="" required/>
    Số điện thoại:
    <input type="text" name="SDT" value="" required/>
    <br/>
    <br/>
    <input type="button" class="buttonDN" name="dangnhap" value="Đăng Nhập" onclick="hienthidangnhap()"/>
    <br/>
    <br/>
    <input type="submit" class="buttonDN" name="dangky" value="Đăng Ký"/>
    <?php require 'register_submit.php';?>
</form>
