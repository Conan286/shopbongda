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
    <title>Lalla | Cửa hàng</title>
    <!--css files-->
    <link rel="stylesheet" href="css/shop.css">
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
                <div class="control">
                    <div class="control__title">Danh Mục Sản Phẩm</div>
                    <div class="control__links">
                        <?php 

                            $get_product_category = "select * from product_categories";

                            $run_product_category = mysqli_query($conn, $get_product_category);

                            while($row_product_category = mysqli_fetch_array($run_product_category)) {

                                $product_category_id = $row_product_category['product_category_id'];

                                $product_category_title = $row_product_category['product_category_title'];

                                echo "
                                    <a class='control__link' href='shop.php?product_category=$product_category_id'>$product_category_title</a>
                                ";
                            }

                        ?>
                    </div>
                </div>
                <div class="control category">
                    <div class="control__title">Thể loại</div>
                    <div class="control__links">
                        <?php 

                            $get_category = "select * from categories";

                            $run_category = mysqli_query($conn, $get_category);

                            while($row_category = mysqli_fetch_array($run_category)) {

                                $category_id = $row_category['category_id'];

                                $category_title = $row_category['category_title'];

                                echo "
                                    <a class='control__link' href='shop.php?category=$category_id'>$category_title</a>
                                ";
                            }
                        
                        ?>
                    </div>
                </div>
            </section>

            <!--Products-->
            <section class="contentProducts">
                <div class="contentProducts__wrapper">
                    <div class="contentProducts__heading">
                        <h3 class="contentProducts__title anime">Sản phẩm mới</h3>
                    </div>
                    <div class="contentProducts__cards">

                        <!-- php get product -->
                        <?php 
                        if (!isset($_GET['product_category'])) {
                            if (!isset($_GET['category'])) {

                                $per_page = 8;

                                if (isset($_GET['page'])) {
                                    
                                    $page = $_GET['page'];

                                } else {

                                    $page = 1;
                                }
                                
                            $start_from = ($page-1) * $per_page;

                            $get_products = "select * from products order by 1 DESC LIMIT $start_from, $per_page";

                            $run_products = mysqli_query($conn, $get_products);

                            while ($row_products = mysqli_fetch_array($run_products)) {

                                $product_id = $row_products['product_id'];

                                $product_title = $row_products['product_title'];

                                $product_price = $row_products['product_price'];
                                $product_price_format = number_format($product_price, 0, ',', '.');

                                $product_image_1 = $row_products['product_image_1'];

                                $product_label = $row_products['product_label'];

                                $product_sale = $row_products['product_sale'];
                                $product_sale_format = number_format((float)$product_sale, 0, ',', '.');
                                
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

                        ?>

                        <?php

                        }

                    }

                    ?>

                        <!-- end php get product -->
                        <?php get_p_category() ?>
                        <?php get_category() ?>
                        <!--end Card-->
                    </div>

                    <div class="pagination">

                        <?php 
                        
                            if (!isset($_GET['product_category'])) {
                                if (!isset($_GET['category'])) {

                                    $get_products = "select * from products";

                                    $run_products = mysqli_query($conn, $get_products);

                                    $total_records = mysqli_num_rows($run_products);
                                    
                                    $total_pages = ceil($total_records / $per_page);
            
                                    echo "<a class='pagination__link first' href='shop.php?page=1'><img src='assets/icon-back.svg' alt=''></a>";
            
                                    for ($i=1; $i<= $total_pages; $i++) {
                                        
                                        echo "<a class='pagination__link' href='shop.php?page=$i'><span>$i</span></a>";
                                    }
            
                                    echo "<a class='pagination__link last' href='shop.php?page=$total_pages'><img src='assets/icon-next.svg' alt=''></a>";
                                }
                            }

                        ?>
                    </div>
                </div>
            </section>
            <!--end Products-->
        </div>

        <!--Footer-->
        <footer class="footer">
            <p class="footer__text">A project made by <a href="https://github.com/Conan286" target="_blank"
                    rel="noopener" class="link">Huy</a></p>
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

    <!--General-->
    <script src="js/main.js"></script>
    <script src="js/shop.js"></script>
    <!--end Script Files-->
</body>

</html>