jQuery(document).ready(function ($) {
    "use strict";

    eval(blog.custom_script);

    var page = 3; // Initialize your page variable

    // Load more posts when the button is clicked
    $('body').on('click', '.loadmore', function () {
        var button = $(this);

        var data = {
            'action': 'load_posts_by_ajax',
            'page': page,
            'security': blog.security
        };

        button.html('<div class="spinner-border spinner-border-sm text-light"></div> &nbsp; Loading...');

        // Send AJAX request
        $.post(blog.ajaxurl, data, function (response) {
            if ($.trim(response) !== '') {
                button.html('Load More');
                $('.load-post').append(response);
                page++; // Increment the page number for the next request
            } else {
                button.fadeOut();
                button.parent().append('No more data available to show');
            }
        });
    });

    // Add more event handlers or functions as needed within the $(document).ready() block
});
