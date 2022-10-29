<?php
/**
 * Participate button
 *
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;
$use_answers        = wc_lottery_use_answers( $product->get_id() );
$lucky_dip        =  get_option( 'lottery_use_lucky_dip', 'no' ); 
$lucky_dip_qty = get_option( 'lottery_use_lucky_dip_qty', 'no' ); 
$available_ticket = wc_lotery_get_available_ticket( $product->get_id() );
$random_ticket_numbers 	= get_post_meta( $product->get_id() , '_lottery_pick_numbers_random', true );
$qty_dip = ! empty( $qty ) ? $qty : '1';
$qty_label = ! empty( $label ) ? $label : __('Lucky Dip' , 'wc-lottery-pn' ) ;
if ( $lucky_dip == 'yes' &&  ( count( $available_ticket ) > 0 ) && "yes" !== $random_ticket_numbers ){
	echo '<div class="lucky_dip_predef">';
	echo '<button data-product-id="' . $product->get_id() . '" class="button alt lucky-dip-button"';
	if ( $use_answers == 'yes' ){
		echo 'alt= "' . esc_attr__('Please answer the question.' , 'wc-lottery-pn') . '"';
		echo 'title= "' . esc_attr__('Please answer the question.' , 'wc-lottery-pn') . '"';
		echo ' disabled ';

	}
	if( $product->get_max_purchase_quantity() <= 0 ) {
		echo 'alt= "' . sprintf( esc_attr__( 'The maximum allowed quantity is %1$d.', 'wc-lottery-pn' ), $product->get_max_tickets_per_user() ) . '"';
		echo 'title= "' . sprintf( esc_attr__( 'The maximum allowed quantity is %1$d.', 'wc-lottery-pn' ), $product->get_max_tickets_per_user() ) . '"';
		echo ' disabled ';
	}
	echo ' >'. esc_html( $label) . '</button>';
	echo '<input type="hidden" value="'. intval( $qty_dip ) .'" name="qty_dip" />';
	echo "</div>";
}