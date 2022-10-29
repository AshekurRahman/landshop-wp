<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://wpgenie.org
 * @since      1.0.0
 *
 * @package    Wc_Lottery_Pn
 * @subpackage Wc_Lottery_Pn/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Wc_Lottery_Pn
 * @subpackage Wc_Lottery_Pn/includes
 * @author     wpgenie <info@wpgenie.org>
 */
class Wc_Lottery_Pn {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Wc_Lottery_Pn_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	public $plugin_public;

	public $plugin_admin;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->version     = WC_LOTTERY_PN;
		$this->plugin_name = 'wc-lottery-pn';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->update();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Wc_Lottery_Pn_Loader. Orchestrates the hooks of the plugin.
	 * - Wc_Lottery_Pn_i18n. Defines internationalization functionality.
	 * - Wc_Lottery_Pn_Admin. Defines all hooks for the admin area.
	 * - Wc_Lottery_Pn_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wc-lottery-pn-update.php';
		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wc-lottery-pn-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wc-lottery-pn-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wc-lottery-pn-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wc-lottery-pn-public.php';

		$this->loader = new Wc_Lottery_Pn_Loader();

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/wc-lottery-pn-functions.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/wc-lottery-pn-template-functions.php';
		
		if ( class_exists( 'WC_Shortcode_Lottery' ) ){
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wc-lottery-shortcodes-pn.php' ;
			$this->shortcodes = new WC_Shortcode_Lottery_Pn();
		}


		
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Wc_Lottery_Pn_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Wc_Lottery_Pn_i18n();
		
