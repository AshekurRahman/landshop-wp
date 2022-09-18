<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package Landshop
 */
if ( is_active_sidebar( 'wc_sidebar' )  ) : 
?>
<aside class="sidebar main-sidebar">
   <?php dynamic_sidebar( 'wc_sidebar' ); ?>
</aside>
<?php endif; ?>