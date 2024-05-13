<?php

    session_set_cookie_params('86400');
    session_start();
    include("includes/db.php");
    include("functions/functions.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lalla | Kết quả tìm kiếm</title>
    <!--css swiper-->
    <link rel="stylesheet" href="css/swiper.min.css">
    <!--css files-->
    <link rel="stylesheet" href="css/result.css">
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
    <nav class="mainNav">
        <div class="mainNav__logo">
            <a href="index.php"><img src="assets/images/logo.svg" alt=""></a>
        </div>
        <div class="mainNav__wrapper">
            <div class="mainNav__links">
                <a class="mainNav__link" href="index.php">Trang chủ</a>
                <a class="mainNav__link" href="shop.php">Cửa hàng</a>
                
                <a class="mainNav__link" href="contacts.php">Liên hệ</a>
            </div>
        </div>

        <div class="mainNav__menu">
            <form action="result.php" method="get">
                <div class="mainNav__input">
                    <input type="search" name="user_query" placeholder="Tìm kiếm ...">
                    <button class="mainNav__btnSearch" type="submit"> <img src="assets/icon-search.svg" alt=""></button>
                </div>
            </form>
            <a href="cart.php">
                <div class="mainNav__shoppingCart">
                    <?xml version="1.0"?>
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 489 489" style="enable-background:new 0 0 489 489;" xml:space="preserve" width="512px" height="512px"><g><g>
                        <path d="M440.1,422.7l-28-315.3c-0.6-7-6.5-12.3-13.4-12.3h-57.6C340.3,42.5,297.3,0,244.5,0s-95.8,42.5-96.6,95.1H90.3   c-7,0-12.8,5.3-13.4,12.3l-28,315.3c0,0.4-0.1,0.8-0.1,1.2c0,35.9,32.9,65.1,73.4,65.1h244.6c40.5,0,73.4-29.2,73.4-65.1   C440.2,423.5,440.2,423.1,440.1,422.7z M244.5,27c37.9,0,68.8,30.4,69.6,68.1H174.9C175.7,57.4,206.6,27,244.5,27z M366.8,462   H122.2c-25.4,0-46-16.8-46.4-37.5l26.8-302.3h45.2v41c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5v-41h139.3v41   c0,7.5,6,13.5,13.5,13.5s13.5-6,13.5-13.5v-41h45.2l26.9,302.3C412.8,445.2,392.1,462,366.8,462z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#666666"/>
                    </g></g> </svg>
                    <span class="mainNav__itemNumber"><?php items(); ?></span>
                </div>
            </a>

            <div class="mainNav__profile">
                <?php
                
                    if (!isset($_SESSION['customer_email'])) {

                        echo "
                            <a href='customer/login.php'>
                                <div class='mainNav__profileImage'>
                                    <img src='customer/customer_images/customer_default.png' title='Đăng Nhập' alt=''>
                                </div>
                            </a>
                        ";

                    } else {

                        $session_email = $_SESSION['customer_email'];

                        $get_customer = "select * from customers where customer_email='$session_email'";

                        $run_customer = mysqli_query($conn, $get_customer);

                        $row_customer = mysqli_fetch_array($run_customer);

                            $customer_name = $row_customer['customer_name'];

                            $customer_image = $row_customer['customer_image'];
                            
                        if ($customer_image=='') {

                            echo "
                                <div class='mainNav__profileImage'>
                                    <img src='customer/customer_images/customer_default_2.png' alt=''>
                                </div>
                            ";

                        } else {

                            echo "
                                <div class='mainNav__profileImage'>
                                    <img src='customer/customer_images/$customer_image' alt=''>
                                </div>
                            ";
                        }
                    }
                
                ?>

                <div class="mainNav__profileMenu">
                    <a href="customer/my_account.php?my_orders" class="mainNav__profileText account"> <?xml version="1.0"?>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 483.5 483.5" style="enable-background:new 0 0 483.5 483.5;" xml:space="preserve" width="512px" height="512px"><g><g>
                            <g>
                                <path d="M430.75,471.2v-67.8c0-83.9-55-155.2-130.7-179.8c36.4-20.5,61.1-59.5,61.1-104.2c0-65.8-53.6-119.4-119.4-119.4    s-119.4,53.6-119.4,119.4c0,44.7,24.7,83.7,61.1,104.2c-75.8,24.6-130.7,95.9-130.7,179.8v67.8c0,6.8,5.5,12.3,12.3,12.3h353.6    C425.25,483.4,430.75,478,430.75,471.2z M146.75,119.4c0-52.3,42.6-94.9,94.9-94.9s94.9,42.6,94.9,94.9s-42.6,94.9-94.9,94.9    S146.75,171.7,146.75,119.4z M406.25,458.9H77.05v-55.6c0-90.7,73.8-164.6,164.6-164.6s164.6,73.8,164.6,164.6V458.9z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#666666"/>
                            </g>
                        </g></g> </svg>
                        Hồ sơ</a>
                    <a href="customer/my_account.php?edit_account" class="mainNav__profileText"> <?xml version="1.0"?>
                        <svg xmlns="http://www.w3.org/2000/svg" height="512px" viewBox="0 0 431.66 431" width="512px"><g><path d="m75.375 370.960938c2.796875 1.996093 6.421875 2.417968 9.601562 1.117187l110.167969-45.09375c1.625-.664063 3.046875-1.746094 4.121094-3.132813l161.113281-208.03125c10.308594-13.3125 14.863282-30.203124 12.636719-46.898437-2.222656-16.691406-11.039063-31.800781-24.480469-41.949219l-18.53125-14c-27.578125-20.683594-66.644531-15.457031-87.816406 11.75l-161.917969 209.515625c-1.230469 1.597657-1.953125 3.53125-2.070312 5.542969l-7 122.46875c-.195313 3.429688 1.382812 6.71875 4.175781 8.710938zm21.6875-110.753907 73.585938 55.1875-78.578126 32.160157zm92.070312 44.050781-87.175781-65.378906 131.488281-170.140625 86.964844 66.019531zm68.878907-267.308593c14.453125-18.566407 41.113281-22.136719 59.9375-8.019531l18.53125 14c9.175781 6.925781 15.191406 17.238281 16.710937 28.632812 1.519532 11.394531-1.589844 22.921875-8.628906 32.011719l-11.90625 15.371093-86.980469-66.03125zm0 0" data-original="#000000" class="active-path" data-old_color="#000000" fill="#666666"/><path d="m421.660156 411.367188h-411.660156c-5.523438 0-10 4.476562-10 10 0 5.523437 4.476562 10 10 10h411.660156c5.523438 0 10-4.476563 10-10 0-5.523438-4.476562-10-10-10zm0 0" data-original="#000000" class="active-path" data-old_color="#000000" fill="#666666"/></g> </svg>
                        Chỉnh sửa hồ sơ</a>
                    <a href="customer/my_account.php?change_password" class="mainNav__profileText"> <?xml version="1.0"?>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 478.703 478.703" style="enable-background:new 0 0 478.703 478.703;" xml:space="preserve" width="512px" height="512px"><g><g>
                            <g>
                                <path d="M454.2,189.101l-33.6-5.7c-3.5-11.3-8-22.2-13.5-32.6l19.8-27.7c8.4-11.8,7.1-27.9-3.2-38.1l-29.8-29.8    c-5.6-5.6-13-8.7-20.9-8.7c-6.2,0-12.1,1.9-17.1,5.5l-27.8,19.8c-10.8-5.7-22.1-10.4-33.8-13.9l-5.6-33.2    c-2.4-14.3-14.7-24.7-29.2-24.7h-42.1c-14.5,0-26.8,10.4-29.2,24.7l-5.8,34c-11.2,3.5-22.1,8.1-32.5,13.7l-27.5-19.8    c-5-3.6-11-5.5-17.2-5.5c-7.9,0-15.4,3.1-20.9,8.7l-29.9,29.8c-10.2,10.2-11.6,26.3-3.2,38.1l20,28.1    c-5.5,10.5-9.9,21.4-13.3,32.7l-33.2,5.6c-14.3,2.4-24.7,14.7-24.7,29.2v42.1c0,14.5,10.4,26.8,24.7,29.2l34,5.8    c3.5,11.2,8.1,22.1,13.7,32.5l-19.7,27.4c-8.4,11.8-7.1,27.9,3.2,38.1l29.8,29.8c5.6,5.6,13,8.7,20.9,8.7c6.2,0,12.1-1.9,17.1-5.5    l28.1-20c10.1,5.3,20.7,9.6,31.6,13l5.6,33.6c2.4,14.3,14.7,24.7,29.2,24.7h42.2c14.5,0,26.8-10.4,29.2-24.7l5.7-33.6    c11.3-3.5,22.2-8,32.6-13.5l27.7,19.8c5,3.6,11,5.5,17.2,5.5l0,0c7.9,0,15.3-3.1,20.9-8.7l29.8-29.8c10.2-10.2,11.6-26.3,3.2-38.1    l-19.8-27.8c5.5-10.5,10.1-21.4,13.5-32.6l33.6-5.6c14.3-2.4,24.7-14.7,24.7-29.2v-42.1    C478.9,203.801,468.5,191.501,454.2,189.101z M451.9,260.401c0,1.3-0.9,2.4-2.2,2.6l-42,7c-5.3,0.9-9.5,4.8-10.8,9.9    c-3.8,14.7-9.6,28.8-17.4,41.9c-2.7,4.6-2.5,10.3,0.6,14.7l24.7,34.8c0.7,1,0.6,2.5-0.3,3.4l-29.8,29.8c-0.7,0.7-1.4,0.8-1.9,0.8    c-0.6,0-1.1-0.2-1.5-0.5l-34.7-24.7c-4.3-3.1-10.1-3.3-14.7-0.6c-13.1,7.8-27.2,13.6-41.9,17.4c-5.2,1.3-9.1,5.6-9.9,10.8l-7.1,42    c-0.2,1.3-1.3,2.2-2.6,2.2h-42.1c-1.3,0-2.4-0.9-2.6-2.2l-7-42c-0.9-5.3-4.8-9.5-9.9-10.8c-14.3-3.7-28.1-9.4-41-16.8    c-2.1-1.2-4.5-1.8-6.8-1.8c-2.7,0-5.5,0.8-7.8,2.5l-35,24.9c-0.5,0.3-1,0.5-1.5,0.5c-0.4,0-1.2-0.1-1.9-0.8l-29.8-29.8    c-0.9-0.9-1-2.3-0.3-3.4l24.6-34.5c3.1-4.4,3.3-10.2,0.6-14.8c-7.8-13-13.8-27.1-17.6-41.8c-1.4-5.1-5.6-9-10.8-9.9l-42.3-7.2    c-1.3-0.2-2.2-1.3-2.2-2.6v-42.1c0-1.3,0.9-2.4,2.2-2.6l41.7-7c5.3-0.9,9.6-4.8,10.9-10c3.7-14.7,9.4-28.9,17.1-42    c2.7-4.6,2.4-10.3-0.7-14.6l-24.9-35c-0.7-1-0.6-2.5,0.3-3.4l29.8-29.8c0.7-0.7,1.4-0.8,1.9-0.8c0.6,0,1.1,0.2,1.5,0.5l34.5,24.6    c4.4,3.1,10.2,3.3,14.8,0.6c13-7.8,27.1-13.8,41.8-17.6c5.1-1.4,9-5.6,9.9-10.8l7.2-42.3c0.2-1.3,1.3-2.2,2.6-2.2h42.1    c1.3,0,2.4,0.9,2.6,2.2l7,41.7c0.9,5.3,4.8,9.6,10,10.9c15.1,3.8,29.5,9.7,42.9,17.6c4.6,2.7,10.3,2.5,14.7-0.6l34.5-24.8    c0.5-0.3,1-0.5,1.5-0.5c0.4,0,1.2,0.1,1.9,0.8l29.8,29.8c0.9,0.9,1,2.3,0.3,3.4l-24.7,34.7c-3.1,4.3-3.3,10.1-0.6,14.7    c7.8,13.1,13.6,27.2,17.4,41.9c1.3,5.2,5.6,9.1,10.8,9.9l42,7.1c1.3,0.2,2.2,1.3,2.2,2.6v42.1H451.9z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#666666"/>
                                <path d="M239.4,136.001c-57,0-103.3,46.3-103.3,103.3s46.3,103.3,103.3,103.3s103.3-46.3,103.3-103.3S296.4,136.001,239.4,136.001    z M239.4,315.601c-42.1,0-76.3-34.2-76.3-76.3s34.2-76.3,76.3-76.3s76.3,34.2,76.3,76.3S281.5,315.601,239.4,315.601z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#666666"/>
                            </g>
                        </g></g> </svg>
                        Cài đặt tài khoản</a>
                    <a href="customer/logout.php" class="mainNav__profileText"> <?xml version="1.0"?>
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 56 56" style="enable-background:new 0 0 56 56;" xml:space="preserve" width="512px" height="512px"><g><g>
                            <path d="M35.31,5.042c-0.532-0.155-1.085,0.15-1.24,0.68s0.149,1.085,0.68,1.24C44.906,9.932,52,19.405,52,30   c0,13.233-10.767,24-24,24S4,43.233,4,30C4,19.392,11.105,9.915,21.279,6.953c0.53-0.154,0.835-0.709,0.681-1.239   c-0.153-0.53-0.708-0.839-1.239-0.681C9.698,8.241,2,18.508,2,30c0,14.337,11.663,26,26,26s26-11.663,26-26   C54,18.522,46.314,8.26,35.31,5.042z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#666666"/>
                            <path d="M28,27c0.553,0,1-0.447,1-1V1c0-0.553-0.447-1-1-1s-1,0.447-1,1v25C27,26.553,27.447,27,28,27z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#666666"/>
                        </g></g> </svg>
                        Đăng xuất</a>
                </div>
            </div>

            <div class="mainNav__icon"><span></span></div>
        </div>
    </nav>
    <!--end Navigation-->

    <!--Products-->
    <section class="contentProducts">
        <p class="contentProducts__result">Chúng tôi đã tìm thấy 
            
            <?php 

                $find = "%{$_GET['user_query']}%";
                $findName = $_GET['user_query'];

                $get_products = "select * from products where product_keywords like '$find' or product_title like'$find' or product_price like'$find' or product_sale like'$find'";

                $run_products = mysqli_query($conn, $get_products);

                $count_products = mysqli_num_rows($run_products);

                echo "$count_products";

            ?>
            kết quả cho <strong><?php echo $findName; ?></strong></p>
        <div class="contentProducts__wrapper">
            <div class="contentProducts__heading">
                <!--<h3 class="contentProducts__title anime">${contentProducts.title}</h3>-->
            </div>
            <div class="contentProducts__cards">
            <!-- php get product -->
            <?php 
            
                $find = "%{$_GET['user_query']}%";

                $get_products = "select * from products where product_keywords like '$find' or product_title like'$find' or product_price like'$find' or product_sale like'$find'";

                $run_products = mysqli_query($conn, $get_products);

                $count_products = mysqli_num_rows($run_products);

                if ($count_products>0) {

                    while ($row_products = mysqli_fetch_array($run_products)) {

                        $product_id = $row_products['product_id'];

                        $product_title = $row_products['product_title'];

                        $product_price = $row_products['product_price'];
                        $product_price_format = number_format($product_price, 0, ',', '.');

                        $product_image_1 = $row_products['product_image_1'];

                        $product_label = $row_products['product_label'];

                        $product_sale = $row_products['product_sale'];
                        $product_sale_format = number_format($product_sale, 0, ',', '.');

                
                ?>

                <a class="contentProducts__card anime" href="details.php?product_id=<?php echo $product_id; ?>">
                    
                    <?php
                        
                        if ($product_label == "new") {

                            echo "<div class='contentProducts__label new'>mới</div>";

                        } else {

                            echo "<div class='contentProducts__label'>giảm giá</div>";

                        }

                    ?>
                    <figure class="contentProducts__image">
                        <img src="admin/<?php echo $product_image_1; ?>" alt="">
                    </figure>
                    <div class="contentProducts__text">
                        <h4 class="contentProducts__productTitle"><?php echo $product_title; ?></h4>
                        <div class="contentProducts__priceContainer">
                            <?php
                            
                                if ($product_label == "sale") {

                                    echo "
                                        <div class='contentProducts__priceFinal'>$product_sale_format ₫</div>
                                        <div class='contentProducts__priceOriginal'>$product_price_format ₫</div>
                                    ";
                                } else {

                                    echo "<div class='contentProducts__priceFinal'>$product_price_format ₫</div>";

                                }

                            ?>
                        </div>
                        <div class="contentProducts__info">
                            <p class="contentProducts__link"><span>chi tiết</span><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-plus" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#a346ce" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z"/>
                            <circle cx="12" cy="12" r="9" />
                            <line x1="9" y1="12" x2="15" y2="12" />
                            <line x1="12" y1="9" x2="12" y2="15" />
                            </svg>
                            </p>
                            <div class="contentProducts__view cta cta02"><span>Xem</span></div>
                        </div>
                    </div>
                </a>
            <?php } } ?>
            <!-- end php get product -->
            </div>
            <div class="ctaContainer anime">
                <a href="shop.php" class="cta cta01">xem thêm</a>
            </div>
        </div>
    </section>
    <!--end Products-->

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
        <p class="footer__text">A project made by <a href="github.com/Conan286" target="_blank" rel="noopener"
                class="link">Huy</a></p>
        <div class="footer__icons">

            <a href="#" target="_blank" rel="noopener"
                class="footer__icon linkedin"><span></span>
                <p>Linkedin</p>
            </a>

            <a href="#" target="_blank" rel="noopener"
                class="footer__icon dribbble"><span></span>
                <p>Dribbble</p>
            </a>

            <a href="#" target="_blank" rel="noopener"
                class="footer__icon codepen"><span></span>
                <p>Codepen</p>
            </a>
        </div>
    </footer>
    <!--end Footer-->

    <!--Script Files-->
    <script src="js/swiper.min.js"></script>
    
    <!--General-->
    <script src="js/main.js"></script>
    <script src="js/result.js"></script>
    <script src="js/backTop.js"></script>
    <!--end Script Files-->
</body>
</html>