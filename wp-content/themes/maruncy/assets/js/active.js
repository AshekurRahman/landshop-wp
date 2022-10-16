;
(function ($) {
	"use strict";
	$(document).on('ready', function () {		
		// To Added a plus icon after sub menu parents.
		$('.nav_menu .sub-menu').parent('li').children('a').append('<i class="plus"></i>');		
		// Select all links with hashes
		$('.mainmenu-area .primary-menu a[href*="#"]').not('[href="#"]').not('[href="#0"]').on('click', function (event) {if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {var target = $(this.hash); target = target.length ? target : $('[name=' + this.hash.slice(1) + ']'); if (target.length) { event.preventDefault(); $('html, body').animate({ scrollTop: target.offset().top }, 1000, function () { var $target = $(target); $target.focus(); if ($target.is(":focus")) { return false; } else { $target.attr('tabindex', '-1'); $target.focus(); }; }); } } });
		
		$('.nav_menu').slicknav({
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
	});

    $(window).on("load", function () {
        /*------------- preloader js --------------*/
        $('#preloader').addClass('loaded');
        $("#loading").fadeOut(500);
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