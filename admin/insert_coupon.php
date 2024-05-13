<?php

    if (!isset($_SESSION['admin_email'])) {

        echo "<script>window.open('login.php','_self')</script>";

    } else {
    
?>

<div class="right__title">Bảng điều khiển</div>
<p class="right__desc">Chèn mã giảm giá</p>
<div class="right__formWrapper">
    <form action="" method="post">
        <div class="right__inputWrapper">
            <label for="title">Tiêu đề</label>
            <input name="coupon_title" type="text" placeholder="Tiêu đề" required>
        </div>
        <div class="right__inputWrapper">
            <label for="price">Giá SP</label>
            <input name="coupon_price" type="text" placeholder="Giá SP" required>
        </div>
        <div class="right__inputWrapper">
            <label for="limit">Giới hạn</label>
            <input name="coupon_limit" type="number" placeholder="Giới hạn" required>
        </div>
        <div class="right__inputWrapper">
            <label for="product">Chọn sản phẩm</label>
            <select name="product_id" required>
                <option disabled selected>Chọn sản phẩm</option>

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
            <input name="coupon_code" type="text" placeholder="Mã giảm giá" required>
        </div>
        <button name="submit" class="btn" type="submit">Chèn</button>
    </form>
</div>

<?php

    if (isset($_POST['submit'])) {

        $coupon_title = $_POST['coupon_title'];

        $coupon_price = preg_replace("/[^0-9]/", "", $_POST['coupon_price']);

        $coupon_product_id = $_POST['product_id'];

        $coupon_code = $_POST['coupon_code'];

        $coupon_limit = $_POST['coupon_limit'];

        $coupon_used = 0;

        $get_coupons = "select * from coupons where product_id='$coupon_product_id' or coupon_code='$coupon_code'";

        $run_coupons = mysqli_query($conn, $get_coupons);

        $check_coupons = mysqli_num_rows($run_coupons);

        if ($check_coupons == 1) {

            echo "<script>alert('Mã giảm giá hoặc sản phẩm đã được ấp dụng, vui lòng chọn mã giảm giá hoặc sản phẩm khác')</script>";

        } else {

            $insert_coupon = "insert into coupons (product_id, coupon_title, coupon_price, coupon_code, coupon_limit, coupon_used)
                                value ('$coupon_product_id', '$coupon_title', '$coupon_price', '$coupon_code', '$coupon_limit', '$coupon_used')";

            
            $run_coupon = mysqli_query($conn, $insert_coupon);

            if ($run_coupon) {

                echo "<script>alert('Đã Thêm Thành Công')</script>";

                echo "<script>window.open('index.php?view_coupons')</script>";

            }

        }

    }

?>

<?php } ?>