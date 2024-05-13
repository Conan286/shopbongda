<?php

    include("../includes/db.php");

?>

<div class="tableWrapper">
    <h3 class="sectionTitle">đơn hàng</h3>
    <table>
        <thead>
            <tr>
                <th colspan="2">Sản phẩm</th>
                <th>Giá</th>
                <th>Số hoá đơn</th>
                <th>Số lượng</th>
                <th>Kích thước</th>
                <th>Ngày</th>
                <th>Thanh toán</th>
                <th>Hủy đơn</th>
            </tr>
        </thead>

        <tbody>
            <?php

                $session_email = $_SESSION['customer_email'];
                $get_customer = "SELECT * FROM customers WHERE customer_email='$session_email'";
                $run_customer = mysqli_query($conn, $get_customer);
                $row_customer = mysqli_fetch_array($run_customer);
                $customer_id = $row_customer['customer_id'];
                $get_orders = "SELECT * FROM customer_orders WHERE customer_id='$customer_id' order by 1 DESC";
                $run_orders = mysqli_query($conn, $get_orders);
                while ($row_orders = mysqli_fetch_array($run_orders)) {
                    $order_id = $row_orders['order_id'];
                    $due_amount = $row_orders['due_amount'];
                    $due_amount_format = number_format($due_amount, 0, ',', '.');
                    $invoice_no = $row_orders['invoice_no'];
                    $product_id = $row_orders['product_id'];
                    $product_size = $row_orders['product_size'];
                    $product_quantity = $row_orders['product_quantity'];
                    $order_date = $row_orders['order_date'];
                    $order_status = $row_orders['order_status'];
                    if ($order_status=="Pending") {
                        $order_status = 'Chưa';
                    } else {
                        $order_status = 'Rồi';
                    }

                    $get_products = "SELECT * FROM products WHERE product_id='$product_id'";
                    $run_products = mysqli_query($conn, $get_products);
                    while ($row_products = mysqli_fetch_array($run_products)) {
                        $product_title = $row_products['product_title'];
                        $product_id = $row_products['product_id'];
                        $product_image_1 = $row_products['product_image_1'];
            ?>
            <tr>
                <td data-label="Sản phẩm"><img src="../admin/<?= $product_image_1; ?>" alt=""></td>
                <td data-label="Tên sản phẩm"><a class="tableTitle"
                        href="../details.php?product_id=<?= $product_id; ?>"><?= $product_title; ?></a></td>
                <td data-label="Tiền đến hạn"><?= $due_amount_format; ?> ₫</td>
                <td data-label="Số hoá đơn"><?= $invoice_no; ?></td>
                <td data-label="Số lượng"><?= $product_quantity; ?></td>
                <td data-label="Kích thước">
                    <?php if($product_size==1): ?>
                    <?php echo 'S';?>
                    <?php elseif($product_size==2): ?>
                    <?php echo 'M';?>
                    <?php elseif($product_size==3): ?>
                    <?php echo 'L';?>
                    <?php endif; ?>
                </td>
                <td data-label="Ngày"><?= $order_date; ?></td>
                <td><?= $order_status; ?></td>
                <td>
                    <?php if($row_orders['order_status'] == "Complete"): ?>
                    <?php else: ?>
                    <a href="my_account.php?delete=<?=$order_id; ?>" class="delete-btn"
                        title="xoa_san_pham_khoi_gio_hang">Huỷ</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php } } ?>
        </tbody>
    </table>
</div>
<style>
.delete-btn {
    display: inline-block;
    padding: 10px;
    background-color: black;
    color: white;
    text-decoration: none;
    border-radius: 5px;
}
</style>