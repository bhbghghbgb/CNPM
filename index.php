
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

<!-- products -->
    <link rel="stylesheet" href="./css/products.css">
    <script src="./js/index.js"></script>
    <script src="./js/login.js"></script>

    <!-- slider -->
    <link rel="stylesheet" href="./css/slider.css">
    <script src="./js/slider.js"></script>

    <!-- header -->
    <link rel="stylesheet" href="./css/top_menu.css">
    <link rel="stylesheet" href="./fonts/themify-icons-font/themify-icons/themify-icons.css">
    <link rel="stylesheet" href="./css/header.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- footer -->
    <link rel="stylesheet" href="./css/footer.css">

    <!-- post -->
    <link rel="stylesheet" href="./css/post.css">

    <!-- login -->
    <link rel="stylesheet" href="./css/formDN.css">


</head>
<body>
    <div id="wrapper">
        <?php include('account/login.php');?>
        <?php include('account/register.php');?>
        <?php include('template/header.php');?>
        <?php include('template/top_menu.php');?>
        <div id="main">
            <?php include('template/slider.php');?>
            <?php include('template/products.php');?>
            <?php include('template/post.php');?>
            
        </div>
        <div id="footer">
            <?php include('template/footer.php');?>
        </div>
    </div>
    
</body>
</html>