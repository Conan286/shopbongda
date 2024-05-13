<?php 
    
    if (!isset($_SESSION['admin_email'])) {
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

        
?>

<div class="right__title">Bảng điều khiển</div>
<p class="right__desc">Xem đơn hàng</p>
<div class="right__table">
    <div class="right__tableWrapper">
        <table id="example">
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Email</th>
                    <th>Số hoá đơn</th>
                    <th>Tên sản phẩm</th>
                    <th>Số lượng</th>
                    <th>Kích cở</th>
                    <th>Ngày</th>
                    <th>Tổng</th>
                    <th>Trạng thái</th>
                    <th>Xoá</th>
                    <th>In</th>
                    <th>Thanh toán</th>
                </tr>
            </thead>

            <tbody>

                <?php 

                    $i=0;
                
                    $get_orders = "SELECT * FROM customer_orders";
                    
                    $run_orders = mysqli_query($conn, $get_orders);

                    while ($row_order=mysqli_fetch_array($run_orders)){
                        
                        $order_id = $row_order['order_id'];
                        
                        $customer_id = $row_order['customer_id'];
                        
                        $order_amount = $row_order['due_amount'];
                        $order_amount_format = number_format($order_amount, 0, ',', '.');
                        
                        $invoice_no = $row_order['invoice_no'];
                        
                        $product_id = $row_order['product_id'];
                        
                        $product_size = $row_order['product_size'];
                        
                        $product_quantity = $row_order['product_quantity'];
                        
                        $order_date = $row_order['order_date'];
                        
                        $order_status = $row_order['order_status'];
                        
                        $get_products = "SELECT * FROM products WHERE product_id='$product_id'";
                        
                        $run_products = mysqli_query($conn, $get_products);
                        
                        $row_products = mysqli_fetch_array($run_products);
                        
                            $product_title = $row_products['product_title'];
                        
                        $get_customer = "SELECT * FROM customers WHERE customer_id='$customer_id'";
                        
                        $run_customer = mysqli_query($conn, $get_customer);
                        
                        $row_customer = mysqli_fetch_array($run_customer);
                        
                            $customer_email = $row_customer['customer_email'];
                        
                        $i++;
                
                ?>
                <tr>
                    <td data-label="STT"><?= $i; ?></td>
                    <td data-label="Email"><?= $customer_email; ?></td>
                    <td data-label="Số hoá đơn"><?= $invoice_no; ?></td>
                    <td data-label="Tên sản phẩm"><?= $product_title; ?></td>
                    <td data-label="Số lượng"><?= $product_quantity; ?></td>
                    <td data-label="Kích cở"><?= $product_size; ?></td>
                    <td data-label="Ngày"><?= $order_date; ?></td>
                    <td data-label="Tổng"><?= $order_amount_format; ?> ₫</td>
                    <td data-label="Trạng thái">
                        <?php 
                                    
                        if($order_status=='Pending') {
                            
                            echo $order_status='Đang Chờ Xử Lý';
                            
                        } else {
                            
                            echo $order_status='Hoàn Thành';
                            
                        }
                                
                    ?>
                    </td>
                    <td data-label="Xoá" class="right__iconTable"><a
                            href="index.php?delete_order=<?= $order_id; ?>"><img src="assets/icon-trash-black.svg"
                                alt=""></a></td>
                    <td>
                        <a href="view_orders_in.php?code_orders=<?= $invoice_no; ?>" target="_blank">In</a>

                    </td>
                    <td data-label="Thanh toán" class="right__confirm">
                        <a href="index.php?confirm_yes=<?= $order_id; ?>" class="right__iconTable"><img
                                src="assets/icon-check.svg" alt=""></a>
                        <a href="index.php?confirm_no=<?= $order_id; ?>" class="right__iconTable"><img
                                src="assets/icon-x.svg" alt=""></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php } ?>