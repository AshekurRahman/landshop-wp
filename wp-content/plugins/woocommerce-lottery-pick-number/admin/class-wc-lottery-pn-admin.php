<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://wpgenie.org
 * @since      1.0.0
 *
 * @package    Wc_Lottery_Pn
 * @subpackage Wc_Lottery_Pn/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wc_Lottery_Pn
 * @subpackage Wc_Lottery_Pn/admin
 * @author     wpgenie <info@wpgenie.org>
 */
class Wc_Lottery_Pn_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles($hook) {

		global $post_type;
		if ( $hook == 'post-new.php' || $hook == 'post.php' || $hook == 'woocommerce_page_wc-settings') {
			if ( 'product' == get_post_type() || $hook == 'woocommerce_page_wc-settings') {
				wp_enqueue_style( 'DataTables', plugin_dir_url( __FILE__ ) . 'js/DataTables/datatables.min.css', array() );
				wp_enqueue_style( 'DataTables-buttons', plugin_dir_url( __FILE__ ) . 'js/DataTables/buttons.dataTables.min.css', array() );
				
				wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wc-lottery-pn-admin.css', array(), $this->version, 'all' );
			}
		}

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts($hook) {

		global $post_type;

		if ( $hook == 'post-new.php' || $hook == 'post.php' || $hook == 'woocommerce_page_wc-settings') {
			if ( 'product' == get_post_type() || $hook == 'woocommerce_page_wc-settings') {
				$params = array(
					'add_lottery_answer_nonce'  => wp_create_nonce( 'add_lottery_answer_nonce' ),
					'save_lottery_answer_nonce' => wp_create_nonce( 'save_lottery_answer_nonce' ),
					'remove_wcsbs'              => __( 'Remove this answer?', 'wc-lottery-pn' ),
					'remove_wcsbs_instant'      => __( 'Remove this instant winner?', 'wc-lottery-pn' ),
					'datatable_language' => array(
					           "sEmptyTable"=>     __("No data available in table", 'wc-lottery-pn' ),
					           "sInfo"=>           __("Showing _START_ to _END_ of _TOTAL_ entries", 'wc-lottery-pn' ),
					           "sInfoEmpty"=>      __("Showing 0 to 0 of 0 entries", 'wc-lottery-pn' ),
					           "sInfoFiltered"=>   __("(filtered from _MAX_ total entries)", 'wc-lottery-pn' ),
					           "sLengthMenu"=>     __("Show _MENU_ entries", 'wc-lottery-pn' ),
					           "sLoadingRecords"=> __("Loading...", 'wc-lottery-pn' ),
					           "sProcessing"=>     __("Processing...", 'wc-lottery-pn' ),
					           "sSearch"=>         __("Search:", 'wc-lottery-pn' ),
					           "sZeroRecords"=>    __("No matching records found", 'wc-lottery-pn' ),
					           "oPaginate"=> array(
					               "sFirst"=>    __("First", 'wc-lottery-pn' ),
					               "sLast"=>     __("Last", 'wc-lottery-pn' ),
					               "sNext"=>     __("Next", 'wc-lottery-pn' ),
					               "sPrevious"=> __("Previous", 'wc-lottery-pn' )
					           ),
					           "oAria"=> array(
					               "sSortAscending"=>  __(": activate to sort column ascending", 'wc-lottery-pn' ),
					               "sSortDescending"=> __(": activate to sort column descending", 'wc-lottery-pn' )
					           )
					        )
				);
				wp_enqueue_script( 'DataTables', plugin_dir_url( __FILE__ ) . 'js/DataTables/datatables.min.js', array( 'jquery' ), false );
				wp_enqueue_script( 'DataTables-buttons', plugin_dir_url( __FILE__ ) . 'js/DataTables/dataTables.buttons.min.js', array( 'jquery', 'DataTables' ), false );
				wp_enqueue_script( 'jszip', plugin_dir_url( __FILE__ ) . 'js/DataTables/jszip.min.js', array( 'jquery', 'DataTables', 'DataTables-buttons' ), false );
				wp_enqueue_script( 'buttons.html5', plugin_dir_url( __FILE__ ) . 'js/DataTables/buttons.html5.min.js', array( 'jquery', 'DataTables', 'DataTables-buttons' ), false );
				wp_enqueue_script( 'buttons.colVis', plugin_dir_url( __FILE__ ) . 'js/DataTables/buttons.colVis.min.js', array( 'jquery', 'DataTables', 'DataTables-buttons' ), false );
				
				wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wc-lottery-pn-admin.js', array( 'jquery', 'DataTables' ), $this->version, false );
				wp_localize_script( $this->plugin_name, 'woocommerce_lottery_pn', $params );
			}
		}

	}
	public function add_ticket_numbers_to_order_items( $item, $cart_item_key, $values, $order ) {
		$product                    = $values['data'];
		if( 'yes' === get_post_meta( $product->get_id() , '_lottery_pick_numbers_random', true ) ){
			$values['lottery_tickets_number'] = wc_lottery_generate_random_ticket_numbers( $product->get_id(), $values['quantity'] );
			if( $values['lottery_tickets_number'] == false ) {
				throw new Exception( sprintf( __( 'You cannot add that amount of &quot;%1$s&quot; to the cart because there is not enough stock (%2$s remaining).', 'woocommerce' ), $product->get_name(), wc_format_stock_quantity_for_display( $product->get_stock_quantity(), $product ) ) );
			}
		}
		if ( empty( $values['lottery_tickets_number'] ) ) {
				return;
		}

		foreach ( $values['lottery_tickets_number'] as $key => $ticket_number ) {
			$item->add_meta_data( __( 'Ticket number', 'wc-lottery-pn' ), $ticket_number );
		}
		

	}


	public function add_ticket_answer_to_order_items( $item, $cart_item_key, $values, $order ) {
		if ( empty( $values['lottery_answer'] ) ) {
				return;
		}
		$item->add_meta_data( __( 'Answer', 'wc-lottery-pn' ), $values['lottery_answer'] );

	}

	public function lottery_pn_order( $product_id, $user_id, $order_id, $log_ids, $item, $item_id ) {
		global $wpdb;

		$order          = wc_get_order( $order_id );
		$item_meta      = function_exists( 'wc_get_order_item_meta' ) ? wc_get_order_item_meta( $item_id, '' ) : $order->get_item_meta( $item_id );
		$ticket_numbers = isset( $item_meta[ __( 'Ticket number', 'wc-lottery-pn' ) ] ) ? $item_meta[ __( 'Ticket number', 'wc-lottery-pn' ) ] : '';
		$answer         = isset( $item_meta[ __( 'Answer', 'wc-lottery-pn' ) ] ) ? intval( $item_meta[ __( 'Answer', 'wc-lottery-pn' ) ][0] ) : '';
		$use_ticket_numbers = get_post_meta( $product_id, '_lottery_use_pick_numbers', true );

		if( $use_ticket_numbers === 'yes' ) {
			$duplicate_tickets = $this->check_if_tickets_exist( $product_id, $ticket_numbers );
			if( ! empty( $duplicate_tickets ) ){
				$order->update_status( 'on-hold', __( 'Order is on-hold because of duplicate ticket number.', 'wc-lottery-pn' ) );
				do_action('woocommerce_lottery_duplicate_ticket_in_order_found', $order, $duplicate_tickets );
				throw new Exception( __('Duplicate ticket number in order', 'wc-lottery-pn') );
				return;
			}
			$this->log_participant_extra_info( $log_ids, $order_id, $product_id, $ticket_numbers, $answer );
		} else {
			$this->log_participant_extra_info( $log_ids, $order_id, $product_id, null, $answer );
		}
		do_action('woocommerce_after_adding_extar_info', $ticket_numbers, $product_id, $user_id, $order_id, $log_ids, $item, $item_id);

	}

	public function lottery_pn_order_canceled( $product_id, $user_id, $order_id, $log_ids, $item, $item_id ) {
		if ( $order_id ) {
			$this->del_lottery_extra_logs_by_order_id( $order_id );
		}

	}
	public function lottery_pn_ajax_delete_entry( $product_id, $log_id) {
		if ( $log_id ) {
			$this->delete_log_participant_extra_info( $log_id );
		}

	}

	/**
	* Log bid
	*
	* @param  int, int
	* @return void
	*
	*/
	public function log_participant_extra_info( $log_ids, $order_id, $product_id, $ticket_numbers, $answer_id ) {

		global $wpdb;
		$values = array();
		$place_holders = array();

		$query = "INSERT " . $wpdb->prefix . "wc_lottery_pn_log (log_id, order_id, ticket_number, answer_id, lottery_id ) VALUES ";


		for ( $i = 0; $i < count($log_ids); ) {
			if( ! empty ( $ticket_numbers ) && is_array( $ticket_numbers )  ){
				array_push( $values, $log_ids[$i], $order_id, $ticket_numbers[$i] , $answer_id, $product_id );
			} else {
				array_push( $values, $log_ids[$i], $order_id, $ticket_numbers , $answer_id, $product_id );
			}
			$place_holders[] = "('%d', '%d', %d , %d, %d)";
			$i++;
		}
		$query .= implode( ', ', $place_holders );
		$results = $wpdb->query( $wpdb->prepare( $query, $values ) );
		return $log_ids;

	}

