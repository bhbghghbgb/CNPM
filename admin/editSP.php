

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./css/bootstrap.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/admin.js"></script>
    <script src="../resources/ckeditor/ckeditor.js"></script>


    <link rel="stylesheet" href="./css/admin.css">
    <script src="./js/edit.js"></script>
    <title>Admin</title>
</head>

<body>
    <div class="wrapper" style=" background-color: #6c757d;height:100%;min-height:100vh">
        <?php include('template/topbar_ad.php'); ?>
        <div class="container">
            <div class="row " style="min-height:1200px;padding-bottom:50px;position: relative;">
                <div class="col-2 d-none d-lg-block d-md-block"></div>
                <?php include('template/menu_ad.php'); ?>
                <div id="main" class="col col-12 col-lg-10 col-md-10 ">
                    <?php include('template/header_ad.php'); ?>
                    <div id="content" class="row" style="background-color:#f0f5f8;height:calc(100% - 72px)">
                        <div class="main mx-auto ">
                            <?php
                            include('../db/dbconnect.php');
                            // Sửa sản phẩm
                            if (isset($_GET['id'])) {
                                
                                $id = $_GET['id'];
                                echo '<div class="row justify-content-center display-4">Sửa sản phẩm</div>';
                                $sql = 'SELECT * FROM sanpham WHERE MaSP="' . $id . '"';
                                $result = $conn->query($sql);
                                if (mysqli_num_rows($result) > 0) {
                                    // Lấy thông tin sản phẩm
                                    $row = mysqli_fetch_assoc($result);
                                    $ten = $row["Ten"];
                                    $moTa = $row["MoTa"];
                                    $gia = $row["Gia"];
                                    $hinhAnh = $row["AnhChinh"];
                                    $maKhuyenMai = $row["MaKhuyenMai"];
                                    $soLuong = $row["SLTonKho"];
                                    $maHang = $row["MaHang"];                                    
                                    $maDanhMuc = $row["MaDM"];                                    
                                }
                                else {echo"lỗi";}
                            }
                            // Thêm sản phẩm
                             else {
                                echo '<div class="row justify-content-center display-4">Thêm sản phẩm</div>';
                                $ten = '';
                                $moTa = '';
                                $gia = '';
                                $hinhAnh = '';
                                $maKhuyenMai = '';
                                $soLuong = 0;
                                $maHang='';
                                $maDanhMuc='';
                            }
                            //Luu bảng khuyen mãi, hang va danh muc
                                // Xuat danh sách hãng db ra mảng
                                $listHang = [];
                                $sql = "SELECT * FROM hang WHERE TrangThai = 1";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $listHang[$row['MaHang']]=$row['Ten'];
                                    }
                                }
                                // Xuat danh sách danhmuc db ra mảng
                                $listDanhMuc = [];
                                $sql = "SELECT * FROM danhmuc WHERE TrangThai = 1";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $listDanhMuc[$row['MaDM']]=$row['TenDM'];
                                    }
                                }
                                // Xuat danh sách khuyenmai db ra mảng
                                $listKhuyenMai = [];
                                $sql = "SELECT * FROM khuyenmai";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $listKhuyenMai[$row['MaKhuyenMai']]=$row['TenKhuyenMai'];
                                    }
                                }
                           
                            ?>
                            <!-- Tạo form thêm / sửa -->
                            <form action="xuly/xulyEditSP.php?" method="post" enctype="multipart/form-data">
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Tên sản phẩm: </div>
                                        <div class="col col-9">
                                            <input class="w-100" required type="text" name='ten' value="<?php echo $ten; ?>">
                                        </div>
                                    </label>
                                </div>
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Mô tả:</div>
                                        <div class="col col-9">
                                            <textarea id="textarea"class="w-100" rows="" cols="" name="mota"
                                                value="<?php echo $moTa; ?>"><?php echo $moTa; ?></textarea>
                                        </div>
                                    </label>
                                </div>
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Giá:</div>
                                        <div class="col col-9">
                                            <input class="w-100" type="number"required name='gia' value="<?php echo $gia; ?>">
                                        </div>
                                    </label>
                                </div>
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Danh mục:</div>
                                        <div class="col col-9">
                                            <select class="w-100" name="danhmuc">
                                            <?php
                                                foreach($listDanhMuc as $maDM=>$tenDM){
                                                    if($maDM==$maDanhMuc)
                                                    echo'<option value='.$maDM.' selected>'.$tenDM.'</option>';    
                                                    else
                                                    echo"<option value='$maDM'>$tenDM</option>";                                                
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </label>
                                </div>
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Ảnh :</div>
                                        <div class="col col-9">
                                            <input class="w-100" type="file" id="anhSP" name="anhchinh"
                                                onchange="getLinkImg()">
                                                <input class="w-100" type="hidden" name="anhchinhcu" value="<?php echo $hinhAnh;?> ">
                                            </div>
                                        </label>
                                    </div>                     
                                    <div class="row">
                                        <div class="col col-3"></div>
                                        <div class="col col-9">
                                            <div class="row">
                                                <img style="width: 300px;min-height: 150px;"
                                                src="<?php
                                                echo"../img/products/".$hinhAnh;
                                                ?>"
                                                alt="" id="imagePreview">
                                                <div id="myButton">Xóa ảnh</div>
                                                <div id="inner"></div>
                                                <script>
                                                    var changeButton = document.getElementById('myButton');
                                                    changeButton.addEventListener('click', function(){
                                                        document.getElementById('inner').innerHTML=`<input class="w-100" type="hidden" name="xoa" value="">`;
                                                        document.getElementById('imagePreview').style.display='none';
                                                    });
                                                </script>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label class="row"> 
                                        <div class="col col-3">Thư viện ảnh :</div>
                                        <div class="col col-9">
                                            <input class="w-100" type="file" id="anhSPs" name="anhphu" multiple enctype="multipart/form-data" onchange="getLinkImgs()">
                                        </div>
                                    </label>
                                </div>
                                <div class="row">
                                    <div class="col col-3"></div>
                                    <div class="col col-9">
                                        <div class="row">
                                            <div id="ListAnhPhu"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Hãng:</div>
                                        <div class="col col-9">
                                            <select class="w-100" name="hang">
                                                <?php
                                                foreach($listHang as $maH=>$tenH){
                                                    if($maH==$maHang)
                                                    echo'<option value='.$maH.' selected>'.$tenH.'</option>';    
                                                    else
                                                    echo"<option value='$maH'>$tenH</option>";                                                
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </label>
                                </div>
                                <div class="row mt-2">
                                    <label class="row">
                                        <div class="col col-3">Khuyến mãi:</div>
                                        <div class="col col-9">
                                            <select class="w-100" name="khuyenmai">
                                            <?php
                                                foreach($listKhuyenMai as $maKM=>$tenKM){
                                                    if($maKM==$maKhuyenMai)
                                                    echo'<option value='.$maKM.' selected>'.$tenKM.'</option>';    
                                                    else
                                                    echo'<option value='.$maKM.'>'.$tenKM.'</option>';                                                
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </label>
                                </div>
                                <div class="row mt-2">
                                    <div class="col col-3"></div>
                                    <div class="col col-9">
                                        <?php
                                        if (isset($_GET['id'])) {
                                            echo "<input type='hidden' name='id' value=" . $id . ">";
                                            echo '<a><input type="submit" class="btn bg-success" name="hd" value="Lưu"></a>';
                                            echo "<a class='text-black' href='editsp.php?'> 
                                                <div class='btn bg-secondary'>Thêm mới</div>
                                            </a>";
                                        } else
                                            echo '<input type="submit" class="btn bg-success"name="hd" value="Thêm">';
                                        ?>
                                        <a href="index.php?id=sp">
                                            <div class='btn text-black bg-danger'>Hủy</div>
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        </div>

    </div>
    <?php
    $conn->close();
    ?>
    <script>
        showmenu();
        choosemenu();
    </script>
    <script>
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('textarea');
    </script>
</body>

</html>