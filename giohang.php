<?php require 'account/login_submit.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- JS dùng để làm AJAX -->
    <script src="./js/jquery-3.7.0.min.js"></script>

    <link rel="stylesheet" href="./css/main.css">

    <link rel="stylesheet" href="./css/GioHang.css">

    <script src="./js/login.js"></script>
    <script src="./js/quantity-handler.js"></script>
    <!-- header -->
    <link rel="stylesheet" href="./css/top_menu.css">
    <link rel="stylesheet" href="./fonts/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./css/header.css">

    <!-- footer -->
    <link rel="stylesheet" href="./css/footer.css">

    <!-- login -->
    <link rel="stylesheet" href="./css/formDN.css">


</head>

<body>
    <div id="wrapper">
        <?php include('account/login.php'); ?>
        <?php include('account/quenmatkhau.php'); ?>
        <?php include('template/header.php'); ?>
        <?php include('template/top_menu.php'); ?>
        <?php include('account/register.php'); ?>

        <div id="main">
            <?php include('template/GioHang.php'); ?>
            <?php include('template/Ajax-GioHang/DonHangDaDat.php'); ?>
        </div>

        <div id="footer">
            <?php include('template/footer.php'); ?>
        </div>
    </div>
</body>

</html>