		$this->loader->add_action( 'wp_loaded', $plugin_i18n, 'load_plugin_textdomain' );


	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$this->plugin_admin = new Wc_Lottery_Pn_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $this->plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $this->plugin_admin, 'enqueue_scripts' );

		$this->loader->add_action( 'wc_lottery_participate', $this->plugin_admin, 'lottery_pn_order', 10, 6);
		$this->loader->add_action( 'wc_lottery_cancel_participation', $this->plugin_admin, 'lottery_pn_order_canceled', 10, 6 );
		$this->loader->add_action( 'wc_lottery_delete_participate_entry', $this->plugin_admin, 'lottery_pn_ajax_delete_entry', 10, 2 );

		$this->loader->add_action( 'woocommerce_checkout_create_order_line_item', $this->plugin_admin, 'add_ticket_numbers_to_order_items', 10, 4 );
		$this->loader->add_action( 'woocommerce_checkout_create_order_line_item', $this->plugin_admin, 'add_ticket_answer_to_order_items', 10, 4 );

		$this->loader->add_action( 'woocommerce_product_options_lottery', $this->plugin_admin, 'add_extra_product_write_panel', 10 );
		$this->loader->add_action( 'lottery_product_save_data', $this->plugin_admin, 'product_save_data', 80, 2 );
		$this->loader->add_action( 'lottery_product_save_data', $this->plugin_admin, 'save_answers', 80, 2 );

		$this->loader->add_action( 'wp_ajax_woocommerce_add_lottery_answer', $this->plugin_admin, 'ajax_add_answer_line' );
		$this->loader->add_action( 'delete_post', $this->plugin_admin, 'del_lottery_extra_logs' );
		$this->loader->add_action( 'woocommerce_lottery_do_relist', $this->plugin_admin, 'del_lottery_extra_logs' );

		$this->loader->add_filter( 'woocommerce_lottery_participants', $this->plugin_admin, 'get_lottery_participants', 90, 3 );
		$this->loader->add_filter( 'woocommerce_lottery_winners', $this->plugin_admin, 'get_lottery_winners', 90, 3 );

		$this->loader->add_filter( 'woocommerce_simple_lottery_settings', $this->plugin_admin, 'custom_woocommerce_lottery_settings', 90);

		$this->loader->add_action( 'do_meta_boxes', $this->plugin_admin, 'remove_lottery_metaboxes' );
		$this->loader->add_action( 'add_meta_boxes', $this->plugin_admin, 'woocommerce_simple_lottery_meta' );
		$this->loader->add_action( 'woocommerce_lottery_do_relist', $this->plugin_admin, 'do_relist', 10, 3);

		$this->loader->add_action( 'woocommerce_checkout_update_order_meta', $this->plugin_admin, 'check_for_duplicate_tickets_in_order', 10, 2);

		$this->loader->add_filter( 'lotery_add_participants_from_order', $this->plugin_admin, 'remove_participants_if_wrong_answer', 90, 4 );
		$this->loader->add_filter( 'lotery_remove_participants_from_order', $this->plugin_admin, 'remove_participants_if_wrong_answer', 90, 4 );
		$this->loader->add_filter( 'lotery_add_participants_from_order', $this->plugin_admin, 'filter_duplicate_ticket_in_order', 90, 4 );

		$this->loader->add_filter( 'add_meta_boxes', $this->plugin_admin, 'automatic_relist_meta_boxes', 10);
		$this->loader->add_action( 'wp_ajax_delete_lottery_history_csv', $this->plugin_admin, 'wp_ajax_delete_lottery_history_csv' );
		$this->loader->add_action( 'wp_ajax_get_lottery_istant_winners_fields', $this->plugin_admin, 'wp_ajax_get_lottery_istant_winners_fields' );

		$this->loader->add_action( 'admin_notices', $this->plugin_admin, 'woocommerce_simple_lottery_pn_admin_notice' );
		$this->loader->add_action( 'admin_init', $this->plugin_admin, 'woocommerce_simple_lottery_pn_ignore_notices' );

		$this->loader->add_action( 'woocommerce_after_adding_extar_info', $this->plugin_admin, 'check_for_instant_prize', 10, 7);
		$this->loader->add_action( 'woocommerce_email', $this->plugin_admin, 'add_to_mail_class' );
		$this->loader->add_filter( 'woocommerce_lottery_get_lottery_participants', $this->plugin_admin, 'remove_instant_winners_for_participate', 10, 3 );

		/* emails hooks */
		$email_actions = array( 'wc_lottery_instant_won');
		foreach ( $email_actions as $action ) {
			$this->loader->add_action( $action, 'WC_Emails' , 'send_transactional_email') ;
		}
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$this->plugin_public = new Wc_Lottery_Pn_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $this->plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $this->plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'wc_ajax_wc_lottery_get_taken_numbers', $this->plugin_public, 'get_taken_numbers' );
		$this->loader->add_action( 'wc_ajax_wc_lottery_lucky_dip', $this->plugin_public, 'lottery_lucky_dip' );
		$this->loader->add_action( 'woocommerce_add_to_cart', $this->plugin_public, 'reserve_tickets', 10, 6 );
		$this->loader->add_action( 'woocommerce_remove_cart_item', $this->plugin_public, 'delete_ticket_reservations', 10, 2 );
		$this->loader->add_action( 'get_header', $this->plugin_public, 'remove_notification_from_order_recieved_page', 99 );
		$this->loader->add_action( 'woocommerce_before_pay_action', $this->plugin_public, 'check_ticket_numbers_before_pay_action', 99 );
		$this->loader->add_action( 'woocommerce_order_item_meta_start', $this->plugin_public, 'add_wrong_answer_notice_in_emails', 1,4 );
		$this->loader->add_action( 'woocommerce_order_item_meta_end', $this->plugin_public, 'add_instant_in_order', 1,4 );

		$this->loader->add_filter( 'woocommerce_locate_template', $this->plugin_public, 'woocommerce_locate_template', 10, 3 );
		$this->loader->add_filter( 'woocommerce_add_cart_item_data', $this->plugin_public, 'add_ticket_number_to_cart_item', 10, 3 );
		$this->loader->add_filter( 'woocommerce_add_cart_item_data', $this->plugin_public, 'add_ticket_answer_to_cart_item', 10, 3 );
		$this->loader->add_filter( 'woocommerce_get_item_data', $this->plugin_public, 'display_ticket_numbers_cart', 10, 2 );
		$this->loader->add_filter( 'woocommerce_get_item_data', $this->plugin_public, 'display_ticket_answer_cart', 10, 2 );
		$this->loader->add_filter( 'woocommerce_order_item_display_meta_value', $this->plugin_public, 'order_item_display_meta_value', 10, 3 );
		$this->loader->add_filter( 'woocomerce_lottery_history', $this , 'get_lottery_history_with_extra_info', 10, 4 );
		$this->loader->add_filter( 'woocommerce_get_cart_item_from_session', $this->plugin_public , 'check_cart_ticket_numbers', 10, 4 );
		$this->loader->add_filter( 'woocommerce_cart_loaded_from_session', $this->plugin_public , 'check_cart_for_dupicate_ticket_numbers', 10 );
		$this->loader->add_filter( 'woocommerce_add_to_cart_validation', $this->plugin_public, 'add_to_cart_validation', 10, 3 );
		$this->loader->add_action( 'template_redirect', $this->plugin_public, 'use_alphabet' );
		$this->loader->add_action( 'woocommerce_product_options_lottery', $this->plugin_public, 'use_alphabet',99 );
		$this->loader->add_action( 'export_lottery_history_with_extra_info', $this->plugin_public, 'use_alphabet',99 );
		
		$this->loader->add_filter( 'woocommerce_get_item_data', $this->plugin_public, 'change_cart_ticket_number_to_alphabet', 10, 2 );
		$this->loader->add_filter( 'woocommerce_display_item_meta', $this->plugin_public, 'change_order_ticket_number_to_alphabet', 90, 3 );
		$this->loader->add_filter( 'woocommerce_order_item_display_meta_value', $this->plugin_public, 'woocommerce_order_item_display_meta_value_aplhabet', 90, 3 );

		$this->loader->add_filter( 'woocommerce_quantity_input_max', $this->plugin_public, 'reduce_quantity_input_max_for_reserved_tickets', 90, 2 );
		$this->loader->add_filter( 'woocommerce_lottery_max_purchase_quantity', $this->plugin_public, 'remove_reserved_from_max_purchase_quantity', 90, 2 );

		$this->loader->add_action( 'wp_login', $this->plugin_public, 'sync_seesion_key', 99, 2 );
		$this->loader->add_action( 'user_register', $this->plugin_public, 'sync_session_key_register', 99, 1 );


		if( get_option( 'lottery_show_my_tickets', 'yes' ) === 'yes' ){
			$this->loader->add_action( 'init', $this->plugin_public, 'woocommerce_lottery_my_tickets_mytickets_endpoint' );
			$this->loader->add_action( 'init', $this->plugin_public, 'woocommerce_lottery_my_tickets_mytickets_past_endpoint' );
			$this->loader->add_action( 'woocommerce_account_comp-tickets_endpoint', $this->plugin_public, 'woocommerce_lottery_my_tickets_endpoint_content' );
			$this->loader->add_action( 'woocommerce_account_comp-tickets-past_endpoint', $this->plugin_public, 'woocommerce_lottery_my_tickets_past_endpoint_content' );
			$this->loader->add_filter( 'woocommerce_account_menu_items', $this->plugin_public, 'add_my_account_menu_items', 100, 1 );
		}	

		$this->loader->add_filter( 'query_vars', $this->plugin_public, 'add_query_vars', 0 );
		$this->loader->add_filter( 'woocommerce_lottery_entry_list_columns', $this->plugin_public, 'add_woocommerce_lottery_entry_list_columns', 10, 1 );
		$this->loader->add_filter( 'woocommerce_lottery_entry_list_column_default', $this->plugin_public, 'add_woocommerce_lottery_entry_list_column_default', 10, 3);
		$this->loader->add_filter( 'woocommerce_lottery_entry_list_query', $this->plugin_public, 'mod_woocommerce_lottery_entry_list_query', 10, 3 );
		$this->loader->add_action( 'init', $this->plugin_public, 'simple_lottery_pn_cron', PHP_INT_MAX );		

		add_action( 'woocommerce_before_add_to_cart_button', 'lottery_ticket_numbers_add_to_cart_button', 5 );
		add_action( 'woocommerce_before_add_to_cart_button', 'lottery_questions_add_to_cart_button', 7 );
		add_action( 'wc_lottery_before_ticket_numbers', 'woocommerce_lottery_lucky_dip_button_template', 10 );
		add_action( 'woocommerce_lottery_ajax_change_participate', 'woocommerce_lottery_instant_prizes_info_template',12 );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 *
	 * @since    2.0.7
	 */
	public function update() {
		$wc_lottery_version = get_site_option( 'wc_lottery_version' );
		if($this->version !== $wc_lottery_version) {
			flush_rewrite_rules();
			update_option( 'wc_lottery_version', $this->version );
		}
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Wc_Lottery_Pn_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	public function get_lottery_history_with_extra_info( $history, $product_id, $user_id, $relisteddate ) {
		
		global $wpdb;
		$wheredatefrom = '';
		$datefrom      = FALSE;

		$relisteddate = get_post_meta( $product_id, '_lottery_relisted', true );
		if(!is_admin() && !empty($relisteddate)){
		    $datefrom = $relisteddate;
		}

		if($datefrom){
		    $wheredatefrom =" AND CAST(date AS DATETIME) > '$datefrom' ";
		}

		if($user_id){
		    $wheredatefrom =" AND wc_lottery_log.userid = $user_id";
		}
		
		$history = $wpdb->get_results( 'SELECT * FROM '.$wpdb->prefix.'wc_lottery_log LEFT JOIN '.$wpdb->prefix.'wc_lottery_pn_log on '.$wpdb->prefix.'wc_lottery_log.id = '.$wpdb->prefix.'wc_lottery_pn_log.log_id WHERE '.$wpdb->prefix.'wc_lottery_log.lottery_id =' . $product_id . $wheredatefrom.' ORDER BY `date` DESC');

		return $history;
	}

}