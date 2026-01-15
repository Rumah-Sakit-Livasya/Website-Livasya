// GSAP Config (Placeholder as per original)
// Konfigurasi GSAP

// PureCounter
if (typeof PureCounter !== "undefined") {
    new PureCounter({
        // Setting that can't' be overriden on pre-element
        selector: ".purecounter", // HTML query selector for spesific element

        // Settings that can be overridden on per-element basis, by `data-purecounter-*` attributes:
        start: 0, // Starting number [uint]
        end: 100, // End number [uint]
        duration: 10, // The time in seconds for the animation to complete [seconds]
        delay: 10, // The delay between each iteration (the default of 10 will produce 100 fps) [miliseconds]
        once: true, // Counting at once or recount when the element in view [boolean]
        pulse: false, // Repeat count for certain time [boolean:false|seconds]
        decimals: 0, // How many decimal places to show. [uint]
        legacy: true, // If this is true it will use the scroll event listener on browsers
        filesizing: false, // This will enable/disable File Size format [boolean]
        currency: false, // This will enable/disable Currency format. Use it for set the symbol too [boolean|char|string]
        formater: "us-US", // Number toLocaleString locale/formater, by default is "en-US" [string|boolean:false]
        separator: false, // This will enable/disable comma separator for thousands. Use it for set the symbol too [boolean|char|string]
    });
}

// Dropdown Menu Fade
if (typeof jQuery !== "undefined") {
    jQuery(document).ready(function () {
        $(".dropdown").hover(
            function () {
                $(".dropdown-menu", this).fadeIn("fast");
            },
            function () {
                $(".dropdown-menu", this).fadeOut("fast");
            }
        );
    });
}

document.addEventListener("DOMContentLoaded", function () {
    if (typeof Splide !== "undefined" && document.querySelector(".splide")) {
        new Splide(".splide", {
            type: "loop",
            perPage: 1,
            pauseOnHover: true,
            autoplay: true,
            interval: 2000,
            pagination: false,
        }).mount();
    }
});

if (typeof AOS !== "undefined") {
    AOS.init({
        once: true,
    });
}

if (typeof jQuery !== "undefined" && typeof jQuery.fn.slick !== "undefined") {
    $(".slider-single").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: false,
        adaptiveHeight: true,
        infinite: false,
        useTransform: true,
        speed: 400,
        autoplay: true,
        autoplaySpeed: 5000,

        cssEase: "cubic-bezier(0.77, 0, 0.18, 1)",
    });

    $(".slider-nav")
        .on("init", function (event, slick) {
            $(".slider-nav .slick-slide.slick-current").addClass("is-active");
        })
        .slick({
            slidesToShow: 3,
            slidesToScroll: 3,
            dots: false,
            focusOnSelect: false,
            infinite: false,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 5,
                    },
                },
                {
                    breakpoint: 640,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                    },
                },
                {
                    breakpoint: 420,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    },
                },
            ],
        });

    $(".slider-single").on(
        "afterChange",
        function (event, slick, currentSlide) {
            $(".slider-nav").slick("slickGoTo", currentSlide);
            var currrentNavSlideElem =
                '.slider-nav .slick-slide[data-slick-index="' +
                currentSlide +
                '"]';
            $(".slider-nav .slick-slide.is-active").removeClass("is-active");
            $(currrentNavSlideElem).addClass("is-active");
        }
    );

    $(".slider-nav").on("click", ".slick-slide", function (event) {
        event.preventDefault();
        var goToSingleSlide = $(this).data("slick-index");

        $(".slider-single").slick("slickGoTo", goToSingleSlide);
    });
}
