<?php
/**
 * The template for the sidebar containing the main widget area
 *
 * @package maruncy
 */
if ( is_active_sidebar( 'main_sidebar' )  ) : 
?>
<aside class="sidebar main-sidebar ps-lg-4">
   <?php dynamic_sidebar( 'main_sidebar' ); ?>
</aside>
<?php endif; ?>