<?php

session_set_cookie_params('86400');
session_start();
include("../includes/db.php");
include("../functions/functions.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <!--css files-->
    <link rel="stylesheet" href="../css/login.css">
    <link rel="shortcut icon" href="../assets/favicon.ico">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-137426789-2"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-137426789-2');
    </script>

</head>

<body>
    <!--Navigation-->
    <?php
    include 'nav.php';
    ?>
    <!--end Navigation-->

    <!--Content-->
    <div class="wrapper">
        <div class="content">
            <div class="subtitle">Đăng nhập</div>
            <form action="login.php" method="post">
                <div class="inputWrapper">
                    <label for="email">E-mail</label>
                    <input id="email" type="text" placeholder="Nhập email của bạn" name="customer_email" required>
                </div>
                <div class="inputWrapper">
                    <label for="password">Mật Khẩu</label>
                    <input id="password" type="password" placeholder="Mật khẩu" name="customer_password" required>
                </div>

                <div class="account">
                    <p>Chưa có tài khoản? <a class="link" href="../register.php">Đăng ký tại đây</a></p>
                </div>
                <button class="btn" name="login">Đăng Nhập</button>
            </form>
        </div>
    </div>

    <!--Script Files-->

    <!--General-->
    <script src="../js/main.js"></script>
    <!--end Script Files-->
</body>

</html>

<?php

if (isset($_POST['login'])) {

    $customer_email = $_POST['customer_email'];

    $customer_password = $_POST['customer_password'];

    $get_customer = "SELECT * from customers where customer_email='$customer_email'";

    $run_customer = mysqli_query($conn, $get_customer);

    $count_customer = mysqli_num_rows($run_customer);

    $row_customer = mysqli_fetch_array($run_customer);

    $customer_password_hash = $row_customer['customer_password'];

    $get_ip = getRealIpUser();

    $get_cart = "SELECT * from cart where ip_add='$get_ip'";

    $run_cart = mysqli_query($conn, $get_cart);

    $count_cart = mysqli_num_rows($run_cart);

    if ($count_customer == 0) {

        echo "<script>alert('Email Không Chính Xác, Vui Lòng Nhập Lại.')</script>";

        exit();
    }

    if (!password_verify($_POST['customer_password'], $customer_password_hash)) {

        echo "<script>alert('Mật Khẩu Không Chính Xác, Vui Lòng Nhập Lại.')</script>";

        exit();
    }

    if ($count_customer == 1 and $count_cart == 0) {

        $_SESSION['customer_email'] = $customer_email;

        echo "<script>alert('Đăng Nhập Thành Công')</script>";

        echo "<script>window.open('../index.php','_self')</script>";
    } else {

        $_SESSION['customer_email'] = $customer_email;

        $get_customer = "select * from customers where customer_email='$customer_email'";

        $run_customer = mysqli_query($conn, $get_customer);

        $row_customer = mysqli_fetch_array($run_customer);
        $_SESSION['customer_id']     = $row_customer['customer_id'];
        echo "<script>alert('Đăng Nhập Thành Công.')</script>"; 

        echo "<script>window.open('../index.php','_self')</script>";
    }
}

?>