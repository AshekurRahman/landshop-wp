;
(function ($) {
    "use strict";
    $(document).on('ready', function () {

        $('.nav_sidebar_toggle').on('click', function(){
            $('body').toggleClass('nav_sidebar_open');
        });

        $('.header_alert .close').on('click', function(){
            $(this).closest('.header_alert').slideUp();
        });        

        // Select all links with hashes
        $('.navbar__area .nav__menu a[href*="#"]').not('[href="#"]').not('[href="#0"]').on('click', function (event) { if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) { var target = $(this.hash); target = target.length ? target : $('[name=' + this.hash.slice(1) + ']'); if (target.length) { event.preventDefault(); $('html, body').animate({ scrollTop: target.offset().top }, 1000, function () { var $target = $(target); $target.focus(); if ($target.is(":focus")) { return false; } else { $target.attr('tabindex', '-1'); $target.focus(); }; }); } } });


        $('.mobile__menu .nav li .collapse__menu').on('click', function(){
            $(this).find('.fa-regular').toggleClass('fa-minus fa-plus');
            $(this).siblings('ul').slideToggle();
        });
        
        

        //$('.navbar__area .nav__menu .nav').clone().addClass('mobile__menu').appendTo('.navbar__area .container');

        $('.mobile__menu__toggle').on('click', function () {
            var toggole_icon = $(this).find('.fa-regular');
            toggole_icon.toggleClass('fa-bars');
            toggole_icon.toggleClass('fa-times');
            $('.mobile__menu').slideToggle();
        });

        if (typeof imagesLoaded == 'function') {
            $('.masonrys > *').addClass('masonry-item');
            var $boxes = $('.masonry-item');
            $boxes.hide();
            var $container = $('.masonrys');
            $container.imagesLoaded(function () {
                $boxes.fadeIn();
                $container.masonry({
                    itemSelector: '.masonry-item',
                });
            });
        }

        $('.form-submit .submit').addClass('primary_button small-button');

        //Scroll back to top
        var progressPath = document.querySelector('.progress__wrap path');
        if (progressPath) {
            var pathLength = progressPath.getTotalLength();
            progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
            progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
            progressPath.style.strokeDashoffset = pathLength;
            progressPath.getBoundingClientRect();
            progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
            var updateProgress = function () {
                var scroll = $(window).scrollTop();
                var height = $(document).height() - $(window).height();
                var progress = pathLength - (scroll * pathLength / height);
                progressPath.style.strokeDashoffset = progress;
            }
            updateProgress();
            $(window).scroll(updateProgress);
            var offset = 50;
            var duration = 550;
            jQuery(window).on('scroll', function () {
                if (jQuery(this).scrollTop() > offset) {
                    jQuery('.progress__wrap').addClass('active-progress');
                } else {
                    jQuery('.progress__wrap').removeClass('active-progress');
                }
            });
            jQuery('.progress__wrap').on('click', function (event) {
                event.preventDefault();
                jQuery('html, body').animate({
                    scrollTop: 0
                }, duration);
                return false;
            });
        }

        /*--- Sticky_Menu ---*/
        var navSticky = $("[data-sticky]");
        var navOffset = navSticky.data('sticky');        
        jQuery(window).on('scroll', function () {
            if (jQuery(this).scrollTop() > navOffset) {
                $('body').addClass('sticky');
            } else {
                $('body').removeClass('sticky');
            }
        });
    });

    $(window).on("load", function () {
        $(".preloader").fadeOut(500);
        $(".post-single").fitVids();
    });
})(jQuery);