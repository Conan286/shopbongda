<?php

    if (!isset($_SESSION['admin_email'])) {

        echo "<script>window.open('login.php','_self')</script>";

    } else {
    
?>

<?php

    if (isset($_GET['edit_product'])){

        $edit_id = $_GET['edit_product'];

        $get_p = "select * from products where product_id='$edit_id'";

        $run_edit =mysqli_query($conn, $get_p);

        $row_edit = mysqli_fetch_array($run_edit);

        $p_id = $row_edit['product_id'];

        $p_title = $row_edit['product_title'];

        $p_cat = $row_edit['product_category_id'];
        
        $cat = $row_edit['category_id'];

        $p_image1 = $row_edit['product_image_1'];

        $p_image2 = $row_edit['product_image_2'];

        $p_image3 = $row_edit['product_image_3'];

        $p_price = $row_edit['product_price'];
        $p_price_format = number_format((float)$p_price, 0, ',', '.');

        $p_keywords = $row_edit['product_keywords'];

        $p_desc = $row_edit['product_description'];

        $p_label = $row_edit['product_label'];

        $p_sale = $row_edit['product_sale'];
        $p_sale_format = number_format((float)$p_sale, 0, ',', '.');

        $p_total = $row_edit['product_total'];

    }

        $get_p_cat = "select * from product_categories where product_category_id='$p_cat'";

        $run_p_cat = mysqli_query($conn, $get_p_cat);

        $row_p_cat = mysqli_fetch_array($run_p_cat);

        $p_cat_title = $row_p_cat['product_category_title'];

        $p_cat_desc = $row_p_cat['product_category_desc'];


        $get_cat = "select *from categories where category_id='$cat'";

        $run_cat = mysqli_query($conn, $get_cat);

        $row_cat = mysqli_fetch_array($run_cat);

        $cat_title = $row_cat['category_title'];

?>

<div class="right__title">Bảng điều khiển</div>
<p class="right__desc">Chỉnh sửa sản phẩm</p>
<div class="right__formWrapper">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="right__inputWrapper">
            <label for="title">Tiêu đề</label>
            <input name="product_title" type="text" placeholder="Tiêu đề" value="<?php echo $p_title ?>" required>
        </div>
        <div class="right__inputWrapper">
            <label for="p_category">Danh mục</label>
            <select name="product_category" required>
            <option value ="<?php echo $p_cat;?>"> <?php echo $p_cat_title;?> </option>

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
                <option value ="<?php echo $cat;?>"> <?php echo $cat_title;?> </option>
                              
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
            <img src="<?php echo $p_image1; ?>" alt="">
            <label for="image">Hình ảnh 1</label>
            <input name="product_img1" type="file">
        </div>
        <div class="right__inputWrapper">
            <img src="<?php echo $p_image2; ?>" alt="">
            <label for="image">Hình ảnh 2</label>
            <input name="product_img2" type="file">
        </div>
        <div class="right__inputWrapper">
            <img src="<?php echo $p_image3; ?>" alt="">
            <label for="image">Hình ảnh 3</label>
            <input name="product_img3" type="file">
        </div>
        <div class="right__inputWrapper">
            <label for="label">Nhãn sản phẩm</label>
            <select name="product_label">
                <option value ="<?php echo $p_label;?>">
                
                <?php
                            
                    if ($p_label == "new") {
                        
                        echo "Mới";

                    } else {

                        echo "Giảm Giá";

                    }
                          
                ?>
                </option>
                <option value="new">Mới</option>
                <option value="sale">Giảm giá</option>
            </select>
        </div>
        <div class="right__inputWrapper">
            <label for="title">Giá sản phẩm</label>
            <input name="product_price" type="text" placeholder="Giá sản phẩm" value ="<?php echo $p_price_format; ?>" required>
        </div>
        <div class="right__inputWrapper">
            <label for="title">Giá giảm sản phẩm</label>
            <input name="product_sale" type="text" placeholder="Giá giảm sản phẩm"  value ="<?php echo $p_sale_format; ?>">
        </div>
        <div class="right__inputWrapper">
            <label for="keywords">Từ khoá</label>
            <input name="product_keywords" type="text" placeholder="Từ khoá" value ="<?php echo $p_keywords; ?>" required>
        </div>
        <div class="right__inputWrapper">
            <label for="desc">Mô tả</label>
            <textarea name="product_description" cols="30" rows="10" placeholder="Mô tả"><?php echo $p_desc; ?></textarea>
        </div>
        <div class="right__inputWrapper">
            <label for="total">Tổng số lượng</label>
            <input name="product_total" type="text" placeholder="Tổng số lượng" value ="<?php echo $p_total; ?>" required>
        </div>
        <button name="update" class="btn" type="submit">Cập nhật</button>
    </form>
</div>


<?php

if (isset($_POST['update'])) {

    $product_title = $_POST['product_title'];
    $product_cat = $_POST['product_category'];
    $cat = $_POST['category'];
    $product_price = preg_replace("/[^0-9]/", "", $_POST['product_price']);
    $product_keywords = $_POST['product_keywords'];
    $product_desc = $_POST['product_description'];
    $product_label = $_POST['product_label'];
    $product_sale = preg_replace("/[^0-9]/", "", $_POST['product_sale']);
    $product_total = $_POST['product_total'];

    $image_path = "product_images/";
    $product_img1 = $image_path . basename($_FILES['product_img1']['name']);
    $product_img2 = $image_path . basename($_FILES['product_img2']['name']);
    $product_img3 = $image_path . basename($_FILES['product_img3']['name']);

    $temp_name1 = $_FILES['product_img1']['tmp_name'];
    $temp_name2 = $_FILES['product_img2']['tmp_name'];
    $temp_name3 = $_FILES['product_img3']['tmp_name'];

    if ($temp_name1=='' AND $temp_name2=='' AND $temp_name3=='') {

        $update_product = "update products set product_category_id='$product_cat', category_id='$cat', date=NOW(), product_title='$product_title',
        product_keywords='$product_keywords',product_description='$product_desc',product_price='$product_price', product_label='$product_label', product_sale='$product_sale', product_total='$product_total' where product_id='$p_id'";
    
        $run_product = mysqli_query($conn, $update_product);
    
        if ($run_product) {
    
            echo "<script>alert('Cập Nhật Thành Công')</script>";
    
            echo "<script>window.open('index.php?view_products','_self')</script>";
    
        }

        exit();

    }

    if ($temp_name1!=='' AND $temp_name2!=='' AND $temp_name3!=='') {

        move_uploaded_file($temp_name1, "$product_img1");
        move_uploaded_file($temp_name2, "$product_img2");
        move_uploaded_file($temp_name3, "$product_img3");

        unlink($p_image1);
        unlink($p_image2);
        unlink($p_image3);

        $update_product = "update products set product_category_id='$product_cat', category_id='$cat', date=NOW(), product_title='$product_title', product_image_1='$product_img1', product_image_2='$product_img2', product_image_3='$product_img3',
        product_keywords='$product_keywords',product_description='$product_desc',product_price='$product_price', product_label='$product_label', product_sale='$product_sale', product_total='$product_total' where product_id='$p_id'";
    
        $run_product = mysqli_query($conn, $update_product);
    
        if ($run_product) {
    
            echo "<script>alert('Cập Nhật Thành Công')</script>";
    
            echo "<script>window.open('index.php?view_products','_self')</script>";
    
        }

        exit();

    }


    if ($temp_name1=='' AND $temp_name2=='') {

        move_uploaded_file($temp_name3, "$product_img3");

        unlink($p_image3);

        $update_product = "update products set product_category_id='$product_cat', category_id='$cat', date=NOW(), product_title='$product_title', product_image_3='$product_img3',
        product_keywords='$product_keywords',product_description='$product_desc',product_price='$product_price', product_label='$product_label', product_sale='$product_sale' product_total='$product_total' where product_id='$p_id'";
    
        $run_product = mysqli_query($conn, $update_product);
    
        if ($run_product) {
    
            echo "<script>alert('Cập Nhật Thành Công')</script>";
    
            echo "<script>window.open('index.php?view_products','_self')</script>";
    
        }

        exit();

    }

    if ($temp_name1=='' AND $temp_name3=='') {

        move_uploaded_file($temp_name2, "$product_img2");

        unlink($p_image2);

        $update_product = "update products set product_category_id='$product_cat', category_id='$cat', date=NOW(), product_title='$product_title', product_image_2='$product_img2',
        product_keywords='$product_keywords',product_description='$product_desc',product_price='$product_price', product_label='$product_label', product_sale='$product_sale', product_total='$product_total' where product_id='$p_id'";
    
        $run_product = mysqli_query($conn, $update_product);
    
        if ($run_product) {
    
            echo "<script>alert('Cập Nhật Thành Công')</script>";
    
            echo "<script>window.open('index.php?view_products','_self')</script>";
    
        }

        exit();

    }

    if ($temp_name2=='' AND $temp_name3=='') {

        move_uploaded_file($temp_name1, "$product_img1");unlink($p_image1);

        unlink($p_image1);

        $update_product = "update products set product_category_id='$product_cat', category_id='$cat', date=NOW(), product_title='$product_title', product_image_1='$product_img1',
        product_keywords='$product_keywords',product_description='$product_desc',product_price='$product_price', product_label='$product_label', product_sale='$product_sale', product_total='$product_total' where product_id='$p_id'";
    
        $run_product = mysqli_query($conn, $update_product);
    
        if ($run_product) {
    
            echo "<script>alert('Cập Nhật Thành Công')</script>";
    
            echo "<script>window.open('index.php?view_products','_self')</script>";
    
        }

        exit();

    }

}

?>

<?php } ?>