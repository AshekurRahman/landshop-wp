<?php
/**
 * Lottery Pick Number Addon - admin email notification for duplicated ticket
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

do_action('woocommerce_email_header', $email_heading);

printf( __( 'Sorry. Order %s has duplicate ticket number %s. Order has been put on hold please check it!', 'wc-lottery-pn' ), $order_id, $ticket_number);
echo "\n\n";
echo admin_url( 'post.php?post=' . $order_id . '&action=edit' );
echo "\n\n";

do_action('woocommerce_email_footer');