<?php
/**
 * Tickets numbers
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tickets-numbers.php.
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;

$max_tickets     = intval( $product->get_max_tickets() );
$tickets_sold    = wc_lottery_pn_get_taken_numbers();
$tickets_in_cart = wc_lottery_pn_get_ticket_numbers_from_cart( $product->get_id() );
$reserved        = wc_lottery_pn_get_reserved_numbers( $product->get_id() );
$use_answers     = wc_lottery_use_answers( $product->get_id() );
$lucky_dip       =  get_option( 'lottery_use_lucky_dip', 'no' ); 
$lucky_dip_qty   = get_option( 'lottery_use_lucky_dip_qty', 'no' ); 

$available_ticket = wc_lotery_get_available_ticket( $product->get_id() );

if( $max_tickets ){

	echo '<h3>'. esc_html__('Pick your ticket number(s)' , 'wc-lottery-pn' ) . '</h3>';
	
	echo '<div id="wc-lottery-pn"';
	$max_tickets_per_user = $product->get_max_tickets_per_user() ? $product->get_max_tickets_per_user() : false;
	if ( ! is_user_logged_in() &&  $max_tickets_per_user > 0  && $max_tickets_per_user != $product->get_max_tickets() && 'yes' !== get_option( 'simple_lottery_alow_non_login', 'yes' ) ) {
		echo 'class=" guest"';
	}
	echo '>';

	do_action('wc_lottery_before_ticket_numbers');

	echo '<ul class="tickets_numbers" data-product-id="' . $product->get_id() . '">';

	$i = intval( apply_filters( 'woocommerce_lottery_start_ticket_number ', 1 , $product ) );
	while ( $i<= $max_tickets) {

		$alt_text = ''; $class = '';
		$class = in_array( $i, $reserved) ? ' reserved ' : $class ;
		$class = in_array( $i, $tickets_in_cart) ? ' in_cart ' : $class ;
		$class = in_array( $i, $tickets_sold) ? ' taken ' : $class ;

		if ( $class === ' taken ' ) {
			$alt_text = esc_html__( 'Sold!' , 'wc-lottery-pn' );
		} elseif( $class === ' in_cart ' ) {
			$alt_text = esc_html__( 'Already in your cart!' , 'wc-lottery-pn' );
		} elseif( $class === ' reserved ' ) {
			$alt_text = esc_html__( 'Reserved!' , 'wc-lottery-pn' );
		}
		echo '<li class="tn ' . esc_attr( $class ). '"data-ticket-number="' . intval( $i ) . '" alt="' . esc_attr( $alt_text ) . '" title="' . esc_attr( $alt_text ) . '">' . apply_filters( 'ticket_number_display_html' , intval( $i ), $product) . '</li>';
		$i++;
	}
	
	echo '</ul></div>';
}
