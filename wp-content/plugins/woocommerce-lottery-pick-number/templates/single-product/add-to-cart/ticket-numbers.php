<?php
/**
 * Lottery add to cart ticket numbers 
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/ticket-numbers.php.
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

$use_ticket_numbers 	= get_post_meta( $product->get_id() , '_lottery_use_pick_numbers', true );
$random_ticket_numbers 	= get_post_meta( $product->get_id() , '_lottery_pick_numbers_random', true );

if ( 'yes' === $use_ticket_numbers && "yes" !== $random_ticket_numbers ): ?>
	<?php if( get_post_meta( $product->get_id() , '_lottery_pick_number_use_tabs', true ) === 'yes' ) {
		wc_get_template('single-product/tickets-numbers-tabbed.php' );
	} else {
		wc_get_template('single-product/tickets-numbers.php' );
	}

endif;
