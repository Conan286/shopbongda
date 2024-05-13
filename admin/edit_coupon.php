<?php

    if (!isset($_SESSION['admin_email'])) {

        echo "<script>window.open('login.php','_self')</script>";

    } else {
    
?>

<?php

    if (isset($_GET['edit_coupon'])) {

        $edit_coupon_id = $_GET['edit_coupon'];

        $get_coupons = "select * from coupons where coupon_id='$edit_coupon_id'";

        $run_coupons = mysqli_query($conn, $get_coupons);
    
        $row_coupons = mysqli_fetch_array($run_coupons);
    
            $coupon_id = $row_coupons['coupon_id'];
    
            $coupon_product_id = $row_coupons['product_id'];
    
            $coupon_title = $row_coupons['coupon_title'];
    
            $coupon_price = $row_coupons['coupon_price'];
    
            $coupon_code = $row_coupons['coupon_code'];
    
            $coupon_limit = $row_coupons['coupon_limit'];
    
            $coupon_used = $row_coupons['coupon_used'];

            $get_product = "select * from products where product_id='$coupon_product_id'";

            $run_product = mysqli_query($conn, $get_product);

            $row_product = mysqli_fetch_array($run_product);

                $product_id = $row_product['product_id'];

                $product_title = $row_product['product_title'];


    }


?>

<div class="right__title">Bảng điều khiển</div>
<p class="right__desc">Chỉnh sửa mã giảm giá</p>
<div class="right__formWrapper">
    <form action="" method="post">
        <div class="right__inputWrapper">
            <label for="title">Tiêu đề</label>
            <input name="coupon_title" type="text" placeholder="Tiêu đề" value="<?php echo $coupon_title; ?>" required>
        </div>
        <div class="right__inputWrapper">
            <label for="price">Giá SP</label>
            <input name="coupon_price" type="text" placeholder="Giá SP" value="<?php echo $coupon_price; ?>" required>
        </div>
        <div class="right__inputWrapper">
            <label for="limit">Giới hạn</label>
            <input name="coupon_limit" type="number" placeholder="Giới hạn" value="<?php echo $coupon_limit; ?>" required>
        </div>
        <div class="right__inputWrapper">
            <label for="product">Chọn sản phẩm</label>
            <select name="product_id" required>
            <option value="<?php echo $product_id; ?>"><?php echo $product_title; ?></option>

                <?php

                    $get_products = "select * from products";

                    $run_products = mysqli_query($conn, $get_products);

                    while ($row_products = mysqli_fetch_array($run_products)) {

                        $product_id = $row_products['product_id'];

                        $product_title = $row_products['product_title'];

                        echo "<option value='$product_id'>$product_title</option>";
                    }
                
                ?>
            </select>
        </div>
        <div class="right__inputWrapper">
            <label for="code">Mã giảm giá</label>
            <input name="coupon_code" type="text" placeholder="Mã giảm giá" value="<?php echo $coupon_code; ?>" required>
        </div>
        <button name="update" class="btn" type="submit">Cập nhật</button>
    </form>
</div>
<?php

    if (isset($_POST['update'])) {

        $coupon_title = $_POST['coupon_title'];

        $coupon_price = preg_replace("/[^0-9]/", "", $_POST['coupon_price']);

        $coupon_product_id = $_POST['product_id'];

        $coupon_code = $_POST['coupon_code'];

        $coupon_limit = $_POST['coupon_limit'];

        $get_coupons = "select * from coupons where coupon_code='$coupon_code'";

        $run_coupons = mysqli_query($conn, $get_coupons);

        $check_coupons = mysqli_num_rows($run_coupons);

        if ($check_coupons == 1) {

            echo "<script>alert('Mã giảm giá được sử dụng, vui lòng chọn mã giảm giá khác')</script>";

        } else {

            $update_coupon = "update coupons set product_id='$coupon_product_id', coupon_title='$coupon_title', coupon_price='$coupon_price', coupon_code='$coupon_code', coupon_limit='$coupon_limit', coupon_used='$coupon_used'";

            
            $run_coupon = mysqli_query($conn, $update_coupon);

            if ($run_coupon) {

                echo "<script>alert('Cập Nhật Thành Công')</script>";

                echo "<script>window.open('index.php?view_coupons')</script>";

            }

        }

    }

?>

<?php } ?>