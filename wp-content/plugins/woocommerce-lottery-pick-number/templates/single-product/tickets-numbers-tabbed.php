<?php
/**
 * Tickets numbers
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tickets-numbers-tabbed.php
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;
$tabnumbers = get_post_meta( $product->get_id() , '_lottery_pick_number_tab_qty', true );
$max_tickets     = intval( $product->get_max_tickets() );
$tabnumbers = $tabnumbers > $max_tickets ? $max_tickets : $tabnumbers;
$tabnumbers = $tabnumbers ? intval( $tabnumbers )  : 100;
$tickets_sold    = wc_lottery_pn_get_taken_numbers();
$tickets_in_cart = wc_lottery_pn_get_ticket_numbers_from_cart( $product->get_id() );
$reserved        = wc_lottery_pn_get_reserved_numbers( $product->get_id() );
$use_answers        = wc_lottery_use_answers( $product->get_id() );
$lucky_dip        =  get_option( 'lottery_use_lucky_dip', 'no' ); 
$lucky_dip_qty = get_option( 'lottery_use_lucky_dip_qty', 'no' );
$available_ticket = wc_lotery_get_available_ticket( $product->get_id() );

if( $max_tickets ){

	echo '<h3>'. esc_html__('Pick your ticket number(s)' , 'wc-lottery-pn' ) . '</h3>';
	echo '<div id="wc-lottery-pn"';
	$max_tickets_per_user = $product->get_max_tickets_per_user() ? $product->get_max_tickets_per_user() : false;
	if ( ! is_user_logged_in() &&  $max_tickets_per_user > 0  && $max_tickets_per_user != $product->get_max_tickets() && 'yes' !== get_option( 'simple_lottery_alow_non_login', 'yes' ) ) {
		echo 'class=" guest"';
	}
	echo '> ';

	do_action('wc_lottery_before_ticket_numbers');

	echo '<div class="ticket-tab-bar">
		<button class="ticket-tab-bar-item tablink ticket-tab-active" id="button-tab1_' . $tabnumbers . '" onclick="opentab(event,\'tab1_' . $tabnumbers . '\' )" data-number-range=1_' . $tabnumbers .'">' . apply_filters( 'ticket_number_tab_display_html', '1-' . $tabnumbers , $product) . '</button>
	';
	$i =  1;
	$a =  2;
	$numberoftabs = $max_tickets / $tabnumbers;
	$start_tab_number = $tabnumbers + 1;

	while ( $i < $numberoftabs) {

		
		$end_tab_number =  $tabnumbers * $a;

		$end_tab_number =  $end_tab_number > $max_tickets ? $max_tickets : $end_tab_number;

		echo' <button class="ticket-tab-bar-item tablink" id="button-tab' . $start_tab_number . '_' . $tabnumbers . '" onclick="opentab(event,\'tab'. $start_tab_number . '_' . $end_tab_number .'\')" data-number-range="'. $start_tab_number . '_' . $end_tab_number .'">'. apply_filters( 'ticket_number_tab_display_html', $start_tab_number . '-' . $end_tab_number, $product) . '</button>';
		$start_tab_number = $start_tab_number + $tabnumbers;
		$i++;$a++;
	}

	echo '</div>
	
	<ul class="tickets_numbers" data-product-id="' . $product->get_id() . '">';
	$i = 1;
	$i2 = 0;
	$a =  1;
	$numberoftabs = $max_tickets / $tabnumbers;
	$start_tab_number = 1;
	while ( $i2 < $numberoftabs) {
		
		$end_tab_number =  $tabnumbers * $a;
		$end_tab_number =  $end_tab_number > $max_tickets ? $max_tickets : $end_tab_number;
		$hidden = $i2 !== 0 ? 'style="display:none"' : '' ;
		echo '<li id="tab'. $start_tab_number . '_' . $end_tab_number .'" class="ticketnumber-tab-container" ' . $hidden . ' ><ul class="tickets_numbers_tab" data-number-range="'. $start_tab_number . '_' . $end_tab_number .'" >';
		
		while ( $i<= $end_tab_number) {

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
			echo '<li class="tn ' . esc_attr( $class ). '"data-ticket-number="' . intval( $i ) . '" alt="' . esc_attr( $alt_text ) . '" title="' . esc_attr( $alt_text ) . '">' .apply_filters( 'ticket_number_display_html', intval( $i ) ,$product ) . '</li>';
			$i++;
		}
		echo '</ul></li>';
		$start_tab_number = $start_tab_number + $tabnumbers;
		$i2++;$a++;
	}
	echo '</ul></div>';
} ?>

<script>
var tablinks = document.getElementsByClassName("tablink");
for(i=0, len=tablinks.length; i<len; i++){
    tablinks[i].addEventListener('click', function(e){e.preventDefault();});
}
function opentab(evt, tabName) {
  var i, x, tablinks;
  x = document.getElementsByClassName("ticketnumber-tab-container");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" ticket-tab-active", "");
  }
  document.getElementById(tabName).style.display = "block";
  evt.currentTarget.className += " ticket-tab-active";
}
</script>
