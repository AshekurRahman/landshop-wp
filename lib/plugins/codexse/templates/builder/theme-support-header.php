<?php
use Elementor\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php echo Utils::get_meta_viewport( 'theme-builder' ); ?>
    <?php if (!current_theme_supports('title-tag')) : ?>
        <title>
            <?php echo wp_get_document_title(); ?>
        </title>
    <?php endif; ?>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>

    <?php do_action('codexseaddons/template/before_header'); ?>

    <div class="cx-template-content-markup cx-template-content-header cx-template-content-theme-support">
        <?php
        // $template = \Codexse_Addons\Elementor\Theme_Builder::template_ids();
        // echo \Codexse_Addons\Elementor\Theme_Builder::render_builder_data($template[0]);

        // $template = \Codexse_Addons\Elementor\Condition_Manager::instance()->get_location_templates('header');
        echo \Codexse_Addons\Elementor\Theme_Builder::instance()->render_builder_data_location('header');
        ?>
    </div>
    <?php do_action('codexseaddons/template/after_header'); ?>
