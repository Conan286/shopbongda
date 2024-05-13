<?php
    include("includes/db.php");
    include("functions/functions.php");

    if (isset($_POST['register'])) {

        $customer_ip = getRealIpUser();

        $customer_name = $_POST['customer_name'];

        $customer_email = $_POST['customer_email'];

        $customer_phone = $_POST['customer_phone'];

        $customer_address = $_POST['customer_address'];

        $customer_password = password_hash($_POST['customer_password'],PASSWORD_DEFAULT);

        $customer_repassword = $_POST['customer_repassword'];

        $customer_image = $_FILES['customer_image']['name'];

        $customer_image_tmp = $_FILES['customer_image']['tmp_name'];

        move_uploaded_file($customer_image_tmp,"customer/customer_images/$customer_image");

        if (!password_verify($_POST['customer_repassword'],$customer_password)) {

            echo "<script>alert('Mật Khẩu Nhập Lại Chưa Đúng')</script>";

            exit();

        }
    
        $get_customer = "SELECT * FROM customers WHERE customer_email='$customer_email'";

        $run_customer = mysqli_query($conn, $get_customer);

        $count_customer = mysqli_num_rows($run_customer);

        if ($count_customer==1) {

            echo "<script>alert('Email đã có người dùng')</script>";

            exit();

        } 
        
        $insert_customer = "INSERT INTO customers (customer_name, customer_email, customer_phone, customer_address, customer_password, customer_image, customer_ip) values ('$customer_name', '$customer_email', '$customer_phone', '$customer_address', '$customer_password', '$customer_image', '$customer_ip')";

        $run_customer = mysqli_query($conn, $insert_customer);

        $get_cart = "SELECT * FROM cart WHERE ip_add='$customer_ip'";

        $run_cart = mysqli_query($conn, $get_cart);

        $count_cart = mysqli_num_rows($run_cart);

        if ($count_cart>0) {

            $_SESSION['customer_email']=$customer_email;

            $get_customer = "SELECT * FROM customers WHERE customer_email='$customer_email'";

            $run_customer = mysqli_query($conn, $get_customer);

            $row_customer = mysqli_fetch_array($run_customer);

                $customer_id = $row_customer['customer_id'];

            echo "<script>alert('Đăng Ký Thành Công')</script>";

            echo "<script>window.open('order.php?customer_id=$customer_id','_self')</script>";

        } else {

            $_SESSION['customer_email']=$customer_email;

            // echo "<script>alert('Đăng Ký Thành Công')</script>";

            successful_registration($customer_email);
           
        }
        
        
    }

function successful_registration($customer_email)
{
    require "mailer/PHPMailer/src/PHPMailer.php";
    require "mailer/PHPMailer/src/SMTP.php";
    require "mailer/PHPMailer/src/Exception.php";

    $mail = new PHPMailer\PHPMailer\PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->CharSet = "utf-8";
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth   = true;
        $mail->Username   = '9552f8d8080ed2';
        $mail->Password   = '2b72f67ce9a7d7';
        $mail->SMTPSecure = 'tls';  
        $mail->Port       = 587; 

        //Recipients
        $mail->setFrom('adlallatest@gmail.com', 'Admin Lalla');
        $mail->addAddress($customer_email, 'User');
        $mail->isHTML(true);

        $mail->isHTML(true);
        $mail->Subject = 'Đăng ký thành công';
        $mail->Body    = '<p>Hello bạn,<br><br>Chúc bạn có một ngày mới tốt lành!</p>';
        $mail->AltBody = "Hello bạn,\n\nChúc bạn có một ngày mới tốt lành!\n\n";
        $mail->Body .= '<p>Bạn đã đăng ký thành công tài khoản, Đăng nhập bằng link sau<a href="http://localhost/shopthoitrang/customer/login.php">Link đăng nhập</a></p>'; // Thay đổi link này thành trang của bạn

        $mail->smtpConnect(array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
                "allow_self_signed" => true

            )
        ));
        $mail->send();
        echo "<script>window.open('index.php','_self')</script>";
    } catch (Exception $e) {
        echo "Lỗi!, không gởi đươc thông tin: {$mail->ErrorInfo}";
    }
}

?>
