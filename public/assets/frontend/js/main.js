(function ($) {
    "use strict";

    /*-------------------------------------
    Popup
    -------------------------------------*/
    var yPopup = $(".popup-youtube");
    if (yPopup.length) {
        yPopup.magnificPopup({
            disableOn: 700,
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
    }

    if ($('.elv-zoom-single').length) {
        $('.elv-zoom-single').magnificPopup({type: 'image'});
    }

    if ($('.zoom-gallery').length) {
        $('.zoom-gallery').each(function () { // the containers for all your galleries
            $(this).magnificPopup({
                delegate: 'a.elv-zoom', // the selector for gallery item
                type: 'image',
                gallery: {
                    enabled: true
                }
            });
        });
    }

    /*-------------------------------------
     jQuery MeanMenu activation code
     --------------------------------------*/
    $('nav#dropdown').meanmenu({siteLogo: "<a href='index.html'><img src='http://localhost/assets/frontend/img/logo2.png' alt='logo3' class='img-fluid logo'></a>"});

    /*-------------------------------------
     Wow js Active
    -------------------------------------*/
    new WOW().init();

    /*-------------------------------------
     Jquery Scollup
     -------------------------------------*/
    $.scrollUp({
        scrollText: '<i class="fa fa-angle-double-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    });

    /*-------------------------------------
    Circle Bars - Knob
    -------------------------------------*/
    if (typeof($.fn.knob) != 'undefined') {
        $('.knob.knob-nopercent').each(function () {
            var $this = $(this),
                knobVal = $this.attr('data-rel');
            $this.knob({
                'draw': function () {
                }
            });
            $this.appear(function () {
                $({
                    value: 0
                }).animate({
                    value: knobVal
                }, {
                    duration: 2000,
                    easing: 'swing',
                    step: function () {
                        $this.val(Math.ceil(this.value)).trigger('change');
                    }
                });
            }, {accX: 0, accY: -150});
        });
    }

    /*-------------------------------------
     Window load function
     -------------------------------------*/
    $(window).on('load', function () {

        /*-------------------------------------
        Page Preloader
        -------------------------------------*/
        $('#preloader').fadeOut('slow', function () {
            $(this).remove();
        });
        /*-------------------------------------
        jQuery for Isotope initialization
        -------------------------------------*/
        var $container = $('#isotope-container');
        if ($container.length > 0) {
            var $isotope = $container.find('.featuredContainer').isotope({
                filter: '*',
                animationOptions: {
                    duration: 750,
                    easing: 'linear',
                    queue: false
                }
            });
            $container.find('.isotope-classes-tab').on('click', 'a', function () {
                var $this = $(this);
                $this.parent('.isotope-classes-tab').find('a').removeClass('current');
                $this.addClass('current');
                var selector = $this.attr('data-filter');
                $isotope.isotope({
                    filter: selector,
                    animationOptions: {
                        duration: 750,
                        easing: 'linear',
                        queue: false
                    }
                });
                return false;
            });
        }
    });

    /*-------------------------------------
     Auto height for product listing
     -------------------------------------*/
    $(window).on('load resize', function() {
        var wHeight = $(window).height(),
            mLogoH = $('a.logo-mobile-menu').outerHeight();
        wHeight = wHeight - 50;
        $('.mean-nav > ul').css('height', wHeight + 'px');
        headerNsliderResize();
    });

    /*-------------------------------------
     Accordion
     -------------------------------------*/
    var accordion = $('#accordion');
    accordion.children('.panel').children('.panel-collapse').each(function () {
        if ($(this).hasClass('in')) {
            $(this).parent('.panel').children('.panel-heading').addClass('active');
        }
    });
    accordion.on('show.bs.collapse', function (e) {
        $(e.target).prev('.panel-heading').addClass('active');
    }).on('hide.bs.collapse', function (e) {
        $(e.target).prev('.panel-heading').removeClass('active');
    });

    /*-------------------------------------
    Contact Form initiating
    -------------------------------------*/
    var contactForm = $('#contact-form');
    if (contactForm.length) {
        contactForm.validator().on('submit', function (e) {
            var $this = $(this),
                $target = contactForm.find('.form-response');
            if (e.isDefaultPrevented()) {
                $target.html("<div class='alert alert-success'><p>Please select all required field.</p></div>");
            } else {
                $.ajax({
                    url: "vendor/php/contact-form-process.php",
                    type: "POST",
                    data: contactForm.serialize(),
                    beforeSend: function () {
                        $target.html("<div class='alert alert-info'><p>Loading ...</p></div>");
                    },
                    success: function (text) {
                        if (text == "success") {
                            $this[0].reset();
                            $target.html("<div class='alert alert-success'><p>Message sent successfully.</p></div>");
                        } else {
                            $target.html("<div class='alert alert-success'><p>" + text + "</p></div>");
                        }
                    }
                });
                return false;
            }
        });
    }

    /*-------------------------------------
     Google Map
    -------------------------------------*/
    if ($('#googleMap').length) {
        var initialize = function () {
            var mapOptions = {
                zoom: 15,
                scrollwheel: false,
                center: new google.maps.LatLng(-37.81618, 144.95692),
                styles: [{
                    stylers: [{
                        saturation: -100
                    }]
                }]
            };
            var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);
            var marker = new google.maps.Marker({
                position: map.getCenter(),
                animation: google.maps.Animation.BOUNCE,
                icon: 'img/map-marker.png',
                map: map
            });
        }
        // Add the map initialize function to the window load function
        google.maps.event.addDomListener(window, "load", initialize);
    }

    /*-------------------------------------
     Carousel slider initiation
     -------------------------------------*/
    $('.rc-carousel').each(function () {
        var carousel = $(this),
            loop = carousel.data('loop'),
            items = carousel.data('items'),
            margin = carousel.data('margin'),
            stagePadding = carousel.data('stage-padding'),
            autoplay = carousel.data('autoplay'),
            autoplayTimeout = carousel.data('autoplay-timeout'),
            smartSpeed = carousel.data('smart-speed'),
            dots = carousel.data('dots'),
            nav = carousel.data('nav'),
            navSpeed = carousel.data('nav-speed'),
            rXsmall = carousel.data('r-x-small'),
            rXsmallNav = carousel.data('r-x-small-nav'),
            rXsmallDots = carousel.data('r-x-small-dots'),
            rXmedium = carousel.data('r-x-medium'),
            rXmediumNav = carousel.data('r-x-medium-nav'),
            rXmediumDots = carousel.data('r-x-medium-dots'),
            rSmall = carousel.data('r-small'),
            rSmallNav = carousel.data('r-small-nav'),
            rSmallDots = carousel.data('r-small-dots'),
            rMedium = carousel.data('r-medium'),
            rMediumNav = carousel.data('r-medium-nav'),
            rMediumDots = carousel.data('r-medium-dots'),
            center = carousel.data('center');
        carousel.owlCarousel({
            loop: (loop ? true : false),
            items: (items ? items : 4),
            lazyLoad: true,
            margin: (margin ? margin : 0),
            autoplay: (autoplay ? true : false),
            autoplayTimeout: (autoplayTimeout ? autoplayTimeout : 1000),
            smartSpeed: (smartSpeed ? smartSpeed : 250),
            dots: (dots ? true : false),
            nav: (nav ? true : false),
            navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
            navSpeed: (navSpeed ? true : false),
            center: (center ? true : false),
            responsiveClass: true,
            responsive: {
                0: {
                    items: (rXsmall ? rXsmall : 1),
                    nav: (rXsmallNav ? true : false),
                    dots: (rXsmallDots ? true : false)
                },
                480: {
                    items: (rXmedium ? rXmedium : 2),
                    nav: (rXmediumNav ? true : false),
                    dots: (rXmediumDots ? true : false)
                },
                768: {
                    items: (rSmall ? rSmall : 3),
                    nav: (rSmallNav ? true : false),
                    dots: (rSmallDots ? true : false)
                },
                992: {
                    items: (rMedium ? rMedium : 5),
                    nav: (rMediumNav ? true : false),
                    dots: (rMediumDots ? true : false)
                }
            }
        });
    });

    /*-------------------------------------
     Jquery Stiky Menu at window Load
     -------------------------------------*/
    $(window).on('scroll', function () {
        var s = $('#sticker'),
            w = $('body'),
            h = s.outerHeight(),
            windowpos = $(window).scrollTop(),
            windowWidth = $(window).width(),
            h3 = s.parent('#header-three'),
            h2 = s.parent('#header-two'),
            h1 = s.parent('#header-one'),
            h1H = h1.find('.header-top-bar').outerHeight(),
            topBar = s.prev('.header-top-bar'),
            tempMenu;
        if (windowWidth > 991) {
            w.css('padding-top', '');
            var topBarH, mBottom = 0;
            if (h3.length) {
                topBarH = h = 1;
                mBottom = 0;
            } else if (h2.length) {
                mBottom = h2.find('.main-menu-area').outerHeight();
                topBarH = w.find("#top-slider").outerHeight();
                topBarH = mBottom + topBarH;
            } else if (h1.length) {
                topBarH = topBar.outerHeight();
                if (windowpos <= topBarH) {
                    if (h1.hasClass('header-fixed')) {
                        h1.css('top', '-' + windowpos + 'px');
                    }
                }
            }
            if (windowpos >= topBarH) {
                if (h1.length || h3.length) {
                    s.addClass('stick');
                }
                if (h1.length) {
                    if (h1.hasClass('header-fixed')) {
                        h1.css('top', '-' + topBarH + 'px');
                    } else {
                        w.css('padding-top', h + 'px');
                    }
                } else if (h2.length) {
                    h2.addClass('hide-menu');
                    tempMenu = h2.find('.main-menu-area').clone();
                    tempMenu.addClass('temp-main-menu stick').attr("id", '');
                    tempMenu.css({opacity: 0});
                    if (h2.find('.temp-main-menu.stick').length == 0) {
                        h2.append(tempMenu);
                        h2.find('.temp-main-menu.stick').animate({opacity: 1}, 100);
                    }
                    if (h2.find('.temp-main-menu.stick').length > 1) {
                        h2.find('.temp-main-menu.stick').last().remove();
                    }
                }
            } else {
                s.removeClass('stick');
                if (h1.length) {
                    w.css('padding-top', 0);
                } else if (h2.length) {
                    h2.removeClass('hide-menu');
                    h2.find('.stick.temp-main-menu').remove();
                }
            }
        }
    });

    function headerNsliderResize() {
        var Hh1 = $('#header-one'),
            wWidth = $(window).width(),
            Hh1slider = Hh1.parents('#wrapper').find("#header-area-space"),
            mHeight = Hh1.outerHeight();
        if (wWidth < 992) {
            mHeight = $('body > .mean-bar').outerHeight();
        }
        Hh1slider.css("margin-top", mHeight + 'px');
    }

})(jQuery);