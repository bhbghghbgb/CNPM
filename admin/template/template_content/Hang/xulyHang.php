<link rel="stylesheet" href="../../../css/XuLyKhuyenMai.css" >
<!-- ^Hang_ -->
<?php
    include("../../../../db/DAOHang.php");
    $db = new DAOHang();
    $db->connect();
    if(isset($_GET['cn'])){
        switch($_GET['cn']){
            case 'Add':{
                        if(isset($_POST['MaHang'])){
                            $_MaHang = $_POST['MaHang'];
                        }
                        else{
                            $_MaHang = "";
                        }
                    
                        if(isset($_POST['TenHang'])){
                            $_TenHang = $_POST['TenHang'];
                        }
                        else{
                            $_TenHang = "";
                        }
                    

                ?>
                    <form method="POST" action="">
                        <a href="../../../index.php?id=h"><div id="Back">X</div></a>
                        <h2>Thêm hãng</h2>

                        <label for="MaHang">Mã hãng: </label><br>
                        <input type="text" id="MaHang" name="MaHang" value="<?php echo $_MaHang?>"><br>
                        
                        <label for="TenHang">Tên hãng: </label><br>
                        <input type="text" id="TenHang" name="TenHang" value="<?php echo $_TenHang?>"><br>
            
                        
                        <div class="button-block"><input type="submit" id="Add" name="Add" value="Thêm hãng"></div>
                    </form>
                <?php
                break;
            }
            case 'Delete':{
                $_MaHang = $_GET['MaHang'];

                if($db->deleteHang($_MaHang) == true){
                    echo "<script>alert('Đã xóa hãng ');window.location='../../../index.php?id=h';</script>";
                    return;
                }
                else{
                    echo "<script>alert('Không xóa hãng này được');window.location='../../../index.php?id=h';</script>";
                    return;
                }
            }
            case 'Edit':{
                        if(isset($_GET['MaHang'])){
                            $_MaHang = $_GET['MaHang'];
                        }
                        else{
                            $_MaHang = "";
                        }
                    
                        if(isset($_GET['TenHang'])){
                            $_TenHang = $_GET['TenHang'];
                        }
                        else{
                            $_TenHang = "";
                        }
                ?>
                    <form method="POST" action="">
                        <a href="../../../index.php?id=h"><div id="Back">X</div></a>
                        <h2>Sửa hãng</h2>
                        
                        <label for="MaHang">Mã hãng: </label><br>
                        <input type="text" id="MaHang" name="MaHang" value="<?php echo $_MaHang?>" readonly><br>
                        <!-- Su dung thuoc tinh readonly de thuc hien khoa ma hang lai -->

                        <label for="TenHang">Tên hãng: </label><br>
                        <input type="text" id="TenHang" name="TenHang" value="<?php echo $_TenHang?>"><br>
                        
                        <div class="button-block"><input type="submit" id="Edit" name="Edit" value="Sửa hãng"></div>
                    </form>
                <?php
                break;
            }
        }
    }

    if(isset($_POST['Add']))
    {
        $_MaHang = $_POST['MaHang'];        
        $_TenHang = $_POST['TenHang'];

        
        $_date = getdate();

        $_NgayTao = $_date['year'] . '-' . $_date['mon'] . '-' . $_date['mday'];

        if($_MaHang == "" || $_TenHang == "" ){
            echo "<script>alert('Không được để trống thông tin')</script>";
            return;
        }

        $pattern = '/^MH-/';
        if(preg_match($pattern, $_MaHang) == false){
            echo "<script>alert('Mã hãng phải bắt đầu bằng MH-')</script>";
            return;
        }

        if($db->checkHangDaXoa($_MaHang)==true){
            if($db->insertHangDaXoa($_MaHang,$_TenHang,$_NgayTao)==true){
                echo "<script>alert('Thêm thành công');window.location='../../../index.php?id=h';</script>";
                return;
            }
            return;
        }

        if($db->hasHang($_MaHang) == false){
            echo "<script>alert('Mã hãng đã tồn tại ')</script>";
            return;
        }

        
        if($db->insertHang($_MaHang,$_TenHang,$_NgayTao) == true){
            echo "<script>alert('Them thanh cong');window.location='../../../index.php?id=h';</script>";
        }
    }

    if(isset($_POST['Edit'])){
        $_MaHang = $_POST['MaHang'];        
        $_TenHang = $_POST['TenHang'];

        if($_MaHang == "" || $_TenHang == "" ){
            echo "<script>alert('Khong duoc de trong thong tin')</script>";
            return;
        }

        if($db->updateHang($_MaHang,$_TenHang) == true){
            echo "<script>alert('Sua thanh cong');window.location='../../../index.php?id=h';</script>";
        }
        else{
            echo "<script>alert('Sua that bai');</script>";
        }

    }
    
?>