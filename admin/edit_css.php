<?php 
    
    if (!isset($_SESSION['admin_email'])) {
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>

<?php

    $file = "../css/main.css";

    if (file_exists($file)) {

        $data = file_get_contents($file);

    }

?>

<div class="right__title">Bảng điều khiển</div>
<p class="right__desc">Chỉnh sửa css</p>
<div class="right__formWrapper">
    <form action="" method="post">
        <div class="right__inputWrapper">
            <label for="desc">Code</label>
            <textarea name="newdata" cols="30" rows="10" placeholder="code"><?php echo $data; ?></textarea>
        </div>
        <button name="update" class="btn" type="submit">Cập nhật</button>
    </form>
</div>

<?php

    if (isset($_POST['update'])) {

        $newdata = $_POST['newdata'];

        $handle = fopen($file, "w");

        fwrite($handle, $newdata);

        echo "<script>alert('Cập Nhật Thành Công')</script>";
        echo "<script>window.open('index.php?edit_css','_self')</script>";

    }
?>

<?php } ?>