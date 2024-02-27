<?php
    // Import the namespace at the beginning of your PHP file
    use Codexse\Frontend\Wishlist;
    

    add_action("init", "landshop_wc_init_function");
    function landshop_wc_init_function()
    {

        if (class_exists("Redux")) {
            global $landshop_opt;
        } else {
            $landshop_opt["prod__flash_switch"] = 1;
            $landshop_opt["prod__wish_button"] = 1;
            $landshop_opt["product_list_style"] = "product_card_one";
        }

        $card_style = $landshop_opt["product_list_style"];
        $flash = $landshop_opt["prod__flash_switch"];
        $actions_position = ($card_style == "six" || $card_style == "seven" || $card_style == "eight" || $card_style == "nine") ? false : true;
        

        
        // Create an object of the Wishlist class within the correct namespace
        if(class_exists('Codexse')){
            $wishlist = new Wishlist\Wishlist();
            if ($landshop_opt["prod__wish_button"] == 1) {
                // Hook the wishlist button to product items
                if ($actions_position) {                    
                    add_action(
                        "woocommerce_before_shop_loop_item_title",
                        [$wishlist, "add_wishlist_button"],
                        20
                    );
                }else{
                    add_action(
                        "woocommerce_after_shop_loop_item",
                        [$wishlist, "add_wishlist_button"],
                        5
                    );
                }
            }
            // Add the wishlist button HTML to the single product page
            add_action(
                "woocommerce_after_add_to_cart_button",
                [$wishlist, "add_wishlist_button"],
                9999
            );  
        }
               

        remove_action(
            "woocommerce_before_main_content",
            "woocommerce_breadcrumb",
            20
        );
        remove_action(
            "woocommerce_before_shop_loop_item",
            "woocommerce_template_loop_product_link_open",
            10
        );
        remove_action(
            "woocommerce_after_shop_loop_item",
            "woocommerce_template_loop_product_link_close",
            5
        );
        remove_action(
            "woocommerce_before_shop_loop_item_title",
            "woocommerce_show_product_loop_sale_flash",
            10
        );
        remove_action(
            "woocommerce_shop_loop_item_title",
            "woocommerce_template_loop_product_title",
            10
        );

        remove_action(
            "woocommerce_before_shop_loop",
            "woocommerce_output_all_notices",
            10
        );
        remove_action(
            "woocommerce_before_shop_loop",
            "woocommerce_result_count",
            20
        );
        remove_action(
            "woocommerce_before_shop_loop",
            "woocommerce_catalog_ordering",
            30
        );

        add_action(
            "woocommerce_shop_loop_item_title",
            "landshop_woocommerce_shop_loop_item_title",
            10
        );

        if ($flash == 1) {
            add_action(
                "woocommerce_before_shop_loop_item",
                "woocommerce_show_product_loop_sale_flash",
                5
            );
        }

        if ($card_style == "two" || $card_style == "six" || $card_style == "seven" || $card_style == "eight" || $card_style == "nine") {
            remove_action(
                "woocommerce_after_shop_loop_item_title",
                "woocommerce_template_loop_rating",
                5
            );
        }
        if ($card_style == "nine") {
            add_action(
                "woocommerce_shop_loop_item_title",
                "woocommerce_template_single_excerpt",
                20
            );
        }

        if ($actions_position) {
            remove_action(
                "woocommerce_after_shop_loop_item",
                "woocommerce_template_loop_add_to_cart",
                10
            );
            add_action(
                "woocommerce_before_shop_loop_item_title",
                "woocommerce_template_loop_add_to_cart",
                20
            );
            
            add_action(
                "woocommerce_before_shop_loop_item_title",
                "landshop_product_card_overlay_link",
                50
            );

            add_action(
                "woocommerce_before_shop_loop_item_title",
                function () {
                    echo '<div class="product_actions">';
                },
                15
            );
            add_action(
                "woocommerce_before_shop_loop_item_title",
                function () {
                    echo "</div>";
                },
                9999
            );
        }else {

            add_action(
                "woocommerce_after_shop_loop_item",
                function () {
                    echo '<div class="product_actions">';
                },
                0
            );
            
            add_action(
                "woocommerce_after_shop_loop_item",
                "landshop_product_card_overlay_link",
                50
            );
            add_action(
                "woocommerce_after_shop_loop_item",
                function () {
                    echo "</div>";
                },
                9999
            );

        }
    }

    // landshop function to modify woocommerce_shop_loop_item_title
    function landshop_woocommerce_shop_loop_item_title()
    {
        echo '<h4 class="product__title"><a href="' .
            esc_url(get_permalink()) .
            '">' .
            esc_html(get_the_title()) .
            "</a></h4>";
    }

    function landshop_product_card_overlay_link()
    {
        echo '<a href="' . get_the_permalink() . '" class="overlay_link" ></a>';
    }


    function landshop_update_mini_cart() {
        echo wc_get_template_part( 'cart/mini-cart' );
        die();
    }
    
    add_action( 'wp_ajax_update_mini_cart', 'landshop_update_mini_cart' );
    add_action( 'wp_ajax_nopriv_update_mini_cart', 'landshop_update_mini_cart' );
        

    // Output the mini cart in the navbar
    function landshop_mini_cart() {
        ?>
        <div class="shopping_cart_content">
            <?php woocommerce_mini_cart(); ?>
        </div>
        <?php
    }

    function landshop_mini_cart_icon() {
        ob_start();
            ?>
                <button class="nav_action cart_toggle" data-bs-toggle="collapse" data-bs-target="#shoping_mini_cart" title="<?php _e( 'View your shopping cart', 'landshop' ); ?>">
                    <span class="position-relative">
                        <i class="fa-light fa-bag-shopping"></i>
                        <span class="cart_count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                    </span>
                </button>
            <?php
        return ob_get_clean();
    }

    // Add fragments to cart
    function landshop_shoping_mini_cart_fragment($fragments) {
		$fragments['.cart_toggle .cart_count'] = '<span class="cart_count">'.WC()->cart->get_cart_contents_count().'</span>';
        ob_start();
        landshop_mini_cart();
        $fragments['.shopping_cart_content'] = ob_get_clean();
        return $fragments;
    }

    add_filter('woocommerce_add_to_cart_fragments', 'landshop_shoping_mini_cart_fragment');