<?php
/*
Plugin Name: Landshop Core
Description: Creates an interfaces to manage store / business locations on your website. Useful for showing location based information quickly. Includes both a widget and shortcode for ease of use.
Version:     1.0.0
Author:      Ashekur Rahman
Author URI:  https://www.codexse.com/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/
if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly


/*-- All-Action-Hooks --*/
add_action( 'plugins_loaded', 'landshopcore_plugin_loaded' );
add_action( 'wp_enqueue_scripts', 'landshopcore_enqueue_script' );
add_action( 'admin_enqueue_scripts', 'landshopcore_admin_scripts' );
add_action( 'widgets_init', 'landshopcore_widgets_init' );

/*-- Elementor-Widget-Controls --*/
add_action( 'elementor/init','landshopcore_elementor_init', 10 );
add_action( 'elementor/widgets/widgets_registered', 'landshopcore_includes_widgets' ); 
add_action( 'elementor/frontend/after_register_scripts', 'landshopcore_register_fronted_scripts', 10 );
add_action( 'elementor/frontend/after_register_styles', 'landshopcore_register_frontend_styles', 10 );  
add_action( 'elementor/editor/after_enqueue_styles', 'landshopcore_admin_scripts', 10 );
add_action( 'elementor/controls/controls_registered', 'landshopcore_add_fonts_elementor', 10, 1 ); 

function landshopcore_add_fonts_elementor($controls_registry){
    // retrieve fonts list from Elementor
    $fonts = $controls_registry->get_control( 'font' )->get_settings( 'options' );
    // add your new custom font
    $new_fonts = array_merge( [ 'satoshi' => 'system' ], $fonts );
    $new_fonts = array_merge( [ 'recoleta' => 'system' ], $new_fonts );
    // return the new list of fonts
    $controls_registry->get_control( 'font' )->set_settings( 'options', $new_fonts );
}


function landshopcore_elementor_init(){
    \Elementor\Plugin::instance()->elements_manager->add_category( 'landshopcore',[ 'title'  => 'landshopcore' ], 1 );
    require_once( dirname(__FILE__) . '/inc/plugin-icon-manager.php');
}

function landshopcore_includes_widgets(){
    require_once( dirname(__FILE__).'/addons/widgets_control.php' );
}

function landshopcore_register_frontend_styles(){
    // Add Lity, Used for lightbox popup
    wp_register_style( 'lity', plugins_url( '/assets/css/lity-min.css', __FILE__ ), array(), '2.3.1' );     
}

function landshopcore_register_fronted_scripts(){
    wp_register_script( 'countdown', plugins_url( '/assets/js/countdown.js', __FILE__ ), array('jquery'), '1.0.0', true );
    wp_register_script( 'isotope', plugins_url( '/assets/js/isotope-min.js', __FILE__ ), array('jquery'), '1.0.0', true );
    wp_register_script( 'addons-active', plugins_url( '/assets/js/addons-active.js', __FILE__ ), array('jquery'), '1.0.0', true );
    // Add Lity, Used for lightbox popup.
    wp_register_script( 'lity', plugins_url( '/assets/js/lity-min.js', __FILE__ ), array('jquery'), '2.3.1', true );     
    wp_register_script( 'bootstrap-js', plugins_url( '/assets/js/bootstrap-min.js', __FILE__ ), array('jquery'), '3.4.1', true );     
    wp_register_script( 'plyr', plugins_url( '/assets/js/plyr.min.js', __FILE__ ), array('jquery'), '3.4.1', true );     
    wp_register_script( 'polyfilled', plugins_url( '/assets/js/plyr.polyfilled.min.js', __FILE__ ), array('jquery'), '3.4.1', true );     
}

function landshopcore_widgets_init(){
    register_widget( 'landshop_social_menu' );
    register_widget( 'landshop_author_info' );
    register_widget( 'landshop_popular_posts' );
}

function landshopcore_enqueue_script(){
    $wp_scripts = wp_scripts();
    wp_enqueue_style('landshop-ui-css', plugins_url( '/assets/css/jquery-ui.css', __FILE__ ), false, '1.13.0', false);
    // Add Landshop Core Style, Used For Stylist Dropdown Select Box
    wp_enqueue_style( 'landshopcore-audio', plugins_url( '/assets/css/audio.css', __FILE__ ), array(), '1.0.0' );
    wp_enqueue_style( 'landshopcore-main', plugins_url( '/assets/css/main.css', __FILE__ ), array(), '1.0.0' );
    wp_enqueue_style( 'swiper', plugins_url( '/assets/css/swiper-bundle-min.css', __FILE__ ), array(), '1.0.0' );
            
    wp_register_script( 'jquery-easing', plugins_url( '/assets/js/easing-min.js', __FILE__ ), array('jquery'), '1.3.0', true );
    wp_register_script( 'easypiechart', plugins_url( '/assets/js/easypiechart-min.js', __FILE__ ), array('jquery'), '1.0.0', true );
    wp_register_script( 'anime', plugins_url( '/assets/js/anime.js', __FILE__ ), array('jquery'), '1.0.0', true );
	wp_enqueue_script( 'swiper', plugins_url( '/assets/js/swiper-bundle-min.js', __FILE__ ), array('jquery'), '1.0.0', true );        
	// landshopcore-Core-Active-Script
	wp_enqueue_script( 'landshopcore-active', plugins_url( '/assets/js/plugin-core.js', __FILE__ ), array('jquery'), '1.0.0', true );
}

function landshopcore_plugin_loaded(){
    load_plugin_textdomain( 'landshopcore', false, basename(dirname(__FILE__)) . '/language/' );
    require_once( dirname(__FILE__) . '/inc/plugin-functions.php');
    require_once( dirname(__FILE__) . '/inc/metabox.php');
    require_once( dirname(__FILE__) . '/inc/service-post-type.php');
    require_once( dirname(__FILE__) . '/inc/case-studies-post-type.php');
    require_once( dirname(__FILE__) . '/inc/team-post-type.php');
    require_once( dirname(__FILE__) . '/widgets/popular-post.php');
    require_once( dirname(__FILE__) . '/widgets/social-menu.php');
    require_once( dirname(__FILE__) . '/widgets/profile.php');
}

function landshopcore_admin_scripts(){
    wp_enqueue_style('landshop_admin_style',plugins_url( '/assets/css/plugin-admin.css', __FILE__ ),array(),'1.0','all');
    wp_enqueue_script('landshop_admin_script', plugins_url( '/assets/js/plugin-admin.js', __FILE__ ) ,array('jquery'),'1.0',true );
}

function landshop_add_file_types_to_uploads($file_types){
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes );
	return $file_types;
}
add_action('upload_mimes', 'landshop_add_file_types_to_uploads');