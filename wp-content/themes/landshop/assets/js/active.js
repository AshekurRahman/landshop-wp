;
(function ($) {
	"use strict";
	$(document).on('ready', function () {		
		// To Added a plus icon after sub menu parents.
		$('.nav_menu .sub-menu').parent('li').children('a').append('<i class="plus"></i>');		
		// Select all links with hashes
		$('.mainmenu-area .primary-menu a[href*="#"]').not('[href="#"]').not('[href="#0"]').on('click', function (event) {if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {var target = $(this.hash); target = target.length ? target : $('[name=' + this.hash.slice(1) + ']'); if (target.length) { event.preventDefault(); $('html, body').animate({ scrollTop: target.offset().top }, 1000, function () { var $target = $(target); $target.focus(); if ($target.is(":focus")) { return false; } else { $target.attr('tabindex', '-1'); $target.focus(); }; }); } } });
		
		$('.nav_area .nav_menu').slicknav({
            label: '',
            duration: 500,
            prependTo: '',
            closedSymbol: '<i class="far fa-plus"></i>',
            openedSymbol: '<i class="far fa-minus"></i>',
            appendTo: '.nav_area .container-wide',
            menuButton: '#nav_mobile_toggle',
            closeOnClick: 'true' // Close menu when a link is clicked.
        });
        
        $('#nav_mobile_toggle').on('click',function(){
            var toggole_icon = $(this).find('.fal');
            toggole_icon.toggleClass('fa-bars');
            toggole_icon.toggleClass('fa-times');
            
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
		        
        //Scroll back to top
        var progressPath = document.querySelector('.progress-wrap path');
        if(progressPath){
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
                    jQuery('.progress-wrap').addClass('active-progress');
                } else {
                    jQuery('.progress-wrap').removeClass('active-progress');
                }
            });
            jQuery('.progress-wrap').on('click', function (event) {
                event.preventDefault();
                jQuery('html, body').animate({
                    scrollTop: 0
                }, duration);
                return false;
            });
        }
        
        /*--- Sticky_Menu ---*/
		var navSticky = $("[data-sticky]");
		var navOffset = $("[data-sticky]").data('sticky');
        jQuery(window).on('scroll', function () {
            if (jQuery(this).scrollTop() > navOffset) {
                $('body').addClass('sticky');
            } else {
                $('body').removeClass('sticky');
            }
        });
        
        /*--- Page_Title_Word_Count ---*/
        $(".site-header .page_title").each(function(){
            if($(this).text().length > 18){
                $(this).addClass('long-text');
            }       
        });
        
        $('.woocommerce .product-box .button:not(.wish-add-button)').empty();
        $('.woocommerce .product-box .ajax_add_to_cart').append('<svg class="svg-icon icon" viewBox="0 0 24 24" fill="none"><g id="Iconly/Bold/Buy"><g id="Buy"><path id="Buy_2" fill-rule="evenodd" clip-rule="evenodd" d="M14.1213 11.2331H16.8891C17.3088 11.2331 17.6386 10.8861 17.6386 10.4677C17.6386 10.0391 17.3088 9.70236 16.8891 9.70236H14.1213C13.7016 9.70236 13.3719 10.0391 13.3719 10.4677C13.3719 10.8861 13.7016 11.2331 14.1213 11.2331ZM20.1766 5.92749C20.7861 5.92749 21.1858 6.1418 21.5855 6.61123C21.9852 7.08067 22.0551 7.7542 21.9652 8.36549L21.0159 15.06C20.8361 16.3469 19.7569 17.2949 18.4879 17.2949H7.58639C6.25742 17.2949 5.15828 16.255 5.04837 14.908L4.12908 3.7834L2.62026 3.51807C2.22057 3.44664 1.94079 3.04864 2.01073 2.64043C2.08068 2.22305 2.47038 1.94649 2.88006 2.00874L5.2632 2.3751C5.60293 2.43735 5.85274 2.72207 5.88272 3.06905L6.07257 5.35499C6.10254 5.68257 6.36234 5.92749 6.68209 5.92749H20.1766ZM7.42631 18.9079C6.58697 18.9079 5.9075 19.6018 5.9075 20.459C5.9075 21.3061 6.58697 22 7.42631 22C8.25567 22 8.93514 21.3061 8.93514 20.459C8.93514 19.6018 8.25567 18.9079 7.42631 18.9079ZM18.6676 18.9079C17.8282 18.9079 17.1487 19.6018 17.1487 20.459C17.1487 21.3061 17.8282 22 18.6676 22C19.4969 22 20.1764 21.3061 20.1764 20.459C20.1764 19.6018 19.4969 18.9079 18.6676 18.9079Z" fill="currentColor" /></g></g></svg>');
        $('.woocommerce .product-box .product_type_grouped').append('<i class="far fa-eye"></i>');
        $('.woocommerce .product-box .product_type_variable').append('<i class="far fa-eye"></i>');
        $('.woocommerce .product-box .product_type_external').append('<i class="far fa-external-link"></i>');
        $('.woocommerce .product-box .product_type_simple:not(.add_to_cart_button)').append('<i class="far fa-eye"></i>');
	});

    $(window).on("load", function () {
        /*------------- preloader js --------------*/
        $('#preloader').addClass('loaded');
        $(".loading").fadeOut(500);
        // Una vez haya terminado el preloader aparezca el scroll
        if ($('#preloader').hasClass('loaded')) {
            // Es para que una vez que se haya ido el preloader se elimine toda la seccion preloader
            $('#preloader').delay(900).queue(function () {
                $(this).remove();
            });
        }        
		$(".post-single").fitVids();
	});
})(jQuery);