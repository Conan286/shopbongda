<?php 
    
    if (!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>
<?php
    $get_products_size = "SELECT * FROM products_quantity_size";
    $run_products_size = mysqli_query($conn, $get_products_size);

    $get_name_product = "SELECT products_quantity_size.product_id,products.product_title FROM products_quantity_size INNER JOIN products ON products_quantity_size.product_id = products.product_id ";
    $query_list_name = mysqli_query($conn, $get_name_product);
?>
<div class="right__title">Bảng điều khiển</div>
<p class="right__desc">Xem sản phẩm</p>
<a href="index.php?insert_quantity_size_products" class="green-btn">Add Quantity</a>
<div class="right__table">
    <div class="right__tableWrapper">
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Sl Size S</th>
                    <th>Sl Size M</th>
                    <th>Sl Size L</th>
                </tr>
            </thead>

            <tbody>
                <?php
                $i = 0;
                if ($query_list_name->num_rows > 0) {
                    while ($item = $query_list_name->fetch_assoc()) {
                        $product_id = $item["product_id"];
                        $product_title = $item["product_title"];
                        $name_quantity_product[$product_id] = $product_title;
                    }
                }
                foreach ($run_products_size as $value) :
                    $product_id = $value["product_id"];
                    $product_title = isset($name_quantity_product[$product_id]) ? $name_quantity_product[$product_id] : '';
                    extract($value);
                    $i++;
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$product_title;?></td>
                    <td><?=$product_quantity_s;?></td>
                    <td><?=$product_quantity_m;?></td>
                    <td><?=$product_quantity_l;?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php } ?>

<style>
.green-btn {
    background-color: #2a4bf1;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 4px;
}
</style>