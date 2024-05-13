<?php 
    
    if (!isset($_SESSION['admin_email'])) {
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>

<div class="right__title">Bảng điều khiển</div>
<p class="right__desc">Xem thể loại</p>
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

                    $get_cats = "select * from categories";

                    $run_cats = mysqli_query($conn, $get_cats);

                    while ($row_cats = mysqli_fetch_array($run_cats)) {
                        
                        $cat_id = $row_cats['category_id'];
                        
                        $cat_title = $row_cats['category_title'];
                        
                        $cat_desc = $row_cats['category_desc'];
                        
                        $i++;
                
                ?>
                <tr>
                    <td data-label="STT"><?php echo $i; ?></td>
                    <td data-label="Tiêu đề"><?php echo $cat_title; ?></td>
                    <td data-label="Mô tả"><?php echo $cat_desc; ?></td>
                    <td data-label="Sửa" class="right__iconTable"><a href="index.php?edit_cat=<?php echo $cat_id; ?>"><img src="assets/icon-edit.svg" alt=""></a></td>
                    <td data-label="Xoá" class="right__iconTable"><a href="index.php?delete_cat=<?php echo $cat_id; ?>"><img src="assets/icon-trash-black.svg" alt=""></a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php } ?>