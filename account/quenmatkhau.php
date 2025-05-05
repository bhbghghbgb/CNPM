<div id="form_quenmatkhau">
    <p class="icon-close" onclick=tatqmk()>×</p>
    <h2>Khôi phục mật khẩu</h2>
    <p class="form-description">Vui lòng nhập địa chỉ email đã đăng ký để nhận mã xác nhận</p>
    
    <div class="input-group">
        <label for="valueSend">Email đã đăng ký</label>
        <input type="email" id='valueSend' placeholder="Nhập địa chỉ email" required value=''>
    </div>
    
    <div class="form-action">
        <input type="submit" class="buttonDN" id='Send' value="Gửi mã xác nhận">
    </div>
    
    <div id="ma">
        <div class="input-group">
            <label for="token">Mã xác nhận</label>
            <input type="hidden" id='token1' value=''>
            <input type="number" required id='token' placeholder="Nhập mã xác nhận">
        </div>
        
        <div class="form-action">
            <input type="submit" class="buttonDN" id='confirmtoken' value="Xác nhận">
        </div>
    </div>
    
    <div id="matkhaumoi"></div>
    
    <div class="form-footer">
        <p>Đã nhớ mật khẩu? <a href="#" onclick="hienthidangnhap()">Đăng nhập ngay</a></p>
    </div>
</div>
<!-- <script src="QuenMatKhau.js"> </script> -->

<style>
    #ma {
        display: none;
    }
</style>