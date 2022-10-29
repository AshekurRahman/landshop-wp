<?php
/**
 * Lottery info template
 *
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $product, $post;

$prizes = wc_lottery_get_instant_winning_prizes( $product->get_id() );
if ( empty( $prizes ) ){
        return;
}
?>
<p class="max-pariticipants"><?php  printf( _n( "This lottery has %d instant prize" , "This lottery has %d instant prizes", count( $prizes ) , 'wc_lottery' ) , count( $prizes ) ) ; ?></p>
<ol class="lottery-winners">
        <?php
        foreach ($prizes as $prize) {
                echo "<li>";
                esc_html_e(  $prize );
                echo "</li>";
        }
        ?>
</ol>

