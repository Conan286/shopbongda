<?php 
    
    if (!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {


?>

<div class="right__title">Bảng điều khiển</div>
<p class="right__desc">Xem sản phẩm</p>
<div class="right__table">
    <div class="right__tableWrapper">
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tiêu đề</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá SP</th>
                    <th>Mã giảm giá</th>
                    <th>Giới hạn</th>
                    <th>Đã dùng</th>
                    <th>Sửa</th>
                    <th>Xoá</th>
                </tr>
            </thead>
    
            <tbody>

                <?php

                    $i=0;

                    $get_coupons = "select * from coupons";

                    $run_coupons = mysqli_query($conn, $get_coupons);

                    while ($row_coupons = mysqli_fetch_array($run_coupons)) {

                        $coupon_id = $row_coupons['coupon_id'];

                        $coupon_product_id = $row_coupons['product_id'];

                        $coupon_title = $row_coupons['coupon_title'];

                        $coupon_price = $row_coupons['coupon_price'];

                        $coupon_code = $row_coupons['coupon_code'];

                        $coupon_limit = $row_coupons['coupon_limit'];

                        $coupon_used = $row_coupons['coupon_used'];
                        

                        $get_products = "select * from products where product_id='$coupon_product_id'";

                        $run_products = mysqli_query($conn, $get_products);

                        $row_products = mysqli_fetch_array($run_products);

                            $product_title = $row_products['product_title'];

                        $i++;
                ?>
                <tr>
                    <td data-label="STT"><?php echo $i; ?></td>
                    <td data-label="Tiêu đề"><?php echo $coupon_title; ?></td>
                    <td data-label="Tên sản phẩm"><?php echo $product_title; ?></td>
                    <td data-label="Giá SP"><?php echo $coupon_price; ?></td>
                    <td data-label="Mã giảm giá"><?php echo $coupon_code; ?></td>
                    <td data-label="Giới hạn"><?php echo $coupon_limit; ?></td>
                    <td data-label="Đã dùng"><?php echo $coupon_used; ?></td>
                    <td data-label="Sửa" class="right__iconTable"><a href="index.php?edit_coupon=<?php echo $coupon_id; ?>"><img src="assets/icon-edit.svg" alt=""></a></td>
                    <td data-label="Xoá" class="right__iconTable"><a href="index.php?delete_coupon=<?php echo $coupon_id; ?>"><img src="assets/icon-trash-black.svg" alt=""></a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php } ?>