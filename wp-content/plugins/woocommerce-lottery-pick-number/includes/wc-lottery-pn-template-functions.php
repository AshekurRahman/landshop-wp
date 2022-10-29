<?php

if ( ! function_exists( 'lottery_questions_add_to_cart_button' ) ) {

	function lottery_questions_add_to_cart_button(){
		wc_get_template( 'single-product/add-to-cart/answers.php' );
	}

}

if ( ! function_exists( 'lottery_ticket_numbers_add_to_cart_button' ) ) {

	function lottery_ticket_numbers_add_to_cart_button(){
		wc_get_template( 'single-product/add-to-cart/ticket-numbers.php' );
	}

}

if ( ! function_exists( 'woocommerce_lottery_lucky_dip_button_template' ) ) {

	function woocommerce_lottery_lucky_dip_button_template(){
		wc_get_template( 'single-product/lucky-dip-button.php' );
	}

}

if ( ! function_exists( 'woocommerce_lottery_instant_prizes_info_template' ) ) {
	/**
	 * Load lottery product add to cart template part.
	 *
	 */
	function woocommerce_lottery_instant_prizes_info_template() {
		wc_get_template( 'single-product/lottery-instant-prize-info.php' );
	}
}