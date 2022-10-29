<?php
/**
 * Lottery history tab template
 * 
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/lottery-history.php
 * 
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce, $post, $product;

$lottery_winers = get_post_meta($post->ID, '_lottery_winners');
$users_names = '';
$use_answers = wc_lottery_use_answers( $post->ID );
$use_ticket_numbers = get_post_meta( $post->ID , '_lottery_use_pick_numbers', true );
$answers = maybe_unserialize( get_post_meta( $post->ID, '_lottery_pn_answers', true ) );
$date_format = get_option( 'date_format' );
$time_format = get_option( 'time_format' );

?>

<h2><?php echo esc_html( __( 'Lottery History', 'wc-lottery-pn' ) ); ?></h2>


<?php if(($product->is_closed() === TRUE ) and ($product->is_started() === TRUE )) : ?>
	
	<p><?php _e('Lottery has finished', 'wc-lottery-pn') ?></p>
	<?php if ($product->get_lottery_fail_reason() == '1'){
		 _e('Lottery failed because there were no minimal number of participants', 'wc-lottery-pn');
	} else{

		if ( count($lottery_winers) > 1 ) { ?>

		   <p><?php _e('Lottery winners are', 'wc-lottery-pn') ?>: <?php foreach ($lottery_winers as $winner_id) {
		   	if( intval( $winner_id ) > 0) {
					$users_names .= "<span>";
					$users_names .= get_userdata($winner_id)->display_name;
					$users_names .= "</span>, ";
				}
			} ?><?php echo rtrim( $users_names , ', '); ?></p>
		
		<?php } elseif( count($lottery_winers) === 1 ) {
			$winner = reset($lottery_winers);

			if ( ! empty ( $winner ) ) { ?>
			<p><?php _e('Lottery winner is:', 'wc-lottery-pn') ?> <span><?php echo get_userdata($winner)->display_name ?></span></p>
		<?php } 
		}
	} ?>
							
<?php endif; ?>	

<?php if ( 'yes' === get_post_meta( $post->ID, '_lottery_instant_win', true ) ){

			$lottery_instant_instant_winners = get_post_meta( $post->ID, '_lottery_instant_instant_winners');
			$prizes = wc_lottery_get_instant_winning_prizes( $post->ID );
			printf( _n( "This lottery has %d instant prize winner" , "This lottery has %d instant prize winners", count( $lottery_instant_instant_winners ) , 'wc_lottery' ) , count( $lottery_instant_instant_winners ) ) ;
			echo '<ol class="lottery-instant-winners">';

        		if ( $lottery_instant_instant_winners ){
					foreach ($lottery_instant_instant_winners as $key => $winner) {
						echo "<li>";
                		esc_html_e(  $winner['prize'] );
                		echo ' - ';
                		_e('prize winner is:', 'wc-lottery-pn');
                		echo ' <span>' . get_userdata( $winner['user_id'] )->display_name .'</span>';
                		echo ', ';
                		_e('ticket number:', 'wc-lottery-pn');
                		echo ' <span>' .  $winner['ticket']  .'</span>';
                		echo "</li>";

					}
				}

			echo '</ol>';

		}
		?>

<table>
	<thead>
		<tr>
			<th><?php _e('Date', 'wc-lottery-pn') ?></th>
			<th><?php _e('User', 'wc-lottery-pn') ?></th>
			<?php if ($use_ticket_numbers === 'yes' ) :?>
				<th><?php _e('Ticket number', 'wc-lottery-pn') ?></th>
			<?php endif; ?>
			<?php if ($use_answers === true && 'yes' === get_option('lottery_answers_in_history', 'yes')  && ( 'no' === get_option('lottery_answers_in_history_finished', 'no') || $product->is_closed() === TRUE ) ) :?>
				<th><?php _e('Answer', 'wc-lottery-pn') ?></th>
			<?php endif; ?>
		</tr>
	</thead>
	<?php 
		$lottery_history = $product->lottery_history();
		
		if( $lottery_history ) {		 
		
			foreach ($lottery_history as $history_value) {

				echo "<tr>";
				echo "<td class='date'>".date_i18n( $date_format, strtotime( $history_value->date )).' '.date_i18n( $time_format, strtotime( $history_value->date ))."</td>";
				echo $history_value->userid ? "<td class='username'>". ( get_userdata($history_value->userid) ? get_userdata($history_value->userid)->display_name : '' ) ."</td>" : '';

				if ($use_ticket_numbers === 'yes' ) {
					echo "<td class='ticket_number'>" . apply_filters( 'ticket_number_display_html' , $history_value->ticket_number, $product ) . "</td>";
				}
				
				if ( $use_answers === true && 'yes' === get_option('lottery_answers_in_history', 'yes')  && ( 'no' === get_option('lottery_answers_in_history_finished', 'no') || $product->is_closed() === TRUE ) ){
					$answer = isset( $answers[$history_value->answer_id] ) ? $answers[$history_value->answer_id] : false;
					
					echo "<td class='answer'>";
					echo $answer !== true ? $answer['text'] : "" ;
					echo "</td>";
				}
				
				echo "</tr>";
			}
		
		}
	?>	
	<tr class="start">
			<?php 
			
			$lottery_dates_to = $product->get_lottery_dates_from();


			if ($product->is_started() === TRUE ){
				echo '<td class="date">'.date_i18n( $date_format,  strtotime( $lottery_dates_to )).' '.date_i18n( $time_format,  strtotime( $lottery_dates_to )).'</td>';				
				echo '<td class="started">';
				esc_html_e( 'Lottery started', 'wc-lottery-pn' );
				echo '</td>';

			} else {
				echo '<td class="date">'.date_i18n( $date_format,  strtotime( $lottery_dates_to )).' '.date_i18n( $time_format,  strtotime( $lottery_dates_to )).'</td>';				
				echo '<td class="starting">';
				esc_html_e( 'Lottery starting', 'wc-lottery-pn' );
				echo '</td>' ;
			}?>
	</tr>
</table>