
<h3 class="sectionTitle">Thay đổi Mật Khẩu</h3>
<div class="right__formWrapper">
    <form action="" method="post" enctype="multipart/form-data">
        <div class="right__inputWrapper">
            <label for="old_password">Mật Khẩu Cũ</label>
            <input id="old_password" type="password" name="customer_old_password">
        </div>
        <div class="right__inputWrapper">
            <label for="new_password">Mật Khẩu Mới</label>
            <input id="new_password" type="password" name="customer_new_password">
        </div>
        <div class="right__inputWrapper">
            <label for="re_new_password">Nhập Lại Mật Khẩu Mới</label>
            <input id="re_new_password" type="password" name="customer_re_new_password">
        </div>
        <button type="submit" name="update" class="btn">Cập Nhật</button>
    </form>
</div>

<?php

    if (isset($_POST['update'])) {

        $customer_old_password = $_POST['customer_old_password'];

        $customer_new_password = password_hash($_POST['customer_new_password'],PASSWORD_DEFAULT);

        $customer_re_new_password = $_POST['customer_re_new_password'];

        $get_old_password = "select * from customers where customer_id='$customer_id'";

        $run_old_password = mysqli_query($conn, $get_old_password);

        $row_old_password = mysqli_fetch_array($run_old_password);

            $old_password_hash = $row_old_password['customer_password'];
            

        if (!password_verify($_POST['customer_old_password'],$old_password_hash)) {

            echo "<script>alert('Mật Khẩu Cũ Không Đúng')</script>";

            exit();

        }

        if (!password_verify($_POST['customer_re_new_password'],$customer_new_password)) {

            echo "<script>alert('Mật Khẩu Nhập Lại Chưa Đúng')</script>";

            exit();

        }

        $update_password = "update customers set customer_password='$customer_new_password' where customer_id='$customer_id'";

        $run_update = mysqli_query($conn, $update_password);

        if ($run_update) {

            echo "<script>alert('Mật Khẩu Đã Được Cập Nhật')</script>";
            echo "<script>window.open('my_account.php?my_orders','_self')</script>";

        }

    }

?>