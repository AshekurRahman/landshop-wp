<?php
/**
 * Lottery add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/lottery.php.
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;
if ( ! $product->is_purchasable() ) {
	return;
}

if ( ! $product->is_in_stock() ) {
	return;
}
if ( $product->get_max_purchase_quantity() <= 0 ) { ?>
	<p class="lottery-max-ticket-txt">
		<?php printf( esc_html__( 'The maximum allowed quantity for %1$s is %2$d.', 'wc_lottery' ), $product->get_title(), $product->get_max_tickets_per_user() ); ?>
	</p>
	<?php 
	return;
}
$use_answers        	= wc_lottery_use_answers( $product->get_id() );
$use_ticket_numbers 	= get_post_meta( $product->get_id() , '_lottery_use_pick_numbers', true );
$random_ticket_numbers 	= get_post_meta( $product->get_id() , '_lottery_pick_numbers_random', true );

do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="cart pick-number <?php echo ( "yes" !== $random_ticket_numbers && 'yes' === $use_ticket_numbers)  ? 'hidden-qty' : '' ?> " action="<?php echo esc_url( get_permalink() ); ?>" method="post" enctype='multipart/form-data'>

		<?php
			/**
			 * @since 2.1.0.
			 */
			do_action( 'woocommerce_before_add_to_cart_button' );

			do_action( 'woocommerce_before_add_to_cart_quantity' );
		
			woocommerce_quantity_input( array(
				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
				'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : $product->get_min_purchase_quantity(),
			), $product);
				

			/**
			 * @since 3.0.0.
			 */
			do_action( 'woocommerce_after_add_to_cart_quantity' );

			if ( 'yes' === $use_ticket_numbers && "yes" !== $random_ticket_numbers ): ?>
				<input type="hidden" value="" name='lottery_tickets_number'  >
				<input type="hidden" name='quantity' value= "" >
				<?php if ( $product->get_max_purchase_quantity() ) {?>
					<input type="hidden" name='max_quantity' value= "<?php echo intval( $product->get_max_purchase_quantity() ) ?>" >
				<?php } 
			endif;
			if( true === $use_answers ):
				echo '<input type="hidden" value="" name="lottery_answer">';
			endif;
		?>

	<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt <?php echo 'yes' === $use_ticket_numbers && "yes" !== $random_ticket_numbers ? ' lottery-must-pick ' : ''; echo true === $use_answers ? ' lottery-must-answer ' : '' ; ?>" ><?php echo wp_kses_post( $product->single_add_to_cart_text() ); ?></button>

	<?php
		/**
		 * @since 2.1.0.
		 */
		do_action( 'woocommerce_after_add_to_cart_button' );
	?>
</form>

<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
