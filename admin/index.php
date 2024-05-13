<?php

    session_start();

    include("../includes/db.php");

    if (!isset($_SESSION['admin_email'])) {

        echo "<script>window.open('login.php','_self')</script>";

    } else {
    
        $admin_session = $_SESSION['admin_email'];

        $get_admin = "select * from admins where admin_email='$admin_session'";
        
        $run_admin = mysqli_query($conn,$get_admin);

        $row_admin = mysqli_fetch_array($run_admin);

            $admin_id = $row_admin['admin_id'];

            $admin_name = $row_admin['admin_name'];

            $admin_email = $row_admin['admin_email'];

            $admin_image = $row_admin['admin_image'];


        $get_products = "select * from products";

        $run_products = mysqli_query($conn,$get_products);

        $count_products = mysqli_num_rows($run_products);


        $get_customers = "select * from customers";

        $run_customers = mysqli_query($conn, $get_customers);

        $count_customers = mysqli_num_rows($run_customers);


        $get_product_category = "select * from product_categories";

        $run_product_category = mysqli_query($conn, $get_product_category);

        $count_product_category = mysqli_num_rows($run_product_category);
        

        $get_customer_orders = "select * from customer_orders";

        $run_customer_orders = mysqli_query($conn, $get_customer_orders);

        $count_customer_orders = mysqli_num_rows($run_customer_orders);

    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <div class="wrapper">
        <div class="container">
            <div class="dashboard">
                <div class="left">
                    <span class="left__icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                    <div class="left__content">
                        <div class="left__logo">
                            Trang Admin
                        </div>
                        <div class="left__profile">
                            <div class="left__image"><img src="admin_images/<?php echo $admin_image; ?>" alt=""></div>
                            <p class="left__name"><?php echo $admin_name; ?></p>
                        </div>
                        <ul class="left__menu">
                            <li class="left__menuItem">
                                <a href="index.php?dashboard" class="left__title"><img src="assets/icon-dashboard.svg"
                                        alt="">Dashboard</a>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-tag.svg" alt="">Tồn kho<img
                                        class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="index.php?view_quantity_size_products">Số lượng Sản
                                        Phẩm</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-tag.svg" alt="">Sản Phẩm<img
                                        class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="index.php?insert_products">Chèn Sản Phẩm</a>
                                    <a class="left__link" href="index.php?view_products">Xem Sản Phẩm</a>
                                    <a class="left__link" href="index.php?view_quantity_size_products">Số lượng Sản
                                        Phẩm</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-edit.svg" alt="">Danh Mục SP<img
                                        class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="index.php?insert_p_category">Chèn Danh Mục</a>
                                    <a class="left__link" href="index.php?view_p_categories">Xem Danh Mục</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-book.svg" alt="">Thể Loại<img
                                        class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="index.php?insert_category">Chèn Thể Loại</a>
                                    <a class="left__link" href="index.php?view_categories">Xem Thể Loại</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-settings.svg" alt="">Slide<img
                                        class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="index.php?insert_slide">Chèn Slide</a>
                                    <a class="left__link" href="index.php?view_slides">Xem Slide</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-book.svg" alt="">Coupons<img
                                        class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="index.php?insert_coupon">Chèn Coupon</a>
                                    <a class="left__link" href="index.php?view_coupons">Xem Coupons</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <a href="index.php?view_customers" class="left__title"><img src="assets/icon-users.svg"
                                        alt="">Khách Hàng</a>
                            </li>
                            <li class="left__menuItem">
                                <a href="index.php?view_orders" class="left__title"><img src="assets/icon-book.svg"
                                        alt="">Đơn Đặt Hàng</a>
                            </li>
                            <li class="left__menuItem">
                                <div class="left__title"><img src="assets/icon-user.svg" alt="">Admin<img
                                        class="left__iconDown" src="assets/arrow-down.svg" alt=""></div>
                                <div class="left__text">
                                    <a class="left__link" href="index.php?insert_user">Chèn Admin</a>
                                    <a class="left__link" href="index.php?view_users">Xem Admins</a>
                                </div>
                            </li>
                            <li class="left__menuItem">
                                <a href="logout.php" class="left__title"><img src="assets/icon-logout.svg" alt="">Đăng
                                    Xuất</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="right">
                    <div class="right__content">

                        <?php 
        
                        //dashboard
        
                        if(isset($_GET['dashboard'])){
        
                            include("dashboard.php");
        
                        }
                        
                        //products
        
                        if(isset($_GET['insert_products'])){
        
                            include("insert_product.php");
        
                        }
                        
                        if(isset($_GET['view_products'])){
        
                            include("view_products.php");
        
                        }

                        if(isset($_GET['view_quantity_size_products'])){
        
                            include("view_quantity_size_products.php");
        
                        }

                        if(isset($_GET['insert_quantity_size_products'])){
        
                            include("insert_quantity_size_products.php");
        
                        }
                        
                        if(isset($_GET['delete_product'])){
        
                            include("delete_product.php");
        
                        }
                        
                        if(isset($_GET['edit_product'])){
        
                            include("edit_product.php");
        
                        }
                        
                        // product_categories
                        
                        if(isset($_GET['view_p_categories'])){
        
                            include("view_p_categories.php");
        
                        }
                        
                        if(isset($_GET['insert_p_category'])){
        
                            include("insert_p_category.php");
        
                        }
                        
                        if(isset($_GET['delete_p_cat'])){
        
                            include("delete_p_cat.php");
        
                        }
                        
                        if(isset($_GET['edit_p_cat'])){
        
                            include("edit_p_cat.php");
        
                        }
                        
                        // categories
        
                        if(isset($_GET['view_categories'])){
        
                            include("view_categories.php");
        
                        }
                        
                        if(isset($_GET['insert_category'])){
        
                            include("insert_category.php");
        
                        }
                        
                        if(isset($_GET['edit_cat'])){
        
                            include("edit_cat.php");
        
                        }
                        
                        if(isset($_GET['delete_cat'])){
        
                            include("delete_cat.php");
        
                        }
                        
                        // slides
                        
                        if(isset($_GET['insert_slide'])){
        
                            include("insert_slide.php");
        
                        }
                        
                        if(isset($_GET['view_slides'])){
        
                            include("view_slides.php");
        
                        }
                        
                        if(isset($_GET['delete_slide'])){
        
                            include("delete_slide.php");
        
                        }
                        
                        if(isset($_GET['edit_slide'])){
        
                            include("edit_slide.php");
        
                        }
                        
                        // coupons
                        
                        if(isset($_GET['insert_coupon'])){
        
                            include("insert_coupon.php");
        
                        }
                        
                        if(isset($_GET['view_coupons'])){
        
                            include("view_coupons.php");
        
                        }
                        
                        if(isset($_GET['delete_coupon'])){
        
                            include("delete_coupon.php");
        
                        }
                        
                        if(isset($_GET['edit_coupon'])){
        
                            include("edit_coupon.php");
        
                        }
        
                        // customers
        
                        if(isset($_GET['view_customers'])){
        
                            include("view_customers.php");
        
                        }
                        
                        if(isset($_GET['delete_customer'])){
        
                            include("delete_customer.php");
        
                        }
        
                        // order
                        
                        if(isset($_GET['view_orders'])){
        
                            include("view_orders.php");
        
                        }
                        
                        if(isset($_GET['delete_order'])){
        
                            include("delete_order.php");
        
                        }
                        
                        if(isset($_GET['confirm_yes'])){
        
                            include("confirm_yes.php");
        
                        }
                        
                        if(isset($_GET['confirm_no'])){
        
                            include("confirm_no.php");
        
                        }
        
                        // user admin
                        
                        if(isset($_GET['view_users'])){
        
                            include("view_users.php");
        
                        }
                        
                        if(isset($_GET['delete_user'])){
        
                            include("delete_user.php");
        
                        }
                        
                        if(isset($_GET['user_profile'])){
        
                            include("user_profile.php");
        
                        }
                        
                        if(isset($_GET['insert_user'])){
        
                            include("insert_user.php");
        
                        }
        
                        // CSS Editor
        
                        if(isset($_GET['edit_css'])){
        
                            include("edit_css.php");
        
                        }

                        // CSS Editor
        
                        if(isset($_GET['view_revenue'])){
        
                            include("view_revenue.php");
        
                        }
        
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="js/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
    $(document).ready(function() {
        $('#example').DataTable();
    });
    </script>
</body>

</html>
<?php } ?>