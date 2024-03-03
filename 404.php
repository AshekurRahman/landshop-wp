<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-spy="scroll" data-target=".navbar__area">
    <?php wp_body_open(); ?>
    <main class="main_wrapper">
        <div class="page__wrapper">
        <?php
            if ( is_plugin_active( 'elementor/elementor.php' ) ) {
                $elementor_template = get_theme_mod('header_elementor_template_setting', 'default');
            }
        ?>
        <?php if (empty($elementor_template) || $elementor_template === 'default'): ?>
            <section class="error__section">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="error__image">
                                <img src="<?php echo esc_url(get_theme_mod('landshop_404_image', get_theme_file_uri('assets/images/404.png'))); ?>" alt="<?php esc_attr_e('404', 'landshop'); ?>">
                            </div>
                            <h2 class="error__title"><?php echo esc_html(get_theme_mod('landshop_404_button_text', __('Oops... Page Not Found!', 'landshop'))); ?></h2>
                            <div class="error__desc">
                                <p><?php echo esc_html(get_theme_mod('landshop_404_description', __('Please return to the site\'s homepage. It looks like nothing was found at this location. Get in touch to discuss your employee needs today. Please give us a call, drop us an email.', 'landshop'))); ?></p>
                            </div>
                            <a href="<?php echo esc_url(home_url('/')) ?>" class="primary__button">
                                <?php echo esc_html(get_theme_mod('landshop_404_button_text', __('Back to Home', 'landshop'))); ?>
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        <?php else: ?>
            <footer class="header__elementor__section">
                <?php echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($elementor_template); ?>
            </footer>
        <?php endif; ?>
        </div>
    </main>
    <?php wp_footer(); ?>
</body>

</html>
