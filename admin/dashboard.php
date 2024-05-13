<div class="right__title">Bảng điều khiển</div>
<p class="right__desc">Bảng điều khiển</p>
<div class="right__cards">
    <a class="right__card" href="index.php?view_products">
        <div class="right__cardTitle">Sản Phẩm</div>
        <div class="right__cardNumber"><?= $count_products; ?></div>
        <div class="right__cardDesc">Xem Chi Tiết <img src="assets/arrow-right.svg" alt=""></div>
    </a>
    <a class="right__card" href="index.php?view_customers">
        <div class="right__cardTitle">Khách Hàng</div>
        <div class="right__cardNumber"><?= $count_customers; ?></div>
        <div class="right__cardDesc">Xem Chi Tiết <img src="assets/arrow-right.svg" alt=""></div>
    </a>
    <a class="right__card" href="index.php?view_p_categories">
        <div class="right__cardTitle">Danh Mục</div>
        <div class="right__cardNumber"><?= $count_product_category; ?></div>
        <div class="right__cardDesc">Xem Chi Tiết <img src="assets/arrow-right.svg" alt=""></div>
    </a>
    <a class="right__card" href="index.php?view_orders">
        <div class="right__cardTitle">Đơn Hàng</div>
        <div class="right__cardNumber"><?= $count_customer_orders; ?></div>
        <div class="right__cardDesc">Xem Chi Tiết <img src="assets/arrow-right.svg" alt=""></div>
    </a>
    <a class="right__card" href="index.php?view_revenue">
        <div class="right__cardTitle">Tổng doanh thu</div>
        <div class="right__cardNumber"><?= $count_customer_orders; ?></div>
        <div class="right__cardDesc">Xem Chi Tiết <img src="assets/arrow-right.svg" alt=""></div>
    </a>
</div>
<div class="right__table">
    <p class="right__tableTitle">Đơn hàng mới</p>
    <div class="right__tableWrapper">
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th style="text-align: left;">Email</th>
                    <th>Số Hoá Đơn</th>
                    <th>ID Sản Phẩm</th>
                    <th>Số Lượng</th>
                    <th>Kích thước</th>
                    <th>Trạng Thái</th>
                </tr>
            </thead>

            <tbody>

                <?php

                $i = 0;

                $get_order = "select * from customer_orders order by 1 DESC LIMIT 0,5";

                $run_order = mysqli_query($conn, $get_order);

                while ($row_order = mysqli_fetch_array($run_order)) {

                    $order_id = $row_order['order_id'];

                    $customer_id = $row_order['customer_id'];

                    $invoice_no  = $row_order['invoice_no'];

                    $product_id  = $row_order['product_id'];

                    $product_quantity = $row_order['product_quantity'];

                    $product_size = $row_order['product_size'];

                    $order_status = $row_order['order_status'];

                    $i++;

                ?>
                <tr>
                    <td data-label="STT"><?= $i; ?></td>
                    <td data-label="Email" style="text-align: left;">
                        <?php

                            $get_customer = "select * from customers where customer_id='$customer_id'";

                            $run_customer = mysqli_query($conn, $get_customer);

                            $row_customer = mysqli_fetch_array($run_customer);
                            
                            $customer_email = $row_customer['customer_email'];

                            echo $customer_email;
                            ?>
                    </td>
                    <td data-label="Số Hoá Đơn"><?= $invoice_no; ?></td>
                    <td data-label="ID Sản Phẩm"><?= $product_id; ?></td>
                    <td data-label="Số Lượng"><?= $product_quantity; ?></td>
                    <td data-label="Kích thước"><?= $product_size; ?></td>
                    <td data-label="Trạng Thái">
                        <?php

                            if ($order_status == 'Pending') {

                                echo $order_status = 'Đang Xử Lý';
                            } else {

                                echo $order_status = 'Đã Thanh Toán';
                            }

                            ?>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <a href="index.php?view_orders" class="right__tableMore">
        <p>Xem tất cả các đơn đặt hàng</p> <img src="assets/arrow-right-black.svg" alt="">
    </a>
</div>