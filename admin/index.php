<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="./css/font-awesome_5.15.4_css_all.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">


    <script src="../js/jquery-3.7.0.min.js"></script>
    <script src="../js/index.js"></script>
    <script src="./js/admin.js"></script>
    <script src="./js/DanhMuc.js"></script>

    <link rel="stylesheet" href="./css/DonHang.css">

    <link rel="stylesheet" href="./css/admin.css">

    <!-- Css cua khuyen mai -->
    <link rel="stylesheet" href="./css/KhuyenMai.css">

    <!-- Css cua phan quyen -->
    <link rel="stylesheet" href="./css/PhanQuyen.css">
    <link rel="stylesheet" href="./css/admin.css">

    <link rel="stylesheet" href="./css/DanhMuc.css">
    <!-- Icon -->
    <link rel="stylesheet" href="../fonts/themify-icons-font/themify-icons/themify-icons.css">

    <title>Admin</title>
</head>

<body>
    <div id="message">
            <div id="hihi">
            </div>
        </div>
    <div class="wrapper">
        <?php include('template/topbar_ad.php');?>
        <div class="container-fluid">
                <?php include('template/menu_ad.php');?>
                <?php include('template/main_ad.php');?>
                
            </div>
        </div>
    </div>

    <?php 
    if (isset($_SESSION['message'])) {
        if(isset($cache)&& $cache!=$_SESSION['message']);
        $cache=$_SESSION['message'];
        echo '<script language="javascript"> addmess("' . $_SESSION['message'] . '", "#434343", "white", 2000);</script>';
        unset($_SESSION['message']); // Xóa thông báo sau khi hiển thị
    } 
?>
    </div>
    <script>
        showmenu();
        choosemenu();
    </script>
</body>

</html>