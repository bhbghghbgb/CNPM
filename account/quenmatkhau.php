


<div id="form_quenmatkhau">
    <h2>Nhập địa chỉ email của bạn </h2>
    <p class="icon-close" onclick=tatqmk()>X</p>
    <label for="email">Email:</label>
    <input type="email" id='valueSend' required value=''>
    </br>
    </br>
    <input type="submit" class="buttonDN" id='Send' value="Gửi Mã">
    </br>
    </br>
    <div id="ma">
        Nhập mã :
        <input type="hidden" id='token1' value=''>
        <input type="number" required id='token'>
        </br>
        </br>
        <input type="submit" class="buttonDN" id='confirmtoken' value="Xác nhận">
        </br>
        </br>
    </div>
    <div id="matkhaumoi"></div>
</div>
<!-- <script src="QuenMatKhau.js"> </script> -->

<style>
    #ma{display:none;}
</style> 