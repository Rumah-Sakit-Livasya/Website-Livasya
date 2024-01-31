<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="zUQMkNpBa0KPi9FqAO6eaWtbuvUjYK__y2mIee9tHVE" />
    <meta name="google-site-verification" content="qkgOTUKpY1-bXDjm3IKE9DJUzFp6SZgPjGAaGp790tk" />
    <meta name="description"
        content="Rumah Sakit Livasya merupakan Rumah Sakit di Majalengka yang menyelenggarakan pelayanan medik spesialistik atau pelayanan dasar dan spesialistik.">
    <!-- Google Tag Manager -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-528TZMT7');
    </script>
    <!-- End Google Tag Manager -->


    @if ($title === 'Home')
        <title>Rumah Sakit Livasya Majalengka</title>
    @else
        <title>RS LIVASYA MAJALENGKA | {{ $title }}</title>
    @endif

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/swiper-bundle.min.css" />
    <link href="/css/aos.css" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="/css/buttons.bootstrap4.min.css">

    {{-- SweetAlert2 --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <!-- Add the slick-theme.css if you want default styling -->
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/63ce504147425128790f20af/1gneuj0cg';
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
    <!--End of Tawk.to Script-->

    <!--Start of Fancybox Style-->
    <script src="/js/jquery.min.js"></script>
    <link rel="stylesheet" href="/css/jquery.fancybox.min.css">
    <script src="/js/jquery.fancybox.min.js"></script>
    <!--End of Fancybox Style-->

    <!-- custom css file link  -->
    <script src="/js/splide.min.js"></script>
    <link rel="stylesheet" href="/css/splide.min.css">
    <link rel="stylesheet" href="/css/timeline.css">
    <link rel="stylesheet" href="/css/waves.css">
    <link rel="stylesheet" href="/css/style.css">

    <link rel="shortcut icon" href="/img/logo.ico" type="image/x-icon">

</head>

<body class="m-0">

    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-528TZMT7" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <div class="position-fixed"></div>

    <!-- header section starts  -->

    @include('partials/navbar')

    <!-- header section ends -->

    <!-- home section starts  -->

    @yield('container')

    @include('partials.footer')

    <script src="/js/footer.jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="/js/swiper-bundle.min.js"></script>
    <script src="/js/bootstrap.bundle.min.js"></script>
    <script src="/js/aos.js"></script>
    <script type="text/javascript" src="/js/slick.js"></script>
    <script src="/js/adminlte.js"></script>
    <script src="/js/purecounter_vanilla.js"></script>
    <script src="/js/gsap.min.js"></script>
    <script src="/js/text-plugin.min.js"></script>
    <script>
        // Konfigurasi GSAP
    </script>
    <script>
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
            separator: false // This will enable/disable comma separator for thousands. Use it for set the symbol too [boolean|char|string]
        });
    </script>

    <!-- custom js file link  -->
    <script src="/js/script.js"></script>

    <script>
        // Dropdown Menu Fade    
        jQuery(document).ready(function() {
            $(".dropdown").hover(
                function() {
                    $('.dropdown-menu', this).fadeIn("fast");
                },
                function() {
                    $('.dropdown-menu', this).fadeOut("fast");
                });
        });

        document.addEventListener('DOMContentLoaded', function() {
            new Splide('.splide', {
                type: 'loop',
                perPage: 1,
                pauseOnHover: true,
                autoplay: true,
                interval: 2000,
                pagination: false,
            }).mount();
        });

        AOS.init({
            once: true
        });

        $('.slider-single').slick({
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

            cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)',
        });

        $('.slider-nav')
            .on('init', function(event, slick) {
                $('.slider-nav .slick-slide.slick-current').addClass('is-active');
            })
            .slick({
                slidesToShow: 3,
                slidesToScroll: 3,
                dots: false,
                focusOnSelect: false,
                infinite: false,
                responsive: [{
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 5,
                        slidesToScroll: 5,
                    }
                }, {
                    breakpoint: 640,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                    }
                }, {
                    breakpoint: 420,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3,
                    }
                }]
            });

        $('.slider-single').on('afterChange', function(event, slick, currentSlide) {
            $('.slider-nav').slick('slickGoTo', currentSlide);
            var currrentNavSlideElem = '.slider-nav .slick-slide[data-slick-index="' + currentSlide + '"]';
            $('.slider-nav .slick-slide.is-active').removeClass('is-active');
            $(currrentNavSlideElem).addClass('is-active');
        });

        $('.slider-nav').on('click', '.slick-slide', function(event) {
            event.preventDefault();
            var goToSingleSlide = $(this).data('slick-index');

            $('.slider-single').slick('slickGoTo', goToSingleSlide);
        });
    </script>

    <!-- DataTables -->
    <script src="/js/jquery.dataTables.min.js"></script>
    <script src="/js/dataTables.bootstrap4.min.js"></script>
    <script src="/js/dataTables.responsive.min.js"></script>
    <script src="/js/responsive.bootstrap4.min.js"></script>
    <script src="/js/dataTables.buttons.min.js"></script>
    <script src="/js/buttons.bootstrap4.min.js"></script>
    <script src="/js/jszip.min.js"></script>
    <script src="/js/pdfmake.min.js"></script>
    <script src="/js/vfs_fonts.js"></script>
    <script src="/js/buttons.html5.min.js"></script>
    <script src="/js/buttons.print.min.js"></script>
    <script src="/js/buttons.colVis.min.js"></script>
    <script>
        $(function() {
            $("#datatab").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "paging": false,
                "ordering": false,
                "info": false,
                "searching": false
            });
        });

        $('[data-fancybox]').fancybox({
            // Options will go here
            buttons: [
                'close'
            ],
            wheel: false,
            transitionEffect: "slide",
            // thumbs          : false,
            // hash            : false,
            loop: true,
            // keyboard        : true,
            toolbar: false,
            // animationEffect : false,
            // arrows          : true,
            clickContent: false
        });
    </script>
    <!--End of Fancybox Script-->

    @yield('plugin')

</body>

</html>
