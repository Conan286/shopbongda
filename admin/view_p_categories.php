<?php 
    
    if (!isset($_SESSION['admin_email'])){
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>

<div class="right__title">Bảng điều khiển</div>
<p class="right__desc">Xem danh mục</p>
<div class="right__table">
    <div class="right__tableWrapper">
        <table>
            <thead>
                <tr>
                    <th>STT</th>
                    <th>Tiêu đề</th>
                    <th>Mô tả</th>
                    <th>Sửa</th>
                    <th>Xoá</th>
                </tr>
            </thead>
    
            <tbody>
                            
                <?php 
                
                    $i=0;

                    $get_p_categories = "select * from product_categories order by 1 DESC";

                    $run_p_categories = mysqli_query($conn, $get_p_categories);

                    while ($row_categories = mysqli_fetch_array($run_p_categories)) {
                        
                        $product_category_id = $row_categories['product_category_id'];
                        
                        $product_category_title = $row_categories['product_category_title'];
                        
                        $product_category_desc = $row_categories['product_category_desc'];
                        
                        $i++;
                
                ?>
                <tr>
                    <td data-label="STT"><?php echo $i; ?></td>
                    <td data-label="Tiêu đề"><?php echo $product_category_title; ?></td>
                    <td data-label="Mô tả"><?php echo $product_category_desc; ?></td>
                    <td data-label="Sửa" class="right__iconTable"><a href="index.php?edit_p_cat=<?php echo $product_category_id; ?>"><img src="assets/icon-edit.svg" alt=""></a></td>
                    <td data-label="Xoá" class="right__iconTable"><a href="index.php?delete_p_cat=<?php echo $product_category_id; ?>"><img src="assets/icon-trash-black.svg" alt=""></a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php } ?>