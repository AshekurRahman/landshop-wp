<?php
/**
 * User instant lottery win finish email
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
$product_data = wc_get_product($product_id);

do_action('woocommerce_email_header', $email_heading);
printf(__('Congratulations. You have won "%s" with ticket number %s in %s as instant prize.', 'wc-lottery-pn'), $prize, $ticket, $product_data -> get_title());
echo "\n\n";
echo get_permalink($product_id);

do_action('woocommerce_email_footer');