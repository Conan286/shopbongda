<?php

    // session_set_cookie_params('86400');
    session_start();
    include("includes/db.php");
    include("functions/functions.php");

?>
<?php 
include "VnpayClass.php";
$payment = new payment;
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$invoice_no = $_POST['invoice_no'];
$product_total_price = $_POST['product_total_price'];
$customer_id = $_POST['customer_id'];

$payment-> vnpay_payment($invoice_no,$product_total_price);
}
?>

<?php error_reporting(0);?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lalla | Giỏ hàng</title>
    <!--css files-->
    <link rel="stylesheet" href="css/cart.css">
    <link rel="shortcut icon" href="assets/favicon.ico">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-137426789-2"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-137426789-2');
    </script>

</head>

<body>
    <!--Navigation-->
    <?php
        include 'nav.php';
    ?>
    <!--end Navigation-->

    <!--Content-->
    <div class="wrapper">
        <div class="content">
            <section class="left">
                <form action="cart.php" method="post" enctype="multipart/form-data">
                    <div class="tableWrapper">
                        <div class="sectionTitleWrapper">
                            <h3 class="sectionTitle">Giỏ Hàng</h3>
                        </div>
                        <table>
                            <thead>
                                <tr>
                                    <th colspan="2">Sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Đơn giá</th>
                                    <th>Kích thước</th>
                                    <th>Xoá</th>
                                    <!-- <th>Giá</th> -->
                                    <th>Tạm tính</th>

                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                    $ip_add = getRealIpUser();
                                    $session_email = $_SESSION['customer_email'];
                                    $get_customer = "select * from customers where customer_email='$session_email'";
                                    $run_customer = mysqli_query($conn, $get_customer);
                                    $row_customer = mysqli_fetch_array($run_customer);
                                    $customer_id = $row_customer['customer_id'];  
                                    $get_cart = "SELECT * FROM cart WHERE ip_add='$customer_id '";
                                    $run_cart = mysqli_query($conn, $get_cart);
                                    $count_cart = mysqli_num_rows($run_cart);
                                    $total = 0;
                                    while ($row_cart = mysqli_fetch_array($run_cart)) {
                                        $product_id = $row_cart['product_id'];
                                        $cart_id = $row_cart['cart_id'];
                                        $product_size = $row_cart['p_size'];
                                        $product_price = $row_cart['p_price'];
                                        $product_price_format = number_format($product_price, 0, ',', '.');
                                        $product_quantity = $row_cart['p_quantity'];
                                        $get_products = "SELECT * FROM products WHERE product_id='$product_id'";
                                        $run_products = mysqli_query($conn, $get_products);
                                        while ($row_products = mysqli_fetch_array($run_products)) {

                                            $product_title = $row_products['product_title'];

                                            $product_image_1 = $row_products['product_image_1'];

                                            $sub_total = $product_price*$product_quantity;
                                            $sub_total_format = number_format($sub_total, 0, ',', '.');

                                            $_SESSION['product_quantity'] = $product_quantity;

                                            $total = $total+$sub_total;
                                            $total_format = number_format($total, 0, ',', '.');


                                ?>
                                <tr>
                                    <td data-label="Sản phẩm">
                                        <img src="admin/<?= $product_image_1; ?>" alt="">
                                    </td>
                                    <td data-label="Tên sản phẩm">
                                        <a class="tableTitle" href="details.php?product_id=<?= $product_id; ?>">
                                            <?= $product_title; ?>
                                        </a>
                                    </td>
                                    <td data-label="Số lượng">
                                        <input class="quantity inputNumber" type="text" name="quantity"
                                            data-product_id="<?= $product_id; ?>"
                                            value="<?= $_SESSION['product_quantity']; ?>">
                                    </td>
                                    <td data-label="Đơn giá">
                                        <?php 
                                            if ($count_cart == "") {

                                            } else {
                                                echo $product_price_format.' ₫';
                                            }
                                        ?>
                                    </td>
                                    <td data-label="Kích thước">
                                        <?php if($product_size==1): ?>
                                        <?php echo 'S';?>
                                        <?php elseif($product_size==2): ?>
                                        <?php echo 'M';?>
                                        <?php elseif($product_size==3): ?>
                                        <?php echo 'L';?>
                                        <?php endif; ?>

                                    </td>
                                    <td>
                                        <a href="cart.php?remove_from_cart=<?= $cart_id; ?>"
                                            title="xoa_san_pham_khoi_gio_hang">Xóa</a>
                                    </td>
                                    <!-- <td data-label="Xoá">
                                        <input class="inputCheckBox" type="checkbox" id="check" name="remove[]"
                                            value="?= $product_id; ?>">
                                        <label for="check"></label>
                                    </td> -->
                                    <td data-label="Giá">
                                        <?php 
                                            if ($count_cart == "") {
                                            } else {
                                                echo $sub_total_format.' ₫';
                                            }
                                        ?>
                                    </td>
                                </tr>
                            </tbody>

                            <?php } } ?>

                            <!--end tbody-->

                            <tfoot>
                                <tr>
                                    <td class="totalPriceTitle" colspan="5">
                                        <?php 
                                            if ($count_cart == "") {
                                                
                                            } else {
                                                echo 'Tổng giá';
                                            }
                                        ?>
                                    </td>
                                    <td class="totalPrice" data-label="Tổng giá" colspan="2">
                                        <?php 
                                            if ($count_cart == "") {
                                                
                                            } else {
                                                echo $total_format.' ₫';
                                            }
                                        ?>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <?php
                        if (isset($_GET['remove_from_cart'])) {
                            remove_from_cart();
                        }

                        function remove_from_cart() {
                            global $conn;
                            
                            if (isset($_GET['remove_from_cart'])) {
                                $remove_id = $_GET['remove_from_cart'];

                                $select_product = "SELECT * FROM cart WHERE cart_id=?";
                                $stmt = mysqli_prepare($conn, $select_product);
                                mysqli_stmt_bind_param($stmt, "i", $remove_id);
                                mysqli_stmt_execute($stmt);
                                $result = mysqli_stmt_get_result($stmt);
                                $row = mysqli_fetch_assoc($result);

                                $product_id = $row['product_id'];
                                $product_size = $row['p_size'];
                                $product_quantity = $row['p_quantity'];

                                $column = "";
                                switch ($product_size) {
                                    case '1':
                                        $column = "product_quantity_size_s";
                                        break;
                                    case '2':
                                        $column = "product_quantity_size_m";
                                        break;
                                    case '3':
                                        $column = "product_quantity_size_l";
                                        break;
                                    default:
                                        break;
                                }

                                $column_all = "";
                                switch ($product_size) {
                                    case '1':
                                        $column_all = "product_quantity_s";
                                        break;
                                    case '2':
                                        $column_all = "product_quantity_m";
                                        break;
                                    case '3':
                                        $column_all = "product_quantity_l";
                                        break;
                                    default:
                                        break;
                                }

                                if ($column !== "" && $column_all !== "") {
                                    $update_quantity = "UPDATE products SET $column = $column + $product_quantity WHERE product_id=?";
                                    $stmt = mysqli_prepare($conn, $update_quantity);
                                    mysqli_stmt_bind_param($stmt, "i", $product_id);
                                    $update_success_products = mysqli_stmt_execute($stmt);

                                    $update_quantity_all = "UPDATE products_quantity_size SET $column_all = $column_all + $product_quantity WHERE product_id=?";
                                    $stmt_all = mysqli_prepare($conn, $update_quantity_all);
                                    mysqli_stmt_bind_param($stmt_all, "i", $product_id);
                                    $update_success_quantity = mysqli_stmt_execute($stmt_all);

                                    if ($update_success_products && $update_success_quantity) {
                                        $delete_cart_id_product = "DELETE FROM cart WHERE cart_id=?";
                                        $stmt = mysqli_prepare($conn, $delete_cart_id_product);
                                        mysqli_stmt_bind_param($stmt, "i", $remove_id);
                                        $delete_success_one = mysqli_stmt_execute($stmt);

                                        if ($delete_success_one) {
                                            echo "<script>alert('Đã xóa sản phẩm khỏi giỏ hàng');</script>";
                                            echo "<script>window.open('cart.php','_self')</script>";
                                        } else {
                                            echo "Xóa không thành công"; 
                                        }
                                    } else {
                                        echo "Cập nhật số lượng sản phẩm thất bại";
                                    }
                                }
                            }
                        }
                        ?>

                    <!--Coupon-->

                    <div class="coupon">
                        <label for="coupon">Mã giảm giá</label>
                        <div class="couponWrapper">
                            <input type="text" id="coupon" name="code">
                            <button type="submit" name="apply_coupon" class="coupon__btn"><span>Sử dụng</span></button>
                        </div>
                    </div>

                    <!--end Coupon-->

                    <!--httt-->
                    <div class="coupon">

                        <label for="coupon">Hình thức thanh toán</label>
                        <div class="couponWrapper">
                            <form action="" method="post">
                                <?php foreach ($run_cart as $key) :
                                    extract($key);
                                    $sub_total = $product_price*$product_quantity;

                                    $_SESSION['product_quantity'] = $product_quantity;

                                    $invoice_no = 'DH' . mt_rand(10000, 999999);
                                    ?>
                                <input type="hidden" name="invoice_no" value="<?=$invoice_no?>">

                                <input type="hidden" name="product_total_price" value="<?=$sub_total?>">

                                <?php endforeach; ?>
                                <button type="submit" name="redirect" class="coupon__btn"><span>
                                        Thanh toán qua VNPAY</span>
                                </button>

                            </form>
                        </div>
                    </div>
                    <!--end httt-->




                    <div class="footTable">
                        <div class="footTable__btn">
                            <a class="footTable__btnItem" href="index.php">
                                <img src="assets/icon-arrow-left.svg" alt=""> <span>Tiếp Tục Mua Sắm</span>
                            </a>
                        </div>
                        <div class="footTable__btn">
                            <!-- <button ?php 
                                    if ($count_cart == "") {
                                        echo "disabled";
                                    } else {
                                        
                                    }
                                ?> class="footTable__btnItem update" type="submit" name="update">
                                <img src="assets/icon-update.svg" alt="">
                                <span>Cập Nhật Giỏ Hàng</span>
                            </button> -->
                            <!-- php get customer_id -->

                            <?php
                                if (isset($_SESSION['customer_email'])) {
                                    $session_email = $_SESSION['customer_email'];
                                    $get_customer = "SELECT * from customers where customer_email='$session_email'";
                                    $run_customer = mysqli_query($conn, $get_customer);
                                    $row_customer = mysqli_fetch_array($run_customer);
                                        $customer_id = $row_customer['customer_id'];
                                        echo "
                                            <div class='footTable__orderWrapper'>
                                                <a class='footTable__order' href='order.php?customer_id=$customer_id'>
                                                    <span>Đặt Hàng Ngay</span>
                                                </a>
                                                <div class='footTable__image'>
                                                    <img src='assets/icon-arrow-right.svg' alt=''>
                                                </div>
                                            </div>
                                        ";
                                } else {
                                    echo "
                                        <div class='footTable__orderWrapper'>
                                            <a class='footTable__order' href='customer/login.php'>
                                                <span>Đặt Hàng Ngay</span>
                                            </a>
                                            <div class='footTable__image'>
                                                <img src='assets/icon-arrow-right.svg' alt=''>
                                            </div>
                                        </div>
                                    ";

                                }
                            
                            ?>
                            <!-- end php get customer_id -->
                        </div>
                    </div>
                </form>
            </section>

            <!-- php coupon -->
            <?php
            
                if (isset($_POST['apply_coupon'])) {

                    $code = $_POST['code'];

                    if ($code == "") {

                    } else {

                        $get_coupons = "SELECT * FROM coupons WHERE coupon_code='$code'";

                        $run_coupons = mysqli_query($conn, $get_coupons);

                        $check_coupons = mysqli_num_rows($run_coupons);

                        if ($check_coupons == "1") {

                            $row_coupons = mysqli_fetch_array($run_coupons);

                                $coupon_product_id = $row_coupons['product_id'];
                                
                                $coupon_price = $row_coupons['coupon_price'];

                                $coupon_limit = $row_coupons['coupon_limit'];

                                $coupon_used = $row_coupons['coupon_used'];

                                if ($coupon_limit == $coupon_used) {

                                    echo "<script>alert('Phiếu Giảm Giá Của Bạn Đã Hết Hạn')</script>";

                                } else {

                                    $get_cart = "SELECT * FROM cart WHERE product_id='$coupon_product_id' AND ip_add='$ip_add'";

                                    $run_cart = mysqli_query($conn, $get_cart);

                                    $check_cart = mysqli_num_rows($run_cart);

                                    if ($check_cart == "1") {

                                        $add_used = "UPDATE coupons set coupon_used=coupon_used+1 where coupon_code='$code'";

                                        $run_used = mysqli_query($conn, $add_used);

                                        $update_cart = "update cart set p_price='$coupon_price' where product_id='$coupon_product_id'";

                                        $run_update_cart = mysqli_query($conn, $update_cart);

                                        echo "<script>alert('Áp Dụng Thành Công')</script>";

                                        echo "<script>window.open('cart.php','_self')</script>";

                                    } else {

                                        echo "<script>alert('Sản Phẩm Không Áp Dụng Với Mã Giảm Giá Này')</script>";

                                    }

                                }

                        } else {

                            echo "<script>alert('Mã Giảm Giá Không Hợp Lệ')</script>";

                        }

                    }

                }
            
            ?>
            <!-- end php coupon -->


            <!-- php update_cart-->
            <?php

                function update_cart() {
                    global $conn;
                    if (isset($_POST['update'])) {
                        foreach($_POST['remove'] as $remove_id) {
                            $delete_product = "DELETE FROM cart WHERE product_id='$remove_id'";
                            $run_delete = mysqli_query($conn, $delete_product);
                            if ($run_delete) {
                                echo "<script>window.open('cart.php','_self')</script>";
                            }
                        }
                    }
                }
                echo $update_cart = update_cart();
            ?>

            <?php
                if (isset($_GET['delete_one_product_cart'])) {
                    delete_one_product_cart(); 
                }

                function delete_one_product_cart(){
                    global $conn;
                    $session_email = $_SESSION['customer_email'];
                    $get_customer = "select * from customers where customer_email='$session_email'";
                    $run_customer = mysqli_query($conn, $get_customer);
                    $row_customer = mysqli_fetch_array($run_customer);
                    $customer_id = $row_customer['customer_id'];  
                    $delete_id = $_GET['delete_one_product_cart'];

                    $delete_cart_id_product = "DELETE FROM cart WHERE ip_add=$customer_id and cart_id=?";
                    $stmt = mysqli_prepare($conn, $delete_cart_id_product);
                    mysqli_stmt_bind_param($stmt, "i", $delete_id);
                    $delete_success_one = mysqli_stmt_execute($stmt);

                    if ($delete_success_one) {
                        // Thành công: hiển thị alert và sau đó chuyển hướng về trang cart.php
                        echo "<script>alert('Đã xóa sản phẩm khỏi đơn hàng');</script>";
                        echo "<script>window.open('cart.php','_self')</script>";
                    } else {
                        // Thất bại: hiển thị thông báo lỗi
                        echo "Xóa không thành công"; 
                    }
                }
                ?>

            <!-- end php update_cart-->

            <section class="right">
                <div class="rightContent">
                    <div class="container anime">
                        <div class="receipt">
                            <div class="receipt__message">
                                <h2 class="receipt__title">Đơn hàng của bạn!</h2>
                                <p class="receipt__text">
                                    Vận chuyển và chi phí bổ sung được tính dựa trên giá trị bạn đã nhập
                                </p>
                                <a class="receipt__btn" href="customer/my_account.php?my_orders">Xem đơn hàng</a>
                            </div>
                            <!--Coupon-->
                            <div class="coupon">
                                <label for="coupon">Địa chỉ giao hàng</label>
                                <div class="cart-section-right-select">
                                    <select name="" id="city">
                                        <option value="">Tỉnh/Tp</option>
                                    </select>
                                    <select name="" id="district">
                                        <option value="">Quận/huyện</option>
                                    </select>
                                    <select name="" id="ward">
                                        <option value="">Phường/xã</option>
                                    </select>
                                </div>
                            </div>
                            <button id="submit_button">them</button>


                            <!--end Coupon-->
                            <div class="price">
                                <div class="price__pricing">
                                    <p class="price__pricingTitle">Tổng phụ</p>
                                    <p class="price__pricingNumber">
                                        <?php 
                                            if ($count_cart == "") {
                                                echo "";
                                            } else {
                                                echo $total_format.' ₫';
                                            }
                                        ?>
                                    </p>
                                </div>
                                <div class="price__pricing">
                                    <p class="price__pricingTitle">Phí vận chuyển</p>
                                    <p class="price__pricingNumber">
                                        0 ₫
                                    </p>
                                </div>
                                <div class="price__total">
                                    <p class="price__totalTitle">Tổng cộng</p>
                                    <p class="price__totalNumber">
                                        <?php 
                                            if ($count_cart == "") {
                                                echo "";
                                            } else {
                                                echo $total_format.' ₫';
                                            }
                                        ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!--Back to top-->
        <div id="scrollme">
            <div class="backtop">
                <span class="arrow-top">
                    <p>về đầu trang</p>
                </span>
            </div>
        </div>
        <!--end Back to top-->

        <!--Footer-->
        <footer class="footer">
            <p class="footer__text">A project made by <a href="github.com" target="_blank" rel="noopener"
                    class="link">Huy</a></p>
            <div class="footer__icons">

                <a href="#" target="_blank" rel="noopener" class="footer__icon linkedin"><span></span>
                    <p>Linkedin</p>
                </a>

                <a href="#" target="_blank" rel="noopener" class="footer__icon dribbble"><span></span>
                    <p>Dribbble</p>
                </a>

                <a href="#" target="_blank" rel="noopener" class="footer__icon codepen"><span></span>
                    <p>Codepen</p>
                </a>
            </div>
        </footer>
        <!--end Footer-->
    </div>

    <!--Script Files-->
    <script src="js/swiper.min.js"></script>

    <!--General-->
    <script src="js/main.js"></script>
    <script src="js/backTop.js"></script>
    <!--Ajax-->
    <script src="js/jquery-331.min.js"></script>
    <script>
    $(document).ready(function(data) {

        $(document).on('keyup', '.quantity', function() {

            var id = $(this).data("product_id");
            var quantity = $(this).val();

            if (quantity != '') {

                $.ajax({

                    url: "change.php",
                    method: "POST",
                    data: {
                        id: id,
                        quantity: quantity
                    },

                    success: function() {
                        $("body").load("cart_body.php");
                    }

                });

            }

        });

    });
    </script>
    <!--end Script Files-->
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

<script src="js/apiprovince.js"></script>

</html>