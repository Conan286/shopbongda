<?php 

    if (!isset($_SESSION['admin_email'])) {
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>

<div class="right__title">Bảng điều khiển</div>
<p class="right__desc">Chèn admin</p>
<div class="right__formWrapper">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="right__inputWrapper">
            <label for="name">Tên admin</label>
            <input name="admin_name" type="text" placeholder="Tên admin">
        </div>
        <div class="right__inputWrapper">
            <label for="email">Email</label>
            <input name="admin_email" type="text" placeholder="Email">
        </div>
        <div class="right__inputWrapper">
            <label for="password">Mật khẩu</label>
            <input name="admin_pass" type="text" placeholder="Mật khẩu">
        </div>
        <div class="right__inputWrapper">
            <label for="image">Hình ảnh</label>
            <input name="admin_image" type="file">
        </div>
        <button name="submit" class="btn" type="submit">Chèn</button>
    </form>
</div>
<?php 

if (isset($_POST['submit'])) {
    
    $user_name = $_POST['admin_name'];
    $user_email = $_POST['admin_email'];
    $user_pass = $_POST['admin_pass'];
    $user_image = $_FILES['admin_image']['name'];
    $temp_admin_image = $_FILES['admin_image']['tmp_name'];
    
    move_uploaded_file($temp_admin_image,"admin_images/$user_image");
    
    $insert_user = "insert into admins (admin_name, admin_email, admin_password,admin_image) values ('$user_name', '$user_email', '$user_pass', '$user_image')";
    
    $run_user = mysqli_query($conn, $insert_user);
    
    if ($run_user) {
        
        echo "<script>alert('Đã Thêm Thành Công Tài Khoản Admin')</script>";

        echo "<script>window.open('index.php?view_users','_self')</script>";
        
    }
    
}

?>

<?php } ?>