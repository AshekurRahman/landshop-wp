<?php
	if ( ! defined( 'ABSPATH' ) ) {
		exit; // Exit if accessed directly.
	}

	/**
	 * Main Spicy Extension Class
	 *
	 * The main class that initiates and runs the plugin.
	 *
	 * @since 1.0.0
	 */
	final class Lottery_Pn_Extension {


		/**
		 * Minimum Elementor Version
		 *
		 * @since 1.0.0
		 *
		 * @var string Minimum Elementor version required to run the plugin.
		 */
		const MINIMUM_ELEMENTOR_VERSION = '3';

		/**
		 * Instance
		 *
		 * @since 1.0.0
		 *
		 * @access private
		 * @static
		 *
		 * @var Spicy_Extension The single instance of the class.
		 */
		private static $_instance = null;

		/**
		 * Instance
		 *
		 * Ensures only one instance of the class is loaded or can be loaded.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 * @static
		 *
		 * @return Spicy_Extension An instance of the class.
		 */
		public static function instance() {

			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

		 	return self::$_instance;
		}

		/**
		 * Constructor
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		
		public function __construct() {	
			add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
		}

		

		/**
		 * Initialize the plugin
		 *
		 * Load the plugin only after Elementor (and other plugins) are loaded.
		 * Checks for basic plugin requirements, if one check fail don't continue,
		 * if all check have passed load the files required to run the plugin.
		 *
		 * Fired by `plugins_loaded` action hook.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function init() {

			// Check for required Elementor version			
			if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
				add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
				return;
			}
			// Add Plugin actions
			add_action( 'elementor/widgets/widgets_registered', [ $this, 'init_widgets' ] );
			// Register Widget Styles
			add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );

		}

		public function widget_styles() {
			wp_enqueue_style( 'spicyPluginStylesheet', plugins_url( '/css/lotteries.css', __FILE__ ) );
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required Elementor version.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function admin_notice_minimum_elementor_version() {

			if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

			$message = sprintf(
				/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'Spicy-extension' ),
				'<strong>' . esc_html__( 'Elementor Spicy Extension', 'Spicy-extension' ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', 'Spicy-extension' ) . '</strong>',
				self::MINIMUM_ELEMENTOR_VERSION
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

		}


		/**
		 * Init Widgets
		 *
		 * Include widgets files and register them
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function init_widgets() {

			// Include Widget files
			require_once( __DIR__ . '/widgets/lottery_pick_numbers.php' );
			require_once( __DIR__ . '/widgets/lottery_answers.php' );
			require_once( __DIR__ . '/widgets/lucky_dip.php' );
			require_once( __DIR__ . '/widgets/participate_qty.php' );
			
			// Register widget
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \ElementorPro\Modules\Woocommerce\Widgets\Lottery_Pick_Numbers() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \ElementorPro\Modules\Woocommerce\Widgets\Lottery_Answers() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \ElementorPro\Modules\Woocommerce\Widgets\Lucky_Dip() );
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \ElementorPro\Modules\Woocommerce\Widgets\Participate_Qty() );

		}


    }

Lottery_Pn_Extension::instance();

add_action( 'elementor/widget/wc-add-to-cart/skins_init', 'lottery_deregsiter_hooks_for_elementor_suport' );

function lottery_deregsiter_hooks_for_elementor_suport(){
	remove_action( 'woocommerce_before_add_to_cart_button', 'lottery_ticket_numbers_add_to_cart_button', 5 );
	remove_action( 'woocommerce_before_add_to_cart_button', 'lottery_questions_add_to_cart_button', 7 );
	remove_action( 'wc_lottery_before_ticket_numbers', 'woocommerce_lottery_lucky_dip_button_template', 10 );
}