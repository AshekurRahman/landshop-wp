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

add_filter('get_product_search_form','landshop_get_product_search_form');
if( !function_exists('landshop_get_product_search_form') ){
    function landshop_get_product_search_form(){            
        $data = '<form role="search" method="get" class="search_form" action="'.esc_url(home_url("/")).'">';
        $data .= '<input type="search" id="woocommerce-product-search-field-'.(isset( $index ) ? absint( $index ) : 0).'" class="form_control" placeholder="'.esc_attr__( 'Search products&hellip;', 'woocommerce' ).'" value="'.get_search_query().'" name="s" />';
        $data .= '<button type="submit" class="search_submit">';
		$data .= '<svg class="svg-icon"><use xlink:href="'.get_theme_file_uri( 'assets/images/symble.svg' ).'#ic-search"></use></svg>';
        $data .= '</button>';         
        $data .= '<input type="hidden" name="post_type" value="product" />';         
        $data .= '</form>';            
        return $data;
   }
}