	/**
	* Delete single log by log id
	*
	* @param  int, int
	* @return void
	*
	*/
	public function delete_log_participant_extra_info( $log_id ) {

		global $wpdb;

		$result = $wpdb->query( $wpdb->prepare( 'DELETE FROM ' . $wpdb->prefix . 'wc_lottery_pn_log WHERE log_id = %d', $log_id ) );
		return $result;
	}

	/**
	* Delete extra log
	*
	* @param  int, int
	* @return void
	*
	*/
	public function del_lottery_extra_logs( $post_id ) {

		global $wpdb;

		$wpdb->query( $wpdb->prepare( 'DELETE FROM ' . $wpdb->prefix . 'wc_lottery_pn_reserved WHERE lottery_id = %d', $post_id ) );

		$wpdb->query( $wpdb->prepare( 'DELETE FROM ' . $wpdb->prefix . 'wc_lottery_pn_log WHERE lottery_id = %d', $post_id ) );

	}

	/**
	* Delete extra log by order id
	*
	* @param  int, int
	* @return void
	*
	*/
	public function del_lottery_extra_logs_by_order_id( $order_id ) {

		global $wpdb;

		$result = $wpdb->query( $wpdb->prepare( 'DELETE FROM ' . $wpdb->prefix . 'wc_lottery_pn_log WHERE order_id = %d', $order_id ) );

		return $result;
	}

