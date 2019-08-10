/*---------------------------------------------
Template name:  Avivon
Version:        1.0
Author:         layerdrops
Author Email:   layerdrops@gmail.com

[Table of Content]

Warning: do not edit anything here, if want to change anything then we created a empty
js file for your testing that name is (custom.js) in js folder, edit and test in this file.
and you will link this file as we linked script files on the body tag

01: preloader
02: menu-area scrolling effects
02: office-list owl-carousel control
03: testimonial-list owl-carousel control
04: client-logo owl-carousel control
05: quote-slide owl-carousel control
06: site-open control
07: menu-close and body-overlay control
08: scroll top animation
09: scroll top control
10: skill-area skills skill control

----------------------------------------------*/


$(document).on('ready', function () {
    "use strict"; // Start of use strict

    // start preloader
    $(window).on('load', function(){
        $('#loading-area').fadeOut(2000);
        $('#loading-area').delay('500').fadeOut(2000);
    });
    // end preloader


    // start menu-area scrolling effects
    $(window).on('scroll', function () {
        if ($(window).scrollTop()) {
            $('.menu-area, .menu-area-3, .menu-full-box, .logo-box, .contact-para').addClass('active');
        }else {
            $('.menu-area, .menu-area-3, .menu-full-box, .logo-box, .contact-para').removeClass('active');
        }
    });
    // end menu-area scrolling effects


    // start office-list owl-carousel control
    $('.office-list').owlCarousel({
        loop: true,
        items: 4,
        nav: false,
        dots: true,
        smartSpeed: 500,
        autoplay: true,
        margin: 10,
        responsive:{
            320:{
                items:1,
            },
            479:{
                items:1,
            },
            480:{
                items:1,
            },
            600:{
                items:2,
            },
            1000:{
                items:3,
            },
            1920:{
                items:4,
            },
            1440:{
                items:4,
            },
            1366:{
                items:4,
            },
            1280:{
                items:4,
            }
        }
    });
    //end office-list owl-carousel control


    // start testimonial-list owl-carousel control
    $('.testimonial-list').owlCarousel({
        loop: true,
        items: 5,
        nav: false,
        dots: true,
        smartSpeed: 500,
        autoplay: true,
        margin: 25,
        responsive:{
            320:{
                items:1,
            },
            479:{
                items:1,
            },
            480:{
                items:1,
            },
            575:{
                items:1,
            },
            600:{
                items:2,
            },
            1000:{
                items:3,
            },
            1920:{
                items:5,
            },
            1440:{
                items:5,
            },
            1366:{
                items:5,
            },
            1280:{
                items:5,
            }
        }
    });
    //end testimonial-list owl-carousel control


    // start client-logo owl-carousel control
    $('.client-logo').owlCarousel({
        loop: true,
        items: 5,
        nav: false,
        dots: false,
        smartSpeed: 500,
        autoplay: true,
        margin: 60,
        responsive:{
            320:{
                items:2,
                margin: 10,
            },
            479:{
                items:2,
            },
            480:{
                items:2,
            },
            600:{
                items:3,
            },
            1000:{
                items:5,
            },
            1920:{
                items:5,
            },
            1440:{
                items:5,
            },
            1366:{
                items:5,
            },
            1280:{
                items:5,
            }
        }
    });
    //end client-logo owl-carousel control


    // start quote-slide owl-carousel control
    $('.quote-slide').owlCarousel({
        loop: true,
        items: 1,
        nav: false,
        dots: false,
        smartSpeed: 500,
        autoplay: true
    });
    //end quote-slide owl-carousel control


    // start site-open control
    $(document).on('click', '.site-open', function () {
        $(".offcanvas-menu").addClass('active');
        $(".body-overlay").addClass('active');
    });
    // end site-open control

    // start menu-close and body-overlay control
    $(document).on('click', '.menu__close, .body-overlay', function () {
        $(".offcanvas-menu").removeClass('active');
        $(".body-overlay").removeClass('active');
    });
    // end menu-close and body overlay control

    // start scroll top animation
    $(document).on('click', '#scroll-top', function () {
        $('html, body').animate({scrollTop:0},1000);
    });
    //end scroll top animation

    // start scroll top control
    var scrollButton = $('#scroll-top');
    $(window).on('scroll', function () {
        if($(this).scrollTop()>= 400){
            scrollButton.show();
        }else{
            scrollButton.hide();
        }
    });
    //end scroll top control

    // start skill-area skills skill control
    $(window).on('scroll', function () {
        var my_skill = '.skill-area .skills .skill';
        if ($(my_skill).length !== 0){
            spy_scroll(my_skill);
        }
    });
    // end skill-area skills skill control

        function isotopeActivator() {
        if ($('.masonary-layout').length) {
            $('.masonary-layout').isotope({
                layoutMode: 'masonry',
                itemSelector: '.masonary-item'
            });
        }

        if ($('.post-filter').length) {
            var postFilterList = $('.post-filter li');
            postFilterList.children('span').on('click', function() {
                var Self = $(this);
                var selector = Self.parent().attr('data-filter');
                postFilterList.children('span').parent().removeClass('active');
                Self.parent().addClass('active');


                $('.filter-layout').isotope({
                    filter: selector,
                    animationOptions: {
                        duration: 500,
                        easing: 'linear',
                        queue: false
                    }
                });
                return false;
            });
        }

        if ($('.post-filter.has-dynamic-filter-counter').length) {
            // var allItem = $('.single-filter-item').length;

            var activeFilterItem = $('.post-filter.has-dynamic-filter-counter').find('li');

            activeFilterItem.each(function() {
                var filterElement = $(this).data('filter');
                var count = $('.gallery-content').find(filterElement).length;
                $(this).children('span').append('<span class="count"><b>' + count + '</b></span>');
            });
        }
    }
    $(window).on('load', function() {
        isotopeActivator();

        if ($(window).width() < 1200) {
            if ($('.masonary-destroy-lg').length) {
                $('.masonary-destroy-lg').isotope('destroy');
            }
        }
    });

    $(window).on('resize', function() {
        // deactvating masonary
        if ($('.masonary-layout').length) {
            $('.masonary-layout').isotope('destroy');
        }
        // reactvating masonary
        isotopeActivator();

        if ($(window).width() < 1200) {
            if ($('.masonary-destroy-lg').length) {
                $('.masonary-destroy-lg').isotope('destroy');
            }
        }

    });

});