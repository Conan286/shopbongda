<?php 
    
    if (!isset($_SESSION['admin_email'])) {
        
        echo "<script>window.open('login.php','_self')</script>";
        
    } else {

?>

<div class="right__title">Bảng điều khiển</div>
<p class="right__desc">Xem slides</p>
<div class="right__slidesWrapper">
    <div class="right__slides">

        <?php 
            
            $get_slides = "select * from slides";

            $run_slides = mysqli_query($conn, $get_slides);

            while ($row_slides = mysqli_fetch_array($run_slides)) {
                
                $slide_id = $row_slides['slide_id'];
                
                $slide_image = $row_slides['slide_image'];
        
        ?>
        <div class="right__slide">

            <div class="right__slideImage"><img src="<?php echo $slide_image; ?>" alt=""></div>
            <div class="right__slideIcons">
                <a class="right__slideIcon" href="index.php?edit_slide=<?php echo $slide_id; ?>"><img src="assets/icon-pencil.svg" alt=""></a>
                <a class="right__slideIcon" href="index.php?delete_slide=<?php echo $slide_id; ?>"><img src="assets/icon-trash.svg" alt=""></a>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<?php } ?>