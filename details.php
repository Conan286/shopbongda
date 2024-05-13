<?php
session_set_cookie_params('86400');
session_start();
include("includes/db.php");
include("functions/functions.php");
// print_r($_SESSION);
?>

<?php error_reporting(0); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSport | Chi tiết</title>
    <!--css swiper-->
    <link rel="stylesheet" href="css/swiper.min.css">
    <!--css files-->
    <link rel="stylesheet" href="css/details.css">
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
                <div class="swiper-container galleryMain">
                    <!-- php get product your chose -->
                    <?php

                    if (isset($_GET['product_id'])) {

                        $product_id = $_GET['product_id'];

                        $get_product = "select * from products where product_id = '$product_id'";

                        $run_product = mysqli_query($conn, $get_product);

                        $row_product = mysqli_fetch_array($run_product);

                        $product_title = $row_product['product_title'];

                        $product_price = $row_product['product_price'];
                        $product_price_format = number_format($product_price, 0, ',', '.');

                        $product_image_1 = $row_product['product_image_1'];

                        $product_image_2 = $row_product['product_image_2'];

                        $product_image_3 = $row_product['product_image_3'];

                        $product_description = $row_product['product_description'];

                        $product_label = $row_product['product_label'];

                        $product_sale = $row_product['product_sale'];
                        $product_sale_format = number_format($product_sale, 0, ',', '.');

                        $product_quantity_size_s = $row_product['product_quantity_size_s'];
                        $product_quantity_size_m = $row_product['product_quantity_size_m'];
                        $product_quantity_size_l = $row_product['product_quantity_size_l'];
                    }
                    ?>
                    <!-- end php get product your chose -->
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="scene">
                                <img src="admin/<?php echo $product_image_1; ?>" alt="đang tải...">
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="scene">
                                <img src="admin/<?php echo $product_image_2; ?>" alt="đang tải...">
                            </div>
                        </div>

                        <div class="swiper-slide">
                            <div class="scene">
                                <img src="admin/<?php echo $product_image_3; ?>" alt="đang tải...">
                            </div>
                        </div>
                    </div>
                </div>
                <!--Add Arrows-->
                <div class="sliderNavigation">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </section>

            <section class="right">
                <div class="rightContent">
                    <?php
                    $get_coupon = "select * from coupons where product_id='$product_id'";
                    $run_coupon = mysqli_query($conn, $get_coupon);
                    $row_coupon = mysqli_fetch_array($run_coupon);
                    if ($row_coupon > 0) {
                        $coupon_code = $row_coupon['coupon_code'];
                        $coupon_price = $row_coupon['coupon_price'];
                        $coupon_price_format = number_format($coupon_price, 0, ',', '.');
                        $show_coupon_price = "Ưu đãi giá chỉ còn $coupon_price_format khi nhập mã <b>$coupon_code</b>";
                    } else {
                        $show_coupon_price = "";
                    }
                    ?>
                    <div class="modal">
                        <p class="modal__title"><?php echo $product_title; ?></p>
                        <p class="modal__desc"><?php echo $product_description; ?>
                            <span><?php echo $show_coupon_price ?></span>
                        </p>
                        <div class="modal__detailTotal">
                            <div class="modal__total">
                                <p> Số lượng </p>
                                <p class="size-s">Size (S):
                                    <?= $product_quantity_size_s; ?></p>
                                <p class="size-m">Size (M):
                                    <?= $product_quantity_size_m; ?></p>
                                <p class="size-l">Size (L):
                                    <?= $product_quantity_size_l; ?></p>
                            </div>
                            <br>
                            <!-- <p> <?php echo "" ?> </p> -->
                            <div class="modal__sold">
                                <p>Đã bán <br>
                                    <?php
                                    $get_sold = "SELECT * FROM customer_orders WHERE product_id='$product_id'";
                                    $run_sold = mysqli_query($conn, $get_sold);
                                    $count = mysqli_num_rows($run_sold);
                                    $total_quantity_s = 0;
                                    $total_quantity_m = 0;
                                    $total_quantity_l = 0;
                                    while ($row_sold = mysqli_fetch_array($run_sold)) {
                                        $product_quantity = $row_sold['product_quantity'];
                                        $product_size = $row_sold['product_size'];
                                        // Tăng tổng số lượng tương ứng với kích thước
                                        switch ($product_size) {
                                            case '1':
                                                $total_quantity_s += $product_quantity;
                                                break;
                                            case '2':
                                                $total_quantity_m += $product_quantity;
                                                break;
                                            case '3':
                                                $total_quantity_l += $product_quantity;
                                                break;
                                            default:
                                                break;
                                        }
                                    }
                                    // Hiển thị tổng số lượng theo từng kích thước
                                    echo "Size S: " . $total_quantity_s . "<br>";
                                    echo "Size M: " . $total_quantity_m . "<br>";
                                    echo "Size L: " . $total_quantity_l . "<br>";

                                    ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="price">
                        <?php

                        if ($product_label == "sale") {

                            echo "
                                    <p class='price__final'>$product_sale_format ₫</p>
                                    <p class='price__original'>$product_price_format ₫</p>
                                ";
                        } else {

                            echo "<p class='price__final'>$product_price_format ₫</p>";
                        }

                        ?>
                    </div>

                    <!--Form-->
                    <?php add_cart(); ?>

                    <form action="details.php?add_cart=<?= $product_id; ?>" method="post">
                        <div class="specs">
                            <div class="size">
                                <h3 class="subtitle">Kích Thước</h3>
                                <select name="product_size" id="product_size" required>
                                    <option disabled selected>Chọn Kích Thước</option>
                                    <option value="1" data-quantity="<?= $product_quantity_size_s; ?>">S (Còn :
                                        <?= $product_quantity_size_s; ?>)</option>
                                    <option value="2" data-quantity="<?= $product_quantity_size_m; ?>">M (Còn :
                                        <?= $product_quantity_size_m; ?>)</option>
                                    <option value="3" data-quantity="<?= $product_quantity_size_l; ?>">L (Còn :
                                        <?= $product_quantity_size_l; ?>)</option>
                                </select>
                            </div>

                            <div class="quantity">
                                <h3 class="subtitle" style="margin-bottom:15px;">Số Lượng</h3>
                                <div style="box-shadow: rgba(0, 0, 0, 0.02) 0px 1px 3px 0px, rgba(27, 31, 35, 0.15) 0px 0px 0px 1px;;padding:4px;">
                                    <input type="number" name="product_quantity" id="product_quantity" min="1">
                                </div>
                            </div>

                        </div>

                        <button name="add_to_cart" class="btn" type="submit">
                            <img src="assets/icon-shopping-w.svg" alt="">
                            <span>thêm vào giỏ</span>
                        </button>
                    </form>
                </div>
            </section>
        </div>


    </div>
    <div class="product-single__details-tab">

        <div class="tab-content">

            <div class="tab-pane fade active show" id="tab-reviews" role="tabpanel" aria-labelledby="tab-reviews-tab">
                <h2 class="product-single__reviews-title">Reviews</h2>
                <div class="product-single__reviews-list">
                    <?php
                    // Assuming $conn is your database connection
                    $product_id = $_GET['product_id'];

                    $get_product = "select * from products ";
                    $get_reviews = "SELECT reviews.*, customers.* 
                 FROM reviews 
                 INNER JOIN customers ON reviews.customer_id = customers.customer_id where reviews.product_id = '$product_id'";

                    $run_reviews = mysqli_query($conn, $get_reviews);

                    while ($row_review = mysqli_fetch_array($run_reviews)) {
                        $product_name = $row_product['product_title'];
                        $review_text = $row_review['review_text'];
                        $customer_name = $row_review['customer_name'];
                        $review_date = $row_review['review_date'];
                        $rating = $row_review['rating'];
                        $customer_image = $row_review['customer_image'];
                    ?>
                        <div class="product-single__reviews-item">
                            <div class="customer-avatar">
                                <img loading="lazy" src="./customer/customer_images/<?php echo $customer_image; ?>" alt="">
                            </div>
                            <div class="customer-review">
                                <div class="customer-name">
                                    <h6><?php echo $customer_name; ?></h6>
                                    <div class="reviews-group d-flex">
                                        <?php
                                        // Output star rating based on the value of $rating
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($i <= $rating) {
                                                // Display filled star for ratings <= $rating
                                                echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill user_rate" viewBox="0 0 16 16">
                                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                                      </svg>';
                                            } else {
                                                // Display empty outline star for ratings > $rating
                                                echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star user_rate" viewBox="0 0 16 16">
                                                        <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
                                                      </svg>';
                                            }
                                        }

                                        ?>
                                    </div>
                                </div>
                                <div class="review-date"><?php echo $review_date; ?></div>
                                <div class="review-text">
                                    <p><?php echo $review_text; ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div class="product-single__review-form">
                    <?php add_review(); ?>

                    <form method="post" action="details.php?product_id=<?= $product_id; ?>">
                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                        <input type="hidden" name="customer_id" value="<?php echo $_SESSION['id_kh']; ?>">
                        <h5>Be the first to review “ <?php echo $product_name; ?> ”</h5>
                        <p>Your email address will not be published. Required fields are marked *</p>
                        <div class="select-star-rating">
                            <label>Your rating *</label>
                            <span class="star-rating">
                                <!-- Star rating selection using hidden input -->


                                <!-- Dynamic generation of star icons -->
                                <?php
                                // Output star rating options

                                ?>
                                <div class="rating">
                                    <label>
                                        <input type="radio" name="rating" value="1" />
                                        <span class="icon">★</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="rating" value="2" />
                                        <span class="icon">★</span>
                                        <span class="icon">★</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="rating" value="3" />
                                        <span class="icon">★</span>
                                        <span class="icon">★</span>
                                        <span class="icon">★</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="rating" value="4" />
                                        <span class="icon">★</span>
                                        <span class="icon">★</span>
                                        <span class="icon">★</span>
                                        <span class="icon">★</span>
                                    </label>
                                    <label>
                                        <input type="radio" name="rating" value="5" />
                                        <span class="icon">★</span>
                                        <span class="icon">★</span>
                                        <span class="icon">★</span>
                                        <span class="icon">★</span>
                                        <span class="icon">★</span>
                                    </label>
                                </div>
                            </span>
                        </div>
                        <div class="mb-4">
                            <textarea id="form-input-review" class="form-control form-control_gray" placeholder="Your Review" name="review_text" cols="30" rows="8"></textarea>
                        </div>
                        <div class="form-check mb-4">
                            <input class="form-check-input form-check-input_fill" type="checkbox" value="" id="remember_checkbox" name="remember_checkbox">
                            <label class="form-check-label" for="remember_checkbox">
                                Save my name, email, and website in this browser for the next time I comment.
                            </label>
                        </div>
                        <div class="form-action">
                            <input type="hidden" name="customer_id" value="<?php echo $_SESSION['id_kh']; ?>">
                            <input type="submit" name="submit_review" class="btn btn-primary" value="Submit">
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
    <script>
        function setRating(rating) {
            // Set the value of the hidden input to the selected rating
            document.getElementById('form-input-rating').value = rating;

            // Optional: You can provide visual feedback, such as highlighting the selected stars
            // Remove fill="#ccc" from all stars
            var starIcons = document.querySelectorAll('.star-rating__star-icon');
            starIcons.forEach(function(icon, index) {
                if (index < rating) {
                    icon.setAttribute('fill', 'gold'); // Highlight selected stars
                } else {
                    icon.setAttribute('fill', '#ccc'); // Reset other stars to default color
                }
            });
        }
        $(':radio').change(function() {
            console.log('New star rating: ' + this.value);
        });
    </script>

    <style>
        .rating {
            display: inline-block;
            position: relative;
            height: 34px;
            line-height: 50px;
            /* color: yellow; */
            font-size: 2rem;
        }

        .rating label {
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            cursor: pointer;
        }

        .rating label:last-child {
            position: static;
        }

        .rating label:nth-child(1) {
            z-index: 5;
        }

        .rating label:nth-child(2) {
            z-index: 4;
        }

        .rating label:nth-child(3) {
            z-index: 3;
        }

        .rating label:nth-child(4) {
            z-index: 2;
        }

        .rating label:nth-child(5) {
            z-index: 1;
        }

        .rating label input {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
        }

        .rating label .icon {
            float: left;
            color: transparent;
        }

        .rating label:last-child .icon {
            color: #000;
        }

        .rating:not(:hover) label input:checked~.icon,
        .rating:hover label:hover input~.icon {
            color: #ffc107;
        }

        .rating label input:focus:not(:checked)~.icon:last-child {
            color: #000;
            text-shadow: 0 0 5px #ffc107;
        }

        .user_rate {
            color: #ffc107;
        }

        .product-single__details-tab {
            margin: 6.25rem auto 2.375rem;
            max-width: 58.125rem;
        }

        .product-single__details-tab>.tab-content {
            padding: 3.125rem 0;
        }

        .product-single__reviews-title {
            font-size: 1.125rem;
            margin-bottom: 1.75rem;
        }

        .product-single__reviews-list {
            display: flex;
            flex-direction: column;
            gap: 1.87rem;
            margin-bottom: 2.375rem;
        }

        .product-single__reviews-item {
            display: flex;
            gap: 1.875rem;
            border-bottom: 1px solid #e4e4e4;
        }

        .product-single__reviews-item .customer-avatar {
            flex: 0 0 3.75rem;
            width: 3.75rem;
            height: 3.75rem;
            border-radius: 2rem;
            overflow: hidden;
        }

        .product-single__reviews-item .customer-avatar>img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-single__reviews-item .customer-review .customer-name {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .product-single__reviews-item .customer-review .customer-name>h6,
        .product-single__reviews-item .customer-review .customer-name>.h6 {
            margin: 0;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1.5rem;
        }

        .d-flex {
            display: flex !important;
        }

        .review-star {
            width: 9px;
            height: 9px;
            margin-right: .25rem;
            fill: #ffc78b;
        }

        img,
        svg {
            vertical-align: middle;
        }

        .product-single__reviews-item .customer-review .review-date {
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1.5rem;
            color: #767676;
            margin-bottom: 1.25rem;
        }

        .product-single__reviews-item .customer-review .review-text {
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1.5rem;
            color: #767676;
            margin-bottom: 1.5rem;
        }

        .product-single__reviews-item .customer-review .review-text {
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1.5rem;
            color: #767676;
            margin-bottom: 1.5rem;
        }

        .product-single__review-form form>h5,
        .product-single__review-form form>.h5 {
            font-size: 1.125rem;
            margin-bottom: 0.375rem;
        }

        .product-single__review-form form>p {
            font-size: 0.875rem;
            color: #767676;
            line-height: 1.5rem;
            margin-bottom: 1.875rem;
        }

        .product-single__review-form form .select-star-rating {
            margin-bottom: 2rem;
        }

        .star-rating__star-icon {
            cursor: pointer;
            transition: all .1s ease;
            fill: #ccc;
        }

        .mb-4 {
            margin-bottom: 1.5rem !important;
        }

        textarea.form-control {
            min-height: calc(1.5em + 0.75rem + 2px);
        }

        .form-control {
            transition: none;
        }

        .form-control_gray {
            border-color: #e4e4e4;
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 0.9375rem 0.9375rem 0.75rem;
            font-size: 0.875rem;
            font-weight: 400;
            line-height: 1.7143;
            color: #222222;
            background-color: #fff;
            background-clip: padding-box;
            border: 0.125rem solid #e4e4e4;
            appearance: none;
            border-radius: 0;
            box-shadow: none;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        textarea {
            resize: vertical;
        }

        .customer-review {
            width: 100%;
        }
    </style>
    <!--Script Files-->
    <script src="js/swiper.min.js"></script>

    <!--General-->
    <script src="js/main.js"></script>

    <script>
        document.getElementById('product_size').onchange = function() {
            var selectedOption = this.options[this.selectedIndex];
            var quantity = selectedOption.getAttribute('data-quantity');

            document.getElementById('product_quantity').setAttribute('max', quantity);
            document.getElementById('product_quantity').value = 1;
        };

        document.getElementById('product_quantity').addEventListener('input', function() {
            var quantityInput = parseInt(this.value);
            var maxQuantity = parseInt(this.getAttribute('max'));

            if (quantityInput > maxQuantity) {
                this.value = maxQuantity;
            }

            if (quantityInput < 1) {
                this.value = 1;
            }
        });
    </script>

    <script>
        // swiper   
        var mySwiper = new Swiper('.swiper-container', {
            effect: '',
            loop: false,
            speed: 1000,
            slidesPerView: 1,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            pagination: {
                el: '.swiper-pagination',
                type: 'bullets',
                clickable: 'true'
            },


        });
    </script>
    <!--end Script Files-->
</body>

</html>