<?php

    session_start();
    include("../includes/db.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!--css files-->
    <link rel="stylesheet" href="../css/login.css">

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
    <!--Content-->
    <div class="wrapper">
        <div class="content">
            <div class="subtitle">Admin</div>
            <form action="login.php" method="post">
                <div class="inputWrapper">
                    <label for="email">Email</label>
                    <input id="email" name="admin_email" type="text" placeholder="Nhập email của bạn">
                </div>
                <div class="inputWrapper">
                    <label for="password">Mật khẩu</label>
                    <input id="password" name="admin_pass" type="password" placeholder="Mật khẩu">
                </div>

                <button class="btn" name="admin_login">Đăng Nhập</button>
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

    if (isset($_POST['admin_login'])) {

        $admin_email = mysqli_real_escape_string($conn, $_POST['admin_email']);

        $admin_pass = mysqli_real_escape_string($conn, $_POST['admin_pass']);

        $get_admin = "select * from admins where admin_email='$admin_email' AND admin_password='$admin_pass'";

        $run_admin = mysqli_query($conn, $get_admin);

        $count = mysqli_num_rows($run_admin);

        if ($count==1) {

            $_SESSION['admin_email']=$admin_email;

            echo "<script>window.open('index.php?dashboard','_self')</script>";

        } else {

            echo "<script>alert('Email hoặc Mật Khẩu Chưa Đúng')</script>";

        }

    }

?>