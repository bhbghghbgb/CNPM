<form action="" method="" style="padding: 10px;">
    <h2 id="title_dh"  >Danh sách phiếu nhập</h2>

    <div >
        <h5 style="font-weight: bold; display:inline-block"  >Lọc đơn hàng theo : </h5> 
        <input type="radio" name="options" value="date" id="radioDate"  style="margin-left: 15px;"checked > <label style="font-weight: bold; font-size:18px;" for="radioDate">Ngày</label>
        <input type="radio" name="options" value="fromto" id="radioFromTo" > <label style="font-weight: bold; font-size:18px;" for="radioFromTo">Khoảng thời gian</label>
    </div>

    
    
        <div id="dateDiv" style=" display:inline-block; " >
            <label>Ngày:</label>
            <input type="date" id="date" >
            <button type = "button" id="buttonLocNgay" style="width: 100px; height:42px;background-color:burlywood; display:inline-block;" >Lọc</button>
            <button type = "button" class="buttonReset" style="width: 100px; height:42px;background-color:burlywood; margin-left:20px;display:inline-block;">Refresh</button>

        </div>

        <div id="fromToDiv" style=" display:inline-block;" >
            <label>Từ:</label>
            <input type="date" id="from">
            <label>Đến:</label>
            <input type="date" id="to">
            <button type = "button" id="buttonLocKhoangTG" style="width: 100px; height:42px;background-color:burlywood; display:inline-block;" >Lọc</button>
            <button type = "button" class="buttonReset" style="width: 100px; height:42px;background-color:burlywood; margin-left:20px;display:inline-block;">Refresh</button>

        </div>
    
        
    
    
    <div>
        <a href="editpn.php?"  type="button"  style="width: 150px; height:42px; background-color:burlywood; text-align:center;display:inline-block; margin-bottom:20px; border:2px solid black; color:black; margin-top:20px;  display: flex; justify-content: center; align-items: center; line-height: 42px;"  >Thêm Phiếu</a>    
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
    <?php 
        // include ("../db/DAOPhanQuyen.php");
        $maTaiKhoan = $_SESSION['MaQuyen'];
        $daoPhanQuyen = new DaoPhanQuyen();
        $flag = $daoPhanQuyen->hasDuyetPN($maTaiKhoan);
        
        if ($flag ) {
            $d = 1;
        } else {
            $d = 0;
        }
        ?>
</form>

<script>
     $(document).ready(function () { 
        
         var flagjs = <?php echo json_decode($d); ?>;
         if (flagjs == 1) {
            var getList = 'getList';
         } else {
            var getList = 'getListNoHanhDong';
         }

        // hien thi phieu nhap len man hinh
        $.ajax({
            url: '/CNPM/admin/template/template_content/ajaxphieunhap.php', // Đường dẫn đến file PHP
            method: 'POST',
            data: { flag: getList, }, // Dữ liệu muốn gửi đi
            success: function (response) {
                $('#ds_donhang').html(response);
              
            }
            });

            // button lọc theo khoảng thời gian
            $('#buttonLocKhoangTG').click(function () {
                var flagLoc = 0;
                var fromDateValue = document.getElementById("from").value;
                var toDateValue =document.getElementById("to").value;
                
                
                var fromDate = new Date(fromDateValue);
                var toDate = new Date(toDateValue);
              
                if (fromDateValue != "" && toDateValue != ""){
                    if (fromDate < toDate) { // ngay dung
                        console.log("Đúng");
                        flagLoc = 1;
                    }else if ( fromDate > toDate){ // ngay sai
                        console.log("sai");
                        alert ("Ngày bắt đầu không được lớn hơn ngày kết thúc !");
                        flagLoc =2;
                    } else {
                        console.log("bằng nhau"); // ngay bang nhau
                        flagLoc = 3;
                    }
                } else {
                    alert ("Vui lòng chọn đầy đủ thời gian để lọc !");
                }

                if (flagLoc == 1 || flagLoc == 3){
                    console.log (getList);
                    console.log(fromDateValue);
                    console.log(toDateValue);
                    $.ajax({
                    url: '/CNPM/admin/template/template_content/ajaxphieunhap.php', // Đường dẫn đến file PHP
                    method: 'POST',
                    data: { dateStart: fromDateValue,
                            dateEnd : toDateValue,
                            flagValueLoc : getList, 
                            }, // Dữ liệu muốn gửi đi
                    success: function (response) {
                        $('#ds_donhang').html(response);
                        console.log(response);
                    
                        }
                    });
                }
            });
        
            $('#buttonLocNgay').click(function () {
                var dateValue = document.getElementById("date").value;
                console.log(dateValue);
                if (dateValue != "") {
                    $.ajax({
                    url: '/CNPM/admin/template/template_content/ajaxphieunhap.php', // Đường dẫn đến file PHP
                    method: 'POST',
                    data: { dateValueLoc: dateValue,
                            flagValueLocNgay : getList, 
                            }, // Dữ liệu muốn gửi đi
                    success: function (response) {
                        $('#ds_donhang').html(response);
                        console.log(response);
                    
                        }
                    });

                } else {
                    alert ("Vui lòng chọn thời gian để lọc");
                }
            });

            $('.buttonReset').click(function () {
                console.log("Đã bấm reset")
                $.ajax({
                    url: '/CNPM/admin/template/template_content/ajaxphieunhap.php', // Đường dẫn đến file PHP
                    method: 'POST',
                    data: { flag: getList, }, // Dữ liệu muốn gửi đi
                    success: function (response) {
                        $('#ds_donhang').html(response);
                    
                    }
                });
            });


     
 });


    // khai báo nhấn chọn
    var radioDate = document.getElementById("radioDate");
    var radioFromTo = document.getElementById("radioFromTo");
    // khai báo thẻ div
    var dateDiv = document.getElementById("dateDiv");
    var fromToDiv = document.getElementById("fromToDiv");
    // khóa chọn khoảng thời gian
    dateDiv.style.display = "block";
    fromToDiv.style.display = "none";
    // khi nhấn chọn ngày
    radioDate.addEventListener("change", function() {
    if (radioDate.checked) {
        dateDiv.style.display = "block";
        fromToDiv.style.display = "none";
    }
    });

    // khi nhấn chọn khoảng thời gian
    radioFromTo.addEventListener("change", function() {
    if (radioFromTo.checked) {
        dateDiv.style.display = "none";
        fromToDiv.style.display = "block";
    }
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


