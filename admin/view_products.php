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
                    <th>Tên sản phẩm</th>
                    <th>Hình ảnh</th>
                    <th>Giá SP</th>
                    <th>SL SP</th>
                    <th>Đã bán</th>
                    <th>Từ khoá</th>
                    <th>Thời gian</th>
                    <th>Sửa</th>
                    <th>Xoá</th>
                </tr>
            </thead>

            <tbody>

                <?php

                    $i=0;
                
                    $get_products = "select * from products order by 1 DESC";
                    
                    $run_products = mysqli_query($conn, $get_products);

                    while ($row_products = mysqli_fetch_array($run_products)){

                        $product_id = $row_products['product_id'];

                        $product_title = $row_products['product_title'];

                        $product_image_1 = $row_products['product_image_1'];

                        $product_price = $row_products['product_price'];
                        $product_price_format = number_format($product_price, 0, ',', '.');

                        $product_keywords = $row_products['product_keywords'];

                        $product_date = $row_products['date'];

                        $product_label = $row_products['product_label'];

                        $product_sale = $row_products['product_sale'];
                        $product_sale_format = number_format((float)$product_sale, 0, ',', '.');

                        $product_quantity_size_s = $row_products['product_quantity_size_s'];
                        $product_quantity_size_m = $row_products['product_quantity_size_m'];
                        $product_quantity_size_l = $row_products['product_quantity_size_l'];
                        $i++;

                ?>
                <tr>
                    <td data-label="STT"><?php echo $i;?></td>
                    <td data-label="Tên sản phẩm"><?php echo $product_title; ?></td>
                    <td data-label="Hình ảnh"><img src="<?php echo $product_image_1; ?>"
                            alt="<?php echo $product_image_1; ?>"></td>
                    <td data-label="Giá SP">
                        <?php

                            if ($product_label == "sale") {

                                echo $product_sale_format;

                            } else {

                                echo $product_price_format;
                            }
                        
                        ?>

                        ₫</td>
                    <td>
                        <p>Size S:<?=$product_quantity_size_s;?></p>
                        <p>Size M:<?=$product_quantity_size_s;?></p>
                        <p>Size L:<?=$product_quantity_size_s;?></p>
                    </td>
                    <td data-label="Đã bán">
                        <?php 
                                
                            $get_sold = "select * from customer_orders where product_id='$product_id'";

                            $run_sold = mysqli_query($conn, $get_sold);

                            $count = mysqli_num_rows($run_sold);
                            
                            $total_quantity = 0;

                            //echo $count;
                            while ($row_sold = mysqli_fetch_array($run_sold)) {

                                $product_quantity = $row_sold['product_quantity'];

                                $total_quantity = $total_quantity + $product_quantity;

                            }
                            
                            echo $total_quantity;
                            
                        ?>
                    </td>
                    <td data-label="Từ khoá"><?php echo $product_keywords; ?></td>
                    <td data-label="Thời gian"><?php echo $product_date; ?></td>
                    <td data-label="Sửa" class="right__iconTable"><a
                            href="index.php?edit_product=<?php echo $product_id; ?>"><img src="assets/icon-edit.svg"
                                alt=""></a></td>
                    <td data-label="Xoá" class="right__iconTable"><a
                            href="index.php?delete_product=<?php echo $product_id; ?>"><img
                                src="assets/icon-trash-black.svg" alt=""></a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<?php } ?>