<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_filter('get_product_search_form','maruncy_get_product_search_form');
if( !function_exists('maruncy_get_product_search_form') ){
    function maruncy_get_product_search_form(){            
        $data = '<form role="search" method="get" class="search_form" action="'.esc_url(home_url("/")).'">';
        $data .= '<input type="search" name="s" class="form_control" placeholder="'. __("Search product","maruncy").'" value="'.esc_attr(get_search_query()).'">';
        $data .= '<button type="submit" class="search_submit"><i class="mr-search-icon"></i></button>';            
        $data .= '</form>';            
        return $data;
   }
}