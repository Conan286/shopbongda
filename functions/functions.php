<?php
$servername = "localhost";
//$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shopthoitrang";


// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// getRealIpUser()

function getRealIpUser()
{

    switch (true) {

        case (!empty($_SERVER['HTTP_X_REAL_IP'])):
            return $_SERVER['HTTP_X_REAL_IP'];
        case (!empty($_SERVER['HTTP_CLIENT_IP'])):
            return $_SERVER['HTTP_CLIENT_REAL_IP'];
        case (!empty($_SERVER['HTTP_X_ROWARDED'])):
            return $_SERVER['HTTP_X_RORWARDED_FOR'];

        default:
            return $_SERVER['REMOTE_ADDR'];
    }
}

// add cart
function add_cart()
{
    global $conn;

    if (isset($_GET['add_cart'])) {
        $ip_add = getRealIpUser();
        $product_id = $_GET['add_cart'];
        $product_size = $_POST['product_size'];
        $cus_gmail = $_POST['cus_gmail'];

        $session_email = $_SESSION['customer_email'];
        $get_customer = "select * from customers where customer_email='$session_email'";
        $run_customer = mysqli_query($conn, $get_customer);
        $row_customer = mysqli_fetch_array($run_customer);
        $customer_id = $row_customer['customer_id'];
        $product_quantity = $_POST['product_quantity'];
        if (!isset($_SESSION['customer_email'])) {
            echo "<script>alert('Vui lòng đăng nhập để thêm.')</script>";
            echo "<script>window.open('customer/login.php', '_self')</script>";
            exit();
        }
        // Lấy thông tin sản phẩm từ bảng products
        $get_product = "SELECT * FROM products WHERE product_id='$product_id'";
        $run_product = mysqli_query($conn, $get_product);
        $row_product = mysqli_fetch_array($run_product);

        // Lấy thông tin sản phẩm từ bảng products_quantity_size
        $get_product_size = "SELECT * FROM products_quantity_size WHERE product_id='$product_id'";
        $run_product_size = mysqli_query($conn, $get_product_size);
        $row_product_size = mysqli_fetch_array($run_product_size);

        // Lấy số lượng tương ứng với kích thước đã chọn
        switch ($product_size) {
            case '1':
                $product_quantity_size = $row_product['product_quantity_size_s'];
                $product_quantity_size_all = $row_product_size['product_quantity_s'];
                break;
            case '2':
                $product_quantity_size = $row_product['product_quantity_size_m'];
                $product_quantity_size_all = $row_product_size['product_quantity_m'];
                break;
            case '3':
                $product_quantity_size = $row_product['product_quantity_size_l'];
                $product_quantity_size_all = $row_product_size['product_quantity_l'];
                break;
            default:
                break;
        }

        // Kiểm tra số lượng tồn kho
        if ($product_quantity_size < $product_quantity) {
            echo "
                    <div class='popup'>
                        <p>Số lượng trong kho không đủ </p>
                    </div>
                ";
            exit();
        } else {
            // Thêm sản phẩm vào giỏ hàng
            $product_price = $row_product['product_price'];
            $query = "INSERT INTO cart (product_id, ip_add, p_size, p_price, p_quantity,cart_id) 
                                VALUES ('$product_id', ' $customer_id', '$product_size', '$product_price', '$product_quantity','$cus_gmail')";


            $run_product1 = mysqli_query($conn, $query);

            if ($run_product1) {

                echo "<script>alert('Sản Phẩm Đã Được Thêm')</script>";


                echo "<script>window.open('index.php?view_products', '_self')</script>";
            }
            echo "<script>";
            echo "alert('Thêm vào giỏ hàng thành công');";
            // echo "window.open('details.php?product_id=$product_id','_self');";
            echo "window.open('cart.php','_self');";
            echo "</script>";
            // Cập nhật số lượng trong bảng products
            $new_quantity = $product_quantity_size - $product_quantity;
            switch ($product_size) {
                case '1':
                    $update_products = "UPDATE products SET product_quantity_size_s='$new_quantity' WHERE product_id='$product_id'";
                    break;
                case '2':
                    $update_products = "UPDATE products SET product_quantity_size_m='$new_quantity' WHERE product_id='$product_id'";
                    break;
                case '3':
                    $update_products = "UPDATE products SET product_quantity_size_l='$new_quantity' WHERE product_id='$product_id'";
                    break;
                default:
                    break;
            }
            mysqli_query($conn, $update_products);

            // Cập nhật số lượng trong bảng products_quantity_size
            $new_quantity_all = $product_quantity_size_all - $product_quantity;
            switch ($product_size) {
                case '1':
                    $update_product_size = "UPDATE products_quantity_size SET product_quantity_s='$new_quantity_all' WHERE product_id='$product_id'";
                    break;
                case '2':
                    $update_product_size = "UPDATE products_quantity_size SET product_quantity_m='$new_quantity_all' WHERE product_id='$product_id'";
                    break;
                case '3':
                    $update_product_size = "UPDATE products_quantity_size SET product_quantity_l='$new_quantity_all' WHERE product_id='$product_id'";
                    break;
                default:
                    break;
            }
            mysqli_query($conn, $update_product_size);

            mysqli_query($conn, $update_product_size);
        }
    }
}

