<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-spy="scroll" data-target=".navbar__area">
    <?php wp_body_open();
        if ( class_exists( 'Redux' ) ) {
            global $landshop_opt;
        }else{
            $landshop_opt = array();
            $landshop_opt['error_image']['url'] = get_theme_file_uri('assets/images/404.png');
            $landshop_opt['error_title'] = esc_html__('Oops... Page Not Found!','landshop');
            $landshop_opt['error_desc'] = esc_html__("Please return to the site's homepage, It looks like nothing was found at this location. Get in touch to discuss your employee needs today. Please give us a call, drop us an email.",'landshop');
        }
    ?>
    <section class="error_page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="error_image">
                        <img src="<?php echo esc_url($landshop_opt['error_image']['url']); ?>" alt="<?php esc_attr_e('404','landshop'); ?>">
                    </div>
                    <?php if(!empty($landshop_opt['error_title'])): ?>
                    <h2 class="error-title"><?php echo esc_html($landshop_opt['error_title']); ?></h2>
                    <?php endif; ?>
                    <?php if(!empty($landshop_opt['error_desc'])): ?>
                    <div class="error-desc">
                        <p><?php echo esc_html($landshop_opt['error_desc']); ?></p>
                    </div>
                    <?php endif; ?>
                    <a href="<?php echo esc_url(home_url('/'))?>" class="primary_button"><?php esc_html_e('Back To Home','landshop'); ?></a>
                </div>
            </div>
        </div>
    </section>
    <?php wp_footer(); ?>
</body>

</html>