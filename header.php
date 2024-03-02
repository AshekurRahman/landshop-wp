<!DOCTYPE html>

<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-spy="scroll" data-target=".navbar__area">
    <!-- Preloader Start -->
    <?php
    $preloader_status = get_theme_mod('landshop_preloader_status', 'enable');
    $preloader_image  = get_theme_mod('landshop_preloader_image', get_theme_file_uri('assets/images/preloader.gif'));

    if ($preloader_status === 'enable') : ?>
        <div class="preloader">
			<div class="loader__image">
            <img src="<?php echo esc_url($preloader_image); ?>" alt="Preloader">
			</div>
        </div>
    <?php endif; ?>
    <!-- Preloader End -->

    <?php wp_body_open(); ?>

    <main class="main_wrapper">
        <div class="page__wrapper">
            <?php get_template_part('components/layouts/nav_menu'); ?>
