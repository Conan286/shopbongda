<?php 
    
    if (!isset($_SESSION['admin_email'])) {
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>

<div class="right__title">Bảng điều khiển</div>
<p class="right__desc">Chèn thể loại</p>
<div class="right__formWrapper">
    <form action="" method="post">
        <div class="right__inputWrapper">
            <label for="title">Tiêu đề</label>
            <input name="cat_title" type="text" placeholder="Tiêu đề">
        </div>
        <div class="right__inputWrapper">
            <label for="desc">Mô tả</label>
            <textarea name="cat_desc" cols="30" rows="10" placeholder="Mô tả"></textarea>
        </div>
        <button name="submit" class="btn" type="submit">Chèn</button>
    </form>
</div>

<?php  

    if (isset($_POST['submit'])) {
              
        $cat_title = $_POST['cat_title'];
              
        $cat_desc = $_POST['cat_desc'];
              
        $insert_cat = "insert into categories (category_title, category_desc) values ('$cat_title', '$cat_desc')";
              
        $run_cat = mysqli_query($conn, $insert_cat);
              
        if ($run_cat) {
                  
            echo "<script>alert('Đã Thêm Thành Công')</script>";
                  
            echo "<script>window.open('index.php?view_categories','_self')</script>";
                  
        }
              
    }

?>

<?php } ?>