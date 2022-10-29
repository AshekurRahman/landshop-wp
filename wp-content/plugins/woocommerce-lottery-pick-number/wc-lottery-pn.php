<?php

/**
 *
 * @link              http://wpgenie.org
 * @since             1.0.0
 * @package           Wc_Lottery_Pn
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Lottery Pick Number
 * Plugin URI:        https://wpgenie.org/woocommerce-lottery/
 * Description:       WooCommerce Lottery plugin extension for picking lottery number(s), randomly assigning ticket numbers, questions / answers and manually picking winners based on 3rd party lottery number drawings.
 * Version:           2.3.0
 * Author:            wpgenie
 * Author URI:        http://wpgenie.org
 * Requires at least: 4.0
 * Tested up to:      7.0
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wc-lottery-pn
 * Domain Path:       /languages
 * 
 * WC requires at least: 4.0
 * WC tested up to: 7.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die();
}

/**
 * Current plugin version.
 *
 */
define( 'WC_LOTTERY_PN', '2.3.0' );
define( 'WC_LOTTERY_PN_DB', '1.1' );

function activate_wc_lottery_pn() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wc-lottery-pn-activator.php';
	Wc_Lottery_Pn_Activator::activate();
}
register_activation_hook( __FILE__, 'activate_wc_lottery_pn' );
/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wc-lottery-pn.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wc_lottery_pn() {
	if ( class_exists( 'wc_lottery' ) ){
		global $wc_lottery_pn;
		$wc_lottery_pn = new Wc_Lottery_Pn();
		$wc_lottery_pn->run();
	}
}


add_action( 'woocommerce_init' , 'run_wc_lottery_pn', 90);
add_action( 'elementor_pro/init', 'wc_lottery_pn_load_elementor_support');

function wc_lottery_pn_load_elementor_support() {
	require_once plugin_dir_path(  __FILE__  )  . 'includes/elementor/lotteries.php' ;
}

if ( ! function_exists( 'woocommerce_quantity_input' ) ) { 
	/**
	 * Output the quantity input for add to cart forms.
	 *
	 * @param  array           $args Args for the input.
	 * @param  WC_Product|null $product Product.
	 * @param  boolean         $echo Whether to return or echo|string.
	 *
	 * @return string
	 */
	
	function woocommerce_quantity_input( $args = array(), $product = null, $echo = true ) {
		if ( is_null( $product ) ) {
			$product = $GLOBALS['product'];
		}
		
		$defaults = array(
			'input_id'     => uniqid( 'quantity_' ),
			'input_name'   => 'quantity',
			'input_value'  => '1',
			'classes'      => apply_filters( 'woocommerce_quantity_input_classes', array( 'input-text', 'qty', 'text' ), $product ),
			'max_value'    => apply_filters( 'woocommerce_quantity_input_max', -1, $product ),
			'min_value'    => apply_filters( 'woocommerce_quantity_input_min', 0, $product ),
			'step'         => apply_filters( 'woocommerce_quantity_input_step', 1, $product ),
			'pattern'      => apply_filters( 'woocommerce_quantity_input_pattern', has_filter( 'woocommerce_stock_amount', 'intval' ) ? '[0-9]*' : '' ),
			'inputmode'    => apply_filters( 'woocommerce_quantity_input_inputmode', has_filter( 'woocommerce_stock_amount', 'intval' ) ? 'numeric' : '' ),
			'product_name' => $product ? $product->get_title() : '',
			'placeholder'  => apply_filters( 'woocommerce_quantity_input_placeholder', '', $product ),
		);

		$args = apply_filters( 'woocommerce_quantity_input_args', wp_parse_args( $args, $defaults ), $product );
		// Apply sanity to min/max args - min cannot be lower than 0.
		$args['min_value'] = max( $args['min_value'], 0 );
		$args['max_value'] = 0 < $args['max_value'] ? $args['max_value'] : '';

		// Max cannot be lower than min if defined.
		if ( '' !== $args['max_value'] && $args['max_value'] < $args['min_value'] ) {
			$args['max_value'] = $args['min_value'];
		}
		ob_start();

		if ( get_post_meta( $product->get_id() , '_lottery_use_pick_numbers', true ) === 'yes' && "yes" !== get_post_meta( $product->get_id() , '_lottery_pick_numbers_random', true ) && $args['input_id'] != 'qty_dip') {
			echo '<div class="quantity">
				<input type="hidden" id="' .esc_attr( $args['input_id'] ) . '" class="qty" name="' . esc_attr( $args['input_name'] ) . '" value="' . esc_attr($args['input_value']) . '" />
				'.$args['input_value'].'
			</div>';
		} else {
			wc_get_template( 'global/quantity-input.php', $args );
		}
		

		if ( $echo ) {
			echo ob_get_clean(); // WPCS: XSS ok.
		} else {
			return ob_get_clean();
		}
	}
}
