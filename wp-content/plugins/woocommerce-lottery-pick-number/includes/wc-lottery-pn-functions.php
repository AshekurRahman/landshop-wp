<?php

function wc_lottery_pn_get_taken_numbers( $product_id = false, $user_id = false, $context = 'view' ) {
	global $product;

	$wheredatefrom = '';

	if ( ! $product_id && $product ) {
			$product_id = $product->get_id();
	}
	global $wpdb;

	$relisteddate = get_post_meta( $product_id, '_lottery_relisted', true );
	$result = wp_cache_get( 'wc_lottery_pn_get_taken_numbers' . $product_id  , 'wc_lottery' );
	if ( false === $result || $context === 'edit' ) {
		if ( $relisteddate ) {
			$wheredatefrom = ' AND CAST(' . $wpdb->prefix . "wc_lottery_log.date AS DATETIME) > '$relisteddate' ";
		}

		$result = $wpdb->get_col( $wpdb->prepare( 'SELECT ' . $wpdb->prefix . 'wc_lottery_pn_log.ticket_number FROM ' . $wpdb->prefix . 'wc_lottery_pn_log LEFT JOIN ' . $wpdb->prefix . 'wc_lottery_log ON ' . $wpdb->prefix . 'wc_lottery_log.id = ' . $wpdb->prefix . 'wc_lottery_pn_log.log_id WHERE ' . $wpdb->prefix . 'wc_lottery_pn_log.lottery_id = %d ' . $wheredatefrom, $product_id ) );
		wp_cache_set( 'wc_lottery_pn_get_taken_numbers' . $product_id, $result, 'wc_lottery' );
	}

	return $result;
}


function wc_lottery_pn_get_reserved_numbers( $product_id = false, $session_key = false, $context = 'view', $user_numbers = false) {
	global $product;

	if ( ! $product_id && $product ) {
			$product_id = $product->get_id();
	}
	global $wpdb;

	$result = wp_cache_get( 'wc_lottery_pn_get_reserved_numbers' . $product_id . $session_key. $user_numbers , 'wc_lottery' );
	if ( false === $result || $context !== 'edit') {
		$minutes = get_option( 'lottery_answers_reserved_minutes', '5' );

		$wpdb->query( $wpdb->prepare( 'DELETE FROM ' . $wpdb->prefix . 'wc_lottery_pn_reserved WHERE date < (NOW() - INTERVAL %d MINUTE)', $minutes ) );

		if( ! $session_key ){

			$result = $wpdb->get_col( $wpdb->prepare( 'SELECT ' . $wpdb->prefix . 'wc_lottery_pn_reserved.ticket_number FROM ' . $wpdb->prefix . 'wc_lottery_pn_reserved  WHERE ' . $wpdb->prefix . 'wc_lottery_pn_reserved.lottery_id = %d ', $product_id ) );
		} else {
			if ( $user_numbers  ) {
				$result = $wpdb->get_col( $wpdb->prepare( 'SELECT ' . $wpdb->prefix . 'wc_lottery_pn_reserved.ticket_number FROM ' . $wpdb->prefix . 'wc_lottery_pn_reserved  WHERE ' . $wpdb->prefix . 'wc_lottery_pn_reserved.lottery_id = %d AND session_key = %s', $product_id, $session_key ) );
			} else {
				$result = $wpdb->get_col( $wpdb->prepare( 'SELECT ' . $wpdb->prefix . 'wc_lottery_pn_reserved.ticket_number FROM ' . $wpdb->prefix . 'wc_lottery_pn_reserved  WHERE ' . $wpdb->prefix . 'wc_lottery_pn_reserved.lottery_id = %d AND session_key != %s', $product_id, $session_key ) );
			}
		}
		wp_cache_set( 'wc_lottery_pn_get_reserved_numbers' . $product_id . $session_key . $user_numbers, $result, 'wc_lottery' );
	}


	return $result;
}


function wc_lottery_pn_get_true_answers( $product_id = false ) {
	global $product;

	$answers_id = array();

	if ( ! $product_id && $product ) {
			$product_id = $product->get_id();
	}

	$answers = maybe_unserialize( get_post_meta( $product_id, '_lottery_pn_answers', true ) );

	if ( $answers ) {
		foreach ( $answers as $key => $answer ) {
			if ( 1 === $answer['true'] ) {
					$answers_id[ $key ] = $answer['text'];
			}
		}
	}

	return $answers_id;
}


