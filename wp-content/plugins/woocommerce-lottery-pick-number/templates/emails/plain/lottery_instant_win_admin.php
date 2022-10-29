<?php
/**
 * Admin instant lottery win finish email
 *
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
$product_data = wc_get_product($product_id);

do_action('woocommerce_email_header', $email_heading);
printf(__("User %s has won %s with ticket number %s in %s as instant prize.", 'wc-lottery-pn'),  get_userdata( $user_id )->display_name, $prize, $ticket, $product_data -> get_title());
echo "\n\n";
echo get_permalink($product_id);

do_action('woocommerce_email_footer');