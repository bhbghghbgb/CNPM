<?php require 'account/login_submit.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- JS dùng để làm AJAX -->
    <script src="./js/jquery-3.7.0.min.js">

    </script>
http://localhost:86/
    <link rel="stylesheet" href="./css/main.css">

    <!-- products -->
    <link rel="stylesheet" href="./css/products.css">
    <script src="./js/index.js"></script>
    <script src="./js/login.js"></script>
    <script src="./js/scroll-effects.js"></script>

    <!-- slider -->
    <link rel="stylesheet" href="./css/slider.css">
    <link rel="stylesheet" href="./css/modern-slider.css">
    <!-- <script src="./js/slider.js"></script> -->
    <!-- <script src="./js/modern-slider.js"></script> -->
    <script src="./js/slider-fix.js?v=1"></script> <!-- New fixed slider script -->
    <script src="./js/QuenMatKhau.js"></script>

    <!-- header -->
    <link rel="stylesheet" href="./css/top_menu.css">
    <link rel="stylesheet" href="./fonts/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./css/header.css">

    <!-- footer -->
    <link rel="stylesheet" href="./css/footer.css">

    <!-- post -->
    <link rel="stylesheet" href="./css/post.css">
    
    <!-- Modern design -->
    <link rel="stylesheet" href="./css/modern-categories.css">
    <link rel="stylesheet" href="./css/modern-products.css">
    <link rel="stylesheet" href="./css/modern-utilities.css">
    <script src="./js/modern-products.js"></script>

    <!-- login -->
    <link rel="stylesheet" href="./css/formDN.css">


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