function wc_lottery_pn_get_ticket_numbers_from_cart( $product_id = false ) {
	$items          = WC()->cart->get_cart();
	$ticket_numbers = array();
	foreach ( $items as $key => $value ) {
		if ( isset( $ticket_numbers[ $value['product_id'] ] ) ) {
			$ticket_numbers[ $value['product_id'] ] = array_merge( $ticket_numbers[ $value['product_id'] ], $value['lottery_tickets_number'] );
		} elseif ( isset( $value['lottery_tickets_number'] ) ) {
			$ticket_numbers[ $value['product_id'] ] = $value['lottery_tickets_number'];
		}
	}
	if ( $product_id ) {
		return isset( $ticket_numbers[ $product_id ] ) ? $ticket_numbers[ $product_id ] : array();
	}
	return $ticket_numbers;
}


function wc_lottery_use_answers( $product_id = false ) {

	global $product;

	if ( ! $product_id && $product ) {
			$product_id = $product->get_id();
	}

	$use_answers = get_post_meta( $product_id, '_lottery_use_answers', true );

	if ( 'yes' !== $use_answers ) {
		return false;
	}

	$lottery_question = get_post_meta( $product_id, '_lottery_question', true );

	if ( ! $lottery_question ) {
		return false;
	}

	$answers = maybe_unserialize( get_post_meta( $product_id, '_lottery_pn_answers', true ) );
	if ( ! $answers ) {
		return false;
	}

	return true;
}


function wc_lottery_generate_random_ticket_numbers( $product_id, $qty ) {

	$random_tickets = array();

	$available_tickets= wc_lotery_get_available_ticket( $product_id );

	if( empty( $available_tickets ) || count( $available_tickets ) < $qty ) {
		return false;
	}

	$random_tickets =   (array) array_rand( array_flip ($available_tickets) , $qty);

	if( !empty( $random_tickets ) ){

		$session_key = WC()->session->get_customer_id();
		wc_lottery_reserve_ticket($product_id, $random_tickets, $session_key);
	} 

	if ( empty( $random_tickets ) ){
		return false;
	}
	
	return apply_filters( 'wc_lottery_generate_random_ticket_numbers', $random_tickets, $product_id, $qty );
}


function wc_lottery_reserve_ticket( $lottery_id, $ticket_number, $session_key) {
	global $wpdb;
	$result = false;

	if( is_array( $ticket_number ) && ! empty( $ticket_number )){
		$values = array();
		$place_holders = array();

		$query = "INSERT IGNORE INTO " . $wpdb->prefix . "wc_lottery_pn_reserved (lottery_id, ticket_number, session_key) VALUES ";
		for ( $i = 0; $i < count($ticket_number); ) {
			array_push( $values, $lottery_id, $ticket_number[$i] , $session_key);
			$place_holders[] = "('%d', '%d', %s)";
			$i++;
		}
		$query .= implode( ', ', $place_holders );
		$result = $wpdb->query( $wpdb->prepare( $query, $values ) );

	} else{
		$result=  $wpdb->query( $wpdb->prepare( 'INSERT IGNORE INTO '.$wpdb -> prefix .'wc_lottery_pn_reserved (lottery_id, ticket_number, session_key) VALUES ( %d, %d, %s)', $lottery_id, $ticket_number, $session_key) );
	}

	return $result;
}


function lottery_get_int_number_from_alphabet($alphabet_number , $product){

	if( ! $product ) {
		return $alphabet_number;
	}
	$max_tickets = intval( $product->get_max_tickets() );
	$tabnumbers = get_post_meta( $product->get_id() , '_lottery_pick_number_tab_qty', true );
	$tabnumbers = $tabnumbers ? intval( $tabnumbers )  : 100;

	if ( $max_tickets > $tabnumbers * 26 ){
		$tabnumbers = ceil ( $max_tickets / 26 );
	}

	$alphabet = array_flip  ( range('A', 'Z') );

	$letter = $alphabet_number[0];

	$in = $alphabet[$letter];

	$first_digits= $in;

	$add_numbers = $in * $tabnumbers;

	$int_ticket_number = intval( $add_numbers + intval( substr($alphabet_number, 1) ) );	

	return $int_ticket_number;
}


function wc_lotery_get_available_ticket( $product_id ) {

	$taken_numbers = wc_lottery_pn_get_taken_numbers( $product_id, false, 'edit' );

	$reserved_numbers = wc_lottery_pn_get_reserved_numbers( $product_id, false, 'edit' );

	$tickets_from_cart = wc_lotery_get_tickets_from_cart( $product_id );

	$max_tickets = intval( get_post_meta( $product_id, '_max_tickets', true ) );

	$tickets = range(1, $max_tickets);

	$available_tickets= array_diff ($tickets,$taken_numbers, $reserved_numbers, $tickets_from_cart);

	return $available_tickets;
}


