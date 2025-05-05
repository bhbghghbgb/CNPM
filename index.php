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

    <!-- Base CSS -->
    <link rel="stylesheet" href="./css/main.css">
    <link rel="stylesheet" href="./fonts/themify-icons-font/themify-icons/themify-icons.css">
    
    <!-- Core Components CSS -->
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="./css/top_menu.css">
    <link rel="stylesheet" href="./css/slider.css">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/products.css">
    <link rel="stylesheet" href="./css/post.css">
    <link rel="stylesheet" href="./css/formDN.css">
    
    <!-- Modern Design - Hợp nhất từ nhiều file CSS -->
    <link rel="stylesheet" href="./css/modern.css">
    
    <!-- Effects & Animations - Hợp nhất từ nhiều file CSS -->
    <link rel="stylesheet" href="./css/effects.css">
    
    <!-- JS Core -->
    <script src="./js/login.js"></script>
    <script src="./js/index.js"></script>
    <script src="./js/QuenMatKhau.js"></script>
    
    <!-- Consolidated JS Effects File -->
    <script src="./js/effects.js?v=1"></script> <!-- Thêm version để tránh cache -->
    <script src="./js/modern-products.js"></script>
</head>

<body>
    <div id="wrapper">


        <div id="message">
            <div id="content_mess">

            </div>
        </div>

        <?php include('account/login.php'); ?>

        <?php include('account/quenmatkhau.php'); ?>

        <?php include('account/register.php'); ?>

        <?php include('template/header.php'); ?>

        <?php include('template/top_menu.php'); ?>

        <div id="main">
            <?php include('template/slider.php'); ?>

            <?php include('template/products.php'); ?>

            <?php
            // include('template/post.php');
            ?>
        </div>

        <div id="footer">
            <?php include('template/footer.php'); ?>
        </div>
    </div>



</body>

</html>