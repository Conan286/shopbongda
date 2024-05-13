<?php
session_set_cookie_params('86400');
session_start();
include("../includes/db.php");
include("../functions/functions.php");

if (isset($_GET['delete'])) {
    delete();
}

function delete() {
    global $conn;
    $delete_id = $_GET['delete'];

    // Truy vấn để lấy thông tin sản phẩm từ đơn hàng
    $select_order = "SELECT * FROM customer_orders WHERE order_id = ?";
    $stmt_order = mysqli_prepare($conn, $select_order);
    mysqli_stmt_bind_param($stmt_order, "i", $delete_id);
    mysqli_stmt_execute($stmt_order);
    $result_order = mysqli_stmt_get_result($stmt_order);
    $row_order = mysqli_fetch_assoc($result_order);

    $product_id = $row_order['product_id'];
    $product_quantity = $row_order['product_quantity'];
    $product_size = $row_order['product_size'];

    // Cập nhật số lượng trong bảng products
    $column_pro = "";
    switch ($product_size) {
        case '1':
            $column_pro = "product_quantity_size_s";
            break;
        case '2':
            $column_pro = "product_quantity_size_m";
            break;
        case '3':
            $column_pro = "product_quantity_size_l";
            break;
        default:
            break;
    }

    // Cập nhật số lượng trong bảng products
    if ($column_pro !== "") {
        $update_products = "UPDATE products SET $column_pro = $column_pro + ? WHERE product_id = ?";
        $stmt_products = mysqli_prepare($conn, $update_products);
        mysqli_stmt_bind_param($stmt_products, "ii", $product_quantity, $product_id);
        $update_success_products = mysqli_stmt_execute($stmt_products);
    }

    // Cập nhật số lượng theo kích thước trong bảng products_quantity_size
    $column = "";
    switch ($product_size) {
        case '1':
            $column = "product_quantity_s";
            break;
        case '2':
            $column = "product_quantity_m";
            break;
        case '3':
            $column = "product_quantity_l";
            break;
        default:
            break;
    }

    // Cập nhật số lượng theo kích thước trong bảng products_quantity_size
    if ($column !== "") {
        $update_quantity_size = "UPDATE products_quantity_size SET $column = $column + ? WHERE product_id = ?";
        $stmt_quantity_size = mysqli_prepare($conn, $update_quantity_size);
        mysqli_stmt_bind_param($stmt_quantity_size, "ii", $product_quantity, $product_id);
        $update_success_quantity_size = mysqli_stmt_execute($stmt_quantity_size);
    }

    // Xóa đơn hàng từ bảng customer_orders
    $delete_order = "DELETE FROM customer_orders WHERE order_id = ?";
    $stmt_delete_order = mysqli_prepare($conn, $delete_order);
    mysqli_stmt_bind_param($stmt_delete_order, "i", $delete_id);
    $delete_success_order = mysqli_stmt_execute($stmt_delete_order);

    // Kiểm tra và thông báo kết quả
    if (isset($update_success_products, $update_success_quantity_size, $delete_success_order) && $update_success_products && $update_success_quantity_size && $delete_success_order) {
        echo "<script>alert('Đã xóa sản phẩm khỏi đơn hàng');</script>";
        echo "<script>window.open('my_account.php?my_orders','_self')</script>";
    } else {
        echo "Xóa không thành công";
    }
}
?>


<?php
    if (!isset($_SESSION['customer_email'])) {
        echo "<script>window.open('login.php','self')</script>";
    } else {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tài khoản</title>
    <!--css files-->
    <link rel="stylesheet" href="../css/my_account.css">
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
            <section class="left">
                <div class="left__content">
                    <?php

                        $session_email = $_SESSION['customer_email'];

                        $get_customer = "SELECT * from customers where customer_email='$session_email'";

                        $run_customer = mysqli_query($conn, $get_customer);

                        $row_customer = mysqli_fetch_array($run_customer);

                        $customer_id = $row_customer['customer_id'];

                        $customer_name = $row_customer['customer_name'];

                        $customer_email = $row_customer['customer_email'];

                        $customer_phone = $row_customer['customer_phone'];

                        $customer_address = $row_customer['customer_address'];

                        $customer_image_origin = $row_customer['customer_image'];

                        if ($customer_image_origin=='') {
                            
                            echo "

                                <div class='left__avatar'>
                                    <img src='customer_images/customer_default_2.png' alt=''>
                                </div>

                            ";

                        } else {

                            echo "

                            <div class='left__avatar'>
                                <img src='customer_images/$customer_image_origin' alt=''>
                            </div>

                        ";
                        
                        }
                
                    ?>
                    <div class="left__name"><?php echo $customer_name; ?></div>
                    <div class="left__links">
                        <a class="left__link" href="my_account.php?my_orders">
                            <img src="../assets/icon-list.svg" alt="">Đơn Hàng Của Tôi
                        </a>
                        <!-- <a class="left__link" href="my_account.php?pay_offline">
                            <img src="../assets/icon-bolt.svg" alt="">Thanh Toán Ngoại Tuyến
                        </a> -->
                        <a class="left__link" href="my_account.php?edit_account">
                            <img src="../assets/icon-pencil.svg" alt="">Chỉnh Sửa Tài Khoản
                        </a>
                        <a class="left__link" href="my_account.php?change_password">
                            <img src="../assets/icon-user.svg" alt="">Đổi Mật Khẩu
                        </a>
                        <a class="left__link" href="my_account.php?delete_account">
                            <img src="../assets/icon-trash.svg" alt="">Xoá Tài Khoản
                        </a>
                        <a class="left__link" href="logout.php">
                            <img src="../assets/icon-logout.svg" alt="">Đăng Xuất
                        </a>
                    </div>
                </div>
            </section>

            <section class="right">
                <section class="right__content">

                    <?php

                        if (isset($_GET['my_orders'])) {

                            include("my_orders.php");
                            
                        }
                    
                    ?>

                    <?php

                        if (isset($_GET['pay_offline'])) {

                            include("pay_offline.php");
                            
                        }
                
                    ?>

                    <?php

                        if (isset($_GET['edit_account'])) {

                            include("edit_account.php");
                            
                        }
                
                    ?>

                    <?php

                        if (isset($_GET['change_password'])) {

                            include("change_password.php");
                            
                        }
                
                    ?>

                    <?php

                        if (isset($_GET['delete_account'])) {

                            include("delete_account.php");
                            
                        }
                
                    ?>

                </section>
            </section>

            <!--Footer-->
            <footer class="footer">
                <p class="footer__text">A project made by <a href="https://github.com/Conan286" target="_blank" rel="noopener"
                        class="link">Huy</a></p>
                <div class="footer__icons">

                    <a href="#" target="_blank" rel="noopener" class="footer__icon linkedin"><span></span>
                        <p>Linkedin</p>
                    </a>

                    <a href="#" target="_blank" rel="noopener" class="footer__icon dribbble"><span></span>
                        <p>Dribbble</p>
                    </a>

                    <a href="#" target="_blank" rel="noopener" class="footer__icon codepen"><span></span>
                        <p>Codepen</p>
                    </a>
                </div>
            </footer>
            <!--end Footer-->
        </div>

        <!--Script Files-->

        <!--General-->
        <script src="../js/main.js"></script>
        <!--end Script Files-->
</body>

</html>
<?php } ?>