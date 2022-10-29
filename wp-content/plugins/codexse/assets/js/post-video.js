(function($) {

    "use strict";
    /*------------------------
    Window-Load-Function
    -------------------------*/
    $(window).on("load", function () {
        $('.video-post').each(function () {
            var video_src = '';            
            $(this).find(".video-play-bttn").on("click", function (ev) {
                $('.video-post').find("iframe").attr("src","");                
                video_src = $(this).parent('.videoPoster').siblings('iframe').data("src");                
                $(this).parent('.videoPoster').siblings('iframe').attr('src',video_src );
                $(this).parent('.videoPoster').fadeOut(300);
                return false;
            });
        });
    });
    
    
})(jQuery);