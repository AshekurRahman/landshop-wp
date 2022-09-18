;
(function ($) {
	"use strict";
	$(document).on('ready', function () {
        var page = 3;
        jQuery(function($) {
            $('body').on('click', '.loadmore', function() {
                var button = $(this);
                var data = {
                    'action': 'load_posts_by_ajax',
                    'page': page,
                    'security': blog.security
                };
                button.html('<div class="spinner-border spinner-border-sm text-light"></div> &nbsp; Loading...');
                $.post(blog.ajaxurl, data, function(response) {
                    if($.trim(response) != '') {
                        button.html('Load More');
                        $('.load-post').append(response);
                        page++;
                    } else {
                        button.fadeOut();
                        button.parent().append('No more data available to show');
                    }
                });
            });
            
            
            
            $('body').on('click', '.caseload', function() {
                var button = $(this);
                var data = {
                    'action': 'load_case_by_ajax',
                    'page': page,
                    'security': blog.security
                };
                button.html('<div class="spinner-border spinner-border-sm text-light"></div> &nbsp; Loading...');
                $.post(blog.ajaxurl, data, function(response) {
                    if($.trim(response) != '') {
                        button.html('Load More');
                        $('.load-post').append(response);
                        setTimeout(function() {
                            var $container = $('.masonrys');
                            $container.masonry('reloadItems');
                            $container.masonry();
                        },500);
                        page++;
                    } else {
                        button.fadeOut();
                        button.parent().append('No more data available to show');
                    }
                });
            });
        });
	});   
    
})(jQuery);