function add_review()
{
    global $conn;

    if (isset($_POST['submit_review'])) {
        $product_id = $_POST['product_id'];
        $customer_id = $_SESSION['customer_id'];
        // print_r($customer_id);
        $review_text = $_POST['review_text'];
        $rating = $_POST['rating'];

        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (!isset($_SESSION['customer_email'])) {
            echo "<script>alert('Vui lòng đăng nhập để thêm đánh giá.')</script>";
            // echo "<script>window.open('login.php', '_self')</script>";
            exit();
        }

        // Kiểm tra xem khách hàng đã mua sản phẩm chưa
        $check_purchase_query = "SELECT * FROM customer_orders   WHERE product_id='$product_id' AND customer_id='$customer_id'";
        $check_purchase_result = mysqli_query($conn, $check_purchase_query);
        // print_r(mysqli_fetch_array($check_purchase_result));


        // if (mysqli_num_rows($check_purchase_result) == 0) {
        //     echo "<script>alert('Bạn cần mua sản phẩm trước khi thêm đánh giá.')</script>";
        //     echo "<script>window.open('index.php', '_self')</script>";
        //     exit();
        // }

        // Thêm đánh giá vào cơ sở dữ liệu
        $insert_review_query = "INSERT INTO reviews (product_id, customer_id, review_text, rating) 
                                VALUES ('$product_id', '$customer_id', '$review_text', '$rating')";
        $insert_review_result = mysqli_query($conn, $insert_review_query);

        if ($insert_review_result) {
            echo "<script>alert('Đánh giá đã được thêm thành công.')</script>";
            echo "<script>window.open('details.php?product_id=$product_id', '_self')</script>";
        } else {
            echo "<script>alert('Đã xảy ra lỗi. Vui lòng thử lại.')</script>";
        }
    }
}

// delete cart



// get items

function items()
{
    if (!isset($_SESSION['customer_email'])) echo 0;
    else {

        global $conn;

        $ip_add = getRealIpUser();
        $session_email = $_SESSION['customer_email'];
        $get_customer = "select * from customers where customer_email='$session_email'";
        $run_customer = mysqli_query($conn, $get_customer);
        $row_customer = mysqli_fetch_array($run_customer);
        $customer_id = $row_customer['customer_id'];


        $get_items = "SELECT * FROM cart WHERE ip_add='$customer_id'";

        $run_items = mysqli_query($conn, $get_items);

        $count_items = mysqli_num_rows($run_items);

        echo $count_items;
    }
}

