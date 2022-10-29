;
(function ($) {
    var carousel_controler = function ($scope, $) {
        var slider_elem = $scope.find('.swiper-container').eq(0);
        if (slider_elem.length > 0) {
            settings = slider_elem.data('settings');
            var slloop = settings['slloop'];
            var sleffect = settings['sleffect'];
            var slautolaydelay = settings['slautolaydelay'];
            var slanimation_speed = settings['slanimation_speed'];
            var slcustom_arrow = settings['slcustom_arrow'];
            var slider_target_id = settings['sltarget_id'];
            var sldisplay_columns = parseInt(settings['sldisplay_columns']);
            var slcenter = settings['slcenter'];
            var slcenter_padding = parseInt(settings['slcenter_padding']);

            var laptop_width = parseInt(settings['laptop_width']);
            var tablet_width = parseInt(settings['tablet_width']);
            var mobile_width = parseInt(settings['mobile_width']);
            var laptop_padding = parseInt(settings['laptop_padding']);
            var tablet_padding = parseInt(settings['tablet_padding']);
            var mobile_padding = parseInt(settings['mobile_padding']);
            var laptop_display_columns = parseInt(settings['laptop_display_columns']);
            var tablet_display_columns = parseInt(settings['tablet_display_columns']);
            var mobile_display_columns = parseInt(settings['mobile_display_columns']);

            var swiperOptions = {
                loop: slloop,
                speed: slanimation_speed,
                centeredSlides: slcenter,
                slidesPerView: sldisplay_columns,
                spaceBetween: slcenter_padding,
                effect: sleffect, // More Options: 'slide' | 'fade' | 'cube' | 'coverflow' | 'flip'            
                autoplay: {
                    delay: slautolaydelay,
                    disableOnInteraction: false
                },
                navigation: {
                    prevEl: (slcustom_arrow == true && slider_target_id != null ? '#slider-arrow-' + slider_target_id + ' .prev-action' : $scope.find('.swiper-navigation .swiper-prev')),
                    nextEl: (slcustom_arrow == true && slider_target_id != null ? '#slider-arrow-' + slider_target_id + ' .next-action' : $scope.find('.swiper-navigation .swiper-next')),
                },
                pagination: {
                    el: $scope.find('.swiper-pagination'),
                    clickable: true,
                    type: 'bullets',
                    renderBullet: function (i) {
                        return `<span class="dot swiper-pagination-bullet" ><svg> <circle style="animation-duration: `+slautolaydelay/1000+`s;" cx="11" cy="11" r="10"></circle></svg></span>`;
                    }
                },
                breakpoints: {
                    [mobile_width]: {
                        slidesPerView: mobile_display_columns,
                        spaceBetween: mobile_padding,
                    },
                    [tablet_width]: {
                        slidesPerView: tablet_display_columns,
                        spaceBetween: tablet_padding,
                    },
                    [laptop_width]: {
                        slidesPerView: laptop_display_columns,
                        spaceBetween: laptop_padding,
                    },
                },
            };
            var swiper = new Swiper(slider_elem, swiperOptions);
        }
    }
    // Run this code under Elementor.
    $(window).on('elementor/frontend/init', function () {
        elementorFrontend.hooks.addAction('frontend/element_ready/codexse-carousel-addons.default', carousel_controler);
    });
}(jQuery));