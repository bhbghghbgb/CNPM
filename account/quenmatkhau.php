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
<script>
    // Lấy tham chiếu đến button

    $(document).ready(function () {

        var btnSend = document.getElementById('Send');
        btnSend.addEventListener('click', function () {
            // Lấy giá trị của phần tử valueSend khi người dùng nhấn vào nút
            var value = document.getElementById('valueSend').value;
            var ma = document.getElementById('ma');
            $.ajax({
                url: './account/ajax_check.php',
                method: 'POST',
                data: { email: value },
                success: function (response) {
                    if(response!=''){
                        document.getElementById('token1').value = response;
                        addmessText('Gửi mã thành công \n Vui lòng check gmail');
                        ma.style.display='block'
                    }
                    else addmessText('Tài khoản không tồn tại');
                }
            });
        });

        var btnConfirm = document.getElementById('confirmtoken');
        btnConfirm.addEventListener('click', function () {
            var value = document.getElementById('token').value;
            var email = document.getElementById('valueSend').value;
            var inner = document.getElementById('matkhaumoi');
            $.ajax({
                url: './account/ajax_check.php',
                method: 'POST',
                data: {
                    email:email,
                    token: value,
                    token1: document.getElementById('token1').value
                },
                success: function (response) {
                    if(response!='')
                    inner.innerHTML = response
                    else addmessText('Mã không đúng');
                }
            });
        });
    });

</script>
<style>
    #ma{display:none;}
</style>