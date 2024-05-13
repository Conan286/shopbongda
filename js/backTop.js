


    /* Back to top */

    var toTop = document.getElementById("scrollme");

    toTop.addEventListener("click", function () {
        scrollToTop(600);
    });

    function scrollToTop(scrollDuration) {
        var scrollStep = -window.scrollY / (scrollDuration / 15),
            scrollInterval = setInterval(function () {
                if (window.scrollY != 0) {
                    window.scrollBy(0, scrollStep);
                } else clearInterval(scrollInterval);
        }, 15);

    }