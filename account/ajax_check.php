<?php

include('../db/DAOThongTinTaiKhoan.php');
$daotttk = new DAOThongTinTaiKhoan();
session_start();
function generateResetToken()
{
    return rand(100000, 999999); // Sử dụng random_bytes để tạo một chuỗi ngẫu nhiên
}

// Hàm để gửi email với liên kết đặt lại mật khẩu
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
// require 'vendor/autoload.php'; // Thay đổi đường dẫn đến tệp autoload.php tùy thuộc vào cài đặt của bạn

function sendResetEmail($email, $token)
{
    // Khởi tạo đối tượng PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Cấu hình thông tin email
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'quanglinh1023m@gmail.com';
        $mail->Password = 'viwu jhun fzdr iapy';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->CharSet = 'UTF-8';

        // Thiết lập thông tin người gửi và người nhận
        $mail->setFrom('quanglinh1023m@gmail.com', 'Đặt lại mật khẩu website bán giày'); // Điền thông tin người gửi
        $mail->addAddress($email); // Điền địa chỉ email người nhận

        // Thiết lập tiêu đề và nội dung email
        $mail->Subject = 'Đặt lại mật khẩu';
        $mail->isHTML(true);
        $mail->Body = "Mã đặt lại mật khẩu của bạn là :<div style='width: 44px; padding:5px; background-color:#ccc;'>$token</div>";

        // Gửi email
        $mail->send();

        // echo 'Email đã được gửi thành công!';
    } catch (Exception $e) {
        echo "Gửi email không thành công. Lỗi: {$mail->ErrorInfo}";
    }
}


// Xử lý yêu cầu đặt lại mật khẩu
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"]) && !isset($_POST["token"])) {
    $email = $_POST["email"]; // Địa chỉ email từ biểu mẫu
    if ($daotttk->hasEmail($email) == false) {
        $token = generateResetToken();
        sendResetEmail($email, $token);
        if (isset($token))
            echo md5($token);
    } else echo '';
}

//Xử lý khi gửi mã
if (isset($_POST["token"]) && isset($_POST["token1"]) && isset($_POST["email"])) {
    if (md5($_POST["token"]) == $_POST["token1"]) {
        echo 'Nhập mật khẩu mới của bạn :<form action="account/ajax_check.php" method="POST" >
        <input type="tel" name="mat_khau"></br></br>
        <input type="tel" name="mat_khau1">
        <input type="hidden" name="email1" value=' . $_POST["email"] . '></br></br>
        <input class="buttonDN" type="submit" value="Lưu lại mật khẩu">
        </form>';
    } else {
        echo '';
    }
}

//Xử lý khi thêm mat khau moi
if (isset($_POST['mat_khau']) && isset($_POST['mat_khau1']) && isset($_POST['email1'])) {

    if (trim($_POST['mat_khau']) == trim($_POST['mat_khau1'])) {
        if (!preg_match('/^\S{5,}$/', trim($_POST['mat_khau']))) {
            $_SESSION["message"] = "Mật khẩu phải lớn hơn hoặc bằng 5 ký tự và không chứa khoảng trắng !";
        } else 
        if ($daotttk->updatePassTaiKhoan($_POST['mat_khau'], $_POST['email1'])) {
            $_SESSION["message"] = "Đặt lại mật khẩu thành công";
        } else {
            $_SESSION["message"] = "Đổi mật khẩu không thành công" . $_POST['mat_khau'] . $_POST['email1'] . "";
        }
    } else if ($_POST['mat_khau'] != $_POST['mat_khau1']) {
        $_SESSION["message"] = "Mật khẩu không khớp !";
    }
    header("Location: ../index.php");
    exit;
}
