<?php 
    
    if (!isset($_SESSION['admin_email'])) {
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>

<?php 

    if (isset($_GET['edit_p_cat'])) {
        
        $edit_p_cat_id = $_GET['edit_p_cat'];
        
        $edit_p_cat_query = "select * from product_categories where product_category_id='$edit_p_cat_id'";
        
        $run_edit = mysqli_query($conn, $edit_p_cat_query);
        
        $row_edit = mysqli_fetch_array($run_edit);
        
        $p_cat_id = $row_edit['product_category_id'];
        
        $p_cat_title = $row_edit['product_category_title'];
        
        $p_cat_desc = $row_edit['product_category_desc'];
        
    }

?>

<div class="right__title">Bảng điều khiển</div>
<p class="right__desc">Chỉnh sửa danh mục</p>
<div class="right__formWrapper">
    <form action="" method="post">
        <div class="right__inputWrapper">
            <label for="title">Tiêu đề</label>
            <input name="p_cat_title" type="text" placeholder="Tiêu đề" value="<?php echo $p_cat_title; ?>">
        </div>
        <div class="right__inputWrapper">
            <label for="desc">Mô tả</label>
            <textarea name="p_cat_desc" id="" cols="30" rows="10" placeholder="Mô tả"><?php echo $p_cat_desc; ?></textarea>
        </div>
        <button name="update" class="btn" type="submit">Chèn</button>
    </form>
</div>

<?php  

    if (isset($_POST['update'])) {
              
        $p_cat_title = $_POST['p_cat_title'];
              
        $p_cat_desc = $_POST['p_cat_desc'];
              
        $update_p_cat = "update product_categories set product_category_title='$p_cat_title',product_category_desc='$p_cat_desc' where product_category_id='$p_cat_id'";
              
        $run_p_cat = mysqli_query($conn, $update_p_cat);
              
        if ($run_p_cat) {
                  
            echo "<script>alert('Cập Nhật Thành Công')</script>";
                  
            echo "<script>window.open('index.php?view_p_categories','_self')</script>";
                  
        }
              
    }

?>

<?php } ?> 