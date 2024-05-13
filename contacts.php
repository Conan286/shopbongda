<?php

    session_set_cookie_params('86400');
    session_start();
    include("includes/db.php");
    include("functions/functions.php");

?>

<?php error_reporting(0);?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PSport | Giỏ hàng</title>
    <!--css files-->
    <link rel="stylesheet" href="css/contacts.css">
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

    <!--Content-->
    <div class="wrapper">
        <div class="sectionTitleWrapper">
            <h3 class="sectionTitle">Liên hệ</h3>
        </div>
        <div class="info">
            <div class="info_map">
            <iframe src="https://maps.google.com/maps?width=600&amp;height=400&amp;hl=en&amp;q=ptit&amp;t=p&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" width="600" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
 </div>
            <div class="info_content">
                <p>Km 10, Đường Nguyễn Trãi, Hà Nội</p>   
                <p>MỞ HÀNG NGÀY: 9:00 AM - 10:00 PM.</p>
                <p>0686.686.686 ĐỂ ĐẶT HÀNG vui lòng inbox facebook của chúng tôi hoặc truy cập trang web của chúng tôi.</p>
            </div>
        </div>
    </div>

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

            $(document).on('keyup','.quantity',function() {

                    var id = $(this).data("product_id");
                    var quantity = $(this).val();

                    if(quantity !='') {

                        $.ajax({

                            url: "change.php",
                            method: "POST",
                            data:{id:id, quantity:quantity},

                            success:function() {
                                $("body").load("cart_body.php");
                            }

                        });

                    }

            });

        });

    </script>
    <!--end Script Files-->
</body>
</html>