	/**
	 * Adds the panel to the Product Data postbox in the product interface
	 *
	 * @return void
	 *
	 */
	public function add_extra_product_write_panel() {
		global $post;
		$product = wc_get_product( $post->ID );

		woocommerce_wp_checkbox(
			array(
				'id'            => '_lottery_use_pick_numbers',
				'wrapper_class' => '',
				'label'         => __( 'Allow ticket numbers?', 'wc-lottery-pn' ),
				'description'   => __( 'Allow customer to pick ticket number(s) ', 'wc-lottery-pn' ),
				'desc_tip'      => 'true',
			)
		);
		woocommerce_wp_checkbox(
			array(
				'id'            => '_lottery_pick_number_alphabet',
				'wrapper_class' => '',
				'label'         => __( 'Use alphabet?', 'wc-lottery-pn' ),
			)
		);
		woocommerce_wp_checkbox(
			array(
				'id'            => '_lottery_pick_numbers_random',
				'wrapper_class' => '',
				'label'         => __( 'Randomly assign ticket number(s) without ticket number picking', 'wc-lottery-pn' ),
				'description'   => __( 'Customer gets random assing ticket number', 'wc-lottery-pn' ),
				'desc_tip'      => 'false',
			)
		);
		woocommerce_wp_checkbox(
			array(
				'id'            => '_lottery_pick_number_use_tabs',
				'wrapper_class' => '',
				'label'         => __( 'Sort tickets in tabs?', 'wc-lottery-pn' ),
			)
		);
		
		woocommerce_wp_text_input(
			array(
				'id'                => '_lottery_pick_number_tab_qty',
				'class'             => 'input_text',
				'size'              => '6',
				'label'         => __( 'Number of tickets per tab', 'wc-lottery-pn' ),
				'type'              => 'number',
				'custom_attributes' => array(
					'step' => '1',
					'min'  => '0',
				),
			)
		);
		woocommerce_wp_checkbox(
			array(
				'id'            => '_lottery_manualy_winners',
				'wrapper_class' => '',
				'label'         => __( 'Manual winner picking', 'wc-lottery-pn' ),
				'description'   => __( 'Pick winners manually when lottery has finished.', 'wc-lottery-pn' ),
				'desc_tip'      => 'true',
			)
		);
		echo '<div id="wc_lotery_instant-tb" >';
		woocommerce_wp_checkbox(
			array(
				'id'            => '_lottery_instant_win',
				'wrapper_class' => '',
				'label'         => __( 'Instant winner', 'wc-lottery-pn' ),
				'description'   => __( 'Instant prizes. Only works when customer is alowed to pick ticket number(s).', 'wc-lottery-pn' ),
				'desc_tip'      => 'true',
			)
		);
		$instant_winner_class = 'hidden';
		if ( is_object($product) && 'lottery' === $product->get_type() && 'yes' === get_post_meta( $post->ID, '_lottery_instant_win', true ) ) {
			$instant_winner_class = '';
		}

		$type = get_post_meta( $post->ID, '_lottery_pick_number_alphabet', true ) == 'yes' ? 'text' : 'number';
		echo '<div class="instant_winners">';

		$instant_ticket_numbers_prizes = maybe_unserialize( get_post_meta( $post->ID, '_lottery_instant_ticket_numbers_prizes', true ) );

		// Output All instant prizes
		if ( ! empty( $instant_ticket_numbers_prizes ) ) {

			foreach ($instant_ticket_numbers_prizes as $ticket_numbers_prizes => $ticket_number_prize) {

				$metabox_class = array();

				include(  plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/html-product-lottery-instant-winners.php');;
			}
		}




		echo '</div>';

		echo'<div class="toolbar ' . $instant_winner_class . '">
				<button type="button" class="button add_lottery_instant_winner">';
			_e( "Add new", "wc-lottery-pn" );
			echo'</button>
			</div><div class="clear"></div>';

		woocommerce_wp_checkbox(
			array(
				'id'            => '_lottery_instant_win_main_competition',
				'wrapper_class' => $instant_winner_class,
				'label'         => __( 'Instant winners can participate in main prize(s)', 'wc-lottery-pn' ),
				'description'   => __( '', 'wc-lottery-pn' ),
				'desc_tip'      => 'true',

			)
		);
		echo '</div>';
		woocommerce_wp_checkbox(
			array(
				'id'            => '_lottery_use_answers',
				'wrapper_class' => '',
				'label'         => __( 'Force user to answer a question?', 'wc-lottery-pn' ),
				'description'   => __( 'Force user to answer a question before adding lottery number to cart', 'wc-lottery-pn' ),
				'desc_tip'      => 'true',
			)
		);
		woocommerce_wp_checkbox(
			array(
				'id'            => '_lottery_only_true_answers',
				'wrapper_class' => '',
				'label'         => __( 'Only alow true answers.', 'wc-lottery-pn' ),
				'description'   => __( 'Only alow users to pick correct answers', 'wc-lottery-pn' ),
				'desc_tip'      => 'true',
			)
		);
		include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/html-meta-box-answers.php';
		if ( is_object($product) && 'lottery' === $product->get_type() && '2' === $product->get_lottery_closed() && 'yes' === get_post_meta( $post->ID, '_lottery_manualy_winners', true ) ) {
			$lottery_num_winners = intval( $product->get_lottery_num_winners() );
			$i                   = 1;
			echo '<p>';
			echo '<h3>' . esc_html__( 'Manual winner picking' ) . '</h3>';
			while ( $i <= $lottery_num_winners ) {
				$type = get_post_meta( $post->ID, '_lottery_pick_number_alphabet', true ) == 'yes' ? 'text' : 'number';
				woocommerce_wp_text_input(
					array(
						'id'                => '_lottery_manualy_winner_' . $i,
						'wrapper_class'     => '',
						'description'       => sprintf( __( 'Enter number of winning ticket. Fom 1-%d', 'wc-lottery-pn' ), $product->get_max_tickets() ),
						'label'             => __( 'Winning ticket', 'wc_lottery' ),
						'type'              => $type,
						'custom_attributes' => array(
							'step' => '1',
							'min'  => '1',
							'max'  => $product->get_max_tickets(),
						),
						'desc_tip'          => 'false',
					)
				);

				$i++;

			}
			echo '</p>';
			echo '<p>';
			woocommerce_wp_textarea_input(
				array(
					'id'            => '_lottery_manualy_pick_text',
					'wrapper_class' => '',
					'label'         => __( 'Manual pick text', 'wc-lottery-pn' ),
					'description'   => __( 'Some text explaining how mmanual winner picking is done.', 'wc-lottery-pn' ),
					'desc_tip'      => 'true',
				)
			);
			echo '</p>';
		}

	}
	/**
	 * Saves the data inputed into the product boxes, as post meta data
	 *
	 *
	 * @param int $post_id the post (product) identifier
	 * @param stdClass $post the post (product)
	 *
	 */
	public function product_save_data( $post_id, $post ) {

		if ( ! current_user_can( 'edit_products' ) ) {
			return;
		}
				$product_type = empty( $_POST['product-type'] ) ? 'simple' : sanitize_title( wc_clean( $_POST['product-type'] ) );

		$product = wc_get_product( $post_id );

		if ( $product_type == 'lottery' ) {

			if ( isset( $_POST['_lottery_use_pick_numbers'] ) && ! empty( $_POST['_lottery_use_pick_numbers'] ) ) {
				update_post_meta( $post_id, '_lottery_use_pick_numbers', 'yes' );
			} else {
				update_post_meta( $post_id, '_lottery_use_pick_numbers', 'no' );
			}

			if ( isset( $_POST['_lottery_pick_numbers_random'] ) && ! empty( $_POST['_lottery_pick_numbers_random'] ) &&  ( isset( $_POST['_lottery_use_pick_numbers'] ) && ! empty( $_POST['_lottery_use_pick_numbers'] ) ) ) {
				update_post_meta( $post_id, '_lottery_pick_numbers_random', 'yes' );
			} else {
				update_post_meta( $post_id, '_lottery_pick_numbers_random', 'no' );
			}

			if ( isset( $_POST['_lottery_pick_number_use_tabs'] ) && ! empty( $_POST['_lottery_pick_number_use_tabs'] ) ) {
				update_post_meta( $post_id, '_lottery_pick_number_use_tabs', 'yes' );
			} else {
				update_post_meta( $post_id, '_lottery_pick_number_use_tabs', 'no' );
			}
			if ( isset( $_POST['_lottery_pick_number_alphabet'] ) && ! empty( $_POST['_lottery_pick_number_alphabet'] ) ) {
				update_post_meta( $post_id, '_lottery_pick_number_alphabet', 'yes' );
			} else {
				update_post_meta( $post_id, '_lottery_pick_number_alphabet', 'no' );
			}
			if ( isset( $_POST['_lottery_pick_number_tab_qty'] ) ) {
				update_post_meta( $post_id, '_lottery_pick_number_tab_qty', intval( $_POST['_lottery_pick_number_tab_qty'] ) );
			} else{
				delete_post_meta( $post_id, '_lottery_pick_number_tab_qty' );
			}
			if ( isset( $_POST['_lottery_use_answers'] ) && ! empty( $_POST['_lottery_use_answers'] ) ) {
				update_post_meta( $post_id, '_lottery_use_answers', 'yes' );
			} else {
				update_post_meta( $post_id, '_lottery_use_answers', 'no' );
			}
			if ( isset( $_POST['_lottery_manualy_winners'] ) && ! empty( $_POST['_lottery_manualy_winners'] ) ) {
				update_post_meta( $post_id, '_lottery_manualy_winners', 'yes' );
			} else {
				update_post_meta( $post_id, '_lottery_manualy_winners', 'no' );
			}
			if ( isset( $_POST['_lottery_instant_win'] ) && ! empty( $_POST['_lottery_instant_win'] ) ) {
				update_post_meta( $post_id, '_lottery_instant_win', 'yes' );
			} else {
				update_post_meta( $post_id, '_lottery_instant_win', 'no' );
			}
			if ( isset( $_POST['_lottery_pick_numbers_random'] ) && ! empty( $_POST['_lottery_pick_numbers_random'] ) ) {
				update_post_meta( $post_id, '_lottery_pick_numbers_random', 'yes' );
			} else {
				update_post_meta( $post_id, '_lottery_pick_numbers_random', 'no' );
			}
			if ( isset( $_POST['_lottery_only_true_answers'] ) && ! empty( $_POST['_lottery_only_true_answers'] ) ) {
				update_post_meta( $post_id, '_lottery_only_true_answers', 'yes' );
			} else {
				update_post_meta( $post_id, '_lottery_only_true_answers', 'no' );
			}

			if ( 'yes' === get_post_meta( $post_id, '_lottery_manualy_winners', true ) && $product->is_closed() ) {

				$old_lotery_winners = get_post_meta( $post_id, '_lottery_winners' );

				delete_post_meta( $post_id, '_lottery_winners' );
				$winners             = array();
				$pn_winners          = array();
				$lottery_num_winners = isset( $_POST['_lottery_num_winners'] ) ? intval( $_POST['_lottery_num_winners'] ) : 1;

				$i = 1;
				while ( $i <= $lottery_num_winners ) {
					if ( isset( $_POST[ '_lottery_manualy_winner_' . $i ] ) && ( ! empty( $_POST['_lottery_manualy_winner_'. $i ] ) || $_POST['_lottery_manualy_winner_'. $i ] === '0' ) ) {
						if( get_post_meta( $post->ID, '_lottery_pick_number_alphabet', true ) == 'yes' ) {
							update_post_meta( $post_id, '_lottery_manualy_winner_' . $i,  $_POST[ '_lottery_manualy_winner_' . $i ] );
							$int_winner = lottery_get_int_number_from_alphabet( $_POST[ '_lottery_manualy_winner_' . $i ], $product);
							update_post_meta( $post_id, '_lottery_manualy_winner_int' . $i,  $int_winner );
							if ( isset( $_POST['_lottery_use_pick_numbers'] ) && ! empty( $_POST['_lottery_use_pick_numbers'] ) ) {
								$winners[ $i ]     = $this->get_user_id_by_ticket_number( intval( $int_winner ), $post_id );
								$pn_winners [ $i ] = $this->get_log_by_ticket_number( intval( $int_winner ), $post_id );

							} else {
								$participants  = apply_filters( 'woocommerce_lottery_participants', $product->get_lottery_participants(), $post_id, $product );
								$participants  = array_combine ( range( 1, count( $participants ) ), $participants );
								$winners[ $i ] = $participants[ intval( $int_winner ) ];
							}
						} else {
							update_post_meta( $post_id, '_lottery_manualy_winner_' . $i, intval( $_POST[ '_lottery_manualy_winner_' . $i ] ) );
							if ( isset( $_POST['_lottery_use_pick_numbers'] ) && ! empty( $_POST['_lottery_use_pick_numbers'] ) ) {
								$winners[ $i ]     = $this->get_user_id_by_ticket_number( intval( $_POST[ '_lottery_manualy_winner_' . $i ] ), $post_id );
								$pn_winners [ $i ] = $this->get_log_by_ticket_number( intval( $_POST[ '_lottery_manualy_winner_' . $i ] ), $post_id );

							} else {
								$participants  = apply_filters( 'woocommerce_lottery_participants',$product->get_lottery_participants(), $post_id, $product );
								$participants  = array_combine ( range( 1, count( $participants ) ), $participants );
								$winners[ $i ] = $participants[ intval( $_POST[ '_lottery_manualy_winner_' . $i ] ) ];
							}
						}
					}
					$i++;
				}
				
				update_post_meta( $post_id, '_lottery_pn_winners', $pn_winners );
				foreach ( $winners as $key => $userid ) {
					add_post_meta( $post_id, '_lottery_winners', $userid );
					add_user_meta( $userid, '_lottery_win', $post_id );
					add_user_meta( $userid, '_lottery_win_' . $post_id . '_position', $key );
				}

				if ( $old_lotery_winners !== get_post_meta( $post_id, '_lottery_winners' ) ) {
					do_action('wc_lottery_close', $post_id);
					do_action('wc_lottery_won', $post_id);
				}

				if ( isset( $_POST['_lottery_manualy_pick_text'] ) && ! empty( $_POST['_lottery_manualy_pick_text'] ) ) {
					update_post_meta( $post_id, '_lottery_manualy_pick_text', $_POST['_lottery_manualy_pick_text'] );
				} else {
					delete_post_meta( $post_id, '_lottery_manualy_pick_text' );
				}
				

			}



			if ( isset( $_POST['_lottery_automatic_relist'] ) ) {
				update_post_meta( $post_id, '_lottery_automatic_relist', stripslashes( $_POST['_lottery_automatic_relist'] ) );
			} else {
				update_post_meta( $post_id, '_lottery_automatic_relist', 'no' );
			}
			if ( isset( $_POST['_lottery_automatic_relist_fail'] ) ) {
				update_post_meta( $post_id, '_lottery_automatic_relist_fail', stripslashes( $_POST['_lottery_automatic_relist_fail'] ) );
			}else {
				update_post_meta( $post_id, '_lottery_automatic_relist_fail', 'no' );
			}
			if ( isset( $_POST['_lottery_automatic_relist_save'] ) ) {
				update_post_meta( $post_id, '_lottery_automatic_relist_save', stripslashes( $_POST['_lottery_automatic_relist_save'] ) );
			}else {
				update_post_meta( $post_id, '_lottery_automatic_relist_save', 'no' );
			}
			if ( isset( $_POST['_lottery_relist_time'] ) ) {
				update_post_meta( $post_id, '_lottery_relist_time', stripslashes( $_POST['_lottery_relist_time'] ) );
			}
			if ( isset( $_POST['_lottery_relist_duration'] ) ) {
				update_post_meta( $post_id, '_lottery_relist_duration', stripslashes( $_POST['_lottery_relist_duration'] ) );
			}

			// Save Instant winners
			$instant_ticket_numbers_prizes = array();


			if ( isset( $_POST['_lottery_instant_win'] ) ) {
				$lottery_instant_winner = isset( $_POST['lottery_instant_ticket'] ) ? wc_clean( $_POST['lottery_instant_ticket'] ) : array();
				$lottery_instant_prize = isset( $_POST['lottery_instant_prize'] ) ? wc_clean( $_POST['lottery_instant_prize'] ) : array();

				foreach ( $lottery_instant_winner as $key => $ticket ) {
					if ( ! empty( $ticket ) ) {
						$instant_ticket_numbers_prizes[ $key ]['ticket'] = $ticket;
						$instant_ticket_numbers_prizes[ $key ]['prize'] = isset( $lottery_instant_prize[ $key ] ) ? $lottery_instant_prize[ $key ] : '';
					}
				}
			}

			if ( isset( $_POST['_lottery_instant_win_main_competition'] ) ) {
				update_post_meta( $post_id, '_lottery_instant_win_main_competition', stripslashes( $_POST['_lottery_instant_win_main_competition'] ) );
			}else {
				update_post_meta( $post_id, '_lottery_instant_win_main_competition', 'no' );
			}


			update_post_meta( $post_id, '_lottery_instant_ticket_numbers_prizes', $instant_ticket_numbers_prizes );
		}
	}
	/**
	 * Add answer(s) via ajax.
	 * 
	 */
	public function ajax_add_answer_line() {

		ob_start();

		check_ajax_referer( 'add_lottery_answer_nonce', 'security' );

		if ( ! current_user_can( 'edit_products' ) ) {
			die( -1 );
		}

		$thepostid     = 0;
		$answer_key    = absint( $_POST['key'] );
		$position      = 0;
		$metabox_class = array();
		$answer        = array(
			'text' => '',
			'true' => 0,
		);

		include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/html-product-lottery-answers.php';
		die();

	}
	/**
	 * Save discounts via ajax.
	 * 
	 */
	public static function save_answers( $post_id, $post ) {

		if ( ! current_user_can( 'edit_products' ) ) {
			return;
		}

		// Save Attributes
		$answers = array();

		$lottery_question = isset( $_POST['_lottery_question'] ) ? wp_kses_post( $_POST['_lottery_question'] ) : '';
		update_post_meta( $post_id, '_lottery_question', $lottery_question );

		if ( isset( $_POST['lottery_answer'] ) ) {

			$post_answers = isset( $_POST['lottery_answer'] ) ? wc_clean( $_POST['lottery_answer'] ) : array();
			$answers_true = isset( $_POST['lottery_answer_true'] ) ? wc_clean( $_POST['lottery_answer_true'] ) : array();

			foreach ( $post_answers as $key => $answer ) {
				if ( ! empty( $answer ) ) {
					$answers[ $key ]['text'] = $answer;
					$answers[ $key ]['true'] = isset( $answers_true[ $key ] ) ? 1 : 0;
				}
			}
		}

		update_post_meta( $post_id, '_lottery_pn_answers', $answers );

	}
	/**
	 * Get lottery participants.
	 * 
	 */	
	public function get_lottery_participants( $paricipants, $product_id, $product ) {
		global $wpdb;

		$wheredatefrom = '';

		$use_ticket_numbers = get_post_meta( $product_id, '_lottery_use_pick_numbers', true );

		if ( wc_lottery_use_answers( $product_id ) ) {

			$true_answers = wc_lottery_pn_get_true_answers( $product_id );
			$answers_ids  = array_keys( $true_answers );

			if ( $true_answers ) {
				$ids                = join( ',', $answers_ids );
				$true_answers_query = " AND answer_id IN ('" . $ids . "') ";
			}

			$relisteddate = get_post_meta( $product_id, '_lottery_relisted', true );

			if ( $relisteddate ) {
				$wheredatefrom = " AND CAST(date AS DATETIME) > '$relisteddate' ";
			}

			$paricipants = $wpdb->get_results( 'SELECT userid,ticket_number,answer_id, ' . $wpdb->prefix . 'wc_lottery_pn_log.log_id FROM ' . $wpdb->prefix . 'wc_lottery_log LEFT JOIN ' . $wpdb->prefix . 'wc_lottery_pn_log ON ' . $wpdb->prefix . 'wc_lottery_log.id = ' . $wpdb->prefix . 'wc_lottery_pn_log.log_id WHERE ' . $wpdb->prefix . 'wc_lottery_pn_log.lottery_id =' . $product_id . $wheredatefrom . $true_answers_query, ARRAY_A );

		} elseif ( 'yes' === $use_ticket_numbers ) {

			$paricipants = $wpdb->get_results( 'SELECT userid,ticket_number, ' . $wpdb->prefix . 'wc_lottery_pn_log.log_id , answer_id FROM ' . $wpdb->prefix . 'wc_lottery_log LEFT JOIN ' . $wpdb->prefix . 'wc_lottery_pn_log ON ' . $wpdb->prefix . 'wc_lottery_log.id = ' . $wpdb->prefix . 'wc_lottery_pn_log.log_id  WHERE ' . $wpdb->prefix . 'wc_lottery_pn_log.lottery_id =' . $product_id . $wheredatefrom, ARRAY_A );

		}
		return apply_filters( 'woocommerce_lottery_get_lottery_participants' , $paricipants, $product_id, $product );

	}
	/**
	 * Get lottery winners.
	 * 
	 */
	public function get_lottery_winners( $winners, $product_id, $product ) {

		$use_ticket_numbers = get_post_meta( $product_id, '_lottery_use_pick_numbers', true );
		$pn_winners         = false;

		if ( 'yes' === get_post_meta( $product_id, '_lottery_manualy_winners', true ) ) {
			return array();
		}

		if ( wc_lottery_use_answers( $product_id ) ) {
			$paricipants = $this->get_lottery_participants( '', $product_id, $product );

			if ( $paricipants ) {
				$pn_winners = $this->pick_lottery_winers_from_array( $paricipants, $product );
			}
		} elseif ( 'yes' === $use_ticket_numbers ) {
			$paricipants = $this->get_lottery_participants( '', $product_id, $product );
			if ( $paricipants ) {
				$pn_winners = $this->pick_lottery_winers_from_array( $paricipants, $product );
			}
		}
		if ( ! empty( $pn_winners ) ) {
			$winners = array_column( $pn_winners, 'userid' );

		}
		if ( $pn_winners ) {
			update_post_meta( $product_id, '_lottery_pn_winners', $pn_winners );
		}

		return $winners;

	}
	/**
	 * Pick lottery winners from array.
	 * 
	 */
	public function pick_lottery_winers_from_array( $participants, $product ) {

		$winners = array();
		if ( is_array( $participants ) ) {
			$i                   = 0;
			$lottery_num_winners = $product->get_lottery_num_winners() ? $product->get_lottery_num_winners() : 1;

			while ( $i <= ( $lottery_num_winners - 1 ) ) {
				$winner_id         = '';
				$winners_key[ $i ] = mt_rand( 0, count( $participants ) - 1 );
				$winners[]         = $participants[ $winners_key[ $i ] ];
				$winner_id         = $participants[ $winners_key[ $i ] ]['userid'];
				if ( $product->get_lottery_multiple_winner_per_user() == 'yes' ) {
					unset( $participants[ $winners_key[ $i ] ] );
				} else {
					foreach ( $participants as $key => $participant ) {
						if ( $participant['userid'] == $winner_id ) {
							unset( $participants[ $key ] );
						}
					}
				}
				
				$participants = array_values( $participants );
				$i++;
				 if ( count( $participants ) <= 0 ) {
				 	break;
				 }
			}
		}
		return $winners;
	}
	/**
	 * Lottery pick numbers specific settings.
	 * 
	 */
	public function custom_woocommerce_lottery_settings( $settings ) {


		$settings[] = array(
			'title' => __( 'Lottery pick number and answer', 'wc-lottery-pn' ),
			'type'  => 'title',
			'id'    => 'lottery_pn',
		);
		$settings[] = array(
			'title'   => __( 'Show answers in history tab', 'wc-lottery-pn' ),
			'type'    => 'checkbox',
			'id'      => 'lottery_answers_in_history',
			'default' => 'yes',
		);
		$settings[] = array(
			'title'   => __( 'Show answers in history only when lottery is finished', 'wc-lottery-pn' ),
			'type'    => 'checkbox',
			'id'      => 'lottery_answers_in_history_finished',
			'default' => 'no',
		);
		$settings[] = array(
			'title'   => __( 'Reserve ticket number when user puts it in cart', 'wc-lottery-pn' ),
			'type'    => 'checkbox',
			'id'      => 'lottery_answers_reserved',
			'default' => 'no',
		);
		$settings[] = array(
			'title'   => __( 'Hold reserve tickets for n minutes', 'wc-lottery-pn' ),
			'type'    => 'number',
			'id'      => 'lottery_answers_reserved_minutes',
			'default' => '5',
		);
		$settings[] = array(
			'title'   => __( 'Show notice for reserving tickets', 'wc-lottery-pn' ),
			'type'    => 'checkbox',
			'id'      => 'lottery_answers_reserved_notice',
			'default' => 'yes',
		);
		$settings[] = array(
			'title'   => __( 'Remove ticket numbers from orders with wrong answer.', 'wc-lottery-pn' ),
			'type'    => 'checkbox',
			'id'      => 'lottery_remove_ticket_wrong_answer',
			'default' => 'no',
		);
		$settings[] = array(
			'title'   => __( 'Show lucky dip button', 'wc-lottery-pn' ),
			'type'    => 'checkbox',
			'id'      => 'lottery_use_lucky_dip',
			'default' => 'no',
		);
		$settings[] = array(
			'title'   => __( 'Use qty with lucky dip button', 'wc-lottery-pn' ),
			'type'    => 'checkbox',
			'id'      => 'lottery_use_lucky_dip_qty',
			'default' => 'no',
		);
		$settings[] = array(
			'title'   => __( 'Use dropdown for answers', 'wc-lottery-pn' ),
			'type'    => 'checkbox',
			'id'      => 'lottery_use_dropdown_answers',
			'default' => 'no',
		);
		$settings[] = array(
			'title'   => __( 'Show notice for wrong answer in user order email', 'wc-lottery-pn' ),
			'type'    => 'checkbox',
			'id'      => 'lottery_wrong_answers_email_notice',
			'default' => 'yes',
		);
		$settings[] = array(
			'title'   => __( 'Show My Tickets in My Account menu', 'wc-lottery-pn' ),
			'type'    => 'checkbox',
			'id'      => 'lottery_show_my_tickets',
			'default' => 'yes',
		);		
		$settings[] = array(
			'type' => 'sectionend',
			'id'   => 'lottery_pn',
		);
		
		return $settings;

	}
	/**
	 * Get user ID from ticket number.
	 * 
	 */
	public function get_user_id_by_ticket_number( $ticket_number, $product_id ) {
		global $wpdb;

		$user_id = $wpdb->get_var( $wpdb->prepare( 'SELECT userid FROM ' . $wpdb->prefix . 'wc_lottery_log LEFT JOIN ' . $wpdb->prefix . 'wc_lottery_pn_log ON ' . $wpdb->prefix . 'wc_lottery_log.id = ' . $wpdb->prefix . 'wc_lottery_pn_log.log_id    WHERE ' . $wpdb->prefix . 'wc_lottery_log.lottery_id = %d AND ' . $wpdb->prefix . 'wc_lottery_pn_log.ticket_number = %d', $product_id, $ticket_number ) );

		return intval( $user_id );
	}
	/**
	 * Get log from ticker number.
	 * 
	 */
	public function get_log_by_ticket_number( $ticket_number, $product_id ) {
		global $wpdb;

		$log = $wpdb->get_row( $wpdb->prepare( 'SELECT * FROM ' . $wpdb->prefix . 'wc_lottery_log LEFT JOIN ' . $wpdb->prefix . 'wc_lottery_pn_log ON ' . $wpdb->prefix . 'wc_lottery_log.id = ' . $wpdb->prefix . 'wc_lottery_pn_log.log_id    WHERE ' . $wpdb->prefix . 'wc_lottery_log.lottery_id = %d AND ' . $wpdb->prefix . 'wc_lottery_pn_log.ticket_number = %d', $product_id, $ticket_number ), ARRAY_A );

		return $log;
	}
	/**
	 * Remove lottery metaboxes.
	 * 
	 */
	public function remove_lottery_metaboxes(){
		remove_meta_box( 'Lottery', 'product', 'normal' );
	}
	/**
	 * Add meta box to the product editing screen.
	 *
	 * @access public
	 *
	 */
	function woocommerce_simple_lottery_meta() {

		global $post;

		$product_data = wc_get_product( $post->ID );
		if ( $product_data ) {
			$product_data_type = method_exists( $product_data, 'get_type' ) ? $product_data->get_type() : $product_data->product_type;
			if ( $product_data_type == 'lottery' ) {
				add_meta_box( 'Lottery-pn', __( 'Lottery', 'wc_lottery' ), array( $this, 'woocommerce_simple_lottery_meta_callback' ), 'product', 'normal', 'default' );
			}
		}

	}

	/**
	 *  Callback for adding a meta box to the product editing screen used in woocommerce_simple_lottery_meta
	 *
	 * @access public
	 *
	 */
	function woocommerce_simple_lottery_meta_callback() {

		global $post;
		$colspan =7;
		$product_data    = wc_get_product( $post->ID );
		$lottery_winers  = get_post_meta( $post->ID, '_lottery_winners' );
		$lottery_pn_winers  = get_post_meta($post->ID, '_lottery_pn_winners',true);
		$order_hold_on   = get_post_meta( $post->ID, '_order_hold_on' );
		$use_answers 	 = wc_lottery_use_answers( $post->ID );
		$use_ticket_numbers = get_post_meta( $post->ID , '_lottery_use_pick_numbers', true );
		$answers = maybe_unserialize( get_post_meta( $post->ID, '_lottery_pn_answers', true ) );

		if ( $order_hold_on ) {
			$orders_links_on_hold = '';
			echo '<p>';
			_e( 'Some on hold orders are preventing this lottery to end. Can you please check it! ', 'wc_lottery' );
			foreach ( array_unique( $order_hold_on ) as $key => $order_hold_on_id ) {
				$orders_links_on_hold .= "<a href='" . admin_url( 'post.php?post=' . $order_hold_on_id . '&action=edit' ) . "'>$order_hold_on_id</a>, ";
			}
			echo rtrim( $orders_links_on_hold, ', ' );
			echo "<form><input type='hidden' name='clear_on_hold_orders' value='1'>";
			echo " <br><button class='button button-primary clear_orders_on_hold' data-product_id='" . $product_data->get_id() . "'>" . __( 'Clear all on hold orders! ', 'wc_lottery' ) . '</button>';
			echo '</form>';
			echo '</p>';
		}

		if ( is_object($product_data) ) $lottery_relisted = $product_data->get_lottery_relisted();

		if ( ! empty( $lottery_relisted ) ) {
		?>
		<p><?php esc_html_e( 'Lottery has been relisted on:', 'wc_lottery' ); ?> <?php echo date_i18n( get_option( 'date_format' ), strtotime( $lottery_relisted )).' '.date_i18n( get_option( 'time_format' ), strtotime( $lottery_relisted )); ?></p>
		
		<?php
		}

		if ( ( $product_data->is_closed() === true ) and ( $product_data->is_started() === true ) ) : ?>
			<p><?php _e( 'Lottery has finished', 'wc_lottery' ); ?></p>
			<?php
			if ( $product_data->get_lottery_fail_reason() == '1' ) {
				echo '<p>';
					_e( 'Lottery failed because there were no participants', 'wc_lottery' );
					echo '</p>';
			} elseif ( $product_data->get_lottery_fail_reason() == '2' ) {
				echo '<p>';
				_e( 'Lottery failed because there was not enough participants', 'wc_lottery' );
				echo " <button class='button button-primary do-api-refund' href='#' id='lottery-refund' data-product_id='" . $product_data->get_id() . "'>";
				_e( 'Refund ', 'wc_lottery' );
				echo '</button>';
				echo '<div id="refund-status"></div>';
				echo '<//p>';
			}
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
							if ( $winner ) {
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

			<?php } ?>

			<?php } ?>

		<?php endif; ?>

		<?php if ( 'yes' === get_post_meta( $post->ID, '_lottery_instant_win', true ) ){

			$lottery_instant_instant_winners = get_post_meta( $post->ID, '_lottery_instant_instant_winners');
			$prizes = wc_lottery_get_instant_winning_prizes( $post->ID );
			printf( _n( "This lottery has %d instant prize" , "This lottery has %d instant prizes", count( $prizes ) , 'wc_lottery' ) , count( $prizes ) ) ;
			echo '<ol class="lottery-instant-winners">';

        		if ( $lottery_instant_instant_winners ){
					foreach ($lottery_instant_instant_winners as $key => $winner) {
						echo "<li>";
                		esc_html_e(  $winner['prize'] );
                		echo ' - <span><a href=' . get_edit_user_link( $winner['user_id'] ) . '>' . get_userdata( $winner['user_id'] )->display_name .'</a></span>';
                		echo "</li>";

					}
				}

			echo '</ol>';

		}
		?>
		<?php 
		if ( get_option( 'simple_lottery_history_admin', 'yes' ) == 'yes' ) : 
			$lottery_history = apply_filters( 'woocommerce__lottery_history_data', $product_data->lottery_history() );
			$heading         = esc_html( apply_filters( 'woocommerce_lottery_history_heading', __( 'Lottery History', 'wc_lottery' ) ) );
		?>
			<h2 class="old_lottery_data"><?php echo $heading; ?> pick number</h2>
			<table class="lottery-table">
				<thead>
					<tr>
						<th><?php _e( 'Date', 'wc_lottery' ); ?></th>
						<th><?php _e( 'User', 'wc_lottery' ); ?></th>
						<th><?php _e( 'Email', 'wc_lottery' ); ?></th>
						<th><?php _e( 'First name', 'wc_lottery' ); ?></th>
						<th><?php _e( 'Last name', 'wc_lottery' ); ?></th>
						<th><?php _e( 'Address', 'wc_lottery' ); ?></th>
						<th><?php _e( 'Phone', 'wc_lottery' ); ?></th>
						<?php if ($use_ticket_numbers === 'yes' ) : $colspan++;?>
							<th class="numbers"><?php _e('Ticket number', 'wc-lottery-pn') ?></th>
						<?php endif; ?>
						<?php if ($use_answers === true) : $colspan++;?>
							<th class="answer"><?php _e('Answer', 'wc-lottery-pn') ?></th>
						<?php endif; ?>
						<th><?php _e( 'Order', 'wc_lottery' ); ?></th>
						<th class="actions"><?php _e( 'Actions', 'wc_lottery' ); ?></th>
					</tr>
				</thead>

				<?php
				if ( $lottery_history ) :
					foreach ( $lottery_history as $history_value ) {

						if ( $history_value->date < $product_data->get_lottery_relisted() && ! isset( $displayed_relist ) ) {
							echo '<tfoot>';
							echo '<tr>';
							echo '<td class="date">' . date_i18n( get_option( 'date_format' ), strtotime( $product_data->get_lottery_dates_from() )).' '.date_i18n( get_option( 'time_format' ), strtotime( $product_data->get_lottery_dates_from() )) . '</td>';
							echo '<td colspan="'. $colspan . '"  class="relist">';
							echo __( 'Lottery relisted', 'wc_lottery' );
							echo '</td>';
							echo '</tr>';
							echo '</tfoot>';
							echo '</table>';
							$displayed_relist = true;?>
							<h2 class="old_lottery_data"><?php _e( 'Lottery Data Prior Relist', 'wc-lottery-pn' ); ?> </h2>
							<table class="lottery-table">
								<thead>
									<tr>
										<th><?php _e( 'Date', 'wc_lottery' ); ?></th>
										<th><?php _e( 'User', 'wc_lottery' ); ?></th>
										<th><?php _e( 'Email', 'wc_lottery' ); ?></th>
										<th><?php _e( 'First name', 'wc_lottery' ); ?></th>
										<th><?php _e( 'Last name', 'wc_lottery' ); ?></th>
										<th><?php _e( 'Address', 'wc_lottery' ); ?></th>
										<th><?php _e( 'Phone', 'wc_lottery' ); ?></th>
										<?php if ($use_ticket_numbers === 'yes' ) :?>
											<th class="numbers"><?php _e('Ticket number', 'wc-lottery-pn') ?></th>
										<?php endif; ?>
										<?php if ($use_answers === true) :?>
											<th class="answer"><?php _e('Answer', 'wc-lottery-pn') ?></th>
										<?php endif; ?>
										<th><?php _e( 'Order', 'wc_lottery' ); ?></th>
										<th class="actions"><?php _e( 'Actions', 'wc_lottery' ); ?></th>
									</tr>
								</thead>

						<?php }
						echo '<tr>';
						echo '<td class="date">' . date_i18n( get_option( 'date_format' ), strtotime( $history_value->date )).' '.date_i18n( get_option( 'time_format' ), strtotime( $history_value->date )) . '</td>';
						$order = wc_get_order( $history_value->orderid );
						$user_data = get_userdata( $history_value->userid );
						echo "<td class='username'><a href='" . get_edit_user_link( $history_value->userid ) . "'>". ( $user_data ? $user_data->display_name : '' ). '</a></td>';
						echo "<td class='email'>" . ( $order ? $order->get_billing_email() : '' ) . '</td>';
						echo "<td class='firstname'>" .  ( $order ? $order->get_billing_first_name(): '' ) . '</td>';
						echo "<td class='lastname'>" .  ( $order ? $order->get_billing_last_name() : '' ). '</td>';
						echo "<td class='addres'>" .  ( $order ? $order->get_formatted_billing_address() : '' ). '</td>';
						echo "<td class='phone'>" .  ( $order ? $order->get_billing_phone() : '' ). '</td>';
						if ($use_ticket_numbers === 'yes' ) {
							echo "<td class='ticket_number'>". apply_filters( 'ticket_number_display_html' ,$history_value->ticket_number, $product_data) . "</td>";
						}						
						if ( $use_answers === true ){
							
							$answer = isset( $answers[$history_value->answer_id] ) ? $answers[$history_value->answer_id] : false;

							echo "<td class='answer'>";

							if ( is_array($answer) ){
								echo esc_html( $answer['text'] );
							} else {
								echo "";
							}
					
							echo "</td>";
						}
						echo "<td class='orderid'><a href='" . admin_url( 'post.php?post=' . $history_value->orderid . '&action=edit' ) . "'>" . $history_value->orderid . '</a></td>';
						echo "<td class='action'> <a href='#' data-id='" . $history_value->id . "' data-postid='" . $post->ID . "'    >" . __( 'Delete', 'wc_lottery' ) . '</a></td>';
						echo '</tr>';
					}
				endif;
				?>
				<tfoot>
					<tr class="start">
						<?php

							echo '<td class="date">' . date_i18n( get_option( 'date_format' ), strtotime( $product_data->get_lottery_dates_from() )).' '.date_i18n( get_option( 'time_format' ), strtotime( $product_data->get_lottery_dates_from() )) . '</td>';

						if ( $product_data->is_started() === true ) {				
							echo '<td colspan="' . $colspan . '" class="started">';
							echo apply_filters( 'lottery_history_started_text', __( 'Lottery started', 'wc_lottery' ), $product_data );
							echo '</td>';

						} else {
							echo '<td colspan="' . $colspan . '" class="starting">';
							echo apply_filters( 'lottery_history_starting_text', __( 'Lottery starting', 'wc_lottery' ), $product_data );
							echo '</td>';
						}
						?>
					</tr>
				</tfoot>
			</table>
		<?php endif; ?>
		</ul>
		<?php
		$history_lottery_csv_files = get_post_meta($post->ID, '_history_lottery_csv_files');
		if ( $history_lottery_csv_files ){
			$upload_dir = wp_upload_dir();
			?>
			<h2 class="history_lottery_csv_files"><?php  _e( 'Exported csv files', 'wc_lottery' ) ?></h2>
			<table class="lottery-files-table" width="100%">
				<thead>
					<tr>
						<th><?php _e( 'Date', 'wc_lottery' ); ?></th>
						<th><?php _e( 'File', 'wc_lottery' ); ?></th>
						<th><?php _e( 'Winners', 'wc_lottery' ); ?></th>
						<th class="actions"><?php _e( 'Actions', 'wc_lottery' ); ?></th>
					</tr>
				</thead>
				<?php
				foreach ( $history_lottery_csv_files as $key => $file ) {
					if( is_array( $file[3] ) ){
						foreach ($file[3] as $winner) {
							$winner_string = get_userdata($winner['userid'])->display_name.', ';
							    if( $use_ticket_numbers === 'yes'){
							    	$winner_string .= "<span class='ticket-number'>";
							    	$winner_string .= esc_html__( 'Ticket number: ', 'wc-lottery-pn' );
							    	$winner_string .= apply_filters( 'ticket_number_display_html' , $winner['ticket_number'], $product_data ) ;
							    	$winner_string .= " </span>";
							    }
							    if( $use_answers === true ){
							    	$winner_string .= "<span class='ticket-answer'>";
							    	$winner_string .=esc_html__( 'Answer: ', 'wc-lottery-pn' );
							    	$answer = isset( $answers[$winner['answer_id']]['text'] ) ? $answers[$winner['answer_id']]['text'] : '';
							    	$winner_string .= $answer;
							    	$winner_string .= "</span>";
								}
							echo "<br/>";
						}
					}
					echo '<tr>'; 
					echo '<td class="date">' . date_i18n( get_option( 'date_format' ), intval( $file[2] ) ).' '.date_i18n( get_option( 'time_format' ), intval( $file[2] ) ) . '</td>';
					echo '<td class="path"><a href="' . $upload_dir['baseurl'] . $file[0] .' "> '. esc_html( $file[1] ) .'</td>';
					echo '<td class="path">'. $winner_string .'</td>';
					echo '<td class="action"> <a href="#"" data-id = "' . intval( $key ) . '" data-file="' . esc_attr( $file[1] ) . '" data-postid="' . $post->ID . '" >' . __( 'Delete', 'wc_lottery' ) . '</a></td>';
					echo '</tr>';
				}?>
			</table>


		<?php }
	}
	/**
	 * Relist  lottery
	 *
	 * @access public
	 * @param int, string, string
	 * @return void
	 *
	 */
	function do_relist( $post_id, $relist_from, $relist_to ) {

		delete_post_meta( $post_id, '_lottery_pn_winners' );
		delete_post_meta( $post_id, '_lottery_instant_instant_winners' );

		$lottery_num_winners = isset( $_POST['_lottery_num_winners'] ) ? intval( $_POST['_lottery_num_winners'] ) : 1;
		$i = 1;
		while ( $i <= $lottery_num_winners ) {
			delete_post_meta( $post_id, '_lottery_manualy_winner_'. $i );
			$i++;
		}

	}

