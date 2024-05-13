
window.addEventListener("load", event => {
    // Anime Modules
    let delay = 1;
    observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.intersectionRatio > 0) {
                entry.target.classList.add('animeModules');
                //entry.target.style.transitionDelay = `${delay}` * 0.2 + "s";
                // delay++;
            }
        });
    });

    function animeModules() {
        document.querySelectorAll('section').forEach(el => observer.observe(el))
        document.querySelectorAll('header').forEach(el => observer.observe(el))
    }

    animeModules();
});

function mainNav() {
    
    const mainNav = document.querySelector('.mainNav'),
        logo = document.querySelector('.mainNav__logo.home img');

    window.onscroll = function () {
        if (window.pageYOffset >= 60) {
            mainNav.classList.add("fixed");
            logo.src = "assets/images/logo.svg";
        } else {
            mainNav.classList.remove("fixed");
            logo.src = "assets/images/logo-white.svg";
        }
    }

    // Open Menu Mobile
    const iconNav = document.querySelector('.mainNav__icon'),
        link = document.querySelectorAll('.mainNav__link');
    iconNav.addEventListener('click', openNavMobile);

    function openNavMobile() {
        if (mainNav.classList.contains('navOpen')) {
            mainNav.classList.remove('navOpen');
            document.querySelector('body').style.overflowY = "initial";
            if (window.innerWidth < 799) {
                setTimeout(() => {
                    document.querySelector('.mainNav .mainNav__wrapper').style.height = "auto";
                }, 600);
            }

        } else {
            mainNav.classList.add('navOpen');
            document.querySelector('body').style.overflowY = "hidden";
            if (window.innerWidth < 799) {
                document.querySelector('.mainNav.navOpen .mainNav__wrapper').style.height = window.innerHeight + "px";
            }
        }
    }

    if (window.innerWidth < 799) {
        link.forEach(function (el) {
            el.addEventListener("click", openNavMobile)
        });
    }

};

mainNav();

/*********************************/
// Slider Heading

function sliderHeading() {

    var mySwiper = new Swiper('.sliderHeading__slider.swiper-container', {
        // Optional parameters
        loop: true,
        speed: 500,

        // If we need pagination
        pagination: {
            el: '.sliderHeading .swiper-pagination',
        },

        // Navigation arrows
        navigation: {
            nextEl: '.sliderHeading .swiper-button-next',
            prevEl: '.sliderHeading .swiper-button-prev',
        },
    });



};

sliderHeading();

/********************************/
// Content Media - About

function contentMedia() {
    const sliderAboutItems = [{
            img: `assets/images/slide.jpg`,
            alt: " ",
        },
        {
            img: `assets/images/slide02.jpg`,
            alt: " ",
        },
        {
            img: `assets/images/intro03.jpg`,
            alt: " ",
        },
        {
            img: `assets/images/intro04.jpg`,
            alt: " ",
        },
    ];

    const contentMedia = [{
            img: `assets/images/default4.jpg`,
            alt: "alt",
            title: "Giới thiệu",
            text: "Thiết kế độc quyền của thương hiệu thời trang Lalla. Form đẹp, thanh lịch, hiện đại, chất liệu cao cấp là những gì Lalla muốn gửi gắm vào những thiết kế riêng độc quyền của mình. Chào mừng đến với cửa hàng thời trang của chúng tôi!",
            ctaText: "Đọc thêm",
            ctaStyle: "cta01"
        },

    ];

    contentMedia.forEach(function (el) {
        let template =`

        <div class="contentMedia__wrapper">
            <div class="contentMedia__sliderContainer">
                <div class="contentMedia__slider swiper-container anime">
                    <div class="swiper-wrapper">
                    </div>
                </div>

                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-pagination"></div>
            </div>

            <div class="contentMedia__content">
                <h2 class="contentMedia__title mainTitle anime">${el.title}</h2>
                <p class="contentMedia__description anime">${el.text}</p>
                <div class="ctaContainer anime"><a href="#" target="_blank" rel="noopenner" class="cta ${el.ctaStyle}">${el.ctaText}</a></div>
            </div>
        </div>`;
        
        document.querySelector('.contentMedia.about').insertAdjacentHTML("beforeend", template);


        sliderAboutItems.forEach(function (el) {
            let templateSlider = `
                <div class="swiper-slide">
                    <figure class="contentMedia__image anime">
                        <img src="${el.img}" alt="${el.alt}">
                    </figure>
                </div>`;
            document.querySelector(".contentMedia.about .swiper-wrapper").insertAdjacentHTML("beforeend", templateSlider);
    
        });
    
        var mySwiper = new Swiper('.contentMedia__slider.swiper-container', {
            // Optional parameters
            loop: true,
            speed: 500,
    
            // If we need pagination
            pagination: {
                el: '.contentMedia .swiper-pagination',
                clickable: 'true'
            },
    
            // Navigation arrows
            navigation: {
                nextEl: '.contentMedia .swiper-button-next',
                prevEl: '.contentMedia .swiper-button-prev',
            },
        });


    });
};

contentMedia();

/******************************/
// Products

/*********************************/
// Product Slider

