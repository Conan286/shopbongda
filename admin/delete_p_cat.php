<?php 
    
    if (!isset($_SESSION['admin_email'])) {
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>

<?php 

    if (isset($_GET['delete_p_cat'])) {
        
        $delete_p_cat_id = $_GET['delete_p_cat'];
        
        $delete_p_cat = "delete from product_categories where product_category_id='$delete_p_cat_id'";
        
        $run_delete = mysqli_query($conn, $delete_p_cat);
        
        if($run_delete) {
            
            echo "<script>alert('Đã Xoá Thành Công')</script>";
            
            echo "<script>window.open('index.php?view_p_categories','_self')</script>";
            
        }
        
    }

?>

<?php } ?>