	public function remove_participants_if_wrong_answer( $data, $item , $order, $product_id ){
		$ticket_numbers = array();
		$true_answer = true;

		if( 'yes' !== get_option( 'lottery_remove_ticket_wrong_answer' , 'no' ) ){
			return $data;
		}

		$meta = $item->get_formatted_meta_data();

		if ( $meta ){
			foreach ($meta as $key => $value) {

				if(	$value->key == __( 'Ticket number', 'wc-lottery-pn' ) ){
					$ticket_numbers[] = $value->value;
				}
				if(	$value->key == __( 'Answer', 'wc-lottery-pn' ) ){
					$true_answers = wc_lottery_pn_get_true_answers( $product_id );
					$answers_ids  = array_keys( $true_answers );
					$true_answer = in_array($value->value, $answers_ids); 
				}
			}
			if ( ! $true_answer ){
				if( ! empty( $ticket_numbers ) ){
					global $wpdb;
					$how_many = count($ticket_numbers);
					$placeholders = array_fill(0, $how_many, '%d');
					$format = implode(', ', $placeholders);
					$prepare_vars = $ticket_numbers;
					array_unshift ($prepare_vars, $product_id);
					$wpdb->query( $wpdb->prepare( 'DELETE FROM ' . $wpdb->prefix . 'wc_lottery_pn_reserved WHERE lottery_id = %d AND ticket_number IN('. $format. ') ', $prepare_vars ) );
					if ( get_post_meta( $product_id, '_max_tickets', true ) ) {
						if ( get_post_meta( $product_id, '_lottery_participants_count', true ) ) {
							update_post_meta( $product_id, '_stock', intval( get_post_meta( $product_id, '_max_tickets', true ) ) - intval( get_post_meta( $product_id, '_lottery_participants_count', true ) ) );
						} else {
							update_post_meta( $product_id, '_stock', wc_clean( get_post_meta( $product_id, '_max_tickets', true ) ) );
						}
					}
				}
				
			}
			do_action( 'remove_participants_if_wrong_answer' ,$true_answer, $ticket_numbers, $order , $product_id);
			return $true_answer;
		}
		return $data;
	}