function productSlider() {

    var mySwiper = new Swiper('.productSlider__slider.swiper-container', {
        // Optional parameters
        loop: true,
        speed: 500,
        slidesPerView: 4,
        spaceBetween: 32,

        breakpoints: {
            1023: {
                slidesPerView: 4,
            },
            799: {
                spaceBetween: 24,
                slidesPerView: 3,
            },
            511: {
                spaceBetween: 24,
                slidesPerView: 2,
            },
            0: {
                spaceBetween: 24,
                slidesPerView: 1,
            }

        },

        // If we need pagination
        pagination: {
            el: '.productSlider .swiper-pagination',
        },
        // Navigation arrows
        navigation: {
            nextEl: '.productSlider .swiper-button-next',
            prevEl: '.productSlider .swiper-button-prev',
        },
    });
};

productSlider();


/*********************************/
// Content Media - Collections

function contentMedia2() {
    const contentMedia = [{
            img: `assets/images/contentMedia01.jpg`,
            alt: "alt",
            title: "Collection",
            text: "Nhẹ nhàng, phong cách thanh lịch, hiện đại. Sự kết hợp tinh tế với 2 sắc màu hot trend trong năm là hồng thạch anh và xanh baby blue sẽ thổi một luồng gió mới đầy ngọt ngào và trẻ trung vào phong cách thời trang thanh lịch vốn có của bạn.",
            ctaText: "Đọc thêm",
            ctaStyle: "cta01"
        },

    ];

    contentMedia.forEach(function (el) {
        let template =`

        <div class="contentMedia__wrapper">
            <figure class="contentMedia__image animeImg">
                <img src="${el.img}" alt="${el.alt}">
            </figure>
            <div class="contentMedia__content">
                <h2 class="contentMedia__title mainTitle anime">${el.title}</h2>
                <p class="contentMedia__description anime">${el.text}</p>
                <div class="ctaContainer anime"><a href="#" target="_blank" rel="noopenner" class="cta ${el.ctaStyle}">${el.ctaText}</a></div>
            </div>
        </div>`;
        
        document.querySelector('.contentMedia.vineyards').insertAdjacentHTML("beforeend", template);
    })
};

contentMedia2();

/*********************************/
// Highlight Slider -  Testimonials 

function templateTestimonials() {

    const testimonials = {
        title: "Khách Hàng Nhận Xét",
        img: "images/bgtestimonials.jpg",
        alt: "teste"
    }

    let template = `
        <figure class="highlightSlider__bgImage animeImg">
            <img src="assets/${testimonials.img}" alt="${testimonials.alt}">
        </figure>
        <div class="highlightSlider__wrapper">
            <div class="highlightSlider__heading">
                <h3 class="highlightSlider__title">${testimonials.title}</h3>
            </div>
            <div class="highlightSlider__slider swiper-container">
                <div class="swiper-wrapper">
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>`;
    document.querySelector('.highlightSlider.testimonials').insertAdjacentHTML("beforeend", template);
};

function templateQuotesItem() {
    
    const quotes = [{
            name: "John doe",
            text: "Biết nói gì đây, Thiết kế của Lalla thật mong manh thuần khiết.",
        },
        {
            name: "Maria doe",
            text: "Ngọt ngào, sang chảnh tối đa với mẫu, Chất liệu cao cấp và form dáng đơn giản nhưng tính ứng dụng cao mang lại cho người mặc sự tao nhã.",
        },
        {
            name: "Midu",
            text: "Thiết kế siêu tôn dáng, chất liệu mềm mại lên form người vô cùng thoải mái.",
        }
    ];

    quotes.forEach(function (el) {
        let template = `
            <div class="swiper-slide">
                <div class="highlightSlider__content">
                    <div class="highlightSlider__text">
                        <p class="highlightSlider__subtitle anime">${el.text}</p>
                        <p class="highlightSlider__description anime">${el.name}</p>
                    </div>
                </div>
            </div>`;
        document.querySelector(".highlightSlider.testimonials .swiper-wrapper").insertAdjacentHTML("beforeend", template);
    });

    var mySwiper = new Swiper('.testimonials .highlightSlider__slider.swiper-container', {
        // Optional parameters
        loop: true,
        speed: 500,

        // If we need pagination
        pagination: {
            el: '.highlightSlider .swiper-pagination',
        },

        // Navigation arrows
        navigation: {
            nextEl: '.highlightSlider .swiper-button-next',
            prevEl: '.highlightSlider .swiper-button-prev',
        },
    });
}

templateTestimonials();
templateQuotesItem();

/*********************************/
// CTA Block

function ctaBlock() {
    const ctaBlock = [{
        img: `assets/images/content03.jpg`,
        alt: "Wrist watch photo close up",
        title: "Liên lạc",
        subtitle: "Liên hệ với chúng tôi nếu bạn có câu hỏi hoặc nhận xét và chúng tôi sẽ liên hệ lại với bạn sớm nhất có thể!",
        text: "",
        ctaText: "Gửi email",
        ctaStyle: "cta01"
    }];

    ctaBlock.forEach(function (el) {
        let template = `
        <div class="ctaBlock__wrapper">
            
            <div class="ctaBlock__content">
            <div class="ctaBlock__text">
                <h2 class="ctaBlock__title mainTitle anime">${el.title}</h2>
                <h3 class="ctaBlock__subtitle anime">${el.subtitle}</h3>
                <div class="ctaContainer anime"><a href="" class="cta ${el.ctaStyle}"><span>${el.ctaText}</span></a></div>
                </div>
            </div>
        </div>`;

        document.querySelector('.ctaBlock.one').insertAdjacentHTML("beforeend", template);
    });
};
ctaBlock();