<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
?>
<?php get_template_part('components/layouts/site_header'); ?> 
<?php

/**
 * Hook: woocommerce_before_main_content.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked Close woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );

if ( woocommerce_product_loop() ) {
    ?>
    
    <div class="row">
        <div class="col-sm-12 <?php echo ( (is_active_sidebar('wc_sidebar')) ? 'col-lg-8' : '' ); ?>">
           <div class="row">
                <div class="col">
                    <?php woocommerce_output_all_notices(); ?>
                </div>
            </div>
            <div class="row g-4 product-top-bar align-items-center">
                <div class="col-md-12 <?php echo ( (is_active_sidebar('wc_sidebar')) ? 'text-center' : 'col-lg-4' ); ?>">
                    <?php woocommerce_result_count(); ?>            
                </div>
                <div class="col-md-12 <?php echo ( (is_active_sidebar('wc_sidebar')) ? '' : 'col-lg-8 col-xl-7 offset-xl-1' ); ?>">  
                    <div class="row g-4">
                        <div class="col-md-6">
                            <?php
                                woocommerce_catalog_ordering(); 
                            ?>    
                        </div>
                        <div class="col-md-6">
                            <?php
                                get_product_search_form();
                            ?>    
                        </div>
                    </div>    
                </div>
            </div>
            <?php            
            woocommerce_product_loop_start();

            if ( wc_get_loop_prop( 'total' ) ) {
                while ( have_posts() ) {
                    the_post();
                        /**
                         * Hook: woocommerce_shop_loop.
                         *
                         * @hooked WC_Structured_Data::generate_product_data() - 10
                         */
                        do_action( 'woocommerce_shop_loop' );

                        wc_get_template_part( 'content', 'product' );
                    }
                }

                woocommerce_product_loop_end();

                /**
                 * Hook: woocommerce_after_shop_loop.
                 *
                 * @hooked woocommerce_pagination - 10
                 */
                do_action( 'woocommerce_after_shop_loop' );
            } else {
                /**
                 * Hook: woocommerce_no_products_found.
                 *
                 * @hooked wc_no_products_found - 10
                 */
                do_action( 'woocommerce_no_products_found' );
            }


                ?>
        </div>
        <div class="col-sm-12 <?php echo ( (is_active_sidebar('wc_sidebar')) ? 'col-lg-4' : '' ); ?>">
            <?php do_action( 'woocommerce_sidebar' ); ?>
        </div>
    </div>
<?php
do_action( 'woocommerce_after_main_content' );
get_footer();