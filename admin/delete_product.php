<?php

    if (!isset($_SESSION['admin_email'])){

        echo "<script>window.open('login.php','_self')</script>";

    } else {
    
?>

<?php

    if (isset($_GET['delete_product'])){

        $delete_id = $_GET['delete_product'];

        $get_product = "select * from products where product_id='$delete_id'";

        $run_product = mysqli_query($conn, $get_product);

        $row_product = mysqli_fetch_array($run_product);

            $product_image_1 = $row_product['product_image_1'];
            $product_image_2 = $row_product['product_image_2'];
            $product_image_3 = $row_product['product_image_3'];
        
        unlink($product_image_1);
        unlink($product_image_2);
        unlink($product_image_3);

        $delete_product = "DELETE products, products_quantity_size
        FROM products
        JOIN products_quantity_size ON products.product_id = products_quantity_size.product_id
        WHERE products.product_id = '$delete_id'";

        $run_delete = mysqli_query($conn, $delete_product);

        if($run_delete){

            echo "<script>alert('Xoá Thành Công')</script>";

            echo "<script>window.open('index.php?view_products','_self')</script>";

        }

    }

?>

<?php } ?>
