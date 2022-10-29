<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	$product = wc_get_product( $product_id );
	$cart_url = wc_get_cart_url();
	$available_ticket = wc_lotery_get_available_ticket( $product_id );
?>
<p class="lucky-dip-text">
	<?php printf( _n( 'Congratulations! Your ticket number %s has been added to cart.', 'Congratulations! Your ticket numbers %s have been added to cart.', count( $display_numbers ),  'wc-lottery-pn'  ), implode(', ', $display_numbers) ); ?>
</p>
<?php if ( count( $available_ticket) > 0 && $product->get_max_purchase_quantity() > 0) { ?>
	<a href="#" class="button alt lucky-dip-button-second" ><?php esc_html_e( 'Add more with lucky dip' , 'wc-lottery-pn' ) ?></a>
<?php } ?>

<a href="<?php echo $cart_url ?>" class="button alt gtc"><?php esc_html_e( 'Go to cart' , 'wc-lottery-pn' ) ?></a>

<script type="text/javascript">
	jQuery('.lucky-dip-button-second').on('click',function(e){
		e.preventDefault();
		var lottery_answer = false;
		var available_tickets = <?php echo count( $available_ticket) ?>;
		var max_tickets = <?php echo $product->get_max_purchase_quantity() ?>;
		var numbers = jQuery( 'ul.tickets_numbers');
		var lottery_id = numbers.data( 'product-id' );
		var qty = jQuery('#qty_dip').closest('#qty_dip').val();
		var max_qty = jQuery('input[name=max_quantity]').val();
		var new_max_qty = max_qty - qty;
		if( new_max_qty < 0 ){
			jQuery.alertable.alert(wc_lottery_pn.maximum_text);
			return;
		}
		if( available_tickets < qty ){
			qty = available_tickets;
		}
		if( max_tickets < qty ){
			qty = max_tickets;
		}
		if ( jQuery('input[name=lottery_answer]').val() > 0) {
			lottery_answer = jQuery('input[name=lottery_answer]').val();
		}
		if ( new_max_qty < 1 ){
			jQuery('div.lucky_dip button').prop('disabled', true);
		}
		jQuery.ajax({
			type : "get",
			url : woocommerce_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'wc_lottery_lucky_dip' ),
			data : { 'lottery_id' : lottery_id, 'lottery_answer' : lottery_answer,'qty' : qty},
			success: function(response) {
				jQuery.alertable.alert( response.message, { html : true } );
				jQuery.each(response.ticket_numbers, function(index, value){
					jQuery( 'li.tn[data-ticket-number=' + value + ' ]' ).addClass('in_cart');
				});
				jQuery(document.body).trigger('added_to_cart');
				jQuery(document.body).trigger('wc_fragment_refresh');
				jQuery( document.body).trigger('lottery_lucky_dip_finished',[response,lottery_id] );
				jQuery('input[name=max_quantity]').val(  parseInt(new_max_qty) );
			},
			error: function() {

			}
		});
		jQuery(document.body).trigger('wc_fragment_refresh');
		jQuery(document.body).trigger('added_to_cart');
		e.preventDefault();
	});
</script>