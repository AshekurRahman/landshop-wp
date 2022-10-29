<?php
/**
 * Lottery Pick Number Addon - admin email notification for duplicated ticket
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
?>

<?php do_action('woocommerce_email_header', $email_heading); ?>

<p><?php printf( __( 'Sorry. Order <a href="' . admin_url( 'post.php?post=%s&action=edit' ) . '">%s</a> has duplicate ticket number %s. Order has been put on hold please check it!', 'wc_lottery' ), $order_id, $order_id, $ticket_number); ?></p>


<?php do_action('woocommerce_email_footer');