<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package landshop
 */
if ( is_active_sidebar( 'main_sidebar' )  ) : 
?>
<aside class="sidebar main__sidebar">
   <?php dynamic_sidebar( 'main_sidebar' ); ?>
</aside>
<?php endif; ?>