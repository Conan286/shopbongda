<?php

    if (!isset($_SESSION['admin_email'])) {

        echo "<script>window.open('login.php','_self')</script>";

    } else {
    
?>
<?php

if(isset($_POST['submit_quantity'])){
    $product_id = $_POST['product_id'];
    $product_quantity_s = $_POST['product_quantity_s'];
    $product_quantity_m = $_POST['product_quantity_m'];
    $product_quantity_l = $_POST['product_quantity_l'];

    $check_product = "SELECT * FROM products_quantity_size WHERE product_id = '$product_id'";
    $result_check = mysqli_query($conn, $check_product);

    if(mysqli_num_rows($result_check) > 0) {
        $update_quantity_size_product = "UPDATE products_quantity_size SET product_quantity_s = product_quantity_s + '$product_quantity_s', product_quantity_m = product_quantity_m + '$product_quantity_m', product_quantity_l = product_quantity_l + '$product_quantity_l' WHERE product_id = '$product_id'";
        $run_update_quantity_size_product = mysqli_query($conn, $update_quantity_size_product);

        if($run_update_quantity_size_product) {
            $update_product = "UPDATE products SET product_quantity_size_s = product_quantity_size_s + '$product_quantity_s', product_quantity_size_m = product_quantity_size_m + '$product_quantity_m', product_quantity_size_l = product_quantity_size_l + '$product_quantity_l' WHERE product_id = '$product_id'";
            $run_update_product = mysqli_query($conn, $update_product);

            if($run_update_product) {
                echo "<script>alert('Số Lượng Sản Phẩm Đã Được Cập Nhật')</script>";
                echo "<script>window.open('index.php?view_quantity_size_products', '_self')</script>";
            } else {
                echo "<script>alert('Có lỗi xảy ra khi cập nhật số lượng sản phẩm')</script>";
            }
        } else {
            echo "<script>alert('Có lỗi xảy ra khi cập nhật số lượng sản phẩm')</script>";
        }
    } else {
        $insert_quantity_size_product = "INSERT INTO products_quantity_size (product_id, product_quantity_s, product_quantity_m, product_quantity_l) VALUES ('$product_id', '$product_quantity_s', '$product_quantity_m', '$product_quantity_l')";
        $run_insert_quantity_size_product = mysqli_query($conn, $insert_quantity_size_product);

        if($run_insert_quantity_size_product) {
            $update_product_n = "UPDATE products SET product_quantity_size_s = product_quantity_size_s + '$product_quantity_s', product_quantity_size_m = product_quantity_size_m + '$product_quantity_m', product_quantity_size_l = product_quantity_size_l + '$product_quantity_l' WHERE product_id = '$product_id'";
            $run_update_product_n = mysqli_query($conn, $update_product_n);

            if($run_update_product_n) {
                echo "<script>alert('Số Lượng Sản Phẩm Đã Được Cập Nhật')</script>";
                echo "<script>window.open('index.php?view_quantity_size_products', '_self')</script>";
            } else {
                echo "<script>alert('Có lỗi xảy ra khi cập nhật số lượng sản phẩm')</script>";
            }
        } else {
            echo "<script>alert('Có lỗi xảy ra khi cập nhật số lượng sản phẩm')</script>";
        }
    }
}

 ?>
<?php
$get_product = "SELECT * FROM products";
$run_product = mysqli_query($conn, $get_product);
?>

<div class="right__title">Bảng điều khiển</div>
<p class="right__desc">Quantity Size Product</p>
<div class="right__formWrapper">
    <form action="" method="post">
        <div class="right__inputWrapper">
            <label for="p_category">Tên sản phẩm</label>
            <select name="product_id" required>
                <option value="">---Select---</option>
                <?php foreach ($run_product as $key) :
                    extract($key);?>
                <option value="<?=$product_id; ?>"><?=$product_title;?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="right__inputWrapper">
            <label for="label">SL Product Size S</label>
            <input type="number" name="product_quantity_s" placeholder="Số lượng sản phẩm size s">
        </div>

        <div class="right__inputWrapper">
            <label for="label">SL Product Size M</label>
            <input type="number" name="product_quantity_m" placeholder="Số lượng sản phẩm size m">
        </div>

        <div class="right__inputWrapper">
            <label for="label">SL Product Size L</label>
            <input type="number" name="product_quantity_l" placeholder="Số lượng sản phẩm size l">
        </div>

        <button name="submit_quantity" class="btn" type="submit">Add</button>
    </form>
</div>

<?php } ?>