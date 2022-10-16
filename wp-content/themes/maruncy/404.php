<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-spy="scroll" data-target=".nav_area">
	<?php wp_body_open();
        if ( class_exists( 'Redux' ) ) {
            global $maruncy_opt;
        }else{
            $maruncy_opt = array();
            $maruncy_opt['error_image']['url'] = get_theme_file_uri('assets/images/404.png');
            $maruncy_opt['error_title'] = __('Opps! Page not found','maruncy');
            $maruncy_opt['error_desc'] = __("Page doesn't exist or some other error occurred. Go to our home page or go back to the previous page.",'maruncy');
        }
    ?>
    <section class="error_page">
        <div class="container">
            <div class="error_image">
                <img src="<?php echo esc_url($maruncy_opt['error_image']['url']); ?>" alt="<?php _e('404','maruncy'); ?>">
            </div>
            <?php if(!empty($maruncy_opt['error_title'])): ?>
                <h2 class="error-title"><?php echo esc_html($maruncy_opt['error_title']); ?></h2>
            <?php endif; ?>
            <?php if(!empty($maruncy_opt['error_desc'])): ?>
            <div class="error-desc">
                <p><?php echo esc_html($maruncy_opt['error_desc']); ?></p>
            </div>
            <?php endif; ?>
            <a href="<?php echo esc_url(home_url('/'))?>" class="primary_button rounded"><?php _e('Go to Homepage','maruncy'); ?></a>
        </div>
    </section>    
    <?php wp_footer(); ?>
</body>

</html>