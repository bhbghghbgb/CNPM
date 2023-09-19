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

    <script src="../js/jquery-3.7.0.min.js"></script>
    
    <script src="./js/admin.js"></script>
    <script src="./js/DanhMuc.js"></script>

    <link rel="stylesheet" href="./css/DonHang.css">

    <link rel="stylesheet" href="./css/admin.css">

    <!-- Css cua khuyen mai -->
    <link rel="stylesheet" href="./css/KhuyenMai.css">

    <!-- Css cua phan quyen -->
    <link rel="stylesheet" href="./css/PhanQuyen.css">


    <link rel="stylesheet" href="./css/DanhMuc.css">
    <!-- Icon -->
    <link rel="stylesheet" href="../fonts/themify-icons-font/themify-icons/themify-icons.css">

    <title>Admin</title>
</head>

<body>
    <div class="wrapper" style=" background-color: #6c757d;height:100%;min-height:100vh">
        <?php include('template/topbar_ad.php');?>
        <div class="container">
            <div class="row " style="min-height:900px;padding-bottom:50px;position: relative;">
                <div class="col-2 d-none d-lg-block d-md-block"></div>
                <?php include('template/menu_ad.php');?>
                <?php include('template/main_ad.php');?>
                
            </div>
        </div>
    </div>

    </div>
    <script>
        showmenu();
        choosemenu();
    </script>
</body>

</html>