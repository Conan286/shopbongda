<?php 
    
    if (!isset($_SESSION['admin_email'])) {
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>

<div class="right__title">Bảng điều khiển</div>
<p class="right__desc">Xem khách hàng</p>
<div class="right__table">
    <div class="right__tableWrapper">
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th style="text-align: center;">Hình ảnh</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Địa chỉ</th>
                    <th>Xoá</th>
                </tr>
            </thead>
    
            <tbody>
                            
                <?php 

                    $i=0;
                
                    $get_c = "select * from customers";
                    
                    $run_c = mysqli_query($conn, $get_c);

                    while ($row_c = mysqli_fetch_array($run_c)) {
                        
                        $c_id = $row_c['customer_id'];
                        
                        $c_name = $row_c['customer_name'];

                        $c_email = $row_c['customer_email'];

                        $c_phone = $row_c['customer_phone'];

                        $c_address = $row_c['customer_address'];
                        
                        $c_img = $row_c['customer_image'];
                        
                        $i++;
                
                ?>
                <tr>
                    <td data-label="STT"><?php echo $i; ?></td>
                    <td data-label="Hình ảnh" style="text-align: center;"><img style="width: 50px;height: 50px; border-radius: 100%; object-fit: cover;" src="../customer/customer_images/<?php echo $c_img; ?>" alt=""></td>
                    <td data-label="Tên"><?php echo $c_name; ?></td>
                    <td data-label="Email"><?php echo $c_email; ?></td>
                    <td data-label="Phone"><?php echo $c_phone; ?></td>
                    <td data-label="Địa chỉ"><?php echo $c_address ?></td>
                    <td data-label="Xoá" class="right__iconTable"><a href="index.php?delete_customer=<?php echo $c_id; ?>"><img src="assets/icon-trash-black.svg" alt=""></a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php } ?>