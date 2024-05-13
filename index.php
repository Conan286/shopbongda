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
    <title>Lalla | Trang chủ</title>
    <!--css swiper-->
    <link rel="stylesheet" href="css/swiper-bundle.css">
    <!--css files-->
    <link rel="stylesheet" href="css/main.css">
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

    <!--Slider Heading-->
    <header class="sliderHeading white neu-09">
        
        <div class="sliderHeading__wrapper">
            <div class="sliderHeading__text anime">
                <h2 class="sliderHeading__title mainTitle">Sự lựa chọn cho mọi sở thích.</h2>
            </div>
                
            <div class="sliderHeading__slider swiper-container anime">
            <div class="sliderHeading__arrows">
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
                <div class="swiper-wrapper">
                    <!-- php get slider heading -->

                    <?php
                        
                        $get_slides = "select * from slides";

                        $run_slides = mysqli_query($conn, $get_slides);

                        while ($row_slides = mysqli_fetch_array($run_slides)) {

                            $slide_image = $row_slides['slide_image'];
                        

                    ?>

                    <div class="swiper-slide">
                        <figure class="sliderHeading__image anime">
                            <img src="admin/<?php echo $slide_image; ?>" alt="slider image">
                        </figure>
                    </div>

                    <?php } ?>
                    <!-- end php get slider heading -->
                </div>
                <div class="swiper-pagination"></div>
            </div>
            <p class="sliderHeading__scroll anime2">Khám phá</p>
        </div>
    </header>
    <!--end Slider Heading-->
    
    <section class="contentMedia white neu-01 about" id="intro"></section>

    <!--Products-->
    <section class="contentProducts">
        <div class="contentProducts__wrapper">
            <div class="contentProducts__heading">
                <h3 class="contentProducts__title anime">Sản phẩm mới</h3>
            </div>
            <div class="contentProducts__cards">
                <!-- php get product -->
                <?php 

                    $get_products = "select * from products order by 1 DESC";

                    $run_products = mysqli_query($conn, $get_products);

                    while ($row_products = mysqli_fetch_array($run_products)) {

                        $product_id = $row_products['product_id'];

                        $product_title = $row_products['product_title'];

                        $product_price = $row_products['product_price'];
                        $product_price_format = number_format((float)$product_price, 0, ',', '.');

                        $product_image_1 = $row_products['product_image_1'];

                        $product_label = $row_products['product_label'];

                        $product_sale = $row_products['product_sale'];
                        $product_sale_format = number_format((float)$product_sale, 0, ',', '.');

                
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
                            <p class="contentProducts__link"><span>chi tiết</span><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-circle-plus" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#7E56C8" fill="none" stroke-linecap="round" stroke-linejoin="round">
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
            <?php } ?>
            <!-- end php get product -->
            </div>
            <div class="ctaContainer anime">
                <a href="shop.php" class="cta cta01">Xem thêm</a>
            </div>
        </div>
    </section>
    <!--end Products-->

    <!-- Product Slider -->
    <section class="productSlider neu-09 white" id="products">
        <div class="productSlider__wrapper">
            <div class="productSlider__heading">
                <h3 class="productSlider__title mainTitle anime">Sản phẩm nổi bật</h3>
            </div>
            <div class="productSlider__sliderContainer">
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>

                <div class="productSlider__slider swiper-container">
                    <div class="swiper-wrapper">
                    <!-- php get product -->
                        <?php 

                            $get_products = "select * from products order by 1 DESC LIMIT 0,8";

                            $run_products = mysqli_query($conn, $get_products);

                            while ($row_products = mysqli_fetch_array($run_products)) {

                                $product_id = $row_products['product_id'];

                                $product_title = $row_products['product_title'];

                                $product_image_1 = $row_products['product_image_1'];

                        
                        ?>

                        <div class="swiper-slide anime">
                            <a class="productSlider__card" href="details.php?product_id=<?php echo $product_id; ?>">
                                <figure class="productSlider__image">
                                    <img src="admin/<?php echo $product_image_1; ?>" alt="<?php echo $product_title; ?>">
                                </figure>
                                <div class="productSlider__text">
                                    <h4 class="productSlider__productTitle"><?php echo $product_title; ?></h4>
                                    <p class="productSlider__link ctaLink">Xem chi tiết</p>
                                </div>
                            </a>
                        </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
            <div class="ctaContainer anime">
                <a href="" class="cta cta01"><span>Xem thêm</span></a>
            </div>
        </div>
    </section>
    <!-- end Product Slider-->
    
    <section class="contentMedia neu-01 vineyards right" id=""></section>

    <!-- Highlight Slider -->
    <section class="highlightSlider white testimonials"></section>
    <!-- end Highlight Slider -->

    <!-- cta Block -->
    <section class="ctaBlock one neu-01" id="contacts"></section>
    <!-- end cta Block-->

    <!--Back to top-->
    <div id="scrollme">
        <div class="backtop">
            <span class="arrow-top">
                <p>Về đầu trang</p>
            </span>
        </div>
    </div>
    <!--end Back to top-->

    <!--Footer-->
    <footer class="footer">
       <p class="footer__text">A project made by <a href="https://github.com/Conan286" target="_blank" rel="noopener"
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
    <script src="js/swiper-bundle.js"></script>
    
    <!--General-->
    <script src="js/main.js"></script>
    <script src="js/backTop.js"></script>
    <!--end Script Files-->
</body>
</html>