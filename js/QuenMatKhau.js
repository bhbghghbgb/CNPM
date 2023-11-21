//    Lấy tham chiếu đến button
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