// get p_category
function get_p_category()
{

    global $conn;

    if (isset($_GET['product_category'])) {

        $product_category_id = $_GET['product_category'];

        $get_products = "select * from products where product_category_id='$product_category_id'";

        $run_products = mysqli_query($conn, $get_products);

        $count_product = mysqli_num_rows($run_products);

        if ($count_product == 0) {

            echo "<script>alert('Sản phẩm tạm thời hết hàng')</script>";
            echo "<script>window.open('shop.php','_self')</script>";
        } else {

            while ($row_products = mysqli_fetch_array($run_products)) {

                $product_id = $row_products['product_id'];

                $product_title = $row_products['product_title'];

                $product_price = $row_products['product_price'];
                $product_price_format = number_format($product_price, 0, ',', '.');

                $product_image_1 = $row_products['product_image_1'];

                $product_label = $row_products['product_label'];

                $product_sale = $row_products['product_sale'];
                $product_sale_format = number_format($product_sale, 0, ',', '.');

                if ($product_label == 'new') {

                    $label = "<div class='contentProducts__label new'>mới</div>";
                } else {

                    $label = "<div class='contentProducts__label'>giảm giá</div>";
                }

                if ($product_label == 'sale') {

                    $price = " 
                                    <div class='contentProducts__priceFinal'>$product_sale_format ₫</div>
                                    <div class='contentProducts__priceOriginal'>$product_price_format ₫</div>
                                ";
                } else {

                    $price = "<div class='contentProducts__priceFinal'>$product_price_format ₫</div>";
                }


                echo "

                            <a class='contentProducts__card anime' href='details.php?product_id=$product_id'>
                                
                            $label

                            <figure class='contentProducts__image'>
                                <img src='admin/$product_image_1' alt=''>
                            </figure>
                            <div class='contentProducts__text'>
                                <h4 class='contentProducts__productTitle'>$product_title</h4>
                                <div class='contentProducts__priceContainer'>
                                    $price
                                </div>
                                <div class='contentProducts__info'>
                                    <p class='contentProducts__link'><span>chi tiết</span><svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-circle-plus' width='44' height='44' viewBox='0 0 24 24' stroke-width='1.5' stroke='#7E56C8' fill='none' stroke-linecap='round' stroke-linejoin='round'>
                                    <path stroke='none' d='M0 0h24v24H0z'/>
                                    <circle cx='12' cy='12' r='9' />
                                    <line x1='9' y1='12' x2='15' y2='12' />
                                    <line x1='12' y1='9' x2='12' y2='15' />
                                    </svg>
                                    </p>
                                    <div class='contentProducts__view cta cta02'><span>Xem</span></div>
                                </div>
                            </div>
                        </a>
                    ";
            }
        }
    }
}

// get category
function get_category()
{

    global $conn;

    if (isset($_GET['category'])) {

        $category_id = $_GET['category'];

        $get_products = "select * from products where category_id='$category_id'";

        $run_products = mysqli_query($conn, $get_products);

        $count_product = mysqli_num_rows($run_products);

        if ($count_product == 0) {

            echo "<script>alert('Sản phẩm tạm thời hết hàng')</script>";
            echo "<script>window.open('shop.php','_self')</script>";
        } else {

            while ($row_products = mysqli_fetch_array($run_products)) {

                $product_id = $row_products['product_id'];

                $product_title = $row_products['product_title'];

                $product_price = $row_products['product_price'];
                $product_price_format = number_format($product_price, 0, ',', '.');

                $product_image_1 = $row_products['product_image_1'];

                $product_label = $row_products['product_label'];

                $product_sale = $row_products['product_sale'];
                $product_sale_format = number_format($product_sale, 0, ',', '.');

                if ($product_label == 'new') {

                    $label = "<div class='contentProducts__label new'>mới</div>";
                } else {

                    $label = "<div class='contentProducts__label'>giảm giá</div>";
                }

                if ($product_label == 'sale') {

                    $price = " 
                                    <div class='contentProducts__priceFinal'>$product_sale_format ₫</div>
                                    <div class='contentProducts__priceOriginal'>$product_price_format ₫</div>
                                ";
                } else {

                    $price = "<div class='contentProducts__priceFinal'>$product_price_format ₫</div>";
                }


                echo "

                            <a class='contentProducts__card anime' href='details.php?product_id=$product_id'>
                                
                            $label

                            <figure class='contentProducts__image'>
                                <img src='admin/$product_image_1' alt=''>
                            </figure>
                            <div class='contentProducts__text'>
                                <h4 class='contentProducts__productTitle'>$product_title</h4>
                                <div class='contentProducts__priceContainer'>
                                    $price
                                </div>
                                <div class='contentProducts__info'>
                                    <p class='contentProducts__link'><span>chi tiết</span><svg xmlns='http://www.w3.org/2000/svg' class='icon icon-tabler icon-tabler-circle-plus' width='44' height='44' viewBox='0 0 24 24' stroke-width='1.5' stroke='#7E56C8' fill='none' stroke-linecap='round' stroke-linejoin='round'>
                                    <path stroke='none' d='M0 0h24v24H0z'/>
                                    <circle cx='12' cy='12' r='9' />
                                    <line x1='9' y1='12' x2='15' y2='12' />
                                    <line x1='12' y1='9' x2='12' y2='15' />
                                    </svg>
                                    </p>
                                    <div class='contentProducts__view cta cta02'><span>Xem</span></div>
                                </div>
                            </div>
                        </a>
                    ";
            }
        }
    }
}
