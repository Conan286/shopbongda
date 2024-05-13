<?php

    if (!isset($_SESSION['admin_email'])) {

        echo "<script>window.open('login.php','_self')</script>";

    } else {
    
?>

<div class="right__title">Bảng điều khiển</div>
<p class="right__desc">Chèn sản phẩm</p>
<div class="right__formWrapper">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="right__inputWrapper">
            <label for="title">Tiêu đề</label>
            <input name="product_title" type="text" placeholder="Tiêu đề" required>
        </div>
        <div class="right__inputWrapper">
            <label for="p_category">Danh mục</label>
            <select name="product_category" required>
                <option value="" disabled selected>Chọn danh mục</option>

                    <?php 
                    
                        $get_product_categories = "select * from product_categories";

                        $run_product_categories = mysqli_query($conn, $get_product_categories);
                    
                        while ($row_product_categories = mysqli_fetch_array($run_product_categories)) {
                            
                            $product_category_id = $row_product_categories['product_category_id'];

                            $product_category_title = $row_product_categories['product_category_title'];
                            
                            echo "
                            
                            <option value='$product_category_id'> $product_category_title </option>
                            
                            ";
                        
                        }
                    
                    ?>
            </select>
        </div>
        <div class="right__inputWrapper">
            <label for="category">Thể loại</label>
            <select name="category" required>
                <option value="" disabled selected>Chọn thể loại</option>
                              
                <?php 
                
                    $get_categories = "select * from categories";

                    $run_categories = mysqli_query($conn, $get_categories);
                
                    while ($row_categories = mysqli_fetch_array($run_categories)) {
                        
                        $category_id = $row_categories['category_id'];

                        $category_title = $row_categories['category_title'];
                        
                        echo "
                        
                        <option value='$category_id'> $category_title </option>
                        
                        ";
                        
                    }
                
                ?>
            </select>
        </div>
        <div class="right__inputWrapper">
            <label for="image">Hình ảnh 1</label>
            <input name="product_image_1" type="file" required>
        </div>
        <div class="right__inputWrapper">
            <label for="image">Hình ảnh 2</label>
            <input name="product_image_2" type="file" required>
        </div>
        <div class="right__inputWrapper">
            <label for="image">Hình ảnh 3</label>
            <input name="product_image_3" type="file" required>
        </div>
        <div class="right__inputWrapper">
            <label for="label">Nhãn sản phẩm</label>
            <select name="product_label" required>
                <option value="" disabled selected>Nhãn sản phẩm</option>
                <option value="new">Mới</option>
                <option value="sale">Giảm giá</option>
            </select>
        </div>
        <div class="right__inputWrapper">
            <label for="title">Giá sản phẩm</label>
            <input name="product_price" type="text" placeholder="Giá sản phẩm" required>
        </div>
        <div class="right__inputWrapper">
            <label for="title">Giá giảm sản phẩm</label>
            <input name="product_sale" type="text" placeholder="Giá giảm sản phẩm">
        </div>
        <div class="right__inputWrapper">
            <label for="keywords">Từ khoá</label>
            <input name="product_keywords" type="text" placeholder="Từ khoá" required>
        </div>
        <div class="right__inputWrapper">
            <label for="desc">Mô tả</label>
            <textarea name="product_description" cols="30" rows="10" placeholder="Mô tả"></textarea>
        </div>
        <div class="right__inputWrapper">
            <label for="total">Tổng số lượng</label>
            <input name="product_total" type="number" placeholder="Tổng số lượng" required>
        </div>
        <button name="submit" class="btn" type="submit">Chèn</button>
    </form>
</div>

<?php

if (isset($_POST['submit'])) {

    $product_title = $_POST['product_title'];
    $product_category = $_POST['product_category'];
    $category = $_POST['category'];
    $product_price = preg_replace("/[^0-9]/", "", $_POST['product_price']);
    $product_keywords = $_POST['product_keywords'];
    $product_description = $_POST['product_description'];
    $product_label = $_POST['product_label'];
    $product_sale = preg_replace("/[^0-9]/", "", $_POST['product_sale']);
    $product_total = $_POST['product_total'];

    $image_path = "product_images/";
    $product_image_1 = $image_path . basename($_FILES['product_image_1']['name']);
    $product_image_2 = $image_path . basename($_FILES['product_image_2']['name']);
    $product_image_3 = $image_path . basename($_FILES['product_image_3']['name']);

    $temp_name1 = $_FILES['product_image_1']['tmp_name'];
    $temp_name2 = $_FILES['product_image_2']['tmp_name'];
    $temp_name3 = $_FILES['product_image_3']['tmp_name'];

    move_uploaded_file($temp_name1, "$product_image_1");
    move_uploaded_file($temp_name2, "$product_image_2");
    move_uploaded_file($temp_name3, "$product_image_3");

    $insert_product = "insert into products (product_category_id, category_id, date, product_title, product_image_1, product_image_2, product_image_3, product_price, product_keywords, product_description, product_label, product_sale, product_total)
                                     values ('$product_category', '$category', NOW(), '$product_title', '$product_image_1', '$product_image_2', '$product_image_3', '$product_price', '$product_keywords', '$product_description', '$product_label', '$product_sale', '$product_total')";
    
    $run_product = mysqli_query($conn, $insert_product);

    if($run_product) {

        echo "<script>alert('Sản Phẩm Đã Được Thêm')</script>";
        
        echo "<script>window.open('index.php?view_products', '_self')</script>";
    }
}

?>
<?php } ?>