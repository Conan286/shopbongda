<?php 
    
    if (!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>

<div class="right__title">Bảng điều khiển</div>
<p class="right__desc">Xem admins</p>
<div class="right__table">
    <div class="right__tableWrapper">
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên</th>
                    <th>Hình ảnh</th>
                    <th>Email</th>
                    <th>Sửa</th>
                    <th>Xoá</th>
                </tr>
            </thead>
    
            <tbody>
                            
                <?php 

                    $i=0;
                
                    $get_users = "select * from admins";
                    
                    $run_users = mysqli_query($conn ,$get_users);

                    while ($row_users = mysqli_fetch_array($run_users)) {
                        
                        $user_id = $row_users['admin_id'];
                        
                        $user_name = $row_users['admin_name'];
                        
                        $user_img = $row_users['admin_image'];
                        
                        $user_email = $row_users['admin_email'];
                        
                        $i++;
                
                ?>
                <tr>
                    <td data-label="STT"><?php echo $i; ?></td>
                    <td data-label="Tên"><?php echo $user_name; ?></td>
                    <td data-label="Hình ảnh" style="text-align: center;"><img style="width: 50px;height: 50px; border-radius: 100%; object-fit: cover;" src="admin_images/<?php echo $user_img; ?>" alt=""></td>
                    <td data-label="Email"><?php echo $user_email; ?></td>
                    <td data-label="Sửa" class="right__iconTable"><a href="index.php?user_profile=<?php echo $user_id; ?>"><img src="assets/icon-edit.svg" alt=""></a></td>
                    <td data-label="Xoá" class="right__iconTable"><a href="index.php?delete_user=<?php echo $user_id; ?>"><img src="assets/icon-trash-black.svg" alt=""></a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php } ?>