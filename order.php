<?php

    session_set_cookie_params('86400');
	session_start();
    include("includes/db.php");
    include("functions/functions.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt hàng</title>
    <link rel="stylesheet" href="css/details.css">
</head>

<body>

    <?php

    if (!isset($_SESSION['customer_email'])) {

        echo "<script>window.open('customer/login.php','self')</script>";
        
    } else {

    
?>

    <?php

    if (isset($_GET['customer_id'])) {

        $customer_id = $_GET['customer_id'];

    }

    $ip_add = getRealIpUser();
 
    $status = "Pending";
    $invoice_no = 'DH' . mt_rand(10000, 999999);
    $get_cart = "SELECT * from cart where ip_add=' $customer_id'";
    $run_cart = mysqli_query($conn, $get_cart);
    while ($row_cart = mysqli_fetch_array($run_cart)) {
        $product_id = $row_cart['product_id'];

        $product_size = $row_cart['p_size'];
        $product_quantity = $row_cart['p_quantity'];
        $product_price = $row_cart['p_price'];
        $get_products = "SELECT * from products where product_id='$product_id'";
        $run_products = mysqli_query($conn, $get_products);
        while ($row_products = mysqli_fetch_array($run_products)) {
            $sub_total = $product_price*$product_quantity;
            $insert_customer_order = "INSERT into customer_orders (customer_id, due_amount, invoice_no, product_id, product_size, product_quantity, order_date, order_status)
                                                            values ('$customer_id','$sub_total', '$invoice_no', '$product_id', '$product_size', '$product_quantity', NOW(), '$status')";
            $run_customer_order = mysqli_query($conn, $insert_customer_order);
            $delete_cart = "DELETE from cart where ip_add='$customer_id'";
            $run_delete = mysqli_query($conn, $delete_cart);
            $update_total = "UPDATE products set product_total=product_total-$product_quantity where product_id='$product_id'";
            $run_update_total = mysqli_query($conn, $update_total);
            echo "
                <div class='popup'>
                <div class='popup__content'>
                    <div class='popup__image'>
                        <img src='assets/icon-location.svg' alt='>
                    </div>
                    <div class='popup__text'>
                        <h4 class='popup__title'>Đặt hàng thành công!</h4>
                        <p class='popup__desc'>Cảm ơn bạn đã đặt hàng</p>
                    </div>
                    <a href='customer/my_account.php?my_orders' class='popup__btn'>Xem đơn hàng</a>
                </div>
            </div>
            ";
        }
    }
?>

    <?php } ?>
</body>

</html>