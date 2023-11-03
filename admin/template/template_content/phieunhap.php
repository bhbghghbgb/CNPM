<form action="" method="" style="padding: 10px;">
    <h2 id="title_dh"  >Danh sách phiếu nhập</h2>

    <h5 style="font-weight: bold;" >Lọc đơn hàng theo ngày</h5>
    <label >Từ :</label>
    <input type="date" id="from" >
    <label >Đến :</label>
    <input type="date" id="to">

    <button type = "button" style="width: 100px; height:42px;background-color:burlywood;" >Lọc</button>
    <button type = "button"  style="width: 100px; height:42px;background-color:burlywood; margin-left:20px;">Refresh</button>
    
    <div>
        <a href="editpn.php?"  type="button"  style="width: 150px; height:42px; background-color:burlywood; text-align:center; margin-bottom:20px; border:2px solid black; color:black; margin-top:20px;  display: flex; justify-content: center; align-items: center; line-height: 42px;"  >Thêm Phiếu</a>
    </div>


    <style>
        .btn {
            display: none;
            
        }
        
        tr:hover .btn {
            display: inline-block;
        }
        #tablePN th {
            text-align: center;
            border: 1px solid black;
            padding: 5px;
            font-size: 18px;
            background-color: orange;
        }

        #tablePN td {
            text-align: center;
            font-size: 16px;
            border: 1px solid black;
            padding: 5px;
        }

    </style>

    <table id="ds_donhang"  >
     
    
    </table>

</form>

<script>
     $(document).ready(function () { 
        // hien thi phieu nhap len man hinh
        var getList = 'getList';
        $.ajax({
            url: '/CNPM/admin/template/template_content/ajaxphieunhap.php', // Đường dẫn đến file PHP
            method: 'POST',
            data: { flag: getList, }, // Dữ liệu muốn gửi đi
            success: function (response) {
                $('#ds_donhang').html(response);
            }
            });
     });

     function xemChiTiet(btn) {
        var row = btn.parentNode.parentNode;
        var maPN = row.children[0].textContent;
        // console.log( maPN);
        var ulr_new = 'ChiTietPhieuNhap.php?MaPN=' + maPN;
        window.location.href = ulr_new;
    }

    function duyet(btn) {
        var row = btn.parentNode.parentNode;
        var maPN = row.children[0].textContent;
        $.ajax({
            url: '/CNPM/admin/template/template_content/ajaxphieunhap.php', // Đường dẫn đến file PHP
            method: 'POST',
            data: { maPNDuyet: maPN, }, // Dữ liệu muốn gửi đi
            success: function (response) {
                // $('#ds_donhang').html(response);
                alert("Duyệt phiếu số : " + response + " thành công !");
                location.reload();
            }
            });
    }

    function tuChoi(btn) {
        var row = btn.parentNode.parentNode;
        var maPN = row.children[0].textContent;
        $.ajax({
            url: '/CNPM/admin/template/template_content/ajaxphieunhap.php', // Đường dẫn đến file PHP
            method: 'POST',
            data: { maPNTuChoi: maPN, }, // Dữ liệu muốn gửi đi
            success: function (response) {
                // $('#ds_donhang').html(response);
                alert("Từ chối phiếu số : " + response + " thành công !");
                location.reload();
            }
            });
    }

    function xoa(btn) {
        var row = btn.parentNode.parentNode;
        var maPN = row.children[0].textContent;
        $.ajax({
            url: '/CNPM/admin/template/template_content/ajaxphieunhap.php', // Đường dẫn đến file PHP
            method: 'POST',
            data: { maPNXoa: maPN, }, // Dữ liệu muốn gửi đi
            success: function (response) {
                // $('#ds_donhang').html(response);
                alert("Xóa phiếu số : " + response + " thành công !");
                location.reload();
            }
            });
    }



</script>


