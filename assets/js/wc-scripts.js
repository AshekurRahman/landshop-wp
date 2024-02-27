;
(function ($) {
    "use strict";
    $(document).on('ready', function () {
        $('.form-floating select').addClass('form-control');
        // Function to generate a random light color with opacity
        function getRandomLightColor() {
            var letters = '0123456789ABCDEF';
            var color = '#';
            for (var i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color + '1A'; // '1A' corresponds to 10% opacity in hexadecimal (0x1A)
        }
        // Apply random light colors with opacity to elements with class .color-item
        $('.product_card_two .product__item, .product_card_six .product__thumb').each(function () {
            $(this).css('background-color', getRandomLightColor());
        });        
    
        
        $('.single-product-summary .cart .single_add_to_cart_button').prepend('<i class="fa-regular fa-basket-shopping icon"></i>');

        $(document).on('click', '.quantity .plus, .quantity .minus', function() {
            // Get current quantity
            var qty = $(this).closest('.quantity').find('.qty');
            var val = parseFloat(qty.val());
            var step = parseFloat(qty.attr('step'));
            var min = parseFloat(qty.attr('min'));
            var max = parseFloat(qty.attr('max'));        
            // Get button type (plus or minus)
            var button = $(this).is('.plus') ? 'plus' : 'minus';        
            // Calculate new quantity
            if ('plus' === button) {
                if (max && (val >= max)) {
                    qty.val(max);
                } else {
                    qty.val(val + step);
                }
            } else {
                if (min && (val <= min)) {
                    qty.val(min);
                } else if (val > 1) {
                    qty.val(val - step);
                }
            }        
            // Trigger change event
            qty.trigger('change');
        });        
    });

    $(document).on('ajaxComplete', function() {
        // Target the "Add to Cart" button by its class and modify its text
        $('body:not(.product_card_three, .product_card_seven, .product_card_eight, .product_card_nine) .added_to_cart').html('<i class="fa-regular fa-eye"></i>');
        // Add a class to the button
        $('.product__item .added_to_cart').addClass('button');
        $('.added_to_cart').addClass('dark');
    });
    
})(jQuery);