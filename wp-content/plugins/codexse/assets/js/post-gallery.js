(function($) {
    "use strict";
    /*----------------------
    Document-Reader-Function
    -----------------------*/
    $(document).on('ready', function(){
        /*====== Services-Slider-Active ======*/
        var blog__slider = new Swiper(".photo_slider", {
            loop: true,
            speed: 800,
            spaceBetween: 0,
            slidesPerView: 1,
            watchSlidesVisibility: true,
            watchSlidesProgress: true,
            navigation: {
                nextEl: ".post_slider_arrow .arrow_next",
                prevEl: ".post_slider_arrow .arrow_prev",
            },
            pagination: {
                el: '.photo_slider .swiper-pagination',
                clickable: true,
                type: 'bullets',
                renderBullet: function (i) {
                    return `<span class="dot swiper-pagination-bullet" ><svg> <circle style="animation-duration: `+slautolaydelay/1000+`s;" cx="11" cy="11" r="10"></circle></svg></span>`;
                }
            },
        });        
    });
})(jQuery);