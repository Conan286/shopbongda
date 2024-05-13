<?php 
    
    if (!isset($_SESSION['admin_email'])) {
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>

<?php 

    if (isset($_GET['edit_cat'])) {
        
        $edit_cat_id = $_GET['edit_cat'];
        
        $edit_cat_query = "select * from categories where category_id='$edit_cat_id'";
        
        $run_edit = mysqli_query($conn, $edit_cat_query);
        
        $row_edit = mysqli_fetch_array($run_edit);
        
        $cat_id = $row_edit['category_id'];
        
        $cat_title = $row_edit['category_title'];
        
        $cat_desc = $row_edit['category_desc'];
        
    }

?>

<div class="right__title">Bảng điều khiển</div>
<p class="right__desc">Chèn thể loại</p>
<div class="right__formWrapper">
    <form action="" method="post">
        <div class="right__inputWrapper">
            <label for="title">Tiêu đề</label>
            <input name="cat_title" type="text" placeholder="Tiêu đề" value="<?php echo $cat_title; ?>">
        </div>
        <div class="right__inputWrapper">
            <label for="desc">Mô tả</label>
            <textarea name="cat_desc" cols="30" rows="10" placeholder="Mô tả"><?php echo $cat_desc; ?></textarea>
        </div>
        <button name="update" class="btn" type="submit">Chèn</button>
    </form>
</div>

<?php  

    if (isset($_POST['update'])) {
              
        $cat_title = $_POST['cat_title'];
                
        $cat_desc = $_POST['cat_desc'];
                
        $update_cat = "update categories set category_title='$cat_title',category_desc='$cat_desc' where category_id='$cat_id'";
                
        $run_cat = mysqli_query($conn, $update_cat);
                
        if ($run_cat) {
                    
            echo "<script>alert('Cập Nhật Thành Công')</script>";
                    
            echo "<script>window.open('index.php?view_categories','_self')</script>";
                    
        }
              
    }

?>

<?php } ?> 