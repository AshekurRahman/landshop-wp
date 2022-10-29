<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://wpgenie.org
 * @since      1.0.0
 *
 * @package    Wc_Lottery_Pn
 * @subpackage Wc_Lottery_Pn/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wc_Lottery_Pn
 * @subpackage Wc_Lottery_Pn/public
 * @author     wpgenie <info@wpgenie.org>
 */
class Wc_Lottery_Pn_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wc_Lottery_Pn_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wc_Lottery_Pn_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wc-lottery-pn-public.css', array(), $this->version, 'all' );
		wp_enqueue_style('jquery-alertable', plugin_dir_url( __FILE__ ) . 'css/jquery.alertable.css', array($this->plugin_name), null, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wc_Lottery_Pn_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wc_Lottery_Pn_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wc-lottery-pn-public.js', array( 'jquery' ), $this->version, false ); 
		$data = array(
			'maximum_text'            =>  esc_js( __('You already have selected maximum number of tickets!' , 'wc-lottery-pn') ),
			'maximum_add_text'            =>  esc_js( __('Max tickets qty is:' , 'wc-lottery-pn') ),
			'sold_text'            =>  esc_js( __('Ticket sold!' , 'wc-lottery-pn') ),
			'in_cart_text'            =>  esc_js( __('You have already this ticket in your cart!' , 'wc-lottery-pn') ),
			'logintext'            =>  sprintf( __('Sorry, you must be logged in to participate in lottery. <a href="%s" class="button">Login &rarr;</a>', 'wc-lottery-pn'), get_permalink(wc_get_page_id('myaccount') ) ),
			'please_pick'            =>  esc_js( __('Please pick a number. ' , 'wc-lottery-pn') ),
			'please_answer'            =>  esc_js( __('Please answer the question.' , 'wc-lottery-pn') ),
			'please_true_answer'            =>  esc_js( __('You must pick correct answer.' , 'wc-lottery-pn') ),
			'reserve_ticket' =>  esc_js( get_option('lottery_answers_reserved', 'no') ),
		);
		wp_localize_script( $this->plugin_name, 'wc_lottery_pn', $data );
		wp_enqueue_script( $this->plugin_name);
		wp_enqueue_script( 'jquery-alertable', plugin_dir_url( __FILE__ ) . 'js/jquery.alertable.min.js', array( 'jquery', $this->plugin_name ), null , false );
	}


	function woocommerce_locate_template( $template, $template_name, $template_path ) {

		$_template = $template;
		if ( ! $template_path ) $template_path = wc()->template_url;
			  $plugin_path  = plugin_dir_path( dirname( __FILE__ ) ) . 'templates/';

		// Look within passed path within the theme - this is priority
		$template = locate_template(
			  array(
				$template_path . $template_name,
				$template_name
			  )
		);

		// Modification: Get the template from this plugin, if it exists
		if ( ! $template && file_exists( $plugin_path . $template_name ) )
			  $template = $plugin_path . $template_name;

		// Use default template
		if ( ! $template )
			  $template = $_template;

		// Return what we found
		return $template;
	}

	public function get_taken_numbers(){

		$response= null;

		$lottery_id = isset( $_GET['lottery_id'] ) ? intval( $_GET['lottery_id'] ) : false;

		if ( $lottery_id ) {
			$response['taken'] = wc_lottery_pn_get_taken_numbers($lottery_id);
			$response['in_cart'] = wc_lottery_pn_get_ticket_numbers_from_cart($lottery_id);
			if ( 'yes' === $_GET['reserve_ticket'] ) {
				$response['reserved'] = wc_lottery_pn_get_reserved_numbers($lottery_id);
			}
		}
	
		wp_send_json( $response );
	}

	
	public function add_ticket_number_to_cart_item( $cart_item_data, $product_id, $variation_id ) {
		$ticket_numbers = filter_input( INPUT_POST, 'lottery_tickets_number' );

		if ( strlen( $ticket_numbers ) == 0 ) {
			return $cart_item_data;
		}
		$ticket_numbers = explode( ',', $ticket_numbers );

		$cart_item_data['lottery_tickets_number'] = $ticket_numbers;

		return $cart_item_data;
	}

	public function add_ticket_answer_to_cart_item( $cart_item_data, $product_id, $variation_id ) {
		$lottery_tickets_answer = filter_input( INPUT_POST, 'lottery_answer' );

		if ( strlen( $lottery_tickets_answer ) == 0 ) {
			return $cart_item_data;
		}

		$cart_item_data['lottery_answer'] = $lottery_tickets_answer;

		return $cart_item_data;
	}

	public function display_ticket_numbers_cart( $item_data, $cart_item ) {

		if ( empty( $cart_item['lottery_tickets_number'] ) ) {
			return $item_data;
		}
		if ( is_array($cart_item['lottery_tickets_number'] ) )  {
			foreach ($cart_item['lottery_tickets_number'] as $ticket_number) {
				$item_data[] = array(
				'key'     => esc_html__( 'Ticket number', 'wc-lottery-pn' ),
				'value'   => wc_clean( $ticket_number ),
				'display' => '',
				);
			}
		} 

		return $item_data;
	}

	public function display_ticket_answer_cart( $item_data, $cart_item ) {

		if ( empty( $cart_item['lottery_answer'] ) ) {
			return $item_data;
		}

		$answers = maybe_unserialize( get_post_meta( $cart_item['product_id'], '_lottery_pn_answers', true ) );

		$item_data[] = array(
			'key'     => __( 'Answer', 'wc-lottery-pn' ),
			'value'   => wc_clean( $cart_item['lottery_answer'] ),
			'display' => isset( $answers[ $cart_item['lottery_answer'] ] ['text'] ) ? $answers[ $cart_item['lottery_answer'] ]['text']  : '',
		);
		return $item_data;
	}
	 
	 public function order_item_display_meta_value( $display_value, $meta, $order ) {

	 	if ( esc_html__( 'Answer', 'wc-lottery-pn' ) !== rawurldecode( (string) $meta->key ) ) {
	 		return $display_value;
	 	}

		$product = is_callable( array( $order, 'get_product' ) ) ? $order->get_product() : false;

		if(! $product ){
			return $display_value;
		}

		$answers = maybe_unserialize( get_post_meta( $product->get_id(), '_lottery_pn_answers', true ) );

	 	return isset( $answers[ $display_value ] ['text'] ) ? $answers[ $display_value ]['text']  : $display_value;

	 }

	public function check_cart_ticket_numbers( $session_data, $values, $key) {
		if( $session_data['data']->get_type() !== 'lottery' ){
			return $session_data;
		}
		if( get_post_meta( $session_data['product_id'], '_lottery_use_pick_numbers', true ) === 'yes' ){ 
			if (  ! empty( $session_data['lottery_tickets_number'] ) ) {
				$product = wc_get_product( $session_data['product_id'] );
				$ticket_numbers =  $session_data['lottery_tickets_number'];
				$session_key = WC()->session->get_customer_id();
				$reserved_numbers = wc_lottery_pn_get_reserved_numbers($session_data['product_id'], $session_key);
				$taken_numbers = wc_lottery_pn_get_taken_numbers($session_data['product_id']);

				if( ! empty($taken_numbers) && ! empty($ticket_numbers) && ! empty( array_intersect( $ticket_numbers, $taken_numbers ) )   ) {
					wc_add_notice( sprintf( __( 'Product %1$s has been removed from your cart because someone purchase that ticket number. Please add it to your cart again by <a href="%2$s">clicking here</a>.', 'wc-lottery-pn' ), $product->get_name(), $product->get_permalink() ), 'error' );
					return false;
				}
				if( ! empty($reserved_numbers) && ! empty($ticket_numbers) && ! empty( array_intersect( $ticket_numbers, $reserved_numbers ) )   ) {
					wc_add_notice( sprintf( __( 'Product %1$s has been removed from your cart because someone reserved that ticket number. Please add it to your cart again by <a href="%2$s">clicking here</a>.', 'wc-lottery-pn' ), $product->get_name(), $product->get_permalink() ), 'error' );
					return false;
				}
				
			} elseif( 'yes' !== get_post_meta( $session_data['product_id'] , '_lottery_pick_numbers_random', true ) ){
				wc_add_notice( sprintf( __( 'Product %1$s has been removed from your cart because you have not selected ticket number. Please add it to your cart again by <a href="%2$s">clicking here</a>.', 'wc-lottery-pn' ), $session_data['data']->get_name(), $session_data['data']->get_permalink() ), 'error' );
				return false;
			}
		}
		return $session_data;
	}

	public function check_cart_for_dupicate_ticket_numbers( $cart_object) {
		$cart = WC()->session->get( 'cart', null );
		$tickets = array();
		if ( ! empty( $cart ) ) {

			foreach ( $cart as $key => $cart_item ) {
				if( isset( $cart_item['lottery_tickets_number'] ) &&  $cart_item['lottery_tickets_number'] ){
					if( !isset( $tickets[$cart_item['product_id']] )){
						$tickets[$cart_item['product_id']] = $cart_item['lottery_tickets_number'];
					} else{
						$tickets[$cart_item['product_id']] = array_merge($tickets[$cart_item['product_id']], $cart_item['lottery_tickets_number']) ;
					}
					
				}
			}
			if(  ! empty( $tickets ) ){
				foreach ($tickets as $key => $value) {
					if(count(array_unique($value))<count($value)) {
						wc_add_notice(  __( 'Please check cart for duplicate ticket numbers.', 'wc-lottery-pn' ), 'error' );
					} 
				}
			}
			
			
		}

	}
	/**
	 * Add to cart validation
	 *
	 */
	public function add_to_cart_validation( $pass, $product_id, $quantity ) {
		
		if ( false === $pass ) {
			return $pass;
		}

		$product = wc_get_product($product_id);

		if ( $product && $product->get_type() !== 'lottery' ) {
			return $pass;
		}

		$use_ticket_numbers = get_post_meta( $product_id , '_lottery_use_pick_numbers', true );
		$random_ticket_numbers = get_post_meta( $product_id , '_lottery_pick_numbers_random', true );
		$use_answers        = wc_lottery_use_answers( $product_id );

		if( 'yes' === $use_ticket_numbers  ){
			if( isset( $_POST['lottery_tickets_number'] ) && strlen ($_POST['lottery_tickets_number'] ) > 0  ){
				$taken_numbers = wc_lottery_pn_get_taken_numbers();
				$session_key = WC()->session->get_customer_id();
				$reserved_numbers = wc_lottery_pn_get_reserved_numbers($product_id, $session_key);
				$tickets_in_cart = wc_lottery_pn_get_ticket_numbers_from_cart($product_id); 
				$ticket_numbers = explode( ',' , $_POST['lottery_tickets_number'] );

				if ( count( $ticket_numbers ) !== $quantity) {
					wc_add_notice( sprintf( __( 'Product %1$s has not been added to your cart. Please add it to your cart again.', 'wc-lottery-pn' ), $product->get_name() ), 'error' );
					$pass = false;
				}

				if( ! empty($taken_numbers) && ! empty($ticket_numbers) && ! empty( array_intersect( $ticket_numbers, $taken_numbers ) ) ) {
					wc_add_notice( sprintf( __( 'Product %1$s has not been added to your cart because someone puchased that ticket number. Please add it to your cart again.', 'wc-lottery-pn' ), $product->get_name() ), 'error' );
					$pass = false;
				}
				if( ! empty($reserved_numbers) && ! empty($ticket_numbers) && ! empty( array_intersect( $ticket_numbers, $reserved_numbers ) ) ) {
					wc_add_notice( sprintf( __( 'Product %1$s has not been added to your cart because someone reserved that ticket number. Please add it to your cart again.', 'wc-lottery-pn' ), $product->get_name() ), 'error' );
					$pass = false;
				}
				if( ! empty($tickets_in_cart) && ! empty($ticket_numbers) && ! empty( array_intersect( $ticket_numbers, $tickets_in_cart ) ) ) {
					wc_add_notice( sprintf( __( 'Product %1$s has not been added to your cart because there is already that product with same ticket number in cart.', 'wc-lottery-pn' ), $product->get_name() ), 'error' );
					$pass = false;
				}
				if ( 'yes' === get_option('lottery_answers_reserved', 'no') ) {
					$reserved = wc_lottery_pn_get_reserved_numbers( $product_id );
					if( ! empty($reserved) && ! empty($ticket_numbers) && ! empty( array_intersect( $ticket_numbers, $reserved ) ) ) {
						wc_add_notice( sprintf( __( 'Product %1$s has not been added to your cart because someone reserved that ticket number. Please add it to your cart again.', 'wc-lottery-pn' ), $product->get_name() ), 'error' );
						$pass = false;
					}
				}

			} elseif ( empty( $_POST['lottery_tickets_number'] ) && "yes" === $random_ticket_numbers){

			}elseif (  ! is_user_logged_in() && 'yes' !== get_option( 'simple_lottery_alow_non_login', 'yes' )  ) {
				wc_add_notice(sprintf(__('Sorry, you must be logged in to participate in lottery. <a href="%s" class="button">Login &rarr;</a>', 'wc-lottery-pn'), get_permalink(wc_get_page_id('myaccount'))), 'error');
				$pass = false;
			} else{
				wc_add_notice( sprintf( esc_html__( 'Product %1$s has not been added to your cart because you have to select ticket number!', 'wc-lottery-pn' ), $product->get_name()), 'error' );
				$pass = false;
			}
		}

		if( true === $use_answers ){
			
			if( ! empty( $_REQUEST['lottery_answer'] ) ){
				$answers = maybe_unserialize( get_post_meta( $product_id, '_lottery_pn_answers', true ) );
				if ( is_array( $answers ) ){
					if ( ! array_key_exists( intval($_REQUEST['lottery_answer']), $answers) ){
						wc_add_notice( sprintf( esc_html__( 'Product %1$s has not been added to your cart because of problem with your answer!', 'wc-lottery-pn' ), $product->get_name()), 'error' );
						$pass = false;
					} 
					if( 'yes' === get_post_meta( $product_id , '_lottery_only_true_answers', true ) ){
						$true_answers = wc_lottery_pn_get_true_answers( $product_id );
						$true_answers_ids = array_keys( $true_answers );
						if ( is_array($true_answers_ids) && ! in_array($_REQUEST['lottery_answer'] , $true_answers_ids) ) {
							wc_add_notice( sprintf( esc_html__( 'Product %1$s has not been added to your cart because your answer is not correct. Please try it again!!', 'wc-lottery-pn' ), $product->get_name()), 'error' );
							$pass = false;
						}
					}
				} else {
					wc_add_notice( sprintf( esc_html__( 'Product %1$s has not been added to your cart because there is some problem with answers. Please contact us!', 'wc-lottery-pn' ), $product->get_name()), 'error' );
					$pass = false;
				}

			} elseif (  ! is_user_logged_in() && 'yes' !== get_option( 'simple_lottery_alow_non_login', 'yes' ) ) {
				wc_add_notice(sprintf(__('Sorry, you must be logged in to participate in lottery. <a href="%s" class="button">Login &rarr;</a>', 'wc-lottery-pn'), get_permalink(wc_get_page_id('myaccount'))), 'error');
				$pass = false;
			} else{
				wc_add_notice( sprintf( esc_html__( 'Product %1$s has not been added to your cart because you have to answer question!', 'wc-lottery-pn' ), $product->get_name()), 'error' );
				$pass = false;
			}

		}

		return $pass;		
	}

	/**
	 * Make reservation for ticket when adding to cart
	 *
	 */
	public function reserve_tickets( $cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data ) {

		if ( 'yes' === get_option('lottery_answers_reserved', 'no') ) {
			if ( ! is_user_logged_in() ){
				WC()->session->set( 'customer_session_key' , WC()->session->get_customer_id() );
			}
			if ( isset( $cart_item_data['lottery_tickets_number'] ) ) {
				foreach ($cart_item_data['lottery_tickets_number'] as $ticket_number) {
					$this->save_reserved_ticket( $product_id, $ticket_number, WC()->session->get_customer_id() );
				}
				$minutes = get_option('lottery_answers_reserved_minutes', '5');
				$message = sprintf( esc_html__('Ticket numbers will be reserved for %d minutes. After that someone else could reserve or buy the same ticket!' , 'wc-lottery-pn'  ), $minutes ); 
				if( ! wc_has_notice( $message, 'notice') && get_option('lottery_answers_reserved_notice', 'yes') == 'yes' ) {
					wc_add_notice( $message, 'notice');
				}
			}
		}

	}

	public function delete_ticket_reservations( $cart_item_key, $cart ) {

		if ( 'yes' === get_option('lottery_answers_reserved', 'no') ) {
			$cart_item_data = $cart->get_cart_item( $cart_item_key );
			if ( $cart_item_data ){
				if ( isset( $cart_item_data['lottery_tickets_number'] ) ){
					$product_id = $cart_item_data['product_id'];
					foreach ($cart_item_data['lottery_tickets_number'] as $ticket_number) {
						$this->delete_reserved_ticket( $product_id, $ticket_number, WC()->session->get_customer_id() );
					}
				}
			}
		}
	}
	/**
	* Save reserved ticket
	*
	* @param  int, int
	* @return void
	*
	*/
	public function save_reserved_ticket( $lottery_id, $ticket_number, $session_key ) {

		global $wpdb;

		$log = $wpdb->get_row( $wpdb->prepare( 'SELECT 1 FROM ' . $wpdb->prefix . 'wc_lottery_pn_reserved WHERE lottery_id=%d AND ticket_number=%d', $lottery_id, $ticket_number ) );
		if ( ! is_null( $log ) ) {
			return;
		}
		$log_bid = $wpdb -> insert($wpdb -> prefix . 'wc_lottery_pn_reserved', array('lottery_id' => $lottery_id, 'ticket_number' => $ticket_number, 'session_key' => $session_key ), array('%d', '%d', '%s'));

		return $log_bid;
	}
	/**
	* Delete reserved ticket
	*
	* @param  int, int
	* @return void
	*
	*/
	public function delete_reserved_ticket( $lottery_id, $ticket_number) {

		global $wpdb;

		$result = $wpdb->query( $wpdb->prepare( 'DELETE FROM '.$wpdb -> prefix .'wc_lottery_pn_reserved WHERE lottery_id = %d AND ticket_number = %d ', $lottery_id, $ticket_number ) );

		return $result;
	}

	public function remove_notification_from_order_recieved_page(){

		global $wp;

		if ( ! empty( $wp->query_vars['order-received'] ) ) {
			wc_clear_notices();
		}
	}

	public function lottery_lucky_dip(){

		$response = null;
		$guest_cart = false;

		$lottery_id = isset( $_GET['lottery_id'] ) ? intval( $_GET['lottery_id'] ) : false;
		$max_tickets_per_user = intval( get_post_meta( $lottery_id, '_max_tickets_per_user', true ) );
		$max_tickets = intval( get_post_meta( $lottery_id, '_max_tickets', true ) );

		if ( empty( $max_tickets_per_user )  || $max_tickets_per_user == $max_tickets ) {
			$guest_cart = true;
		}

		if( ! is_user_logged_in() && $guest_cart === false && 'yes' !== get_option( 'simple_lottery_alow_non_login', 'yes' )){
			$response ['status'] = 'failed';
			$response ['message'] = sprintf( __('Sorry, you must be logged in to participate in lottery. <a href="%s" class="button">Login &rarr;</a>', 'wc-lottery-pn'), get_permalink(wc_get_page_id('myaccount') ) );
			wp_send_json( $response );
			die();
		}

		if( get_post_meta( $lottery_id , '_lottery_pick_number_alphabet', true ) === 'yes' ){
			add_filter( 'ticket_number_display_html', array( $this, 'change_ticket_numbers_to_alphabet'), 10, 2 );
			add_filter( 'ticket_number_tab_display_html', array( $this, 'change_ticket_tab_to_alphabet'), 10, 2 );
		}

		$lottery_answer = isset( $_GET['lottery_answer'] ) ? intval( $_GET['lottery_answer'] ) : false;
		$qty = isset( $_GET['qty'] ) ? intval( $_GET['qty'] ) : 1;
		$use_answers        = wc_lottery_use_answers( $lottery_id );
		if ( $lottery_id ) {
			if( $use_answers ){
				if(! $lottery_answer ) {
					$response ['status'] = 'failed';
					$response ['message'] = __('Please answer the question.' , 'wc-lottery-pn');
					wp_send_json( $response );
					die();
				}

			} 
			$numbers = wc_lottery_generate_random_ticket_numbers( $lottery_id, $qty );

			if( $numbers ){

				WC()->cart->add_to_cart( $lottery_id,$qty,0, array(), array( 'lottery_tickets_number' => $numbers, 'lottery_answer' => $lottery_answer ) ) ; 
				foreach ($numbers as $key => $value) {
					$display_numbers[$key] = apply_filters( 'ticket_number_display_html' , $value, wc_get_product( $lottery_id ) );
				}

				$response['message'] =  wc_get_template_html( 'global/lucky-dip-modal.php', array( 'display_numbers' => $display_numbers, 'product_id' => $lottery_id ) );
				$response['ticket_numbers'] =  $numbers ;
				$response ['status'] = 'success';
			} else {
				$response ['status'] = 'failed';
				$response['message'] =  wc_get_template_html( 'global/lucky-dip-modal-error.php');
			}
		}
		wp_send_json( $response );
	}

	public function use_alphabet( $post_id = false ){

		add_filter( 'ticket_number_display_html', array( $this, 'change_ticket_numbers_to_alphabet'), 10, 2 );
		add_filter( 'ticket_number_tab_display_html', array( $this, 'change_ticket_tab_to_alphabet'), 10, 2 );

	}

	public function change_ticket_numbers_to_alphabet( $ticket_number, $product ){
		if( get_post_meta( $product->get_id() , '_lottery_pick_number_alphabet', true ) !== 'yes' ){
			return $ticket_number;
		}
		$_ticket_number = $ticket_number;
		if( ! $product || !$ticket_number ) {
			return $ticket_number;
		}
		$max_tickets = intval( $product->get_max_tickets() );
		$tabnumbers = get_post_meta( $product->get_id() , '_lottery_pick_number_tab_qty', true );
		$tabnumbers = $tabnumbers ? intval( $tabnumbers )  : 100;
		if ( $max_tickets > $tabnumbers * 26 ){
			$tabnumbers = ceil ( $max_tickets / 26 );
		}
		$tabnumbers == apply_filters( 'lottery_numbers_to_alphabet_number_per_letter', $tabnumbers );
		$alphabet = range('A', 'Z');
		$in =  ( intval(( $ticket_number - 1 )/$tabnumbers) );
		if($in > 0 ){
			$ticket_number = $ticket_number - ( $tabnumbers * $in );
		}
		$is_100 = $ticket_number % 100;
		if ($ticket_number === '00' &&  $is_100 === 0  ){
			$ticket_number = '100';
		}
		$ticket_number = ltrim($ticket_number, 0 );
		if( isset( $alphabet[$in] ) ){
			$ticket_number = $alphabet[$in].$ticket_number;
		} else {
			return $_ticket_number;
		}

		return apply_filters( 'change_ticket_numbers_to_alphabet' , $ticket_number, $_ticket_number, $product );
	}

	public function change_ticket_tab_to_alphabet( $tabnumbers, $product ){

		if( get_post_meta( $product->get_id() , '_lottery_pick_number_alphabet', true ) !== 'yes' ){
			return $tabnumbers;
		}

		$alphabet = range('A', 'Z');
		$tabs = get_post_meta( $product->get_id() , '_lottery_pick_number_tab_qty', true );
		$tabs = $tabs ? intval( $tabs )  : 100;
		$last_digit = substr($tabnumbers, strpos($tabnumbers, "-") + 1); 
		$in =  ( intval( $last_digit -1 ) / intval($tabs) );
		if( isset( $alphabet[$in] ) ) {
			$tabnumbers = $alphabet[$in];
		}
		return $tabnumbers;
	}

	public function change_cart_ticket_number_to_alphabet( $item_data, $cart_item ){

		// Format item data ready to display.
		foreach ( $item_data as $key => $data ) {
			if( isset( $data['key'] ) && $data['key'] === 'Ticket number' ) {
				$product = wc_get_product( $cart_item['product_id'] );
				if( get_post_meta( $cart_item['product_id'] , '_lottery_pick_number_alphabet', true ) === 'yes' ){
					$item_data[ $key ]['display'] = $this->change_ticket_numbers_to_alphabet($data['value'], $product );
				}
			}
		}
		return $item_data;
	}	

	public function change_order_ticket_number_to_alphabet( $html, $item, $args ){
		$strings = false;
		$product_id = $item->get_product_id();
		$product =  wc_get_product( $product_id );

		if( ! $product || get_post_meta( $product_id , '_lottery_pick_number_alphabet', true ) !== 'yes') {
			return $html;
		}
		foreach ( $item->get_formatted_meta_data() as $meta_id => $meta ) {
			if ( $meta->key === 'Ticket number' ){
				$value     = $args['autop'] ? wp_kses_post( $meta->display_value ) : wp_kses_post( make_clickable( $this->change_ticket_numbers_to_alphabet(intval( $meta->value ), $product )) );
				$strings[] = $args['label_before'] . wp_kses_post( $meta->display_key ) . $args['label_after'] . $value;
			} else {
				$value     = $args['autop'] ? wp_kses_post( $meta->display_value ) : wp_kses_post( make_clickable( trim( $meta->display_value ) ) );
				$strings[] = $args['label_before'] . wp_kses_post( $meta->display_key ) . $args['label_after'] . $value;
			}
		}

		if ( $strings ) {
			$html = $args['before'] . implode( $args['separator'], $strings ) . $args['after'];
		}

		return $html;
	}

	public function woocommerce_order_item_display_meta_value_aplhabet( $meta_value, $meta, $item ){

		if ( is_a($item, 'WC_Order_Item_Product') ){

			$product_id = $item->get_product_id();
			$product =  wc_get_product( $product_id );

			if( ! $product || get_post_meta( $product_id , '_lottery_pick_number_alphabet', true ) !== 'yes') {
				return $meta_value;
			}
			if ( $meta->key === 'Ticket number' ){
					$meta_value =  $this->change_ticket_numbers_to_alphabet(intval( $meta_value ), $product );
			}
		}
		return $meta_value;
	}

	public function check_ticket_numbers_before_pay_action( $order ){

		if ( $order ) {
			if ( $order_items = $order->get_items() ) {
				try {
					foreach ( $order_items as $item_id => $item ) {
						
						if ( function_exists( 'wc_get_order_item_meta' ) ){
							$item_meta = wc_get_order_item_meta( $item_id, '' );
						} else{
							$item_meta    = method_exists( $order, 'wc_get_order_item_meta' ) ? $order->wc_get_order_item_meta( $item_id ) : $order->get_item_meta( $item_id );
						}

						$product_id   = $this->get_main_wpml_product_id( $item_meta['_product_id'][0] );
						$product_data = wc_get_product( $product_id );

						if ( $product_data && $product_data->get_type() == 'lottery' ) {

							$lottery_relisted = $product_data->get_lottery_relisted();
							if( $lottery_relisted &&  $lottery_relisted > $order->get_date_created()->date( 'Y-m-d H:i:s' ) ){
								continue;
							}
							$use_ticket_numbers = get_post_meta( $product_id , '_lottery_use_pick_numbers', true );
							if( 'yes' === $use_ticket_numbers  ){
								$available_tickets= wc_lotery_get_available_ticket( $product_id );
								$ticket_numbers = isset( $item_meta[ __( 'Ticket number', 'wc-lottery-pn' ) ] ) ? $item_meta[ __( 'Ticket number', 'wc-lottery-pn' ) ] : '';
								foreach ($ticket_numbers as $key => $value) {
									if (! in_array($value, $available_tickets) || empty( $ticket_numbers ) ){
										throw new Exception( __( 'Invalid ticket number.', 'wc-lottery-pn' ) );
									}
								}
							}
						}
					}
				} catch ( Exception $e ) {
					wc_add_notice( $e->getMessage(), 'error' );
				}				
			}
		}			
	}
	 /**
	 * Get main product id for multilanguage purpose
	 *
	 * @access public
	 * @return int
	 *
	 */
	function get_main_wpml_product_id( $id ) {

		return intval( apply_filters( 'wpml_object_id', $id, 'product', false, apply_filters( 'wpml_default_language', null ) ) );

	}

	public function reduce_quantity_input_max_for_reserved_tickets( $qty, $product ){
		if( $product->get_type( ) === 'lottery') {
			$reserved = wc_lottery_pn_get_reserved_numbers( $product->get_id() );
			$reserved_per_user = wc_lottery_pn_get_reserved_numbers( $product->get_id() , WC()->session->get_customer_id(), 'view', true );
			$max_tickets_per_user = $product->get_max_tickets_per_user() ? intval( $product->get_max_tickets_per_user() ): false;
			if ( $max_tickets_per_user ) {
				$available_quantity = $product->get_stock_quantity() - count( $reserved );

				if ( $available_quantity < $max_tickets_per_user ){

					$qty =  $available_quantity - count( $reserved_per_user ) >  0 ? $available_quantity - count( $reserved_per_user ) : 0;
				}

			} else {
				$qty = $qty - count( $reserved );
			}

		}
		return $qty;
	}

	public function remove_reserved_from_max_purchase_quantity( $qty, $product ){
		if ( 'yes' === get_post_meta( $product->get_id() , '_lottery_pick_numbers_random', true ) ){
			$reserved = wc_lottery_pn_get_reserved_numbers( $product->get_id() );
			$reserved_per_user = wc_lottery_pn_get_reserved_numbers( $product->get_id() , WC()->session->get_customer_id(), 'view', true );
			$available_quantity = $product->get_stock_quantity() - count( $reserved );
			return $qty - count( $reserved_per_user );
		}

		return $qty;

	}

	public function add_wrong_answer_notice_in_emails( $item_id, $item, $order, $plain_text ){

		if( get_option( 'lottery_wrong_answers_email_notice', 'yes' ) !== 'yes' ){
			return;
		}
		
		$product = $item->get_product();

		if($product && $product->get_type() === 'lottery' && wc_lottery_use_answers( $product->get_id() ) ){
			foreach ( $item->get_formatted_meta_data() as $meta_id => $meta ) {
				if( $meta->display_key == __( 'Answer', 'wc-lottery-pn' ) ){
					$true_answers = wc_lottery_pn_get_true_answers( $product->get_id() );
					$answers_ids  = array_keys( $true_answers );
					if(! in_array($meta->value, $answers_ids) ){
						$message = '<div class="wc-item-meta wrong-answer" style="font-size: small; margin: 1em 0 0; padding: 0;" >';
						$message .= wp_kses_post(  __('Your answer is not correct. In order to participate you will need to select right answer, pick your ticket(s) and checkout again.', 'wc-lottery-pn' ) );
						$message .= '</div>';

						$html = apply_filters( 'wrong_answer_display_item_meta', $message, $item );
						if ( 'yes' === get_option( 'lottery_remove_ticket_wrong_answer' , 'no' ) ) {
							add_filter( 'woocommerce_display_item_meta', array($this, 'remove_ticket_numbers_from_display_item_meta' ), 10, 3 );
						}
						echo $html; // WPCS: XSS ok.
					} else { 
						remove_filter( 'woocommerce_display_item_meta', array($this, 'remove_ticket_numbers_from_display_item_meta' ), 10, 3 );
					}
				}
			}

		}
	}

	public function add_instant_in_order( $item_id, $item, $order, $plain_text ){


		$product = $item->get_product();

		if ( ! $product || 'yes' !== get_post_meta( $product->get_id(), '_lottery_instant_win', true ) ){
			return;
		}

		foreach ( $item->get_formatted_meta_data() as $meta_id => $meta ) {
			$ticket_prize = array();
			$lottery_instant_instant_winners = get_post_meta( $product->get_id(), '_lottery_instant_instant_winners');
			if ( ! empty ( $lottery_instant_instant_winners ) ){
				$ticket_prize = array();
				foreach ($lottery_instant_instant_winners as $key => $winner) {
					$ticket_prize[ $winner[ 'ticket' ] ] = $winner['prize'];
				}
			}

			 if ( $meta->display_key == __( 'Ticket number', 'wc-lottery-pn' ) ){

			 	if ( array_key_exists( $meta->value, $ticket_prize ) ){
			 		$message = '<div class="wc-item-meta instant-winn" style="font-size: small; margin: 1em 0 0; padding: 0;" >';
					$message .= wp_kses_post(  printf( __('Congratulations. You have won "%s" with ticket number %s as instant prize.', 'wc-lottery-pn' ), $ticket_prize[ $meta->value ], $meta->value  ) );
					$message .= '</div>';
			 	}

			}
		}

	}

	public function remove_ticket_numbers_from_display_item_meta( $html, $item, $args ){
		return '';
	}

	public function sync_seesion_key($user_login, $user){

		if ( 'yes' === get_option('lottery_answers_reserved', 'no') ) {

			global $wpdb;
			$customer_session_key = WC()->session->get( 'customer_session_key');
			if( $customer_session_key ){
				$wpdb -> update($wpdb -> prefix . 'wc_lottery_pn_reserved', array('session_key' =>$user->ID ), array('session_key' => $customer_session_key ) );
			}
		}

	}

	public function sync_session_key_register($user_id){

		if( is_admin() ) return;

		if ( 'yes' === get_option('lottery_answers_reserved', 'no') ) {
			global $wpdb;
			if( WC()->session ){
				$customer_session_key = WC()->session->get( 'customer_session_key');
				if( $customer_session_key ){
					$wpdb -> update($wpdb -> prefix . 'wc_lottery_pn_reserved', array('session_key' =>$user_id ), array('session_key' => $customer_session_key ) );
				}
			}
		}
	}

	// Go to Settings -> Permalinks and save permalinks
	public function woocommerce_lottery_my_tickets_mytickets_endpoint() {
		add_rewrite_endpoint( 'comp-tickets', EP_ROOT | EP_PAGES );
	}

	public function woocommerce_lottery_my_tickets_mytickets_past_endpoint() {
		add_rewrite_endpoint( 'comp-tickets-past', EP_ROOT | EP_PAGES );
	}

	public function woocommerce_lottery_my_tickets_endpoint_content() {

		global $wpdb;

		$current_user_id = get_current_user_id();
		$postids = woocommerce_lottery_get_user_lotteries();
		$posts_ids = array();

		if ( count($postids)>0 ) {
			// Return active user's lottery products.
			$args = array(
				'fields' => 'ids',
				'post_type'=> 'product',
				'post__in' => $postids,
				'show_past_lottery' => FALSE,
				'is_lottery_archive' => TRUE,
				'tax_query' => array(array('taxonomy' => 'product_type' , 'field' => 'slug', 'terms' => 'lottery')),
			);     
			$the_query  = new WP_Query( apply_filters( 'woocommerce_lottery_my_tickets_endpoint_query_args' , $args, $postids, $current_user_id  ) );
			$posts_ids = $the_query->posts;
		}

		wc_get_template( 'myaccount/active-tickets.php', array( 'posts_ids' => $posts_ids) );
	}

	public function woocommerce_lottery_my_tickets_past_endpoint_content() {

		global $wpdb;

		$current_user_id = get_current_user_id();
		$postids = woocommerce_lottery_get_user_lotteries();
		$posts_ids = array();
		if ( count($postids)>0 ) {
			// Return past user's lottery products.
			$args = array(
				'fields' => 'ids',
				'post_type'=> 'product',
				'post__in' => $postids,
				'show_past_lottery' => TRUE,
				'is_lottery_archive' => TRUE,
				'meta_query' => array(
					array(
							'key' => '_lottery_closed',
							'operator' => 'EXISTS',
						),
					),
			);          
			$the_query  = new WP_Query( apply_filters( 'woocommerce_lottery_my_tickets_past_endpoint_query_args' , $args, $postids, $current_user_id  )  );
			$posts_ids = $the_query->posts;
		}
		wc_get_template( 'myaccount/past-tickets.php', array( 'posts_ids' => $posts_ids) );
	}

	function add_my_account_menu_items( $items ) {

		$ordered_items = array();

		$subscription_item = array( 'comp-tickets' => esc_html__( 'My Tickets', 'wc-lottery-pn' ) );
		unset( $items['comp-tickets'] );
		$items = array_merge( $subscription_item, $items );

		return $items;
	}
	/**
	* Add new query var.
	*
	* @param array $vars
	* @return array
	*/
	public function add_query_vars( $vars ) {

		$vars['comp-tickets'] = 'comp-tickets';
		$vars['comp-tickets-past'] = 'comp-tickets-past';
		return $vars;
	}
	/**
	* Add new colums to enty list table
	*
	* @param array $columns
	* @return array
	*/
	public function add_woocommerce_lottery_entry_list_columns( $columns ) {

		global $product;

		if ( get_post_meta( $product->get_id(), '_lottery_use_pick_numbers', false ) ){
			$columns['ticket_number'] = __('Ticket number', 'wc-lottery-pn');
		}
		if ( wc_lottery_use_answers( $product->get_id() ) ){
			$columns['answer_id'] = __('Answer', 'wc-lottery-pn');
		}
	
		return $columns;

	}

	public function add_woocommerce_lottery_entry_list_column_default( $value, $item, $column_name ) {

		global $product;

		if( $column_name == 'answer_id' ){
			$answers = maybe_unserialize( get_post_meta( $product->get_id(), '_lottery_pn_answers', true ) );
			$answer = isset( $answers[$value] ) ? $answers[$value] : false;
			if ( is_array($answers) ){
				$value =  esc_html( $answer['text'] );
			} else {
				$value = "";
			}
		}
		if( $column_name == 'ticket_number' ){
			return apply_filters( 'ticket_number_display_html' , $value, $product );
		}
		return $value;
	}
	/**
	* Mod query for entry list table
	*
	* @param array $columns
	* @return array
	*/
	public function mod_woocommerce_lottery_entry_list_query( $query, $orderby, $order ){

		global $wpdb, $_wp_column_headers, $wp, $product;

		$current_url      = esc_attr( add_query_arg( $wp->query_string, '', home_url( $wp->request ) ) );


		/* -- Preparing your query -- */
		$query = '
			SELECT * FROM ' . $wpdb->prefix . 'wc_lottery_log 
			LEFT JOIN ' . $wpdb->prefix . 'wc_lottery_pn_log ON ' . $wpdb->prefix . 'wc_lottery_log.id = ' . $wpdb->prefix . 'wc_lottery_pn_log.log_id
			LEFT JOIN ' . $wpdb->users . ' ON ' . $wpdb->prefix . 'wc_lottery_log.userid = ' . $wpdb->users . '.id  
			LEFT JOIN ' . $wpdb->posts . ' ON ' . $wpdb->prefix . 'wc_lottery_log.lottery_id = ' . $wpdb->posts . '.ID 
			WHERE ' . $wpdb->prefix . 'wc_lottery_log.lottery_id ='. $product->get_id();
			if ( ! empty( $orderby ) & ! empty( $order ) ) {
				$orderby_query = apply_filters( 'woocommerce_lottery_entry_list_query_orderby', ' ORDER BY ' . $orderby . ' ' . $order, $orderby, $order );
				$query .= $orderby_query;
			}

		return $query;
	}

	/**
	 * Cron action
	 *
	 * Checks for a valid request, check lottery and closes lottery if is finished
	 *
	 * @access public
	 * @param bool $url (default: false)
	 * @return void
	 *
	 */
	function simple_lottery_pn_cron( $url = false ) {

		if ( empty( $_REQUEST['lottery-relist'] ) ) {
			return;
		}



		if ( $_REQUEST['lottery-relist'] == 'true' ) {
			
			update_option( 'Wc_lottery_cron_relist', 'yes' );
			set_time_limit( 0 );
			ignore_user_abort( 1 );

			$args = array(
				'post_type'          => 'product',
				'posts_per_page'     => '200',
				'tax_query'          => array(
					array(
						'taxonomy' => 'product_type',
						'field'    => 'slug',
						'terms'    => 'lottery',
					),
				),
				'meta_query'         => array(
					'relation' => 'AND',

					array(
						'key'     => '_lottery_closed',
						'compare' => 'EXISTS',
					),
					array(
						'key'   => '_lottery_automatic_relist',
						'value' => 'yes',
					),
				),
				'lottery_archive'     => true,
				'is_lottery_archive' => true,
				'show_past_lottery' => true,
				'show_future_lottery' => true,
				'cache_results'  => false,
				'fields'             => 'ids',
			);

			$the_query = new WP_Query( $args );
			$posts_ids = $the_query->posts;
			if ( is_array( $posts_ids ) ) {
				foreach ( $posts_ids as $post_id ) {
					Wc_Lottery_Pn_Admin::automatic_relist_lottery( $post_id );
				}
			}
		}// end if relist
	exit;
	}

}