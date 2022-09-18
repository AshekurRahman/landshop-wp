<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-spy="scroll" data-target=".nav_area">
	<?php wp_body_open(); ?>
	<main class="main_wrapper">
		<div class="page_wrapper">
    		<?php get_template_part('components/layouts/nav_menu'); ?>