<?php 
    
    if (!isset($_SESSION['admin_email'])) {
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>

<div class="right__title">Bảng điều khiển</div>
<p class="right__desc">Chèn danh mục</p>
<div class="right__formWrapper">
    <form action="" method="post">
        <div class="right__inputWrapper">
            <label for="title">Tiêu đề</label>
            <input name="p_cat_title" type="text" placeholder="Tiêu đề">
        </div>
        <div class="right__inputWrapper">
            <label for="desc">Mô tả</label>
            <textarea name="p_cat_desc" id="" cols="30" rows="10" placeholder="Mô tả"></textarea>
        </div>
        <button name="submit" class="btn" type="submit">Chèn</button>
    </form>
</div>

<?php  

    if(isset($_POST['submit'])){
              
        $p_cat_title = $_POST['p_cat_title'];
              
        $p_cat_desc = $_POST['p_cat_desc'];
              
        $insert_p_cat = "insert into product_categories (product_category_title, product_category_desc) values ('$p_cat_title', '$p_cat_desc')";
              
        $run_p_cat = mysqli_query($conn, $insert_p_cat);
              
        if ($run_p_cat) {
                  
            echo "<script>alert('Đã Thêm Thành Công')</script>";
                  
            echo "<script>window.open('index.php?view_p_categories','_self')</script>";
                  
        }
              
    }

?>

<?php } ?> 