<link rel="stylesheet" href="../../../css/XuLyKhuyenMai.css" >
<!-- ^KM_ -->
<?php
    include("../../../../db/DAOKhuyenMai.php");
    $db = new DAOKhuyenMai();
    $db->connect();
    if(isset($_GET['cn'])){
        switch($_GET['cn']){
            case 'Add':{
                        if(isset($_POST['MaKM'])){
                            $_MaKM = $_POST['MaKM'];
                        }
                        else{
                            $_MaKM = "";
                        }
                    
                        if(isset($_POST['TenKM'])){
                            $_TenKM = $_POST['TenKM'];
                        }
                        else{
                            $_TenKM = "";
                        }
                    
                        if(isset($_POST['MoTa'])){
                            $_MoTa = $_POST['MoTa'];
                        }
                        else{
                            $_MoTa = "";
                        }
                    
                        if(isset($_POST['TiLeGiam'])){
                            $_TiLeGiam = $_POST['TiLeGiam'];
                        }
                        else{
                            $_TiLeGiam = "";
                        }
                ?>
                    <form method="POST" action="">
                        <a href="../../../index.php?id=km"><div id="Back">X</div></a>
                        <h2>Thêm khuyến mãi</h2>

                        <label for="MaKM">Mã khuyến mãi: </label><br>
                        <input type="text" id="MaKM" name="MaKM" value="<?php echo $_MaKM?>"><br>
                        
                        <label for="TenKM">Tên khuyến mãi: </label><br>
                        <input type="text" id="TenKM" name="TenKM" value="<?php echo $_TenKM?>"><br>
                        
                        <label for="MoTa">Mô tả: </label><br>
                        <input type="text" id="MoTa" name="MoTa" value="<?php echo $_MoTa?>"><br>
                        
                        <label for="TiLeGiam">Phần trăm sẽ giảm:</label><br>
                        <input type="number" id="TiLeGiam" name="TiLeGiam" min="1" max="100" value="<?php echo $_TiLeGiam?>"><br>
                        
                        <div class = "button-block"><input type="submit" id="Add" name="Add" value="Thêm khuyến mãi"></div>
                    </form>
                <?php
                break;
            }
            case 'Delete':{
                $_MaKM = $_GET['MaKM'];
                if($db->hasSP($_MaKM) == false){
                    echo "<script>alert('Còn sản phẩm đang áp dụng khuyến mãi này');window.location='../../../index.php?id=km';</script>";
                    return;
                }
                if($db->deleteKM($_MaKM) == true){
                    echo "<script>alert('Đã xóa khuyến mãi ');window.location='../../../index.php?id=km';</script>";
                    return;
                }
                else{
                    echo "<script>alert('Không xóa khuyến mãi này được');window.location='../../../index.php?id=km';</script>";
                    return;
                }
                
            }
            case 'Edit':{
                        if(isset($_GET['MaKM'])){
                            $_MaKM = $_GET['MaKM'];
                        }
                        else{
                            $_MaKM = "";
                        }
                    
                        if(isset($_GET['TenKM'])){
                            $_TenKM = $_GET['TenKM'];
                        }
                        else{
                            $_TenKM = "";
                        }
                    
                        if(isset($_GET['MoTa'])){
                            $_MoTa = $_GET['MoTa'];
                        }
                        else{
                            $_MoTa = "";
                        }
                    
                        if(isset($_GET['TiLeGiam'])){
                            $_TiLeGiam = $_GET['TiLeGiam'];
                        }
                        else{
                            $_TiLeGiam = "";
                        }
                ?>
                    <form method="POST" action="">
                        <a href="../../../index.php?id=km"><div id="Back">X</div></a>
                        <h2>Sửa khuyến mãi</h2>
                        
                        <label for="MaKM">Mã khuyến mãi: </label><br>
                        <input type="text" id="MaKM" name="MaKM" value="<?php echo $_MaKM?>" readonly><br>
                        <!-- Su dung thuoc tinh readonly de thuc hien khoa ma khuyen mai lai -->

                        <label for="TenKM">Tên khuyến mãi: </label><br>
                        <input type="text" id="TenKM" name="TenKM" value="<?php echo $_TenKM?>"><br>
                        
                        <label for="MoTa">Mô tả: </label><br>
                        <input type="text" id="MoTa" name="MoTa" value="<?php echo $_MoTa?>"><br>
                        
                        <label for="TiLeGiam">Phần trăm sẽ giảm:</label><br>
                        <input type="number" id="TiLeGiam" name="TiLeGiam" min="1" max="100" value="<?php echo $_TiLeGiam?>"><br>
                        
                        <div class="button-block"><input type="submit" id="Edit" name="Edit" value="Sửa khuyến mãi"></div>
                    </form>
                <?php
                break;
            }
        }
    }

    if(isset($_POST['Add']))
    {
        $_MaKM = $_POST['MaKM'];        
        $_TenKM = $_POST['TenKM'];
        $_MoTa = $_POST['MoTa'];
        $_TiLeGiam = $_POST['TiLeGiam'];


        if($_MaKM == "" || $_TenKM == "" || $_MoTa == "" || $_TiLeGiam == ""){
            echo "<script>alert('Khong duoc de trong thong tin')</script>";
            return;
        }

        $pattern = '/^KM_/';
        if(preg_match($pattern, $_MaKM) == false){
            echo "<script>alert('Ma khuyen mai phai bat dau bang KM_')</script>";
            return;
        }

        if($db->hasKM($_MaKM) == false){
            echo "<script>alert('Ma khuyen mai da ton tai ')</script>";
            return;
        }
        if($db->insertKM($_MaKM,$_TenKM,$_MoTa,$_TiLeGiam) == true){
            echo "<script>alert('Them thanh cong');window.location='../../../index.php?id=km';</script>";
        }
    }

    if(isset($_POST['Edit'])){
        $_MaKM = $_POST['MaKM'];        
        $_TenKM = $_POST['TenKM'];
        $_MoTa = $_POST['MoTa'];
        $_TiLeGiam = $_POST['TiLeGiam'];


        if($_MaKM == "" || $_TenKM == "" || $_MoTa == "" || $_TiLeGiam == ""){
            echo "<script>alert('Khong duoc de trong thong tin')</script>";
            return;
        }

        if($db->updateKM($_MaKM,$_TenKM,$_MoTa,$_TiLeGiam) == true){
            echo "<script>alert('Sua thanh cong');window.location='../../../index.php?id=km';</script>";
        }
        else{
            echo "<script>alert('Sua that bai');</script>";
        }

    }
    
?>