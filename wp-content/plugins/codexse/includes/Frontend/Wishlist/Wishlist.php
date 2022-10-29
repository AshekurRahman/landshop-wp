<?php

namespace Codexse\Frontend\Wishlist;

class Wishlist
{
    function __construct(){   
        add_action( 'product_items_actions', [ $this, 'woocommerce_wishlist_button' ] );
        add_shortcode( 'landshop_wishlist', [ $this, 'wish_shortcode'] );
        add_action( 'wp_ajax_wishitems', [ $this, 'wish_ajax_callback']);
        add_action( 'wp_ajax_nopriv_wishitems', [ $this, 'wish_ajax_callback']);
    }

    public function woocommerce_wishlist_button()
    {
        echo '<button class="button wish-add-button" data-id="'.get_the_ID().'" ><svg class="svg-icon"><use xlink:href="'.get_theme_file_uri( 'assets/images/symble.svg#ic-love' ).'"></use></svg></button>';
    }

    public function wish_ajax_callback()
    {
        include __DIR__ . './table.php';
        wp_die(); // this is required to terminate immediately and return a proper response 
    }

    public function wish_shortcode()
    {
        wp_enqueue_script( 'codexse-wishlist' );
        wp_localize_script( 'codexse-wishlist' , 'wishitems', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'emptymessage' => __( 'Your wishlist is currently empty.','codexse' )
        ) );

        return '<div class="codexse-wishlist" ></div>';
    }
}
