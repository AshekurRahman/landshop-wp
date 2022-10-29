<?php
/**
 * Admin instant lottery win finish email
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
$product_data = wc_get_product($product_id);
?>

<?php do_action('woocommerce_email_header', $email_heading); ?>

<p><?php printf(__("User <a href='%s'>%s</a> has won %s with ticket number %s in <a href='%s'>%s</a> as instant prize.", 'wc-lottery-pn'), get_edit_user_link( $user_id ), get_userdata( $user_id )->display_name, $prize, $ticket, get_permalink($product_id), $product_data -> get_title()); ?></p>

<p><?php
/**
 * Show user-defined additional content - this is set in each email's settings.
 */

if ( $additional_content ) {

	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}
?></p>

<?php do_action('woocommerce_email_footer');