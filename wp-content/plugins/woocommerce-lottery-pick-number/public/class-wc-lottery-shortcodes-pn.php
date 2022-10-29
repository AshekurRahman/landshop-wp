<?php
/**
 * Wc lotteries Shortcode
 *
 */

class WC_Shortcode_Lottery_Pn extends WC_Shortcode_Lottery {

	/**
	 * Init shortcodes.
	 */
	public function __construct() {
		$shortcodes = array(
			'lottery_lucky_dip_buton'             => __CLASS__ . '::lottery_participate_buton',
		);
		foreach ( $shortcodes as $shortcode => $function ) {
			add_shortcode( apply_filters( "{$shortcode}_shortcode_tag", $shortcode ), $function );
		}

	}
	public static function lottery_participate_buton( $atts ) {
		wc_get_template( '/global/lottery-participate-button.php', $atts );
	}
}