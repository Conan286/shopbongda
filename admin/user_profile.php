<?php 

    if (!isset($_SESSION['admin_email'])) {
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>
   
<?php 

    if (isset($_GET['user_profile'])) {
        
        $edit_user = $_GET['user_profile'];
        
        $get_user = "select * from admins where admin_id='$edit_user'";
        
        $run_user = mysqli_query($conn, $get_user);
        
        $row_user = mysqli_fetch_array($run_user);
        
        $user_id = $row_user['admin_id'];
        
        $user_name = $row_user['admin_name'];
        
        $user_pass = $row_user['admin_password'];
        
        $user_email = $row_user['admin_email'];
        
        $user_image_origin = $row_user['admin_image'];
    }

?>
<div class="right__title">Bảng điều khiển</div>
<p class="right__desc">Chèn admin</p>
<div class="right__formWrapper">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="right__inputWrapper">
            <label for="name">Tên admin</label>
            <input name="admin_name" type="text" placeholder="Tên admin" value="<?php echo $user_name; ?>">
        </div>
        <div class="right__inputWrapper">
            <label for="email">Email</label>
            <input name="admin_email" type="text" placeholder="Email" value="<?php echo $user_email; ?>">
        </div>
        <div class="right__inputWrapper">
            <label for="password">Mật khẩu</label>
            <input name="admin_pass" type="text" placeholder="Mật khẩu" value="<?php echo $user_pass; ?>">
        </div>
        <div class="right__inputWrapper">
            <label for="image">Hình ảnh</label>
            <input name="admin_image" type="file">
        </div>
        <div class="right__inputImageReview"><img src="admin_images/<?php echo $user_image_origin; ?>" alt=""></div>
        <button name="update" class="btn" type="submit">Cập nhật</button>
    </form>
</div><?php 

if (isset($_POST['update'])) {
    
    $user_name = $_POST['admin_name'];
    $user_email = $_POST['admin_email'];
    $user_pass = $_POST['admin_pass'];
    $user_image = $_FILES['admin_image']['name'];
    $temp_admin_image = $_FILES['admin_image']['tmp_name'];

    if ($temp_admin_image=='') {

        $update_user = "update admins set admin_name='$user_name',admin_email='$user_email',admin_password='$user_pass' where admin_id='$user_id'";
    
        $run_user = mysqli_query($conn, $update_user);
        
        if ($run_user) {
            
            echo "<script>alert('Cập Nhật Thành Công')</script>";
    
            echo "<script>window.open('login.php','_self')</script>";
            
            session_destroy();

        }

    } else {

        unlink("admin_images/$user_image_origin");

        move_uploaded_file($temp_admin_image,"admin_images/$user_image");

        $update_user = "update admins set admin_name='$user_name',admin_email='$user_email',admin_password='$user_pass',admin_image='$user_image' where admin_id='$user_id'";
    
        $run_user = mysqli_query($conn, $update_user);
        
        if ($run_user) {
            
            echo "<script>alert('Cập Nhật Thành Công')</script>";
    
            echo "<script>window.open('login.php','_self')</script>";
            
            session_destroy();
            
        }

    }
    
}

?>

<?php } ?>