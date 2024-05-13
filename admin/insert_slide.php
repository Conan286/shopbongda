<?php 
    
    if (!isset($_SESSION['admin_email'])) {
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>

<div class="right__title">Bảng điều khiển</div>
<p class="right__desc">Chèn slide</p>
<div class="right__formWrapper">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="right__inputWrapper">
            <label for="image">Hình ảnh</label>
            <input name="slide_image" type="file">
        </div>
        <button name="submit" class="btn" type="submit">Chèn</button>
    </form>
</div>

<?php

    if (isset($_POST['submit'])) {

        $slide_path = "slides_images/";
        
        $slide_image = $slide_path . basename($_FILES['slide_image']['name']);
        
        $temp_name = $_FILES['slide_image']['tmp_name'];
        
        $view_slides = "select * from slides";
        
        $view_run_slide = mysqli_query($conn, $view_slides);
        
        $count = mysqli_num_rows($view_run_slide);
        
        if($count<4){
            
            move_uploaded_file($temp_name,"$slide_image");
            
            $insert_slide = "insert into slides (slide_image) values ('$slide_image')";
            
            $run_slide = mysqli_query($conn, $insert_slide);
            
            echo "<script>alert('Thêm Thành Công')</script>";
            
            echo "<script>window.open('index.php?view_slides','_self')</script>";
            
        } else {
            
           echo "<script>alert('Tối Đa 4 Slide Có Thể Thêm')</script>"; 

           echo "<script>window.open('index.php?view_slides','_self')</script>";
            
        }
        
    }

?>

<?php } ?>