<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Lottery won emails 
 *
 * Lottery won emails are sent when a user wins the lottery.
 * @class 		WC_Email_SA_Outbid
 * @extends 	WC_Email
 */

class WC_Email_Lottery_Instant_Win extends WC_Email {
    
    /** @var string */
    var $title;

    /** @var string */
    var $lottery_id;	
    /** @var string */
    var $ticket;
    /** @var string */
    var $prize;

    /**
     * Constructor
     *
     * @access public
     * @return void
     */
    function __construct() {

        global $wc_lottery;		

        $this->id             = 'lottery_instant_win';
        $this->title          = __( 'Lottery Instant Win User', 'wc_lottery' );
        $this->description    = __( 'Lottery won emails are sent when a user wins instant prize.', 'wc_lottery' );
        
        $this->template_html  = 'emails/lottery_instant_win_user.php';
        $this->template_plain = 'emails/plain/lottery_instant_win_user.php';
        $this->template_base  =  $wc_lottery->get_path(). 'templates/';
        $this->customer_email = true;
        
        $this->subject        = __( 'Instant prize won on {blogname}', 'wc_lottery');
        $this->heading        = __( 'You have won instant prize in the lottery!', 'wc_lottery');
        
        

        add_action( 'wc_lottery_instant_won_notification', array( $this, 'trigger' ) );

        // Call parent constructor
        parent::__construct();
    }
    /**
     * trigger function.
     *
     * @access public
     * @return void
     */
    function trigger( $data ) {

        if ( !$this->is_enabled() ) return;

        if ( $data['product_id'] ) {
            if( get_post_status( $data['product_id'] ) != 'publish' ){
                return;
            }
            $product_data  = wc_get_product(  $data['product_id'] );

            if ( $product_data && !empty($data['user_id'])) {

                $this->object      = new WP_User( $data['user_id'] );
                $this->recipient   = $this->object->user_email;
                $this->lottery_id  = $data['product_id'];
                $this->ticket  = $data['ticket'];
                $this->prize  = $data['prize'];
                $this->send( $this->get_recipient(), $this->get_subject(), $this->get_content(), $this->get_headers(), $this->get_attachments() );

            }
        }	
    }
    /**
     * get_content_html function.
     *
     * @access public
     * @return string
     */
    function get_content_html() {
        ob_start();
        wc_get_template( 	
                $this->template_html, array(
                    'email_heading'      => $this->get_heading(),
                    'blogname'           => $this->get_blogname(),
                    'additional_content' => $this->get_additional_content(),
                    'product_id'         => $this->lottery_id,
                    'ticket'             => $this->ticket,
                    'prize'              => $this->prize
                ) );
        return ob_get_clean();
    }
    /**
     * get_content_plain function.
     *
     * @access public
     * @return string
     */
    function get_content_plain() {
        ob_start();
        wc_get_template( 
                $this->template_plain, array(
                    'email_heading'         => $this->get_heading(),
                    'blogname'              => $this->get_blogname(),
                    'additional_content'    => $this->get_additional_content(),
                    'product_id'         => $this->lottery_id,
                    'ticket'             => $this->ticket,
                    'prize'              => $this->prize
        ) );
        return ob_get_clean();
    }
}