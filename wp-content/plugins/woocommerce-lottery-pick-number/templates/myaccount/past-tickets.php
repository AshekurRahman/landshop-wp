<?php
/**
 * My account active tickets template
 *
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$current_user_id = get_current_user_id();
?>

<header class="woocommerce-products-header">
	<h4 class="woocommerce-products-header__title page-title mytickets"><a href="<?php echo wc_get_account_endpoint_url("comp-tickets"); ?>"><?php esc_html_e( 'Active Tickets', 'woocommerce_lottery_my_tickets' ); ?></a></h4>
	<h4 class="woocommerce-products-header__title page-title mytickets active"><?php esc_html_e( 'Past Tickets', 'woocommerce_lottery_my_tickets' ); ?></h4>
</header>

<?php
if ( is_array( $posts_ids ) && count( $posts_ids ) > 0 ) {
	?>

	<table class="woocommerce-orders-table woocommerce-MyAccount-orders shop_table shop_table_responsive my_account_orders account-orders-table">
		<thead>
			<tr>
				<th class="woocommerce-orders-table__header woocommerce-orders-table__header"><span class="nobr"></span></th>
				<th class="woocommerce-orders-table__header woocommerce-orders-table__header"><span class="nobr"><?php esc_html_e( 'Competition', 'wc-lottery-pn' ); ?></span></th>
				<th class="woocommerce-orders-table__header woocommerce-orders-table__header"><span class="nobr"><?php esc_html_e( 'Tickets', 'wc-lottery-pn' ); ?></span></th>                
			</tr>
		</thead>
	<?php
	foreach ( $posts_ids as $posts_id ) {

		$product       = wc_get_product( $posts_id );
		$order_history = wc_lottery_get_user_tickets_for_lottery( $current_user_id, $posts_id )
		?>
		<tr class="woocommerce-orders-table__row woocommerce-orders-table__row--status order">
			
				<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell">
				<?php echo $product->get_image( 'thumbnail' ); ?>
				</td>
				<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell">
					<p><a href="<?php echo esc_attr( get_permalink( $posts_id ) ); ?>"><?php echo wp_kses_post( $product->get_title() ); ?></a></p>
				</td>
				<td class="woocommerce-orders-table__cell woocommerce-orders-table__cell">
					<p> 
					<?php
					foreach ( $order_history as $order_item ) {
						echo wp_kses_post( apply_filters( 'ticket_number_display_html' , intval( $order_item->ticket_number ), $product ) );
						if ( next( $order_history ) ) {
							echo ', ';
						}
					} // end foreach
					?>
					</p>
				</td>
		</tr>
		<?php
	} // end foreach
    ?>
	</tbody>
</table>
	<?php

} else {
	?>

	<div class="woocommerce-message woocommerce-message--info woocommerce-Message woocommerce-Message--info woocommerce-info">
		<?php esc_html_e( 'No ticket(s) found.', 'wc-lottery-pn' ); ?>
	</div>

	<?php
}
