<?php 
    
    if (!isset($_SESSION['admin_email'])) {
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>

<?php 

    if (isset($_GET['delete_slide'])) {
        
        $delete_slide_id = $_GET['delete_slide'];

        $get_slide = "select * from slides where slide_id='$delete_slide_id'";

        $run_slide = mysqli_query($conn, $get_slide);

        $row_slide = mysqli_fetch_array($run_slide);

            $slide_image = $row_slide['slide_image'];

        unlink($slide_image);
        
        $delete_slide = "delete from slides where slide_id='$delete_slide_id'";
        
        $run_delete = mysqli_query($conn, $delete_slide);
        
        if ($run_delete) {
            
            echo "<script>alert('Xoá Thành Công')</script>";
            
            echo "<script>window.open('index.php?view_slides','_self')</script>";
            
        }
        
    }

?>


<?php } ?>