<?php 
    
    if (!isset($_SESSION['admin_email'])) {
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>

<?php 

    if (isset($_GET['delete_cat'])) {
        
        $delete_cat_id = $_GET['delete_cat'];
        
        $delete_cat = "delete from categories where category_id='$delete_cat_id'";
        
        $run_delete = mysqli_query($conn, $delete_cat);
        
        if ($run_delete) {
            
            echo "<script>alert('Xoá Thành Công')</script>";
            
            echo "<script>window.open('index.php?view_categories','_self')</script>";
            
        }
        
    }

?>

<?php } ?>