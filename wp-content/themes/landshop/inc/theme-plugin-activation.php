<?php
require_once get_theme_file_path('/inc/class-tgm-plugin-activation.php');
add_action( 'tgmpa_register', 'landshop_register_required_plugins' );
function landshop_register_required_plugins() {
	$plugins = array(        
		// Add CMB2 plugin. Userd for Create Extra New Field in .
		array(
			'name'      => 'Redux Framework',
			'slug'      => 'redux-framework',
			'required'  => true,
		),
        array(
            'name'      => 'Landshop Core',
            'slug'      => 'landshopcore',
            'source'    => get_theme_file_path('/lib/plugins/landshopcore.zip'),
            'required'  => false
        ),
        array(
            'name'      => 'MailChimp for WordPress',
            'slug'      => 'mailchimp-for-wp',
            'required'  => false
        ),
        array(
            'name'      => 'Classic Editor',
            'slug'      => 'classic-editor',
            'required'  => false
        ),
        array(
            'name'      => 'One Click Demo Import',
            'slug'      => 'one-click-demo-import',
            'required'  => false
        ),
        array(
            'name'      => 'Elementor Page Builder',
            'slug'      => 'elementor',
            'required'  => false
        ),
        array(
            'name'      => 'Contact Form 7',
            'slug'      => 'contact-form-7',
            'required'  => false
        ),
        array(
            'name'      => 'CMB2',
            'slug'      => 'cmb2',
            'required'  => true
        ),
        array(
            'name'      => 'Widget Importer & Exporter',
            'slug'      => 'widget-importer-exporter',
            'required'  => false
        ),
        array(
            'name'      => 'Customizer Export/Import',
            'slug'      => 'customizer-export-import',
            'required'  => false
        ),
       array(
            'name'      => 'TI WooCommerce Wishlist',
            'slug'      => 'ti-woocommerce-wishlist',
            'required'  => false
        ),
       array(
            'name'      => 'WooCommerce',
            'slug'      => 'woocommerce',
            'required'  => false
        )
	);

	$config = array(
		'id'           => 'landshop',
		'default_path' => '',
		'menu'         => 'tgmpa-install-plugins',
		'has_notices'  => true,
		'dismissable'  => true,
		'dismiss_msg'  => '',
		'is_automatic' => false,
		'message'      => '',
	);

	tgmpa( $plugins, $config );
}