<?php session_start(); ?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/font-awesome_5.15.4_css_all.min.css">
    <link rel="stylesheet" href="./css/admin.css">
    <style>
        body {
            background-color: #f0f5f8;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 400px;
            max-width: 90%;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 150px;
            margin-bottom: 10px;
        }

        .btn-primary {
            background-color: #212529;
            border-color: #212529;
            width: 100%;
            padding: 10px;
        }

        .btn-primary:hover {
            background-color: #000;
            border-color: #000;
        }

        .message {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            text-align: center;
        }

        .message.error {
            background-color: #f8d7da;
            color: #721c24;
        }

        .message.success {
            background-color: #d4edda;
            color: #155724;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="logo">
            <img src="../img/img-logo/sneaker.jpg" alt="Logo">
            <h4>Đăng nhập Quản trị</h4>
        </div>

        <?php if (isset($_SESSION['admin_message'])): ?>
            <div class="message <?php echo $_SESSION['admin_message_type']; ?>">
                <?php
                echo $_SESSION['admin_message'];
                unset($_SESSION['admin_message']);
                unset($_SESSION['admin_message_type']);
                ?>
            </div>
        <?php endif; ?>

        <form method="post" action="login_submit.php">
            <div class="mb-3">
                <label for="username" class="form-label">Tên đăng nhập</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Mật khẩu</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="admin_login">Đăng nhập</button>
        </form>
        <div class="mt-3 text-center">
            <a href="../index.php">Quay lại trang chính</a>
        </div>
    </div>

    <script src="../js/jquery-3.7.0.min.js"></script>
</body>

</html>