function wc_lotery_get_tickets_from_cart( $product_id ) {

	$tickets_in_cart = array();

	if ( ! WC()->cart->is_empty() ) {
		foreach(WC()->cart->get_cart() as $cart_item ) {
			if($product_id == $cart_item['product_id'] ){
				if( isset( $cart_item[ 'lottery_tickets_number' ] ) && $cart_item['lottery_tickets_number'] && is_array( $cart_item['lottery_tickets_number'] ) ){
					$tickets_in_cart = array_merge($tickets_in_cart, $cart_item['lottery_tickets_number']);
				}
			}
			
		}
	}
	return $tickets_in_cart;

}

function wc_lotery_get_order_id_by_log_id( $log_id ) {
	global $wpdb;
	if( $log_id ){
		$log_id = $wpdb->get_var( 'SELECT order_id FROM '.$wpdb->prefix.'wc_lottery_pn_log WHERE log_id =' . intval( $log_id ) );
	}
	return $log_id;

}
function wc_lottery_get_user_tickets_for_lottery ($user_id, $product_id ) {
	global $wpdb;
	$result = wp_cache_get( 'wc_lottery_get_user_tickets_for_lottery' . $product_id . $user_id , 'wc_lottery' );
	if ( false === $result ) {
		$result = $wpdb->get_results(
				$wpdb->prepare(
					'SELECT distinct(ticket_number), order_id
	                FROM ' . $wpdb->prefix . 'wc_lottery_pn_log
	                INNER JOIN ' . $wpdb->prefix . 'wc_lottery_log ON ' . $wpdb->prefix . 'wc_lottery_pn_log.log_id = ' . $wpdb->prefix . 'wc_lottery_log.id
	                WHERE ' . $wpdb->prefix . 'wc_lottery_pn_log.lottery_id = %d AND ' . $wpdb->prefix . 'wc_lottery_log.userid = %d',
					$product_id,
					$user_id
				)
			);
		wp_cache_set( 'wc_lottery_get_user_tickets_for_lottery' . $product_id . $user_id, $result, 'wc_lottery' );
	}

	return $result;

}


function wc_lottery_get_instant_winning_tickets ($product_id ) {
	$instant_winning_tickets = array();
	$instant_ticket_numbers_prizes = maybe_unserialize( get_post_meta( $product_id, '_lottery_instant_ticket_numbers_prizes', true ) );


	if ( ! empty( $instant_ticket_numbers_prizes ) ) {

		foreach ($instant_ticket_numbers_prizes as $instant_winner_key => $instant_winner) {
			$instant_winning_tickets[] = $instant_winner['ticket'];
		}
	}
	return $instant_winning_tickets ;
}

function wc_lottery_get_instant_winning_prizes ($product_id ) {
	$instant_prizes = array();
	$instant_ticket_numbers_prizes = maybe_unserialize( get_post_meta( $product_id, '_lottery_instant_ticket_numbers_prizes', true ) );

	if ( ! empty( $instant_ticket_numbers_prizes ) ) {

		foreach ($instant_ticket_numbers_prizes as $instant_winner_key => $instant_winner) {
			$instant_prizes[] = isset( $instant_winner['prize']) ? $instant_winner['prize'] : '' ;
		}
	}
	return $instant_prizes ;

}

function wc_lottery_get_instant_winners_id ($product_id ) {

	$lottery_instant_instant_winners = get_post_meta( $product_id, '_lottery_instant_instant_winners');
	$users_id = array();

	if ( ! empty( $lottery_instant_instant_winners ) ) {

		foreach ($lottery_instant_instant_winners as $instant_winner_key => $instant_winner) {
			$users_id[] = isset( $instant_winner['user_id']) ? $instant_winner['user_id'] : '' ;
		}
	}
	return $users_id ;

}
function wc_lottery_get_instant_winners_ticket ($product_id ) {

	$lottery_instant_instant_winners = get_post_meta( $product_id, '_lottery_instant_instant_winners');
	$ticket = array();

	if ( ! empty( $lottery_instant_instant_winners ) ) {

		foreach ($lottery_instant_instant_winners as $instant_winner_key => $instant_winner) {
			$ticket[] = isset( $instant_winner['ticket']) ? $instant_winner['ticket'] : '' ;
		}
	}
	return $ticket ;

}