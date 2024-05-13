<?php

    session_set_cookie_params('86400');
    session_start();
    include("includes/db.php");
    include("functions/functions.php");

?>

<?php 

    $ip_add = getRealIpUser();

    if(isset($_POST['id'])) {

        $id = $_POST['id'];

        $quantity = $_POST['quantity'];

        $get_product = "select * from products where product_id='$id'";

            $run_product = mysqli_query($conn, $get_product);

            $row_product = mysqli_fetch_array($run_product);

                $product_total = $row_product['product_total'];

            if ($product_total < $quantity) {
                exit();
            }
        
        $update_quantity = "update cart set p_quantity='$quantity' where product_id='$id' AND ip_add='$ip_add'";

        $run_quantity = mysqli_query($conn, $update_quantity);

    }

?>