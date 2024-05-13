<?php 
    
    if (!isset($_SESSION['admin_email'])) {
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>

<?php 

    if (isset($_GET['delete_customer'])) {
        
        $delete_id = $_GET['delete_customer'];

        $get_c = "select * from customers where customer_id='$delete_id'";

        $run_c = mysqli_query($conn, $get_c);

        $row_c = mysqli_fetch_array($run_c);

            $c_image = $row_c['customer_image'];
        
        unlink("../customer/customer_images/$c_image");
        
        $delete_c = "delete from customers where customer_id='$delete_id'";
        
        $run_delete = mysqli_query($conn, $delete_c);
        
        if ($run_delete) {
            
            echo "<script>alert('Xoá Thành Công')</script>";
            
            echo "<script>window.open('index.php?view_customers','_self')</script>";
            
        }
        
    }

?>
<?php } ?>