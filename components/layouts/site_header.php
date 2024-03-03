<?php   
if ( is_plugin_active( 'elementor/elementor.php' ) ) {
    $elementor_template = get_theme_mod('header_elementor_template_setting', 'default');
}
?>
<?php if (empty($elementor_template) || $elementor_template === 'default'): ?>
<!--Site_Header-Start-->
<section class="header__area <?php echo get_post_type(); ?>">
    <div class="container">
        <h1 class="page_title"><?php echo landshop_page_title(); ?></h1>
        <div class="sub__title">
            <?php echo get_bloginfo( 'description' ); ?>
        </div>
    </div>
</section>
<!--Site_Header-End-->
<?php else: ?>
    <footer class="header__elementor__section">
        <?php echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($elementor_template); ?>
    </footer>
<?php endif; ?>