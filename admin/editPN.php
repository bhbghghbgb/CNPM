<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
        <link rel="stylesheet" href="./css/font-awesome_5.15.4_css_all.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="./js/admin.js"></script>
    


    <link rel="stylesheet" href="./css/admin.css">
    <script src="./js/edit.js"></script>
    <title>Admin</title>
</head>

<body>
    <div class="wrapper">
        <?php include('template/topbar_ad.php'); ?>
        <div class="container-fluid">
                <?php include('template/menu_ad.php'); ?>
                <div id="main">
                    <?php include('template/header_ad.php'); ?>
                    <div id="content" class="row" style="background-color:#f0f5f8;height:calc(100% - 72px)">
                        <div class="main mx-auto ">
                            <?php
                            // Phiếu nhập
                                echo '<div class="row justify-content-center display-4">Thêm Phiếu Nhập</div>';
                            ?>
                            
                            <a href="./index.php?id=pn" type="button"  style="width: 80px; height:30px; background-color:burlywood; text-align:center; margin-bottom:10px; border:2px solid black; color:black;" >Thoát</a>

                            <!-- List hãng-->
                            <form action="" method="" style="border:2px solid black; background-color:bisque; padding:10px;"   >
                                <button type="button" id="buttonGuiYeuCau" style="width: 200px; height:30px;background-color:burlywood;" >Gửi yêu cầu nhập hàng</button>
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Hãng</div>
                                        <div class="col col-7">
                                            <select class="w-100" name="hang"  id="selectHang" >
                                            <?php
                                            include('../db/DAOHang.php');
                                            $daoHang = new DAOHang();
                                            $ListHang = $daoHang->getList();
                                            for ($i = 0; $i<count($ListHang); $i++) {
                                                $maHang =   $ListHang[$i]['MaHang']; // mã hãng
                                                $tenHang =   $ListHang[$i]['Ten']; // tên hãng
                                                echo"<option value='$maHang'>$tenHang</option>";   
                                            }
                                            ?>
                                            </select>
                                        </div>
                                        <button type="button" id="buttonXacNhan" style="width: 100px; height:30px ; text-align:center;background-color:burlywood;"  >  Xác nhận </button>
                                    </label>
                                </div> 
                                <!-- List sản phẩm -->
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Tên sản phẩm:</div>
                                        <div class="col col-9">
                                            <select class="w-100" name="sanpham" id="selectSanPham" >
                                           
                                            </select>
                                        </div>
                                    </label>
                                </div>
                                <!-- Nhập số lượng -->
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Số lượng: </div>
                                        <div class="col col-9">
                                            <input class="w-100" required type="number" name='soluong' id="inputSoLuong" value="" >
                                        </div>
                                    </label>
                                </div>
                                <!-- Nhập giá nhập -->
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Giá Nhập: </div>
                                        <div class="col col-9">
                                            <input class="w-100"  type="number" name='dongia' value="" id="inputGiaNhap" >
                                        </div>
                                    </label>
                                </div>
                                <!-- List size -->
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Size: </div>
                                        <div class="col col-9">
                                            <select name="soSize" class="w-100" id="selectSize">

                                            </select>
                                        </div>
                                    </label>
                                </div>

                                <button type="button" id="buttonThem"  style="margin-left: 325px; margin-top:10px; width:80px; height:30px;background-color:burlywood; margin-bottom:10px;" >Thêm</button>
                                
                                                     
                            <div id="ctdh" >
                                <style>
                                    .btn {
                                        display: none;
                                    }

                                    tr:hover .btn {
                                        display: inline-block;
                                    }
                                    
                                    #tableCTPN th {
                                        text-align: center;
                                        border: 1px solid black;
                                        padding: 5px;
                                        font-size: 18px;
                                        background-color: orange;
                                    }

                                    #tableCTPN td {
                                        text-align: center;
                                        font-size: 16px;
                                        border: 1px solid black;
                                        padding: 5px;
                                    }

                                </style>
                                <table class="w-100"id="tableCTPN" style="background-color: #f0f5f8;" >
                                    <thead>
                                        <th>Mã sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Size</th>
                                        <th>Số lượng</th>
                                        <th>Giá</th>
                                        <th>Tổng tiền</th> 
                                        <th>Hành động</th>
                                    </thead>
                                    <tbody>
                                      

                                    </tbody>   
                                </table>
                                </div>
                            </form>
                 
                            <div style="display: inline-block; margin-left:800px; font-size: 25px; margin-top:20px;" >Tổng : </div>    
                            <div id = "tong"  style = "display: inline-block;font-size: 25px;background-color: burlywood; margin-top:20px;">0</div>             
                            <div id="showData" ></div>
                       </div>
                    </div>
                </div>

            </div>
        </div>
        </div>
    </div>

    <script>
 

    $(document).ready(function () {
        //Xử lý sự kiện nhấn nút xác nhận
        $('#buttonXacNhan').click(function () {
            document.getElementById('selectHang').disabled = true;
            document.getElementById('buttonXacNhan').disabled = true;
            var selectHangValue = document.getElementById('selectHang').value;
            $.ajax({
            url: 'editAjaxPN.php', // Đường dẫn đến file PHP
            method: 'POST',
            data: { maHang: selectHangValue, }, // Dữ liệu muốn gửi đi
            success: function (response) {
                $('#selectSanPham').html(response);
                var event = new Event('change');
                document.getElementById('selectSanPham').dispatchEvent(event);

            }
            });
        });
        // Xử lý sự kiện khi chọn một sản phẩm
        document.getElementById('selectSanPham').addEventListener('change', function() {
            var selectSPValue = document.getElementById('selectSanPham').value;
            var parts = selectSPValue.split("~");

            var maSPValue = parts[0];
            var tenSPValue = parts[1];
            $.ajax({
            url: 'editAjaxPN.php', // Đường dẫn đến file PHP
            method: 'POST',
            data: { maSP: maSPValue, }, // Dữ liệu muốn gửi đi
            success: function (response) {
                $('#selectSize').html(response);
                document.getElementById('inputSoLuong').value = "";
                document.getElementById('inputGiaNhap').value = "";
            }
            });
        });

        $('#buttonThem').click(function () {
           
            
            var maSP = document.getElementById('selectSanPham').value;
            var selectedOption = document.getElementById('selectSanPham').options[document.getElementById('selectSanPham').selectedIndex];
            var tenSP = selectedOption.getAttribute("data-name");
            var maHang =  document.getElementById('selectHang').value;
            var soLuong =  document.getElementById('inputSoLuong').value;
            var giaNhap =  document.getElementById('inputGiaNhap').value;
            var size =  document.getElementById('selectSize').value;

           
            if (maSP == "" || tenSP == "" || soLuong == "" || size == "" || giaNhap =="") {
                alert("Vui lòng điền đầy đủ thông tin !");
            }else {
                addTableCTPN(maSP, tenSP, soLuong, size, giaNhap)
                tinhTongTien();
            }
        });

        $('#buttonGuiYeuCau').click(function () {
            var table = document.getElementById('tableCTPN'); // Thay 'myTable' bằng ID của bảng
            if (table.rows.length > 1) {
                var ListCTPNValue = getTableCTPN();
                var TongTien =   document.getElementById("tong").innerText;
                var selectHangValue = document.getElementById('selectHang').value;
                $.ajax({
                url: 'editAjaxPN.php', // Đường dẫn đến file PHP
                method: 'POST',
                data: { listCTPN: ListCTPNValue,
                        tongTien : TongTien,
                        maHangValue:  selectHangValue }, // Dữ liệu muốn gửi đi
                success: function (response) {
                    // $('#showData').html(response);
                    alert("Gửi yêu cầu thành công mã phiếu nhập là : " + response);
                    window.location.href = './index.php?id=pn';
                }
                });
            } else {
                alert('Vui lòng nhập sản phẩm cần nhập !');
            }
           
           
            
        });

        function getTableCTPN () {
            var table = document.getElementById("tableCTPN");
            var data = [];

            for (var i = 1; i < table.rows.length; i++) {
                var rowData = [];
                var row = table.rows[i];

                for (var j = 0; j < row.cells.length-1; j++) {
                    if (j!=1) {
                        rowData.push(row.cells[j].innerHTML);
                    }
                
                }
                data.push(rowData);
            }
           return data;
        }
       
        function tinhTongTien () {
            var tongTien = 0;
            var table = document.getElementById("tableCTPN");
            for (var i = 1; i < table.rows.length; i++) {
                var row = table.rows[i];
                tongTien +=  parseInt( row.cells[5].innerHTML)
               
            }
            document.getElementById("tong").innerHTML  = tongTien;
        }

        function addTableCTPN(maSP, tenSP, soLuong, size, giaNhap) {
            var flag =true;
            var table = document.getElementById("tableCTPN");
            
            for (var i = 0; i < table.rows.length; i++) {
                var row = table.rows[i];
                if (maSP == row.cells[0].innerHTML && size == row.cells[2].innerHTML && giaNhap == row.cells[4].innerHTML) {
                   row.cells[3].innerHTML = parseInt(row.cells[3].innerHTML) + parseInt( soLuong);
                   row.cells[5].innerHTML =parseInt(row.cells[3].innerHTML) * parseInt (giaNhap);
                   flag = false; 
                }
            }

  
            // them hang moi
            if (flag == true) {
            
                for (var i = 0; i < table.rows.length; i++) {
                var row = table.rows[i];
                if (maSP == row.cells[0].innerHTML && size == row.cells[2].innerHTML) {
                        var result = confirm("Tồn tại cùng một sản phẩm nhưng khác giá, bạn có muốn thêm tiếp không ?");
                        if (result) {
                            flag = true;
                            break;
                        } else {
                            flag = false;
                            break;
                        }
                    }
                }
                if (flag == true){
                    var tongTien = parseInt(soLuong) * parseInt(giaNhap);
                    
                    var table = document.getElementById("tableCTPN");
                    var row = table.insertRow();
                    var cellMaSP = row.insertCell(0);
                    var cellTenSP = row.insertCell(1);
                    var cellSize = row.insertCell(2);
                    var cellSoLuong = row.insertCell(3);
                    var cellGiaNhap = row.insertCell(4);
                    var cellTongTien = row.insertCell(5);
                    var cellHanhDong = row.insertCell(6);

                    cellMaSP.innerHTML =  maSP;
                    cellTenSP.innerHTML =  tenSP;
                    cellSize.innerHTML =  size;
                    cellSoLuong.innerHTML =  soLuong;
                    cellGiaNhap.innerHTML =  giaNhap;
                    cellTongTien.innerHTML =  tongTien;
                    cellHanhDong.innerHTML =  '<button class = "btn" id="buttonDelete" type= "button" style="background-color:red; height:auto; border: 1px solid black;" onclick="deleteRow(this)">Xóa </button>'; 
                }  
            }
    
        }
    });

    function deleteRow(btn) {
        var row = btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
        

 
    </script>
</body>

</html>