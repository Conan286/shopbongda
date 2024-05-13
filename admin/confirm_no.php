<?php 
    
    if (!isset($_SESSION['admin_email'])) {
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>

<?php

    if (isset($_GET['confirm_no'])) {
        $confirm_product_id = $_GET['confirm_no'];
        $order_status = "Pending";
        $update_customer_order = "update customer_orders set order_status='$order_status' where order_id='$confirm_product_id'";
        $row_update_customer_order = mysqli_query($conn, $update_customer_order);

        if ($row_update_customer_order) {
            echo "<script>alert('Bạn đã huỷ xác nhận sản phẩm này đã thanh toán')</script>";
            echo "<script>window.open('index.php?view_orders','_self')</script>";
        }
        
    }
?>

<?php } ?>