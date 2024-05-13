<?php 
    
    if (!isset($_SESSION['admin_email'])) {
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>

<?php 

    if (isset($_GET['edit_slide'])) {
        
        $edit_slide_id = $_GET['edit_slide'];
        
        $edit_slide = "select * from slides where slide_id='$edit_slide_id'";
        
        $run_edit_slide = mysqli_query($conn, $edit_slide);
        
        $row_edit_slide = mysqli_fetch_array($run_edit_slide);
        
        $slide_id = $row_edit_slide['slide_id'];
        
        $slide_image_orgin = $row_edit_slide['slide_image'];
        
    }

?>

<div class="right__title">Bảng điều khiển</div>
<p class="right__desc"> Chỉnh sửa slide</p>
<div class="right__formWrapper">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="right__inputWrapper">
            <label for="image">Hình ảnh</label>
            <input name="slide_image" type="file">
        </div>
        <div class="right__inputImageReview"><img src="<?php echo $slide_image_orgin; ?>" alt=""></div>
        <button name="update" class="btn" type="submit">Cập nhật</button>
    </form>
</div>

<?php  

    if (isset($_POST['update'])) {

        $slide_path = "slides_images/";
        
        $slide_image = $slide_path . basename($_FILES['slide_image']['name']);
        
        $temp_name = $_FILES['slide_image']['tmp_name'];
        
        if ($temp_name=='') {
            
            echo "<script>alert('Vui lòng chọn một hình ảnh')</script>";

        } else {
            
            move_uploaded_file($temp_name,"$slide_image");

            unlink($slide_image_orgin);

            $update_slide = "update slides set slide_image='$slide_image' where slide_id='$slide_id'";
        
            $run_update_slide = mysqli_query($conn, $update_slide);
        
            if($run_update_slide) {
            
                echo "<script>alert('Cập Nhật Thành Công')</script>"; 
            
                echo "<script>window.open('index.php?view_slides','_self')</script>";
            
            }

        }
        
    }

?>

<?php } ?>