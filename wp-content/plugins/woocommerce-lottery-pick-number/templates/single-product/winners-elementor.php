<?php
/**
 * Winners block template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/winners.php.
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global  $product, $post;
$current_user       = wp_get_current_user();
$lottery_winers     = get_post_meta($post->ID, '_lottery_winners');
$lottery_pn_winers  = get_post_meta($post->ID, '_lottery_pn_winners',true);
$use_answers        = wc_lottery_use_answers( $post->ID );
$use_ticket_numbers = get_post_meta( $post->ID , '_lottery_use_pick_numbers', true );
$answers            = maybe_unserialize( get_post_meta( $post->ID, '_lottery_pn_answers', true ) );

?>



<p><?php esc_html_e('Please be patient. We are waiting for some orders to be paid!','wc-lottery-pn') ?></p>

<p><?php esc_html_e('Please be patient. We are picking winners!','wc-lottery-pn'); ?></p>

<p><?php _e('Congratulations! You are winner!','wc_lottery') ?></p>

<p><?php _e('Sorry, better luck next time.','wc_lottery') ?></p>

<p><?php _e('Lottery failed because there were no participants','wc_lottery') ?></p>

<p><?php _e('Lottery failed because there was not enough participants','wc_lottery') ?></p>
	

<h3><?php esc_html_e('Winners:','wc-lottery-pn') ?></h3>


<div class="lottery-winners">
<h3><?php esc_html_e('Winner is:','wc-lottery-pn') ?> <?php esc_html_e('Example user','wc-lottery-pn') ?> </h3>
	<?php 
		echo " <span class='ticket-number'>";
		esc_html_e( 'Ticket number: ', 'wc-lottery-pn' );
		echo apply_filters( 'ticket_number_display_html' , '1', $product );
		echo "</span>";
		echo " <span class='ticket-answer'>";
		esc_html_e( 'Answer: ', 'wc-lottery-pn' );
		esc_html_e( 'Sample Answer', 'wc-lottery-pn' );
		echo "</span>";
echo '</div>';


echo '<h3>';
esc_html_e( 'There is no winner for this lottery', 'wc-lottery-pn' );
echo '</h3>';
