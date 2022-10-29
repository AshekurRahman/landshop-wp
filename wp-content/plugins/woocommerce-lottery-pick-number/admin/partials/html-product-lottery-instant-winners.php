<div class="wcl_instant_box" rel="<?php echo esc_attr( $ticket_numbers_prizes ); ?>" >
	<div class="woocommerce_instant_winner_data">
		<table cellpadding="0" cellspacing="0" width="100%">
		<tbody>
		<tr>
			<td>
				<label><?php _e( 'Instant ticket', 'wc-lottery-pn' ); ?>:</label>

				<input type="text" class="lottery_instant_ticket" name="lottery_instant_ticket[<?php echo esc_attr( $ticket_numbers_prizes ); ?>]" size="20" value="<?php echo isset( $ticket_number_prize['ticket'] ) ? esc_attr( $ticket_number_prize['ticket'] ) : '' ; ?>" data-instant_winner-id="<?php echo esc_attr( $ticket_numbers_prizes ) ?>" />
				<br/>
				<label><?php _e( 'Prize', 'wc-lottery-pn' ); ?>:</label>

				<input type="text" class="lottery_instant_prize" name="lottery_instant_prize[<?php echo esc_attr( $ticket_numbers_prizes ); ?>]" size="20" value="<?php echo isset( $ticket_number_prize['prize'] ) ? esc_attr( $ticket_number_prize['prize'] ) : '' ; ?>" data-instant_winner-id="<?php echo esc_attr( $ticket_numbers_prizes ) ?>" />
			</td>
			<td class="remove-instant_winner"><a href="#" class="remove_row delete"><?php _e( 'Remove', 'woocommerce' ); ?></a></td>
		</tr>
		</tbody>
		</table>
	</div>
</div>
