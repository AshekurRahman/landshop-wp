<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>



<head>

	<meta charset="<?php bloginfo('charset'); ?>">

	<meta name="viewport" content="width=device-width, initial-scale=1">

	<meta http-equiv="x-ua-compatible" content="ie=edge">

	<?php wp_head(); ?>

</head>

<?php
	if ( class_exists( 'Redux' ) ) {
		global $landshop_opt;
	}else{
		$landshop_opt['nav_alert_display'] = '0';
		$landshop_opt['nav_alert_content'] = esc_html__('Wireless Webcam, Satisfaction Guaranteed Small Photo, Special Photo','landshop');
	}
?>

<body <?php body_class(); ?> data-spy="scroll" data-target=".navbar__area">
	<?php wp_body_open(); ?>
	<main class="main_wrapper">
        <?php if($landshop_opt['nav_alert_display'] == '1' && !empty($landshop_opt['nav_alert_content'])): ?>
            <div class="header_alert">
                <div class="alert_text"><?php echo wp_kses_post($landshop_opt['nav_alert_content']); ?></div>
                <button type="button" class="close" ><i class="fa-light fa-times"></i></button>
            </div>
        <?php endif; ?>
		<div class="page__wrapper">
    		<?php get_template_part('components/layouts/nav_menu'); ?>