	public function check_for_duplicate_tickets_in_order ($order_id, $data  ){
		$error = false;
		$tickets = array();
		$order = new WC_Order( $order_id );
		if ( $order ) {
			if ( $order_items = $order->get_items() ) {
				foreach ( $order_items as $item_id => $item ) {
					$product_id   = $this->get_main_wpml_product_id(  $item->get_product_id() );
					$product_data = wc_get_product( $product_id );
					if ( $product_data && $product_data->get_type() == 'lottery' ) {
						$item_meta      = function_exists( 'wc_get_order_item_meta' ) ? wc_get_order_item_meta( $item_id, '' ) : $order->get_item_meta( $item_id );
						$ticket_numbers = isset( $item_meta[ __( 'Ticket number', 'wc-lottery-pn' ) ] ) ? $item_meta[ __( 'Ticket number', 'wc-lottery-pn' ) ] : array();
						$session_key = WC()->session->get_customer_id();
						$reserved_numbers = wc_lottery_pn_get_reserved_numbers($product_id, $session_key, 'edit');
						if ( is_array($ticket_numbers ) ){
							if ( ! empty( array_intersect($ticket_numbers, wc_lottery_pn_get_taken_numbers($product_id ) ) ) ) {
							$error = true;
							$message= __( 'Order cancelled because of duplicate ticket number.', 'wc-lottery-pn' );
							}
							if ( ! empty( array_intersect($ticket_numbers, $reserved_numbers) ) ) {
							$error = true;
							$message= __( 'Order cancelled because someone has reserved that ticket number.', 'wc-lottery-pn' );
							}
						}

						if( !isset( $tickets[$product_id] ) ){
							$tickets[$product_id] = $ticket_numbers;
						} else{
							$tickets[$product_id] = array_merge($tickets[$product_id], $ticket_numbers) ;
						}
					}
				}
			}
		}

		if( $tickets ){
			foreach ($tickets as $product_id => $value) {
				if(count(array_unique($value))<count($value)) {
					$error = true;
				} 
				if( $error == false ){
					wc_lottery_reserve_ticket( $product_id, $value, WC()->session->get_customer_id() );
				}
			}
		}

		if( $error === true  ){ 
			$order->update_status( 'cancelled', $message );
			throw new Exception( $message  );
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

	function filter_duplicate_ticket_in_order( $data, $item , $order_id, $product_id ){
		global $wpdb;
		$tickets = array();
		$order          = wc_get_order( $order_id );
		$meta = $item->get_formatted_meta_data();

		if ( get_post_meta( $product_id, '_lottery_use_pick_numbers', true ) !== 'yes' ){
			return $data;
		}
		if ( $meta ){
			foreach ($meta as $key => $value) {
				if(	$value->key == __( 'Ticket number', 'wc-lottery-pn' ) ){
					$tickets[] = $value->value;
					
				}

			}
		}
		if( ! empty( $tickets ) ){
			$duplicat_ticket = $this->check_if_tickets_exist($product_id, $tickets );
			if( $duplicat_ticket ){
				$order->update_status( 'on-hold', __( 'Order is on-hold because of duplicate ticket number.', 'wc-lottery-pn' ) );
				do_action('woocommerce_lottery_duplicate_ticket_in_order_found', $order, $duplicat_ticket );
				throw new Exception( __('Duplicate ticket number in order', 'wc-lottery-pn') );
			}
		}
		return $data;
	}


	public function check_if_tickets_exist($lotery_id, $tickets ){
		global $wpdb;

		if( empty( $tickets ) ){
			return false;
		}

		$tickets_count = count($tickets);
		$stringPlaceholders = array_fill(0, $tickets_count, "%d");

		$placeholders_ticket = implode(", ", $stringPlaceholders);
		$values =  array_merge($tickets, array( $lotery_id ) );
		$results = $wpdb->get_col( $wpdb->prepare( "SELECT ticket_number FROM " . $wpdb->prefix . "wc_lottery_pn_log WHERE `ticket_number` IN ( $placeholders_ticket ) and lottery_id= %d", $values ) );
		
		return $results;
	}

	/**
	 *  Add lottery relist meta box to the product editing screen
	 *
	 * @access public
	 *
	 */
	public function automatic_relist_meta_boxes() {

		add_meta_box( 'Automatic_relist_lottery', esc_html__( 'Automatic relist lottery', 'wc-lottery-pn' ), array( $this, 'automatic_relist_meta_boxes_callback' ), 'product', 'normal' );

	}
	/**
	 *  Callback for adding a meta box to the product editing screen used for automatic relist
	 *
	 * @access public
	 *
	 */
	public function automatic_relist_meta_boxes_callback() {

		global $post;

		$product_data = wc_get_product( $post->ID );
		$heading      = esc_html( apply_filters( 'woocommerce_lottery_history_heading', esc_html__( 'Lottery automatic relist', 'wc-lottery-pn' ) ) );

		echo '<div class="woocommerce_options_panel ">';
		woocommerce_wp_checkbox(
			array(
				'id'            => '_lottery_automatic_relist',
				'wrapper_class' => '',
				'label'         => esc_html__( 'Automatic relist lottery', 'wc-lottery-pn' ),
				'description'   => esc_html__(
					'Enable automatic relisting',
					'wc-lottery-pn'
				),
			)
		);
		woocommerce_wp_checkbox(
			array(
				'id'            => '_lottery_automatic_relist_fail',
				'wrapper_class' => '',
				'label'         => esc_html__( 'Relist lottery only if failed', 'wc-lottery-pn' ),
				'description'   => esc_html__(
					'Relist lottery only if failed',
					'wc-lottery-pn'
				),
			)
		);
		woocommerce_wp_checkbox(
			array(
				'id'            => '_lottery_automatic_relist_save',
				'wrapper_class' => '',
				'label'         => esc_html__( 'Save lottery participants to csv file for export', 'wc-lottery-pn' ),
				'description'   => esc_html__(
					'Save lottery participants to csv file for export',
					'wc-lottery-pn'
				),
			)
		);
		woocommerce_wp_text_input(
			array(
				'id'                => '_lottery_relist_time',
				'class'             => 'wc_input_price short',
				'label'             => esc_html__( 'Relist after n hours', 'wc-lottery-pn' ),
				'type'              => 'number',
				'custom_attributes' => array(
					'step' => 'any',
					'min'  => '0',
				),
			)
		);

		woocommerce_wp_text_input(
			array(
				'id'                => '_lottery_relist_duration',
				'class'             => 'wc_input_price short',
				'label'             => esc_html__( 'Relist lottery duration in h', 'wc-lottery-pn' ),
				'type'              => 'number',
				'custom_attributes' => array(
					'step' => 'any',
					'min'  => '0',
				),
			)
		);

		echo '</div>';
	}

	/**
	 * Get all lotteries that need to be relisted depending on parameter set
	 *
	 * @param int
	 * @return void
	 *
	 */
	public static function automatic_relist_lottery( $post_id ) {

		$product                       = wc_get_product( $post_id );
		$lottery_relist_duration       = get_post_meta( $post_id, '_lottery_relist_duration', true );
		$lottery_automatic_relist      = get_post_meta( $post_id, '_lottery_automatic_relist', true );
		$lottery_automatic_relist_save = get_post_meta( $post_id, '_lottery_automatic_relist_save', true );

		if ( $lottery_automatic_relist == 'yes' && $product->is_finished() && $lottery_relist_duration ) {

			$lottery_relist_time = get_post_meta( $post_id, '_lottery_relist_time', true );
			$lottery_automatic_relist_fail = get_post_meta( $post_id, '_lottery_automatic_relist_fail', true );

			$from_time = date( 'Y-m-d H:i', current_time( 'timestamp' ) );
			$to_time   = date( 'Y-m-d H:i', current_time( 'timestamp' ) + ( $lottery_relist_duration * 3600 ) );

			if ( $product->get_lottery_closed() && $lottery_relist_time ) {
				if( $lottery_automatic_relist_fail == 'yes' && $product->get_lottery_closed() != '1'){
					return;
				}
				if ( current_time( 'timestamp' ) > ( strtotime( $product->get_lottery_dates_to() ) + ( intval( $lottery_relist_time ) * 3600 ) ) ) {

					do_action( 'woocomerce_before_relist_lottery', $post_id );

					if ( $lottery_automatic_relist_save ) {
						self::export_to_csv($post_id);
					}

					wc_lottery_Admin::do_relist( $post_id, $from_time, $to_time );
					do_action( 'woocomerce_after_relist_lottery', $post_id );
					return;
				}
			}
		}

		return;
	}

	public static function export_to_csv( $post_id ) {

		$product_data = wc_get_product( $post_id );
		$relisteddate = get_post_meta( $post_id, '_lottery_relisted', true );
		$lottery_history = apply_filters( 'woocommerce__lottery_history_data', $product_data->lottery_history($relisteddate) );

		$path = apply_filters( 'woocommerce_lottery_export_dir_path', wp_upload_dir());
		$timestamp = current_time( 'timestamp' );
		$filename = $product_data->get_slug().'-'.$timestamp.'.csv';
		$filename = apply_filters( 'woocommerce_lottery_export_filename', $filename , $product_data );
		$lottery_upload_dir = apply_filters( 'woocommerce_lottery_export_dir_path', "/wc-lottery-export/");
		$upload_dir =  $path['basedir'].$lottery_upload_dir;
		
		if (! is_dir($upload_dir)) {
			mkdir( $upload_dir, 0700 );
		}
		$outstream = fopen( $upload_dir."/".$filename, "w" );  // the file name you choose

		$use_answers 	 = wc_lottery_use_answers( $post_id );
		$use_ticket_numbers = get_post_meta( $post_id , '_lottery_use_pick_numbers', true );
		$answers = maybe_unserialize( get_post_meta( $post_id, '_lottery_pn_answers', true ) );
		$fields = array( 
			__( 'Date','wc_lottery' ),
			__( 'User','wc_lottery' ),
			__( 'Email','wc_lottery' ),
			__( 'First name','wc_lottery' ),
			__( 'Last name','wc_lottery' ),
			__( 'Address','wc_lottery' ),
			__( 'Phone','wc_lottery' )
		);
		if ($use_ticket_numbers === 'yes' ) {
			$fields[] = __( 'Ticket number', 'wc-lottery-pn' );
		}
		if ($use_answers === true ) {
			$fields[] = __( 'Answer number', 'wc-lottery-pn' );
		}
		$fields[] = __( 'Order', 'wc_lottery' );

		$fields = apply_filters( 'woocommerce_lottery_export_fields', $fields, $product_data );
		fputcsv($outstream, $fields);  //creates the first line in the csv file
		$values=array();    // initialize the array

		
		foreach ( $lottery_history as $history_value ) {
			$user_data = get_userdata( $history_value->userid );
			$order = wc_get_order( $history_value->orderid );
			$values = array(
						date_i18n( get_option( 'date_format' ), strtotime( $history_value->date )).' '.date_i18n( get_option( 'time_format' ), strtotime( $history_value->date )),
						$user_data ? $user_data->display_name : $history_value->userid,
						$order ? $order->get_billing_email() : '',
						$order ? $order->get_billing_first_name(): '',
						$order ? $order->get_billing_last_name() : '',
						$order ? $order->get_formatted_billing_address() : '',
						$order ? $order->get_billing_phone() : '',
					);
			if( $use_ticket_numbers === 'yes' ){
				$values[] = apply_filters( 'ticket_number_display_html', $history_value->ticket_number, $product_data );
			}
			if ( $use_answers === true ){
				$answer = isset( $answers[$history_value->answer_id] ) ? $answers[$history_value->answer_id] : false;
				$values[] = esc_html( $answer['text'] );
			}
			$values[] = $history_value->orderid;
			fputcsv($outstream, $values);  //output the user info line to the csv file
		}
		fclose($outstream);

		$lottery_winers     = get_post_meta($post_id, '_lottery_winners');
		$lottery_pn_winers  = get_post_meta($post_id, '_lottery_pn_winners',true);
		if ( ! empty( $lottery_pn_winers ) ) {
			$history_winners = $lottery_pn_winers;
		} else {
			$history_winners = $lottery_winers;
		}

		add_post_meta($post_id, '_history_lottery_csv_files' , array( $lottery_upload_dir.$filename, $filename, $timestamp, $history_winners ) );
	}


	/**
	 * Ajax delete lotery csv
	 *
	 * Function for deleting participate entry in wp admin
	 *
	 * @access public
	 * @param  array
	 * @return string
	 *
	 */
	function wp_ajax_delete_lottery_history_csv() {

		global $wpdb;

		if ( ! current_user_can( 'edit_product', $_POST['postid'] ) ) {
			die();
		}

		$log_id = $_POST['logid'] ? intval( $_POST['logid'] ) : false;
		$post_id = $_POST['postid'] ? intval( $_POST['postid'] ) : false;

		if ( $post_id ) {
			$product      = wc_get_product( $post_id );
			$log = get_post_meta($post_id, '_history_lottery_csv_files');
			if ( $log ) {
				if( isset( $log[ $log_id ] ) ){
					$filename = $log[ $log_id ][1];
					unset($log[ $log_id ]);
					delete_post_meta($post_id, '_history_lottery_csv_files' );
					foreach ( $log as $data ){
						add_post_meta($post_id, '_history_lottery_csv_files' , $data );
					}
					$path = apply_filters( 'woocommerce_lottery_export_dir_path', wp_upload_dir());
					$lottery_upload_dir = apply_filters( 'woocommerce_lottery_export_dir_path', "/wc-lottery-export/");
					$upload_dir =  $path['basedir'].$lottery_upload_dir;
					unlink($upload_dir."/".$filename);
					do_action('wc_delete_lottery_history_csv' , $post_id, $log_id);
					wp_send_json( 'deleted' );
					exit;
				}
			}
			wp_send_json( 'failed' );
			exit;
		}
		wp_send_json( 'failed' );
		exit;
	}

	/* Function for adding instant6 winners fields in wp admin
	 *
	 * @access public
	 * @param  array
	 * @return string
	 *
	 */
	function wp_ajax_get_lottery_istant_winners_fields() {

		ob_start();

		check_ajax_referer( 'add_lottery_answer_nonce', 'security' );

		if ( ! current_user_can( 'edit_products' ) ) {
			die( -1 );
		}

		$thepostid     = 0;
		$ticket_numbers_prizes    = absint( $_POST['key'] );
		$position      = 0;
		$metabox_class = array();
		$ticket_number_prize        = array(
			'ticket' => '',
			'prize' => '',
		);

		include plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/html-product-lottery-instant-winners.php';
		die();


		exit;
	}



	/**
	 * Add admin notice
	 *
	 * @access public
	 * @param  array, string
	 * @return array
	 *
	 */
	public function woocommerce_simple_lottery_pn_admin_notice() {

		global $current_user;

		if ( current_user_can( 'manage_options' ) ) {
			$user_id = $current_user->ID;
			if ( get_option( 'Wc_lottery_cron_relist' ) != 'yes' && ! get_user_meta( $user_id, 'lottery_cron_relist_ignore' ) ) {
				echo '<div class="updated">
				<p>' . sprintf( __( 'For automated relisting feature please setup cronjob every 1 hour: <b>%1$s/?lottery-relist=true</b> | <a href="%2$s">Hide Notice</a>', 'wc_lottery' ), get_bloginfo( 'url' ), add_query_arg( 'lottery_cron_relist_ignore', '0' ) ) . '</p>
				</div>';
			}

		}
	}

	/**
	 * Add user meta to ignor notice about crons.
	 * @access public
	 *
	 */
	public function woocommerce_simple_lottery_pn_ignore_notices() {

		global $current_user;
		$user_id = $current_user->ID;

		/* If user clicks to ignore the notice, add that to their user meta */
		if ( isset( $_GET['lottery_cron_relist_ignore'] ) && '0' == $_GET['lottery_cron_relist_ignore'] ) {
			add_user_meta( $user_id, 'lottery_cron_relist_ignore', 'true', true );
		}
	}
	/**
	* Add to mail class
	*
	* @access public
	* @return object
	*
	*/
	public function add_to_mail_class( $emails ) {

		include_once 'emails/class-wc-email-lottery-instant-win.php';
		include_once 'emails/class-wc-email-lottery-instant-win-admin.php';

		$emails->emails['WC_Email_Lottery_Instant_Win']        = new WC_Email_Lottery_Instant_Win();
		$emails->emails['WC_Email_Lottery_Instant_Win_Admin']        = new WC_Email_Lottery_Instant_Win_Admin();


		return $emails;
	}
	/**
	 * Check order for instant prizes
	 *
	 *
	 */
	public function check_for_instant_prize( $ticket_numbers, $product_id, $user_id, $order_id, $log_ids, $item, $item_id ){

		if ( 'yes' !== get_post_meta( $product_id, '_lottery_instant_win', true ) ){
			return;
		}

		$instant_ticket_numbers_prizes = maybe_unserialize( get_post_meta( $product_id, '_lottery_instant_ticket_numbers_prizes', true ) );
		$instant_winning_tickets = array();

		if ( ! empty( $instant_ticket_numbers_prizes ) ) {

			foreach ( $instant_ticket_numbers_prizes as $key => $instant_winner ) {

				if( in_array( $instant_winner['ticket'], $ticket_numbers ) ){
					$data = array(
						'ticket'     => $instant_winner['ticket'],
						'user_id'    => $user_id,
						'order_id'   => $order_id,
						'prize'      => $instant_winner['prize'],
						'product_id' => $product_id
					);
					add_post_meta( $product_id, '_lottery_instant_instant_winners', $data );

					do_action( 'wc_lottery_instant_won',$data);
				}
			}
		}


	}

	public function remove_instant_winners_for_participate( $paricipants, $product_id, $product ){
		if ( 'yes' !== get_post_meta( $product_id, '_lottery_instant_win', true ) ){
			return $paricipants;
		}
		if ( 'yes' === get_post_meta( $product_id, '_lottery_instant_win_main_competition', true ) ){
			return $paricipants;
		}

		$lottery_instant_instant_winners = get_post_meta( $product_id, '_lottery_instant_instant_winners');
		if ( ! empty ( $lottery_instant_instant_winners ) ){
			$ticket_prize = array();
			foreach ($lottery_instant_instant_winners as $key => $winner) {
				$ticket_prize[ $winner[ 'ticket' ] ] = $winner['prize'];
			}
		}

		foreach ($paricipants as $key => $paricipant) {
			if ( array_key_exists( $paricipant['ticket_number'], $ticket_prize ) ){
			 		unset( $paricipants[ $key ] );
			 	}
		}
		return $paricipants;

	}
}

