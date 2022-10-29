<?php
/**
 * Admin lottery finish email
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
$product_data = wc_get_product(  $product_id );
$lottery_winers = get_post_meta($product_id, '_lottery_winners');
$lottery_pn_winers  = get_post_meta($product_id, '_lottery_pn_winners',true);
$use_answers        = wc_lottery_use_answers( $product_id );
$use_ticket_numbers = get_post_meta( $product_id , '_lottery_use_pick_numbers', true );
$answers            = maybe_unserialize( get_post_meta( $product_id, '_lottery_pn_answers', true ) );

?>

<?php do_action('woocommerce_email_header', $email_heading); ?>

<p><?php printf( __( "Lottery <a href='%s'>%s</a> has finished.", 'wc_lottery' ),get_permalink($product_id), $product_data->get_title() ); ?>
<?php 	
if ( ! empty( $lottery_pn_winers ) ) {
	if ( count( $lottery_pn_winers ) === 1 ) { 
		$winner = reset( $lottery_pn_winers );
		if ( ! empty( $lottery_pn_winers ) ) {
			$order_id = wc_lotery_get_order_id_by_log_id( $winner['log_id'] ); 
			?>
					<p>
						<?php _e( 'Lottery winner is', 'wc_lottery' ); ?>: 
						<span><a href='<?php echo get_edit_user_link( $winner['userid'] ); ?>'><?php echo get_userdata( $winner['userid'] )->display_name; ?></a></span>, 
						<?php _e( 'Ticket', 'wc_lottery' ); ?>: 
						<span><?php echo $winner['ticket_number'] ?></span>, 
						<?php _e( 'Order', 'wc_lottery' ); ?>: 
						<span><a href='<?php echo admin_url( 'post.php?post=' . $order_id . '&action=edit' ) ?>'><?php echo $order_id ?></a></span>
					</p>
			<?php } ?>
		<?php } else { ?>

		<p><?php _e( 'Lottery winners are', 'wc_lottery' ); ?>:
			<ul>
			<?php
			foreach ( $lottery_pn_winers as $key => $winner ) {
				if ( $winner) {
					$order_id = wc_lotery_get_order_id_by_log_id( $winner['log_id'] ); 
				?>
					<li>
						<?php _e( 'Lottery winner is', 'wc_lottery' ); ?>: 
						<span><a href='<?php echo get_edit_user_link( $winner['userid'] ); ?>'><?php echo get_userdata( $winner['userid'] )->display_name; ?></a></span>, 
						<?php _e( 'Ticket', 'wc_lottery' ); ?>: 
						<span><?php echo $winner['ticket_number'] ?></span>, 
						<?php _e( 'Order', 'wc_lottery' ); ?>: 
						<span><a href='<?php echo admin_url( 'post.php?post=' . $order_id . '&action=edit' ) ?>'><?php echo $order_id ?></a></span>
					</li>
			<?php
				}
			}
			?>
			</ul>
		</p>

	<?php }

} elseif ( $lottery_winers ) {

	if ( count( $lottery_winers ) === 1 ) { 

		$winnerid = reset( $lottery_winers );
		if ( ! empty( $winnerid ) ) {
		?>
				<p>
					<?php _e( 'Lottery winner is', 'wc_lottery' ); ?>: <span><a href='<?php echo get_edit_user_link( $winnerid ); ?>'><?php echo get_userdata( $winnerid )->display_name; ?></a></span>
				</p>
		<?php } ?>
	<?php } else { ?>

	<p><?php _e( 'Lottery winners are', 'wc_lottery' ); ?>:
		<ul>
		<?php
		foreach ( $lottery_winers as $key => $winnerid ) {
			if ( $winnerid > 0 ) {
			?>
				<li><a href='<?php get_edit_user_link( $winnerid ); ?>'><?php echo get_userdata( $winnerid )->display_name; ?></a></li>
		<?php
			}
		}
		?>
		</ul>
	</p>

<?php }
} ?>


<?php do_action('woocommerce_email_footer');