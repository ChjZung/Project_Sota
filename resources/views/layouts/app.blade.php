<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <base href="{{ url('/') }}/">

    <title>@yield('title', setting('meta_title', 'CÔNG TY TNHH SX TM NHỰA NHỊ BÌNH | Custom Plastic Injection Molding Manufacturer in Vietnam'))</title>
    <meta name="description" content="@yield('description', setting('meta_description', 'Sản xuất các sản phẩm nhựa kỹ thuật cao theo yêu cầu của khách hàng, với nhà xưởng và máy móc hiện đại. Products are exported to the US, Japan, EU.'))">
    <meta name="keywords" content="{{ setting('meta_keywords', 'sản xuất đồ nhựa, ép nhựa, gia công khuôn nhựa, Nhựa Nhị Bình, plastic injection molding') }}">
    <link rel="icon" type="image/x-icon" href="{{ setting('favicon', '/favicon.ico') }}">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,600&family=Montserrat:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    {{-- Third Party CSS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">

    {{-- Original Site Styles --}}
    <link rel="stylesheet" href="/assets/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/fonts.css">
    <link rel="stylesheet" href="/assets/css/social.css">
    <link rel="stylesheet" href="/assets/css/style.css">

    <style>
        /* Essential compatibility and text color styling */
        body {
            overflow-x: hidden;
            background-color: #ffffff !important;
            color: #212529;
            font-family: 'Roboto', 'Montserrat', sans-serif;
        }
        .content1, .wrap-home, .wrap-main, .container, #main-content .fixwidth {
            color: #212529;
        }
        .header_name {
            color: var(--color-main, #cd171f) !important;
            font-weight: 700;
        }
        .header_slogan {
            color: #555555 !important;
        }
        .diachi-top {
            color: #555555;
        }
        .header_right .phone {
            color: #333333;
        }
        .header_right .phone:hover {
            color: var(--color-main, #cd171f);
        }

        /* Footer Styling matching nibiplastic.com with high contrast */
        #background-footer,
        .boxfooter_container {
            background-color: #2F343A !important;
            color: #ffffff !important;
            position: relative;
            padding-top: 45px;
            padding-bottom: 35px;
            font-size: 14px;
            line-height: 1.6;
        }
        .boxfooter_container .fixwidth {
            color: #ffffff !important;
        }
        .boxfooter_container .tit_ft {
            color: #ffffff !important;
            font-size: 17px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            margin-bottom: 16px !important;
            margin-top: 10px !important;
            letter-spacing: 0.5px;
        }
        .boxfooter_container .des_footer,
        .boxfooter_container .des_footer p,
        .boxfooter_container .des_footer span,
        .boxfooter_container .des_footer strong,
        .boxfooter_container .des_footer b,
        .boxfooter_container .box_cs,
        .boxfooter_container .box_cs p {
            color: #ffffff !important;
        }
        .boxfooter_container a {
            color: #ffffff !important;
            text-decoration: none;
            transition: color 0.2s ease;
        }
        .boxfooter_container a:hover {
            color: #ff4d4f !important;
        }
        .boxfooter_container .box_cs p a {
            color: #ffffff !important;
            display: inline-block;
            transition: all 0.3s ease;
        }
        .boxfooter_container .box_cs p a:hover {
            color: #ff4d4f !important;
            padding-left: 6px;
        }
        .boxfooter_bottom {
            background-color: #23272c !important;
            border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #b0b8c4 !important;
            padding: 14px 0 !important;
            font-size: 13px !important;
        }
        .boxfooter_bottom .fixwidth,
        .boxfooter_bottom div,
        .boxfooter_bottom span {
            color: #b0b8c4 !important;
        }
        /* FontAwesome Fallback to prevent square tofu glyphs */
        .fal, .far, .fas, .fa {
            font-family: "Font Awesome 6 Free", "FontAwesome" !important;
        }
        .fal {
            font-weight: 900 !important;
        }
        .fa-chevron-down::before {
            content: "\f078" !important;
        }
        .header_logo img {
            max-height: 85px;
            width: auto;
        }
        .owl-carousel .owl-item img {
            width: 100%;
            height: auto;
            display: block;
        }
        .slideshow {
            position: relative;
        }
        .control-slideshow {
            cursor: pointer;
            z-index: 10;
        }
        .frmtim {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body>
    <div id="wrapper">
        <div class="content1">
            {{-- Header & Red Menu Bar --}}
            <div class="header-cachtop">
                @include('components.header')
                @include('components.navbar')
            </div>

            {{-- Alert --}}
            @if(session('success'))
                <div class="alert alert-success text-center m-0 rounded-0" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                </div>
            @endif

            {{-- Main Content --}}
            <main id="main-content">
                @yield('content')
            </main>

            {{-- Footer --}}
            @include('components.footer')
        </div>
    </div>

    {{-- Floating Social Widgets --}}
    @include('components.social_widgets')

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        $(document).ready(function() {
            // 1. Initialize AOS (Scroll reveal fade in)
            AOS.init({
                duration: 800,
                once: false,
                offset: 50
            });

            // 2. Initialize Main Slideshow Banner
            if ($('.owl-slideshow').length) {
                var owlSlider = $('.owl-slideshow').owlCarousel({
                    items: 1,
                    loop: true,
                    autoplay: true,
                    autoplayTimeout: 4500,
                    smartSpeed: 800,
                    nav: false,
                    dots: true
                });

                $('.prev-slideshow').click(function() {
                    owlSlider.trigger('prev.owl.carousel');
                });
                $('.next-slideshow').click(function() {
                    owlSlider.trigger('next.owl.carousel');
                });
            }

            // 3. Initialize Partner / Service Carousels
            if ($(".owl-dv").length) {
                $('.owl-dv').owlCarousel({
                    loop: true,
                    autoplay: true,
                    autoplayTimeout: 3000,
                    smartSpeed: 500,
                    nav: false,
                    dots: false,
                    responsiveClass: true,
                    responsive: {
                        0: { items: 2, margin: 10 },
                        450: { items: 2, margin: 10 },
                        800: { items: 3, margin: 15 },
                        1024: { items: 4, margin: 20 }
                    }
                });
            }

            if ($(".owl-dv1").length) {
                $('.owl-dv1').owlCarousel({
                    loop: true,
                    autoplay: true,
                    autoplayTimeout: 3000,
                    smartSpeed: 500,
                    nav: false,
                    dots: false,
                    responsiveClass: true,
                    responsive: {
                        0: { items: 2, margin: 10 },
                        450: { items: 2, margin: 10 },
                        800: { items: 3, margin: 15 },
                        1024: { items: 3, margin: 20 }
                    }
                });
            }

            // 4. Slick Slider for Product / Detail if present
            if ($('.slider-for').length && $('.slider-nav').length) {
                $('.slider-for').slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    asNavFor: '.slider-nav'
                });
                $('.slider-nav').slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    asNavFor: '.slider-for',
                    dots: false,
                    centerMode: true,
                    focusOnSelect: true
                });
            }

            // 5. Search Bar Toggle
            $('.btn_tim').click(function() {
                var frm = $('.frmtim');
                if (frm.css('visibility') === 'visible') {
                    frm.css({ 'width': '0', 'opacity': '0', 'visibility': 'hidden' });
                } else {
                    frm.css({ 'width': '260px', 'opacity': '1', 'visibility': 'visible' });
                    frm.find('input').focus();
                }
            });
            $('.btn_close').click(function() {
                $('.frmtim').css({ 'width': '0', 'opacity': '0', 'visibility': 'hidden' });
            });

            // 6. Back To Top
            $(window).scroll(function() {
                if ($(this).scrollTop() > 300) {
                    $('.scrollToTop, .btn-back-to-top').fadeIn();
                } else {
                    $('.scrollToTop, .btn-back-to-top').fadeOut();
                }
            });
            $('.scrollToTop, .btn-back-to-top').click(function(e) {
                e.preventDefault();
                $('html, body').animate({ scrollTop: 0 }, 600);
            });
        });
    </script>
    @stack('scripts')
</body>
</html>